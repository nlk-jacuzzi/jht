<?php
/**
 * Template Name: Jacuzzi Brochure (one page)
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

//avala_form_submit();

wp_enqueue_style('Lato', 'http://fonts.googleapis.com/css?family=Lato:400,900');

get_header( 'newdirect' );

if ( have_posts() ) while ( have_posts() ) : the_post();

?>
<style type="text/css">
		/* Template related gform css */
		.gform_wrapper .gform_footer input.button, .gform_wrapper .gform_footer input[type="submit"] {
		    border-radius: 5px;
		    font-size: 1.5em !important;
		    margin-bottom: 0 !important;
		    margin-left: 24px;
		    padding: 0.63125em 1.3em 0.531em;
			-webkit-box-shadow: 0px 5px 10px 0px rgba(136, 133, 142, 0.75);
			-moz-box-shadow:    0px 5px 10px 0px rgba(136, 133, 142, 0.75);
			box-shadow:         0px 5px 10px 0px rgba(136, 133, 142, 0.75);
			color: #fff;
		}
		
		.gform_wrapper {
    		margin: 0;
		}
		
		.gform_body
		{
			xmargin-left: 24px;
			width: 545px;
		}	
		
		.gform_wrapper .gform_footer {
		    clear: both;
		    margin: 10px 0 0;
		    padding: 10px 0;
		}
		
		.gform_wrapper .gform_footer {
		    clear: both;
		    margin: 16px 0 0;
		    padding: 16px 0 8px !important;
		}
		
		.gform_wrapper ul li.gfield {
		    margin-bottom: 7px !important;
		}
		
		.gform_wrapper {
		    xmargin: 10px 0;
		    xmax-width: 72% !important;
		    xoverflow: inherit;
		    xposition: relative;
			xmax-width: 572px !important;
			xmargin-top: 20px !important;
		}
		
		.gform_wrapper .gform_footer {
		    clear: both;
		    margin: 16px 0 0;
		    padding: 16px 0 10px;
		    position: absolute;
			right: -299px;
			top: 6px;
		}
		
		
		.gform_wrapper input[type="text"], .gform_wrapper input[type="url"], .gform_wrapper input[type="email"], .gform_wrapper input[type="tel"], .gform_wrapper input[type="number"], .gform_wrapper input[type="password"]
		{
				border-radius: 5px  !important;
			    font-family: inherit;
			    font-size: 12px  !important;
			    color: #666;	
		}
		
		.gform_wrapper .top_label .gfield_label {
		    clear: both;
		    display: inline-block;
		    font-weight: bold;
		    line-height: 1.3em;
		    margin: 10px 0 4px;
		    xmin-height: 35px;
		}
		
		.gform_wrapper .top_label .gf_right_half .gfield_label, .gform_wrapper .top_label .gf_left_third .gfield_label,  .gform_wrapper .top_label .gf_middle_third .gfield_label
		{
			min-height: 30px;
			margin-top: 0px;
		}
		
		span.requiredSpan
		{
			display: block;
			margin: 10px 0px;
			text-align: center;
			font-style: italic;
			color: #414141;
			font-size: 12px;
			line-height: 12px;	
		}
		
		.gplaceholder label
		{
			display: none !important;
		}
		
		.gform_wrapper .ginput_complex input[type="text"] {
		    width: 268px;
		    height: 28px;
		    margin: 0px 0px 8px;
		    display: block;
		    box-sizing: border-box;
		}
		
		.gform_wrapper .top_label .gfield_label 
		{
			xwidth: 180px;
			color: #000;
			font: 700 12px/14.5px arial;
			xmax-width: 180px;
			margin-top: 0px !important;
			margin-bottom: 0px !important;
		}
		
		.gform_wrapper .gfield_checkbox li label, .gform_wrapper .gfield_radio li label
		{
			color: #000;
			font: 700 12px/14.5px arial;
			margin-top: 3px !important;
		}	
		
		.checkbox-field .gfield_label
		{
			display: none !important;	
		}	
		
		.gform_wrapper .top_label li.gfield.gf_left_third select.medium, .gform_wrapper .top_label li.gfield.gf_middle_third select.medium, .gform_wrapper .top_label li.gfield.gf_right_third select.medium, .gform_wrapper .top_label li select.medium
		{
		    border: 1px solid #CCC;
		    border-radius: 2px;
		    position: relative;
		    top: 2px;
		    height: 25px;
		    line-height: 25px;
		    background: none repeat scroll 0% 0% #FFF;
		    font-size: 12px;
		    margin-bottom: 0px;
		}
		
		body .gform_wrapper label.gfield_label + div.ginput_container {
		    margin-top: 0px !important;
		}
		
		#land #page-header .content.ab-b form.bro {
		    top: 525px;
		    left: 156px;
		}
		
		.gform_wrapper div.validation_error, .gform_wrapper .ginput_container + .gfield_description.validation_message
		{
			display: none  !important;
		}
		
		.gform_wrapper li.gfield.gfield_error, .gform_wrapper li.gfield.gfield_error.gfield_contains_required.gfield_creditcard_warning
		{
			background-color: none !important;
			margin-bottom: 6px !important;
			padding: 0px !important;
			border-top: 0px !important;
			border-bottom: 0px !important;
		}	
		
		.gform_wrapper li.gfield.gfield_error.gfield_contains_required
		{
			padding: 0px !important;
		}
		
		li.email-right
		{
			position: absolute;
			width: 100%;
			top: 0px;
			left: 562px;
		}
		
		.emailblock
		{
			margin-top: 35px !important;				
		}	
	</style>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('.gform_footer').append('<p><small><i>* indicates required field<br><a href="<?php echo get_permalink(3987) ?>">Privacy policy.</a></i></small></p><a id="click-me-spot" name="more-info"></a>');
		});
	</script>
