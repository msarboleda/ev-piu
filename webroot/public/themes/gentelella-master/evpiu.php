<?php
  echo theme_view('header_evpiu');
  echo Template::message();
  echo isset($content) ? $content : Template::content();
  echo theme_view('footer_evpiu');
