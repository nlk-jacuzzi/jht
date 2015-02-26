<?php

/* chunk to process form submit */
$errors = array();
if( isset($_POST['EmailAddress']) ) {
  $arrayDump = $_POST;  // this will be used for a complete array dump
  $sendMode = $_POST['sendMode'];
  $testMode = $_POST['testMode'];
  $returnUrl = $_POST['returnUrl'];
  // array of identities
  $leadSource = array( 1 => 'Website', 2 => 'BuyerZone', 3 => 'ThermoSpas', 4 => 'Import', 5 => 'Facebook', 6 => 'Google', 7 => 'Google Plus',
    8 => 'Homepage Banner', 9 => 'JacuzziHotTubs.com', 10 => 'Pinterest', 11 => 'Twitter', 12 => 'Yahoo/Bing', 14 => 'Historical' );
  $leadCategory = array( 2 => 'Billboard', 3 => 'BRC Card', 4 => 'Call Center', 5 => 'Consumer iPad', 6 => 'Direct Mail', 7 => 'Direct Traffic',
    8 => 'Display Advertising', 9 => 'Email', 10 => 'Event', 11 => 'Other', 12 => 'Page Retargeting', 13 => 'Print Ad', 14 => 'Radio',
    15 => 'Referral Traffic', 16 => 'Search - Organic', 17 => 'Search - Paid', 18 => 'Social Media', 19 => 'Social Media - Paid', 20 => 'Sponsored Email',
    21 => 'Television', 22 => 'Third Party' );
  $leadType = array( 1 => 'Campaign', 2 => 'Contact Dealer', 3 => 'Request Brochure', 4 => 'Request Financing', 5 => 'Request Quote', 7 => 'Request Trade In',
    8 => 'Subscriber', 9 => 'Sweepstakes', 10 => 'Truck Load', 11 => 'Request Appointment', 12 => 'Request Brochure Download', 13 => 'Other',
    16 => 'Request DVD', 17 => 'Request Brochure & DVD', 18 => 'Request Brochure Mail & DVD', 19 => 'Request Brochure Download & DVD', 20 => 'Request Brochure Mail & Download & DVD',
    21 => 'Request Brochure Mail', 22 => 'Request Brochure Mail & Download' );
  unset($_POST['1676']);  //this is just a validator field so removed
  unset($_POST['sendMode']);  //remove sendMode and testMode and returnUrl so these don't get passed on
  unset($_POST['testMode']);
  unset($_POST['returnUrl']);
  // create a new array from post data to be modified for the API
  $postArrayModified = $_POST;
  $postArrayModified['LeadSourceName'] = $leadSource[$_POST['LeadSourceId']];
  $postArrayModified['LeadTypeName'] = $leadType[$_POST['LeadTypeId']];
  $postArrayModified['LeadCategoryName'] = $leadCategory[$_POST['LeadCategoryId']];
  $postArrayModified['HomePhone'] = $_POST['Phone']['area'].$_POST['Phone']['prefix'].$_POST['Phone']['line'];
  // remove empty fields, since we don't need to pass them to the API and they could break it
  $postArrayModified = array_filter($postArrayModified);
  // then strip out any fields we don't want to pass
  unset($postArrayModified['Id']);
  unset($postArrayModified['LeadSourceId']);
  unset($postArrayModified['LeadTypeId']);
  unset($postArrayModified['LeadCategoryId']);
  // json encoded data to send to API
  $json = '[' . json_encode($postArrayModified) . ']';
  $apiUrl = array('jacuzzi' => 'http://jacuzzi.aimbase.com/FormBuilder/api/Lead',
                  'jacuzzi_test' => 'http://jacuzziqa.aimbase.com/formbuilder/api/lead'
                  );
  // Test Mode?
  $sendTo = ( $testMode == true ) ? $apiUrl['jacuzzi_test'] : $apiUrl['jacuzzi'];
  // send to API or http post?
  if( $sendMode == 'API' ) {
    // submit API
    $ch = curl_init($sendTo);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json', 'Content-Length: ' . strlen($json) ) );
    $apiResult = curl_exec($ch);
    curl_close($ch);
  }
  // insert into db
  $dbArray = array(
      'form_id' => $arrayDump["Id"],
      'campaign_id' =>  $arrayDump["CampaignId"],
      'lead_source_id' => $arrayDump["LeadSourceId"],
      'lead_type_id' => $arrayDump["LeadTypeId"],
      'lead_category_id' => $arrayDump["LeadCategoryId"],
      'lead_source_name' => $postArrayModified["LeadSourceName"],
      'lead_type_name' => $postArrayModified["LeadTypeName"],
      'lead_category_name' => $postArrayModified["LeadCategoryName"],
      'first_name' => $arrayDump["FirstName"],
      'last_name' => $arrayDump["LastName"],
      'address' => $arrayDump["Address1"],
      'city' => $arrayDump["City"],
      'state' => $arrayDump["State"],
      'postal_code' => $arrayDump["PostalCode"],
      'country' => $arrayDump["CountryCode"],
      'email' => $arrayDump["EmailAddress"],
      'phone' => $postArrayModified["HomePhone"],
      'custom_data' => json_encode($arrayDump["CustomData"]),
      'web_session_data' => json_encode($arrayDump["WebSessionData"]),
      'json_dump' => json_encode($arrayDump),
    );
  $columns = implode(", ",array_keys($dbArray));
  $values = "'". implode("', '", array_values($dbArray)). "'";
  $sql = "INSERT INTO `avala_lead_form` ($columns) VALUES ($values)";
  // sql connections
  $username = "form_admin";
  $password = "r4e3w2q1";
  $hostname = "localhost"; 
  //connection to the database
  $dbhandle = mysql_connect($hostname, $username, $password) 
    or die("Unable to connect to database");
  //select a database to work with
  $selected = mysql_select_db("form_data_dump",$dbhandle) 
    or die("Could not select database");
  //run query
  $sqlResult = mysql_query($sql);
  if (!$sqlResult) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $sql;
    die($message);
  }
  //close the connection
  mysql_close($dbhandle);
}

?>