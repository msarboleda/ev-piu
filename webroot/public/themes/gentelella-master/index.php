<?php
  echo theme_view('header_index');
  echo Template::message();
  echo isset($content) ? $content : Template::content();
  echo theme_view('footer_index');
?>
