<?php

if ( ! jht_is_ca() ) { ?>
<style>
.gform_anchor { visibility: hidden; }
.guidecta.form label { display: none !important; }
.guidecta.form .gform_wrapper .top_label li input[type="text"] { 
	border-radius: 0;
	padding: 4px;
}
.guidecta.form .gform_wrapper .top_label li .address_zip input[type="text"] {
	margin-left: 12px;
}
.guidecta.form .gform_wrapper .top_label li {
	margin: auto;
	position: relative;
	width: 95% !important;
}
.scall.bguide .guidecta.form form input[type="submit"] { left: 14px; }
.guidecta.form .bigGoldBtn { box-shadow: none; }
.page .twoCol .side .guidecta.form li { background: none; border-bottom: none; }
.scall.bguide .guidecta.form div.gforms_confirmation_message {
	width: 95%;
	top: 275px;
	position: absolute;
	left: 14px;
}
.validation_error {
	display: none;
}
</style>
<div class="scall bguide optA">
	<div class="guidecta form">
		<?php echo do_shortcode( '[gravityform id=25 description=false title=false ajax=true]' ); ?>
	</div>
</div>
<div class="scall bguide optB" style="display:none;" >
	<div class="guidecta link">
		<a href="<?php echo get_site_url(); ?>/buyers-guide/" /></a>
	</div>
</div>
<?php  } ?>