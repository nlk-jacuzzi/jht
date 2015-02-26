<?php
/**
 * Template Name: Direct
 *
 * Direct Page template.
 *
 * @package JacuzziDirect
 * @since JacuzziDirect 1.0
 */
global $post, $wp_query;
if(isset($wp_query->query_vars['keyword'])) {
	$wp_query->query_vars['kw'] = $wp_query->query_vars['keyword'];
}

$custom = get_post_meta($post->ID,'_progo');
$direct = $custom[0];

$errors = avala_form_submit();
/*$formerrors = array();
if(isset($_POST[person])) {
	$postvars = http_build_query($_POST);
	$ch = curl_init();
	$url = 'http://jacuzzi.techbarn.com/service/jht_'. $direct['form'];
	
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
	
	$data = curl_exec($ch);
	curl_close($ch);
	//echo $data;
	$xml = new SimpleXMLElement($data);
	foreach($xml->children() as $el => $child) {
		if($el == 'error') {
			$formerrors[] = $child;
		} else { //if($el == 'order_id') {
			$kw = $direct['thx'];
			if(isset($wp_query->query_vars['kw']) && $wp_query->query_vars['kw'] != '') {
				$kw .= $wp_query->query_vars['kw'] .'/';
			}
			wp_redirect( $kw );
			exit;
		}
	}
	if(count($formerrors) > 0) {
		global $wp_query;
		$wp_query->query_vars['jht_formerrors'] = $formerrors;
	}
}*/
get_header('direct'); 

if ($errors) echo $errors;

$options = get_option('progo_options'); ?>
<div id="top">
<?php if ( have_posts() ) while ( have_posts() ) : the_post();

if ( $direct[plink] == 0 ) {
	// try to always have SOME product to show...
	$direct[plink] = progo_default_product_id();
}

$direct[productmeta] = get_post_meta($direct[plink],'_wpsc_product_metadata',true);

if(has_post_thumbnail($post->ID)) {
	// post Featured Image overwrites product image & bullet points...
	$pagetitle = esc_attr(the_title('','',false));
	if(isset($wp_query->query_vars['kw']) && $wp_query->query_vars['kw'] != '') {
		$pagetitle = $wp_query->query_vars['kw'];
		$pagetitle = ucwords(str_replace('-',' ',$kw));
	}
	echo get_the_post_thumbnail( $post->ID, 'original', array('id'=>'topimg', 'alt'=>$pagetitle, 'title'=>$pagetitle));
}

get_sidebar($direct['form'] .'form');
?>
<div id="arrow"><span><?php echo wp_kses($direct[arrowd],array()); ?></span></div>
<div id="tend"></div>
</div>
    <div id="container" class="container_12 direct">
        <div id="main" role="main" class="grid_8">
				<div id="bodycontent">
						<?php the_content(); ?>
	<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
				</div><!-- #post-## -->
<?php endwhile; ?>
			</div><!-- #main -->
            <div class="grid_4 omega" id="side">
            <?php get_sidebar('direct'); ?>
            </div>
		</div><!-- #container -->
<?php get_footer('direct'); ?>