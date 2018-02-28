<ul class="nav nav-pills">
  <li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
    <a href="<?php echo site_url(SITE_AREA .'/content/blog') ?>">Publicaciones</a>
  </li>
  <li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?>>
    <a href="<?php echo site_url(SITE_AREA .'/content/blog/create') ?>">Nueva publicación</a>
  </li>
</ul>
