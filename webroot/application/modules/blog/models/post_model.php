<?php defined('BASEPATH') || exit('No direct script access allowed');

class Post_model extends MY_Model {
  protected $table_name   = 'Publicaciones';
  protected $key          = 'publ_id';
  protected $set_created  = true;
  protected $set_modified = true;
  protected $soft_deletes = true;
  protected $date_format  = 'datetime';
  protected $db_con = 'EVPIU';

  protected $validation_rules = array(
    array(
      'field' => 'titulo',
      'label' => 'titulo',
      'rules' => 'trim|strip_tags'
    ),
    array(
      'field' => 'subtitulo',
      'label' => 'subtitulo',
      'rules' => 'trim|strip_tags'
    ),
    array(
      'field' => 'contenido',
      'label' => 'contenido',
      'rules' => 'trim|strip_tags'
    )
  );

  protected $insert_validation_rules = array(
    'titulo' => 'required',
    'subtitulo'  => 'required',
    'contenido' => 'required',
  );

  public function __construct() {
    parent::__construct();

    $this->output->enable_profiler(FALSE);

    $ci =& get_instance();
    $ci->EVPIU = $this->load->database($this->db_con, TRUE);
  }
}
