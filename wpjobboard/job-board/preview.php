<div class="wpjb wpjb-page-preview">

    <?php wpjb_flash(); ?>

    <?php if(wpjb_user_can_post_job()): ?>
    <?php wpjb_add_job_steps(); ?>
    <h2><?php esc_html_e($job->job_title) ?></h2>
    <?php wpjb_job_template(); ?>

    <div style="text-align:left; margin:20px 0 0 0; padding: 20px 0 0 0; border-top: 3px solid whitesmoke">
        <p>
            <a class="wpjb-button" href="<?php esc_attr_e(wpjb_link_to("step_add")) ?>">&#171; <?php _e("Edit Listing", "wpjobboard") ?></a> &nbsp;
            <a class="wpjb-button" href="<?php esc_attr_e(wpjb_link_to("step_save")); ?>"><?php _e("Publish Listing", "wpjobboard") ?> &raquo;</a>
        <p>
    </div>
    <?php endif; ?>

</div>
