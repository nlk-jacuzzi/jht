<?php
/**
 * Template Name: J-500 Collections
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

get_header();
 ?>
 <link href="<?php bloginfo('template_url'); ?>/css/jquery.bxslider.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/j-500.css">
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.bxslider.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('.bxslider').bxSlider({
		  auto: true,
    	  pager: true,
		  autoControls: false,
		  mode: 'fade',
		  controls: false
		});
		
		jQuery(document).on('click', '.anchorscroll', function(e) {
		    // target element id
		    var id = jQuery(this).attr('href');
		
		    // target element
		    var $id = jQuery(id);
		    if ($id.length === 0) {
		        return;
		    }
		
		    // prevent standard hash navigation (avoid blinking in IE)
		    e.preventDefault();
		
		    // top position relative to the document
		    var pos = jQuery(id).offset().top - 200;
		
		    // animated top scrolling
		    jQuery('body, html').animate({scrollTop: pos});
		});
		
		jQuery('.open-modal-iframe').click( function() {
			jQuery('#vimeovideo').attr('src', '//player.vimeo.com/video/113983094?title=0&amp;byline=0&amp;portrait=0&amp;color=ff9933&amp;autoplay=1');
			
			jQuery('body').append('<div class="black-out">');
			var importModalContentId = jQuery(this).attr('rel');
			jQuery('#' + importModalContentId).clone().appendTo('.black-out').addClass('shownModal').removeClass('hiddenModal');
			jQuery('#' + importModalContentId + '.shownModal').append('<div class="close-modal"></div>');
			var wl		= jQuery('#' + importModalContentId).width() / 2,
				wt		= jQuery('#' + importModalContentId).height() / 2,
				ww		= jQuery( window ).width() / 2,
				wh		= jQuery( window ).height() / 2,
				left	= ww - wl,
				top		= wh - wt;
			jQuery('#' + importModalContentId + '.shownModal').css('margin-left', left + 'px').css('margin-top', top + 'px');
			jQuery('div.black-out').fadeIn();
		});
	});
</script>
<div class="hd shd">
	<div class="wrap" id="j500-menu">
		<ul>
			<li>
				<a href="#introdoction" class="anchorscroll">INTRODUCTION</a>
			</li>
			<li>
				<a href="#revo-design" class="anchorscroll">DESIGN</a>
			</li>
			<li>
				<a href="#hydromessage" class="anchorscroll">HYDROMASSAGE</a>
			</li>
			<li>
				<a href="#technology" class="anchorscroll">TECHNOLOGY</a>
			</li>
			<li>
				<a href="#models" class="anchorscroll">MODELS</a>
			</li>
			<li class="brochure-li">
				<a href="<?php bloginfo('url'); ?>/request-brochure/" class="bigGoldBtn menubtn">DOWNLOAD BROCHURE</a>
			</li>
		</ul>
	</div>
</div>
<section id="introdoction">
	<div class="wrap">
		<div class="banner-block">
			<h1>REVOLUTIONARY DESIGN,</h1>
			<h2>LEGENDARY PERFORMANCE</h2>
			<p>
				With the market cornered in advanced hydromassage, the J-500™ Collection combines innovative technology and ground-breaking hot tub design. The new series features a unique curve design and outer architectural lighting never seen before. They also bring an exterior skirt design inspired from woven textiles that steal the spotlight. Regardless of which model you choose, the J-500™ Collection does more than enhance your wellbeing; it makes a statement.
			</p>
			<p>
				<a href="#" class="play-video-btn open-modal-iframe" rel="vimeo-video">PLAY VIDEO</a>
			</p>
			<div id="vimeo-video" class="hiddenModal" style="width: 854px; height: 480px;">
				<iframe id="vimeovideo" src="#" width="854" height="480" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			</div>
		</div>
		<div class="tubs-block">
			<div class="eachtub">
				<div class="tub-thumb">
					<img src="<?php bloginfo('template_url'); ?>/images/j500/j-525.png"/>
				</div>
				<div class="tub-desc">
					<h3 class="text-uppercase">J-575™</h3>
					<ul class="list-unstyled">
						<li>
							<span class="text-uppercase">Seating:</span> 5-6 adults
						</li>
						<li>
							<span class="text-uppercase">Lounge:</span> Yes
						</li>
						<li>
							<span class="text-uppercase">Total Jets:</span> 53
						</li>
					</ul>
					<p class="fulldetailsp"><a href="<?php bloginfo('url'); ?>/j-500/j-575/" class="full-details-btn">FULL DETAILS</a></p>
				</div>
				<div class="clear"></div>
			</div>
			<div class="eachtub last">
				<div class="tub-thumb">
					<img src="<?php bloginfo('template_url'); ?>/images/j500/j-585.png"/>
				</div>
				<div class="tub-desc">
					<h3 class="text-uppercase">J-585™</h3>
					<ul class="list-unstyled">
						<li>
							<span class="text-uppercase">Seating:</span> 5-6 adults
						</li>
						<li>
							<span class="text-uppercase">Lounge:</span> No
						</li>
						<li>
							<span class="text-uppercase">Total Jets:</span> 52
						</li>
					</ul>
					<p class="fulldetailsp"><a href="<?php bloginfo('url'); ?>/j-500/j-585/" class="full-details-btn">FULL DETAILS</a></p>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</section>

<section id="revo-design">
		<div class="wrap">
			<div class="intro-section">
				<div class="left-desc">
					<h2 class="text-uppercase"><span>Revolutionary</span> Design</h2>
					<p>The J-500™ Collection will change the way you see hot tubs. Fiber optic ProEdge™ lighting technology on the inside perimeter and behind dual waterfalls make your hot tub glow. And the weather-proof Curvalux™ exterior skirt that mimics the tight weave of designer outdoor furniture blends seamlessly with your decor. Along with a contemporary silhouette and architectural exterior corner lights, the J-500™ Collection is as much of a design piece as it is a dynamic hydromassage experience. </p>
				</div>
				<div class="right-banner-j500 revo-right">
					
				</div>
				<div class="clear"></div>
			</div>
			<div class="hero-section-j500">
				<div class="slidewrapper">
					<ul class="bxslider">
						<li><img src="<?php bloginfo('template_url'); ?>/images/j500/design_slide1.jpg" /></li>
						<li><img src="<?php bloginfo('template_url'); ?>/images/j500/design_slide2.jpg" /></li>
						<li><img src="<?php bloginfo('template_url'); ?>/images/j500/design_slide3.jpg" /></li>
					</ul>
				</div>
				<div class="right-bullet-point">
					<ul class="list-unstyled">
						<li>CURVALUX™ DESIGNER<br>WOVEN EXTERIORS</li>
						<li>INTEGRATED CORNER<br>EXTERIOR LIGHTING</li>
						<li>PROEDGE™ INTERIOR ILLUMINATION</li>
						<li>SLEEK, MODERN SHAPE<br>WITH ELEVATED SILHOUETTE</li>
						<li>DUAL, MULTI-COLOR PROEDGE™ WATERFALLS</li>
						<li>HIDDEN CLIP SYSTEM SKIRT FOR EASY EQUIPMENT ACCESS</li>
						<li>WALL MOUNTED CONTROLS FOR SLEEK<br> DECK DESIGN</li>
						<li>ELEGANT LOGOED<br>CUSHIONED HEADRESTS</li>
					</ul>
				</div>
			</div>
		</div>
</section>
<section id="hydromessage">
		<div class="wrap">
			<div class="intro-section">
				<div class="left-desc">
					<h2 class="text-uppercase"><span>UNRIVALED</span><br/> HYDROMASSAGE </h2>
					<p>The J-500™ models still bring the same superior hydromassage for which the Jacuzzi<sup>®</sup> Brand is known. A wide variety of seating fosters comfort for people of varying heights, while a new hip jet makes its debut. And, combined with wrist jets in both a lounge and upright therapy seats, the J-500™ Collection has you covered from your neck down to your toes.</p>
				</div>
				<div class="right-banner-j500 hydro-right">
					
				</div>
				<div class="clear"></div>
			</div>
			<div class="hero-section-j500">
				<div class="slidewrapper">
					<ul class="bxslider">
						<li><img src="<?php bloginfo('template_url'); ?>/images/j500/hydromessage_slide1.jpg" /></li>
						<li><img src="<?php bloginfo('template_url'); ?>/images/j500/hydromessage_slide2.jpg" /></li>
						<li><img src="<?php bloginfo('template_url'); ?>/images/j500/hydromessage_slide3.jpg" /></li>
					</ul>
				</div>
				<div class="right-bullet-point">
					<ul class="list-unstyled">
						<li>NEW POWERPRO<sup>®</sup> FX MEDIUM JET</li>
						<li>UPGRADED RX THERAPY<br>
						SEAT AND LOUNGE</li>
						<li>NEW WRIST JET IN UPRIGHT SEAT</li>
						<li>INCREASED VARIETY IN<br>
						SEATING ELEVATIONS</li>
					</ul>
				</div>
			</div>
		</div>
</section>
<section id="technology">
		<div class="wrap">
			<div class="intro-section">
				<div class="left-desc">
					<h2 class="text-uppercase"><span>INNOVATIVE</span><br/> TECHNOLOGY</h2>
					<p>The latest in technology completes the J-500™ Collection. The ProTouch™ Control is the first in the industry to integrate glass touch-screen controls on your hot tub. And a new app lets you pair your J-500™ model with your smartphone so you can heat up your hot tub, program water care cycles and even alert both you and your local dealership of any service needs through remote monitoring regardless of where you are.</p>
				</div>
				<div class="right-banner-j500 techno-right">
					
				</div>
				<div class="clear"></div>
			</div>
			<div class="hero-section-j500">
				<div class="slidewrapper">
					<img src="<?php bloginfo('template_url'); ?>/images/j500/technology_slide1.jpg" />
				</div>
				<div class="right-bullet-point">
					<ul class="list-unstyled">
						<li>SMARTPHONE-ENABLED<br>
						PROTOUCH™ CONTROL</li>
						<li>APP FOR REMOTE MONITORING<br>
						AND MANAGEMENT</li>
					</ul>
				</div>
			</div>
		</div>
</section>
<section id="models">
	<div class="wrap">
		<div class="tubs-block">
			<div class="eachtub">
				<div class="tub-thumb">
					<img src="<?php bloginfo('template_url'); ?>/images/j500/j-525.png"/>
				</div>
				<div class="tub-desc">
					<h3 class="text-uppercase">J-575™</h3>
					<ul class="list-unstyled">
						<li>
							<span class="text-uppercase">Seating:</span> 5-6 adults
						</li>
						<li>
							<span class="text-uppercase">Lounge:</span> No
						</li>
						<li>
							<span class="text-uppercase">Total Jets:</span> 53
						</li>
					</ul>
					<p class="fulldetailsp"><a href="<?php bloginfo('url'); ?>/j-500/j-575/" class="full-details-btn">FULL DETAILS</a></p>
				</div>
				<div class="clear"></div>
			</div>
			<div class="eachtub last">
				<div class="tub-thumb">
					<img src="<?php bloginfo('template_url'); ?>/images/j500/j-585.png"/>
				</div>
				<div class="tub-desc">
					<h3 class="text-uppercase">J-585™</h3>
					<ul class="list-unstyled">
						<li>
							<span class="text-uppercase">Seating:</span> 5-6 adults
						</li>
						<li>
							<span class="text-uppercase">Lounge:</span> Yes
						</li>
						<li>
							<span class="text-uppercase">Total Jets:</span> 52
						</li>
					</ul>
					<p class="fulldetailsp"><a href="<?php bloginfo('url'); ?>/j-500/j-585/" class="full-details-btn">FULL DETAILS</a></p>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</section>
<div class="bd wrap">

<?php get_footer(); ?>
