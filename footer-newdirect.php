<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * NOTE : ALSO MAKE SURE ALL TRACKING PIXELS ARE ON FOOTER-MOBILE.PHP
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */
 ?>
    <div class="hd">
    	<div class="wrap">
        	<a href="<?php bloginfo('url'); ?>" class="logo">Jacuzzi</a>
            <div class="tag">The World's Most Recognized Brand of Hot Tubs and Spas</div>
        </div>
    </div>
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

    <?php google_tag_manager(); ?>

    <?php

	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

</body>
</html>
