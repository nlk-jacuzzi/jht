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
                <h1><?php single_cat_title(); ?></h1>
                <?php echo category_description() ?>
                <div class="warranties">
<?php while ( have_posts() ) : the_post();
global $post;
?>
		<div class="warranty">
        <?php
		$cont = '<a href="'. get_permalink() .'">'. get_the_post_thumbnail($post->ID, 'accthm', array('class'=>'alignleft')) .'<strong>'. get_the_title() .'</strong></a> - '. $post->post_content;
		echo apply_filters('the_content', $cont);
		?>
		</div>
<?php endwhile; // End the loop. Whew. ?>
				</div>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'jht' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'jht' ) ); ?></div>
				</div><!-- #nav-below -->
<?php endif; ?>
			</div><!-- #main -->
		</div><!-- #twocol -->

<?php get_footer(); ?>
