<?php

	/*
	 * todo: RUSSELL REQUESTED ABILITY FOR SOME PAGES
	 * QUOTE/FINANCING SQUEEZE PAGES)
	 * TO NOT HAVE THE SILVERMENU / THREECOL AT THE BOTTOM OF THE FOOTER
	 */
	get_sidebar('silverMenu');
?>
            <div class="threeCol">
                <div class="col col1">
                    <a href="<?php echo get_permalink(3881) ?>"><img class="alignleft" src="<?php bloginfo('template_url'); ?>/images/icons/warranty-star.jpg" style="padding-bottom:50px;" /></a>
                    <h3 class="bigtitle">Industry Leading 10 Year Warranty!</h3>
                    <p>When shopping for a hot tub, be sure to consider the warranty. Other manufacturers offer warranties that last 1 or 2 years, but our quality tubs feature limited warranties for up to 10 years! In addition, Jacuzzi's network of authorized dealers is standing by to ensure years of worry-free enjoyment. <a href="<?php echo get_permalink(4169) ?>">VIEW WARRANTY OPTIONS</a></p>
                </div>
                <?php // NOTE : JHT REQUESTS TO PULL IN LATEST FB POST HERE RATHER THAN TWEET ?>
                <div class="col col2 tweets">
                    <h2>Jacuzzi Twitter<a href="http://twitter.com/jacuzziofficial" target="_blank" class="icon tw"></a></h2>
					<?php
						if ( function_exists('getTweets') ) {
							$mytweets = getTweets(1, 'jacuzziofficial',array('include_rts'=>1));
							if ( isset( $mytweets['error'] ) ) {
								// doh
							} else {
								//echo '<pre style="display:none">'. print_r($mytweets,true) .'</pre>';
								//$mytweetcount = $mytweets[0]['user']['statuses_count'];
								$ents = isset( $mytweets[0]['entities'] ) ? $mytweets[0]['entities'] : array();
								$mytwitterstatus = nlkTwitterTweet($mytweets[0]['text'], $ents);
								$mytwittercreated = nlkTwitterRelativeTime($mytweets[0]['created_at']);	
								$mytwittersource = $mytweets[0]['source'];
								$mytweeturl = 'https://twitter.com/jacuzziofficial/status/'. $mytweets[0]['id'];
								echo '<p>'. $mytwitterstatus .'<br /><small><a href="'. $mytweeturl .'" target="_blank">'. $mytwittercreated .'</a> via '. $mytwittersource .'</small></p>';
							}
						}
					//jQuery('#tweets').append('<p>'+status+'<br /><small>'+relative_time(twitters[i].created_at)+' via '+ twitters[i].source +'</small></p>');
					//tweets here
					?>
                </div>
                <div class="col col3 blog">
                    <h2>Read Our Blog</h2>
                    <p>From news on the best ways to care for your spa to how to get a better night's sleep. Learn and stay informed with our Jacuzzi<br /><a href="<?php echo get_permalink(5) ?>">Blog.</a></p>
                </div>
            </div>