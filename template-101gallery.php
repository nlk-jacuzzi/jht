<?php
/**
 * Template Name: 101 Gallery
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
			jQuery("a[rel^='prettyPhoto']").prettyPhoto({
				markup: '<div class="pp_pic_holder"> \
						<div class="ppt">&nbsp;</div> \
						<div class="pp_top"> \
							<div class="pp_left"></div> \
							<div class="pp_middle"></div> \
							<div class="pp_right"></div> \
						</div> \
						<div class="pp_content_container"> \
							<div class="pp_left"> \
							<div class="pp_right"> \
								<div class="pp_content"> \
									<div class="pp_loaderIcon"></div> \
									<div class="pp_fade"> \
										<a class="pp_close pp_close2" href="#">Close</a> \
										<div class="pp_hoverContainer"> \
											<a class="pp_next" href="#">next</a> \
											<a class="pp_previous" href="#">previous</a> \
										</div> \
										<div id="pp_full_res"></div> \
										<div class="pp_details"> \
											<div class="pp_nav"> \
												<a href="#" class="pp_arrow_previous">Previous</a> \
												<p class="currentTextHolderSlide">SLIDESHOW: <span class="currentTextHolder">0/0</span></p> \
												<a href="#" class="pp_arrow_next">Next</a> \
											</div> \
											<p class="pp_description"></p> \
										</div> \
									</div> \
								</div> \
							</div> \
							</div> \
						</div> \
						<div class="pp_bottom"> \
							<div class="pp_left"></div> \
							<div class="pp_middle"></div> \
							<div class="pp_right"></div> \
						</div> \
					</div> \
					<div class="pp_overlay"></div>',
					gallery_markup: '<div class="pp_gallery"> \
								<a href="#" class="pp_arrow_previous">Previous</a> \
								<div> \
									<ul> \
										{gallery} \
									</ul> \
								</div> \
								<a href="#" class="pp_arrow_next">Next</a> \
							</div>'

			});
		});
	</script>
	<div class="hero hero101 gallery101">
		<div class="wrap">
			<div class="inner">
				<div class="breadcrumb">
					<ul>
						<li class="first-child"><a href="<?php bloginfo('url'); ?>/hot-tubs-101/">Hot Tubs 101</a></li>
						<li>Inspirational</li>
					</ul>
					<div class="clear"></div>	
				</div>
				<?php the_field('banner_text'); ?>
			</div>
		</div>
	</div>
    <div class="bd gallery_content">
    	<div class="wrap">
            <div class="oneCol">
                <div class="main">
					<div class="gallery_101">
						<ul>
							<?php
								if( have_rows('gallery_images') ):
								    while ( have_rows('gallery_images') ) : the_row();
										$image = get_sub_field('gallery_image');
										$image_text = get_sub_field('gallery_text');
										$size_full = 'full';
										$size_thumb = 'gallery_thumb'; 

										if( $image ) {
											$full_image = wp_get_attachment_image_src($image, $size_full);
											echo '<li><a href="'.$full_image[0].'" rel="prettyPhoto[pp_gal]" title="'.$image_text.'">'. wp_get_attachment_image( $image, $size_thumb ).'<div class="overlay2"></div></a></li>';
										}
								    endwhile;
								else:
								endif;								
							?>
						</ul>
						<div class="clear"></div>
					</div>
                </div>
            </div>
       </div><!-- /wrap -->
       <div class="clear"></div>
    </div><!-- /bd --> 
    <div class="bd pinInterest">
    	<div class="wrap">
            <div class="oneCol">
                <div class="main">
                	<?php the_field('pinterest_link'); ?>
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
