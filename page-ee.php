<?php
/**
 * Template Name: Energy Efficiency
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

get_header();
if ( have_posts() ) while ( have_posts() ) : the_post();
if ( function_exists('jhtpolylangfix_contentcheck') ) {
	jhtpolylangfix_contentcheck();
} else {
	the_content(); // hardcoded?
}
endwhile; // end of the loop.
?><div class="threeColEven"><table>
            	<tr class="blueGrad">
                	<th>Model Name</th>
                    <th>Estimated Monthly Costs* <br />
60&deg;F / 15&deg;C</th>
                    <th>Monthly Costs*<br />With SmartSeal&trade;</th>
                </tr>
                <?php
					$alltubs = get_posts(array('numberposts'=>'-1', 'post_type'=>'jht_tub', 'orderby'=>'menu_order', 'order'=>'ASC'));
					foreach ( $alltubs as $t ) {
						$custom = get_post_meta($t->ID,'jht_specs');
						$info = $custom[0];
						if ( $info == '' ) $info = array();
						if ( isset($info['emoc']) == false ) $info['emoc'] = '';
						if ( isset($info['smartseal']) == false ) $info['smartseal'] = '';
						echo '<tr><td>'. esc_attr($t->post_title) .'</td>';
						echo '<td>'. ( in_array( $info['emoc'], array('','NA') ) ? '' : '$' ) . $info['emoc'] .'</td>';
						echo '<td>'. ( in_array( $info['smartseal'], array('','NA') ) ? '' : '$' ) . $info['smartseal'] .'</td>';
						echo '</tr>';
						
					}
				?>
            </table>
            <p style="padding:20px" class="note">*Estimated monthly cost is based on CEC test protocol for standby power consumption only. Test results measured in a controlled environment based on a kilowatt rate per hour of $0.10. Local and future energy rates, local conditions and individual use will alter these estimated monthly costs.For complete CEC test protocol and results visit <a href="http://www.energy.ca.gov" target="_blank">http://www.energy.ca.gov</a></p>
</div>
<?php get_footer(); ?>
