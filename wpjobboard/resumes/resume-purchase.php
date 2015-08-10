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

 /* @var $job Wpjb_Model_Job */
 /* @var $action string */
 /* @var $online boolean True if job was automatically published */
 /* @var $payment string Payment form */
 /* @var $can_post boolean User has job posting priviledges */

?>

<div class="wpjb wpjb-page-resumes-purchase">

    <?php wpjb_flash(); ?>

    <div class="wpjb-grid wpjb-grid-closed-top wpjb-grid-compact">
        <div class="wpjb-grid-row">
            <div class="wpjb-col-65"><?php _e("Amount", "wpjobboard") ?></div>
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
                <?php echo $button->render() ?>
            </div>
        </div>
    </div>
</div>

