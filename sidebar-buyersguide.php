<?php

$test = ( isset( $_GET['test'] ) ) ? strtolower( $_GET['test'] ) : false;

$form_success = avala_form_submit( false );

?>

<div class="scall bguide optA">
	<?php if ( !$form_success ) { ?>
	<div class="guidecta form">
		<form action="<?php echo getUrl( true ); ?>" method="post" id="downloadForm" class="straight-to-dl">
			<?php avala_hidden_fields( 15, 9, 20 ); ?>
			<?php avala_field( 'first_name', 'text ', true, 'field', array( 'placeholder' => 'first name' ) ); ?>
			<?php avala_field( 'last_name', 'text ', true, 'field', array( 'placeholder' => 'last name' ) ); ?>
			<?php avala_field( 'email', 'text email', true, 'field', array( 'placeholder' => 'email' ) ); ?>
			<?php avala_field( 'postal_code', 'text ', true, 'field', array( 'maxlength' => 10, 'placeholder' => 'zip / postal code' ) ); ?>
			<input type="submit" class="submit" value="Download Now" download="http://www.jacuzzihottubs.com/brochures/Jacuzzi_Hottubs_BuyersGuide_43.pdf" />
		</form>
	</div>
	<?php } else { ?>
	<div class="guidecta dlnow">
		<a href="<?php echo get_site_url(); ?>/brochures/Jacuzzi_Hottubs_BuyersGuide_43.pdf" target="_blank" /></a>
	</div>
	<?php } ?>
</div>
<div class="scall bguide optB" style="display:none;" >
	<div class="guidecta link">
		<a href="<?php echo get_site_url(); ?>/buyers-guide/" /></a>
	</div>
</div>
