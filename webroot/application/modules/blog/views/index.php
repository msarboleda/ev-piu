<!-- Page Header -->
<header class="masthead" style="<?php echo 'background-image: url('."'".site_url('themes/clean-blog/img/home-bg.jpg')."'".');'; ?>">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading">
          <h1>EV PIU</h1>
          <span class="subheading">Plataforma de Información Unificada para Estrada Velasquez</span>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Main Content -->
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      <?php
      if (! empty($publicaciones) && is_array($publicaciones)) :
        foreach ($publicaciones as $publicacion) :
      ?>
      <div class="post-preview">
        <a href="<?php echo site_url("home/post/{$publicacion->publ_id}"); ?>">
          <h2 class="post-title">
            <?php e($publicacion->titulo); ?>
          </h2>
          <h3 class="post-subtitle">
            <?php echo auto_typography($publicacion->subtitulo); ?>
          </h3>
        </a>
        <p class="post-meta">Escrito por
        <a href="#"><?php e($publicacion->autor); ?></a>
        en <?php e(strftime(date('F j, Y', strtotime($publicacion->created_on)))); ?></p>
      </div>
      <hr>
      <?php
        endforeach;
      else :
      ?>
      <div class="alert alert-info">
        No se encontraron publicaciones activas.
      </div>
      <?php
      endif;
      ?>

      <!-- Pager -->
      <div class="clearfix">
        <a class="btn btn-primary float-right" href="#">Publicaciones Antiguas &rarr;</a>
      </div>
    </div>
  </div>
</div>

<hr>
