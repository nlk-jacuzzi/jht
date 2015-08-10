<?php
/**
 * Template Name: Responsive Page Template
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

?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/responsive.css" type="text/css" media="all">
<style type="text/css">
.vc_responsive .wpb_row .vc_span12.column_container .wrap {
    width: 960px !important;
    margin: 0 auto !important;
    float: none !important;
}
</style>
    <div class="hero" style="height:72px;"></div>
	<div class="goldBar5"></div>
    <div class="bd">
        <div class="wrap">
        	<div class="innerwrap">
        		<?php the_content(); ?>
        	</div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="bd">
        <div class="wrap">
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
