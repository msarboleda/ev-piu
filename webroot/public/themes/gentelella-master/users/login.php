<?php
	$site_open = $this->settings_lib->item('auth.allow_register');
?>

<div>
  <a class="hiddenanchor" id="signin"></a>

  <div class="login_wrapper">
    <div class="form login_form">
      <section class="login_content">
        <?php echo form_open(LOGIN_URL, array('autocomplete' => 'off')); ?>
          <h1><?php echo lang('us_login'); ?></h1>

					<?php if (validation_errors()) : ?>
					<div class="row-fluid">
						<div class="span12">
							<div class="alert alert-error alert-dismissible fade in">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
								<?php echo validation_errors(); ?>
							</div>
						</div>
					</div>
					<?php endif; ?>

          <div class="form-group <?php echo iif( form_error('login') , 'error') ;?>">
            <input type="text" class="form-control" name="login" id="login_value" value="<?php echo set_value('login'); ?>" tabindex="1" placeholder="<?php echo $this->settings_lib->item('auth.login_type') == 'both' ? lang('bf_username') .'/'. lang('bf_email') : ucwords($this->settings_lib->item('auth.login_type')) ?>" />
          </div>
          <div class="form-group <?php echo iif( form_error('password') , 'error') ;?>">
            <input type="password" class="form-control" name="password" id="password" value="" tabindex="2" placeholder="<?php echo lang('bf_password'); ?>" />
          </div>
					<?php if ($this->settings_lib->item('auth.allow_remember')) : ?>
					<div class="form-group">
						<div class="checkbox">
	            <label for="remember_me">
	              <input type="checkbox" class="flat" name="remember_me" id="remember_me" value="1" tabindex="3" />
								<span class="inline-help"><?php echo lang('us_remember_note'); ?></span>
	            </label>
	          </div>
					</div>
					<?php endif; ?>

          <div class="form-group">
            <button type="submit" name="log-me-in" id="submit" class="btn btn-default" tabindex="5"><?php e(lang('us_let_me_in')); ?></button>
            <a class="reset_pass" href="forgot_password"><?php echo lang('us_forgot_your_password'); ?></a>
          </div>

          <div class="clearfix"></div>

          <div class="separator">
						<?php if ( $site_open ) : ?>
            <p class="change_link">¿Aún no tienes una cuenta?
              <a href="<?php echo REGISTER_URL; ?>" class="to_register"><?php echo lang('us_sign_up'); ?></a>
            </p>
						<p><a href="<?php echo site_url(); ?>"><?php echo lang('us_back_to') . $this->settings_lib->item('site.title'); ?></a></p>
						<?php endif; ?>

						<div>
							<p>Gentelella Alela! is a Bootstrap 3 template.</p>
							<p>Copyright &copy; CI Estrada Velasquez 1980 - <script>document.write(new Date().getFullYear());</script></p>
							<p>Todos los derechos reservados.</p>
						</div>
        	</div>
      	<?php echo form_close(); ?>
      </section>

			<div class="x_content">
				<div class="alert alert-info alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
					</button>
					<?php // show for Email Activation (1) only
						if ($this->settings_lib->item('auth.user_activation_method') == 1) : ?>
						<!-- Activation Block -->
							<p><?php echo lang('bf_login_activate_title'); ?></p>
							<p><?php
								$activate_str = str_replace('[ACCOUNT_ACTIVATE_URL]',anchor('/activate', lang('bf_activate')),lang('bf_login_activate_email'));
								$activate_str = str_replace('[ACTIVATE_RESEND_URL]',anchor('/resend_activation', lang('bf_activate_resend')),$activate_str);
								echo $activate_str; ?>
							</p>
					<?php endif; ?>
				</div>
			</div>
    </div>
  </div>

<?php
	$js_array = array(
		'vendors/iCheck/icheck.min.js',
		'vendors/select2/dist/js/select2.full.min.js',
	);

	Assets::add_js($js_array);
?>
