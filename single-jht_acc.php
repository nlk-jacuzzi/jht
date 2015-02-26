<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

get_header(); ?>
		 <div class="hero">
    	<div class="wrap">
            <h1 class="title">Accessories</h1>
        </div>
    </div>
    <div class="goldBar10"></div>
    <div class="bd">
    	<div class="wrap">
            <div class="twoCol">
                <div class="side">
                	<?php
                    wp_nav_menu(array('theme_location'=>'acc'));
					get_sidebar('freeBrochure');
                    get_sidebar('requestQuote');
                    get_sidebar('tradeIn');
                    get_sidebar('contactNumber');
					?>
                </div>
                <div class="main">
<?php while ( have_posts() ) : the_post();
global $post;
?>
                <h1><?php the_title(); ?></h1>
		<div style="float:right;margin:0 -59px 0 18px"><?php the_post_thumbnail('accimg') ?></div>
        <?php the_content(); ?>
<?php endwhile; // End the loop. Whew. ?>
			</div><!-- #main -->
		</div><!-- #twocol -->

<?php get_footer(); ?>
