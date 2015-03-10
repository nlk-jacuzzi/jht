<?php
/**
 * Template Name: Request Pricing A
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */


avala_form_submit();

$new_post = false;

if( isset($_GET['tid']) ) {
    $new_post = get_post( $_GET['tid'] );
}

$avala_tub_default = false;
$avala_tubs_array = avala_args('product_id_list');

get_header();

if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <div class="hero request-pricing">
        <div class="wrap">
            <?php // empty hero area ?>
        </div>
    </div>
    <div class="bd request-pricing">
    	<div class="wrap">
            <div class="twoCol">
                <div class="main request-pricing">
                    <h1 class="title"><?php the_title(); ?></h1>
                    <p>Simply fill in this quick form to request pricing on your perfect hot tub. Your local authorized Jacuzzi dealer will reach out to you with expert selection advice, pricing, and any current specials in your area.<br /><br />*Indicates required fields.</p>

                    <form action="<?php echo get_permalink(); ?>" method="post" id="leadForm">

                        <?php avala_hidden_fields( 15, 9, 5 ); ?>

                        <div class="avala-row">
                            <label class="small">Name*</label>
                            <?php avala_field( 'first_name', 'medium text', true, 'field', array( 'placeholder' => 'First' ) ); ?>
                            <?php avala_field( 'last_name', 'medium text', true, 'field', array( 'placeholder' => 'Last' ) ); ?>
                        </div>
                        <div class="avala-row">
                            <label class="small">Email*</label>
                            <?php avala_field( 'email', 'email long text', true, 'field'); ?>
                        </div>
                        <div class="avala-row">
                            <label class="small">Zip Code*</label>
                            <?php avala_field( 'postal_code', 'short text', true, 'field', array( 'maxlength' => 10 )); ?>
                            <label class="small" id="label-phone">Phone*</label>
                            <?php avala_field( 'phone', 'phonenumber short text', true, 'field', array( 'maxlength' => 16, 'placeholder' => 'xxx-xxx-xxxxx' )); ?>
                        </div>
                        <div class="avala-row">
                            <label>What is the primary reason you are considering the purchase of a hot tub?</label>
                            <?php avala_field( 'product_use', 'select', false, 'field', null, 'select' ); ?>
                        </div>
                        <div class="avala-row">
                            <label>Which Jacuzzi<sup>&reg;</sup> Hot Tub are you interested in purchasing?</label>
                            <?php avala_field( 'product_id_list', 'select', false, 'field', null, 'select', false, $avala_tub_default ); ?>
                        </div>
                        <div class="avala-row">
                            <?php avala_field('newsletter', '', false, 'field' ); ?>
                        </div>
                        <div class="avala-row">
                            <input type="submit" class="submit bigGoldBtn" value="Get My Pricing" />
                        </div>
                        <div class="avala-row">
                            <p class="note"><a href="<?php echo get_permalink(3987) ?>">Privacy Policy</a></p>
                        </div>

                    </form>
                </div>
                <div class="side">
                    <?php // Dynamic images would go here based on product coming in from 
                    if (class_exists('MultiPostThumbnails') && $new_post) {
                        echo '<p style="font-size: 24px;margin-bottom: .5em;margin-top: -68px;font-family: \'GSBQ\';">' . get_the_title($new_post->ID) . '</p>';
                        $the_img = MultiPostThumbnails::the_post_thumbnail('jht_tub', 'three-quarter', $new_post->ID, 'large');
                        echo '<p style="">' . get_post_meta( $new_post->ID, 'topheadline', true ) . '</p>';
                    }
                    else { ?>
                        <p style="font-size: 24px;margin-bottom: .5em;margin-top: -68px;font-family: 'GSBQ';"></p>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/quote/RequestQuoteDefaultTubs.png" />
                    <?php } ?>
                </div>
            </div>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
