<?php
/**
 * Template Name: Deals Landing
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 2.012
 */
wp_enqueue_script('thickbox'); 

avala_form_submit();

get_header('landing');
if ( have_posts() ) while ( have_posts() ) : the_post();

global $post;
?>
<div class="wrap">
    <div class="top">
        <div class="hdr"><span class="title">There's Only One</span></div>
        <div class="dslides">
            <div class="dslide onn">
            <?php
			if ( has_post_thumbnail() ) {
				$attr = array();
				
				$imgmap = get_post_meta($post->ID, 'jht_imgmap', true);
				if ( $imgmap != '' ) {
					$attr['usemap'] = '#jhtmap';
				}
				
				the_post_thumbnail('original', $attr);
				if ( $imgmap != '' ) {
					echo '<map name="jhtmap" id="jhtmap">'. $imgmap .'</map>';
				}
			} else { ?>
            	<img src="<?php bloginfo('template_url'); ?>/images/landing/slide1.jpg" width="651" height="519" alt="" />
			<?php } ?>
            </div>
            <?php /*
            <div class="dslide">
            	<a href="http://www.youtube.com/embed/Y5-yhuAndAM?autoplay=1&amp;rel=0&amp;KeepThis=true&amp;TB_iframe=true" class="thickbox"><img src="<?php bloginfo('template_url'); ?>/images/landing/slide2.jpg" alt="" height="519" width="651" /></a>
            </div>
            <div class="dslide">
            	<a href="http://www.youtube.com/embed/LVC1q-Ygd-Y?autoplay=1&amp;rel=0&amp;KeepThis=true&amp;TB_iframe=true" class="thickbox"><img src="<?php bloginfo('template_url'); ?>/images/landing/slide3.jpg" alt="" height="519" width="651" /></a>
            </div>
            <div class="dslide">
            	<a href="http://www.youtube.com/embed/IP2xf4_Kf9w?autoplay=1&amp;rel=0&amp;KeepThis=true&amp;TB_iframe=true" class="thickbox"><img src="<?php bloginfo('template_url'); ?>/images/landing/slide4.jpg" alt="" height="519" width="651" /></a>
            </div>
			*/ ?>
        </div>
        <?php
		if ( is_page('thank-you') ) {
    echo '<div class="dform thx"><div class="ftop">Thank You</div>';
    the_content();
	echo '</div>';
		} else {
			get_sidebar('dealsform');
		}
		?>
    </div>
    <?php if ( is_page('thank-you') ) { ?>
    <div>&nbsp;</div>
    <div class="vids_title">Watch New Jacuzzi Commercials</div>
    <div>&nbsp;</div>
    <div class="vids">
        <div id="vplayer">
        	<iframe width="631" height="386" src="http://www.youtube.com/embed/oucVKflU7kk?autohide=0&rel=0&showinfo=0" frameborder="0" allowfullscreen></iframe>
        </div>
        <div id="vthms">
            <a href="http://www.youtube.com/embed/oucVKflU7kk"><img src="<?php bloginfo('template_url'); ?>/images/landing/vid1t.jpg" alt="" height="122" width="310" /></a>
            <a href="http://www.youtube.com/embed/Qp3DuYIUmKg"><img src="<?php bloginfo('template_url'); ?>/images/landing/vid2t.jpg" alt="" height="122" width="310" /></a>
            <a href="http://www.youtube.com/embed/3jj3alx5Ijs"><img src="<?php bloginfo('template_url'); ?>/images/landing/vid3t.jpg" alt="" height="122" width="310" /></a>
        </div>
    <?php } else { ?>
    <div class="vids">
        <a href="http://www.youtube.com/embed/Y5-yhuAndAM?autoplay=1&amp;rel=0&amp;KeepThis=true&amp;TB_iframe=true" class="thickbox"><img src="<?php bloginfo('template_url'); ?>/images/landing/vid1.jpg" alt="" height="175" width="309" /></a>
        <a href="http://www.youtube.com/embed/Qp3DuYIUmKg?autoplay=1&amp;rel=0&amp;KeepThis=true&amp;TB_iframe=true" class="thickbox mid"><img src="<?php bloginfo('template_url'); ?>/images/landing/vid2.jpg" alt="" height="175" width="309" /></a>
        <a href="http://www.youtube.com/embed/3jj3alx5Ijs?autoplay=1&amp;rel=0&amp;KeepThis=true&amp;TB_iframe=true" class="thickbox"><img src="<?php bloginfo('template_url'); ?>/images/landing/vid3.jpg" alt="" height="175" width="309" /></a>
        <?php } ?>
    </div>
    <div class="twoCol">
        <div class="lmain">
        	<h1>Step into award winning patented design</h1>
			<p>Jacuzzi&reg; is the name that defines the hot tub experience. Social and private, fun and relaxing, Jacuzzi completely satisfies and leaves you wanting more. Known for innovation, Jacuzzi is the company that started the modern hot tub industry. See what’s new from the industry leader at your local Jacuzzi hot tub dealer.</p>
            <table width="100%">
            <tr><td width="197"><img src="<?php bloginfo('template_url'); ?>/images/landing/clearray.jpg" alt="" height="180" width="197" />
            <h3>Clear<strong>Ray</strong>&trade;</h3>
            <p>CLEARRAY&trade; Water Purification system treats water using exclusive UV-C technology, which means no gas, chemical, or other by-products are added to the water or produced as a result.<br />
