<?php
/**
 * Template Name: Awareness
 *
 * @package JHT
 * @subpackage JHT
 * @since JHT 1.0
 */

get_header('awareness');
?>

<script type="text/javascript">
    //$('<div />', {id:'TB_window'}).appendTo('body').css({backgroundColor:'red'});
    jQuery('.aware-img').on("click", function(){
        jQuery('#TB_window').ready(function() {
            jQuery('#TB_window').scrollTop(700);
        });
    });
</script>
    <div class="hero">
    	<div class="wrap">
            <!--<h1 class="title"></h1>-->
        </div>
    </div>
    <div class="goldBar10"></div>
    <div class="bd">
    	<div class="wrap">
                <div><h1 class="awareness-title">3 Reasons You'll Love Your Jacuzzi<span>&reg;</span> Hot Tub</h1></div>
                <div class="aware-rows">
                    <div class="aware-row aware-row1">
                        <div class="aware-row-left">
                            <h2 class="awareness-h2">1. Connect With Family &amp; Friends</h2>
                            <h3 class="awareness-h3">Improve relationships with your spouse, kids and friends</h3>
                            <p>"You can't bring a cell phone in a hot tub. All those distractions that are normally there are gone. It's just us. One on one, having real conversations."<br />
                            <b>- Nicole MacKenzie</b></p>
                        </div>

                        <div class="aware-row-right aware-img1">
                            <a class="aware-img thickbox" href="http://www.youtube.com/embed/hIFbnk-3Y4k?rel=0&amp;KeepThis=true&amp;TB_iframe=true&amp;height=400&amp;width=600" >
                                <img src="<?php bloginfo('template_url'); ?>/images/awareness/pic-top.jpg" />
                            </a>
                        </div>
                    </div>
                    <div class="aware-row aware-row2">
                        <div class="aware-row-left">
                            <h2 class="awareness-h2">2. Feel Better Physically</h2>
                            <h3 class="awareness-h3">Reduce aches and pains</h3>
                            <p>"Heat promotes circulation, sensory impulses, it makes you feel good."<br /><b>- Dr. James Andrews, renowned orthopedic surgeon and past president of the American Orthopedic Society for Sports Medicine</b></p>
                        </div>

                        <div class="aware-row-right aware-img2">
                            <a class="aware-img thickbox" href="http://www.youtube.com/embed/XcW1L0woECs?rel=0&amp;KeepThis=true&amp;TB_iframe=true&amp;height=400&amp;width=600" >
                                <img src="<?php bloginfo('template_url'); ?>/images/awareness/pic-middle.jpg" />
                            </a>
                        </div>
                    </div>
                    <div class="aware-row aware-row3">
                        <div class="aware-row-left">
                            <h2 class="awareness-h2">3. Relax</h2>
                            <h3 class="awareness-h3">Melt away stress and tension</h3>
                            <p><b>Bruce Becker, MD, a professor at Washington State University recently studied the effect immersion in warm water has on healthy adults:</b></p>
                            <p>&bull; After about 24 minutes, the central nervous system patterns of the subject changed to that of a relaxed and focused person.</p>
                            <p>&bull; Other studies show reduced depression and anxiety as well as improved sleep. A 1999 study found that women who took a 20-30 miniute soak in hot water were able to fall asleep faster and had higher-quality sleep.</p>
                        </div>

                        <div class="aware-row-right aware-img3">
                            <a class="aware-img thickbox" href="<?php bloginfo('template_url'); ?>/images/awareness/jacuzzi-awareness-infographic.jpg" >
                                <img src="<?php bloginfo('template_url'); ?>/images/awareness/pic-bottom.jpg" />
                            </a>
                        </div>
                    </div>                    
                </div>
                <div class="aware-side">
                    <?php get_sidebar('awareness'); ?>
                </div>
        
<?php get_footer('awareness'); ?>
