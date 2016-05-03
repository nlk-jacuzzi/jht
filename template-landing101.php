<?php
/**
 * Template Name: 101 Landing Page 
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
	<div class="hero">
        <div class="wrap">
       	</div>
    </div>
    <div class="bd">
    	<div class="wrap">
            <div class="oneCol">
                <div class="main">
					<div class="intro_div">
						<div class="text_div">
							<?php the_field('intro_text'); ?>
						</div>
						<div class="img_div">
							<?php the_field('intro_image'); ?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="benefits_div">
						<div class="img_div">
							<?php the_field('benefits_image'); ?>
						</div>
						<div class="text_div">
							<?php the_field('benefits_text'); ?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="three_blocks">
						<div class="block_div block_first">
							<div class="img_div">
								<a href="<?php the_field('block_1_link'); ?>"><img src="<?php the_field('block_1_image'); ?>" /></a>
							</div>
							<div class="text_div">
								<a href="<?php the_field('block_1_link'); ?>"><?php the_field('block_1_text'); ?></a>
							</div>
						</div>
						<div class="block_div block_second">
							<div class="img_div">
								<a href="<?php the_field('block_2_link'); ?>"><img src="<?php the_field('block_2_image'); ?>" /></a>
							</div>
							<div class="text_div">
								<a href="<?php the_field('block_2_link'); ?>"><?php the_field('block_2_text'); ?></a>
							</div>
						</div>
						<div class="block_div block_third">
							<div class="img_div">
								<a href="<?php the_field('block_3_link'); ?>"><img src="<?php the_field('block_3_image'); ?>" /></a>
							</div>
							<div class="text_div">
								<a href="<?php the_field('block_3_link'); ?>"><?php the_field('block_3_text'); ?></a>
							</div>
						</div>
						<div class="clear"></div>
					</div>
                </div>
            </div>
    	</div><!-- /wrap -->
        <div class="clear"></div>
    </div><!-- /bd -->        
<?php endwhile; // end of the loop. ?>
<?php get_footer('tub101'); ?>
