<?php

$errorClass   = empty($errorClass) ? ' bad' : $errorClass;
$controlClass = empty($controlClass) ? '' : $controlClass;
$fieldData = array(
  'errorClass'    => $errorClass,
  'controlClass'  => $controlClass,
);

?>

<div>
  <a class="hiddenanchor" id="signup"></a>

  <div class="login_wrapper">
    <div id="register" class="form registration_form">
      <section class="login_content">
        <?php if (validation_errors()) : ?>
        <div class="alert alert-error fade in">
            <?php echo validation_errors(); ?>
        </div>
        <?php endif; ?>

        <div class="alert alert-info fade in">
          <h4 class="alert-heading"><?php echo lang('bf_required_note'); ?></h4>
          <?php
          if (isset($password_hints)) {
            echo $password_hints;
          }
          ?>
        </div>

        <?php echo form_open(site_url(REGISTER_URL), array('class' => 'form-horizontal form-label-left', 'autocomplete' => 'off')); ?>
        <h1><?php echo lang('us_sign_up'); ?></h1>

        <fieldset>
          <?php Template::block('users/user_fields', 'users/user_fields', $fieldData);
            // Allow modules to render custom fields. No payload is passed
            // since the user has not been created, yet.
            Events::trigger('render_user_form');
            // Start of User Meta -->
            Template::block('users/user_meta', 'users/user_meta', array('frontend_only' => true));
            // End of User Meta
          ?>
        </fieldset>

        <fieldset>
          <button class="btn btn-default submit" type="submit" name="register" id="submit"><?php echo lang('us_register'); ?></button>
        </fieldset>

        <div class="clearfix"></div>

        <div class="separator">
          <p class="change_link"><?php echo lang('us_already_registered'); ?>
            <a href="<?php echo LOGIN_URL; ?>" class="to_register"><?php echo lang('bf_action_login'); ?></a>
          </p>

          <div>
						<p>Gentelella Alela! is a Bootstrap 3 template.</p>
						<p>© CI Estrada Velasquez 1980 - <script>document.write(new Date().getFullYear());</script> </p>
						<p>Todos los derechos reservados. </p>
					</div>
        </div>
        <?php echo form_close(); ?>
      </section>
    </div>
  </div>
</div>

<?php
	$js_array = array(
		'vendors/iCheck/icheck.min.js',
		'vendors/select2/dist/js/select2.full.min.js'
	);

	echo Assets::add_js($js_array);
?>
