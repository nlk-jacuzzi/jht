<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package JacuzziDirect
 * @since JacuzziDirect 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged, $wp_query;
	$kw = '';
	if(isset($wp_query->query_vars['kw']) && $wp_query->query_vars['kw'] != '') {
		$kw = $wp_query->query_vars['kw'];
		$kw = ucwords(str_replace('-',' ',$kw));
		echo wp_kses($kw,array()) .' | ';
	} else {
		wp_title( '|', true, 'right' );
	}
	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<?php custom_data_layer(); ?>
	
<div id="wrap">
	<div id="page">
        <div id="hdr" class="container_12">
        	<div class="grid_8">
	            <h1 id="slogan">
	            	<?php
	            	global $wp_query;
					if($kw != '') {
						echo wp_kses($kw,array());
					} else {
						bloginfo( 'description' );
					} ?>
				</h1>
	            <a href="<?php echo get_bloginfo('url'); ?>" id="logo" title="Hot Tubs">Jacuzzi Hot Tubs</a>
            </div>
            <?php
            /* add the Top Arrow */
			if ( is_page_template() ) { ?>
	            <div class="grid_4 tshade">
	            	<div id="toparr">
	            		<a name="top"></a>
	            		<span>
	            		<?php
						if(is_page_template('page-direct.php') || is_page_template('page-directtwo.php') || is_page_template('page-directcanada.php')) {
							global $post;
							$custom = get_post_meta( $post->ID, '_progo' );
							$direct = $custom[0];
							esc_html_e( $direct[toparr] );
						} else {
							echo 'Thank You';
						}
						?>
						</span>
					</div>
	            </div>
            <?php } else {
				echo '<a name="top"></a>';
			} ?>
        </div>