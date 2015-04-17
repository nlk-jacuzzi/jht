<ul class="wpjb-add-job-steps">
    <?php for($i=1; $i<=3; $i++): ?>
    <li <?php if($current_step==$i): ?>class="wpjb-step-current"<?php endif; ?>>
        <?php #echo "$i. " ?>
        <?php esc_html_e(wpjb_conf("seo_step_$i", $steps[$i])) ?>
        <?php if($current_step==$i): ?><span class="wpjb-arrow wpjb-glyphs wpjb-icon-right-big">&nbsp;</span><?php endif; ?>
    </li>
    <?php endfor; ?>
    

</ul>
    
