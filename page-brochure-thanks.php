<?php
/**
 * Template Name: Brochure-Thanks
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

$ebRand = rand(0,1000000);
wp_enqueue_script('burstingpipe', 'http://bs.serving-sys.com/BurstingPipe/ActivityServer.bs?cn=as&amp;ActivityID=193857&amp;rnd=' . $ebRand );

get_header();
if ( have_posts() ) while ( have_posts() ) : the_post();
$custom = get_post_meta($post->ID,'jht_pageopts');
$pageopts = $custom[0];
$titleoverride = false;
if ( isset($pageopts['o']) ) if ( $pageopts['o'] != '' ) $titleoverride = $pageopts['o'];

if ( has_post_thumbnail() ) {
	$landing_img = '';
	$img_id = get_post_meta( $post->ID, '_thumbnail_id', true );
	if ( $img_id ) {
		$img = get_post($img_id);
		$landing_img = "background-image: url('". $img->guid ."')";
	}
	?>
    <div class="hero" style="<?php echo $landing_img ?>">
    	<div class="wrap">
        	<div class="inner">
            	<h1 style="line-height:48px"><?php if ( $titleoverride ) { echo $titleoverride; } else { the_title(); } ?></h1>
            </div>
<?php } else { ?>
    <div class="hero">
    	<div class="wrap">
            <h1 class="title"><?php if ( $titleoverride ) { esc_attr_e(wp_kses($titleoverride, array())); } else { the_title(); } ?></h1>
<?php } ?>
        </div>
    </div>
    <div class="goldBar10"></div>
    <div class="bd">
    	<div class="wrap">
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
					<?php the_content(); ?>
                </div>
            </div>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
