<?php

/* sidebar */
?>
<div class="dform"><a name="top" id="top"></a>
    <div class="ftop">Download a<br />Free Brochure</div>
    <div class="ftitle">Please provide your information<br />in the form below.</div>
                        <form action="<?php echo get_permalink(); ?>" id="leadForm" method="post">
                            <?php avala_hidden_fields( 15, 9, 12 ); ?>
                            <table cellspacing="0">
                                <tr>
                                    <td>
                                    	<?php avala_field( 'first_name', 'text w115', true); ?>
                                </td>
                                    <td>
                                        <?php avala_field( 'last_name', 'text w115', true); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <?php avala_field( 'email', 'text w270 email', true); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php avala_field( 'phone', 'text w115', false); ?>
                                    </td>
                                    <td>
                                        <label for="person_postal_code">Zip/Postal Code *</label>
                                        <?php avala_field( 'postal_code', 'text w115', true, field, array( 'maxlength' => 10 )); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <p class="note">* Indicates required fields.</p>
                                        <input type="submit" class="submit bigBlueBtn" value="Download a Brochure" />
                                    </td>
                                </tr>
                            </table>
                            <p class="note"><a href="<?php echo get_permalink(3987) ?>">Privacy Policy</a></p>
                        </form>
                    <form action="<?php echo trailingslashit(get_bloginfo('url')) ?>dealer-locator/cities/" class="loc" method="post" name="countryZipForm"><input type="hidden" name="zipcodeSearch" value="1" /><input type="hidden" name="data[Dealer][country_id]" value="1" />
                    <a href="<?php bloginfo('url'); ?>/dealer-locator/">Locate a Dealer</a>
                    <input type="text" class="text zip" name="zip" onblur="if(jQuery(this).val() == '') jQuery(this).val('Zip Code')" onfocus="if(jQuery(this).val() == 'Zip Code') jQuery(this).val('')" value="Zip Code" />
                    <input type="image" src="<?php bloginfo('template_url') ?>/images/icons/topsub.png" style="float:left" value="submit" />
                    </form>
</div>