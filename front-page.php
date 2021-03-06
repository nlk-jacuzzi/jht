<?php
/**
 * Front / Homepage template file
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */
define('DONOTCACHEPAGE', true);

//avala_form_submit();

get_header(); ?>

    <?php
    /**
     *  Attention Russell:
     *
     *  The home page hero slides/section has been moved.
     *
     *  The file containing all home page hero stuff is now called "block-home_hero.php"
     **/
    //get_template_part('block', 'home_hero');
    ?>

    <!--div class="goldBar5"></div-->
	<div class="hero">
        <?php if (function_exists('putRevSlider')) putRevSlider("homepageslider"); ?>
    </div>

    <?php get_template_part('block', 'tubs_by_size'); ?>    

    <?php get_template_part('block', 'cta_forms'); ?>

    <div class="bd wrap">
        
        <?php get_template_part('block', 'innovation'); ?>
        <?php get_template_part('block', 'accolades'); ?>
        <div class="threeCol">
            <div class="col col1and2 main">
                <div class="col">
                    <?php 
                    if ( have_posts() ) while ( have_posts() ) : the_post();
                    the_content(); // hardcoded?
                    endwhile; // end of the loop.
                    ?>
                </div>
            </div>
            <div class="col col3 blog">
                <?php 
                if(jht_is_ca()){
                	?>
                		<h3>Latest News</h3>
						<p><a href="http://www.jacuzzi.ca/hot-tubs/dealer-locator/ontario-on/"><img src="http://www.jacuzzi.ca/hot-tubs/wp-content/uploads/2016/03/JAC-ONTARIO-RES.jpg" alt="Jacuzzi Hot Tubs of Ontario" width="150" height="125" border="0"></a></p>
						<p><a href="http://www.jacuzzi.ca/hot-tubs/dealer-locator/ontario-on/" target="_blank">Jacuzzi Hot Tubs of Ontario</a> receives the 2015 Dealer of the Year Award at this year's Jacuzzi® Dealer Conference in Panama City, Panama! Read more about the announcement <a href="http://www.jacuzzi.ca/hot-tubs/about/press-releases/annual-award-recipients-presented-at-the-2016-jacuzzi-dealer-conference/" target="_blank">here.</a></p>
                	<?php
                }
				else
				{
					
					
	                $l = get_posts(array(
	                    'numberposts' => 1,
	                ));
	                if ( count($l) > 0 ) {
	                    echo '<h3>Latest from the Blog:</h3>';
	                    $l = $l[0];
	                    echo '<h2>'. esc_attr($l->post_title) .'</h2>';
	                    $lc = wp_kses($l->post_content, array());
	                    echo '<p>';
	                    if ( strlen($lc) > 50 ) {
	                        $lc = substr($lc, 0, strrpos(substr($lc,0,50), ' ')) .'... ';
	                    }
	                    echo $lc .'<a href="'. get_permalink($l->ID) .'">Read More</a></p>';
	                }
				}
                ?>

                <h3>The Jacuzzi<sup>&reg;</sup> blog:</h3>
                <p>From news on the best ways to care for your spa to how to get a better night's sleep. Learn and stay informed with our Jacuzzi<br />
                <a href="<?php echo get_permalink(5) ?>">Blog.</a></p>
                

                <h3>Categories</h3>
                <ul><?php
                if ( false === ( $special_query_results = get_transient( 'wp_list_categories' ) ) ) {
                    // It wasn't there, so regenerate the data and save the transient
                    $special_query_results = wp_list_categories('title_li=&echo=0');
                    set_transient( 'wp_list_categories', $special_query_results, 60*60*12 );
                }
                // Use the data like you would have normally...
                $wp_list_categories = get_transient( 'wp_list_categories' );
                echo $wp_list_categories;
                ?></ul>
            </div>
<?php get_footer(); ?>