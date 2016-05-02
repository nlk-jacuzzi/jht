<?php
/**
 * Template Name: 101 Research
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
	<div class="hero hero101 what101">
		<div class="wrap">
			<div class="inner">
				<div class="breadcrumb">
					<ul>
						<li class="first-child"><a href="<?php bloginfo('url'); ?>/hot-tubs-101/">Hot Tubs 101</a></li>
						<li>What To Look For</li>
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
					<div class="eachBenefit benefitJets container_grid">
						<h2><?php the_field('jets_heading_text'); ?></h2>
						<div class="grid_8 alpha">
							<?php the_field('jets_description'); ?>
						</div>
						<div class="grid_4 omega">
							<?php the_field('jets_video_link'); ?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="eachBenefit benefitQuality container_grid">
						<h2><?php the_field('quality_heading_text'); ?></h2>
						<div class="grid_8 alpha">
							<?php the_field('quality_description'); ?>
						</div>
						<div class="grid_4 omega">
							<?php the_field('quality_video_link'); ?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="eachBenefit benefitWater container_grid">
						<h2><?php the_field('water_heading_text'); ?></h2>
						<div class="grid_8 alpha">
							<?php the_field('water_description'); ?>
						</div>
						<div class="grid_4 omega">
							<?php the_field('water_video_link'); ?>
						</div>
						<div class="clear"></div>
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
                	<h2>Check out these related blog topics:</h2>
                	<div class="container_grid">
	                	<div class="grid_4 alpha">
	                		<div class="eachVideo">
	                			<?php the_field('blog_topic_1'); ?>
	                		</div>
	                	</div>
	                	<div class="grid_4">
	                		<div class="eachVideo">
	                			<?php the_field('blog_topic_2'); ?>
	                		</div>
	                	</div>
	                	<div class="grid_4 omega">
	                		<div class="eachVideo">
	                			<?php the_field('blog_topic_3'); ?>
	                		</div>
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
					<div class="eachBenefit benefitPortable container_grid">
						<h2><?php the_field('portable_heading_text'); ?></h2>
						<div class="grid_8 alpha">
							<?php the_field('portable_description'); ?>
						</div>
						<div class="grid_4 omega">
							<?php the_field('portable_video_link'); ?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="eachBenefit benefitDimensions container_grid">
						<h2><?php the_field('dimensions_heading_text'); ?></h2>
						<div class="grid_8 alpha">
							<?php the_field('dimensions_description'); ?>
						</div>
						<div class="grid_4 omega">
							<?php the_field('dimensions_video_link'); ?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="eachBenefit benefitSeating container_grid">
						<h2><?php the_field('seating_heading_text'); ?></h2>
						<div class="grid_8 alpha">
							<?php the_field('seating_description'); ?>
						</div>
						<div class="grid_4 omega">
							<?php the_field('seating_video_link'); ?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="eachBenefit benefitCovers container_grid">
						<h2><?php the_field('covers_heading_text'); ?></h2>
						<div class="grid_8 alpha">
							<?php the_field('covers_description'); ?>
						</div>
						<div class="grid_4 omega">
							<?php the_field('covers_video_link'); ?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="eachBenefit benefitConvenience container_grid">
						<h2><?php the_field('entertainment_heading_text'); ?></h2>
						<div class="grid_8 alpha">
							<?php the_field('entertainment_description'); ?>
						</div>
						<div class="grid_4 omega">
							<?php the_field('entertainment_video_link'); ?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="eachBenefit benefitWarranty container_grid">
						<?php the_field('warranty_box'); ?>
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
    				<div class="container_grid">
	    				<div class="grid_2 alpha cta_img cta_img_touchdown">
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
