<?php

/**
 * Save job
 * 
 * Template displayed when job is being saved
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 * 
 */

 /* @var $payment Object Payment form */
 /* @var $payment_form String */

?>

<div class="wpjb wpjb-page-default-payment">

    <?php wpjb_flash(); ?>

    <p class="wpjb-complete">
        <?php _e("Please use form below to make payment. Thank you!", "wpjobboard") ?>
    </p>
    
    <div class="wpjb-grid wpjb-grid-closed-top wpjb-grid-compact">
        <div class="wpjb-grid-row">
            <div class="wpjb-col-65"><?php _e("Listing Cost", "wpjobboard") ?></div>
            <div class="wpjb-col-30"><?php esc_html_e(wpjb_price($payment->payment_sum+$payment->payment_discount, $payment->payment_currency)) ?></div>
        </div>            
        <div class="wpjb-grid-row">
            <div class="wpjb-col-65"><?php _e("Discount", "wpjobboard") ?></strong></div>
            <div class="wpjb-col-30"><?php esc_html_e(wpjb_price($payment->payment_discount, $payment->payment_currency)) ?></div>
        </div>            
        <div class="wpjb-grid-row">
            <div class="wpjb-col-65"><strong><?php _e("To Pay", "wpjobboard") ?></strong></div>
            <div class="wpjb-col-30"><strong><?php esc_html_e(wpjb_price($payment->getTotal(), $payment->payment_currency)) ?></strong></div>
        </div>
        <div class="wpjb-grid-row">
            <div class="wpjb-col-100">
                <?php echo $payment_form ?>
            </div>
        </div>
    </div>
    

</div>

