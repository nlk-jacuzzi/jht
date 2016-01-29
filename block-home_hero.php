<?php

/**
 *	Template Part : Home Page Hero
 *
 *	get_template_part('part', 'home_hero');
 *
 **/

$show_promo = true;

$promo_start = "12/10/2015"; // promo to begin displaying on... leave time blank to start showing at 00:00:00 morning of
$promo_end = "12/14/2015 23:59:59"; // promo to end display as of... add an extra day to stop display at midnight the day before, otherwise include time as 00:00:00
$promo_image_filename = '';

if ( $show_promo && time() > date("U", strtotime($promo_start)) && time() < date("U", strtotime($promo_end)) ): ?>

    <?php /* * * * * PROMOTIONS HOME PAGE HERO BLOCK * * * * */ ?>
    <?php

    $promo_image_filename = 'hero12112015.jpg'; // promo image filename

    // promo button settings
    $promo_cta_btn_url = get_bloginfo('url') . '/promo/'; //link for promo button

    $promo_cta_btn_styles = array(
        "color"         => "transparent", //do not edit
        "display"       => "block", //do not edit
        "height"        => "100%",
        //"left"          => "57px",
        "position"      => "absolute", //do not edit
        "text-indent"   => "-9999px", //do not edit
        //"top"           => "249px",
        "width"         => "100%",
        );

    // do not edit
    $promo_cta_btn_style = ' style="';
    foreach ($promo_cta_btn_styles as $key => $value) {
        $promo_cta_btn_style .= $key . ': ' . $value . '; ';
    }
    $promo_cta_btn_style .= '" ';
    $promo_image_url = get_bloginfo('url') . '/wp-content/themes/jht/images/heros/' . $promo_image_filename; // hero image root

    ?>
    <div class="hero" style="background: url(<?php echo $promo_image_url; ?>) no-repeat 50% 50%; background-color: #fff;">
        <div id="hero-slide-1" class="block" style="height: 390px;">
            <a id="hero-promotion-call-to-action" class="" href="<?php echo ( !empty($promo_cta_btn_url) ? $promo_cta_btn_url : 'http://www.jacuzzi.com/hot-tubs' . '/promo/' ); ?>" <?php echo $promo_cta_btn_style ?>>View Promotions</a>
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
    <!-- <div class="hero" style="background: url(http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/heros/Prolink-Hotubs-hero.jpg) no-repeat 50% 50%;">
        <div id="hero-slide-1" class="block">
            <a href="http://www.jacuzzi.com/hot-tubs/j-500/" style="position: absolute; color: transparent; width: 330px; height: 40px; top: 127px; left: 10px;">See it in person</a>
            <a href="http://www.jacuzzi.com/hot-tubs/owners-corner/remote-control/" style="position: absolute; color: transparent; width: 116px; height: 20px; top: 295px; left: 80px;">Prolink App</a>
        </div>
    </div> -->
    <?php /* * * * * HOME PAGE SELECTOR HERO BLOCK * * * * */ ?>
    <div class="hero" style="background: url(<?php echo get_bloginfo('url'); ?>/wp-content/themes/jht/images/heros/Selector_Hero_V5.jpg) no-repeat 50% 50%;">
        <div id="hero-slide-1" class="block">
            <a href="<?php echo get_bloginfo('url'); ?>/selector/" style="position: absolute; color: transparent; width: 330px; height: 40px; top: 127px; left: 10px;">See it in person</a>
        </div>
    </div>

<?php endif; ?>