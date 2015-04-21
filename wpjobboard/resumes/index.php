<?php 

/**
 * Resumes list
 * 
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage Resumes
 */

 /* @var $resumeList array of Wpjb_Model_Resume objects */
 /* @var $can_browse boolean True if user has access to resumes */

?>

<div class="wpjb wpjr-page-resumes">

    <?php wpjb_flash(); ?>

    <?php if($search_bar != "disabled"): ?>
    <div id="wpjb-top-search" class="wpjb-layer-inside">
    <form action="<?php esc_attr_e(wpjr_link_to("search")) ?>" method="GET" id="wpjb-top-search-form">
        <?php global $wp_rewrite ?>
        <?php if(!$wp_rewrite->using_permalinks()): ?>
        <input type="hidden" name="page_id" value="<?php echo Wpjb_Project::getInstance()->conf("link_resumes") ?>" />
        <input type="hidden" name="job_board" value="find" />
        <?php endif; ?>
        <input autocomplete="off" type="text" class="wpjb-top-search-query wpjb-ls-query" name="query" value="<?php esc_attr_e(isset($param["query"]) ? $param["query"] : "") ?>" placeholder="<?php esc_attr_e("Who (title, experience, education ...)?", "wpjobboard") ?>" />
        <input autocomplete="off" type="text" class="wpjb-top-search-location wpjb-ls-location" name="location" value="<?php esc_attr_e(isset($param["location"]) ? $param["location"] : "") ?>" placeholder="<?php esc_attr_e("Where?", "wpjobboard") ?>" />

        <div class="wpjb-top-search-submit" style="">
            <input type="submit" value="<?php esc_attr_e("Filter Results", "wpjobboard") ?>" />
        </div>
    </form>
    </div>
    <?php if($search_bar == "enabled-live"): ?>
        <script type="text/javascript">
            jQuery(function($) {
                WPJB_SEARCH_CRITERIA = <?php echo json_encode($search_init) ?>;
                wpjb_ls_jobs_init();
            });
        </script>
    <?php endif; ?>
    
    <?php endif; ?>
    
    <div class="wpjb-grid">
    
        <?php $result = wpjb_find_resumes($param); ?>
        <?php if ($result->count > 0) : foreach($result->resume as $resume): ?>
            <?php /* @var $resume Wpjb_Model_Resume */ ?>
            <?php $this->resume = $resume; ?>
            <?php $this->render("index-item.php") ?>
            <?php endforeach; else :?>
            <div class="wpjb-grid-row">
                <?php _e("No resumes found.", "wpjobboard"); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="wpjb-paginate-links">
        <?php wpjb_paginate_links($url, $result->pages, $result->page, $query, $format) ?>
    </div>


</div>
