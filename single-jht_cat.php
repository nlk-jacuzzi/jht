<?php
/**
 * Template Name: Collections Single
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
?>
    <div class="hero all-tubs "<?php
	if (class_exists('MultiPostThumbnails')) {
		$img_id = MultiPostThumbnails::get_post_thumbnail_id('jht_cat', 'background-image', $post->ID);
		if ( $img_id ) {
			$img = get_post($img_id);
			echo ' style="background: #000 url('. $img->guid .') 50% 0 no-repeat"';
		}
	}
?>>
    	<div class="wrap">
        	<div class="inner detail-desc-intro">
        		<div class="cat-head-spacer">
        			<div class="boxx" ></div>
	                <?php // rather than the_content(), first just show more
					$allcontent = $post->post_content;
					$hasmore = false;
					$firstcontent = $allcontent;
					$morecontent = '';
					$morestart = strpos($allcontent, '<!--more-->');
					if ( $morestart ) {
						$firstcontent = substr($allcontent, 0, $morestart) .'<a href="#" rel="ShowMoreInfoAlt">...</a>';
						$hasmore = true;
					}
					echo apply_filters( 'the_content', $firstcontent );
					?>
				</div>
            </div>
            <div class="tub-grid">
            <?php if ( $hasmore ) {
				echo '<div class="more"><a href="#" rel="ShowMoreInfo"><span>More Info </span><span class="plus">+</span></a></div>';
				echo '<div id="moreinfo">'. apply_filters( 'the_content', $post->post_content ) .'</div>';
			} ?>
            	<div class="goldBar8"></div>
            	<div class="side">
                	

                    <?php
                    // Old sidebar menu on Hot Tubs Category Pages
	                    //get_sidebar('freeBrochure');
	                    //get_sidebar('requestQuote');
	                    //get_sidebar('tradeIn');
	                    //get_sidebar('requestAppointment');

                    // New Buttons and images
					?>
					<div class="tub-brochure-pricing">
						<div>
							<a class="gold-button-208" href="<?php bloginfo('url'); ?>/request-brochure/"><span class="the-content">Free Brochure<span>></span></span></a>
						</div>
						<div class="pages40">
							<img src="<?php bloginfo('template_url'); ?>/images/callouts/40-pages-thumb.png" />
						</div>
						<div class="greyln">
							<?php get_sidebar('buyersguidebtn'); ?>
						</div>
					</div>

					<ul class="tub-menu-category greyln">
	                    <?php global $tubcats;
						global $polylang;
						//echo '<pre id="polylanghere" style="display:none">'. print_r($polylang,true) .'</pre>';
						//echo '<pre id="tubcatshere" style="display:none" title="post-'. $post->ID .'">'. print_r($tubcats,true) .'</pre>';
						
						foreach ( $tubcats as $k => $c ) {
							$showlink = true;
							if ( !empty($polylang) ) {
								$curlang = $polylang->curlang->slug;
								
								if ( function_exists('jhtpolylangfix_servercheck') ) {
									$curlang = jhtpolylangfix_servercheck() ? 'ca' : 'en';
								}
								
								if ( $c['lang'] != $curlang ) {
									$showlink = false;
								}
							}
							if ( $c['name'] == 'Hot Tubs' ) $showlink = false;
							
							if ( $showlink ) {
								echo '<li'. ( in_array($k, array($post->ID, $post->post_parent)) ? ' class="current"' : '') .'><a href="'. $c['url'] .'">'. $c['name'] .'</a>';
								if ( isset($c['subcats']) ) {
									echo '<ul>';
									foreach ( $c['subcats'] as $i => $s ) {
										echo '<li'. ($i==$post->ID ? ' class="current"' : '') .'><a href="'. $s['url'] .'">'. $s['name'] .'</a>';
									}
									echo '</ul>';
								}
								echo '</li>';
							}
						}
						?>
                    </ul>


                    <div class="share greyln">
                    	<?php //<h3>Share This</h3> ?>
                        <div class="share-bar">
                        <?php if(function_exists('sharethis_button')) sharethis_button(); ?>
                        </div>
                    </div>
                </div>
                <div class="main">
                	<ul class="grid3">
                    	<?php
						
						$usid = jht_get_collectionslandingid( true );
						$caid = jht_get_collectionslandingid( false );
						
						if ( in_array($post->ID, array($usid, $caid)) ) { // HOT TUBS landing page
							foreach ( $tubcats as $k => $c ) {
								echo '<li class="cell"';
								$bg_id = get_post_thumbnail_id($k);
								if ( $bg_id ) {
									$img = get_post($bg_id);
									echo ' style="background: url('. $img->guid .') 50% 50% no-repeat"';
								}
								echo '>';
								?>
								<div class="inner">
									<h2 class="ct"><?php esc_attr_e($c['name']) ?></h2>
									<p><a href="<?php echo esc_url($c['url']); ?>">View Hot Tubs</a></p>
								</div>
								<?php
								echo '</li>';
							}
						} else {
							if ( $post->post_parent ) {
								$tubs = $tubcats[$post->post_parent]['subcats'][$post->ID]['tubs'];
							} else {
								$tubs = $tubcats[$post->ID]['tubs'];
							}
							
							if ( count($tubs) > 0 ) {
								foreach ( $tubs as $t ) {
									echo '<li class="cell" id="tub-'. $t['id'] .'"';
									$bg_id = get_post_thumbnail_id($t['id']);
									if ( $bg_id ) {
										$img = get_post($bg_id);
										echo ' style="background: url('. $img->guid .') 50% 50% no-repeat"';
									}
									echo '>';
							?>
								<div class="inner">
									<h2><?php esc_attr_e($t['name']); ?></h2>
									<p>Seats: <?php esc_attr_e($t['seats']) ?></p>
									<p>Jets: <?php echo absint($t['jets']) ?></p>
									<p><a href="<?php echo get_bloginfo('url') . $t['url']; ?>" class="grey-gold-btn">View Full Details</a></p>
								</div>
							<?php
								echo '</li>';
								}
							}
						} ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php endwhile; ?>

<div class="bd wrap">

<?php get_footer(); ?>