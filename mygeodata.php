<?php

function geo_data_mysql( $ip ) {

	$a = null;

	if ( $ip == '127.0.0.1' )
		return 'IP 127.0.0.1 not available in database';

	$LIVEHOST		= array( 'www.jacuzzihottubs.com', 'www.jacuzzihottubs.ca', 'beta.jacuzzihottubs.com' );
	if ( !in_array( $_SERVER['SERVER_NAME'], $LIVEHOST ) ) {
		// local
		$mysqli = new mysqli("localhost", "root", "", "nlk_geoip");
	}
	else {
		// live or beta
		$mysqli = new mysqli("localhost", "jacuzzi_geoip", "g9WpMRjuPf", "jacuzzi_geoip");
	}

	if ($mysqli->connect_errno) {

		$error = "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;

		return $error;
	}

	$query = "SELECT gl.* FROM geoip_locations gl LEFT JOIN geoip_blocks gb ON gb.locId = gl.locId WHERE gb.startIpNum <= INET_ATON( ? ) AND gb.endIpNum >= INET_ATON( ? ) LIMIT 1";

	if ( $stmt = $mysqli->prepare( $query ) ) {

		$stmt->bind_param( "ss", $ip, $ip );

		$stmt->execute();

		$stmt->bind_result( $locId, $country, $region, $city, $postalCode, $latitude, $longitude, $metroCode, $areaCode );

		while ( $stmt->fetch() ) {

			$a = array(

				'locId'			=>	$locId,
				'country'		=>	$country,
				'region'		=>	$region,
				'city'			=>	$city,
				'postalCode'	=>	$postalCode,
				'latitude'		=>	$latitude,
				'longitude'		=>	$longitude,
				'metroCode'		=>	$metroCode,
				'areacode'		=>	$areaCode,
				'ip'			=>	$ip,

				);

		}

		$stmt->close();

	}

	$mysqli->close();

	return $a;
}

function geo_data_curl( $ip ) {
	
	$username = '66659';
	$password = 'FJv62Mz6ezIB';

	if ( $ip == '127.0.0.1' )
		$ip = 'me';

	// Use CURL to get MaxMind Geo Data
	$ch = curl_init('https://geoip.maxmind.com/geoip/v2.0/city/' . $ip . '');
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	$a = json_decode($result, true);
	return $a;
}

function getRemoteIPAddress() {

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) :
        return $_SERVER['HTTP_CLIENT_IP'];
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) :
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    endif;

    return $_SERVER['REMOTE_ADDR'];
}

function getCookieIP() {

	if ( isset($_COOKIE['geoData']) ) {
		$cookie = unserialize( urldecode( $_COOKIE['geoData'] ) );
	}

	if ( isset( $cookie ) && filter_var( $cookie['ip'], FILTER_VALIDATE_IP ) ) :
		return $cookie['ip'];
	endif;

	return false;
}

function returnCookieData() {
	if ( isset($_COOKIE['geoData']) ) :
		$cookie = unserialize( urldecode( $_COOKIE['geoData'] ) );
	else :
		$cookie = false;
	endif;

	if ( $cookie && !filter_var( $cookie['ip'], FILTER_VALIDATE_IP ) ) :
		$cookie['ip'] = getRemoteIPAddress();
	endif;

	return $cookie;
}

function includes( $var ) {
	return isset( $_POST[$var] ) ? $_POST[$var] : null;
}

$resultCO = returnCookieData();
$resultDB = $resultAPI = false;

if ( ($_POST) ) {

	$a = $_POST;

	$includes = includes('includesCookie') + includes('includesMysql') + includes('includesApi');

	if ( !empty($_POST['includeIp']) && filter_var( $_POST['includeIp'], FILTER_VALIDATE_IP ) ) {
		$ip = $_POST['includeIp'];
	}
	elseif ( $includes % 2 != 0 ) {
		$ip = getCookieIP();
	}
	else {
		$ip = getRemoteIPAddress();
	}

	switch ( $includes ) {
		case 1:
			break;
		case 2:
		case 3:
			$resultDB = geo_data_mysql( $ip );
			break;
		case 4:
		case 5:
			$resultAPI = geo_data_curl( $ip );
			break;
		case 6:
		case 7:
			$resultAPI = geo_data_curl( $ip );
			$resultDB = geo_data_mysql( $ip );
			break;
	}

}

?>
<!DOCTYPE html>
<html>
<body>

	<div style="padding: 20px; margin: 10px; border: 1px solid #666; background-color: #ddd;">
		<form action="mygeodata.php" method="post">
			<label>Enter IP Address:</label><br /><input type="text" name="includeIp" value="<?php echo includes('includeIp'); ?>" placeholder="<?php echo getRemoteIPAddress(); ?>" /><br />
			<input type="checkbox" name="includesCookie" value="1" />Use Cookie Data<br />
			<input type="checkbox" name="includesMysql" value="2" checked="checked" />Include MySQL Lookup<br />
			<input type="checkbox" name="includesApi" value="4" />Include API Lookup<br />
			<input type="submit" value="Fetch Results" />
		</form>
	</div>

	<div style="padding: 20px; margin: 10px; border: 1px solid #666; background-color: #ddd;">
	<?php if ( $resultCO ) { ?>
	<details open>
		<summary>Current Cookie Data</summary>
		<pre>
<?php print_r( $resultCO ); ?>
		</pre>
	</details>
	<?php } ?>

	<?php if ( $resultDB ) { ?>
	<details open>
		<summary>MySQL DB Results</summary>
		<pre>
<?php print_r( $resultDB ); ?>
		</pre>
	</details>
	<?php } ?>

	<?php if ( $resultAPI ) { ?>
	<details open>
		<summary>Web Service API Results (<?php echo $resultAPI['maxmind']['queries_remaining']; ?> queries remaining)</summary>
		<pre>
<?php print_r( $resultAPI ); ?>
		</pre>
	</details>
	<?php } ?>
	</div>

</body>
</html>

