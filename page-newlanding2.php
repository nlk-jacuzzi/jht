<?php
/**
 * Template Name: NewLanding 2
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

avala_form_submit();

wp_enqueue_style('Lato', 'http://fonts.googleapis.com/css?family=Lato:400,900,900italic,300');

get_header( 'newdirect' );

if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <div class="bd">
    	<div class="wrap">
            <div class="twoCol" id="land2">
                <div class="main">
                <?php the_content(); ?>
                </div>
                <div class="side rtform">
                	<h3>Get Your Free Brochure</h3>
                    <style type="text/css">
                        .nodisplay {
                            display: none !important;
                        }
                    </style>
                    <form action="<?php echo get_permalink(); ?>" method="post" id="leadForm">

                        <?php avala_hidden_fields( 15, 9, 12 ); ?>                       

                        <input id="DeliveryMethod[0]" name="DeliveryMethod" type="hidden" value="12" />
                        <table cellspacing="0">
                            <tr>
                                <td>
                                    <?php avala_field('first_name', 'text w120', true, 'field', array('placeholder' => 'First Name *', 'required' => 'required')); ?>
                                </td>
                                <td>
                                    <?php avala_field('last_name', 'text w120', true, 'field', array('placeholder' => 'Last Name *', 'required' => 'required')); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php avala_field('postal_code', 'text w120', true, 'field', array('maxlength' => 10, 'placeholder' => 'Zip / Postal Code *', 'required' => 'required')); ?>
                                </td>
                                <td>
                                    <?php avala_field('phone', 'text w120', false, 'field', array('maxlength' => 16, 'placeholder' => 'Phone')); ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <?php avala_field('email', 'text w270 email', true, 'field', array('placeholder' => 'Email *', 'required' => 'required')); ?>
                                    <?php avala_field('currently_own', 'w270 select', false, null, null, false, 'Have you ever owned a hot tub?'); ?>
                                    <input type="hidden" name="ProductIdList" id="productidlist" value="0" />
                                    <?php avala_field('buy_time_frame', 'w270 select', false, null, null, 'select'); ?>
                                    <?php avala_field('product_use', 'w270 select', false, null, null, 'select'); ?>
                                </td>
                            </tr>
                            <tr class="divider">
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label for="ReceiveEmailCampaigns"><input class="editor choice" name="ReceiveEmailCampaigns" value="true" type="checkbox" checked="checked" />  Yes, I would like to receive email updates and specials from Jacuzzi Hot Tubs. </label>
                                </td>
                            </tr>
                            <tr class="divider">
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" class="submit bigGoldBtn" value="Download Now" />
                                    <small>* Indicates required fields</small>
                                    </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
<?php
endwhile; // end of the loop. ?>
<?php get_footer( 'newdirect' ); ?>