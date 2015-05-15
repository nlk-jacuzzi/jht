<?php

/**
 *	Template Part : Home Page Hero
 *
 *	get_template_part('part', 'home_hero');
 *
 **/

$show_promo = true;

$promo_start = "5/15/2015"; // promo to begin displaying on... leave time blank to start showing at 00:00:00 morning of
$promo_end = "6/1/2015"; // promo to end display as of... add an extra day to stop display at midnight the day before, otherwise include time as 00:00:00


if ( $show_promo && time() > date("U", strtotime($promo_start)) && time() < date("U", strtotime($promo_end)) ): ?>

    <?php /* * * * * PROMOTIONS HOME PAGE HERO BLOCK * * * * */ ?>
    <?php

    $promo_image_filename .= 'spring-promo-2015.jpg'; // promo image filename

    // promo button settings
    $promo_cta_btn_url = get_bloginfo('url') . '/promo/'; //link for promo button

    $promo_cta_btn_styles = array(
        "color"         => "transparent", //do not edit
        "display"       => "block", //do not edit
        "height"        => "36px",
        "left"          => "57px",
        "position"      => "absolute", //do not edit
        "text-indent"   => "-9999px", //do not edit
        "top"           => "249px",
        "width"         => "231px",
        );

    // do not edit
    $promo_cta_btn_style = ' style="';
    foreach ($promo_cta_btn_styles as $key => $value) {
        $promo_cta_btn_style .= $key . ': ' . $value . '; ';
    }
    $promo_cta_btn_style .= '" ';
    $promo_image_url = '/images/heros/' . $promo_image_filename; // hero image root

    ?>
    <div class="hero" style="background: url(<?php echo get_template_directory_uri() . $promo_image_url; ?>) no-repeat 50% 85%;">
        <div id="hero-slide-1" class="block" style="height: 316px;">
            <!--a id="hero-promotion-call-to-action" class="" href="<?php echo ( !empty($promo_cta_btn_url) ? $promo_cta_btn_url : get_bloginfo('url') . '/promo/' ); ?>" <?php echo $promo_cta_btn_style ?>>View Promotions</a-->
        </div>
    </div>

<?php else : ?>

    <?php /* * * * * DEFAULT HOME PAGE HERO BLOCK * * * * */ ?>

    <?php /*
    <div class="hero" style="background: url(<?php echo get_template_directory_uri(); ?>/images/bg/site-tuners-front-hero.png) no-repeat 50% 50%;">
        <div id="hero-slide-1" class="block">
            <h2>For Those Seeking <strong>Relaxation</strong> &amp; <strong>Healing</strong>...<br />Indulge in a Jacuzzi<sup>&reg;</sup> Hot Tub</h2>
            <h3>Experience therapeutic hydrotherapy<br />Over 100 years of innovation<br />Refresh &amp; rejuvinate</h3>
            <a id="hero-view-tubs" class="btn cta" href="<?php echo get_bloginfo('url'); ?>/hot-tubs/">View Hot Tubs</a>
            <a id="hero-view-hydro" class="btn dull" href="<?php echo get_bloginfo('url'); ?>/hydrotherapy/">Why Hydrotherapy Works</a>
        </div>
    </div>
    */ ?>

    <?php /* * * * * DEFAULT HOME PAGE J-500 HERO BLOCK * * * * */ ?>
    <div class="hero" style="background: url(<?php echo get_template_directory_uri(); ?>/images/heros/Final-Home-Hero-J500_op.jpg) no-repeat 50% 50%;">
        <div id="hero-slide-1" class="block">
            <a href="<?php echo get_bloginfo('url'); ?>/j-500/" target="_blank" style="position: absolute; color: transparent; width: 190px; height: 40px; top: 240px; left: 3px;">See it in person</a>
        </div>
    </div>

<?php endif; ?>