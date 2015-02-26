<?php
/**
 * Template Name: Request Appointment
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */
$errors = array();
//if(isset($_POST[person])) {
//	$postvars = http_build_query($_POST);
//	$ch = curl_init();
//	$url = 'http://jacuzzi.techbarn.com/service/jht_quote';
//	
//	curl_setopt($ch, CURLOPT_URL, $url);
//	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//	curl_setopt($ch, CURLOPT_POST, 1);
//	curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
//	
//	$data = curl_exec($ch);
//	curl_close($ch);
//	//echo $data;
//	$xml = new SimpleXMLElement($data);
//	foreach($xml->children() as $el => $child) {
//		if($el == 'error') {
//			$errors[] = $child;
//		} else { //if($el == 'order_id') {
//			wp_redirect(get_permalink(6329));
//			die;
//		}
//	}
//}

// redirect to get a quote page
wp_redirect(get_permalink(3743));

get_header();
if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <div class="hero">
    	<div class="wrap">
            <h1 class="title"><?php the_title(); ?></h1>
        </div>
    </div>
    <div class="goldBar10"></div>
    <div class="bd">
    	<div class="wrap">
            <div class="twoCol">
                <div class="main">
                	<p class="note">Please provide your information in the form below. *Indicates required fields.<?php
if(count($errors) > 0) {
	echo '<br /><br /><span class="errors">';
	foreach( $errors as $err ) {
		echo "$err<br />";
	}
	echo '</span><br />';
}
?></p>
                    <form action="<?php echo get_permalink(); ?>" method="post" id="requestform">
                        <table cellspacing="0">
                            <tr>
                                <td>
                                    <table cellspacing="0">
                                        <tr>
                                            <td>
                                                <label for="person[title]">Title</label>
                                                <select id="person_title" name="person[title]" class="w50 select">
                                                    <option value="Mr.">Mr.</option>
                                                    <option value="Ms.">Ms.</option>
                                                </select>
                                            </td>
                                            <td>
                                                <label for="person[first_name]">First Name*</label>
                                                <input id="person_first_name" name="person[first_name]" type="text" class="text w210 required" /><input id="person_middle_initial" name="person[middle_initial]" type="hidden" value="" />
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <label for="person[last_name]">Last Name*</label>
                                    <input id="person_last_name" name="person[last_name]" type="text" class="text w270 required" /><input id="person_company_name" name="person[company_name]" value="" type="hidden" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="person[email]">Email*</label>
                                    <input id="person_email" name="person[email]" type="text" class="text w270 required" />
                                </td>
                                <td><table>
                                <tr><td>
                                    <label for="person[phone]">Phone*</label>
                                    <input id="person_phone" name="person[phone]" type="text" class="text w115 required" />
                                            <td>
                                                <label for="person[zip]">Zip/Postal Code*</label>
                                                <input id="person_zip" name="person[zip]" type="text" class="text w145 required" />
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <!--td>
                                    <label for="timeToContact">Best time to Contact*</label>
                                    <select id="timeToContact" class="select w270 required">
                                        <option selected="selected">Please Select</option>
                                        <option value="any">Anytime</option>
                                    </select>
                                </td-->
                                <td colspan="2">
                                    <label>&nbsp;</label>
                                    <select id="person_web_referrer_id" name="person[web_referrer_id]" class="select w270">
                                        <option value="">How did you learn about us</option>
<option value="18">Google</option>
<option value="11">Yahoo!</option>
<option value="9">MSN</option>
<option value="19">Other Search</option>
<option value="14">Magazine Ad</option>
<option value="15">Newspaper Ad</option>
<option value="16">Yellow Pages</option>
<option value="13">Friend</option>
<option value="17">Other</option></select>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><br /><input type="submit" name="commit" class="submit bigGoldBtn" value="Submit Request" />
                                    <input id="person_address1" name="person[address1]" type="hidden" value="" /><input id="person_address2" name="person[address2]" type="hidden" value="" /><input id="person_city" name="person[city]" type="hidden" value="" /><input type="hidden" value="" id="person_state" name="person[state]" /><input type="hidden" value="" id="person_country_id" name="person[country_id]" /><input type="hidden" value="Request Appointment with Local Dealer" id="person_request_notes" name="person[request_notes]" /><input name="person[mailing_list_status_id]" type="hidden" value="2" /></td>
                            </tr>
                        </table>
                        <p class="note">Your privacy is very important to us. See our <a href="<?php echo get_permalink(3987) ?>">Privacy Policy</a>.</p>
                    </form>
                </div>
                <div class="side">
                </div>
            </div>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
