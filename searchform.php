<?php
/* searchform */
?>
<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ) ?>">
<input type="text" value="<?php echo get_search_query() ?>" name="s" id="s" /><input type="image" id="searchsubmit" value="submit" src="<?php bloginfo('template_url'); ?>/images/icons/search.gif" />
</form>