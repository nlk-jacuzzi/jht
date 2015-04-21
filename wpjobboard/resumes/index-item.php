

<div class="wpjb-grid-row">
    <div class="wpjb-grid-col wpjb-col-logo">
        <?php if($resume->doScheme("image")): ?>
        <?php elseif($resume->getAvatarUrl()): ?>
        <img src="<?php echo $resume->getAvatarUrl("32x32") ?>" alt="" class="wpjb-img-32" />
        <?php else: ?>
        <span class="wpjb-glyphs wpjb-icon-user wpjb-icon-only wpjb-icon-32"></span>
        <?php endif; ?>
    </div>

    <div class="wpjb-grid-col wpjb-col-title">
        <a href="<?php echo wpjr_link_to("resume", $resume) ?>"><?php esc_html_e($resume->getSearch(true)->fullname) ?></a>
        <?php if($resume->doScheme("headline")): else: ?>
        <span class="wpjb-sub"><?php esc_html_e($resume->headline) ?></span>
        <?php endif; ?>
    </div>

    <div class="wpjb-grid-col wpjb-col-location">
        <?php if($resume->locationToString()): ?>
        <?php esc_html_e($resume->locationToString()) ?>
        <?php else: ?>
        -
        <?php endif; ?>
    </div>

    <div class="wpjb-grid-col wpjb-col-date wpjb-grid-col-right">
        <span class="wpjb-glyphs wpjb-icon-calendar" title="<?php esc_attr_e("Last Updated", "wpjobboard") ?>"></span>
        <?php echo wpjb_date_display("M, d", $resume->modified_at, true); ?>
    </div>
</div>
