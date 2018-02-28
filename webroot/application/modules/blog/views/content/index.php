<div class="admin-box">
  <h3>Publicaciones</h3>

  <?php
  if (empty($publicaciones) || ! is_array($publicaciones)) :
  ?>
  <div class="alert alert-warning">
    No se encontraron publicaciones activas.
  </div>
  <?php
  else :
    $numColumns = 3;
    $canDelete = $this->auth->has_permission('Bonfire.Blog.Delete');

    if ($canDelete) {
      ++$numColumns;
    }
    echo form_open();
  ?>
  <table class="table table-striped">
    <thead>
      <tr>
        <?php if ($canDelete) : ?>
        <th class="column-check"><input class="check-all" type="checkbox" /></th>
        <?php endif; ?>
        <th>Título</th>
        <th>Autor</th>
        <th>Fecha de Publicación</th>
      </tr>
    </thead>
    <?php if ($canDelete) : ?>
    <tfoot>
      <tr>
        <td colspan="<?php echo $numColumns; ?>">
          <?php echo lang('bf_with_selected') . ' '; ?>
          <input type="submit" name="delete" class="btn" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('¿Seguro que quieres eliminar estas publicaciones?')" />
        </td>
      </tr>
    </tfoot>
    <?php endif; ?>
    <tbody>
      <?php foreach ($publicaciones as $publicacion) : ?>
      <tr>
        <?php if ($canDelete) : ?>
        <td><input type="checkbox" name="checked[]" value="<?php echo $publicacion->publ_id; ?>" /></td>
        <?php endif; ?>
        <td>
          <a href="<?php echo site_url(SITE_AREA . "/content/blog/edit_post/{$publicacion->publ_id}"); ?>">
            <?php e($publicacion->titulo); ?>
          </a>
        </td>
        <td>
          <?php echo $publicacion->autor; ?>
        </td>
        <td>
          <?php e(strftime(date('F j, Y', strtotime($publicacion->created_on)))); ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php
    echo form_close();
  endif;
  ?>
</div>
