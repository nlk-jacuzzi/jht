<?php
/**
 * Template Name: Hydrotherapy
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

get_header();
if ( have_posts() ) while ( have_posts() ) : the_post();
the_content(); // hardcoded?
endwhile; // end of the loop.
get_footer(); ?>
