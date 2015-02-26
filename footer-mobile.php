<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * NOTE : ALSO MAKE SURE ALL TRACKING PIXELS ARE ON FOOTER-LANDING.PHP
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */
 ?>
    <?php

	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

<script type="text/javascript" src="http://login.sendmetric.com/phase2/bhecho_files/smartlists/check_entry.js"></script>
<script type="text/javascript">
	<!--
		function check_cdfs(form) {
			return true;
		}
	-->
</script><script type="text/javascript">
<!--
    function doSubmit() {
        if (check_cdfs(document.survey)) {
			window.open('','signup','resizable=1,scrollbars=0,width=300,height=150');
            return true;
        }
        else { return false; }
    }
-->
</script>

    <?php google_tag_manager(); ?>

</body>
</html>
