<?php

//$geo = geo_data();
//$pickyPostal = ( $geo['country'] == 'US' ) ? 'Zip / Postal Code' : 'Postal Code' ;
$pickyPostal = 'Zip / Postal Code';

?>
			<ul class="topMenu">
                <!--li class="forOwner menu-item first"><a href="<?php echo get_site_url() ?>/owners-corner/" name="top">For Owners</a></li-->
                <!--li class="brochure menu-item"><a href="http://shop.jacuzzi.com" target="_blank">Accessories Store</a></li-->
                <li class="brochure menu-item"><a class="download-icon" href="<?php echo get_permalink(3745) ?>">Free Brochure</a></li>
                <!--li class="quote menu-item"><a href="<?php echo get_permalink(3743) ?>">Request a Quote</a></li-->
                <!--li class="quote menu-item"><a href="<?php echo get_permalink(7759) ?>">Trade-In Value</a></li-->
                <li class="locateDealer menu-item last">
                    <a class="locate-dealer-icon"  href="<?php bloginfo('url'); ?>/dealer-locator/">Nearest Dealer</a>
                    <form name="countryZipForm" method="post" action="<?php echo trailingslashit(get_bloginfo('url')) ?>dealer-locator/cities/">
                        <input type="hidden" value="1" name="zipcodeSearch" />
                        <input type="hidden" value="1" name="data[Dealer][country_id]" />
                        <input type="text" 
                            id="topZip" 
                            class="text zip" 
                            value="<?php echo $pickyPostal; ?>" 
                            onfocus="if(jQuery(this).val() == '<?php echo $pickyPostal; ?>') jQuery(this).val('').removeClass('err')" 
                            onblur="if(jQuery(this).val() == '') jQuery(this).val('<?php echo $pickyPostal; ?>')" 
                            name="zip" />
                        <input type="image" 
                            id="topSubmit" 
                            value="submit" src="<?php bloginfo('template_url') ?>/images/icons/ul-arrow.png" 
                            style="float:left" 
                            onclick="if(jQuery('input#topZip').val() == '<?php echo $pickyPostal; ?>') {
                                jQuery('input#topZip').addClass('err');
                                return false;
                            }"/>
                    </form>
                </li>
            </ul>