<?php
/**
 * Template Name: NewLanding 1b
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

avala_form_submit();

wp_enqueue_style('Lato', 'http://fonts.googleapis.com/css?family=Lato:400,900');

get_header( 'newdirect' );

if ( have_posts() ) while ( have_posts() ) : the_post();

?>
<div id="main-wrapper">
	<div class="page-header" id="page-header">
    	<div class="content center">
        	<div class="block span1of1">
            	<h1><strong class="small">The Jacuzzi Brochure </strong>40 Pages of Facts &amp; Photos - <strong>Free</strong></h1>
                <h2>Get instant access to model comparison charts, stunning photos,<br />complete specifications and feature descriptions.</h2>
            </div>
            <form action="http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" method="post" id="leadForm" class="pform bro">

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

                <table width="761">
                    <tr>
                        <td width="490" style="vertical-align: top">
                            <table width="490">
                                <tr>
                                    <td width="245">
                                        <?php avala_field('first_name', 'text full', true, 'field', array('size'=>"14", 'placeholder'=>"First Name", 'required'=>"required" )); ?>
                                    </td>
                                    <td width="245">
                                        <?php avala_field('last_name', 'text full', true, 'field', array('size'=>"15", 'placeholder'=>"Last Name", 'required'=>"required" )); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php avala_field('postal_code', 'text full', true, 'field', array('size'=>"7", 'placeholder'=>"Zip", 'required'=>"required" )); ?>
                                    </td>
                                    <td>
                                        <?php avala_field('email', 'text full email', true, 'field', array('size'=>"20", 'placeholder'=>"Email", 'required'=>"required" )); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <?php avala_field('newsletter', 'dark-text', false, 'field'); ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td width="271" style="vertical-align: middle">
                            <input type="submit" value="Download Now" class="bigGoldBtn taller" />
                            <a id="click-me-spot" name="more-info"></a>
                        </td>
                    </tr>
                </table>
            </form>
            <a id="click-me-anchor" href="#more-info"></a>

<script type="text/javascript"> if (!window.mstag) mstag = {loadTag : function(){},time : (new Date()).getTime()};</script> <script id="mstag_tops" type="text/javascript" src="//flex.atdmt.com/mstag/site/2007fee5-1f40-4bc4-b858-08ac4cb4c99b/mstag.js"></script> <script type="text/javascript"> mstag.loadTag("analytics", {dedup:"1",domainId:"1183768",type:"1",revenue:"250",actionid:"28343"})</script> <noscript> <iframe src="//flex.atdmt.com/mstag/tag/2007fee5-1f40-4bc4-b858-08ac4cb4c99b/analytics.html?dedup=1&domainId=1183768&type=1&revenue=250&actionid=28343" frameborder="0" scrolling="no" width="1" height="1" style="visibility:hidden;display:none"> </iframe> </noscript>
        </div>
    </div>
    <section class="section">
    	<div class="content" role="main">
            <article class="row swap">
                <div class="col span1of2 normalize middle">
                    <h2>Easily Compare Models Side-by-Side</h2>
                    <ul>
                    	<li>Find the right hot tub for you</li>
                        <li>Select sizes, features &amp; options</li>
                        <li>Use as an all-in-one reference guide</li>
                    </ul>
                </div>
                <div class="block span1of2 middle">
                    <div class="overflow-left-2of3">
                        <figure class="align-right">
                            <div class="img span1of1">
                           	 <img src="<?php bloginfo('template_url'); ?>/images/landing/brochure-495.jpg" alt="" />
                            </div>
                        </figure>
                    </div>
                </div>
            </article>
        	<article class="row">
            	<div class="col span1of2 normalize middle">
                    <h2>Learn About the Power of Hydrotherapy</h2>
                    <ul>
                    	<li>3 proven wellness effects of hydrotherapy</li>
                        <li>Simple guide to jets and the muscle groups they massage</li>
                        <li>See precise jet placement in each model, and how each seat targets key stress points</li>
                    </ul>
				</div>
                <div class="block span1of2 middle">
                	<div class="overflow-right-1of2">
                        <figure class="span1of1">
                            <div class="img">
                            	<img src="<?php bloginfo('template_url'); ?>/images/landing/brochure-hydrotherapy.jpg" alt="" />
                            </div>
                        </figure>
                	</div>
                </div>
			</article>
            <article class="row swap">
                <div class="col span1of2 normalize middle">
                    <h2>See How Easy it is to Own and Enjoy a Jacuzzi Hot Tub</h2>
                    <ul>
                    	<li>Built-in, care-free maintenance systems</li>
                        <li>Water purification technology that uses no chemicals</li>
                        <li>Easy financing with instant online pre-approvals</li>
                    </ul>
                </div>
                <div class="block span1of2 middle">
                    <div class="overflow-left-2of3">
                        <figure class="align-right">
                            <div class="img span1of1">
                           	 <img src="<?php bloginfo('template_url'); ?>/images/landing/brochure-enjoy.jpg" alt="" />
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
                    <img src="<?php bloginfo('template_url'); ?>/images/landing/edward.jpg" alt="Edward Aleman, Jacuzzi Hot Tub Owner" class="alignleft" width="45" height="45" /><blockquote>&ldquo;As we continued to do research...the name that continued to pop up was the Jacuzzi brand. The quality of the tub as I compared them to other tubs really stood out for me.&rdquo; <strong class="by">Edward Aleman, Jacuzzi Hot Tub Owner</strong></blockquote>
                </div>
                <div class="col span1of2 normalize middle">
                    <img src="<?php bloginfo('template_url'); ?>/images/landing/10yearwarranty.jpg" alt="10 Year Warranty" class="alignleft" /><h3>Rely on our Comprehensive Warranty&nbsp;Protection</h3>
                    <p>Jacuzzi stands behind its products with comprehensive warranties and a global network of authorized dealers.</p>
                </div>
            </article>
            <article class="row grad lastbro">
                <div class="col span1of1">
                	<h3><img src="<?php bloginfo('template_url'); ?>/images/landing/brochure.png" alt="Brochure" class="alignleft brochure" />40 PAGES OF FACTS &amp; PHOTOS <a href="#download" class="btn alignright">Download Your Free Brochure Today</a></h3>
                </div>
            </article>
		</div>
    </section>
</div>
<?php endwhile; // end of the loop. ?>
<?php get_footer( 'newdirect' ); ?>