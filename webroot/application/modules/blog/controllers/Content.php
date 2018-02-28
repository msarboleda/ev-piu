<?php defined('BASEPATH') || exit('No direct script access allowed');

class Content extends Admin_Controller {
  /**
   * Basic constructor. Calls the Admin_Controller's constructor, then sets
   * the toolbar title displayed on the admin/content/blog page.
   *
   * @return void
   */
  public function __construct() {
    parent::__construct();

    $this->db_con = 'EVPIU';
    $this->load->model('users/user_model');
    $this->load->model('post_model');

    Template::set('toolbar_title', 'Administrar Publicaciones');
    Template::set_block('sub_nav', 'content/sub_nav');
  }

  /**
   * The default page for this context.
   *
   * @return void
   */
  public function index() {
    if (isset($_POST['delete'])) {
      $this->deletePosts($this->input->post('checked'));
    }

    // Finished handling the post, now display the list
    $posts = $this->post_model->where('deleted', 0)->find_all();

    Template::set('publicaciones', $posts);
    Template::render();
  }

  public function create() {
    if ($this->input->post('submit')) {
      $user_id = $this->current_user->id;
      $user = $this->user_model->find($user_id);

      $data = array(
        'titulo'      => $this->input->post('titulo'),
        'subtitulo'   => $this->input->post('subtitulo'),
        'contenido'   => $this->input->post('contenido'),
        'autor'       => $user->username,
      );

      if ($this->post_model->insert($data)) {
        Template::set_message('Tu publicación se guardó correctamente.', 'success');
        redirect(SITE_AREA .'/content/blog');
      }
    }

    Template::set('toolbar_title', 'Crear publicación');
    Template::set_view('content/post_form');
    Template::render();
  }

  public function edit_post($id = null) {
    if ($this->input->post('submit')) {
      $user_id = $this->current_user->id;
      $user = $this->user_model->find($user_id);

      $data = array(
        'titulo'      => $this->input->post('titulo'),
        'subtitulo'   => $this->input->post('subtitulo'),
        'contenido'   => $this->input->post('contenido'),
        'autor'       => $user->username,
      );

      if ($this->post_model->update($id, $data)) {
        Template::set_message('Tu publicación se actualizó correctamente.', 'success');
        redirect(SITE_AREA .'/content/blog');
      }
    }

    Template::set('publicacion', $this->post_model->find($id));
    Template::set('toolbar_title', 'Editar publicación');
    Template::set_view('content/post_form');
    Template::render();
  }

  public function deletePosts($postIds) {
    // If no posts were selected, display an error message.
    if (empty($postIds) || ! is_array($postIds)) {
      Template::set_message('No ha seleccionado ningún registro para eliminar.', 'error');
      return false;
    }

    // Only allow users with the correct permission to delete posts
    $this->auth->restrict('Bonfire.Blog.Delete');

    // Track any failures while deleting the selected posts.
    $failed = 0;
    foreach ($postIds as $postId) {
      $result = $this->post_model->delete($postId);
      if (! $result) {
        ++$failed;
      }
    }

    $result = false;
    if ($failed) {
      Template::set_message("Hubo un problema al eliminar {$failed} publicacion(es): {$this->post_model->error}", 'error');
    } else {
      Template::set_message(count($postIds) . ' publicacion(es) eliminada(s)', 'success');
      $result = true;
    }

    // if any tickets were deleted, log the activity.
    if ((count($postIds) - $failed) > 0) {
      log_activity(
        $this->auth->user_id(),
        'eliminó ' . count($postIds) . ' publicacion(es) : ' . $this->input->ip_address(),
        'blog'
      );
    }

    return $result;
  }
}
