<?php
/*
 *		Sidebar - Tracking Codes
 *
 *		Can just add necessary tracking codes here to be injected on all pages with 
 *		@ get_sidebar('trackingcode')
 *
 */


/******************** GOOGLE TRACKING CODES ********************/
function google_tracking_codes_footer() {


	// Remarketing tags on form pages only (to be phased out)
	if ( ( is_page_template('page-quote.php') == true ) 
		|| ( is_page_template('page-quoteb.php') == true ) 
		|| ( is_page_template('page-tradein.php') == true ) 
		|| ( is_page_template('page-brochure.php') == true ) 
		|| ( is_page_template('page-jacuzzi-brochure-onepart.php') == true ) 
		|| ( is_page_template('page-twoColForm.php') == true ) 
		|| ( is_page_template('page-newlanding1.php') == true ) 
		|| ( is_page_template('page-newlanding1b.php') == true ) 
		|| ( is_page_template('page-newlanding2.php') == true )
		|| ( is_page_template('page-direct.php') == true )
		|| ( is_page_template('page-direct2.php') == true )
		|| ( is_page_template('page-directcanada.php') == true )
		|| ( is_page_template('page-directtwo.php') == true ) ) {
		?>
			<!-- Google Code for Form Pages :: Remarketing Tag -->
			<script type="text/javascript">
			/* <![CDATA[ */
			var google_conversion_id = 972980329;
			var google_conversion_label = "hDJcCIeR_gIQ6YD6zwM";
			var google_custom_params = window.google_tag_params;
			var google_remarketing_only = true;
			/* ]]> */
			</script>
			<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
			</script>
			<noscript>
			<div style="display:inline;">
			<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/972980329/?value=0&amp;label=hDJcCIeR_gIQ6YD6zwM&amp;guid=ON&amp;script=0"/>
			</div>
			</noscript>
		<?php
	}

	// Escape Thanks
	if ( is_page('escape-thanks') ) {
		?>
				<script>
				var prodName ="Escape With Jacuzzi";  				// add a name for Form being submitted
				var randId = Math.floor((Math.random()*10000)+1);
				var thankUrl = '/jh'+window.location.pathname;
				var thankTitle = prodName;
				if (!prodName || prodName.length === 0){
					var thankTitle = document.title;	
				}
				  _gaq.push(['_addTrans',
				    randId,           // order ID - required
				    thankUrl,  // affiliation or store name
				    '1',          // total - required
				    '',           // tax
				    '',              // shipping
				    '',       // city
				    '',     // state or province
				    ''             // country
				  ]);
				   // add item might be called for every item in the shopping cart
				   // where your ecommerce engine loops through each item in the cart and
				   // prints out _addItem for each
				  _gaq.push(['_addItem',
				    randId,           // order ID - required
				    thankUrl,           // SKU/code - required
				    thankTitle,        // product name
				    '',   // category or variation
				    '1',          // unit price - required
				    '1'               // quantity - required
				  ]);
				  _gaq.push(['_trackTrans']); //submits transaction to the Analytics servers
				</script>
		<?php
	}
}
add_action('wp_footer', 'google_tracking_codes_footer');



/********************* END GOOGLE ******************************/


/************* ALL OTHER TRACKERS *******************/


	function pixel_site_catalyst() { 
	  if(!is_page_template('page-dlresults.php') || strpos($_SERVER['URI'], 'dealer-locator') !== false) {
			if ( !defined('JHTMOBPX') ) {
				?>
			<!-- SiteCatalyst code version: H.10.
			Copyright 1997-2007 Omniture, Inc. More info available at
			http://www.omniture.com -->
			<script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/SiteCatalyst.js"></script>
			<script type="text/javascript"><!--
			/* You may give each page an identifying name, server, and channel on
			the next lines. sidebar-trackingcode loaded. */
			s.pageName=""
			s.server=""
			s.channel=""
			s.pageType=""
			s.prop1=""
			s.prop2=""
			s.prop3=""
			s.prop4=""
			s.prop5=""
			s.referrer=""
			/* Conversion Variables */
			s.campaign=""
			s.state=""
			s.zip=""
			s.events="<?php
				if ( is_page(4422) ) { // brochure-thanks
					print 'event2';
				} elseif( is_page(4513) ) { // quote-thanks
					print 'event4';
				} elseif( is_page(6782) ) { // truckload-thanks 
					print 'event9';
				} elseif( is_page(6329) ) { // appointment-thanks 
					print 'event10';
				} elseif( is_page_template('page-dlresults.php') ) { // delaer result
					print 'event7';
				} elseif( is_page_template('page-dllanding.php') ) { // delaer landing
					print '';
				} elseif( is_page('thank-you') ) { // deals/thank-you/
					print 'event3';
				}
				?>"
			s.products=""
			s.purchaseID=""
			s.eVar1=""
			s.eVar2=""
			s.eVar3=""
			s.eVar4=""
			s.eVar5=""
			/************* DO NOT ALTER ANYTHING BELOW THIS LINE ! **************/
			var s_code=s.t();if(s_code)document.write(s_code)//--></script>
			<script language="JavaScript"><!--
			if(navigator.appVersion.indexOf('MSIE')>=0)document.write(unescape('%3C')+'\!-'+'-')
			//--></script>
			<noscript><?php } ?>
			<a href="http://www.omniture.com" title="Web Analytics"><img src="http://jacuzzipremiumhottubs.jacuzzi.com.112.2O7.net/b/ss/jacuzzipremiumhottubs.jacuzzi.com/1/H.10--NS/0" height="1" width="1" border="0" alt=""/></a>
			<?php if ( !defined('JHTMOBPX') ) { ?></noscript><!--/DO NOT REMOVE/-->
			<!-- End SiteCatalyst code version: H.10. -->
			<?php 
			}
		}
	}



	function pixel_bazaarinvoice() {

		global $post;
		$custom = get_post_meta($post->ID,'jht_specs');
		$jht_specs = $custom[0];
		$prod = esc_attr($jht_specs['product_id']);
		$val = get_post_meta( $post->ID, 'lead-type', true );

		if ( !empty( $prod ) ) { ?>
			<script type="text/javascript"> 
			$BV.configure("global", { productId : "<?php echo $prod; ?>" });
			</script>
		<?php }
		
		if ( !empty( $val ) ) { ?>
			<script>
			$BV.SI.trackConversion({
			"type" : "lead-<?php echo $val; ?>",
			"value" : "<?php echo $val; ?>"
			});
			</script>
		<?php }
	}

	add_action('wp_footer', 'pixel_site_catalyst');
	add_action('wp_head', 'pixel_bazaarinvoice');

/************* END OF THE OTHERS ********************/

?>