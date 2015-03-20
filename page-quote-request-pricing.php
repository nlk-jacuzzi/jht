<?php
/**
 * Template Name: Request Pricing A
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */


//avala_form_submit();

$new_post = false;

if( isset($_GET['tid']) ) {
    $new_post = get_post( $_GET['tid'] );
    $custom = get_post_meta($new_post->ID,'jht_info');
    $jht_info = $custom[0];
}

//$avala_tub_default = false;
$avala_tubs_array = avala_args('product_id_list');

get_header();

if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <div class="hero request-pricing">
        <div class="wrap">
            <?php // empty hero area ?>
        </div>
    </div>
    <style>
    	.main .gform_wrapper .gform_footer input.button, .main .gform_wrapper .gform_footer input[type="submit"]
    	{
    		box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
			color: #252525 !important;
    		background: -moz-linear-gradient(center top , #E5C871 0%, #D9B444 36%, #C69200 100%) repeat scroll 0% 0% transparent;
    		border-radius: 6px;
			border: 1px solid #D7AD33;
			font: 400 18px "GSBQ";
			padding: 8px 85px;
			color: #252525;
			height: auto;
			text-transform: none;
			text-shadow: none;
			margin: 4px;
			letter-spacing: 1px;
    	}
    	
    	.gform_wrapper .gfield_checkbox li label, .gform_wrapper .gfield_radio li label
    	{
    		margin-top: 4px !important;
    	}
    	
    	p.note a
    	{
    		color: #0092CB;
			text-decoration: none;
    	}
    </style>
    <div class="bd request-pricing">
    	<div class="wrap">
            <div class="twoCol">
                <div class="main request-pricing" style="display: none;">
                    <h1 class="title"><?php the_title(); ?></h1>
                    <p>Simply fill in this quick form to request pricing on your perfect hot tub. Your local authorized Jacuzzi dealer will reach out to you with expert selection advice, pricing, and any current specials in your area.<br><br>*Indicates required fields.</p>
					<?php echo do_shortcode('[gravityform id="14" name="No-Obligation Price Quote" title="false" description="false"]'); ?>
					<p class="note"><a href="<?php echo get_permalink(3987) ?>">Privacy Policy</a></p>
                </div>
                <script type="text/javascript">
                (function($){
                    var str = "<?php echo get_the_title($new_post->ID); ?>";
                    var sel = str.replace(/[^a-z0-9\-]/gi, '');
                    var opt = $('.avalaFieldProductId option').filter(function () { return $(this).html() == sel; }).val();
                    $('.avalaFieldProductId option[value="'+opt+'"]').attr('selected', 'selected');
                    $('div.main.request-pricing').show();
                })(jQuery);
                </script>
                <div class="side">
                    <?php // Dynamic images would go here based on product coming in from 
                    if (class_exists('MultiPostThumbnails') && $new_post) {
                        echo '<p style="font-size: 24px;margin-bottom: .5em;margin-top: -68px;font-family: \'GSBQ\';">' . get_the_title($new_post->ID) . '</p>';
                        $the_img = MultiPostThumbnails::the_post_thumbnail('jht_tub', 'three-quarter', $new_post->ID, 'large');
                        echo '<p class="request-pricing_tub-seo" style="font-size: 24px;margin-top: 10px;font-family: \'GSBQ\';">' . esc_attr($jht_info['topheadline']) . '</p>';
                    }
                    else { ?>
                        <p style="font-size: 24px;margin-bottom: .5em;margin-top: -68px;font-family: 'GSBQ';"></p>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/quote/RequestQuoteDefaultTubs.png" />
                    <?php } ?>
                </div>
            </div>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
