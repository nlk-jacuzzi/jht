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
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<title>
		<?php
			if ( function_exists('get_wpseo_options') ) {
				wp_title('');
				if ( isset($_GET['bvrrp']) )
					echo ' Reviews';
				if ( isset($_GET['bvqap']) )
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

	<?php if ( !isset($_COOKIE['jhtsession']) || $_COOKIE['jhtsession'] > 0 ) {

			// Turn tracking pixel for Header
			$converzion = false;
			$u = $_SERVER['REQUEST_URI'];
			$u_a = explode("/", $u);
			foreach ( $u_a as $k => $v ) {
				if (strpos($v, 'thank') !== false)
					$converzion = true;
			}

			if ($converzion !== true) { 
				/* * * * * * * * * * * * * * * * * * * * TURN TRACKING * * * * * * * * * * * * * * * * * * * * *
				 *
				 *	Beacon Name						: Jacuzzi Remarketing pixel - Landing Page - (Non Secure)
				 *	Beacon Type						: Landing Page
				 *	Click & View Association Window	: 30 Days & 7 Days
				 *	Tracking Method					: Always Fires
				 *	Page Protocol					: Http
				 *
				*/ 
				?>
				<img border="0" src="http://r.turn.com/r/beacon?b2=FU2vWfsEJ1tzmONSqkHjCFlB9SlUuj0073YFNe3A3tp5CBypUzP_hCh-14Z-SQMTJQHFoFc7Cbpp_1CDl3Yfyw&cid=">
			
			<?php }

			else { 
				/* * * * * * * * * * * * * * * * * * * * TURN TRACKING * * * * * * * * * * * * * * * * * * * * *
				 *
				 *	Beacon Name						: Jacuzzi Conversion pixel - Sale - (Secure)
				 *	Beacon Type						: Sale
				 *	Click & View Association Window	: 30 Days & 7 Days
				 *	Tracking Method					: Always Fires
				 *	Page Protocol					: https
				 *
				*/
				?>
				<img border="0" src="https://r.turn.com/r/beacon?b2=PQFhHLsroTbSClySFxP0E9sETopR-nOvuP-LwdEG8Y15CBypUzP_hCh-14Z-SQMTvh9KuYdd3-bC1K606g_ERA&cid=">

			<?php }
	} ?>