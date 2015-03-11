<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title>
		<?php
			if ( function_exists('get_wpseo_options') ) {
				wp_title('');
				if ( $_GET['bvrrp'] )
					echo ' Reviews';
				if ( $_GET['bvqap'] )
					echo ' Questions';
			} else {
				$ti = wp_title('', false);
				if ( $ti ) {
					echo $ti .' - ';
				}
				bloginfo('name');
			}
		?>
	</title>
	<script src="http://www.jacuzzihottubs.com/mbox/mbox.js" type="text/javascript"></script> 
	<link rel="profile" href="http://gmpg.org/xfn/11" />
		<?php
			/* We add some JavaScript to pages with the comment form
			 * to support sites with threaded comments (when in use).
			 */
			if ( is_singular( 'post' ) && get_option( 'thread_comments' ) )
				wp_enqueue_script( 'comment-reply' );

			/* Always have wp_head() just before the closing </head>
			 * tag of your theme, or you will break many plugins, which
			 * generally use this hook to add elements to <head> such
			 * as styles, scripts, and meta tags.
			 */
			wp_head();
		?>
</head>

<body <?php body_class(); ?>>
<!-- Testing commit again. -->
	<?php custom_data_layer(); ?>