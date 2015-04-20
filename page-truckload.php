<?php
/**
 * Template Name: Truckload Sales
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

avala_form_submit();

$truckload_url = get_bloginfo('url') . '/dealer-locator/dealers/get_truckload_cities_json';
$json = file_get_contents($truckload_url);
$truckloadObj = json_decode($json);

get_header();
if ( have_posts() ) while ( have_posts() ) : the_post();
$custom = get_post_meta($post->ID,'jht_pageopts');
$pageopts = $custom[0];
$titleoverride = false;
if ( isset($pageopts['o']) ) if ( $pageopts['o'] != '' ) $titleoverride = $pageopts['o'];

	$landing_img = '';
	$img_id = get_post_meta( $post->ID, '_thumbnail_id', true );
	if ( $img_id ) {
		$img = get_post($img_id);
		$landing_img = "background-image: url('". $img->guid ."')";
	}
	?>
    <div class="hero truckload all-tubs" style="<?php echo $landing_img ?>">
    	<div class="wrap">
            <?php  $IP=$_SERVER['REMOTE_ADDR']; $ipcountry = file_get_contents('http://api.hostip.info/country.php?ip='.$IP); ?>

        	<div class="inner">
            	
                <?php // rather than the_content(), first just show more
				$allcontent = $post->post_content;
				$hasmore = false;
				$firstcontent = $allcontent;
				$morecontent = '';
				$morestart = strpos($allcontent, '<!--more-->');
				if ( $morestart ) {
					$firstcontent = substr($allcontent, 0, $morestart);
					$hasmore = true;
				}
				echo apply_filters( 'the_content', $firstcontent );
				?>
            </div>
            <div class="tub-grid">
                <div class="goldBar8"></div>
                <div class="side">
            	
                    <div id="requestform" class="truckloadform">
                		<h3>Request the<br />Truckload Sale<br />In Your Town</h3>
                		<?php echo do_shortcode('[gravityform id="18" title="false" description="false"]'); ?>
                		<p class="note"><span class="rqd">*</span> Fields with an asterisk are required.<br />&nbsp;</p>
                        <p class="note">Your privacy is very important to us. See our <a href="<?php echo get_permalink(3987) ?>">Privacy Policy</a>.<br />&nbsp;</p>
                	</div>
            		<?php /* ?>
					<form action="<?php echo get_permalink(); ?>" method="post" id="requestform" class="truckloadform">

                        <?php avala_hidden_fields( 15, 9, 10 ); ?>

	                    <table cellpadding="0">
    	                	<tr>
    	                		<td>
                    				<h3>Request the<br />Truckload Sale<br />In Your Town</h3>
                    			</td>
                    		</tr>
                    		<tr>
                    			<td>
                    				<?php avala_field( 'first_name', 'text w170', true); ?>
                    			</td>
                    		</tr>
                    		<tr>
                    			<td>
                    				<?php avala_field( 'last_name', 'text w170', true); ?>
                    			</td>
                    		</tr>
                            <tr>
                                <td>
                                    <?php avala_field( 'email', 'text w170 email', true); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php avala_field( 'phone', 'text w170 number', true, NULL, array( 'maxlength' => 16)); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php avala_field( 'postal_code', 'text w170', true, NULL, array( 'maxlength' => 10 )); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php avala_field( 'country', 'country w170 select', true); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="gaptop">
                                    <?php avala_field( 'currently_own', 'w170 select' ); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="gaptop">
                                    <?php avala_field( 'product_id_list', 'w170 select' ); ?> 
                                </td>
                            </tr>
                            <tr>
                                <td class="gaptop">
                                    <?php avala_field( 'buy_time_frame', 'w170' ); ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="gaptop">
                                    <?php avala_field( 'product_use', 'w170' ); ?>
                                </td>
                            </tr>
                            <tr class="divider">
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <?php avala_field('newsletter', '', false, 'field' ); ?>
                                </td>
                            </tr>
                            <tr class="divider">
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" name="commit" class="submit medGoldBtn" value="Submit">
                                </td>
                            </tr>
                        </table>
                        <p class="note"><span class="rqd">*</span> Fields with an asterisk are required.<br />&nbsp;</p>
                        <p class="note">Your privacy is very important to us. See our <a href="<?php echo get_permalink(3987) ?>">Privacy Policy</a>.<br />&nbsp;</p>
                    </form>
					<?php */ ?>

                <div class="share">
                    <h3>Share This</h3>
                    <div class="share-bar">
                    <?php if(function_exists('sharethis_button')) sharethis_button(); ?>
                    </div>
                </div>
            </div>
            <div class="main">
					
                    <?php
                    if ( $hasmore ) {
						$lastcontent = substr($allcontent, $morestart + 11);
						echo apply_filters( 'the_content', $lastcontent );
					} else {
						the_content();
					}
                    ?>

                    <?php if ( ! empty($truckloadObj) ) : ?>
					   <table class="sales">
    					
                            <?php foreach ($truckloadObj as $key => $dealer) { ?>
                                <tr>
                                    <td colspan="3">
                                        <div class="hr"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="date" width="72" height="72"><br /><?php echo $dealer->start_date; ?><br /><?php echo $dealer->end_date; ?></td>
                                    <td rowspan="2" width="16">&nbsp;</td>
                                    <td width="580" rowspan="2">
                                        <?php if ( !empty($dealer->tl_name) ) { ?>
                                            <div><strong><?php echo $dealer->tl_name; ?></strong></div>
                                        <?php } else { ?>
                                            <div><strong><?php echo $dealer->name; ?></strong></div>
                                        <?php } ?>
                                        <div><strong><?php echo $dealer->phone; ?></strong></div>
                                        <div><?php if ( !empty($dealer->tl_address) ) {
                                                echo ucwords($dealer->tl_address);
                                            } else {
                                                echo ucwords($dealer->address);
                                            } ?><br>
                                            <?php if ( !empty($dealer->tl_city) ) {
                                                echo ucwords($dealer->tl_city);
                                            } else {
                                                echo ucwords($dealer->city);
                                            } ?>, <?php if ( !empty($dealer->tl_state) ) {
                                                echo strtoupper($dealer->tl_state);
                                            } else {
                                                echo strtoupper($dealer->state);
                                            } ?> <?php if ( !empty($dealer->tl_zip) ) {
                                                echo ($dealer->tl_zip);
                                            } else {
                                                echo ($dealer->zip);
                                            } ?></div>
                                        <p><a href="<?php echo $dealer->website; ?>" id=""><?php echo $dealer->website; ?></a></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>

                            <?php } ?>

					   </table>
                    <?php endif; ?>

            </div>
            <div style="clear: both;"><p class="note" style="box-sizing: border-box; padding: 20px;">* The Wells Fargo Outdoor Solutions Visa credit card is issued by Wells Fargo Financial National Bank, an Equal Housing Lender. Special terms apply to qualifying purchases charged with approved credit at participating merchants. The special terms APR will continue to apply until all qualifying purchases are paid off. The monthly payment for this purchase will be the amount that will pay for the purchase in full equal payments during the promotion (special terms) period. The APR for purchases will apply to certain fees such as a late payment fee or if you use the card for other transactions. For newly opened accounts, the APR for purchases is 27.99%. This APR may vary with the market based on the U.S. Prime Rate and is given as of 04/01/2014. If you are charged interest in any billing cycle, the minimum interest charge will be $1.00. If you use the card for cash advances, the cash advance fee is 5.00% of the amount of the cash advance, but not less than $10.00.<br><br>See participating dealers for complete terms and conditions.</p></div>
          </div>
          
        </div>
</div>
<div class="bd wrap">
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
