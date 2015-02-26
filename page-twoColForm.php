<?php
/**
 * Template Name: Form Page - two column form
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

avala_form_submit();

get_header();

if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <div class="hero">
    	<div class="wrap">
            <h1 class="title">
                <?php
                    $t = explode( ' ', get_the_title() );
                    $i = 0;
                    foreach ($t as $k => $v) {
                        if ( $i > 0 ):
                            echo '<span style="color:#eee">' . $v . '</span> ';
                        else:
                            echo $v . ' ';
                        endif;
                        $i++;
                    }
                ?>
            </h1>
        </div>
    </div>
    <div class="goldBar10"></div>
    <div class="bd">
    	<div class="wrap">
            <div class="twoCol">
                <div class="main">
                    <div class="form-content">
                        <?php the_content(); ?>
                    </div>
                	<p class="note">Please provide your information in the form below. * Indicates required fields.</p>
                    <form action="<?php echo get_permalink(); ?>" method="post" id="leadForm">

                        <?php avala_hidden_fields( 15, 9, 20 ); ?>
                        
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
                                    <?php avala_field( 'phone', 'text w270 phonenumber', false, NULL, array( 'maxlength' => 16, 'placeholder' => 'Optional' )); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php avala_field( 'postal_code', 'text w270', true, NULL, array( 'maxlength' => 10 )); ?>
                                </td>
                                <td>
                                    <?php avala_field( 'country', 'w270 select', true ); ?>
                                </td>
                            </tr>
                            <tr class="divider">
                                <td colspan="2"></td>
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
                                    <input type="submit" class="submit bigGoldBtn" value="<?php echo get_post_meta( get_the_ID(), 'form-button-text', true ); ?>" />
                                </td>
                            </tr>
                        </table>
                        <p class="note">Your privacy is very important to us. See our <a href="<?php echo get_permalink(3987) ?>">Privacy Policy</a>.</p>
                    </form>
                </div>
                <div class="side">
                    <?php 
                        if (has_post_thumbnail( $post->ID ) ):
                            echo get_the_post_thumbnail($page->ID, 'full');
                        endif;
                    ?>
                </div>
            </div>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
