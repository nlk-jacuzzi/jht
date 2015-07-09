<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */
get_header();
while ( have_posts() ) : the_post();

global $post;
/*
$custom = get_post_meta($post->ID,'jht_quickinfo');
$jht_tub_quickinfo = $custom[0];
echo '<pre style="display:none" title="quickinfo">'. print_r($jht_tub_quickinfo,true) .'</pre>';
*/
$custom = get_post_meta($post->ID,'jht_info');
$jht_info = $custom[0];
$custom = get_post_meta($post->ID,'jht_colors');
$jht_colors = $custom[0];
// array(66,68,70...) -> so process it
$o = array();

$args = array( 'numberposts' => -1, 'post_type'=>'jht_color', 'include' => $jht_colors, 'orderby' => 'menu_order', 'order' => 'ASC' );
$thesecolors = get_posts($args);

foreach ( $thesecolors as $c ) {
    $o[$c->ID] = $c->post_title;
}

$jht_colors = $o;

$custom = get_post_meta($post->ID,'jht_cabs');
$jht_cabs = $custom[0];
// array(66,68,70...) -> so process it
$o = array();

$args = array( 'numberposts' => -1, 'post_type'=>'jht_cabinetry', 'include' => $jht_cabs, 'orderby' => 'menu_order', 'order' => 'ASC' );
$thesecolors = get_posts($args);

foreach ( $thesecolors as $c ) {
    $o[$c->ID] = $c->post_title;
}
$jht_cabs = $o;

$custom = get_post_meta($post->ID,'jht_specs');
$jht_specs = $custom[0];
$custom = get_post_meta($post->ID,'jht_feats');
$jht_feats = $custom[0];
$custom = get_post_meta($post->ID,'jht_wars');
$jht_wars = $custom[0];
if ( $jht_wars == '' ) $jht_wars = array();
if ( count($jht_wars) > 0 ) {
    $args = array( 'numberposts' => -1, 'post_type'=>'jht_warranty', 'include' => $jht_wars, 'orderby' => 'menu_order', 'order' => 'ASC' );
    $jht_wars = get_posts($args);
}
$custom = get_post_meta($post->ID,'jht_jets');
$jht_jets = $custom[0];
$jetcount = 0;
foreach ( $jht_jets as $v ) $jetcount += $v;

// transient for jht_alljets
if ( false === ( $special_query_results = get_transient( 'jht_alljets' ) ) ) {
    // It wasn't there, so regenerate the data and save the transient
    $special_query_results = get_posts(array('numberposts'=>-1,'post_type'=>'jht_jet','orderby'=>'menu_order','order'=>'ASC'));
    set_transient( 'jht_alljets', $special_query_results, 60*60*12 );
}
// Use the data like you would have normally...
$alljets = get_transient( 'jht_alljets' );

$prod = esc_attr($jht_specs['product_id']);
$is_staging = jht_my_server() == 'live' ? FALSE : TRUE;
$bv = new BV(
    array(
        'deployment_zone_id' => 'Main_Site-en_US',
        'product_id' => $prod, // must match ExternalID in the BV product feed
        'cloud_key' => 'jacuzzi-6e973cecb3ca4a2d532da7d906a4cc84',
        'staging' => $is_staging
        )
    );

