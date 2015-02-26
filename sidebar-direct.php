<?php
/**
* The Sidebar containing the primary and secondary widget areas.
*
* @package JacuzziDirect
* @since JacuzziDirect 1.0
*/
?>
<div id="secondary">
<div class="block features"><ul class="ftabs"><li class="t">Color &amp; Cabinetry</li><li><a href="#jlx">J-LX</a></li><li><a href="#jlxl">J-LXL</a></li></ul>
<div id="features-flash"></div><script type="text/javascript">jacuzzi_swfpath = '<?php bloginfo('template_url'); ?>/product.swf';</script>
</div>
<div class="block ee"><div class="inside"><?php
$kw = '';
if(isset($wp_query->query_vars['kw']) && $wp_query->query_vars['kw'] != '') {
	$kw = $wp_query->query_vars['kw'];
	$kw = ucwords(str_replace('-',' ',$kw));
	echo '<strong>'. wp_kses($kw,array()) .'</strong><br />';
}
?><strong>Energy Efficiency</strong>
<table width="284" cellpadding="0" cellspacing="0">
<tr valign="bottom"><th width="65">Model</th>
<th width="71">Size</th>
<th width="150">Operating Cost*</th></tr>
<tr><td>J-LX</td>
<td>7'x7'</td>
<td>$10.53</td></tr>
<tr><td>J-LXL</td>
<td>7'x7'</td>
<td>$10.95</td></tr>
</table>
<em>Spa Temperature 100&deg;F/38&deg;C. Kilowatt Rate Per Hour $0.10</em>
</div></div>
<div class="block"><div class="inside">
<p><strong>Seats:</strong> 6 Adults<br />
<strong>PowerPro Jets:</strong> 36<br />
<strong>Dimensions:</strong> 84 in x 84 in x 36 in<br />
<strong>Spa Volume:</strong> 365 US gallons 1,381 liters</p>
</div></div>
<?php if(function_exists('sharethis_button')) { ?>
<div class="block share"><h3 class="title"><span class="spacer">Share This</span></h3><div class="inside">
<?php sharethis_button(); ?>
</div></div>
<?php } ?>
</div>