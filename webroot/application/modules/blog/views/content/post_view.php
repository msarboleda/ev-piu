<!-- Page Header -->
<header class="masthead" style="<?php echo 'background-image: url('."'".site_url('themes/clean-blog/img/post-bg.jpg')."'".');'; ?>">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="post-heading">
          <h1><?php e($publicacion->titulo); ?></h1>
          <h2 class="subheading"><?php e($publicacion->subtitulo); ?></h2>
          <span class="meta">Escrito por
            <a href="#"><?php e($publicacion->autor); ?></a>
            en <?php e(strftime(date('F j, Y', strtotime($publicacion->created_on)))); ?></span>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Post Content -->
<article>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <p><?php e($publicacion->contenido); ?>
      </div>
    </div>
  </div>
</article>

<hr>
