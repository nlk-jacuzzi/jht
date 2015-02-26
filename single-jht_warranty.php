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

            <h1 class="title">Warranty Options</h1>

        </div>

    </div>

    <div class="goldBar10"></div>

<div class="bg-new">

    <div class="bd">

    	<div class="wrap">

            <div class="twoCol">

                <div class="side">

                <?php

                $pageopts['menu']=23;

					if ( isset($pageopts['menu']) ) {

						$mid = absint($pageopts['menu']);

						if ( $mid > 0 ) {

							wp_nav_menu(array('menu'=>$mid));

						}

					}

                    //wp_nav_menu(array('theme_location'=>'trademark'));

                    get_sidebar('freeBrochure');

                    get_sidebar('requestQuote');

                    get_sidebar('tradeIn');

                    get_sidebar('contactNumber');

					?>

                </div>

                <div class="main">

<?php while ( have_posts() ) : the_post();

?>

		<div id="post-<?php the_ID(); ?>" class="entry">

            <!--div class="share-icons"></div>-->

			<h2 class="title"><?php the_title(); ?></h2>



			<!--<div class="post-meta">

				<?php jht_posted_on(); ?>

			</div>-->



		



			<div class="post-content">

				<?php the_content( __( 'more', 'jht' ) ); ?>

			

			</div><!-- .entry-content -->



			<?php if ( has_post_thumbnail()) : ?>



                        



                    <?php the_post_thumbnail('full', array('class' => 'aligncenter big-pro')); ?>



                        



                    <?php endif; ?>



            <!--<div class="share-this"><?php if(function_exists('sharethis_button')) sharethis_button(); ?></div>-->

		</div><!-- #post-## -->



<?php endwhile; // End the loop. Whew. ?>

			</div><!-- #main -->



		</div><!-- #twocol -->

</div>

</div>

</div>


<?php get_footer('warranty'); ?>

