<?php
/**
 * Template Name: 101 Benefits
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

get_header();
if ( have_posts() ) while ( have_posts() ) : the_post();
?>
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/hottub101.css" type="text/css" media="all">
	<div class="hero hero101 101benefits">
		<div class="wrap">
			<div class="inner">
				<div class="breadcrumb">
					<ul>
						<li class="first-child"><a href="<?php bloginfo('url'); ?>/intro-to-hot-tubs/">Intro to Hot Tubs</a></li>
						<li>Why Get a Hot Tub?</li>
					</ul>
					<div class="clear"></div>	
				</div>
				<?php the_field('banner_text'); ?>
			</div>
		</div>
	</div>
    <div class="bd general_content">
    	<div class="wrap">
            <div class="oneCol">
                <div class="main">
					<div class="eachBenefit benefitRelax container_grid">
						<h2><?php the_field('relax_heading_text'); ?></h2>
						<div class="grid_4 alpha">
							<?php the_field('relax_video_link'); ?>
						</div>
						<div class="grid_8 omega">
							<?php the_field('relax_description'); ?>	
						</div>
						<div class="clear"></div>
					</div>
					<div class="eachBenefit benefitTherapy container_grid">
						<h2><?php the_field('physical_heading_text'); ?></h2>
						<div class="grid_6 alpha">
							<?php the_field('physical_description_alpha'); ?>
						</div>
						<div class="grid_6 omega">
							<?php the_field('physical_description_omega'); ?>
						</div>
						<div class="clear"></div>
						<?php the_field('physical_description_note'); ?>
					</div>
                </div>
            </div>
       </div><!-- /wrap -->
       <div class="clear"></div>
    </div><!-- /bd -->  
    <div class="bd benefitsection video_testimonials">
    	<div class="wrap">
            <div class="oneCol">
                <div class="main">
                	<h2><?php the_field('video_heading_text'); ?></h2>
                	<div class="container_grid">
	                	<div class="grid_4 alpha">
	                		<?php the_field('video_1'); ?>
	                	</div>
	                	<div class="grid_4">
	                		<?php the_field('video_2'); ?>
	                	</div>
	                	<div class="grid_4 omega">
	                		<?php the_field('video_3'); ?>
	                	</div>
	                	<div class="clear"></div>
                	</div>
                </div>
             </div>
         </div>
         <div class="clear"></div>
     </div>
     <div class="bd general_content">
    	<div class="wrap">
            <div class="oneCol">
                <div class="main">
					<div class="eachBenefit benefitFitness container_grid">
						<h2><?php the_field('fitness_heading_text'); ?></h2>
						<div class="grid_7 alpha">
							<?php the_field('fitness_description'); ?>
						</div>
						<div class="grid_5 omega">
							<div class="video_div">
								<?php the_field('fitness_video_link'); ?>
							</div>
						</div>
						<div class="clear"></div>
					</div>
					<div class="eachBenefit benefitEntertainement container_grid">
						<h2><?php the_field('entertainment_heading_text'); ?></h2>
						<div class="grid_5 alpha">
							<div class="video_div"><?php the_field('entertainment_video_link'); ?></div>
						</div>
						<div class="grid_7 omega">
							<?php the_field('entertainment_description'); ?>	
						</div>
						<div class="clear"></div>
					</div>
                </div>
            </div>
       </div><!-- /wrap -->
       <div class="clear"></div>
    </div><!-- /bd -->     
    <div class="bd benefitsection">
    	<div class="wrap">
            <div class="oneCol">
                <div class="main">
						<?php the_field('bottom_video'); ?>
                </div>
            </div>
       </div><!-- /wrap -->
       <div class="clear"></div>
    </div><!-- /bd -->   
    <div class="bd cta_section">
    	<div class="wrap">
    		<div class="oneCol">
    			<div class="main">
    				<div clas="container_grid">
	    				<div class="grid_2 alpha cta_img">
	    					<img src="<?php the_field('cta_image'); ?>" />
	    				</div>
	    				<div class="grid_7 cta_text">
	    					<?php the_field('cta_text'); ?>
	    				</div>
	    				<div class="grid_3 omega cta_button">
	    					<?php the_field('cta_button'); ?>
	    				</div>
	    				<div class="clear"></div>
    				</div>
    			</div>	
    		</div>	
    	</div>
    </div>
    <div class="bd bottom_navigation">
    	<div class="wrap">
    		<div class="oneCol">
    			<div class="main">
    				<div class="container_grid">
	    				<div class="grid_6 alpha">
	    					<a href="<?php the_field('previous_link'); ?>" class="previous_link"><?php the_field('previous_link_text'); ?></a>
	    				</div>
	    				<div class="grid_6 omega">
	    					<a href="<?php the_field('next_link'); ?>" class="next_link"><?php the_field('next_link_text'); ?></a>
	    				</div>
	    				<div class="clear"></div>
	    			</div>	
    			</div>	
    		</div>	
    	</div>
    </div>     	   
<?php endwhile; // end of the loop. ?>
<?php get_footer('tub101'); ?>