//print('<pre>'); print_r($bv); print('</pre>');
?>
<script>
dataLayer.push({ 
    'pageType':'productPage',
    'msrpStatus':<?php echo ( msrp_display() ? 'MSRP Available' : 'MSRP Not Available' ); ?>, // status if in test market or not - optional
    'event':'pageReady'
});
</script>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            if (typeof tooltip !== 'undefined' && jQuery.isFunction(tooltip)) {
                jQuery( "#monthly-cost" ).tooltip();
            }
        });
    </script>
    <div class="bd" style="margin-top: 110px;">
        <div class="wrap tightgrid">
            <div class="breadcrumb-hottub">
                <?php if(function_exists('bcn_display'))
                {
                    bcn_display();
                }?>
            </div>
        </div>
        <div class="clear"></div>
        <div class="wrap">
            <div class="twoCol extendedCol">
                <div itemscope itemtype="http://schema.org/Product">
                    <div class="main">
                        <div class="hotub-mainimg">
                            <?php
                                if (class_exists('MultiPostThumbnails')) {
                                    MultiPostThumbnails::the_post_thumbnail('jht_tub', 'three-quarter', $post->ID, 'one-half-th', array('class'=>'onehalfs'));
                                }
                            ?>
                        </div>
                        <div class="options" style="width: 100%;">
                            <div class="color-options-box">
                                <h3>Available Shells</h3>
                                <ul>
                                    <?php foreach ( $jht_colors as $i => $t ) {
                                        echo '<li class="has-img-tooltip"><a title="'. $t .'">'. get_the_post_thumbnail( $i, 'options-medium-thumbs') . '</a>';
                                        echo '<div class="tooltip-img" style="display:none;"><div>' . get_the_post_thumbnail($i) . '<p style="padding-top: 6px;">' . $t . '</p></div></div>';
                                        echo '</li>';
                                    } ?>
                                </ul>
                            </div>
                            <div class="cabinetry-options-box">
                                <h3>Cabinets</h3>
                                <ul>
                                    <?php foreach ( $jht_cabs as $i => $t ) {
                                        echo '<li class="has-img-tooltip"><a title="'. $t .'">'. get_the_post_thumbnail( $i, 'options-medium-thumbs') . '</a>';
                                        echo '<div class="tooltip-img" style="display:none;"><div>' . get_the_post_thumbnail($i) . '<p style="padding-top: 6px;">' . $t . '</p></div></div>';
                                        echo '</li>';
                                    } ?>
                                </ul>
                            </div>
                            <div class="clear" style="margin: 0 auto; clear: both;"></div>
                            <div class="color-selector-link">
                                <a class="lightbox-link" onClick="jQuery('.color-selector-modal-bg').show();">View the Jacuzzi Shell & Cabinet Selector</a>
                            </div>
                        </div>
                    </div>
                    <div class="side">
                        <meta itemprop="name" content="<?php echo preg_replace( "/[^A-Za-z0-9 \-]/", '', the_title() ); ?>" />
                        <h1><?php the_title(); ?></h1>
                        <h2><?php esc_attr_e($jht_info['topheadline']); ?></h2>
                            <div id="BVRRSummaryContainer"></div>
                        <div class="specifications">
                            <p><strong>Seats:</strong> <?php esc_attr_e($jht_specs['seats']); ?></p>
                            <p><strong>PowerPro Jets:</strong> <?php echo absint($jetcount); ?></p>
                            <p><strong>Dimensions:</strong> <?php echo ( jht_isca() ) ? esc_attr($jht_specs['dim_int']) : esc_attr($jht_specs['dim_us']); ?></p>
                            <p><strong>Spa Volume:</strong> <?php echo ( jht_isca() ) ? esc_attr($jht_specs['vol_int']) : esc_attr($jht_specs['vol_us']); ?></p>
                        </div>
                        <div class="energy">
                            <h2 class="green"><strong>Energy Efficiency</strong></h2>
                            <div class="efficiency-block">
                                <table cellpadding="0">
                                    <tr>
                                        <td><p><strong>Monthly Cost<span><a href="#" id="monthly-cost" title="Monthly energy costs are estimates based on the results of the California Energy Commissions Portable Hot Tub Testing Protocol. Ambient temperature of 60°F / 15°C and national average of 10 cents per kWh. Actual monthly costs may vary depending on temperature, electricity costs and usage.">(?)</a></span>:</strong></p></td>
                                        <td valign="bottom"><p class="green">$<?php esc_attr_e($jht_specs['emoc']); ?></p></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="warranty-box">
                                <img src="<?php bloginfo('template_url'); ?>/images/warranty_star.png" alt="Warranty 10 years" title="Warranty 10 years"/>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <?php if ( function_exists('msrp_display') && msrp_display() ) : ?>
                            <div class="tub-brochure-pricing">
                                <div class="fullrow">
                                    <div class="twothird msrp">
                                        <a id="show-msrp" href="#" class="getpricing">View MSRP</a>
                                    </div>
                                    <div class="onethird last">
                                        <div class="share-bar">
                                            <?php if(function_exists('sharethis_button')) sharethis_button(); ?>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="tub-brochure-pricing">
                                <div class="fullrow">
                                    <div class="onehalf">
                                        <a class="getpricing" href="<?php bloginfo('url'); ?>/get-a-quote/?tid=<?php echo $post->ID; ?>">Get Pricing</a>
                                    </div>
                                    <div class="onehalf last">
                                        <a class="getpricing" href="<?php bloginfo('url'); ?>/dealer-locator">Find A Dealer</a>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <div class="fullrow">
                                    <div class="twothird">
                                        &nbsp;
                                    </div>
                                    <div class="onethird last">
                                        <div class="share-bar">
                                            <?php if(function_exists('sharethis_button')) sharethis_button(); ?>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php if ( function_exists('msrp_display') && msrp_display() ) : ?>
            <?php
            $msrp = esc_attr($jht_specs['msrp']);
            $msrp = ( $msrp[0] == '$' ? $msrp : '$'.$msrp );
            ?>
            <div class="container msrp" style="display:none;">
                <div class="l">
                    <p class="msrp-disclaimer">Disclaimer</p>
                    <p>Prices listed are Manufacturer's Suggested Retail Price (MSRP). Prices may not include additional fees, see authorized dealer for details.</p>
                </div>
                <div class="r">
                    <?php echo '<p class="msrp-price"><span>' . $msrp . '</span> MSRP</p>'; ?>
                    <a class="msrp-dealer" href="<?php bloginfo('url'); ?>/dealer-locator/">Find Your Nearest Dealer</a>
                    <a class="msrp-pricing" href="<?php bloginfo('url'); ?>/get-a-quote/?tid=<?php echo $post->ID; ?>">Request Pricing from Dealer</a>
                </div>
            </div>
        <?php endif; ?>
            <div class="container">
                <div class="wrap hot-tub-extradesc">
                    <div class="twoCol">
                        <div class="main">
                            <?php the_content(); ?>
                        </div>
                        <div class="side">
                            <center>
                                    <?php 
                                        if (class_exists('MultiPostThumbnails')) {
                                            MultiPostThumbnails::the_post_thumbnail('jht_tub', 'overhead-large', $post->ID, 'overhead-medium', array('class'=>'overhead-medium'));
                                        } 
                                    ?>
                            </center>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <ul class="tabs" id="tubtabs">
                    <li class="current"><a href="#features-options">Features &amp; Options</a></li>
                    <li><a href="#jets">Jets</a></li>
                    <li><a href="#specs">Specifications</a></li>
                    <li><a href="#warranty">Warranty</a></li>
                    <li><a href="#reviews">Reviews</a></li>
                </ul>
                <div class="twoCol">
                    <div class="main">
                    
                        <div id="features-options" class="tab" style="display:block">
                            <h2 class="tabtitle">Features &amp; Options</h2>
                            <p><?php esc_attr_e($jht_info['featureblurb']); ?></p>
                            <div class="features">
                                <?php
                                foreach ( $jht_feats as $fid ) {
                                    $feat = get_post($fid);
                                    ?>
                                <div class="feature withimage">
                                    <?php echo get_the_post_thumbnail($fid, 'feature-option'); ?>
                                    <h2><?php esc_attr_e($feat->post_title); ?></h2>
                                    <?php echo apply_filters('the_content', $feat->post_content); ?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div id="jets" class="tab" >
                            <div class="half">
                                <div class="description">
                                    <div class="inner">
                                        <h2>EXCLUSIVE JET TECHNOLOGY</h2>
                                        <p>Jacuzzi&reg; Brand PowerPro&reg; Jets deliver a high volume, low pressure hydromassage through Aqualibrium&trade;: the perfect mix of air and water. As the first company to pioneer jetted water technology, only Jacuzzi&reg; can deliver a massage experience that a legacy that spans nearly 60 years can bring.</p>
                                        <!--div class="arrow-right"><a href="#">Roll Over Plus Signs for more Jet Info</a></div-->
                                    </div>
                                </div>
                                <div class="rollover">
                                <?php
                                    if (class_exists('MultiPostThumbnails')) {
                                        MultiPostThumbnails::the_post_thumbnail('jht_tub', 'overhead-large', $post->ID, 'overhead');
                                    }
                                ?>
                                </div>
                            </div>
                            <div class="jet-details">
                            <?php
                            $i = 0;
                            foreach( $jht_jets as $j => $c ) {
                                if ( absint($c) > 0 ) { ?>
                                <div class="jet-detail">
                                    <?php echo get_the_post_thumbnail( $j, 'jet', array('class'=>'alignleft')); ?>
                                    <h2><?php esc_attr_e($alljets[$i]->post_title); ?> Jets <span class="count">(<?php echo absint($c); ?>)</span></h2>
                                    <?php echo apply_filters('the_content', $alljets[$i]->post_content); ?>
                                    <br class="clear" />
                                </div>
                                <?php
                                }
                                $i++;
                            }?>
                            </div>
                        </div>

                        <div id="specs" class="specifications tab" >
                            <h3>Overview</h3>
                            <table cellspacing="0">
                                <tr class="line1">
                                    <td>Seating Capacity</td>
                                    <td><?php esc_attr_e($jht_specs['seats']); ?></td>
                                </tr>
                                <tr>
                                    <td>Dimensions</td>
                                    <td><?php echo esc_attr($jht_specs['dim_us']) .(($jht_specs['dim_us'] . $jht_specs['dim_int']) != '' ? ' / ' : ''). esc_attr($jht_specs['dim_int']); ?></td>
                                </tr>
                                <tr>
                                    <td>Average Spa Volume</td>
                                    <td><?php echo esc_attr($jht_specs['vol_us']) .(($jht_specs['vol_us'] . $jht_specs['vol_int']) != '' ? ' / ' : ''). esc_attr($jht_specs['vol_int']); ?></td>
                                </tr>
                                <tr>
                                    <td>Dry Weight</td>
                                    <td><?php esc_attr_e($jht_specs['dry_weight']); ?></td>
                                </tr>
                                <tr>
                                    <td>Total Filled Weight</td>
                                    <td><?php esc_attr_e($jht_specs['filled']); ?></td>
                                </tr>
                                <?php
                                for ( $i = 1; $i < 4; $i++ ) {
                                if ( isset($jht_specs['pump'.$i]) ) if ( $jht_specs['pump'. $i] != '' ) { ?>
                                <tr>
                                    <td>Pump <?php echo $i ?></td>
                                    <td><?php echo nl2br(esc_attr($jht_specs['pump'. $i])); ?></td>
                                </tr>
                                <?php
                                }
                                }
                                ?>
                                <tr>
                                    <td>Circulation Pump</td>
                                    <td><?php esc_attr_e($jht_specs['circulation']); ?></td>
                                </tr>
                                <tr>
                                    <td>Diverter Valves</td>
                                    <td><?php echo absint($jht_specs['diverter']); ?></td>
                                </tr>
                                <?php
                                if ( !isset($jht_specs['wps']) ) $jht_specs['wps'] = 'CLEAR<strong>RAY</strong>&trade;'; // hax
                                if ( isset($jht_specs['wps']) ) if ( $jht_specs['wps'] != '' ) { ?>
                                <tr>
                                    <td>Water Purification System</td>
                                    <td><?php echo $jht_specs['wps']; ?></td>
                                </tr>
                                <?php } ?>
                                <?php if ( isset($jht_specs['filtration']) ) if ( $jht_specs['filtration'] != '' ) { ?>
                                <tr>
                                    <td>Filtration</td>
                                    <td><?php esc_attr_e($jht_specs['filtration']); ?></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td>Filters</td>
                                    <td><?php echo nl2br(esc_attr($jht_specs['filters'])); ?></td>
                                </tr>
                                <tr>
                                    <td>Electrical North America</td>
                                    <td><?php esc_attr_e($jht_specs['elec_na']); ?></td>
                                </tr>
                                <tr>
                                    <td>Electrical International</td>
                                    <td><?php esc_attr_e($jht_specs['elec_int']); ?></td>
                                </tr>
                            </table>
                            <h3>Colors &amp; Cabinetry</h3>
                            <table cellspacing="0">
                                <tr class="line1">
                                    <td>Cabinetry</td>
                                    <td><?php echo implode(', ', $jht_cabs); ?></td>
                                </tr>
                                <tr>
                                    <td>Shell Colors**</td>
                                    <td><?php echo implode(', ', $jht_colors); ?></td>
                                </tr>
                            </table>
                            <h3>Jets</h3>
                            <table cellspacing="0">
                                <tr class="line1">
                                    <td>Total Jets</td>
                                    <td><?php echo absint($jetcount); ?></td>
                                </tr>
                                <?php
                                $i = 0;
                                foreach ( $jht_jets as $j => $c ) {
                                    $c = absint($c);
                                    if ( $c > 0 ) {
                                    ?>
                                <tr>
                                    <td><?php esc_attr_e($alljets[$i]->post_title); ?></td>
                                    <td><?php echo $c; ?></td>
                                </tr><?php
                                    }
                                    $i++;
                                }
                                ?>
                            </table>
                            <p class="note"><small><strong>NOTE:</strong> Spa Volume is based on average fill.<br /><br />
                                Jacuzzi Hot Tubs may make product modifications and enhancements. Specifications may change without notice. International products may be configured differently to meet local electrical requirements. Dimensions are approximate. Spa volume is based on average fill. Manufactured under one or more United States patent numbers. Other patents may apply.<br /><br />
                                Estimated monthly cost is based on CEC test protocol for standby power consumption only. Test results measured in a controlled environment based on a kilowatt rate per hour of $0.10. Local and future energy rates, local conditions and individual use will alter these estimated monthly costs.For complete CEC test protocol and results visit http://www.energy.ca.gov<br /><br />
                                * Pump input or brake horsepower (bhp) is the actual horsepower delivered to the pump shaft. Source: ITT Goulds Pumps, Centrifugal Pump Fundamentals.<br />
                                ** Selection may vary by dealer</small></p>
                        </div>

                        <div id="warranty" class="tab" >
                            <h2 class="tabtitle">Available Warranties</h2>
                            <h2>Warranty Info: <?php the_title(); ?></h2>
                            <div class="warranties">
                                <?php foreach ( $jht_wars as $p ) { ?>
                                <div class="warranty">
                                    <p><?php echo get_the_post_thumbnail($p->ID, 'warranty', array('class'=>'alignleft')); ?><?php echo esc_attr($p->post_title) .' - '. catch_warranty_details_h4( $p->post_content ); ?></p>
                                </div>
                                <?php } ?>
                            </div>
                            <p class="note">For complete warranty information, please visit our <a href="<?php echo get_permalink(4169) ?>">warranty page</a></p>
                        </div>

                        <div id="reviews" class="tab" >
                            <div class="inner">
                                <?php if ( ! empty($bv) ) : ?>
                                    <div id="BVRRContainer">
                                        <?php echo $bv->reviews->getContent();?>
                                    </div>
                                    <script type="text/javascript">
                                    $BV.ui( 'rr', 'show_reviews', {
                                    doShowContent : function () {
                                    // If the container is hidden (such as behind a tab), put code here to make it visible (open the tab).
                                        var tab = $('ul#tubtabs li.current a').attr('href');
                                        tab.replace('#','');
                                        $('ul#tubtabs li.current').removeClass('current');
                                        $('div#'+tab+'.tab').css('display','none');
                                        $('li a[href="#reviews"]').parent().addClass('current');
                                        $('#reviews').css('display', 'block');
                                    }
                                    });
                                    </script>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                    <div class="side">
                        <div class="scall bro newbro">
                            <img src="<?php bloginfo('template_url'); ?>/images/free_brochure_title.png" class="title-img" />
                            <a href="<?php echo get_permalink(3745); ?>?tid=<?php echo $post->ID; ?>"><strong>Free</strong> Brochure</a>
                            <div class="clear"></div>
                            <a class="getpricing" href="<?php echo get_permalink(3745); ?>?tid=<?php echo $post->ID; ?>">Download</a>
                        </div>
                        <div class="scall quo"><a href="<?php echo get_bloginfo('url'); ?>/financing/?tid=<?php echo $post->ID; ?>"><strong>Hot Tub</strong> Financing</a></div>
                        <div class="scall quo"><a href="<?php echo get_bloginfo('url'); ?>/trade-in-value/?tid=<?php echo $post->ID; ?>"><strong>Trade-In</strong> Value</a></div>
                        <!-- <div class="scall quo"><a class="getpricing" href="<?php bloginfo('url'); ?>/get-a-quote/?tid=<?php echo $post->ID; ?>">Get Pricing</a></div> -->
                        <a class="getpricing" href="<?php echo get_bloginfo('url'); ?>/get-a-quote/?tid=<?php echo $post->ID; ?>" style="margin-top: 20px;">Get Pricing</a>
                    </div>
                </div>
                <h3 class="to-top"><a href="#top"><span class="icon upArrow"></span>Back to Top</a></h3>
            </div><br /><br />
            <div class="color-selector-modal-bg" style="display: none;">
                <div class="color-selector-modal">
                    <div class="color-selector-modal-title"><h2>Hot Tub Color Selector</h2><span><a id="close-cs-modal">close</a></div>
                    <?php get_template_part('block', 'color_selector'); ?>
                </div>
            </div>
<?php
endwhile;
get_footer(); ?>