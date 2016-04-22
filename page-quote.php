<?php
/**
 * Template Name: Request a Quote (Avala)
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

//avala_form_submit();

get_header();

if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <div class="hero">
    	<div class="wrap">
            <h1 class="title"><?php the_title(); ?></h1>
        </div>
    </div>
    <div class="goldBar10"></div>
    <div class="bd">
    	<div class="wrap">
            <div class="twoCol">
                <div class="main">
                	<p class="note">Simply fill in this quick form to request pricing on your perfect hot tub. Your local authorized Jacuzzi dealer will reach out to you with expert selection advice, pricing, and any current specials in your area. *Indicates required fields.</p>
                    <form action="<?php echo get_permalink(); ?>" method="post" id="leadForm">

                        <?php avala_hidden_fields( 15, 9, 5 ); ?>

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
                                    <?php avala_field( 'phone', 'text w270 phonenumber', true, NULL, array( 'maxlength' => 16, 'placeholder' => 'xxx-xxx-xxxxx' )); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php avala_field( 'postal_code', 'text w270', true, NULL, array( 'maxlength' => 10 )); ?>
                                </td>
                               <td></td>
                            </tr>
                            <tr class="divider">
                                <td colspan="2"></td>
                            </tr>
                            <tr class="divider">
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td>
                                    <?php avala_field( 'currently_own', '', false, 'label' ); ?>
                                </td>
                                <td>
                                    <?php avala_field( 'currently_own', 'w270 select', false, 'field' ); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php avala_field( 'product_id_list', '', false, 'label' ); ?>
                                </td>
                                <td>
                                    <?php avala_field( 'product_id_list', 'w270 select', false, 'field' ); ?> 
                                </td>
                            </tr>
                            <tr class="divider">
                                <td colspan="2"></td>
                            </tr>

                            <tr>
                                <td>
                                    <?php avala_field( 'buy_time_frame' ); ?>
                                </td>
                                <td>
                                    <?php avala_field( 'product_use' ); ?>
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
                                    <input type="submit" class="submit bigGoldBtn" value="Get My Quote" />
                                </td>
                            </tr>
                        </table>
                        <p class="note">Your privacy is very important to us. See our <a href="<?php echo get_permalink(3987) ?>">Privacy Policy</a>.</p>
                    </form>
                </div>
                <div class="side">
                </div>
            </div>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
