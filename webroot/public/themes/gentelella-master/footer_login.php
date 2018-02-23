  <?php if ( ! isset($show) || $show == true) : ?>
  <?php endif; ?>
  <div id="debug"><!-- Stores the Profiler Results --></div>
  <?php
    $js_array = array(
      'vendors/jquery/dist/jquery.min.js',
      'vendors/bootstrap/dist/js/bootstrap.min.js',
      'vendors/fastclick/lib/fastclick.js',
      'vendors/nprogress/nprogress.js',
      'build/js/custom.min.js',
    );

    Assets::add_js($js_array);
    echo Assets::js();
  ?>
</body>
</html>
