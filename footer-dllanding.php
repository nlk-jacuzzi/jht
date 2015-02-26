<?php
/**
 * Template for displaying the footer on /dealer-locator/ landing page
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 2.012
 */
 
get_sidebar('bottomBlocks');
?>
        </div><!-- /wrap -->
    </div><!-- /bd -->
    <div class="hd">
    	<div class="wrap">
        	<a href="<?php bloginfo('url'); ?>" class="logo">Jacuzzi</a>
            <?php
			get_sidebar('topNav');
			get_sidebar('mainNav');
			?>
        </div>
    </div>
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
    <div id="fbar"><div class="inside"><a href="#" class="prar"></a>
    <?php dynamic_sidebar('fbar-promo'); ?>
    <div class="loc"><form name="countryZipForm" method="post" action="<?php echo trailingslashit(get_bloginfo('url')) ?>dealer-locator/cities/"><input type="hidden" value="1" name="zipcodeSearch" /><input type="hidden" value="1" name="data[Dealer][country_id]" />
                    <a href="<?php bloginfo('url'); ?>/dealer-locator/">Locate a Dealer</a>
                    <input type="text" class="text zip" value="Zip" onfocus="if(jQuery(this).val() == 'Zip') jQuery(this).val('')" onblur="if(jQuery(this).val() == '') jQuery(this).val('Zip')" name="zip" />
                    <input type="image" value="submit" src="<?php bloginfo('template_url') ?>/images/icons/topsub.png" class="sub" />
                    </form></div>
    <a href="<?php bloginfo('url'); ?>/hot-tubs/" class="bbtn">Explore Tubs</a>
    <a href="<?php echo get_permalink(3743) ?>" class="bbtn">Get a Quote</a>
    <a href="<?php echo get_permalink(3745) ?>" class="bbtn">Free Brochure</a>
    <?php jht_socialmenu(); ?>
    <div class="sites"><a href="http://www.jacuzzi.com/" class="bbtn" target="_blank">Jacuzzi Websites</a></div>
    </div></div>

    <?php get_template_part('modal', 'popup'); ?>

    
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

    <?php //google_tag_manager(); // No! This is loaded in dealer locator files... ?>

    <?php

	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

</body>
</html>