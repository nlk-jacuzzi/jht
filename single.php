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
            <h1 class="title">Jacuzzi Blog</h1>
        </div>
    </div>
    <div class="goldBar10"></div>
    <div class="bd">
        <div class="wrap">

            <?php while ( have_posts() ) : the_post(); ?>

                <?php
                $custom = get_post_meta($post->ID,'jht_pageopts');
                $pageopts = $custom[0];
                ?>

                <div class="twoCol">
                    <div class="side">
                        <?php //get_sidebar('blog'); ?>
                        <?php
                        if ( isset($pageopts['menu']) ) {
                            $mid = absint($pageopts['menu']);
                            if ( $mid > 0 ) {
                                wp_nav_menu(array('menu'=>$mid));
                            }
                        }
                        get_sidebar('pageoptions');
                        ?>
                    </div>
                    <div class="main">

                		<div id="post-<?php the_ID(); ?>" class="entry">
                            <!--div class="share-icons"></div-->
                			<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'jht' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

                			<div class="post-meta">
                				<?php jht_posted_on(); ?>
                			</div><!-- .entry-meta -->

                			<div class="post-content">
                				<?php the_content( __( 'more', 'jht' ) ); ?>
                			</div><!-- .entry-content -->

                            <div class="share-this"><?php if(function_exists('sharethis_button')) sharethis_button(); ?></div>
                		</div><!-- #post-## -->

                    </div><!-- #main -->
                </div><!-- #twocol -->

            <?php endwhile; // End the loop. Whew. ?>

<?php get_footer(); ?>
