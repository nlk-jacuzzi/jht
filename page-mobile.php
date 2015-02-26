<?php
/**
 * Template Name: Mobile Landing
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 2.012
 */

avala_form_submit();

get_header( 'mobile' );
if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div class="mwrap">
<a href="<?php bloginfo('url'); ?>" id="logo"><?php bloginfo('name'); ?></a>
<div class="bg"><?php the_post_thumbnail('original'); ?></div>
<?php the_content(); ?>
<a href="<?php bloginfo('url'); ?>/collections/" class="i"><img src="<?php bloginfo('template_url'); ?>/images/landing/mcollections.jpg?r=1" alt="Jacuzzi Hot Tub Collections" /></a>
<a href="#commercials" class="i watch"><img src="<?php bloginfo('template_url'); ?>/images/landing/mwatch.jpg?r=1" alt="Watch the new Jacuzzi Commercials" /></a>
<div class="vids" style="display:none">
    <a href="http://www.youtube.com/watch?v=Y5-yhuAndAM"><img src="<?php bloginfo('template_url'); ?>/images/landing/vid1.jpg" alt="" height="57" width="200" /></a>
    <a href="http://www.youtube.com/watch?v=Qp3DuYIUmKg"><img src="<?php bloginfo('template_url'); ?>/images/landing/vid2.jpg" alt="" height="57" width="200" /></a>
    <a href="http://www.youtube.com/watch?v=3jj3alx5Ijs"><img src="<?php bloginfo('template_url'); ?>/images/landing/vid3.jpg" alt="" height="57" width="200" /></a>
</div>
<a href="#email" class="l email ar"><span>Sign up for Email Updates</span></a>
<form action="http://login.sendmetric.com/phase2/bullseye/contactupdate1.php3" method="post" name="bullseye" id="bullseye" class="mf" onsubmit="return doSubmit();" target="signup" style="display: none"><input type="hidden" name="cid" value="325a091ebb4d440d143f7a6676e8c5bd" />
<label for="email">Email</label>
<input type="email" value="" class="text email" name="email" id="email" size="40" />
<label for="postal_code">Zip Code</label>
<input type="text" value="" class="text zip" name="postal_code" id="postal_code" size="6" />
<input type="hidden" name="message" value="Thank you. Your information has been submitted. To ensure delivery of your newsletter(s), please add donotreply@jacuzzihottubs.com to your address book, spam filter whitelist, or tell your company's IT group to allow this address to pass through any filtering software they may have set up." /><input type="submit" name="SubmitBullsEye" value="SUBMIT"  onclick="var s=s_gi('jacuzzipremiumhottubs.jacuzzi.com');s.linkTrackVars='events';s.linkTrackEvents='event1';s.events='event1';s.tl(this,'o','Email Signup');" class="sub" /><input type=hidden name="grp[]" value="584177" /></form>
<a href="#dl" class="l dl ar"><span>Download a Brochure</span></a>
<form action="<?php echo get_permalink(); ?>" id="requestform" method="post" style="display:none" class="mf">
  <?php get_sidebar('avalaform-chunk-hidden'); ?>

  <label for="person_first_name">First Name*</label>
    <input type="text" class="text w115 required" id="person_first_name" name="FirstName" />
    
    <label for="person_last_name">Last Name*</label>
    <input type="text" class="text w115 required" id="person_last_name" name="LastName" />
    
    <label for="person_email">Email*</label>
    <input type="email" class="text w270 required" id="person_email" name="EmailAddress" />
    
    <label for="person_phone">Phone</label>
    <input type="text" class="text w270" id="person_phone" name="Phone" />
    <label for="person_zip">Zip/Postal Code*</label>
    <input type="text" class="text w115 required" id="person_zip" name="PostalCode" />
  <input type="submit" class="sub" value="SUBMIT" />
  <input type="hidden" name="returnUrl" value="<?php bloginfo('url'); ?>/deals/thank-you/" />
  <input type="hidden" name="fromurl" value="<?php echo get_permalink(); ?>" />
  <input data-val="true" data-val-number="The field LeadTypeId must be a number." data-val-required="The LeadTypeId field is required." id="LeadTypeId" name="LeadTypeId" type="hidden" value="12" />
  <input type="hidden" name="CountryCode" value="US" />

    <a href="<?php echo get_permalink(3987) ?>" class="priv">Privacy Policy</a>
</form>

<a href="<?php bloginfo('url'); ?>/dealer-locator/" class="l"><span>Find a Hot Tub Dealer</span></a>
<a href="<?php bloginfo('url'); ?>/promo/" class="l"><span>Current Deals and Promotions</span></a>
<div class="fs">
<a href="<?php bloginfo('url'); ?>/deals/">View Full Site</a>
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
get_footer('mobile');
?>