<?php
/**
 * Template Name: Sitemap
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

get_header();
global $tubcats; // listing all tubs?
?>
    <div class="hero">
    	<div class="wrap">
            <h1 class="title">Sitemap</h1>
        </div>
    </div>
    <div class="goldBar10"></div>
    <div class="bd">
    	<div class="wrap">
                <div class="main sitemap">
                    <table width="940">
                    <tr valign="top"><td width="25%">
                    <ul>
                        <li class="title"><a href="<?php echo get_permalink(8) ?>">Hot Tubs</a></li>
                        <li><a href="<?php echo get_permalink(13) ?>">6+ People</a></li>
                        <li><a href="<?php echo get_permalink(20) ?>">5-6 People</a></li>
                        <li><a href="<?php echo get_permalink(26) ?>">4-5 People</a></li>
                        <li><a href="<?php echo get_permalink(34) ?>">4 or Fewer People</a></li>
                        <li><a href="<?php echo get_permalink(39) ?>">Best Selling</a></li>
                    </ul>
                    <ul>
                        <li class="title"><a href="<?php echo get_permalink(44) ?>">Collections</a></li>
                        <?php
						$collid = jht_get_collectionslandingid2();
						
						foreach ( $tubcats[$collid]['subcats'] as $s ) { ?>
                        <li><a href="<?php echo esc_url($s['url']) ?>"><?php echo $s['fullname'] ?></a>
                            <ul>
                            <?php foreach ( $s['tubs'] as $t ) { ?>
                            		<li><a href="<?php echo get_bloginfo('url') . esc_url($t['url']); ?>"><?php echo $t['name'] ?></a></li>
                            <?php } ?>
                            </ul>
                        </li>
						<?php } ?>
                    </ul>
                    </td><td width="25%">
                    <ul>
                    <li class="title"><a href="<?php echo get_permalink(3749) ?>">About</a></li>
                    <?php wp_list_pages('include=3803,3805,3899&title_li=&depth=-1'); ?>
                    <li><a href="<?php echo get_permalink(3749) ?>">History of Jacuzzi</a></li>
                    <?php wp_list_pages('include=3913,3908&title_li=&depth=-1'); ?>
                    </ul>
                    <ul>
                    <?php wp_list_pages('include=3886,3888&title_li='); ?>
                    <li><a href="<?php echo get_permalink(3745) ?>">Free Brochure</a></li>
                    <li><a href="<?php echo get_permalink(3743) ?>">Request a Quote</a></li>
                    <li><a href="<?php echo get_permalink(7759) ?>">Trade-In Value</a></li>
                    <?php wp_list_pages('include=4397,4403&title_li='); ?>
                    <li><a href="<?php bloginfo('url'); ?>/dealer-locator/">Locate a Dealer</a></li>
                    <li><a href="<?php echo get_permalink(5) ?>">Jacuzzi Blog</a></li>
                    </ul>
                    <ul>
                        <li class="title"><a href="<?php echo get_permalink(3884) ?>">Customer Support</a></li>
                        <?php wp_list_pages('include=3884,3881,4169,4392,3941,3943,3747,3987,3989,3996,3999&title_li=&depth=-1'); ?>
                    </ul>
                    </td><td width="25%">
                    <ul>
                        <li class="title"><a href="<?php echo get_permalink(4282) ?>">Accessories</a></li>
                        <li><a href="<?php echo get_permalink(4282) ?>">Jacuzzi Exclusives</a></li>
                        <?php
                        // transient for jht_acc_cats
						if ( false === ( $special_query_results = get_transient( 'jht_acc_cats' ) ) ) {
							// It wasn't there, so regenerate the data and save the transient
							$special_query_results = get_terms('jht_acc_cat', array(
								'orderby' => 'id',
							));
							set_transient( 'jht_acc_cats', $special_query_results, 60*60*12 );
						}
						// Use the data like you would have normally...
						$acts = get_transient( 'jht_acc_cats' );
						
						foreach ( $acts as $s ) { 
							echo '<li><a href="'. get_term_link($s) .'">'. $s->name .'</a>';
							
							// transient for accessories inside each cat
							$tname = $s->slug .'-accs';
							if ( false === ( $special_query_results = get_transient( $tname ) ) ) {
								// It wasn't there, so regenerate the data and save the transient
								$special_query_results = get_posts(array(
									'numberposts' => -1,
									'post_type' => 'jht_acc',
									'orderby' => 'menu_order',
									'order' => 'ASC',
									'jht_acc_cat' => $s->slug,
								));
								set_transient( $tname, $special_query_results, 60*60*12 );
							}
							// Use the data like you would have normally...
							$acc = get_transient( $tname );
							echo '<ul>';
							foreach ( $acc as $t ) {
								echo '<li><a href="'. get_permalink($t->ID) .'">'. esc_attr($t->post_title) .'</a></li>';
							}
							echo '</ul>';
							?>
							</li>
						<?php } ?>
                    </ul>
                    </td><td width="25%">
                    <ul style="margin-bottom: 0">
                    <li class="title"><a>Resources</a></li>
                    </ul>
                    <?php wp_nav_menu( array( 'container' => 'false', 'menu_id' => 'resourceMenu', 'theme_location' => 'ftres' ) ); ?>
                    </td></tr>
                    </table>
                </div>
<?php get_footer(); ?>
