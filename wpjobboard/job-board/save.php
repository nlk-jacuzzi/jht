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

<div class="wpjb wpjb-page-save">

    <?php wpjb_flash(); ?>

    <?php if($can_post): ?>
    <?php wpjb_add_job_steps(); ?>

    <div class="wpjb-complete">
    <?php if($action == "job_online"): ?>
        <p><?php _e("Thank you for using our service and submitting your job listing.", "wpjobboard") ?></p>

        <?php if($online): ?>
        <p><?php _e("Your job listing is now live.", "wpjobboard") ?></p>
        <p><a href="<?php echo wpjb_link_to("job", $job) ?>"><?php _e("Click here to view your listing", "wpjobboard") ?></a></p>

        <?php else: ?>
        <p><?php _e("Once it has been moderated and approved your job posting will become active.", "wpjobboard") ?></p>
        
        <?php endif; ?>

    <?php elseif($action == "payment_complete"): ?>
        <p><?php _e("Thank you for the payment, your order will be processed shortly.", "wpjobboard") ?></p>
    <?php elseif($action == "payment_already_sent"): ?>
        <p><?php _e("We already recived payment for this listing. Thank you.", "wpjobboard") ?></p>
    <?php else: // show payment form ?>
        <p style="margin:20px 0 20px 0"><?php _e("Please use form below to make payment for job listing. Thank you!", "wpjobboard") ?></p>

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
        
        
    <?php endif; ?>
    </div>

    <?php endif; ?>
</div>

