<?php 

/**
 * Job details
 * 
 * This template is responsible for displaying job details on job details page
 * (template single.php) and job preview page (template preview.php)
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 */

 /* @var $job Wpjb_Model_Job */
 /* @var $company Wpjb_Model_Employer */

?>

    <?php $job = wpjb_view("job") ?>
    <?php $company = $job->getCompany(true); ?>

    <div itemscope itemtype="http://schema.org/JobPosting">
    <meta itemprop="title" content="<?php esc_attr_e($job->job_title) ?>" />
    <meta itemprop="datePosted" content="<?php esc_attr_e($job->job_created_at) ?>" />
    
    <div class="wpjb-top-header wpjb-layer-inside">
        <div class="wpjb-top-header-image">
            
            <?php if($job->doScheme("company_logo")): ?>
            <?php elseif($job->getLogoUrl()): ?>
            <img src="<?php echo $job->getLogoUrl("64x64") ?>" alt=""  />
            <?php else: ?>
            <span class="wpjb-glyphs wpjb-icon-building wpjb-icon-only wpjb-icon-64"></span>
            <?php endif; ?>
        </div>
            
        <div class="wpjb-top-header-content">
            <div>
                <span class="wpjb-top-header-title">
                    
                    <?php if($job->doScheme("company_name")): ?>
                    <?php else: ?>
                    
                    <?php esc_html_e($job->company_name) ?>
                    
                    <?php if($company->id && $company->hasActiveProfile()): ?>
                    <a href="<?php esc_attr_e(wpjb_link_to("company", $company)) ?>" title="<?php esc_attr_e(__("visit company profile", "wpjobboard")) ?>" class="wpjb-glyphs wpjb-icon-link"></a>
                    <?php elseif($job->company_url): ?>
                    <a href="<?php esc_attr_e($job->company_url) ?>" title="<?php esc_attr_e(__("visit company website", "wpjobboard")) ?>" class="wpjb-glyphs wpjb-icon-link"></a>
                    <?php endif; ?>
                    
                    <?php endif; ?>
                </span>
                
                <em class="wpjb-top-header-subtitle">
                    <?php echo sprintf(__('Published: %1$s (%2$s ago)', "wpjobboard"), wpjb_date_display(get_option('date_format'), $job->job_created_at), daq_time_ago_in_words($job->time->job_created_at)) ?>
                </em>
                
            </div>
        </div>

    </div>
          
    <div class="wpjb-grid wpjb-grid-closed-top">
        <div class="wpjb-grid-row">
            <div class="wpjb-grid-col wpjb-col-30"><?php _e("Location", "wpjobboard"); ?></div>
            <div class="wpjb-grid-col wpjb-col-65 wpjb-glyphs wpjb-icon-location">
                    <?php if(wpjb_conf("show_maps") && $job->getGeo()->status==2): ?>
                    <a href="<?php esc_attr_e(wpjb_google_map_url($job)) ?>" class="wpjb-tooltip" title="<?php esc_attr_e("show on map", "wpjobboard") ?>"><?php esc_html_e($job->locationToString()) ?><span class="wpjb-glyphs wpjb-icon-down-open"></span></a>
                    <?php else: ?>
                    <?php esc_html_e($job->locationToString()) ?>
                    <?php endif; ?>
                </span>
            </div>
                
            <?php if(wpjb_conf("show_maps") && $job->getGeo()->status==2): ?>
            <div class="wpjb-none wpjb-map-slider">
                <iframe style="width:100%;height:350px;margin:0;padding:0;" width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src=""></iframe>
            </div>
            <?php endif; ?>
        </div>        
        
        <?php if(isset($job->getTag()->type) && is_array($job->getTag()->type)): ?>
        <div class="wpjb-grid-row">
            <div class="wpjb-grid-col wpjb-col-30"><?php _e("Job Type", "wpjobboard"); ?></div>
            <div class="wpjb-grid-col wpjb-col-65 wpjb-glyphs wpjb-icon-tags">
                <?php foreach($job->getTag()->type as $type): ?>
                    <a href="<?php esc_attr_e(wpjb_link_to("type", $type)) ?>"><span itemprop="employmentType"><?php esc_html_e($type->title) ?></span></a>
                <?php endforeach; ?>
            </div>
        </div> 
        <?php endif; ?>
        
        <?php if(isset($job->getTag()->category) && is_array($job->getTag()->category)): ?>
        <div class="wpjb-grid-row">
            <div class="wpjb-grid-col wpjb-col-30"><?php _e("Category", "wpjobboard"); ?></div>
            <div class="wpjb-grid-col wpjb-col-65 wpjb-glyphs wpjb-icon-tags">
                <?php foreach($job->getTag()->category as $category): ?>
                    <a href="<?php esc_attr_e(wpjb_link_to("category", $category)) ?>"><span itemprop="employmentType"><?php esc_html_e($category->title) ?></span></a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <?php foreach($job->getMeta(array("visibility"=>0, "meta_type"=>3, "empty"=>false, "field_type_exclude"=>"ui-input-textarea")) as $k => $value): ?>
        <div class="wpjb-grid-row <?php esc_attr_e("wpjb-row-meta-".$value->conf("name")) ?>">
            <div class="wpjb-grid-col wpjb-col-30"><?php esc_html_e($value->conf("title")); ?></div>
            <div class="wpjb-grid-col wpjb-col-65 wpjb-glyphs <?php esc_attr_e($value->conf("render_icon", "wpjb-icon-empty")) ?>">
                <?php if($job->doScheme($k)): ?>
                <?php elseif($value->conf("type") == "ui-input-file"): ?>
                    <?php foreach($job->file->{$value->name} as $file): ?>
                    <a href="<?php esc_attr_e($file->url) ?>" rel="nofollow"><?php esc_html_e($file->basename) ?></a>
                    <?php echo wpjb_format_bytes($file->size) ?><br/>
                    <?php endforeach ?>
                <?php else: ?>
                    <?php esc_html_e(join(", ", (array)$value->values())) ?>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
        
        <?php do_action("wpjb_template_job_meta_text", $job) ?>
    </div>

    <div class="wpjb-text-box">

        <h3><?php _e("Description", "wpjobboard") ?></h3>
        <div itemprop="description" class="wpjb-text">
            <?php if($job->doScheme("job_description")): else: ?>
            <?php wpjb_rich_text($job->job_description, $job->meta->job_description_format->value()) ?>
            <?php endif; ?>
        </div>

        <?php foreach($job->getMeta(array("visibility"=>0, "meta_type"=>3, "empty"=>false, "field_type"=>"ui-input-textarea")) as $k => $value): ?>
        

        <h3><?php esc_html_e($value->conf("title")); ?></h3>
        <div class="wpjb-text">
            <?php if($job->doScheme($k)): else: ?>
            <?php wpjb_rich_text($value->value(), $value->conf("textarea_wysiwyg") ? "html" : "text") ?>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>

        <?php do_action("wpjb_template_job_meta_richtext", $job) ?>
    </div>
    <div class="wpjb-text-box">
		<h3><?php _e("Apply", "wpjobboard") ?></h3>
        <div itemprop="apply-description" class="wpjb-text">
           <p>To apply for this job, email your details to <a href="hr@jacuzzi.com">hr@jacuzzi.com</a>.</p>
        </div>
    </div>
    </div>

