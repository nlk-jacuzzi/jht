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
            <h1 class="title"><?php printf( __( '"%s" search', 'jht' ), get_search_query() ); ?></h1>
        </div>
    </div>
    <div class="goldBar10"></div>
    <div class="bd">
    	<div class="wrap">
            <div class="twoCol">
                <div class="main"><p><br /></p>
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" class="entry">
        <?php /*
            <div class="share-icons">
            //insert code for "Facebook Share" http://wordpress.org/extend/plugins/facebook-share-new/
            //and TweetMeMe Retweet Button http://wordpress.org/extend/plugins/facebook-share-new/ 
            </div>
			*/ ?>
			<h1 class="title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'jht' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<div class="post-content">
				<?php the_excerpt(); ?>
			</div><!-- .entry-content -->
		</div><!-- #post-## -->
		<hr />
<?php endwhile; // End the loop. Whew. ?>
<?php else : ?>
				<div id="post-0" class="entry">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'jht' ); ?></h2>
					<div class="post-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'jht' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-0 -->
<?php endif; ?>
<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<div id="nav-below" class="navigation">
					<div class="nav-next"><?php next_posts_link( __( 'More Results <span class="meta-nav">&rarr;</span>', 'jht' ) ); ?></div>
					<div class="nav-previous"><?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Previous Results', 'jht' ) ); ?></div>
				</div><!-- #nav-below -->
<?php endif; ?>
			</div><!-- #main -->
		</div><!-- #twocol -->

<?php get_footer(); ?>
