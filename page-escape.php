<?php
/**
 * Template Name: Escape with Jacuzzi
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */


avala_form_submit();



get_header();
if ( have_posts() ) while ( have_posts() ) : the_post();
$custom = get_post_meta($post->ID,'jht_pageopts');
$pageopts = $custom[0];
$titleoverride = false;
if ( isset($pageopts['o']) ) if ( $pageopts['o'] != '' ) $titleoverride = $pageopts['o'];
?>
    <div class="hero spacer"></div>
    <div class="bd">
    	<div class="wrap form">
            <div class="twoCol escape">
                
                <div class="main">
                	<img src="<?php bloginfo('template_url'); ?>/images/landing/escape-hdr.png" alt="Escape with Jacuzzi&reg; - Enter to Win" width="551" height="131" class="eschdr" />
                    <h2 class="bigger">PLEASE FILL YOUR INFO TO BE ENTERED TO WIN</h2>
                    <p class="note">*Indicates required fields.</p>
                    <form action="<?php echo get_permalink(); ?>" method="post" id="leadForm">

                        <?php avala_hidden_fields( 22, 1, 2 ); ?>

                        <table cellspacing="0">
                            <tr>
                                <td>
                                    <?php avala_field( 'first_name', 'text w270', true); ?>
                                </td>
                            
                                <td>
                                    <?php avala_field( 'last_name', 'text w270', true); ?> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php avala_field( 'email', 'text w270 email', true); ?>
                                </td>
                                <td>
                                    <?php avala_field( 'postal_code', 'text w270', true, NULL, array( 'maxlength' => 10 )); ?>
                                </td>
                            </tr>
                            <tr class="divider">
                                <td></td><td></td>
                            </tr>
                            <tr>
                                <td>
                                    <?php avala_field( 'home_owner', '', true); ?> 
                                </td>
                                <td></td>
                            </tr>
                            <tr class="divider">
                                <td></td><td></td>
                            </tr>
                            <tr>
                                <td>
                                    <?php avala_field( 'interested_in_owning', '', true, 'label' ); ?>
                                </td>
                                <td>
                                    <fieldset onclick="var selected;
                                        $('.wantsown:checked').each( function() { 
                                            selected = $(this).val();
                                        });
                                        if (selected == 'Yes') { 
                                            $('.showme').removeClass('hideme');
                                        } 
                                        else { 
                                            $('.showme').addClass('hideme');
                                        };" > 
                                            <label for="CustomData" class="inline"><input name="CustomData[InterestedInOwning]" value="Yes" type="radio" class="wantsown"/>  Yes &nbsp;&nbsp;&nbsp;</label> 
                                            <label for="CustomData" class="inline"><input name="CustomData[InterestedInOwning]" value="No" type="radio" class="wantsown"/>  No </label> 
                                    </fieldset>
                                </td>
                            </tr>
                            <tr class="divider">
                                <td></td><td></td>
                            </tr>
                            <tr class="showme hideme">
                                <td>
                                    <?php avala_field( 'product_use' ); ?>
                                </td>
                                <td>
                                    <?php avala_field( 'buy_time_frame' ); ?>
                                </td>
                            </tr>
                            <tr class="divider">
                                <td></td><td></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <?php avala_field('newsletter', '', false, 'field' ); ?>
                                </td>
                            </tr>
                            <tr class="divider">
                                <td colspan="2">
                                    <input type="hidden" name="Brand" value="Jacuzzi Hot Tubs" />
                                    <input type="hidden" name="Event" value="Escape" />
                                    <input type="hidden" name="Campaign" value="EWJ" />
                                    <input type="hidden" name="TriggeredSend" value="EWJCampaignDA" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" class="submit blueBtn" value="Enter to Win!" />
                                </td>
                            </tr>
                        </table>
                        <p class="note">
                          <!--a href="<?php echo get_bloginfo('url'); ?>/escape-with-jacuzzi/escape-thanks/escape-to-jacuzzi-prizes/">Learn More about our great prizes!</a> <br /><br /-->
                        Your privacy is very important to us. See our <a href="<?php echo get_permalink(3987) ?>">Privacy Policy</a>.</p>
                    </form>
                </div>
                <div class="side">
                <?php the_content(); ?>
                </div>
            </div>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>