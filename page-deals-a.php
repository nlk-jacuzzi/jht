<?php
/**
 * Template Name: Deals Landing Page - A
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 2.012
 */
wp_enqueue_script('thickbox'); 

$errors = array();
if(isset($_POST[person])) {
	$postvars = http_build_query($_POST);
	$ch = curl_init();
	$url = 'http://jacuzzi.techbarn.com/service/jht_brochure';
	
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
	
	$data = curl_exec($ch);
	curl_close($ch);
	//echo $data;
	$xml = new SimpleXMLElement($data);
	foreach($xml->children() as $el => $child) {
		if($el == 'error') {
			$errors[] = $child;
		} else { //if($el == 'order_id') {
			wp_redirect('/deals/thank-you/');
			exit;
		}
	}
}

get_header();
if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div class="wrap" style="background:#fff;">
    <div class="top">
        <div class="hdr"></div><div style="position:absolute; z-index: 1000 !important; top: 36px; left: 185px;"><a href="<?php bloginfo('url'); ?>/hot-tubs/" style="position:relative; text-decoration:none;  z-index: 1000 !important; font: 14px/17px 'GSMT'; color: #e4e4e4; text-transform: uppercase;">Explore Tubs</a> <img style="padding-left:20px; padding-right:20px;" src="<?php bloginfo('template_url'); ?>/images/landing/deals-a-nav-spacer.jpg" width="2" height="21" alt="" /> <a href="<?php bloginfo('url'); ?>/hydrotherapy/" style="position:relative; text-decoration:none;  z-index: 1000 !important; font: 14px/17px 'GSMT'; color: #e4e4e4; text-transform: uppercase;">Experience Hydrotherapy</a></div>
        <div style="float: left; width: 651px; height: 667px; position: relative;">
            	<img src="<?php bloginfo('template_url'); ?>/images/landing/slide-a.png" width="651" height="478" alt="" /><a href="http://www.youtube.com/embed/Y5-yhuAndAM?autoplay=1&amp;rel=0&amp;KeepThis=true&amp;TB_iframe=true" class="thickbox"><img src="<?php bloginfo('template_url'); ?>/images/landing/vid1.png" alt="" height="158" width="217" /></a><a href="http://www.youtube.com/embed/LVC1q-Ygd-Y?autoplay=1&amp;rel=0&amp;KeepThis=true&amp;TB_iframe=true" class="thickbox mid"><img src="<?php bloginfo('template_url'); ?>/images/landing/vid2.png" alt="" height="158" width="217" /></a><a href="http://www.youtube.com/embed/IP2xf4_Kf9w?autoplay=1&amp;rel=0&amp;KeepThis=true&amp;TB_iframe=true" class="thickbox"><img src="<?php bloginfo('template_url'); ?>/images/landing/vid3.png" alt="" height="158" width="217" /></a>
            
        </div>
        <?php
		if ( is_page('thank-you') ) {
    echo '<div class="dform thx"><div class="ftop">Thank You</div>';
    the_content();
	echo '</div>';
		} else {
			get_sidebar('dealsform-a');
		}
		?>
    </div>
  
    <div class="twoCol"  style="background:#fff; padding-left:10px; padding-top:10px;">
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
            <table>
             <tr><td><a href="<?php bloginfo('url'); ?>/6-person-hot-tub/"><img src="<?php bloginfo('template_url'); ?>/images/landing/6-plus-people.jpg" border="0" width="206" height="224" /></a></td>
             <td style="padding-left:5px;"><a href="<?php bloginfo('url'); ?>/5-person-hot-tubs/"><img src="<?php bloginfo('template_url'); ?>/images/landing/5-6-people.jpg" border="0" width="206" height="224" /></a></td>
             <td style="padding-left:5px;"><a href="<?php bloginfo('url'); ?>/4-person-hot-tubs/"><img src="<?php bloginfo('template_url'); ?>/images/landing/4-5-people.jpg" border="0" width="206" height="224" /></a></td></tr>
            <tr><td><a href="<?php bloginfo('url'); ?>/3-person-hot-tub/"><img src="<?php bloginfo('template_url'); ?>/images/landing/4-less-people.jpg" border="0" width="206" height="224" /></a></td>
            <td style="padding-left:5px;"><a href="<?php bloginfo('url'); ?>/best-selling-hot-tubs/"><img src="<?php bloginfo('template_url'); ?>/images/landing/best-selling.jpg" border="0" width="206" height="224" /></a></td>
            <td style="padding-left:5px;"><a href="<?php bloginfo('url'); ?>/collections/"><img src="<?php bloginfo('template_url'); ?>/images/landing/collections-a.jpg" border="0" width="206" height="224" /></a></td></tr>
            </table>
            
            <p><a href="<?php bloginfo('url'); ?>/promo/"><img src="<?php bloginfo('template_url'); ?>/images/landing/realdeal.jpg" alt="The Only Real Deal - View Details" height="261" width="633" /></a></p>
            <div class="hr"></div>
            <h2><img src="<?php bloginfo('template_url'); ?>/images/landing/10yearwarranty.jpg" alt="10 year warranty" class="alignleft" height="136" width="140" />Jacuzzi offers a Warranty of up to 10 Years</h2>
            <p>When shopping for a hot tub, be sure to consider the warranty. Other brands guarantee's last 1 or 2 years, but our quality tubs feature limited warranties for up to 10 years! In addition, Jacuzzi's network of authorized dealers and technicians is standing by to ensure years of worry-free enjoyment. <a href="<?php echo get_permalink(4169); ?>">VIEW WARRANTY OPTIONS</a></p>
            <?php if( !is_page('thank-you') ) { ?>
            <div class="hr"></div>
            <a href="<?php bloginfo('url'); ?>/request-brochure/"><img src="<?php bloginfo('template_url'); ?>/images/landing/brochure-b.jpg" alt="Download Your Free Brochure" height="194" width="547" /></a>
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
global $post;
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
get_footer('landing'); ?>
