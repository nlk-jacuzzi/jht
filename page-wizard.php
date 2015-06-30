<?php
/**
  * Template Name: Hot Tub Wizard
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
*/

get_header();
if ( have_posts() ) while ( have_posts() ) : the_post();
$custom = get_post_meta($post->ID,'jht_pageopts');
$pageopts = $custom[0];
$titleoverride = false;
if ( isset($pageopts['o']) ) if ( $pageopts['o'] != '' ) $titleoverride = $pageopts['o'];

if ( has_post_thumbnail() ) {
	$landing_img = '';
	$img_id = get_post_meta( $post->ID, '_thumbnail_id', true );
	if ( $img_id ) {
		$img = get_post($img_id);
		$landing_img = "background-image: url('". $img->guid ."')";
	}
	?>
    <div class="hero" style="<?php echo $landing_img ?>">
    	<div class="wrap">
        	<div class="inner">
            	<h1 style="line-height:48px"><?php if ( $titleoverride ) { echo $titleoverride; } else { the_title(); } ?></h1>
            </div>
<?php } else { ?>
    <div class="hero">
    	<div class="wrap">
            <h1 class="title"><?php if ( $titleoverride ) { esc_attr_e(wp_kses($titleoverride, array())); } else { the_title(); } ?></h1>
<?php } ?>
        </div>
    </div>
    <div class="goldBar10"></div>
    <div class="bd">
    	<div class="wrap">
            <div class="twoCol">
                <div class="side">
                	<?php $post_types = get_post_types( '', 'names' ); ?>
                    <ul>
                    <?php foreach ( $post_types as $post_type ) {
                       echo '<li>' . $post_type . '</li>';
                    } ?>
                    </ul>
                    <pre><?php print_r(get_post_meta(11485)); ?></pre>
                </div>
                <div class="main">

                    


<?php

$args = array(
    'posts_per_page'   => 5,
    'offset'           => 0,
    'category'         => '',
    'category_name'    => '',
    'post_type'        => 'jht_tub',
    'post_status'      => 'publish',
    'meta_query' => array(
        'relation' => 'AND',
        array(
            'key'     => 'haslounge',
            'value'   => 'yes',
            'compare' => '=',
        ),
        array(
            'key'     => 'wizid',
            'value'   => 'performance',
            'compare' => '=',
        ),
    ),
);
// The Query
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) { ?>

<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <div id="post-<?php the_ID(); ?>" class="entry">
            <!--div class="share-icons"></div-->
            <h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'jht' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

            <div class="post-meta">
                <?php jht_posted_on(); ?>
            </div><!-- .entry-meta -->

            <div class="post-content">
                <?php the_content( __( 'more', 'jht' ) ); ?>
            </div><!-- .entry-content -->

            <div class="share-this"><?php if(function_exists('sharethis_button')) sharethis_button(); ?></div>
        </div><!-- #post-## -->
<?php endwhile; // End the loop. Whew. ?>

<?php }
/* Restore original Post Data */
wp_reset_postdata();
?>








                </div>
            </div>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
