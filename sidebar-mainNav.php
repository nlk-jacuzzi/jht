<?php

?>
            <ul class="primaryMenu" id="tnav">
            	<li class="menu-item first parent<?php if ( in_array( get_post_type(), array('jht_cat', 'jht_tub'))) echo ' current'; ?>">
	                <?php
						//global $polylang;
						global $tubcats;
						//echo '<pre style="display:none">'. print_r($tubcats,true) .'</pre>';
						// transient for sundance_htdrop
						//if ( false === ( $special_query_results = get_transient( 'jht_hdrop' ) ) ) {
							$o = '<a href="'. jht_hottublandingurl() .'">Hot Tubs</a>';
							//$o .= '<pre style="display:none" title="tubcats">'. print_r($tubcats,true) .'</pre>';
							$o .= '<ul>';
								foreach ( $tubcats as $c ) {
									$catID = preg_replace("/[^A-Za-z0-9]/", '', $c['name']);
									if ( in_array($c['name'], array('Best Selling', 'Collections')) ) { // make Best Selling like COLLECTIONS :)
										$o .= '<li class="collections">';
									} else {
										$o .= '<li>';
									}
									$o .= '<a href="'. $c['url'] .'">'. $c['name'] .'</a>';
									
									if($c['name'] == 'Collections'){
										$o .= '<div class="superMenu collection-super">';	
									}
									else {
										$o .= '<div class="superMenu">';
									}
									
									
									
									if ( isset($c['subcats']) == false ) {
										if ( $c['name'] == 'Best Selling' ) { // make Best Selling like COLLECTIONS :)
											$o .= '<ul class="grid4 collections">';
											for ( $i = 0; $i < 4; $i++ ) {
												$o .= '<li class="cell '. $c['tubs'][$i]['slug'] .($i==0 ? ' first' : ($i==3 ? ' last' : '') ) .'">';
												$o .= '<div class="h">'. $c['tubs'][$i]['name'] .'</div>';
												$o .= '<p class="thumb"><a href="'. get_bloginfo('url') . $c['tubs'][$i]['url'] .'" class="prel thm" title="'. $c['tubs'][$i]['imgs']['nav34src'] .'"></a></p>';
												$o .= '<p class="tag">'. $c['tubs'][$i]['tag'] .'</p>';
												$o .= '<p class="link"><a href="'. get_bloginfo('url') . $c['tubs'][$i]['url'] .'">View '. $c['tubs'][$i]['name'] .'</a></p>';
											}
											$o .= '</ul>';
										} else {
											$o .= '<ul class="grid8">';
											for ( $i = 0; $i < 8; $i++ ) {
												$o .= '<li class="cell ';
												if ( isset( $c['tubs'][$i] ) ) {
													$t = $c['tubs'][$i];
													$t_size = split('-', str_replace(' in','"',$t['size']));
													
													$o .= $t['slug'] .'"><a href="'. get_bloginfo('url') . $t['url'] .'">'. $t['name'] .'<span>'. $t_size[0] .'</span>';
													if ( $t['imgs']['rollover'] != '' ) {
														$o .= '<span class="rollover prel" title="'. $t['imgs']['rollover'] .'"><span>'. $t['name'] .'</span></span>';
													}
													$o .= '</a></li>';
												} else {
													$o .= '"></li>';
												}
											}
											$o .= '</ul>';
											$o .= '<div class="image prel" title="'. $c['img'] .'"></div>';
										}
									} else {
										$cname = $c['name'];
										if($c['name'] == 'Collections'){
											$o .= '<ul class="grid4 grid2 collections collections-new">';	
										}
										else {
											$o .= '<ul class="grid4 collections">';
										}
										$j = 0;
										foreach ( $c['subcats'] as $k => $s ) {
											$o .= '<li class="cell '. $s['slug'] .($j==0 ? ' first' : ($j==3 ? ' last' : '') ) .'">';
											$o .= '<div class="h">'. $s['fullname'] .'</div>';
											$o .= '<p class="thumb"><a href="'. $s['url'] .'" title="'. $s['imgsrc'] .'" class="prel thm"></a></p>';
											if($cname == 'Collections')
											{
												$o .= '<p class="tag"><a href="'. $s['url'] .'">'. $s['tag'] .'</a></p>';
											}
											else {
												$o .= '<p class="tag">'. $s['tag'] .'</p>';
											}
											$o .= '<p class="link"><a href="'. $s['url'] .'">View '. $s['name'] .'</a></p>';
											if($cname  == 'Collections'){
												$o .= '<p class="clear"></p><hr/>';	
											}
											$j++;
										}
										
										$o .= '</ul>';
									}
									$o .= '</div>';
									$o .= '</li>';
								}
								$o .= '<li><a href="' . get_bloginfo('url') . '/color-selector/">Color Selector</a></li>';
								$o .= '<li><a href="' . get_permalink(4282) . '">Accessories</a><div class="acc-flop"><ul><li class="search-flop-col"><ul class="nav big">';
									$o .= '<li><a href="'. get_permalink(4282) .'">Jacuzzi Exclusives</a></li>';
									// transient for jht_acc_cats
									//if ( false === ( $special_query_results = get_transient( 'jht_acc_cats' ) ) ) {
										// It wasn't there, so regenerate the data and save the transient
										$acts = get_terms('jht_acc_cat', array(
											'orderby' => 'id',
										));
										//set_transient( 'jht_acc_cats', $acts, 60*60*12 );
									//}
									// Use the data like you would have normally...
									//$acts = get_transient( 'jht_acc_cats' );
									foreach ( $acts as $s ) { $o .= '<li><a href="'. get_term_link($s) .'">'. $s->name .'</a></li>'; }
								$o .= '</ul></li></ul></div></li>';
								$o .= '<li><a href="' . get_bloginfo('url') . '/reviews/">Reviews</a></li>';	
							$o .= '</ul>';
							//set_transient( 'jht_hdrop', $o, 60*60*12 );
						//}
						// Use the data like you would have normally...
						//$drop = get_transient( 'jht_hdrop' );
						echo $o; //drop;
					?>
                </li>
                <li class="menu-item parent<?php if(is_page(3749)) echo ' current'; ?>"><a href="<?php echo get_permalink(3749) ?>">The Jacuzzi<sup>&reg;</sup> Brand</a>
                	<ul class="drop2">
                		<li>
                        	<div class="search-flop why">
                        		<ul>
                        			<li class="search-flop-col">
                        				<ul class="nav big">
                        					<li><a href="<?php echo get_permalink(3749) ?>">About</a></li>
					                		<?php wp_list_pages('include=3803,3805,3899&title_li=&depth=-1'); ?>
					                        <li><a href="<?php echo get_permalink(3749) ?>">History of Jacuzzi</a></li>
					                    	<?php wp_list_pages('include=3913,3908&title_li=&depth=-1'); ?>
					                    </ul>
					                </li>
			                    </ul>
			                </div>
			            </li>
                	</ul>
                </li>
                <li class="menu-item<?php if(is_page('video-gallery')) echo ' current'; ?>"><a href="<?php echo get_bloginfo('url'); ?>/video-gallery/">Video Gallery</a></li>
                <li class="menu-item<?php if(is_page('owners-corner')) echo ' current'; ?>"><a href="<?php echo get_bloginfo('url'); ?>/owners-corner/">For Owners</a></li>
                <li class="menu-item<?php if(is_page('request-pricing')) echo ' current'; ?>"><a href="<?php echo get_bloginfo('url'); ?>/get-a-quote/">Get Pricing</a></li>
                
                <li class="menu-item search last parent">
                	<a href="<?php echo get_permalink(3999) ?>">Search</a>
                	<ul class="drop">
                    	<li>
                        	<div class="search-flop">
                            	<ul>
                                	<li class="search-flop-col">
                                        <ul class="nav big">
                                        	<?php wp_list_pages('include=8,4397,4403&title_li='); ?>
                                            <li><a href="<?php bloginfo('url'); ?>/dealer-locator/">Locate a Dealer</a></li>
                                            <?php wp_list_pages('include=3884,3881,4169,3941&title_li=&depth=-1'); ?>
                                        </ul>
                                    </li>
                                    <li class="search-flop-col">
                                        <ul class="small">
                                        	<li class="sform"><?php get_search_form(); ?></li>
                                            <?php /* <li class="title"><a href="<?php echo get_permalink(3884) ?>">Customer Support</a></li> */ ?>
                                        	<?php wp_list_pages('include=4392,3943,3999&title_li=&depth=-1'); ?>
                                        	<li><a href="<?php echo get_permalink(5) ?>">Blog</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <br class="clear" />
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>