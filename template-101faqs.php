<?php
/**
 * Template Name: 101 FAQs
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
	
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery( "#faqs" ).accordion({
		      collapsible: true,
		      heightStyle: "content",
			  active: false,
		    });
		});
	</script>
	<div class="hero hero101 faq101">
		<div class="wrap">
			<div class="inner">
				<div class="breadcrumb">
					<ul>
						<li class="first-child"><a href="<?php bloginfo('url'); ?>/hot-tubs-101/">Hot Tubs 101</a></li>
						<li>Hot Tub Ownership</li>
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
					<div class="eachBenefit faqBenefit">
						<div id="faqs">
							  <?php
								if( have_rows('faqs') ):
								    while ( have_rows('faqs') ) : the_row();
									?>
									<h3><?php the_sub_field('faq_title'); ?></h3>
									<div>
										<?php the_sub_field('faq_text'); ?>
									</div>
								<?php
									endwhile;
								else:
								endif;								
							?>
						</div>
					</div>
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
