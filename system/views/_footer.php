
</div>

<div id="controls">
	<div id="photo_controls">
		<a href="#" id="loadprev">&laquo; prev</a>
    <a href="<?php echo $app->request()->getResourceUri() ?>/all/" id="loadall">Load All</a>
		<a href="#" id="loadnext">next &raquo;</a>
	</div>
</div>
<?php if( !isset( $text_page ) ): ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&v=3&language=&region=&libraries="></script>
<script type="text/javascript" src="/public/js/map.js"></script>
<?php endif; ?>
<!--<p id="queue"></p>-->
  <script type="text/javascript">

  <?php if( isset( $_SESSION['instagram_access_token'] ) ): ?>
  access_token = '<?php echo $_SESSION['instagram_access_token'] ?>';
  <?php endif; ?>

  <?php if( $page == 'location' ): ?>
  var lat = <?php echo $lat ?>;
  var lng = <?php echo $lng ?>;
  var distance = <?php echo $distance ?>;
  <?php endif; ?>

  <?php if( $page == 'search' ): ?>
  var location_search_distance_min = <?php echo INSTAGRAM_MIN_DISTANCE ?>;
  var location_search_distance_max = <?php echo INSTAGRAM_MAX_DISTANCE ?>;
  var location_search_distance_default = <?php echo INSTAGRAM_DEFAULT_DISTANCE ?>;
  <?php endif; ?>

  <?php if( $page == 'tag' ): ?>
  var tag = "<?php echo $tag ?>";
  <?php endif; ?>

  <?php if( strpos( $page, 'user' ) === 0 ): ?>
  var username = "<?php echo $username ?>";
  <?php endif; ?>

  </script>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="/public/js/libs/jquery-1.7.1.min.js"><\/script>')</script>
  <script src="/public/js/jquery-ui.js"></script>
  <script src="/public/js/lib/jquery-tmpl.js"></script>
  <script type="text/javascript" src="/public/js/lib/klass.js"></script>
  <script src="/public/js/GalleryLoaderAbstract.js"></script>
  <script src="/public/js/UserGalleryLoader.js"></script>
  <script src="/public/js/TagGalleryLoader.js"></script>
  <script src="/public/js/MediaSearchGalleryLoader.js"></script>
  <script type="text/javascript" src="/public/js/script.js"></script>
  <script src="/public/js/lightbox.js"></script>

</body>
</html>