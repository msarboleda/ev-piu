<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title><?php echo isset($page_title) ? "{$page_title} : " : ''; e(class_exists('Settings_lib') ? settings_item('site.title') : 'EV PIU');?></title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo site_url('themes/clean-blog/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="<?php echo site_url('themes/clean-blog/vendor/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="<?php echo site_url('themes/clean-blog/css/clean-blog.min.css'); ?>" rel="stylesheet">

  <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">
</head>
<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="<?php echo site_url(); ?>">EV PIU</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fa fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url(); ?>">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0);">Nosotros</a>
          </li>
        <?php if (isset($current_user->email) && $current_user->role_id === 1) { ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url(SITE_AREA); ?>">Administrar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('logout'); ?>"><i class="fa fa-sign-out"></i> Cerrar Sesion</a>
          </li>
          <li class="nav-item">
            <a href="<?php echo site_url(EVPIU_AREA); ?>"><button class="btn btn-default" type="button">Tablero de Trabajo</button></a>
          </li>
        </ul>
        <?php } else if (isset($current_user->email) && $current_user->role_id !== 1) { ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('logout'); ?>"><i class="fa fa-sign-out"></i> Cerrar Sesion</a>
          </li>
          <li class="nav-item">
            <a href="<?php echo site_url(EVPIU_AREA); ?>"><button class="btn btn-default" type="button">Tablero de Trabajo</button></a>
          </li>
        </ul>
        <?php } else { ?>
          <li class="nav-item">
            <a href="<?php echo site_url(LOGIN_URL); ?>"><button class="btn btn-default" type="button"><?php echo lang('bf_action_login'); ?></button></a>
          </li>
        </ul>
        <?php } ?>
      </div>
    </div>
  </nav>
