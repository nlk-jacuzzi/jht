<?php

// something'

?>
<script src="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/js/jquery.lazyload.min.js"></script>
<style>
.color-selector.color-selector-container { height: 500px; margin-top: 1px; width: 100%; }
.color-selector.color-selector-container .color-selector-wrapper { margin: auto; width: 960px; }
.color-selector.color-selector-container .color-selector-wrapper .left { box-sizing: border-box; float: left; height: 400px; margin-right: 76px; text-align: center; width: 576px; }
.color-selector.color-selector-container .color-selector-wrapper .left .tub-container { height: 380px; overflow: visible; position: relative; }
.color-selector.color-selector-container .color-selector-wrapper .left .tub-container div { position: absolute; }
.color-selector.color-selector-container .color-selector-wrapper .left .tub-container img { height: 410px; left: 0; opacity: 0; position: absolute; top: 0; width: 576px; -webkit-transition: opacity .05s; transition: opacity .05s; }
.color-selector.color-selector-container .color-selector-wrapper .left .tub-container img.active { opacity: 1; }
.color-selector.color-selector-container .color-selector-wrapper .left .tub-details {font-family: "GSL"; margin-top: 14px; padding-left: 10px; text-align: left; }
.color-selector.color-selector-container .color-selector-wrapper .left .tub-details h3 { font-size: 13px; }
.color-selector.color-selector-container .color-selector-wrapper .left .tub-details h3 strong { font-family: "GSBQ"; font-weight: 700; }
.color-selector.color-selector-container .color-selector-wrapper .left .tub-details li { font-size: 13px; font-weight: 700; margin-left: 17px; }
.color-selector.color-selector-container .color-selector-wrapper .right { box-sizing: border-box; float: left; height: 400px; padding-top: 22px; width: 308px; }
.color-selector.color-selector-container .color-selector-wrapper .right h2 { font-size: 16px; letter-spacing: .75px; margin: 24px 5px 10px; text-transform: none; }
.color-selector.color-selector-container .color-selector-wrapper .right h2 span { font-family: "GSL"; font-weight: 700; }
.color-selector.color-selector-container .color-selector-wrapper .right .btn { margin-top: 34px; text-transform: uppercase; }
.color-selector.color-selector-container .color-selector-wrapper .right .pdf-download { color: #414141; font: 600 14px/40px "GSL"; text-transform: capitalize;  letter-spacing: 0px !important;}
.color-selector.color-selector-container .color-selector-wrapper .thumb { border: 2px solid #fff; border-radius: 99px; cursor: pointer; display: inline-block; margin: 2px 3px; overflow: hidden; -webkit-transition: border-color .05s; transition: border-color .05s; }
.color-selector.color-selector-container .color-selector-wrapper .thumb.active,
.color-selector.color-selector-container .color-selector-wrapper .thumb:hover { border: 2px solid #666; box-shadow: 0px 0px 6px rgba(0,0,0,.25);  }
.color-selector.color-selector-container .color-selector-wrapper .thumb img { border: 2px solid #fff; border-radius: 99px; display: block; height: 45px; width: 45px; }
/* styles for when modal */
.color-selector-modal-bg { background-color: rgba(0,0,0,.66); height: 100%; left: 0; position: fixed; top: 0; width: 100%; z-index: 999; }
.color-selector-modal { background-color: #fff; margin: 55px auto; width: 1020px; }
.color-selector-modal-title { background-color: #000; position: relative; width: 100%; }
.color-selector-modal-title h2 { color: #fff; font: 700 24px/84px "GSL"; letter-spacing: 1px; margin: 40px; }
.color-selector-modal-title span { position: absolute; right: 36px; top: 36px; }
.color-selector-modal-title span a { color: #fff; cursor: pointer; font: 700 16px "GSL"; }
.color-selector-modal-title span a:after { border: 1px solid #fff; content: 'x'; display: inline-block; height: 7px; line-height: 5px; margin-left: 8px; padding: 2px; }

div[timg="platinum"] img { background-color: #d4d7d7; }
div[timg="silverpearl"] img { background-color: #e5e4de; }
div[timg="monaco"] img { background-color: #887e78; }
div[timg="midnight"] img { background-color: #242426; }
div[timg="opal"] img { background-color: #d3d5d7; }
div[timg="sahara"] img { background-color: #c5c4c2; }
div[timg="sand"] img { background-color: #bca792; }
div[timg="desertsand"] img { background-color: #726151; }
div[timg="caribbeansurf"] img { background-color: #0090b8; }
div[timg="slategreen"] img { background-color: #39565a; }
div[timg="brazilianteak"] img { background-color: #be9969; }
div[timg="roastedchestnut"] img { background-color: #47312c; }
div[timg="silverwood"] img { background-color: #635e5f; }

/* For Responsiveness */
.wrap {
    max-width: 960px;
    margin: 0 auto;
    position: relative;
    width: 100%;
}

.color-selector.color-selector-container .color-selector-wrapper {
    margin: auto;
    max-width: 960px;
    width: 100%;
}

.color-selector.color-selector-container .color-selector-wrapper .left {
    box-sizing: border-box;
    float: left;
    height: 400px;
    margin-right: 2%;
    text-align: center;
    width: 67.8%;
}

.color-selector.color-selector-container .color-selector-wrapper .right {
    box-sizing: border-box;
    float: left;
    height: 400px;
    padding-top: 22px;
    width: 30%;
}

.color-selector.color-selector-container .color-selector-wrapper .right .pdf-download{
	width: 100%;
	max-width: 240px;
}

@media only screen and (max-width: 767px) 
{
	.color-selector.color-selector-container .color-selector-wrapper {
		padding-left: 15px;
		padding-right: 15px;
	}	
	.color-selector.color-selector-container .color-selector-wrapper .left {
	    float: none;
	    width: 100%;
	}
	
	.color-selector.color-selector-container .color-selector-wrapper .right {
	    float: none;
	    width: 30%;
	}
	
	.color-selector.color-selector-container .color-selector-wrapper .left .tub-container img
	{
		width: 350px;
		height: auto;
	}
	
	.color-selector.color-selector-container .color-selector-wrapper .left .tub-container
	{
		height: 255px;
	}
}	
</style>
<div class="color-selector color-selector-container">

	<div class="color-selector-wrapper">

		<div class="left">

			<div class="tub-container">
				<div class="tub-skirt">
					<img class="lazy active" data-original="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/skirts/skirt-brazilianteak.png" timg="brazilianteak" height="410" width="576" />
					<img class="lazy" data-original="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/skirts/skirt-roastedchestnut.png" timg="roastedchestnut" height="410" width="576" />
					<img src="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/skirts/skirt-silverwood.png" timg="silverwood" height="410" width="576" />
				</div>
				<div class="tub-shell">
					<img class="lazy active" data-original="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/shells/platinum.png" timg="platinum" height="410" width="576" />
					<img class="lazy" data-original="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/shells/silverpearl.png" timg="silverpearl" height="410" width="576" />
					<img class="lazy" data-original="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/shells/monaco.png" timg="monaco" height="410" width="576" />
					<img class="lazy" data-original="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/shells/midnight.png" timg="midnight" height="410" width="576" />
					<img class="lazy" data-original="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/shells/opal.png" timg="opal" height="410" width="576" />
					<img class="lazy" data-original="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/shells/sahara.png" timg="sahara" height="410" width="576" />
					<img class="lazy" data-original="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/shells/sand.png" timg="sand" height="410" width="576" />
					<img class="lazy" data-original="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/shells/desertsand.png" timg="desertsand" height="410" width="576" />
					<img class="lazy" data-original="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/shells/caribbeansurf.png" timg="caribbeansurf" height="410" width="576" />
					<img src="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/shells/titanium.png" timg="titanium" height="410" width="576" />
					<!--img src="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/shells/slategreen.png" timg="slategreen" height="410" width="576" /-->
				</div>
			</div>
			<div class="tub-details">
				<?php /*
				<h3><strong>Shell:</strong> <span class="shell-name"></span></h3>
				<h3><strong>Cabinetry:</strong> <span class="skirt-name"></span></h3>
				*/ ?>
				<ul>
					<li><i>J-355<sup>&trade;</sup> model shown for visualization purposes only. Tub size and jet placement will vary by model.<br />Not all colors available in all models. See individual product pages for available colors.</i></li>
				</ul>
			</div>

		</div>
		
		<div class="right">

			<h2><strong>Shell:</strong> <span class="shell-name"></span></h2>
			<div class="shells">
				<div class="shell thumb active" timg="platinum" data-pdf="platinum" rel="Platinum" ><img class="lazy" data-original="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/shells/acrylic-thumb-platinum.png" height="45" width="45"/></div>
				<div class="shell thumb" timg="silverpearl" data-pdf="silverpearl" rel="Silver Pearl" ><img class="lazy" data-original="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/shells/acrylic-thumb-silverpearl.png" height="45" width="45" /></div>
				<div class="shell thumb" timg="monaco" data-pdf="monaco" rel="Monaco" ><img class="lazy" data-original="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/shells/acrylic-thumb-monaco.png" height="45" width="45" /></div>
				<div class="shell thumb" timg="midnight" data-pdf="midnight" rel="Midnight" ><img class="lazy" data-original="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/shells/acrylic-thumb-midnight.png" height="45" width="45" /></div>
				<div class="shell thumb" timg="opal" data-pdf="opal" rel="Opal" ><img class="lazy" data-original="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/shells/acrylic-thumb-opal.png" height="45" width="45" /></div>
				<div class="shell thumb" timg="sahara" data-pdf="sahara" rel="Sahara" ><img class="lazy" data-original="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/shells/acrylic-thumb-sahara.png" height="45" width="45" /></div>
				<div class="shell thumb" timg="sand" data-pdf="sand" rel="Sand" ><img class="lazy" src="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/shells/acrylic-thumb-sand.png" height="45" width="45" /></div>
				<div class="shell thumb" timg="desertsand" data-pdf="desertsand" rel="Desert Sand" ><img class="lazy" data-original="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/shells/acrylic-thumb-desertsand.png" height="45" width="45" /></div>
				<div class="shell thumb" timg="caribbeansurf" data-pdf="caribbeansurf" rel="Caribbean Surf" ><img class="lazy" data-original="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/shells/acrylic-thumb-caribbeansurf.png" height="45" width="45" /></div>
				<div class="shell thumb" timg="titanium" data-pdf="titanium" rel="Titanium" ><img src="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/shells/acrylic-thumb-titanium.png" height="45" width="45" /></div>
				<!--div class="shell thumb" timg="slategreen" data-pdf="slategreen" rel="Slate Green" ><img src="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/shells/acrylic-thumb-slategreen.png" height="45" width="45" /></div-->
			</div>
			<h2><strong>Cabinetry:</strong> <span class="skirt-name"></span></h2>
			<div class="skirts">
				<div class="skirt thumb brazilianteak active" timg="brazilianteak" rel="Brazilian Teak" data-pdf="teak" ><img class="lazy" data-original="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/skirts/skirt-thumb-brazilianteak.png" height="45" width="45" /></div>
				<div class="skirt thumb roastedchestnut" timg="roastedchestnut" rel="Roasted Chestnut" data-pdf="chest" ><img class="lazy" data-original="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/skirts/skirt-thumb-roastedchestnut.png" height="45" width="45" /></div>
				<div class="skirt thumb silverwood" timg="silverwood" rel="Silverwood" data-pdf="silver" ><img class="lazy" data-original="http://www.jacuzzi.com/hot-tubs/wp-content/themes/jht/images/lowres-colorselector/skirts/skirt-thumb-silverwood.png" height="45" width="45" /></div>
			</div>
			<?php /* ?><a class="btn bigGoldBtn" href="<?php echo get_bloginfo('url'); ?>/get-a-quote/" target="_parent">Get Pricing</a><?php */ ?>
			<a class="btn bigGoldBtn pdf-download" href="" download="">Download Your Selected Color PDF</a>

		</div>

	</div>

</div>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("img.lazy").lazyload({
	        event : "sporty"
	    });
	});
	
	jQuery(window).bind("load", function() {
	    var timeout = setTimeout(function() {
	        jQuery("img.lazy").trigger("sporty")
	    }, 5000);
	});
	
jQuery(function($){

	function updatepdf() {
		var pdf1 = $('.color-selector div.shell.thumb.active').attr('data-pdf'),
			pdf2 = $('.color-selector div.skirt.thumb.active').attr('data-pdf'),
			pdfroot = "<?php echo network_site_url('/brochures/shellskirtoptions/'); ?>";
		if ( $(this).hasClass('shell') ) {
			pdf1 = $(this).attr('data-pdf');
		}
		if ( $(this).hasClass('skirt') ) {
			pdf1 = $(this).attr('data-pdf');
		}
		var pdfurl = pdfroot + pdf1 + '_' + pdf2;
		$('a.pdf-download').attr({
			'href': pdfurl + '.pdf',
			'download': pdf1 + '_' + pdf2
		});
	}
	
	
	
	// set default shell and skirt names
	var shellname = $('.color-selector div.shell.thumb.active').attr('rel');
	var skirtname = $('.color-selector div.skirt.thumb.active').attr('rel');
	$('.color-selector span.shell-name').html( shellname );
	$('.color-selector span.skirt-name').html( skirtname );
	updatepdf();

	// onclick update
	$('.color-selector div.shell.thumb').click(function(){
		var newshellname = $(this).attr('rel');
		var newshellimg = $(this).attr('timg');
		$('.color-selector div.shell.thumb.active').removeClass('active');
		$('.color-selector div.tub-shell img.active').removeClass('active');
		$(this).addClass('active');
		$('.color-selector div.tub-shell').find('img[timg="' + newshellimg + '"]').addClass('active');
		$('.color-selector span.shell-name').html( newshellname );
		updatepdf();
	});
	$('.color-selector div.shell.thumb').hover(function(){
		var newshellname = $(this).attr('rel');
		$('.color-selector span.shell-name').html( newshellname );
	}, function(){
		var shellname = $('.color-selector div.shell.thumb.active').attr('rel');
		$('.color-selector span.shell-name').html( shellname );
	});
	$('.color-selector div.skirt.thumb').click(function(){
		var newskirtname = $(this).attr('rel');
		var newskirtimg = $(this).attr('timg');
		$('.color-selector div.skirt.thumb.active').removeClass('active');
		$('.color-selector div.tub-skirt img.active').removeClass('active');
		$(this).addClass('active');
		$('.color-selector div.tub-skirt').find('img[timg="' + newskirtimg + '"]').addClass('active');
		$('.color-selector span.skirt-name').html( newskirtname );
		updatepdf();
	});
	$('.color-selector div.skirt.thumb').hover(function(){
		var newskirtname = $(this).attr('rel');
		$('.color-selector span.skirt-name').html( newskirtname );
	}, function(){
		var skirtname = $('.color-selector div.skirt.thumb.active').attr('rel');
		$('.color-selector span.skirt-name').html( skirtname );
	});
	$('#close-cs-modal').click(function(){
		$('.color-selector-modal-bg').hide();
	});
	$('a.pdf-download').click(function(){

	})
});
</script>