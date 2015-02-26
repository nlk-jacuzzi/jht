<?php
/**
 * Template Name: Form Page - Buyers Guide (Hero Form)
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

avala_form_submit();

get_header( 'newdirect' );

if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <div class="hero buyersguide2">
    	<div class="wrap">
            <img src="<?php bloginfo('template_url'); ?>/images/brochure/hot-tub-buyers-guide.png"/>
            <form action="<?php echo get_permalink(); ?>" method="post" id="leadForm">
                <span class="formtitle">Download Free Guide Now</span>
                <?php avala_hidden_fields( 15, 9, 20 ); ?>
                <table width="320">
                    <tr>
                        <td>
                            <?php avala_field('first_name', 'text', true, 'field', array('placeholder'=>"First Name *", 'required'=>"required" )); ?>
                        </td>
                        <td>
                            <?php avala_field('last_name', 'text', true, 'field', array('placeholder'=>"Last Name *", 'required'=>"required" )); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php avala_field('postal_code', 'text', true, 'field', array('size'=>"7", 'placeholder'=>"Zip *",'required'=>"required" )); ?>
                        </td>
                        <td>
                            <?php avala_field('email', 'text email', true, 'field', array('placeholder'=>"Email *", 'required'=>"required" )); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="dropdowns">
                            <span class="thefield"><?php avala_field('product_use', '', false, 'all', '', 'select', 'What is the primary reason you are considering the purchase of a hot tub?'); ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="buttonarea">
                            <input type="submit" value="Download Now" class="sprite" onClick="if(typeof(_vis_opt_top_initialize) == 'function') { _vis_opt_goal_conversion(200); }; _gaq.push(['_trackEvent', 'lead', 'buyers-guide']);" />
                            <p class="requiredtext">* indicates required field</p>
                            <p class="privacytext">Your privacy is very important to us. We will never rent or sell your information, see our <a href="#">Privacy Policy</a></p>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <div class="goldBar10"></div>
    <div class="bd">
    	<div class="wrap">
            <div class="twoCol">
                <?php 
                the_content(); // hardcoded?
                ?>
            </div>
        </div>
<?php endwhile; // end of the loop. ?>
<?php get_footer( 'newdirect' ); ?>

