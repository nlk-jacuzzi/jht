<?php
/**
 *	SIDEBAR - CTA Forms (Brochure / Dealer / Truckload)
 *
 **/

$truckload_url = get_bloginfo('url') . '/dealer-locator/dealers/get_truckload_cities_json';
$json = file_get_contents($truckload_url);
$truckloadObj = json_decode($json);


?>
<div id="bbg-ctas">
	<div class="bbg-container">
		<div id="bbg-ctas-block1">
			<h3><strong>FREE</strong> Brochure &amp; Buyer's Guide</h3>
			<ul>
				<li>Compare models side-by-side</li>
				<li>Learn about features &amp; options</li>
			</ul>
			<?php 
			if ( jht_my_server() == 'local' ) :
				echo do_shortcode('[gravityform id="12" title="false" description="false"]');
			elseif ( jht_my_server() == 'dev' ) :
				echo do_shortcode('[gravityform id="15" title="false" description="false"]');
			else :
				echo do_shortcode('[gravityform id="12" title="false" description="false"]');
			endif;
			?>
			<p class="note">* Required.&nbsp; &nbsp;<a href="<?php echo get_permalink(3987) ?>">Privacy Policy</a></p>
			<a href="<?php echo get_bloginfo('url'); ?>/brochure-buyers-guide/">See what's included</a>
		</div>
		<div id="bbg-ctas-block2">
			<h3>Find Your Nearest Dealer</h3>
			<ul>
				<li>Get expert help</li>
				<li>Browse models &amp; pricing</li>
				<li>Come take a wet test in a store</li>
			</ul>
			<form name="countryZipForm" method="post" action="<?php echo trailingslashit(get_bloginfo('url')) ?>dealer-locator/cities/">
				<input type="hidden" value="1" name="zipcodeSearch" />
				<input type="hidden" value="1" name="data[Dealer][country_id]" />
				<label>Zip</label>
				<input type="text" class="text zip" value="" name="zip" />
				<input type="submit" class="submit bigGoldBtn" value="Locate Dealer" />
			</form>

		</div>
		<div id="bbg-ctas-block3">
			<h3>Factory Sale</h3>
			<h4>Deeply Discounted<br>
				Hot Tubs!</h4>
			<?php if ( ! empty($truckloadObj) ) : ?>
				<p>Upcoming locations</p>
				<ul>
				<?php foreach ($truckloadObj as $key => $dealer) { ?>
					<li><a href="<?php echo ( !empty($dealer->website) ? $dealer->website : get_bloginfo('url') . '/dealer-locator' . $dealer->link ); ?>"><?php echo ( !empty($dealer->tl_city) ? ucwords($dealer->tl_city) : ucwords($dealer->city) ) . ', ' . strtoupper($dealer->state); ?></a></li>
				<?php } ?>
				</ul>
			<?php endif; ?>
			<a href="<?php echo get_bloginfo('url'); ?>/truckload/">Learn More</a>
		</div>
	</div>
</div>