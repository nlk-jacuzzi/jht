<?php
/**
 * Template Name: Request a Quote (Special Promo - Robe)
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */
global $post, $wp_query;
if(isset($wp_query->query_vars['keyword'])) {
    $wp_query->query_vars['kw'] = $wp_query->query_vars['keyword'];
}
$custom = get_post_meta($post->ID,'jht_newppc_options');
$opts = $custom[0];

//avala_form_submit();

get_header();

if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <div class="hero ppc-page <?php echo $opts['color']; ?>">
        <?php
        $pagetitle = esc_attr(the_title('','',false));
        if(isset($wp_query->query_vars['kw']) && $wp_query->query_vars['kw'] != '') {
            $pagetitle = $wp_query->query_vars['kw'];
            $pagetitle = ucwords(str_replace('-',' ',$kw));
        }
        echo '<img src="'.get_template_directory_uri().'/images/bg/special-promo-robe.png" alt="'.$pagetitle.'" title="'.$pagetitle.'" />';
        ?>
    	<div class="wrap">
            <h1 class="title"><?php if ( $opts['title'] ) { echo $opts['title']; } else { the_title(); } ?></h1>
            <p class="main-text"><?php if ( $opts['text_main'] ) echo $opts['text_main']; ?></p>
            <ul>
                <?php
                foreach ( $opts['text_bullet'] as $k => $v ) {
                    if ( $v ):
                        echo '<li><span class="ppc-icon '.$opts['text_bullet_icon'][$k].'"></span>'.$v.'</li>';
                    endif;
                }
                ?>
            </ul>
        </div>
        <div class="wrap bottom">
            <p class="gold-text"><?php if ( $opts['text_gold'] ) echo $opts['text_gold']; ?></p>
        </div>
    </div>
    <div class="goldBar-ppc"></div>
    <div class="bd">
    	<div class="wrap">
            <div class="oneCol">
                <div class="main">
                    <form action="<?php echo get_permalink(); ?>" method="post" id="leadForm">

                        <?php avala_hidden_fields( 19, 9, 13 ); ?>

                        <input type="hidden" name="CampaignId" value="21" />
                        
                        <table cellspacing="0">
                            <tr>
                                <td>
                                    <?php avala_field( 'first_name', 'text ', true, 'field', array( 'placeholder' => 'First Name*' ) ); ?>
                                </td>
                                <td>
                                    <?php avala_field( 'last_name', 'text ', true, 'field', array( 'placeholder' => 'Last Name*' ) ); ?>
                                </td>
                                <td>
                                    <?php avala_field( 'email', 'text email', true, 'field', array( 'placeholder' => 'Email*' ) ); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php avala_field( 'postal_code', 'text ', true, 'field', array( 'maxlength' => 10, 'placeholder' => 'Zip / Postal Code*' ) ); ?>
                                </td>
                                <td>
                                    <?php avala_field( 'phone', 'text  phonenumber', true, 'field', array( 'maxlength' => 16, 'placeholder' => 'Phone*' ) ); ?>
                                </td>
                                <td>
                                    <?php avala_field( 'newsletter', '', false, 'field', '', 'checkbox', 'receive Jacuzzi updates' ); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" class="submit goldButton-flat" value="<?php if ( $opts['submit'] ) { echo $opts['submit']; } else { echo 'Get My Quote'; } ?>" />
                                </td>
                                <td>
                                    <p>* Indicates required fields</p>
                                    <!--p class="note">Your privacy is very important to us. See our <a href="<?php echo get_permalink(3987) ?>">Privacy Policy</a>.</p-->
                                </td>
                                <td>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
