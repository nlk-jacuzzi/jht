<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

global $post;

wp_reset_query();
?>
        
    <?php /* Top Navigation Items */ ?>
    <div class="hd">
    	<div class="wrap">
        	<a href="<?php echo jht_homeurl_tfix(); ?>" class="logo">Jacuzzi</a>
            <?php
            	get_sidebar('topNav');
				get_sidebar('mainNav101');
            ?>
        </div>
    </div>

    <?php /* Footer navigation / water mark / social icons */ ?>
    <?php if ( !isset($menuopts['foot']) || $menuopts['foot'] !== 'No' ) { ?>
	    <div class="wrap">
	        <div class="ft">
	        	<span class="icon watermark"></span>
	            <?php jht_socialmenu(true);
	    		wp_nav_menu( array( 'container' => 'false', 'menu_class' => 'footerMenuTop', 'theme_location' => 'ftline1' ) );
	    		wp_nav_menu( array( 'container' => 'false', 'menu_class' => 'footerMenuBottom', 'theme_location' => 'ftline2' ) );
	    		wp_nav_menu( array( 'container' => 'false', 'menu_class' => 'footerMenuBottom', 'menu_id' => 'resourceMenu', 'theme_location' => 'ftres' ) );
	            ?>
	        </div>
	    </div>
    <?php } ?>

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
<?php /* include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
<?php if ( ! is_plugin_active('live-chat/live-chat.php') ) { ?>
    <div id="live_chat_status" style=""></div>
    <script type='text/javascript' src='http://greeterware.com/Dashboard/cwgen/scripts/library.js?ver=1.0'></script>
    <script type='text/javascript' src='http://greeterware.com/Dashboard/cwgen/Company/LiveAdmins/jacuzzi.com/gvars.js?ver=1.0'></script>
    <script type='text/javascript' src='http://greeterware.com/Dashboard/cwgen/Company/LiveAdmins/jacuzzi.com/chatwindow.js?ver=1.0'></script>
    <script type='text/javascript' defer="defer" src='http://greeterware.com/Dashboard/cwgen/scripts/chatscriptyui.js?ver=1.0'></script>
<?php } */ ?>
</body>
</html>
