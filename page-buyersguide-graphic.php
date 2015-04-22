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
            <div id="leadForm">
            	<span class="formtitle">Download Free Guide Now</span>
            	<table width="320">
                    <tr>
                        <td colspan="2">
                            <?php echo do_shortcode('[gravityform id="17" title="false" description="false"]'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="buttonarea">
                            <p class="requiredtext">* indicates required field</p>
                            <p class="privacytext">Your privacy is very important to us. We will never rent or sell your information, see our <a href="#">Privacy Policy</a></p>
                        </td>
                    </tr>
                </table>
            </div>
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

