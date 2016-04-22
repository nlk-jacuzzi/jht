<?php
/**
 * Template Name: Brochure - Buyer's Guide (Avala)
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

//avala_form_submit();

get_header();

if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <div class="hero brochure-buyers-guide">
    </div>
    <div class="bd brochure-buyers-guide">
    	<div class="wrap">
            <div class="main">
                <h1 class="title"><strong>FREE</strong> Jacuzzi<sup>&reg;</sup> Brochure + Buyer's Guide</h1>

                <div class="bbg-top-bg">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/bg/BrochureBuyersGuide-top-bg.png" width="960" height="435"/>
                    <form action="<?php echo get_permalink(); ?>" method="post" id="leadForm" class="form1">
                        <p class="form-headline">DOWNLOAD <strong>FREE</strong> GUIDES</p>
                        <ul>
                            <li>View stunning photos</li>
                            <li>Side-by-side model comparisons</li>
                            <li>Learn about the power of hydrotherapy</li>
                            <li>Learn about sizes, features, &amp; options</li>
                        </ul>

                        <?php avala_hidden_fields( 15, 9, 12 ); ?>

                        <div class="avala-row">
                            <label class="small">Name*</label>
                            <?php avala_field( 'first_name', 'short text', true, 'field', array( 'placeholder' => 'First' ) ); ?>
                            <?php avala_field( 'last_name', 'short text', true, 'field', array( 'placeholder' => 'Last' ) ); ?>
                        </div>
                        <div class="avala-row">
                            <label class="small">Email*</label>
                            <?php avala_field( 'email', 'email long text', true, 'field'); ?>
                        </div>
                        <div class="avala-row">
                            <label class="small">Zip Code*</label>
                            <?php avala_field( 'postal_code', 'short text', true, 'field', array( 'maxlength' => 10 )); ?>
                        </div>
                        <?php /*
                        <div class="avala-row">
                            <label>What is the primary reason you are considering the purchase of a hot tub?</label>
                            <?php avala_field( 'product_use', 'select', false, 'field', null, 'select' ); ?>
                        </div>
                        <div class="avala-row">
                            <label>Which Jacuzzi<sup>&reg;</sup> Hot Tub are you interested in purchasing?</label>
                            <?php avala_field( 'product_id_list', 'select', false, 'field', null, 'select', false, $avala_tub_default ); ?>
                        </div>
                        */ ?>
                        <div class="avala-row">
                            <?php avala_field('newsletter', '', false, 'field' ); ?>
                        </div>
                        <div class="avala-row">
                            <input type="submit" class="submit bigGoldBtn" value="Get Them Now" />
                        </div>
                        <div class="avala-row center">
                            <p class="note">* Required.&nbsp; &nbsp;<a href="<?php echo get_permalink(3987) ?>">Privacy Policy</a></p>
                        </div>
                    </form>
                    <div class="bullet-points">
                        <div class="half">
                            <ul>
                                <li>Top reasons to own a hot tub</li>
                                <li>Essential questions to ask your dealer</li>
                                <li>A step-by-step dealer visit checklist</li>
                                <li>Warranty info to look for</li>
                            </ul>
                        </div>
                        <div class="half">
                            <ul>
                                <li>The 3 keys to stress-free hot tub ownership</li>
                                <li>Proven health benefits that adults 30 and over need to know</li>
                                <li>How to select the perfect spot for your hot tub</li>
                                <li>The 2 most important things to look for from jets</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="bbg-innovation">
                    <h2>Over <strong>100 Years</strong> of Innovation</h2>
                    <div class="innov-parts">
                        <div class="innov-sub-parts">
                            <p>The Jacuzzi<sup>&reg;</sup> Difference</p>
                            <ul>
                                <?php echo do_shortcode('[video_lightbox_youtube video_id="qxYknzV-yNQ" width="640" height="480" anchor="'.get_template_directory_uri().'/images/brochure/left1.png"]'); ?>
                                <!--img src="<?php echo get_template_directory_uri(); ?>/images/brochure/left1.png" width="128" height="114" align="left"/-->
                                <li>50 years of hot tub innovation</li>
                                <li>The name that started an industry</li>
                                <li>Luxury features and upgrades</li>
                            </ul>
                        </div>
                        <div class="innov-sub-parts">
                            <p>Advanced Hydrotherapy</p>
                            <ul>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/brochure/left2.png" width="128" height="114" align="left"/>
                                <li>Relaxation and stress relief</li>
                                <li>Speed recovery of injuries</li>
                                <li>Promote flow of endorphines</li>
                            </ul>
                        </div>
                        <div class="innov-sub-parts">
                            <p>Industry-Leading 10-Year Warranty</p>
                            <ul>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/brochure/left3.png" width="128" height="114" align="left"/>
                                <li>Carefree ownership</li>
                                <li>Easy water care</li>
                                <li>Quality materials</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="bbg-accolades">
                    <h2>Accolades <strong>&amp;</strong> Awards</h2>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/brochure/accolades.png" width="810" height="80" />
                </div>


                <div class="bbg-bot-bg">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/bg/BrochureBuyersGuide-bot-bg.png" width="960" height="329"/>
                    <form action="<?php echo get_permalink(); ?>" method="post" id="leadForm2" class="form2">
                        <p class="form-headline">DOWNLOAD <strong>FREE</strong> GUIDES</p>
                        <p>Jacuzzi<sup>&reg;</sup> Brochure &amp; Buyer's Guide</p>


                        <?php avala_hidden_fields( 15, 9, 12 ); ?>

                        <div class="avala-row">
                            <label class="small">Name*</label>
                            <?php avala_field( 'first_name', 'short text', true, 'field', array( 'placeholder' => 'First' ) ); ?>
                            <?php avala_field( 'last_name', 'short text', true, 'field', array( 'placeholder' => 'Last' ) ); ?>
                        </div>
                        <div class="avala-row">
                            <label class="small">Email*</label>
                            <?php avala_field( 'email', 'email long text', true, 'field'); ?>
                        </div>
                        <div class="avala-row">
                            <label class="small">Zip Code*</label>
                            <?php avala_field( 'postal_code', 'short text', true, 'field', array( 'maxlength' => 10 )); ?>
                        </div>
                        <?php /*
                        <div class="avala-row">
                            <label>What is the primary reason you are considering the purchase of a hot tub?</label>
                            <?php avala_field( 'product_use', 'select', false, 'field', null, 'select' ); ?>
                        </div>
                        <div class="avala-row">
                            <label>Which Jacuzzi<sup>&reg;</sup> Hot Tub are you interested in purchasing?</label>
                            <?php avala_field( 'product_id_list', 'select', false, 'field', null, 'select', false, $avala_tub_default ); ?>
                        </div>
                        */ ?>
                        <div class="avala-row">
                            <?php avala_field('newsletter', '', false, 'field' ); ?>
                        </div>
                        <div class="avala-row">
                            <input type="submit" class="submit bigGoldBtn" value="Get Them Now" />
                        </div>
                        <div class="avala-row center">
                            <p class="note">* Required.&nbsp; &nbsp;<a href="<?php echo get_permalink(3987) ?>">Privacy Policy</a></p>
                        </div>
                    </form>
                </div>

            </div>
<?php
the_content(); // for remarketing pixels and whatever...
endwhile; // end of the loop. ?>
<?php get_footer(); ?>
