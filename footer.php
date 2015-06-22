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

$ppccustom = get_post_meta($post->ID,'jht_newppc_options');
$ppcopts = isset($ppccustom[0]) ? $ppccustom[0] : '';

$menucustom = get_post_meta($post->ID,'jht_menuoption');
$menuopts = isset($menucustom[0]) ? $menucustom[0] : '';

wp_reset_query();

// IF not front page and not Backyard Designer -> CTA buttons at bottom
if ( !is_front_page() && !jht_is_backyard() && !jht_is_convpage() && !jht_is_tub() ) {
    get_sidebar('bottomBlocksCTA');
}
// ELSE IF backyard designer -> non-CTA bottom blocks
else if ( jht_is_backyard() ) {
    get_sidebar('bottomBlocks');
}
else {} ?>
        </div><!-- /wrap -->
        <div class="clear"></div>
    </div><!-- /bd -->
    <?php if ( jht_is_tub() ) {
        get_template_part('block', 'cta_forms');
    } ?>

    <?php /* Top Navigation Items */ ?>
    <div class="hd">
    	<div class="wrap">
        	<a href="<?php echo jht_homeurl_tfix(); ?>" class="logo">Jacuzzi</a>
            <?php
            // top black navigation bar
            if ( !isset($menuopts['top']) || $menuopts['top'] !== 'No' ) {
                get_sidebar('topNav');
            }
            // main navigation flop menu
            if ( !isset($menuopts['main']) || $menuopts['main'] !== 'No' ) {
    			get_sidebar('mainNav');
            }
            else {
                // top keyword header in place of menu
                print '<div id="ppc-headline">';
                if (isset($ppcopts['headline'])) { echo $ppcopts['headline']; }
                else { echo "&nbsp;"; }
                print '</div>';
            }
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

    <?php if ( !jht_is_tub() ) { ?>

    <?php /* Bottom black nav bar */ ?>
    <?php if ( !isset($menuopts['black']) || $menuopts['black'] !== 'No' ) { ?>
        <div id="fbar">
            <div class="inside">
                <a href="#" class="prar"></a>
                <?php dynamic_sidebar('fbar-promo'); ?>
                <div class="loc">
                    <form name="countryZipForm" method="post" action="<?php echo trailingslashit(get_bloginfo('url')) ?>dealer-locator/cities/">
                        <input type="hidden" value="1" name="zipcodeSearch" />
                        <input type="hidden" value="1" name="data[Dealer][country_id]" />
                        <a href="<?php bloginfo('url'); ?>/dealer-locator/">Locate a Dealer</a>
                        <input type="text" class="text zip" value="Zip" onfocus="if(jQuery(this).val() == 'Zip') jQuery(this).val('')" onblur="if(jQuery(this).val() == '') jQuery(this).val('Zip')" name="zip" />
                        <input type="image" value="submit" src="<?php bloginfo('template_url') ?>/images/icons/topsub.png" class="sub" />
                    </form>
                </div>
                <a href="<?php bloginfo('url'); ?>/hot-tubs/" class="bbtn">Explore Models</a>
                <a href="<?php echo get_permalink(3743) ?>" class="bbtn">Get a Quote</a>
                <a href="<?php echo get_permalink(3745) ?>" class="bbtn">Free Brochure</a>
                <?php jht_socialmenu(); ?>
                <div class="sites">
                    <a href="<?php echo jht_rooturl(); ?>" class="bbtn" target="_blank">Jacuzzi Websites</a>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php } ?>

    <script type="text/javascript">
      (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/plusone.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
      })();
    </script>

    <?php get_template_part('modal', 'popup'); ?>

    <?php google_tag_manager(); ?>

    <?php

	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
<?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
<?php if ( ! is_plugin_active('live-chat/live-chat.php') ) { ?>
    <div id="live_chat_status" style=""></div>
    <script type='text/javascript' src='http://greeterware.com/Dashboard/cwgen/scripts/library.js?ver=1.0'></script>
    <script type='text/javascript' src='http://greeterware.com/Dashboard/cwgen/Company/LiveAdmins/jacuzzi.com/gvars.js?ver=1.0'></script>
    <script type='text/javascript' src='http://greeterware.com/Dashboard/cwgen/Company/LiveAdmins/jacuzzi.com/chatwindow.js?ver=1.0'></script>
    <script type='text/javascript' defer="defer" src='http://greeterware.com/Dashboard/cwgen/scripts/chatscriptyui.js?ver=1.0'></script>
<?php } ?>
</body>
</html>
