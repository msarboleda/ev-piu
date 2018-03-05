<?php

$errorClass   = empty($errorClass) ? 'bad' : $errorClass;
$controlClass = empty($controlClass) ? '' : $controlClass;
$fieldData = array(
  'errorClass'   => $errorClass,
  'controlClass' => $controlClass,
);

if (isset($password_hints)) {
  $fieldData['password_hints'] = $password_hints;
}

// In order for $renderPayload to be set properly, the order of the isset() checks
// for $current_user, $user, and $this->auth should be maintained. An if/elseif
// structure could be used for $renderPayload, but the separate if statements would
// still be needed to set $fieldData properly.
$renderPayload = null;
if (isset($current_user)) {
  $fieldData['current_user'] = $current_user;
  $renderPayload = $current_user;
}
if (isset($user)) {
  $fieldData['user'] = $user;
  $renderPayload = $user;
}
if (empty($renderPayload) && isset($this->auth)) {
  $renderPayload = $this->auth->user();
}

?>

<div>
  <div class="clearfix"></div>

  <?php if (validation_errors()) : ?>
  <div class="alert alert-error">
    <?php echo validation_errors(); ?>
  </div>
  <?php
  endif;
  if (isset($user) && $user->role_name == 'Banned') :
  ?>
  <div data-dismiss="alert" class="alert alert-error">
    <?php echo lang('us_banned_admin_note'); ?>
  </div>
  <?php endif; ?>
  <div class="alert alert-info">
    <h4 class="alert-heading"><?php echo lang('bf_required_note'); ?></h4>
    <?php
    if (isset($password_hints)) {
      echo $password_hints;
    }
    ?>
  </div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2><?php echo lang('us_edit_profile'); ?></h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
            <div class="profile_img">
              <div id="crop-avatar">
                <!-- Current avatar -->
                <img class="img-responsive avatar-view" src="<?php echo Assets::assets_url('image').'user.png'; ?>" alt="Avatar" title="Change the avatar">
              </div>
            </div>
            <h3><?php echo $current_user->display_name; ?></h3>

            <ul class="list-unstyled user_data">
              <li>
                <i class="fa fa-briefcase user-profile-icon"></i> <?php echo $current_user->role_name; ?>
              </li>
            </ul>
            <br />
          </div>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="span12">
                <?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal', 'autocomplete' => 'off')); ?>
                    <fieldset>
                        <?php Template::block('users/profile_user_fields', 'users/profile_user_fields', $fieldData); ?>
                    </fieldset>
                    <fieldset>
                        <?php
                        // Allow modules to render custom fields
                        Events::trigger('render_user_form', $renderPayload);
                        ?>
                        <!-- Start User Meta -->
                        <?php //Template::block('users/profile_user_meta', 'users/profile_user_meta', array('frontend_only' => true)); ?>
                        <!-- End of User Meta -->
                    </fieldset>
                    <fieldset class="form-actions">
                        <input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('bf_action_save') . ' ' . lang('bf_user'); ?>" />
                        <?php echo lang('bf_or') . ' ' . anchor('/', lang('bf_action_cancel')); ?>
                    </fieldset>
                <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
