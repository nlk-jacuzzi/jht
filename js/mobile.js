function jht_checkreq() {
	var aok = true, fm = jQuery('#requestform');
	fm.find('input.required').trigger('blur');
	fm.find('select.required').trigger('change');
	var bad = fm.find('.err');
	if(bad.size() > 0) {
		aok = false;
		bad.eq(0).focus();
		alert('Please check all Required (*) fields.');
	}
	// check phonecatch
	jQuery('#phonecatch').each(function() {
		var v = jQuery(this).val();
		if ( v != '' ) {
			jQuery('#person_phone').val(v);
		}
	});
	return aok;
}

jQuery(function($) {
	$('a.watch').click(function() {
		$(this).next().slideToggle(200);
		return false;
	});
	$('a.ar').click(function() {
		$(this).toggleClass('down').next().slideToggle(200);//.find('input.text:first').focus();
		return false;
	});
	
	var rfm = $('#requestform');
	if(rfm.size() > 0) {
		rfm.bind('submit',function() {
			return jht_checkreq();
		});
		var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
		rfm.find('input.required').bind('blur', function() {
			if( ($(this).val() == '') || ( ($(this).attr('id') == 'person_email') && (emailPattern.test($(this).val()) == false) ) ) {
				$(this).addClass('err');
			} else {
				$(this).removeClass('err');
			}
		});
		rfm.find('select.required').bind('change', function() {
			if($(this).val() == '' || $(this).val() == '  ') {
				$(this).addClass('err');
			} else {
				$(this).removeClass('err');
			}
		});
	}
});