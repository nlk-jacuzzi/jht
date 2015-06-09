<?php
/**
 * Template Name: Reviews Landing Page
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

$bv = new BV(
    array(
        'deployment_zone_id' => 'ReadOnly-en_US',
        'product_id' => "JHT-ALL-REVIEWS", // must match ExternalID in the BV product feed
        'cloud_key' => 'jacuzzi-6e973cecb3ca4a2d532da7d906a4cc84',
        'staging' => false
        )
    );


?>
<style type="text/css">
.vc_responsive .wpb_row .vc_span12.column_container .wrap {
    width: 960px !important;
    margin: 0 auto !important;
    float: none !important;
}
</style>
<script type="text/javascript">                  
$BV.configure("global", { "productId" : "JHT-ALL-REVIEWS" });
$BV.ui( 'rr', 'show_reviews', {
doShowContent : function () {
    // If the container is hidden (such as behind a tab), put code here to make it visible (open the tab).
}
});
function submitGeneric() {
    $BV.ui(
        "rr",
        "submit_generic",
        { "categoryId" : "JHT" }
    );
}
</script>
    <div class="hero" style="height:72px;"></div>

    <div class="bd">
        <?php the_content(); ?>
        <div class="clearfix"></div>
    </div>

    <div class="bd">
        <div class="wrap">
            <div itemscope itemtype="http://schema.org/Product">
                <meta itemprop="name" content="<?php echo the_title(); ?>" />
                <div id="BVRRContainer">
                    <?php echo $bv->reviews->getContent();?>
                </div>
            </div>
        </div>
    </div>

    <div class="bd">
        <div class="wrap">
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>



