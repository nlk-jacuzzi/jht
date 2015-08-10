<?php 

/**
 * Job list item
 * 
 * This template is responsible for displaying job list item on job list page
 * (template index.php) it is alos used in live search
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 */

 /* @var $job Wpjb_Model_Job */

?>

    <div class="wpjb-grid-row <?php wpjb_job_features($job); ?>">
        <div class="wpjb-grid-col wpjb-col-logo">
            <?php if($job->doScheme("company_logo")): ?>
            <?php elseif($job->getLogoUrl()): ?>
            <img src="<?php echo $job->getLogoUrl("32x32") ?>" alt="" class="wpjb-img-32" />
            <?php else: ?>
            <span class="wpjb-glyphs wpjb-icon-building wpjb-icon-only wpjb-icon-32"></span>
            <?php endif; ?>
        </div>
    
        <div class="wpjb-grid-col wpjb-col-title">
            <a href="<?php echo wpjb_link_to("job", $job) ?>"><?php esc_html_e($job->job_title) ?></a>
            
            <?php if($job->doScheme("company_name")): else: ?>
            <span class="wpjb-sub"><?php esc_html_e($job->company_name) ?></span>
            <?php endif; ?>
        </div>
        
        <div class="wpjb-grid-col wpjb-col-location">
            <?php esc_html_e($job->locationToString()) ?>
        </div>
        
        <div class="wpjb-grid-col wpjb-grid-col-right">
            <?php if($job->isNew()): ?><span class="wpjb-bulb"><?php _e("new", "wpjobboard") ?></span><?php endif; ?>
            <?php echo wpjb_date_display("M, d", $job->job_created_at, true); ?>
            
            <?php if(isset($job->getTag()->type[0])): ?>
            <span class="wpjb-sub" style="color:#<?php echo $job->getTag()->type[0]->meta->color ?>">
            <?php esc_html_e($job->getTag()->type[0]->title) ?>
            </span>
            <?php endif; ?>
            
        </div>
    </div>

