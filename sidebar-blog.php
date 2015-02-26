<?php
get_sidebar('buyersguide');
get_sidebar('freeBrochure');
get_sidebar('requestQuote');
get_sidebar('tradeIn');
?>
<div class="widget recent-posts topspace">
    <h2>Recent Posts</h2>
    <div>
        <ul>
        <?php
		// transient recent posts
		// Get any existing copy of our transient data
		if ( false === ( $special_query_results = get_transient( 'jht_rec_posts' ) ) ) {
			// It wasn't there, so regenerate the data and save the transient
			$special_query_results = get_posts();
			set_transient( 'jht_rec_posts', $special_query_results, 60*60*12 );
		}
		// Use the data like you would have normally...
		$recs = get_transient( 'jht_rec_posts' );
		foreach ($recs as $p) {
			echo '<li><a href="'. get_permalink($p->ID) .'">'. esc_attr($p->post_title) .'</a></li>';
		}
		?>
        </ul>
    </div>
</div>
<div class="widget categories">
    <h2>Categories</h2>
    <div>
        <ul>
            <?php if ( false === ( $special_query_results = get_transient( 'wp_list_categories' ) ) ) {
					// It wasn't there, so regenerate the data and save the transient
					$special_query_results = wp_list_categories('title_li=&echo=0');
					set_transient( 'wp_list_categories', $special_query_results, 60*60*12 );
				}
				// Use the data like you would have normally...
				$wp_list_categories = get_transient( 'wp_list_categories' );
				echo $wp_list_categories; ?>
        </ul>
    </div>
</div>
<div class="widget subscribe">
    <div>
        <ul>
            <li><a href="http://www.facebook.com/jacuzziofficial" target="_blank" title="Join us on Facebook"><span class="icon fb"></span> Join us on Facebook</a></li>
            <li><a href="http://twitter.com/jacuzziofficial" target="_blank" title="Follow us on Twitter"><span class="icon tw"></span> Follow us on Twitter</a></li>
            <li><a href="http://www.youtube.com/jacuzziofficial" target="_blank" title="Watch us on YouTube"><span class="icon yt"></span> Watch us on YouTube</a></li>
            <li><a href="<?php bloginfo('rss2_url'); ?>" target="_blank" title="Subscribe to our Hot Tub Blog"><span class="icon rss"></span> Subscribe</a></li>
        </ul>
    </div>
</div>
<div class="widget text-widget">
    <h2>Jacuzzi Hot Tub Blog</h2>
    <div>
        <p>If you want to learn about Jacuzzi hot tubs you've come to the right place. The Jacuzzi hot tub blog is a one stop shop for everything you need to know before, during and after you have purchased your Jacuzzi hot tub. Browse our recent posts below to see what's new.</p>
    </div>
</div>
<?php
//get_sidebar('contactNumber');
?>