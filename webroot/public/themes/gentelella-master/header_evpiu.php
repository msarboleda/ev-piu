<?php

$css_array = array(
  'vendors/bootstrap/dist/css/bootstrap.min.css',
  'vendors/font-awesome/css/font-awesome.min.css',
  'vendors/nprogress/nprogress.css',
  'vendors/iCheck/skins/flat/green.css',
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
  echo Assets::js('modernizr-2.5.3.js');
  ?>
  <?php echo Assets::css(); ?>
  <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">
</head>
<body class="nav-md footer_fixed">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="<?php site_url('dashboard'); ?>" class="site_title"><i class="fa fa-paw"></i> <span>EV PIU</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="images/user.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Bienvenido(a),</span>
              <h2><?php echo $user->display_name; ?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>General</h3>
              <ul class="nav side-menu">
                <li>
                  <a href="javascript:void(0)"><i class="fa fa-home"></i> Inicio</a>
                </li>
              </ul>
            </div>
          </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <!--<div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
              <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>-->
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="images/user.png" alt=""><?php echo $user->display_name; ?>
                  <span class="fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="javascript:void(0);"> Mi perfil</a></li>
                  <li><a href="<?php echo site_url('logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesión</a></li>
                </ul>
              </li>

              <!-- Notificaciones -->
              <!--<li role="presentation" class="dropdown">
                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-envelope-o"></i>
                  <span class="badge bg-green"></span>
                </a>
                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                  <li>
                    <a>
                      <span class="image"><img src="images/user.png" alt="Profile Image" /></span>
                      <span>
                        <span><?php // echo $user->display_name; ?></span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Message
                      </span>
                    </a>
                  </li>
                  <li>
                    <div class="text-center">
                      <a>
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                      </a>
                    </div>
                  </li>
                </ul>
              </li>-->
              <!-- Notificaciones -->
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">
