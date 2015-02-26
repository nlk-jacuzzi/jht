<?php
/**
* The Sidebar containing the primary and secondary widget areas.
*
* @package JacuzziDirect
* @since JacuzziDirect 1.0
*/
?>
<div id="secondary" class="thx">
<div class="block"><h3 class="title">Locate a Dealer Near You Today!</h3><div class="inside">
<form name="countryZipForm" method="post" action="http://www.jacuzzihottubs.com/dealer-locator/cities/">
<input type="hidden" value="1" id="zipcodeSearch" name="zipcodeSearch"><input type="hidden" name="data[Dealer][country_id]" value="1"/>
<input type="text" name="zip" id="zipcodeInput" value="Postal Code" onfocus="if(this.value=='Postal Code') this.value='';" onblur="if(this.value=='') this.value='Postal Code';" /> <input type="submit" value="Go" id="go" />
</form>
</div></div>
<div class="block"><h3 class="title">Request an Appointment</h3><div class="inside">
<p><strong>Call</strong> : 877.411.5228</p>
</div></div>
<div class="block"><h3 class="title"><?php
$kw = '';
if(isset($wp_query->query_vars['kw']) && $wp_query->query_vars['kw'] != '') {
	$kw = $wp_query->query_vars['kw'] .'/';
}
if( is_page('quote-thanks') ) {
echo '<a href="<?php echo get_bloginfo('url'); ?>/request-brochure/">Download a Free Brochure</a>';
} else {
echo '<a href="<?php echo get_bloginfo('url'); ?>/get-a-quote/">Request a Quote</a>';
} ?></h3></div>
<div class="block"><h3 class="title"><a href="<?php echo get_bloginfo('url'); ?>/wp-content/themes/jht/email-popup.html?KeepThis=true&TB_iframe=true&height=150&width=386" class="thickbox">Email Sign Up</a></h3></div>
<div class="block follow"><div class="inside">
<p><label class="fl">FOLLOW US</label><img src="<?php echo get_bloginfo('url'); ?>/images/home/social.gif" usemap="#socialMap" class="social" width="106" border="0" height="20">
            <map name="socialMap" id="socialMap">
              <area shape="rect" coords="0,0,21,20" alt="join us on facebook" title="join us on facebook" href="http://www.facebook.com/jacuzziofficial" target="_blank">
              <area shape="rect" coords="28,0,50,20" href="http://twitter.com/jacuzziofficial" target="_blank" alt="follow us on twitter" title="follow us on twitter">
              <area shape="rect" coords="57,0,79,20" href="http://www.youtube.com/jacuzziofficial" target="_blank" alt="watch us on youtube" title="watch us on youtube">
              <area shape="rect" coords="85,0,106,20" href="<?php echo get_bloginfo('url'); ?>/hot-tub-blog/" alt="read our blog" title="read our blog">
            </map></p>
</div></div>
</div>

<script type="text/javascript"> if (!window.mstag) mstag = {loadTag : function(){},time : (new Date()).getTime()};</script> <script id="mstag_tops" type="text/javascript" src="//flex.atdmt.com/mstag/site/2007fee5-1f40-4bc4-b858-08ac4cb4c99b/mstag.js"></script> <script type="text/javascript"> mstag.loadTag("analytics", {dedup:"1",domainId:"1183768",type:"1",revenue:"250",actionid:"28343"})</script> <noscript> <iframe src="//flex.atdmt.com/mstag/tag/2007fee5-1f40-4bc4-b858-08ac4cb4c99b/analytics.html?dedup=1&domainId=1183768&type=1&revenue=250&actionid=28343" frameborder="0" scrolling="no" width="1" height="1" style="visibility:hidden;display:none"> </iframe> </noscript>