<a href="<?php bloginfo('url'); ?>/accessories/clearray/">LEARN MORE</a></p>
            </td>
            <td width="21">&nbsp;</td>
            <td width="197"><img src="<?php bloginfo('template_url'); ?>/images/landing/collections.jpg" alt="" height="180" width="197" />
            <h3>The Collections</h3>
            <p>With so many models to choose from, there's a relaxing Jacuzzi hot tub to fit any home and budget. Jacuzzi produces a complete line of affordable spas and hot tubs in a variety of sizes.
<br />
<a href="<?php bloginfo('url'); ?>/hot-tubs/">LEARN MORE</a></p></td>
            <td width="22">&nbsp;</td>
            <td width="197"><img src="<?php bloginfo('template_url'); ?>/images/landing/difference.jpg" alt="" height="180" width="197" />
            <h3>The Jacuzzi Difference</h3>
            <p>Jacuzzi believes hot tubs are about more than just hot water, so we provide high-performance innovative products that celebrate water's ability to refresh and rejuvenate in inspiring ways.
<br />
<a href="<?php bloginfo('url'); ?>/about/">LEARN MORE</a></p></td>
            </tr>
            </table>
            <div class="hr"></div>
            <h2><img src="<?php bloginfo('template_url'); ?>/images/landing/10yearwarranty.jpg" alt="10 year warranty" class="alignleft" height="136" width="140" />Jacuzzi offers a Warranty of up to 10 Years</h2>
            <p>When shopping for a hot tub, be sure to consider the warranty. Other brands guarantee's last 1 or 2 years, but our quality tubs feature limited warranties for up to 10 years! In addition, Jacuzzi's network of authorized dealers and technicians is standing by to ensure years of worry-free enjoyment. <a href="<?php echo get_permalink(4169); ?>">VIEW WARRANTY OPTIONS</a></p>
            <?php if( !is_page('thank-you') ) { ?>
            <div class="hr"></div>
            <a href="#top"><img src="<?php bloginfo('template_url'); ?>/images/landing/download.jpg" alt="Download Your Free Brochure" height="194" width="547" /></a>
        	<?php
    the_content();
			} ?>
        </div>
        <div class="lside">
        	<div class="lblock bb">
            	<a href="http://www.jacuzzi.com/baths/" class="bbtn2">View Baths Offer</a>
            </div>
            <?php /*
            <div class="lblock">
            	<h2><strong>Call today : </strong>877.411.5228</h2>
            </div>
			*/ ?>
            <div class="lblock">
			<?php wp_nav_menu( array( 'container' => 'false', 'menu_class' => 'lmenu', 'theme_location' => 'deal' ) ); ?>
            
            </div>
            <div class="lblock">
            	<h3>Read Our Blog</h3>
                <?php
