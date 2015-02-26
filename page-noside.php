<?php
/**
 * Template Name: Page with No Left Column
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
                <div class="main">
					<?php the_content(); ?>
                </div>
            </div>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
