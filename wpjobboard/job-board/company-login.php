
<div class="wpjb wpjb-page-company-login">

    <?php wpjb_flash() ?>

    <form class="wpjb-form" action="" method="post">
        <?php echo $form->renderHidden() ?>
        <?php foreach($form->getReordered() as $group): ?>
        
        <?php /* @var $group stdClass */ ?> 
        <fieldset class="wpjb-fieldset-<?php esc_attr_e($group->getName()) ?>">
            <?php if(!empty($group->title)): ?><legend><?php esc_html_e($group->title) ?></legend><?php endif; ?>
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
            <div>
                <input type="submit" name="wpjb_login" id="wpjb_submit" value="<?php _e("Login", "wpjobboard") ?>" />
                <a href="<?php echo wpjb_link_to("employer_new") ?>"><?php _e("Not a member? Register", "wpjobboard") ?></a>
            </div>
        </fieldset>


    </form>


</div>
