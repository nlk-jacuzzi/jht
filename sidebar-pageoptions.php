<?php

global $post;
$custom = get_post_meta($post->ID,'jht_pageopts');
$pageopts = $custom[0];

if ( isset($pageopts['b'])  && $pageopts['b'] == 'Yes' ) { ?>
	<div class="scall bro"><a href="<?php echo get_permalink(3745) ?>" class="free-brochure-thumb"><strong>Free</strong> Brochure</a></h1></div>
<?php }

if ( isset($pageopts['q']) && $pageopts['q'] == 'Yes' ) { ?>
	<div class="scall quo"><a href="<?php echo get_permalink(3743) ?>"><strong>Request</strong> a Quote</a></div>
<?php }

if ( isset($pageopts['t']) && $pageopts['t'] == 'Yes' ) { ?>
	<div class="scall quo"><a href="<?php echo get_permalink(7759) ?>"><strong>Trade-In</strong> Value</a></div>
<?php }

if ( isset($pageopts['a']) && $pageopts['a'] == 'Yes' ) { ?>
	<div class="scall quo"><a href="http://shop.jacuzzi.com/"><strong>Accessories</strong> Store</a></div>
<?php } 

/*
if ( isset($pageopts['n']) && $pageopts['n'] == 'Yes' ) { ?>
	<div class="contact"><h1><a href="<?php echo get_permalink(3884) ?>">Contact: <strong>877.411.5228</strong></a></h1></div>
<?php }
*/

if ( isset($pageopts['c']) && $pageopts['c'] == 'Yes' ) { ?>
	<div class="overflowme "><a id="Jacuzzi_Hottubs_Dealer_Visit_Checklist_sidebar" href="<?php echo get_template_directory_uri(); ?>/images/brochure/Jacuzzi_Hottubs_Dealer_Visit_Checklist.pdf">Dealer Visit Checklist</a></div>
<?php }

if ( isset($pageopts['v']) && $pageopts['v'] == 'Yes' ) { ?>
	<div class="overflowme "><a id="Dealer_Locator_sidebar" href="<?php echo get_bloginfo('url'); ?>/dealer-locator/">Visit a Jacuzzi Dealer Today</a></div>
<?php } 

if ( isset($pageopts['x']) && $pageopts['x'] == 'Yes' ) { ?>
	<div class="overflowme "><a id="Quote_Grphic_sidebar" href="<?php echo get_bloginfo('url'); ?>/get-a-quote/">No Obligation Price Quote</a></div>
<?php }

?>