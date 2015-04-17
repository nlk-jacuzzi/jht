<?php

/**
 * Company profile page
 * 
 * This template displays company profile page
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 */

/* @var $jobList array List of active company job openings */
/* @var $company Wpjb_Model_Company Company information */

?>

<div class="wpjb wpjb-job wpjb-page-company">


    <?php wpjb_flash() ?>

    <?php if($company->isVisible() || (Wpjb_Model_Company::current() && Wpjb_Model_Company::current()->id == $company->id)): ?>
    <?php $user = $company->getUser(true) ?>
    
    <div class="wpjb-top-header wpjb-layer-inside">
        <div class="wpjb-top-header-image">
            <?php if($company->doScheme("company_logo")): ?>
            <?php elseif($company->getLogoUrl()): ?>
            <img src="<?php echo $company->getLogoUrl("64x64") ?>" alt=""  />
            <?php else: ?>
            <span class="wpjb-glyphs wpjb-icon-building wpjb-icon-only wpjb-icon-64"></span>
            <?php endif; ?>
        </div>
            
        <div class="wpjb-top-header-content">
            <div>
                <span class="wpjb-top-header-title">
                    <?php _e("Active Listings", "wpjobboard") ?>:
                    <?php echo wpjb_find_jobs(array("employer_id"=>$company->id, "count_only"=>1)) ?>
                </span>
                
                <em class="wpjb-top-header-subtitle">
                    <?php echo sprintf(__('Registered: %1$s (%2$s ago)', "wpjobboard"), wpjb_date_display(get_option('date_format'), $user->user_registered), daq_time_ago_in_words($user->time->user_registered)) ?>
                </em>
                
            </div>
        </div>

    </div>

    <div class="wpjb-grid wpjb-grid-closed-top">
        <div class="wpjb-grid-row">
            <div class="wpjb-grid-col wpjb-col-30"><?php _e("Location", "wpjobboard"); ?></div>
            <div class="wpjb-grid-col wpjb-col-65 wpjb-glyphs wpjb-icon-location">
                    <?php if(wpjb_conf("show_maps") && $company->getGeo()->status==2): ?>
                    <a href="<?php esc_attr_e(wpjb_google_map_url($company)) ?>" class="wpjb-tooltip" title="<?php esc_attr_e("show on map", "wpjobboard") ?>"><?php esc_html_e($company->locationToString()) ?><span class="wpjb-glyphs wpjb-icon-down-open"></span></a>
                    <?php else: ?>
                    <?php esc_html_e($company->locationToString()) ?>
                    <?php endif; ?>
                </span>
            </div>
                
            <?php if(wpjb_conf("show_maps") && $company->getGeo()->status==2): ?>
            <div class="wpjb-none wpjb-map-slider">
                <iframe style="width:100%;height:350px;margin:0;padding:0;" width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src=""></iframe>
                <!--span class="wpjb-glyphs wpjb-icon-arrows-cw wpjb-spin" style="display:block; text-align: center; font-size:64px"></span-->
            </div>
            <?php endif; ?>
        </div>        
        
        <?php if($company->company_website): ?>
        <div class="wpjb-grid-row">
            <div class="wpjb-grid-col wpjb-col-30"><?php _e("Website", "wpjobboard"); ?></div>
            <div class="wpjb-grid-col wpjb-col-65 wpjb-glyphs wpjb-icon-link-ext-alt">
                <?php if($company->doScheme("company_website")): else: ?>
                <a href="<?php esc_attr_e($company->company_website) ?>" class="wpjb-company-link"><?php esc_html_e($company->company_website) ?></a>
                <?php endif; ?>
            </div>
        </div>   
        <?php endif; ?>
        
        <?php foreach($company->getMeta(array("visibility"=>0, "meta_type"=>3, "empty"=>false, "field_type_exclude"=>"ui-input-textarea")) as $k => $value): ?>
        <div class="wpjb-grid-row <?php esc_attr_e("wpjb-row-meta-".$value->conf("name")) ?>">
            <div class="wpjb-grid-col wpjb-col-30"><?php esc_html_e($value->conf("title")); ?></div>
            <div class="wpjb-grid-col wpjb-col-65 wpjb-glyphs <?php esc_attr_e($value->conf("render_icon", "wpjb-icon-empty")) ?>">
                <?php if($company->doScheme($k)): ?>
                <?php elseif($value->conf("type") == "ui-input-file"): ?>
                    <?php foreach($company->file->{$value->name} as $file): ?>
                    <a href="<?php esc_attr_e($file->url) ?>" rel="nofollow"><?php esc_html_e($file->basename) ?></a>
                    <?php echo wpjb_format_bytes($file->size) ?><br/>
                    <?php endforeach ?>
                <?php else: ?>
                    <?php esc_html_e(join(", ", (array)$value->values())) ?>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
            
        <?php do_action("wpjb_template_company_meta_text", $company) ?>
        
    </div>
    
    <div class="wpjb-text-box">

        <?php if(empty($company->company_info)): else: ?>
        <h3><?php _e("Company Information", "wpjobboard") ?></h3>
        <div class="wpjb-text">
            <?php if($company->doScheme("company_info")): else: ?>
            <?php wpjb_rich_text($company->company_info, $company->meta->company_info_format->value()) ?>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <?php foreach($company->getMeta(array("visibility"=>0, "meta_type"=>3, "empty"=>false, "field_type"=>"ui-input-textarea")) as $k => $value): ?>
        
        <h3><?php esc_html_e($value->conf("title")); ?></h3>
        <div class="wpjb-text">
            <?php if($company->doScheme($k)): else: ?>
            <?php wpjb_rich_text($value->value()) ?>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>

        <?php do_action("wpjb_template_job_meta_richtext", $company) ?>
    </div>

    <div class="wpjb-text">
        <h3><?php _e("Current job openings at", "wpjobboard") ?> <?php esc_html_e($company->company_name) ?></h3>
        
        <div class="wpjb-grid wpjb-grid-closed-top wpjb-grid-compact">
            <?php $jobList = wpjb_find_jobs($param) ?>
            <?php if ($jobList->total>0): foreach($jobList->job as $job): ?>
            <?php /* @var $job Wpjb_Model_Job */ ?>
            <div class="wpjb-grid-row <?php wpjb_job_features($job); ?>">
                <div class="wpjb-grid-col wpjb-col-70">
                    <a href="<?php echo wpjb_link_to("job", $job); ?>"><?php esc_html_e($job->job_title) ?></a>
                    &nbsp; 
                    <span class="wpjb-glyphs wpjb-icon-location"><?php esc_html_e($job->locationToString()) ?></span>
                    <?php if($job->isNew()): ?><span class="wpjb-bulb"><?php _e("new", "wpjobboard") ?></span><?php endif; ?>
                </div>
                <div class="wpjb-grid-col wpjb-grid-col-right wpjb-col-30 wpjb-glyphs wpjb-icon-calendar">
                <?php echo wpjb_date_display(get_option('date_format'), $job->job_created_at) ?>
                </div>
            </div>
            <?php endforeach; else :?>
            <div class="wpjb-grid-row">
                <div class="grid-col"><?php _e("Currently this employer doesn't have any openings.", "wpjobboard"); ?></div>
            </div>
            <?php endif; ?>
        </div>
    </div>
        


    <?php endif; ?>

</div>
