<?php

global $post;
$menucustom = get_post_meta($post->ID,'jht_menuoption');
$menuopts = isset($menucustom[0]) ? $menucustom[0] : array();

if ( !isset($menuopts['silver']) || $menuopts['silver'] !== 'No' ) {
	get_sidebar('silverMenu');
}

if ( !isset($menuopts['ctafoot']) || $menuopts['ctafoot'] !== 'No' ) { ?>
            <div class="threeCol ctafoot">
                <div class="col col1 locatedealer">
					<p>See New Jacuzzi Hot Tubs and Get Expert Advice</p>
					<a class="goldButton-290 dealer" href="<?php bloginfo('url'); ?>/dealer-locator/"></a>
                </div>
                <div class="col col2 getbrochure">
					<p>Get a Free Brochure and Learn Even More</p>
					<a class="goldButton-290 brochure" href="<?php bloginfo('url'); ?>/request-brochure/"></a>
                </div>
                <div class="col col3 warranty">
                    <h3 class="bigtitle">Industry Leading <span>10 Year Warranty!</span></h3>
                    <a href="<?php echo get_permalink(3881) ?>"><img class="alignleft" src="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/icons/warranty-star.jpg" style="padding-bottom:50px;" /></a>
                </div>
            </div>
<?php } ?>