<div id="main-wrapper">
	<div class="page-header" id="page-header">
    	<div class="content center ab-b">
        	<div class="block span1of1">
            	<h1><strong class="small">THE JACUZZI HOT TUB BROCHURE </strong>25 Pages of Facts &amp; Photos - <strong>Free</strong></h1>
                <h2>Get instant access to Jacuzzi® Hot Tub features , stunning lifestyle photos,<br />collection descriptions and more.</h2>
            </div>
            <?php echo do_shortcode('[gravityform id="13" name="Download a Free Jacuzi Hot Tub Brochure Today" title="false" description="false"]'); ?>
            <?php /* ?><form action="http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" method="post" id="leadForm" class="pform bro">

                <?php avala_hidden_fields( 15, 9, 12 ); ?>

                <span class="errors"><?php
                global $wp_query;
                $errors = false;
                if(isset($wp_query->query_vars['jht_formerrors']) && ( count($wp_query->query_vars['jht_formerrors']) > 0) ) {
                	foreach( $wp_query->query_vars['jht_formerrors'] as $err ) {
                		echo "$err<br />";
                	}
                }
                ?></span>

                <table width="870">
                    <tr>
                        <td width="490" style="vertical-align: top">
                            <table width="580">
                                <tr>
                                    <td width="270">
                                        <?php avala_field('first_name', 'text full', true, 'field', array('size'=>"14", 'placeholder'=>"First Name *", 'required'=>"required" )); ?>
                                    </td>
                                    <td width="270">
                                        <?php avala_field('last_name', 'text full', true, 'field', array('size'=>"15", 'placeholder'=>"Last Name *", 'required'=>"required" )); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php
                                            $geo = geo_data();
                                            $geoa = $geo['country'];
                                            $geob = ( strpos($_SERVER['HTTP_HOST'], '.ca') ) ? true : false ;
                                            $zipPostal = ( $geoa == 'CA' || $geob == true ) ? 'Postal Code *' : 'Zip *';
                                            avala_field('postal_code', 'text full', true, 'field', array('size'=>"7", 'placeholder'=>$zipPostal, 'required'=>"required" )); ?>
                                    </td>
                                    <td>
                                        <?php avala_field('email', 'text full email', true, 'field', array('size'=>"20", 'placeholder'=>"Email *", 'required'=>"required" )); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <table rel="threeRow">
                                            <tr>
                                                <td width="200">
                                                    <span class="thefield"><?php avala_field('currently_own', '', false, 'all', '', 'select', 'Have you ever owned a hot tub?'); ?></span>
                                                </td>
                                                <td width="200">
                                                    <span class="thefield"><?php avala_field('buy_time_frame', '', false, 'all', '', 'select'); ?></span>
                                                </td>
                                                <td width="200">
                                                    <span class="thefield"><?php avala_field('product_use', '', false, 'all', '', 'select', 'What is the primary benefit you are looking for in a hot tub?'); ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <?php avala_field('newsletter', '', false, 'field' ); ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                            </table>
                        </td>
                        <td width="271" style="padding: 30px 0 0 10px;">
                            <input type="submit" value="Download Now" class="bigGoldBtn taller" onClick="_gaq.push(['_trackEvent', 'lead', 'brochure-full']);" style="max-width: 184px;" />
                            <p><small><i>* indicates required field<br><a href="<?php echo get_permalink(3987) ?>">Privacy policy.</a></i></small></p>
                            <a id="click-me-spot" name="more-info"></a>
                        </td>
                    </tr>
                </table>
            </form>
			 
			 */?>
            <a id="click-me-anchor" href="#more-info"></a>

                <script type="text/javascript"> if (!window.mstag) mstag = {loadTag : function(){},time : (new Date()).getTime()};</script> <script id="mstag_tops" type="text/javascript" src="//flex.atdmt.com/mstag/site/2007fee5-1f40-4bc4-b858-08ac4cb4c99b/mstag.js"></script> <script type="text/javascript"> mstag.loadTag("analytics", {dedup:"1",domainId:"1183768",type:"1",revenue:"250",actionid:"28343"})</script> <noscript> <iframe src="//flex.atdmt.com/mstag/tag/2007fee5-1f40-4bc4-b858-08ac4cb4c99b/analytics.html?dedup=1&domainId=1183768&type=1&revenue=250&actionid=28343" frameborder="0" scrolling="no" width="1" height="1" style="visibility:hidden;display:none"> </iframe></noscript>

        </div>
    </div>
    <section class="section">
    	<div class="content" role="main">
            <article class="row swap">
                <div class="col span1of2 normalize middle">
                    <h2>Easily See Hot Tub Models Side-by-Side</h2>
                    <ul>
                    	<li>Find the right hot tub for you</li>
                        <li>Explore sizes, features &amp; options</li>
                        <li>Use as an all-in-one reference guide</li>
                    </ul>
                </div>
                <div class="block span1of2 middle">
                    <div class="overflow-left-2of3">
                        <figure class="align-right">
                            <div class="img span1of1">
                           	 <img src="<?php bloginfo('template_url'); ?>/images/landing/easy_compare.png" alt="" />
                            </div>
                        </figure>
                    </div>
                </div>
            </article>
            <article class="row">
            	<div class="col span1of2 normalize middle">
                    <h2>Learn About the Power of Hydromassage</h2>
                    <ul>
                    	<li>Reduces stress and improves sleep through warm water</li>
                        <li>Relieves pain through targeted jet action</li>
                        <li>Customizeable hydromassage experience through adjustable jets</li>
                    </ul>
				</div>
                <div class="block span1of2 middle">
                	<div class="overflow-right-1of2">
                        <figure class="span1of1">
                            <div class="img">
                            	<img src="<?php bloginfo('template_url'); ?>/images/landing/learn_about.png" alt="" />
                            </div>
                        </figure>
                	</div>
                </div>
			</article>
        	<article class="row swap">
                <div class="col span1of2 normalize middle">
                    <h2>See How Easy it is to Own and Enjoy a Jacuzzi® Hot Tub</h2>
                    <ul>
                    	<li>Award-winning water purification system for cleaner water with fewer chemicals</li>
                        <li>Less maintenance equals more time to enjoy your hot tub</li>
                        <li>Built-in energy efficiency</li>
                    </ul>
                </div>
                <div class="block span1of2 middle">
                    <div class="overflow-left-2of3">
                        <figure class="align-right">
                            <div class="img span1of1">
                           	 <img src="<?php bloginfo('template_url'); ?>/images/landing/see_how_easy.png" alt="" />
                            </div>
                        </figure>
                    </div>
                </div>
            </article>
            <article class="row awards">
                <div class="col span1of1">
                	<h3>Awards &amp; Recognition<img src="<?php bloginfo('template_url'); ?>/images/landing/brochure-awards.jpg" alt="Awards" class="alignright" /></h3>
                </div>
            </article>
            <article class="row grad">
                <div class="col span1of2 normalize middle">
                    <img src="<?php bloginfo('template_url'); ?>/images/landing/edward.jpg" alt="Edward Aleman, Jacuzzi Hot Tub Owner" class="alignleft" width="45" height="45" /><blockquote>&ldquo;As we continued to do research...the name that continued to pop up was the Jacuzzi Brand. The quality of the tub as I compared them to other tubs really stood out for me.&rdquo; <strong class="by">Edward Aleman, Jacuzzi Hot Tub Owner</strong></blockquote>
                </div>
                <div class="col span1of2 normalize middle">
                    <img src="<?php bloginfo('template_url'); ?>/images/landing/10yearwarranty.jpg" alt="10 Year Warranty" class="alignleft" /><h3>Rely on our Comprehensive Warranty&nbsp;Protection</h3>
                    <p>Jacuzzi stands behind its products with comprehensive warranties and a global network of authorized dealers.</p>
                </div>
            </article>
            <article class="row grad lastbro">
                <div class="col span1of1">
                	<img src="<?php bloginfo('template_url'); ?>/images/landing/bottom_brochure.png" alt="Brochure" class="alignleft brochure" />
                    <h3>25 PAGES OF FACTS &amp; PHOTOS</h3>
                    <?php /* ?><span>Discover why Jacuzzi<sup>&copy;</sup> defines the hot tub experience through its high-performance products that celebrate water's ability to refresh and rejuvenate.</span><?php */ ?>
                    <a id="to-download-form" class="btn alignright">Download Your Free Brochure Today</a>
                </div>
            </article>
		</div>
    </section>
</div>
<?php endwhile; // end of the loop. ?>
<?php get_footer( 'newdirect' ); ?>
