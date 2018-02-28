<div class="admin-box">
  <h3>Nueva publicación</h3>
  <?php echo form_open(current_url(), 'class="form-horizontal"'); ?>
    <fieldset>
      <div class="control-group<?php echo form_error('titulo') ? ' error' : ''; ?>">
        <label for="titulo">Título</label>
        <div class="controls">
          <input type="text" name="titulo" id="titulo" class="input-xxlarge" value="<?php echo isset($publicacion) ? $publicacion->titulo : set_value('titulo'); ?>" />
          <span class='help-inline'><?php echo form_error('titulo'); ?></span>
        </div>
      </div>

      <div class="control-group<?php echo form_error('subtitulo') ? ' error' : ''; ?>">
        <label for="subtitulo">Breve descripción</label>
        <div class="controls">
          <input type="text" name="subtitulo" id="subtitulo" class="input-xxlarge" value="<?php echo isset($publicacion) ? $publicacion->subtitulo : set_value('subtitulo'); ?>" />
          <span class='help-inline'><?php echo form_error('subtitulo'); ?></span>
        </div>
      </div>

      <div class="control-group<?php echo form_error('contenido') ? ' error' : ''; ?>">
        <label for="contenido">Contenido</label>
        <div class="controls">
          <span class="help-inline"><?php echo form_error('contenido'); ?></span>
          <textarea name="contenido" id="contenido" class="input-xxlarge" rows="4"><?php echo isset($publicacion) ? $publicacion->contenido : set_value('contenido'); ?></textarea>
        </div>
      </div>
    </fieldset>

    <fieldset class="form-actions">
      <input type="submit" name="submit" class="btn btn-primary" value="Guardar publicación" />
      <?php echo ' ' . lang('bf_or') . ' '; ?>
      <a href="<?php echo site_url(SITE_AREA . '/content/blog'); ?>">Cancelar</a>
    </fieldset>
    <?php echo form_close(); ?>
</div>
