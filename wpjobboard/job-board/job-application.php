<?php

/**
 * Job application details
 *
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 * 
 /* @var $job Wpjb_Model_Job */
 /* @var $application Wpjb_Model_Application */

?>

<div class="wpjb wpjb-page-job-application">

    <?php wpjb_flash(); ?>
    
    <div class="wpjb-menu-bar">
        <a href="<?php echo wpjb_link_to("employer_panel") ?>"><?php _e("Company jobs", "wpjobboard") ?></a>
        <span class="wpjb-glyphs wpjb-icon-right-open">&nbsp;</span>
        <a href="<?php echo wpjb_link_to("job_applications", $job) ?>"><?php esc_html_e($job->job_title) ?></a>
        <span class="wpjb-glyphs wpjb-icon-right-open">&nbsp;</span>
        <?php _e($application->applicant_name) ?>
    </div>
    
    <div class="wpjb-grid">
        <div class="wpjb-grid-row">
            <div class="wpjb-col-30">
                <?php _e("Application Status", "wpjobboard") ?>
            </div>
            <div class="wpjb-col-65 wpjb-glyphs wpjb-icon-gauge">
                <form action="" method="post" style="display:inline">
                    <select name="status" style="padding:2px;margin:0px">
                        <?php foreach(wpjb_application_status() as $k => $v): ?>
                        <option value="<?php esc_html_e($k) ?>" <?php if($k==$application->status): ?>selected="selected"<?php endif; ?>><?php esc_html_e($v) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="submit" value="<?php _e("change", "wpjobboard") ?>" />
                </form>
            </div>
        </div>      
        <?php if(is_array(wpjb_conf("cv_show_applicant_resume")) && $application->getResume()): ?>
        <div class="wpjb-grid-row">
            <div class="wpjb-col-30">
                <?php _e("Applicant Resume", "wpjobboard") ?>
            </div>
            <div class="wpjb-col-65 wpjb-glyphs wpjb-icon-link-ext-alt">
                <a href="<?php esc_attr_e(wpjr_link_to("resume", $application->getResume(), array("application_id"=>$application->id))) ?>"><?php _e("View Resume", "wpjobboard") ?></a>
            </div>
        </div>    
        <?php endif; ?>
        <div class="wpjb-grid-row">
            <div class="wpjb-col-30">
                <?php _e("Applicant Name", "wpjobboard") ?>
            </div>
            <div class="wpjb-col-65 wpjb-glyphs wpjb-icon-user">
                <?php esc_html_e($application->applicant_name) ?>
            </div>
        </div>        
        <div class="wpjb-grid-row">
            <div class="wpjb-col-30">
                <?php _e("Applicant E-mail", "wpjobboard") ?>
            </div>
            <div class="wpjb-col-65 wpjb-glyphs wpjb-icon-mail-alt">
                <?php esc_html_e($application->email) ?>
            </div>
        </div>        
        <div class="wpjb-grid-row">
            <div class="wpjb-col-30">
                <?php _e("Date Sent", "wpjobboard") ?>
            </div>
            <div class="wpjb-col-65 wpjb-glyphs wpjb-icon-calendar">
                <?php echo wpjb_date_display(get_option("date_format"), $application->applied_at) ?>
            </div>
        </div>        
        <?php foreach($application->getMeta(array("visibility"=>0, "meta_type"=>3, "empty"=>false, "field_type_exclude"=>"ui-input-textarea")) as $k => $value): ?>
        <div class="wpjb-grid-row <?php esc_attr_e("wpjb-row-meta-".$value->conf("name")) ?>">
            <div class="wpjb-grid-col wpjb-col-30"><?php esc_html_e($value->conf("title")); ?></div>
            <div class="wpjb-grid-col wpjb-col-65 wpjb-glyphs <?php esc_attr_e($value->conf("render_icon", "wpjb-icon-empty")) ?>">
                <?php if($value->conf("render_callback")): ?>
                    <?php call_user_func($value->conf("render_callback")); ?>
                <?php elseif($value->conf("type") == "ui-input-file"): ?>
                    <?php foreach($application->file->{$value->name} as $file): ?>
                    <a href="<?php esc_attr_e($file->url) ?>" rel="nofollow"><?php esc_html_e($file->basename) ?></a>
                    <?php echo wpjb_format_bytes($file->size) ?><br/>
                    <?php endforeach ?>
                <?php else: ?>
                    <?php esc_html_e(join(", ", (array)$value->values())) ?>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
        
        <?php if(count($application->getFiles())): ?>
        <div class="wpjb-grid-row">
            <div class="wpjb-col-30">
                <?php _e("Attached Files", "wpjobboard") ?>
            </div>
            <div class="wpjb-col-65">
                <?php foreach($application->getFiles() as $file): ?>
                <a href="<?php echo esc_attr($file->url) ?>"><?php echo esc_html($file->basename) ?></a>
                ~ <?php echo esc_html(wpjb_format_bytes($file->size)) ?>
                <br/>
                <?php endforeach; ?>
            </div>
        </div>   
        <?php endif; ?>
    </div>
    
    <div class="wpjb-text-box">

        <h3><?php _e("Message", "wpjobboard") ?></h3>
        <div class="wpjb-text">
            <?php wpjb_rich_text($application->message) ?>
        </div>

        <?php foreach($application->getMeta(array("visibility"=>0, "meta_type"=>3, "empty"=>false, "field_type"=>"ui-input-textarea")) as $k => $value): ?>
        <h3><?php esc_html_e($value->conf("title")); ?></h3>
        <div class="wpjb-text">
            <?php wpjb_rich_text($value->value(), $value->conf("textarea_wysiwyg") ? "html" : "text") ?>
        </div>
        <?php endforeach; ?>

        <?php do_action("wpjb_template_job_meta_richtext", $job) ?>
    </div>
    


</div>