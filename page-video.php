<?php
/**
 * Template Name: Video Gallery
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

get_header();
if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div class="hero">
    	<div class="wrap">
            <div class="side">
            	<div id="accord">
                <?php
				$firstvid = '';
				// transient for jht_vid_cats
				if ( false === ( $special_query_results = get_transient( 'jht_vid_cats' ) ) ) {
					// It wasn't there, so regenerate the data and save the transient
					$special_query_results = get_terms( 'jht_vid_cat', array('orderby'=>'count', 'order'=>'DESC') );
					set_transient( 'jht_vid_cats', $special_query_results, 60*60*12 );
				}
				// Use the data like you would have normally...
				$cats = get_transient( 'jht_vid_cats' );
				
				foreach ( $cats as $k => $c ) {
				?>
                	<h3><?php esc_attr_e($c->name); ?></h3>
                    <div<?php if ( $k > 0 ) echo ' style="display:none"'; ?>>
                    	<ul class="video-list">
						<?php
						// transient vids
						$tname = $c->slug .'-vinfo';
						if ( false === ( $special_query_results = get_transient( $tname ) ) ) {
							// It wasn't there, so regenerate the data and save the transient
							$args = array('post_type' => 'jht_vid', 'posts_per_page' => -1, 'jht_vid_cat' => $c->slug, 'orderby' => 'menu_order', 'order' => 'ASC' );
							$vids = get_posts($args);
							$o = array();
							foreach( $vids as $v ) {
								$info = get_post_meta($v->ID,'jht_info',true);
								$url = esc_url($info['url']);
								$yt = substr( $url, strpos( $url, '?v=') + 3, 11);
								$dur = $info['dur'];
								$o[] = array(
									'title' => $v->post_title,
									'url' => $url,
									'yt' => $yt,
									'dur' => $dur
								);
							}
							
							set_transient( $tname, $o, 60*60*12 );
						}
						// Use the data like you would have normally...
						$vids = get_transient( $tname );
						foreach($vids as $v) {
							$yt = $v['yt'];
							echo '<li><a href="'. esc_url($v['url']) .'"'. ($firstvid == '' ? ' class="onn"' : '') .'><span class="thm"><img src="http://i4.ytimg.com/vi/'. esc_attr($yt) .'/default.jpg" width="57" height="43" alt="" /></span>'. esc_attr($v['title']) .'<br />Time : '. esc_attr($v['dur']) .'<span class="e">http://www.youtube.com/embed/'. esc_attr($yt) .'</span></a></li>';
							if ( $firstvid == '' ) $firstvid = '<iframe width="640" height="390" src="http://www.youtube.com/embed/'. esc_attr($yt) .'?showinfo=0&rel=0&autohide=1&wmode=opaque" name="mainplayer" id="mainplayer" vid="" frameborder="0" allowfullscreen></iframe>';
						}
						?>
                        </ul>
                    </div>
					<?php
				}
				?>
                </div>
            </div>
        	<div class="main">
            	<?php echo $firstvid ?>
            </div>
            <br class="clear" />
        </div>
    </div>
    <div class="bd">
    	<div class="wrap">
        
            <div class="twoCol">
                <div class="main">
                	<?php the_content(); ?>
                </div><div class="side">
                	<div class="inner">
                    	<h2>Share This</h2>
                        <div class="share-bar">
                        <?php if(function_exists('sharethis_button')) sharethis_button(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
endwhile; // end of the loop.
get_footer(); ?>
