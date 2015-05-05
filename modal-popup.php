<?php

/**
 *	Modal Box - A
 *	tb_show(null, "#TB_inline?width=960&height=550&inlineId=modal-var-a");
 */

$image = array('4things', '5things', 'brochure');
$img_version = 2; // 0 or 1 or 2, etc, used to set the left side content image

?>
<div id="modal-box-ab" style="background-color: rgba(0,0,0,.75); display: none; height: 100%; left: 0; position: fixed; top: 0; width: 100%; z-index: 99999;">
	<?php /*
	<style>
	.avala-row.modal { margin-bottom: 3px; }
	.avala-row.modal label { color: #000; display: block; font-size: 14px; }
	.avala-row.modal input.short { width: 110px; }
	.avala-row.modal input.long { width: 241px; }
	.avala-row.modal input#person_first_name { margin-right: 6px; }
	.avala-row.modal label[for="receive_email_campaigns"] { font-size: 11px; line-height: 1em; padding-left: 21px; text-indent: -23px; }
	.avala-row.modal input#receive_email_campaigns { margin-top: 5px; }
	.avala-row.modal input[type="submit"] { background-color: #222; border: none; border-radius: 7px; color: #fff; cursor: pointer; font: 18px "GSBQ"; height: 37px; letter-spacing: .7px; margin-top: 17px; width: 100%; }
	.avala-row.modal p.note { color: #fff; font-size: 11px; margin-top: 8px; text-align: center; }
	.avala-row.modal p.note a { color: #fff; font-size: 11px; text-align: center; }
	.close-this-modal a { background-color: #222; border: 2px solid #fff; border-radius: 20px; color: #fff; cursor: pointer; font: 700 11px/24px cursive; height: 24px; position: absolute; right: -14px; text-align: center; text-decoration: none; top: -14px; width: 24px; }
	.avala-row.modal ::-webkit-input-placeholder { color:    #d8d8d8; }
	.avala-row.modal :-moz-placeholder { color:    #d8d8d8; }
	.avala-row.modal ::-moz-placeholder { color:    #d8d8d8; }
	.avala-row.modal :-ms-input-placeholder { color:    #d8d8d8; }
	</style>
	<div class="wrapper" style="height: 387px; left: 50%; margin-left: -480px; margin-top: -169px; position: relative; top: 50%; width: 960px;">
		<div class="left-twoth" style="background-color: #fff; box-sizing: border-box; float: left; height: 387px; width: 658px;">
			<img src="<?php echo get_template_directory_uri(); ?>/images/modals/<?php echo $image[ $img_version ]; ?>-pop.jpg" />
		</div>
		<div class="right-twoth" style="background-color: #e3af01; box-sizing: border-box; float: left; height: 387px; width: 302px;">
			<p style="color: #000; font: 16px 'GSBQ'; letter-spacing: 1.2px; margin: 46px 24px 0;" >DOWNLOAD YOUR FREE HOT TUB BUYER'S GUIDE TODAY</p>
			<form method="post" action="<?php echo get_bloginfo('url'); ?>/buyers-guide/" id="leadFormModal" style="margin: 9px 24px;">
				<?php avala_hidden_fields( 15, 9, 20 ); ?>
				<input type="hidden" name="thanks_page" value="http://www.jacuzzi.com/hot-tubs/buyers-guide/thanks/">
				<div class="avala-row modal">
					<label class="">Name*</label>
					<?php avala_field( 'first_name', 'short text', true, 'field', array( 'placeholder' => 'First' ) ); ?>
					<?php avala_field( 'last_name', 'short text', true, 'field', array( 'placeholder' => 'Last' ) ); ?>
				</div>
				<div class="avala-row modal">
					<label class="">Email*</label>
					<?php avala_field( 'email', 'email long text', true, 'field'); ?>
				</div>
				<div class="avala-row modal">
					<label class="">Zip Code*</label>
					<?php avala_field( 'postal_code', 'short text', true, 'field', array( 'maxlength' => 10 )); ?>
				</div>
				<div class="avala-row modal">
					<?php avala_field('newsletter', '', false, 'field' ); ?>
				</div>
				<div class="avala-row modal">
					<input type="submit" class="submit bigBlackBtn" value="Immediate Download" />
				</div>
				<div class="avala-row modal center">
					<p class="note">* Required.&nbsp; &nbsp;<a href="<?php echo get_permalink(3987) ?>">Privacy Policy</a></p>
				</div>
			</form>
		</div>
		<div class="close-this-modal"><a onClick="jQuery(this).parents('#modal-box-ab').hide();">X</a></div>
	</div>
	*/ ?>
	<style>
	.avala-row.modal { margin-bottom: 3px; }
	.avala-row.modal label { color: #fff; display: block; font-size: 14px; }
	.avala-row.modal input.short { width: 110px; }
	.avala-row.modal input.long { width: 241px; }
	.avala-row.modal input#person_first_name { margin-right: 6px; }
	.avala-row.modal label[for="receive_email_campaigns"] { font-size: 11px; line-height: 1em; padding-left: 21px; text-indent: -23px; }
	.avala-row.modal input#receive_email_campaigns { margin-top: 5px; }
	.avala-row.modal input[type="submit"] { background-color: #222; border: none; border-radius: 7px; color: #fff; cursor: pointer; font: 18px "GSBQ"; height: 37px; letter-spacing: .7px; margin-top: 17px; width: 100%; }
	.avala-row.modal p.note { color: #fff; font-size: 11px; margin-top: 8px; text-align: center; }
	.avala-row.modal p.note a { color: #fff; font-size: 11px; text-align: center; }
	.close-this-modal a { background-color: #222; border: 2px solid #fff; border-radius: 20px; color: #fff; cursor: pointer; font: 700 11px/24px cursive; height: 24px; position: absolute; right: -14px; text-align: center; text-decoration: none; top: -14px; width: 24px; }
	.avala-row.modal ::-webkit-input-placeholder { /* WebKit browsers */ color:    #d8d8d8; }
	.avala-row.modal :-moz-placeholder { /* Mozilla Firefox 4 to 18 */ color:    #d8d8d8; }
	.avala-row.modal ::-moz-placeholder { /* Mozilla Firefox 19+ */ color:    #d8d8d8; }
	.avala-row.modal :-ms-input-placeholder { /* Internet Explorer 10+ */ color:    #d8d8d8; }
	</style>
	<div class="wrapper" style="height: 387px; left: 50%; margin-left: -480px; margin-top: -169px; position: relative; top: 50%; width: 960px;">
		<div class="left-twoth" style="background-color: #fff; box-sizing: border-box; float: left; height: 387px; width: 658px;">
			<img src="<?php echo get_template_directory_uri(); ?>/images/modals/<?php echo $image[ $img_version ]; ?>-pop.jpg" />
		</div>
		<div class="right-twoth" style="background-color: #57575a; box-sizing: border-box; float: left; height: 387px; width: 302px;">
			<p style="color: #fff; font: 16px 'GSBQ'; letter-spacing: 1.2px; margin: 46px 24px 0; text-align: center;" ><span style="color: #dba923;">DOWNLOAD</span> YOUR FREE HOT TUB BROCHURE TODAY</p>
			<form method="post" action="<?php echo get_bloginfo('url'); ?>/request-brochure/" id="leadFormModal" style="margin: 9px 24px;">
				<?php avala_hidden_fields( 15, 9, 20 ); ?>
				<input type="hidden" name="thanks_page" value="<?php echo get_bloginfo('url'); ?>/request-brochure/brochure-thanks/">
				<div class="avala-row modal">
					<label class="">Name*</label>
					<?php avala_field( 'first_name', 'short text', true, 'field', array( 'placeholder' => 'First' ) ); ?>
					<?php avala_field( 'last_name', 'short text', true, 'field', array( 'placeholder' => 'Last' ) ); ?>
				</div>
				<div class="avala-row modal">
					<label class="">Email*</label>
					<?php avala_field( 'email', 'email long text', true, 'field'); ?>
				</div>
				<div class="avala-row modal">
					<label class="">Zip Code*</label>
					<?php avala_field( 'postal_code', 'short text', true, 'field', array( 'maxlength' => 10 )); ?>
				</div>
				<div class="avala-row modal">
					<?php avala_field('newsletter', '', false, 'field' ); ?>
				</div>
				<div class="avala-row modal">
					<input type="submit" class="submit bigBlackBtn" value="Immediate Download" />
				</div>
				<div class="avala-row modal center">
					<p class="note">* Required.&nbsp; &nbsp;<a href="<?php echo get_permalink(3987) ?>">Privacy Policy</a></p>
				</div>
			</form>
		</div>
		<div class="close-this-modal"><a onClick="jQuery(this).parents('#modal-box-ab').hide();">X</a></div>
	</div>
</div>