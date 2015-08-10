<?php 

/**
 * Advanced search form
 * 
 * Displays advanced search form
 * 
 * @author Greg Winiarski
 * @package Templates
 * @subpackage JobBoard
 */

 /* @var $form Wpjb_Form_AdvancedSearch */

?>

<div class="wpjb wpjb-page-search">

    <form action="<?php echo wpjb_link_to("search") ?>" method="get" class="wpjb-form">
        <?php echo $form->renderHidden() ?>
        <?php foreach($form->getReordered() as $group): ?>
        <?php /* @var $group stdClass */ ?> 
        <fieldset class="wpjb-fieldset-<?php esc_attr_e($group->getName()) ?>">
            <legend class="wpjb-empty"><?php esc_html_e($group->title) ?></legend>
            <?php foreach($group->getReordered() as $name => $field): ?>
            <?php /* @var $field Daq_Form_Element */ ?>
            <div class="<?php wpjb_form_input_features($field) ?>">

                <label class="wpjb-label">
                    <?php esc_html_e($field->getLabel()) ?>
                    <?php if($field->isRequired()): ?><span class="wpjb-required">*</span><?php endif; ?>
                </label>
                
                <div class="wpjb-field">
                    <?php wpjb_form_render_input($form, $field) ?>
                    <?php wpjb_form_input_hint($field) ?>
                    <?php wpjb_form_input_errors($field) ?>
                </div>

            </div>
            <?php endforeach; ?>
        </fieldset>
        <?php endforeach; ?>
        <fieldset>
            <legend class="wpjb-empty"></legend>
            <input type="submit" class="wpjb-submit" id="wpjb_submit" value="<?php _e("Search", "wpjobboard") ?>" />
        </fieldset>

    </form>

</div>
