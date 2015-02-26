<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package JacuzziDirect
 * @since JacuzziDirect 1.0
 */
?>
	</div><!-- #page -->
</div><!-- #wrap -->
<div id="fwrap">
	<div id="footer">
    <p><a href="<?php echo get_bloginfo('url'); ?>/" title="Hot Tubs" class="logo">Jacuzzi</a><a href="<?php echo get_bloginfo('url'); ?>/warranty-registration/" title="Hot Tub Warranty Registration">Warranty Registration</a> &nbsp; | &nbsp; <a href="<?php echo get_bloginfo('url'); ?>/contact/" title="Jacuzzi Customer Support">Customer Support</a> &nbsp; | &nbsp; <a href="http://www.jacuzzi.com/baths/" title="Jacuzzi Bath" target="_blank">Jacuzzi Bath</a> &nbsp; | &nbsp; <a href="<?php echo get_bloginfo('url'); ?>/for-jacuzzi-dealers/" title="For Jacuzzi Hot Tubs Dealers">For Jacuzzi Dealers</a> &nbsp; | &nbsp; <a href="<?php echo get_bloginfo('url'); ?>/become-a-dealer/" title="Become a Jacuzzi Dealer">Become a Dealer</a><br/>
	    &copy; <?php echo date('Y', time()); ?> Jacuzzi - all rights reserved &nbsp; | &nbsp; <a href="<?php echo get_bloginfo('url'); ?>/about/trademark-use/" title="Jacuzzi Trademark Use">Trademark Use</a> &nbsp; | &nbsp; <a href="<?php echo get_bloginfo('url'); ?>/about/policies/" title="Jacuzzi Policies">Policies</a> &nbsp; | &nbsp; <a href="<?php echo get_bloginfo('url'); ?>/about/legal/" title="Jacuzzi Legal Statement">Legal Statement</a> &nbsp; | &nbsp; <a href="<?php echo get_bloginfo('url'); ?>/careers/" title="Jacuzzi Hot Tubs Careers">Careers</a> &nbsp; | &nbsp; <a href="<?php echo get_bloginfo('url'); ?>/sitemap/" title="Jacuzzi Hot Tubs Sitemap">Sitemap</a><br />
Features and specifications are subject to change. See dealer for details.</p>
</div><!-- #ftr -->
</div><!-- #fwrap -->

    <?php google_tag_manager(); ?>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

<?php get_sidebar('trackingcode'); ?>

</body>
</html>
