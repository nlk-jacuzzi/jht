<?php
/**
 * Template Name: Form Page - Request Quote B
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

avala_form_submit();

get_header( 'newdirect' );

if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <div class="hero getquote ">
    	<div class="wrap getquoteb">
            <img src="<?php bloginfo('template_url'); ?>/images/quote/quote-hero-b.jpg"/>
            <div class="title-text">
                <h3 class="header-text">OUR PROFESSIONAL DEALERS CAN ANSWER ALL YOUR QUESTIONS AND HELP YOU FIND THE HOT TUB OF YOUR DREAMS.</h3>
                <ul>
                    <li>Learn about your local dealer's promotions and special financing options</li>
                    <li>Connect with your local authorized dealer</li>
                    <li>Get price ranges of each collection and model</li>
                </ul>
                <!--ul>
                    <li>Learn about current promotions</li>
                    <li>Ask about easy delivery and set up</li>
                    <li>Learn about our comprehensive warranties</li>
                </ul-->
                <!--ul>
                    <li>Find the size and features you want</li>
                    <li>Sit in the seats and see how you fit</li>
                    <li>Discover all the colors and finishes</li>
                </ul-->
            </div>
            <div class="form-container">
                <div class="left">
                    <h1>No Obligation<br /><span class="gold">Price Quote</span></h1>
                    <p>Please provide your info and an authorized jacuzzi expert will contact you shortly with information regarding models, prices, and financing options.</p>
                    <p class="privacy-policy">Your privacy is very important to us.<br />See our <a href="<?php echo get_site_url(); ?>/about/policies/">Privacy Policy</a>.</p>
                </div>
                <div class="right">
                    <form action="<?php echo get_permalink(); ?>" method="post">
                        <?php avala_hidden_fields( 15, 9, 5 ); ?>
                        <?php avala_field('first_name', 'text half', true, 'field', array('placeholder'=>"First name *", 'required'=>"required" )); ?>
                        <?php avala_field('last_name', 'text half', true, 'field', array('placeholder'=>"Last name *", 'required'=>"required" )); ?>
                        <?php avala_field('email', 'text email third', true, 'field', array('placeholder'=>"Email *", 'required'=>"required" )); ?>
                        <?php avala_field('postal_code', 'text third', true, 'field', array('size'=>"7", 'placeholder'=>"Zip Code *",'required'=>"required" )); ?>
                        <?php avala_field('phone', 'text phonenumber third', true, 'field', array('placeholder'=>"Phone *",'required'=>"required" )); ?>
                        <?php avala_field('currently_own', '', false, 'all', '', 'select', 'Do you currently own, or have you ever owned a hot tub?'); ?>
                        <?php avala_field('product_id_list', '', false, 'all', '', 'select', 'Which hot tub are you interested in purchasing most?'); ?>
                        <?php avala_field('buy_time_frame', '', false, 'all', '', 'select', 'When do you plan to purchase a hot tub?'); ?>
                        <?php avala_field('product_use', '', false, 'all', '', 'select', 'What is the primary benefit you are looking for in a hot tub?'); ?></span>
                        <?php avala_field('newsletter', '', false, 'field' ); ?>
                        <span class="submit-block">
                            <input type="submit" value="Get Pricing" class="sprite btn softgold" onClick="_gaq.push(['_trackEvent', 'lead', 'price-quote']);" />
                            <p class="requiredtext">* indicates required field</p>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="bd">
    	<div class="wrap">
            <div class="twoCol">
                <?php 
                the_content(); // hardcoded?
                ?>
            </div>
        </div>
        <div class="wrap">
            <div class="ft">
                <span class="icon watermark"></span>
                <?php jht_socialmenu(true);
                wp_nav_menu( array( 'container' => 'false', 'menu_class' => 'footerMenuTop', 'theme_location' => 'ftline1' ) );
                wp_nav_menu( array( 'container' => 'false', 'menu_class' => 'footerMenuBottom', 'theme_location' => 'ftline2' ) );
                wp_nav_menu( array( 'container' => 'false', 'menu_class' => 'footerMenuBottom', 'menu_id' => 'resourceMenu', 'theme_location' => 'ftres' ) );
                ?>
            </div>
        </div>
<?php endwhile; // end of the loop. ?>
<?php get_footer( 'newdirect' ); ?>

