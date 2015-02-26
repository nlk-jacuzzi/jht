<?php
/**
 * Template Name: Customer Showcase
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

get_header();
if ( have_posts() ) while ( have_posts() ) : the_post();
?>
    <div class="hero">
    	<div class="wrap">
            <h1 class="title">Customer Showcase</h1>
            <a href="<?php echo get_permalink(4008); ?>" class="bigbtn">Submit Your Hot Tub</a>
        </div>
    </div>
    <div class="goldBar10"></div>
    <div class="bd">
        
    	<div class="wrap">
            <div class="main showcase">
				<?php if ( is_page(4008) ) {
					the_content();
					echo '</div>';
				} else { // load customer showcase?
					$i = 0;
					global $wpdb;
					$uri = $_SERVER['REQUEST_URI'];
					$i = absint(str_replace('/hot-tubs/customer-showcase/', '', $uri));
					if ( $i > 0 ) {
						$row = $wpdb->get_row( "SELECT * FROM wp_rg_lead WHERE form_id = 1 AND is_starred = 1 AND id = ". $i );
						if ( !$row ) $i = 0;
					}
					if ( $i == 0 ) { // get the first one
						$row = $wpdb->get_row( "SELECT * FROM wp_rg_lead WHERE form_id = 1 AND is_starred = 1" );
						$i = $row->id;
					}
					
					$fname = $wpdb->get_var( "SELECT value FROM wp_rg_lead_detail WHERE lead_id = ". $i ." AND field_number > 5 AND field_number < 7", 0, 0 );
					$lname = $wpdb->get_var( "SELECT value FROM wp_rg_lead_detail WHERE lead_id = ". $i ." AND field_number > 5 AND field_number < 7", 0, 1 );
					$loc = $wpdb->get_var( "SELECT value FROM wp_rg_lead_detail WHERE lead_id = ". $i ." AND field_number = 3" );
					$mod = $wpdb->get_var( "SELECT value FROM wp_rg_lead_detail WHERE lead_id = ". $i ." AND field_number = 4" );
					$descID = $wpdb->get_var( "SELECT id FROM wp_rg_lead_detail WHERE lead_id = ". $i ." AND field_number = 5" );
					// check for longer desc
					$desc = $wpdb->get_row( "SELECT * FROM wp_rg_lead_detail_long WHERE lead_detail_id = ". $descID );
					if ( $desc == null ) {
						$desc = $wpdb->get_row( "SELECT * FROM wp_rg_lead_detail WHERE id = ". $descID );
					}
					$desc = $desc->value;
				?>
					<div class="showimages">
                    <?php
                    $imgs = $wpdb->get_results( "SELECT value FROM wp_rg_lead_detail WHERE lead_id = ". $i ." AND field_number >= 7" );
					$mimg = '<div id="mainimg">';
					$thms = '<ul id="mthms">';
					foreach ( $imgs as $id => $v ) {
						$thmsrc = jht_get_resized_src($v->value, 657, 390, false);
						//if ( $thmsrc ) {
							$thm = '<img src="'. $thmsrc .'" alt="'. $mod .'"'. ($id>0 ? ' style="display:none"' : '') .' />';
							$mimg .= $thm;
							$thms .= '<li'. ($id==0?' class="onn"' : '') .'><a href="#img'. $id .'">'. ($id+1) .'</a></li>';
						//}
					}
					echo $mimg .'</div>'. $thms .'</ul>';
					?>
                    </div><div class="showinfo">
                    <h2><?php echo esc_attr($fname) .' '. esc_attr($lname); ?></h2>
                    <h3><strong>Location</strong> : <?php echo esc_attr($loc); ?></h3>
                    <h3><strong>Model</strong> : <?php echo esc_attr($mod); ?></h3>
                    <?php
					echo apply_filters('the_content', wp_kses($desc,array()));
					?>
                    </div>
					</div></div>
					<div class="showcases"><div class="wrap">
                        <span class="icon prev"></span><span class="icon next"></span>
                        <ul class="sthms">
						<?php
                        $entries = $wpdb->get_results( "SELECT * FROM `wp_rg_lead` as `lead` WHERE `lead`.`is_starred` = 1" );
                        foreach ( $entries as $s ) {
							$mod = $wpdb->get_var( "SELECT `value` FROM `wp_rg_lead_detail` WHERE `lead_id` = ". $s->id ." AND `field_number` = 3" ); //loc instead?
							$img = $wpdb->get_var( "SELECT `value` FROM `wp_rg_lead_detail` WHERE `lead_id` = ". $s->id ." AND `field_number` = 7" );
							echo '<li'. ($s->id == $i ? ' class="on"' : '') .'>';
							$thmsrc = jht_get_resized_src($img, 112, 67);
							$thm = '';
							if ( $thmsrc ) {
								$thm = '<img src="'. $thmsrc .'" width="112" height="67" alt="'. $mod .'" />';
								
							}
							echo '<a href="'. get_bloginfo('url') .'/customer-showcase/'. $s->id .'/" class="thm">'. $thm .'</a>';
							echo '<a href="'. get_bloginfo('url') .'/customer-showcase/'. $s->id .'/" class="name">'. $mod .'</a></li>';
						}
                        ?>
                        </ul>
					</div></div><div class="wrap">
				<?php } ?>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
