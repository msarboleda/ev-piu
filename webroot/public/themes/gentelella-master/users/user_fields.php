<?php /* /users/views/user_fields.php */

  $currentMethod = $this->router->method;

  $errorClass     = empty($errorClass) ? ' error' : $errorClass;
  $controlClass   = empty($controlClass) ? 'span4' : $controlClass;
  $registerClass  = $currentMethod == 'register' ? ' required' : '';
  $editSettings   = $currentMethod == 'edit';

  $defaultLanguage = isset($user->language) ? $user->language : strtolower(settings_item('language'));
  $defaultTimezone = isset($user->timezone) ? $user->timezone : strtoupper(settings_item('site.default_user_timezone'));

?>

<div class="form-group <?php echo form_error('email') ? $errorClass : ''; ?>">
  <label for="email"><?php echo lang('bf_email'); ?></label>
  <input type="text" id="email" class="form-control <?php echo $controlClass; ?>" name="email" value="<?php echo set_value('email', isset($user) ? $user->email : ''); ?>" />
  <span class="help-inline"><?php echo form_error('email'); ?></span>
</div>

<div class="form-group <?php echo form_error('display_name') ? $errorClass : ''; ?>">
  <label for="display_name"><?php echo lang('bf_display_name'); ?></label>
  <input type="text" id="display_name" class="form-control <?php echo $controlClass; ?>" name="display_name" value="<?php echo set_value('display_name', isset($user) ? $user->display_name : ''); ?>" />
  <span class="help-inline"><?php echo form_error('display_name'); ?></span>
</div>

<?php if (settings_item('auth.login_type') !== 'email' || settings_item('auth.use_usernames')) : ?>
<div class="form-group <?php echo form_error('username') ? $errorClass : ''; ?>">
  <label for="username"><?php echo lang('bf_username'); ?></label>
  <input type="text" id="username" class="form-control <?php echo $controlClass; ?>" name="username" value="<?php echo set_value('username', isset($user) ? $user->username : ''); ?>" />
  <span class="help-inline"><?php echo form_error('username'); ?></span>
</div>
<?php endif; ?>

<div class="form-group <?php echo form_error('password') ? $errorClass : ''; ?>">
  <label class="<?php echo $registerClass; ?>" for="password"><?php echo lang('bf_password'); ?></label>
  <input type="password" id="password" class="form-control <?php echo $controlClass; ?>" name="password" value="" />
  <span class="help-inline"><?php echo form_error('password'); ?></span>
  <p class="help-block"><?php echo isset($password_hints) ? $password_hints : ''; ?></p>
</div>

<div class="form-group <?php echo form_error('pass_confirm') ? $errorClass : ''; ?>">
  <label class="<?php echo $registerClass; ?>" for="pass_confirm"><?php echo lang('bf_password_confirm'); ?></label>
  <input type="password" id="pass_confirm" class="form-control <?php echo $controlClass; ?>" name="pass_confirm" value="" />
  <span class="help-inline"><?php echo form_error('pass_confirm'); ?></span>
</div>

<?php if ($editSettings) : ?>
<div class="form-group <?php echo form_error('force_password_reset') ? $errorClass : ''; ?>">
  <label class="checkbox" for="force_password_reset">
    <input type="checkbox" id="force_password_reset" name="force_password_reset" value="1" <?php echo set_checkbox('force_password_reset', empty($user->force_password_reset)); ?> />
    <?php echo lang('us_force_password_reset'); ?>
  </label>
</div>

<?php
endif;

if (! empty($languages) && is_array($languages)) :
  if (count($languages) == 1) :
?>

<input type="hidden" id="language" name="language" value="<?php echo $languages[0]; ?>" />
<?php
  else :
?>

<div class="form-group <?php echo form_error('language') ? $errorClass : ''; ?>">
  <label for="language"><?php echo lang('bf_language'); ?></label>
  <select name="language" id="language" class="form-control">
    <?php foreach ($languages as $language) : ?>
    <option value="<?php e($language); ?>" <?php echo set_select('language', $language, $defaultLanguage == $language); ?>>
      <?php e(ucfirst($language)); ?>
    </option>
    <?php endforeach; ?>
  </select>
  <span class="help-inline"><?php echo form_error('language'); ?></span>
</div>

<?php
  endif;
endif;
?>

<div class="form-group <?php echo form_error('timezones') ? $errorClass : ''; ?>">
  <label for="timezones"><?php echo lang('bf_timezone'); ?></label>
  <?php
  echo timezone_menu(
    set_value('timezones', isset($user) ? $user->timezone : $defaultTimezone),
    "form-control",
    'timezones',
    array('id' => 'timezones')
  );
  ?>
  <span class="help-inline"><?php echo form_error('timezones'); ?></span>
</div>
