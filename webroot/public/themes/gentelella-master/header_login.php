<?php

$css_array = array(
  'vendors/bootstrap/dist/css/bootstrap.min.css',
  'vendors/font-awesome/css/font-awesome.min.css',
  'vendors/nprogress/nprogress.css',
  'vendors/iCheck/skins/flat/green.css',
  'vendors/select2/dist/css/select2.min.css',
  'build/css/custom.min.css'
);

$js_array = array(
  'vendors/jquery/dist/jquery.min.js',
  'vendors/bootstrap/dist/js/bootstrap.min.js',
  'vendors/fastclick/lib/fastclick.js',
  'vendors/nprogress/nprogress.js',
  'build/js/custom.min.js',
);


Assets::add_css($css_array);
Assets::add_js($js_array);

$inline  = '$(".dropdown-toggle").dropdown();';
$inline .= '$(".tooltips").tooltip();';
Assets::add_js($inline, 'inline');

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title><?php
        echo isset($page_title) ? "{$page_title} : " : '';
        e(class_exists('Settings_lib') ? settings_item('site.title') : 'EV PIU');
  ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php e(isset($meta_description) ? $meta_description : ''); ?>">
  <meta name="author" content="<?php e(isset($meta_author) ? $meta_author : ''); ?>">
  <?php
  /* Modernizr is loaded before CSS so CSS can utilize its features */
  ?>
  <?php echo Assets::css(); ?>
  <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">
</head>
<body class="login">
