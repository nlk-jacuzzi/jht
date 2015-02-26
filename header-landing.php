<?php
/**
 * The Header for Landing pages.
 *
 * Displays all of the <head> section and start of body tag
 * includes cookie & redirect to MOBILE if that should be the case
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
if ( function_exists('get_wpseo_options') ) {
	wp_title('');
} else {
	$ti = wp_title('', false);
	if ( $ti ) {
		echo $ti .' - ';
	}
	bloginfo('name');
}
?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>

	<?php custom_data_layer(); ?>