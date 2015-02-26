<?php
global $post;
$menucustom = get_post_meta($post->ID,'jht_menuoption');
$menuopts = $menucustom[0];

if ( !isset($menuopts['silver']) || $menuopts['silver'] !== 'No' ) {
?>
			<ul class="silverMenu clear">
                <li class="first"><a href="<?php echo get_permalink(3803) ?>">Energy<br />Efficiency</a></li>
                <li><a href="<?php echo get_permalink(3805) ?>">Advanced<br />Hydrotherapy</a></li>
                <li><a href="<?php echo get_permalink(3899) ?>">Customer<br />Showcase</a></li>
                <li><a href="<?php echo get_permalink(4169) ?>">10 Year<br />Warranty</a></li>
                <li class="last signUp"><span class="txt"><strong>Sign-up</strong> for updates &amp; specials</span>
                    <script type="text/javascript" src="http://login.sendmetric.com/phase2/bhecho_files/smartlists/check_entry.js"></script>
                    <script type="text/javascript">
                    	<!--
                    		function check_cdfs(form) {
                    			return true;
                    		}
                    	-->
                    </script>
                    <script type="text/javascript">
                    <!--
                        function doSubmit() {
                            if (check_cdfs(document.survey)) {
                    			window.open('','signup','resizable=1,scrollbars=0,width=300,height=150');
                                return true;
                            }
                            else { return false; }
                        }
                    -->
                    </script>
                    <form action="http://login.sendmetric.com/phase2/bullseye/contactupdate1.php3" method="post" name="bullseye" id="bullseye" onsubmit="return doSubmit();" target="signup">
                        <input type="hidden" name="cid" value="325a091ebb4d440d143f7a6676e8c5bd" />
                        <input type="text" value="Email" class="text email" name="email" onfocus="if(jQuery(this).val() == 'Email') jQuery(this).val('');" onblur="if(jQuery(this).val() == '') jQuery(this).val('Email');" />
                        <input type="text" value="Zip" class="text zip" name="postal_code" onfocus="if(jQuery(this).val() == 'Zip') jQuery(this).val('');" onblur="if(jQuery(this).val() == '') jQuery(this).val('Zip');" />
                        <input type="hidden" name="message" value="Thank you. Your information has been submitted. To ensure delivery of your newsletter(s), please add donotreply@jacuzzihottubs.com to your address book, spam filter whitelist, or tell your company's IT group to allow this address to pass through any filtering software they may have set up." />
                        <input type="image" name="SubmitBullsEye" value="submit"  onclick="var s=s_gi('jacuzzipremiumhottubs.jacuzzi.com');s.linkTrackVars='events';s.linkTrackEvents='event1';s.events='event1';s.tl(this,'o','Email Signup');" src="<?php bloginfo('template_url') ?>/images/icons/silversub.png" />
                        <input type=hidden name="grp[]" value="584177" />
                    </form>
                </li>
            </ul>
<?php } ?>