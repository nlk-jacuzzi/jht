<?php
/**
 * 
 *
 * This is the template that displays all coupons by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

get_header('blank');
?>
<link href="<?php bloginfo('template_url'); ?>/css/bootstrap.min.css" rel="stylesheet">	
<link href="<?php bloginfo('template_url'); ?>/css/coupon.css" rel="stylesheet">
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#printcoupon').click(function(e){
            e.preventDefault();
            var w = window.open();
            var printOne = jQuery('.coupon_cutout').html();
            w.document.write('<html><head><title>Coupon Printed</title></head><body><h1>Coupon Printed</h1><hr />' + printOne) + '</body></html>';
            w.window.print();
            w.document.close();
            return false;
        });
    });
</script>


<?php
if ( have_posts() ) while ( have_posts() ) : the_post();
	$banner_img = get_field('banner_bacgkround_desktop');
	?>
	<script type="text/javascript">var switchTo5x=true;</script>
	<script type="text/javascript">var switchTo5x=true;</script>
	<script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
	<script type="text/javascript">stLight.options({publisher: "75f7878f-3534-44fe-8ded-7955f92aed01", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
	<div class="wrapper coupon_head">
		<div class="wrap">
			<div class="inner">
				<div class="row">
					<div class="col-xs-12 col-sm-3 col-md-2 logosection">
						<h1><a href="#">Jacuzzi</a></h1>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-6 taglinesection">
						<h2>Aqua Paradise Hot Tubs & Spas. San Diego</h2>
					</div>
					<div class="col-xs-12 col-sm-5 col-md-4 shareicons">
						<ul>
							<li>Share This</li>
							<li><span class='st_email_large' displayText='Email'></span></li>
							<li><span class='st_twitter_large' displayText='Tweet'></span></li>
							<li><span class='st_facebook_large' displayText='Facebook'></span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
    <div class="wrapper banner-section" style="background-image: url('<?php echo $banner_img ?>'); ">
    	<div class="wrap">
        	<div class="row">
            	<div class="col-xs-12 col-sm-8 col-md-7">
            		<?php the_field('banner_text'); ?>
            	</div>
            	<span class="arrow_down"></span>
            </div>
        </div>
    </div>
    <div class="wrapper main-wrap">
    	<div class="wrap">
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 mainsection">
                	<div class="main-content">
                		<h2><?php the_field('introductory_head'); ?></h2>
                		<div class="coupon_container">
                			<div class="coupon_cutout">
                				<a href="<?php the_field('coupon_pdf'); ?>"><img src="<?php the_field('coupon_cutout'); ?>" class="img-responsive img-coupon" /></a>
                			</div>
                			<div class="coupon_action">
                				<div class="row">
                					<div class="col-xs-6 col-sm-4 col-md-4 get_coupon">
                						<a href="<?php the_field('coupon_pdf'); ?>" id="xprintcoupon" class="btn btn-primary btn-print">GET COUPON</a>
                					</div>
                					<div class="col-xs-6 col-sm-8 col-md-8 share_coupon">
                						<ul>
                							<li><span class='st_email_large' displayText='Email'></span></li>
                							<li class="share_all"><span class='st_sharethis_large' displayText='ShareThis'></span></li>
                						</ul>
                					</div>
                				</div>
                			</div>
                		</div>
                		<?php the_field('introductory_text'); ?>
                		<div class="bottom_content">
                			<?php the_content(); ?>
                		</div>
                	</div>
                </div>
               <div class="col-xs-12 col-sm-4 col-md-4 sidebarsection">
                	<div class="eachSidebarWidget eventLocation">
                		<h3>Event Location</h3>
                		<?php the_field('event_location'); ?>
                	</div>
                	<div class="eachSidebarWidget googleMap">
                		<?php the_field('google_map_code'); ?>
                		<a href="<?php the_field('get_direction_link'); ?>" class="btn btn-primary btn-direction">Get Directions</a>
                	</div>
                	<div class="eachSidebarWidget">
                		<h3>Hours</h3>
                		<?php the_field('hours_of_operation'); ?>
                	</div>
                </div>
            </div>
        </div>
	</div>    
    <div class="wrapper footer_section">
    	<div class="wrap">
    		<div class="inner">
    			<div class="row cta_section">
    				<div class="col-xs-12 col-sm-4 col-md-4">
    					<h3>Jacuzzi® Brochure</h3>
						<h4>LIFESTYLE photos, facts & more</h4>
						<a href="#">Get your Free Brochure</a>
    				</div>
    				<div class="col-xs-12 col-sm-4 col-md-4">
    					<h3>Get Pricing</h3>
						<h4>On Your Perfect Hot Tub</h4>
						<a href="#">Get My Pricing</a>
    				</div>
    				<div class="col-xs-12 col-sm-4 col-md-4">
    					<h3>HOT TUB SELECTOR</h3>
						<h4>DISCOVER YOUR PERFECT MODEL</h4>
						<a href="#">IN 3 EASY STEPS</a>
    				</div>
    			</div>
    			<div  class="row social_icons">
    				<div class="col-xs-12">
    					<ul>
    						<li class="facebookli"><a href="http://www.facebook.com/jacuzziofficial">Facebook</a></li>
    						<li class="twitterli"><a href="http://twitter.com/jacuzziofficial">Twitter</a></li>
    						<li class="youtubeli"><a href="http://www.youtube.com/jacuzziofficial">Youtube</a></li>
    						<li class="googleli"><a href="#">Google+</a></li>
    					</ul>
    				</div>
    			</div>
    		</div>
    	</div>	
    </div>        
<?php endwhile; // end of the loop. ?>
<?php get_footer('blank'); ?>
