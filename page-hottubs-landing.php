<?php
/**
 * Template Name: Hot Tubs Landing
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */
define('DONOTCACHEPAGE', true);

avala_form_submit();

get_header(); ?>

    <?php
    /**
     *  Attention Russell:
     *
     *  The home page hero slides/section has been moved.
     *
     *  The file containing all home page hero stuff is now called "block-home_hero.php"
     **/
    ?>

    <div class="hero"></div>

    <div id="block-title-tubs-landing" class="block">
        <div class="container">
            <h1>Find the Perfect <strong>Hot Tub</strong></h1>
            <a href="<?php bloginfo('url'); ?>/hot-tub-wizard/">Help Me Find the Right Model</a>
        </div>
    </div>

    <!--div class="goldBar5"></div-->

    <?php get_template_part('block', 'browse_by_size'); ?>

    <?php get_template_part('block', 'browse_by_collection'); ?>

    <?php get_template_part('block', 'cta_forms'); ?>

    <div class="bd wrap">
        
        <?php get_template_part('block', 'innovation'); ?>
        <?php get_template_part('block', 'accolades'); ?>
        <div class="threeCol">
            <div class="col main">
                <div class="col">
                    <?php 
                    if ( have_posts() ) while ( have_posts() ) : the_post();
                    the_content(); // hardcoded?
                    endwhile; // end of the loop.
                    ?>
                </div>
            </div>
<?php get_footer(); ?>