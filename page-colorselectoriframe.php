<?php
/**
 * Template Name: Iframe Color Selector
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

get_header('blank');

if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <div class="bd color-selector-landing">
        <div class="wrap">
            <h1 class="title"><?php the_title(); ?></h1>
            <h2 class="sub-title">Use the color palette to the right to pick out your shell and cabinet color.</h2>
        </div>

        <?php get_template_part('block', 'color_selector_blank'); ?>
        <?php //get_template_part('block', 'cta_forms'); ?>

        <div class="wrap">
            <div class="oneCol">
                <div class="main">
                    <?php the_content(); ?>
                </div>
            </div>

<?php endwhile; // end of the loop. ?>

<?php get_footer('blank'); ?>