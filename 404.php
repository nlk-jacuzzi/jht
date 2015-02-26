<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

get_header();
?>
    <div class="hero">
    	<div class="wrap">
            <h1 class="title">Page Not Found</h1>
        </div>
    </div>
    <div class="goldBar10"></div>
    <div class="bd">
    	<div class="wrap">
            <div class="twoCol">
                <div class="main">
                <p><br /></p>
					<h1>Looking for something at Jacuzzi&reg; Hot Tubs?</h1>
                    <p>Sorry but the page you requested could not be found.</p>
                    <p><a href="<?php bloginfo('url'); ?>">Return to our home page</a></p>
                </div>
            </div>
<?php get_footer(); ?>
