<?php
/**
 * Template Name: Prolink App
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

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
    <div class="hero prolink-hero">
    	<div class="wrap">
            <div class="col-left">
                <h1 class="title"><span class="gold">Jacuzzi&reg; Brand<br />Hot Tubs<br />Announces</span><br /><span class="white">the ProLink&trade; App</span></h1>
                <p><span class="white">Jacuzzi&reg; Hot Tubs debuts a new way for spa owners to combine smartphone technology with tech-savvy J-500&trade; Collection hot tubs: the ProLink&trade; app.</span></p>
                <a href="#thebuttonDoesWhat">
                    <?php echo do_shortcode('[video_lightbox_youtube video_id="qMxV5mTJlYU" width="640" height="480" anchor="' . get_template_directory_uri() . '/images/landing/button.png" autoplay="true"]'); ?>
                </a>
            </div>
            <div class="coll-right">
                <?php echo do_shortcode('[video_lightbox_youtube video_id="fiW-DfNAJzM" width="640" height="480" anchor="' . get_template_directory_uri() . '/images/landing/imag1.jpg" autoplay="true"]'); ?>
            </div>
<?php } ?>
        </div>
    </div>
    <div class="goldBar10"></div>
    <div class="bd">
    	<div class="wrap">
            <div class="oneCol prolink-content">
                <div class="main">
					<?php the_content(); ?>
                </div>
            </div>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