$thispost = $post;
$myposts = get_posts('numberposts=4');
foreach($myposts as $post) : 
echo '<div class="lpost">';
$title = get_the_title();
echo '<a href="'. get_permalink() .'" title="Read \''. esc_attr($title) .'\'"><strong>'. esc_attr($title) .'</strong><span>READ MORE</span></a>';
echo '</div>';
endforeach;
$post = $thispost;
?>
            </div>
        </div>
    </div>
</div>
<script type='text/javascript'>
// Conversion Name: Landing Page
// INSTRUCTIONS
// The Conversion Tags should be placed at the top of the <BODY> section of the HTML page.
// In case you want to ensure that the full page loads as a prerequisite for a conversion
// being recorded, place the tag at the bottom of the page. Note, however, that this may
// skew the data in the case of slow-loading pages and in general not recommended.
//
// NOTE: It is possible to test if the tags are working correctly before campaign launch
// as follows:  Browse to http://bs.serving-sys.com/BurstingPipe/adServer.bs?cn=at, which is
// a page that lets you set your local machine to 'testing' mode.  In this mode, when
// visiting a page that includes an conversion tag, a new window will open, showing you
// the data sent by the conversion tag to the MediaMind servers.
//
// END of instructions (These instruction lines can be deleted from the actual HTML)
var ebRand = Math.random()+'';
ebRand = ebRand * 1000000;
//<![CDATA[
document.write('<scr'+'ipt src="HTTP://bs.serving-sys.com/BurstingPipe/ActivityServer.bs?cn=as&amp;ActivityID=194640&amp;rnd=' + ebRand + '"></scr' + 'ipt>');
//]]>
</script>
<noscript>
<img width="1" height="1" style="border:0" src="HTTP://bs.serving-sys.com/BurstingPipe/ActivityServer.bs?cn=as&amp;ActivityID=194640&amp;ns=1"/>
</noscript>
<?php endwhile; // end of the loop.

if ( is_page('thank-you') ) { // google tracking ?>
<!-- Google Code for Brochure Request Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 972980329;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "AcT5CPeqvwIQ6YD6zwM";
var google_conversion_value = 0;
if (250) {
  google_conversion_value = 250;
}
/* ]]> */
</script>
<script type="text/javascript"
src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt=""
src="http://www.googleadservices.com/pagead/conversion/972980329/?value=250&
amp;label=AcT5CPeqvwIQ6YD6zwM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<script type="text/javascript" src="http://inttrax.com/pixel.js?cid=15292&trid="></script>
<script type="text/javascript" src="http://inttrax.com/pixel.js?cid=15293&trid="></script>
<?php
}
if ( is_page('deals2') ) { // google tracking ?>
<script type='text/javascript'>
// Conversion Name: Deals2 Landing Page
// INSTRUCTIONS 
// The Conversion Tags should be placed at the top of the <BODY> section of the HTML page. 
// In case you want to ensure that the full page loads as a prerequisite for a conversion 
// being recorded, place the tag at the bottom of the page. Note, however, that this may 
// skew the data in the case of slow-loading pages and in general not recommended. 
//
// NOTE: It is possible to test if the tags are working correctly before campaign launch 
// as follows:  Browse to http://bs.serving-sys.com/BurstingPipe/adServer.bs?cn=at, which is 
// a page that lets you set your local machine to 'testing' mode.  In this mode, when 
// visiting a page that includes an conversion tag, a new window will open, showing you 
// the data sent by the conversion tag to the MediaMind servers. 
// 
// END of instructions (These instruction lines can be deleted from the actual HTML)
var ebRand = Math.random()+'';
ebRand = ebRand * 1000000;
//<![CDATA[ 
document.write('<scr'+'ipt src="HTTP://bs.serving-sys.com/BurstingPipe/ActivityServer.bs?cn=as&amp;ActivityID=212557&amp;rnd=' + ebRand + '"></scr' + 'ipt>');
//]]>
</script>
<noscript>
<img width="1" height="1" style="border:0" src="HTTP://bs.serving-sys.com/BurstingPipe/ActivityServer.bs?cn=as&amp;ActivityID=212557&amp;ns=1"/>
</noscript>

<?php
}
get_footer('landing'); ?>
