<?php
/*
 * Template Name: Warranty Registration
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

get_header();
if ( have_posts() ) while ( have_posts() ) : the_post();
$custom = get_post_meta($post->ID,'jht_pageopts');
$pageopts = $custom[0];

?>
    <div class="hero">
        <div class="wrap">
            <div class="inner">
                <h1><span class="gold">WARRANTY REGISTRATION</span></h1>
                <p>Registering your hot tub will expedite communications with Jacuzzi Hot Tubs and will enable us to send you important updates and special offers.</p>
            </div>
            <div class="sign-up ">
                <div style="position: absolute;"><p>Get Jacuzzi Genuine Parts,  Accessories, and Water Care</p></div>
                <div style="position: absolute; right: 0; top: -25px;">
                    <a href="/hot-tubs/dealer-locator/owners/" class="owners-corner-link dealer"><img src="/hot-tubs/wp-content/uploads/2014/10/locate-dealer-btn.png" /></a>
                    <img src="/hot-tubs/wp-content/uploads/2014/10/for-owners-prod.png" />
                </div>
            </div>
        </div>
    </div>
    <div class="goldBar10"></div>
    <div class="bd">
    	<div class="wrap warranty">
            <div class="twoCol">
                <div class="side">
                	<?php
					if ( isset($pageopts['menu']) ) {
						$mid = absint($pageopts['menu']);
						if ( $mid > 0 ) {
							wp_nav_menu(array('menu'=>$mid));
						}
					}
                    //wp_nav_menu(array('theme_location'=>'trademark'));
                    //if ( isset($pageopts['b']) ) if ( $pageopts['b'] == 'Yes' ) get_sidebar('freeBrochure');
                    //if ( isset($pageopts['q']) ) if ( $pageopts['q'] == 'Yes' ) get_sidebar('requestQuote');
                    //if ( isset($pageopts['t']) ) if ( $pageopts['t'] == 'Yes' ) get_sidebar('tradeIn');
                    //if ( isset($pageopts['n']) ) if ( $pageopts['n'] == 'Yes' ) get_sidebar('contactNumber');
                    get_sidebar('pageoptions');
					?>
                </div>
                <div class="main">
					<?php
if ( function_exists('jhtpolylangfix_contentcheck') ) {
	jhtpolylangfix_contentcheck();
} else {
	the_content(); // hardcoded?
} ?>
                </div>
            </div>
            <div class="splitrow4">
            	<div class="manuals active">
            		<h3>Warranty and Manuals</h3>
            		<p><a href="/hot-tubs/warranty-registration/"><img src="/hot-tubs/wp-content/themes/jht/images/ownerscorner/circ-arrow.png" alt="" width="20" height="20" /></a>Essential information for owners</p>
            	</div>
				<div class="watermaint">
					<h3>Water Maintenance</h3>
					<p><a href="/hot-tubs/owners-corner/water-maintenance/"><img src="/hot-tubs/wp-content/themes/jht/images/ownerscorner/circ-arrow.png" alt="" width="20" height="20" /></a>Keep your water sparkling with genuine Jacuzzi parts!</p>
				</div>
				<div class="htaccessories">
					<h3>Hot Tub Parts</h3>
					<p><a href="/hot-tubs/owners-corner/hot-tub-parts/"><img src="/hot-tubs/wp-content/themes/jht/images/ownerscorner/circ-arrow.png" alt="" width="20" height="20" /></a>Maintain your hot tub with genuine Jacuzzi® parts</p>
				</div>
				<div class="htmaint active">
					<h3>Hot Tub Maintenance</h3>
					<p><a href="/hot-tubs/owners-corner/hot-tub-maintenance/"><img src="/hot-tubs/wp-content/themes/jht/images/ownerscorner/circ-arrow.png" alt="" width="20" height="20" /></a>Efficient Maintenance for Optimal Performance</p>
				</div>
			</div>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
