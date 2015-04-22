<?php
/**
 * Template Name: Trade In Value
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 *
 */

avala_form_submit();

get_header();

if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <div class="hero">
    	<div class="wrap">
            <h1 class="title"><?php the_title(); ?></h1>
        </div>
    </div>
    <div class="goldBar10"></div>
    <div class="bd">
    	<div class="wrap  form quote">
            <div class="twoCol">
                <div class="main">
                	<p class="note">Learn what your current hot tub is worth towards the purchase of a new Jacuzzi hot tub! Upon completing this form, your local authorized dealer will contact you to learn more about your current hot tub and provide a competitive, no obligation, free trade-in estimate.</p>
                    <p class="subnote">Please provide your information in the form below. *Indicates required fields.</p>
                    <div class="trade-in-form">
                   		<?php echo do_shortcode('[gravityform id="16" title="false" description="false"]'); ?>
                   	</div>
                    <p class="subnote">Your privacy is very important to us. We will never sell, share, or rent your personal information and<br />
                            email address to anyone. We hate spam as much as you do. See our <a href="<?php echo get_permalink(3987) ?>">Privacy Policy</a>.</p>
                </div>
                <div class="side">
                </div>
            </div>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>