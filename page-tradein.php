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
                    <form action="<?php echo get_permalink(); ?>" method="post" id="leadForm" class="tradein-form">

                        <?php avala_hidden_fields( 15, 9, 7 ); ?>
                        
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
                                    <table>
                                        <tr>
                                            <td>
                                                <?php avala_field( 'phone', 'text number', true, NULL, array( 'maxlength' => 16 )); ?>
                                            </td>
                                            <td>
                                                <?php avala_field( 'postal_code', 'text', true, NULL, array( 'maxlength' => 10, 'style' => 'width: 85%;' )); ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="divider">
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td>
                                    <?php avala_field( 'buy_time_frame', 'w270 select', true ); ?>
                                </td>
                                <td></td>
                            </tr>
                            <tr class="divider">
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td>
                                    <?php avala_field( 'condition', 'w270 select', true ); ?>
                                </td>
                                <td>
                                    <table>
                                        <tr>
                                            <td>
                                                <?php avala_field( 'trade_in_year', 'text number', true, NULL, array( 'style' => 'width: 85%;' ) ); ?>
                                            </td>
                                            <td>
                                                <?php avala_field( 'trade_in_make', 'text', true, NULL, array( 'maxlength' => 40 )); ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="divider">
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label>Additional comments about the hot tub you would like to trade in?</label>
                                    <textarea name="Comments"></textarea>
                                </td>
                            </tr>
                            <tr class="divider">
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <?php avala_field('newsletter', '', false, 'field' ); ?>
                                </td>
                            </tr>
                            <tr class="divider">
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" class="submit bigGoldBtn" value="Trade in Value" />
                                </td>
                            </tr>
                        </table>
                        <p class="subnote">Your privacy is very important to us. We will never sell, share, or rent your personal information and<br />
                            email address to anyone. We hate spam as much as you do. See our <a href="<?php echo get_permalink(3987) ?>">Privacy Policy</a>.</p>
                    </form>
                </div>
                <div class="side">
                </div>
            </div>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>