// js for front end of ProGo Themes Direct Response sites
var jacuzzi_swfpath;
function checkReq() {
	var aok = true;
	jQuery('form.pform .need').removeClass('.need');
	jQuery('form.pform .req').each(function() {
		if(jQuery(this).val()=='') {
			aok = false;
			jQuery(this).addClass('need');
		}
	});
	if(!aok) alert('Please check all *Required fields.');
	return aok; 
}

function checkThisField() {
	var val = jQuery(this).val();
	var lab = jQuery(this).prev().html();
	if(val=='' || lab.indexOf(val) >= 0) {
		jQuery(this).addClass('need');
	}
	else {
		jQuery(this).removeClass('need');
	}
}

function progo_set_shipping_country(html_form_id, form_id){
	var shipping_region = '';
	country = jQuery(("div#"+html_form_id+" select[class=current_country]")).val();

	if(country == 'undefined'){
		country =  jQuery("select[title='billingcountry']").val();
	}

	region = jQuery(("div#"+html_form_id+" select[class=current_region]")).val();
	if(/[\d]{1,}/.test(region)) {
		shipping_region = "&shipping_region="+region;
	}

	form_values = {
		wpsc_ajax_action: "change_tax",
		form_id: form_id,
		shipping_country: country,
		shipping_region: region
	}
	
	jQuery.post( 'index.php', form_values, function(returned_data) {
		eval(returned_data);
		jQuery('.statelabel').each(function() {
			if(jQuery(this).next().html() == '') {
				jQuery(this).hide();
			} else {
				jQuery(this).show();//.parents().show();
				if(jQuery(this).parent().next().hasClass('zip')) {
					 jQuery(this).next().children().css('width','54px');
				}
			}
		});
	});
	
}

function progo_set_billing_country(html_form_id, form_id){
	var billing_region = '';
	country = jQuery(("div#"+html_form_id+" select[class=current_country]")).val();
	region = jQuery(("div#"+html_form_id+" select[class=current_region]")).val();
	if(/[\d]{1,}/.test(region)) {
		billing_region = "&billing_region="+region;
	}

	form_values = "wpsc_ajax_action=change_tax&form_id="+form_id+"&billing_country="+country+billing_region;
	jQuery.post( 'index.php', form_values, function(returned_data) {
		eval(returned_data);
		jQuery('.statelabel').each(function() {
			if(jQuery(this).next().html() == '') {
				jQuery(this).hide();
			} else {
				jQuery(this).show();//.parents().show();
				if(jQuery(this).parent().next().hasClass('zip')) {
					 jQuery(this).next().children().css('width','54px');
				}
			}
		});
	});
}

function progo_selectcheck( id, disabled ) {
	var wpsc_checkout_table = jQuery('#region_select_'+ id).parents('.wpsc_checkout_table');
	
	if(disabled == true ) {
		wpsc_checkout_table.find('input.billing_region').attr('disabled', 'disabled');
		wpsc_checkout_table.find('input.shipping_region').attr('disabled', 'disabled');
		wpsc_checkout_table.find('.billing_region').parent().hide();
		wpsc_checkout_table.find('.shipping_region').parent().hide();
	} else {
		wpsc_checkout_table.find('input.billing_region').removeAttr('disabled');
		wpsc_checkout_table.find('input.shipping_region').removeAttr('disabled');
		wpsc_checkout_table.find('.billing_region').parent().show();
		wpsc_checkout_table.find('.shipping_region').parent().show();
	}
	var countrysel = jQuery('#wpsc_checkout_form_'+id);
	if( countrysel.children().size() < 2 ) {
		countrysel.hide().parent().prev().prev().hide();
	}
}

jQuery(function($) {
	$('#edit').change(function() {
		$('#billing,#shipping').toggle();
	});
	$('form.pform input.req').bind('blur.progo',checkThisField);
	$('form.pform select.req').bind('change.progo',checkThisField);
	$('form.pform').bind('submit',checkReq);
	$('.pform .current_country').trigger('change');
	
	var editchx = $('#side .editchecks input:checkbox');
	if(editchx.size() > 0) {
		editchx.click(function() {
			var check = $(this).attr('checked');
			var show = 'payment';
			if(check) {
				show = $(this).attr('name') == 'editbilling' ? 'billing' : 'shipping';
			}
			$('#'+show).show().siblings('fieldset').hide();
			$(this).parent().siblings('label').children('input:checkbox').attr('checked',false);
		});
	}
	
	if($('#features-flash').size() > 0) {
		$('#features-flash').prev().find('a').each(function(i) {
			$(this).click(function() {
				$(this).parent().addClass('ison').siblings('.ison').removeClass('ison');
				var pname = $(this).attr('href');
				pname = pname.substr(pname.lastIndexOf('#')+1);
				var flashvars = {};
				flashvars.productName = pname;
				var params = {};
				params.menu = "false";
				params.wmode = "transparent";
				var attributes = {};
				swfobject.embedSWF(jacuzzi_swfpath, "features-flash", "275", "330", "9.0.0", false, flashvars, params, attributes);
				return false;
			});
			if(i==0) {
				$(this).click();
			}
		});
	}
	
	Cufon.replace('#slogan, #bodycontent h2, #bodycontent h3, #arrow', {
		fontFamily: 'GillSans'
	});
	Cufon.replace('#toparr', {
		fontFamily: 'GillSans',
		color: '-linear-gradient(#ffd243, #e8b525'
	});
	Cufon.now();
	
	$('#requestform .txt:eq(0)').focus();
});