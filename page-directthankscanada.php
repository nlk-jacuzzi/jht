<?php
/**
 * Template Name: Direct - Thanks Canada
 *
 * Thank You Page template.
 *
 * @package JacuzziDirect
 * @since JacuzziDirect 1.0
 */
get_header('direct'); ?>
<div id="top">
<?php if ( have_posts() ) while ( have_posts() ) : the_post();

if(has_post_thumbnail($post->ID)) {
	// post Featured Image overwrites product image & bullet points...
	$pagetitle = esc_attr(the_title('','',false));
	if(isset($wp_query->query_vars['kw']) && $wp_query->query_vars['kw'] != '') {
		$pagetitle = $wp_query->query_vars['kw'];
		$pagetitle = ucwords(str_replace('-',' ',$kw));
	}
	echo get_the_post_thumbnail( $post->ID, 'original', array('id'=>'topimg', 'alt'=>$pagetitle, 'title'=>$pagetitle));
}
?>
<div id="right">
<div class="block thx"><div class="inside"><?php the_content(); ?></div></div>
<?php endwhile;
get_sidebar('thanksca');
?>
</div>
<div id="tend"></div>
</div>
<script type="text/javascript" src="http://inttrax.com/pixel.js?cid=15293&trid="></script>
<script type="text/javascript" src="http://inttrax.com/pixel.js?cid=15292&trid="></script>
<?php get_footer('canada'); ?>
