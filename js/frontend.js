// frontend.js
var jht_slideseconds = 6, jht_cycler, jht_hscount, jht_hsload;
var s;

function proGoTwitterCallback(twitters) {
  for (var i=0; i<twitters.length; i++){
    var status = twitters[i].text.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
      return '<a href="'+url+'">'+url+'</a>';
    }).replace(/\B@([_a-z0-9]+)/ig, function(reply) {
      return  reply.charAt(0)+'<a href="http://twitter.com/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
    });
    jQuery('.tweets p').html(status+'<br /><span class="by"><a href="http://twitter.com/'+twitters[i].user.screen_name+'/status/'+twitters[i].id_str+'" target="_blank">'+relative_time(twitters[i].created_at)+'</a> via '+ twitters[i].source +'</span>');
  }
}

function relative_time(time_value) {
  var values = time_value.split(" ");
  time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
  var parsed_date = Date.parse(time_value);
  var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
  var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
  delta = delta + (relative_to.getTimezoneOffset() * 60);

  if (delta < 60) {
    return 'less than a minute ago';
  } else if(delta < 120) {
    return 'about a minute ago';
  } else if(delta < (60*60)) {
    return (parseInt(delta / 60)).toString() + ' minutes ago';
  } else if(delta < (120*60)) {
    return 'about an hour ago';
  } else if(delta < (24*60*60)) {
    return 'about ' + (parseInt(delta / 3600)).toString() + ' hours ago';
  } else if(delta < (48*60*60)) {
    return '1 day ago';
  } else {
    return (parseInt(delta / 86400)).toString() + ' days ago';
  }
}

function jht_nextslide() {
	var onn = jQuery('.hero .controls li.current');
	var nex = onn.next();
	if ( nex.size() < 1 ) nex = onn.parent().children('li:eq(0)');
	nex.click();
}

function hottubPopup() {	
	jQuery.cookie("hottubPagesLeft",null, {path: '/' });
	jQuery.cookie("hottubCountdown",null, {path: '/' });
	jQuery.cookie("hottubStamp",null, {path: '/' });
	jQuery.cookie("hottubPopped",true, {expires: 14, path: '/' });
	
	/*
	if ( jQuery('#TB_window').size() < 1 ) {
		tb_show(null,'/hot-tubs/wp-content/themes/jht/popup.html?TB_iframe=true&height=402&width=462',null);
	}
	*/
	if ( jQuery('#modal-box-ab').length > 0 ) {
		jQuery('#modal-box-ab').show();
	}
	return false;
}


function hottubPromoUp() {
	if(jQuery.cookie('hottubPromoDown')) return false;
	
	jQuery('#fbar a.prar').click();
}

function hottubCookie() {
	if( (jQuery.cookie('hottubPopped') ) || ( jQuery('body').is('.nopop, .fr, .wp-core-ui' ) ) ) return false;
	
	var msLeft = 180000;
	var pagesLeft = 9;
	if(jQuery.cookie("hottubPagesLeft") && jQuery.cookie("hottubCountdown") && jQuery.cookie("hottubStamp")) {
		pagesLeft = jQuery.cookie("hottubPagesLeft");
		msLeft = jQuery.cookie("hottubCountdown");
		pagesLeft--;
		jQuery.cookie("hottubPagesLeft",pagesLeft, {path: '/' });
	} else {
		var now = new Date();
		now = now.getTime();
		jQuery.cookie("hottubPagesLeft",pagesLeft, {path: '/' });
		jQuery.cookie("hottubCountdown",msLeft, {path: '/' });
		jQuery.cookie("hottubStamp",now, {path: '/' });
	}
	
	if(pagesLeft == 0) hottubPopup();
	setTimeout(hottubPopup,msLeft);
	
	jQuery(window).unload(function() {
		var now = new Date();
		now = now.getTime();
		var startStamp = jQuery.cookie("hottubStamp");
		var msDiff = now - startStamp;
		var msLeft = jQuery.cookie("hottubCountdown");
		msLeft -= msDiff;
		jQuery.cookie("hottubCountdown",msLeft, {path: '/' });
	});
}

function jht_tpopit() {	
	jQuery.cookie("hottubTPop",true, {expires: 7, path: '/' });
	
	if ( jQuery('#TB_window').size() < 1 ) {
		tb_show(null,'/hot-tubs/dealer-locator/dealer_ip/get_dealer.php?popped=true&TB_iframe=true&height=229&width=531',null);
	}
	return false;
}

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

function jht_dslide() {
	var onn = jQuery('.dslides .onn');
	var nex = onn.next();
	if ( nex.size() == 0 ) {
		nex = onn.parent().children(':first-child');
	}
	nex.css('z-index', 2).addClass('nex');
	onn.css('z-index', 3).fadeOut(600, function() {
		jQuery(this).removeClass('onn').siblings('.nex').removeClass('nex').addClass('onn').css('z-index',3);
		jQuery(this).css('z-index',1).show();
		jht_cycler = setTimeout(jht_dslide, jht_slideseconds * 1000);
	});
}

function jht_showHideMail() {
	var n = jQuery(".mailCheck:gt(0):checked").length;
	if(n > 0){
		jQuery('.mailer').css('display','');
		jQuery('.mailer input:text').addClass('required').bind('blur', function() {
			var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
			if( (jQuery(this).val() == '') || ( (jQuery(this).attr('id') == 'person_email') && (emailPattern.test(jQuery(this).val()) == false) ) ) {
				jQuery(this).addClass('err');
			} else {
				jQuery(this).removeClass('err');
			}
		});
		jQuery('.mailer select').addClass('required').bind('change', function() {
			if(jQuery(this).val() == '' || jQuery(this).val() == '  ') {
				jQuery(this).addClass('err');
			} else {
				jQuery(this).removeClass('err');
			}
		});
	}else{
		jQuery('.mailer').css('display','none');
		jQuery('.mailer input').removeClass('err');
		jQuery('.mailer select').removeClass('err');
		jQuery('.mailer input').removeClass('required').unbind('blur');
		jQuery('.mailer select').removeClass('required').unbind('change');
	}
}


jQuery(function($) {
	$('.searchform input:eq(0)').focus(function() {
		if ( $(this).val() == 'search' ) $(this).val('');
	}).blur(function() {
		if ( $(this).val() == '' ) $(this).val('search');
	}).trigger('blur');
	
	if ( $('#tubtabs').size() > 0 ) {
		$('#tubtabs a').click(function() {
			if ( $(this).parent().hasClass('current') == false ) {
				var tar = $(this).attr('href');
				$(tar).show().siblings().hide();
				$(this).parent().addClass('current').siblings('.current').removeClass();
			}
			return false;
		});
	}

	/*var hash = location.hash.replace("#","");
	if ( $('#tubtabs').size() > 0 && hash == 'jets') {
		$('#jets').show().siblings().hide();
		$('#jets').parent().addClass('current').siblings('.current').removeClass();
		return false;
	}*/
	
	if ( $('body').hasClass('home') && ( $('.hero .slide').size() > 0 ) ) {
		var chtm = '<div class="controls" style="display:none"><ul>';
		var hslides = $('.hero .slide');
		jht_hscount = hslides.size();
		jht_hsload = 1;
		hslides.each(function(i) {
			chtm += '<li' + (i==0 ? ' class="current"' : '') + '></li>';
			if ( i > 0 ) {
				// load bg images
				slidebg = $(this).children('.slidebg').hide();
				bgsrc = slidebg.attr('href');
				slidebg.append('<img src="'+bgsrc+'" alt="" />').children('img').bind('load',function() {
					jht_hsload++;
					bgurl = 'url(' + $(this).attr('src') + ')';
					thisslide = $(this).parent().parent();
					thisslide.css('background-image',bgurl);
					$(this).parent().remove();
					if ( jht_hsload == jht_hscount ) {
						// THEN start cycle countdown
						thisslide.siblings('.controls').fadeIn();
						jht_cycler = setTimeout(jht_nextslide,jht_slideseconds *1000);
					}
				});
			}
		});
		
		chtm += '</ul></div>';
		$('.hero').css({height:501,overflow:'hidden'}).append(chtm).find('.controls li').each(function(i) {
			$(this).click(function() {
				if ( $(this).hasClass('current') == false ) {
					clearTimeout(jht_cycler);
					$(this).addClass('current').siblings('.current').removeClass();
					var onn = $(this).parent().parent().parent().children('.slide:visible');
					var nex = $(this).parent().parent().parent().children('.slide:eq('+i+')');
					onn.css({position:'absolute',top:0,left:0, 'z-index':2});
					nex.css({position:'absolute',top:0,left:0,'z-index':3}).fadeIn(600,function() {
						onn.hide();
					});
					jht_cycler = setTimeout(jht_nextslide,jht_slideseconds * 1000);
				}
				return false;
			});
		});
	}
	
	if ( $('body').hasClass('showcase') ) {
		if ( $('#gform_1').size() > 0 ) {
			// hide image fields?
			$('#gform_1 .gfield:gt(5)').hide().children('label').hide();
			var $input = $('#gform_1 input[type=file]');

			var jht_revealnextfilefield = function() {
				$('#gform_1 .gfield:hidden').eq(0).show();
			};
			
			if ($.browser.msie) {
				// IE suspends timeouts until after the file dialog closes
				$input.click(function() {
					setTimeout(function() {
						jht_revealnextfilefield();
					}, 0);
				});
			}
			else { // All other browsers behave
				$input.change(jht_revealnextfilefield);
			}
		} else { // SHOWCASE DETAILS page
			$('#mthms a').each(function(i) {
				$(this).click(function() {
					if ($(this).parent().hasClass('onn') == false ) {
						$(this).parent().addClass('onn').siblings('.onn').removeClass('onn');
						$('#mainimg img:eq('+i+')').show().siblings().hide();
					}
					return false;
				});
			});
			$('.showcases .icon, .sthms li:gt(6)').hide();
			/* only 7 for now... TBD
			if ( $('.sthms li').size() > 4 ) {
				$('.sthms li:gt(3)').hide();
				
			} else {
				$('.showcases .icon').hide();
			}
			*/
		}
	}
	
	// footer resources expand/collapse
	if ( $('#resourceMenu').size() > 0 ) {
		$('#menu-footer-line-1 > li.fres > a').click(function() {
			$('#resourceMenu').slideToggle();
			return false;
		});
	}

	// footer show dealers list on locate dealer page
	/*
	$('#FooterMenu-DealerLocations').click( function( e ){
		if ( $('div.additionalinfo').length > 0 ) {
			e.preventDefault();
			$('div.additionalinfo').show('slow');
		}
	});
	*/
	
	if ( $('#moreinfo').size() > 0 ) {
		$('#moreinfo').prev().children('a').click(function() {
			$(this).toggleClass('open').children('.plus').html( $(this).hasClass('open') ? '&ndash;' : '+' );
			$('#moreinfo').slideToggle();
			return false;
		});
	}
	
	if ( $('body').hasClass('video-showcase') ) {
		var icons = {
			header: "off",
			headerSelected: "on"
		};
		$( "#accord" ).accordion({
			icons: icons,
			fillSpace: true 
		});
		
		$('.video-list a').click(function() {
			if ( $(this).hasClass('on') == false ) {
				var e = $(this).children('.e').html();
				e += '?autoplay=1&showinfo=0&rel=0&autohide=1&wmode=opaque';
				$('#mainplayer').attr('src',e);
				$('.video-list a.onn').removeClass('onn');
				$(this).addClass('onn');
			}
			return false;
		});
	}
	
	$('#tnav > li.parent').bind({
		mouseenter: function() {
			$(this).addClass('hover');
		},
		mouseleave: function() {
			$(this).removeClass('hover');
		}
	}).filter('.first').children('ul').children('li').bind('mouseenter', function() {
		if ( $(this).hasClass('loaded') == false ) {
			$(this).find('.prel').each(function() {
				rsrc = $(this).attr('title');
				if ( $(this).hasClass('rollover') ) {
					ralt = $(this).children('span').html();
					$(this).prepend('<img src="'+rsrc+'" alt="'+ ralt +'" />');
				} else if ( $(this).hasClass('image') ) {
					rcss = 'url('+ rsrc +') center no-repeat';
					$(this).css('background', rcss);
				} else if ( $(this).hasClass('thm') ) {
					$(this).removeAttr('class').append('<img src="'+rsrc+'" alt="" />');
				}
				$(this).removeAttr('title').removeClass('prel');
			});
			$(this).addClass('loaded');
		}
	});
	
	// tpop
	if(jQuery.cookie('hottubTPop')) {
		//nada
	} else {
		if ( $('#tpop').size() > 0 ) { // dealer-loc already included inline on page
			jht_tpopit();
		} else {
			// otherwise, $.load it
			$('#fbar').after('<div style="display:none" id="salecatch" />').next().load('/hot-tubs/dealer-locator/dealer_ip/get_dealer.php', function() {
				if ( $("#tpop").size() > 0 ) {
					jht_tpopit();
				}
			});
		}
	}
	
	if ( $('#fbar .promo').size() > 0 ) {
		$('#fbar .promo').children().hide();
		$('#fbar a.prar').click(function() {
			jQuery.cookie("hottubPromoDown",true, {expires: 14, path: '/' });
			$(this).next().slideToggle(400, function() {
				if ( $(this).prev().hasClass('u') ) {
					$(this).children().fadeIn();
				} else {
					$(this).children().hide();
				}
			});
			$(this).toggleClass('u');
			return false;
		});
		$('#fbar .promo a.x').click(function() {
			$(this).parent().prev().click();
			return false;
		});
		
		setTimeout('hottubPromoUp()',15000);
	} else {
		$('#fbar a.prar').click(function() {
			return false;
		});
	}
	
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
	
	$('.mailCheck').click(jht_showHideMail);
	
	if ( $('body').hasClass('dir') ) {
		$('#vthms a').click(function() {
			var ur = $(this).attr('href') + '?autoplay=1&autohide=0&rel=0&showinfo=0';
			$('#vplayer iframe').attr('src',ur);
			return false;
		});
	} else {
		hottubCookie();
	}
	
	if ( $('#land #page-header').size() > 0 && $('#land #page-header .ab-b').size() < 1 ) { // new1
		$('.hd').addClass('fxd').children('.wrap').append('<a href="#download" id="hdbtn" class="btn dl">Free Brochure</a>');
		/*
		$(window).bind('scroll', function() {
			var jhtwt = $(window).scrollTop();
			if ( jhtwt > 539 ) {
				$('#hdbtn').show();
			} else {
				$('#hdbtn').hide();
			}
		});
		*/
		$("#land a[href^='#download']").click(function() {
			$(window).scrollTop(460);
			return false;
		});
	}

	$(".brochure.form a#to-download-form").click(function() {
			$("html, body").animate({
				scrollTop: "480px"
			});
			$("#person_first_name").focus();
			return false;
		});

	// add ID's to menu links
	/*
	 *	This function will iterate over .primaryMenu and add/update ID's by concatenating previous level <a> ID... for example:
	 *		..... MainMenu-HotTubs-6People-J49590x110x41J495
	 *		or... 
	 *
	 */
	if ( $('body').find('ul.primaryMenu').length == 1 ) {
		$('.primaryMenu li').find('a').each(function () {
		    var nameCurrent = $(this).text().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '');
		    if ($(this).parents('ul').length == 1) {
		        nameCurrent = 'PrimaryMenu-' + nameCurrent;
		    }
		    else {
		        var namePrev = $(this).closest('ul').closest('li').children('a:first').attr('id');
		        if (typeof namePrev == 'undefined') { 
		            namePrev = $(this).closest('ul').closest('li').closest('ul').closest('li').children('a:first').attr('id');
		            if (typeof namePrev == 'undefined') {
		                namePrev = $(this).closest('ul').closest('li').closest('ul').closest('li').closest('ul').closest('li').children('a:first').attr('id');
		            }
		        }
		        nameCurrent = namePrev + '-' + nameCurrent;
		    }
		    if ( $(this).attr('id') == '' || !$(this).attr('id') ) {
		    	$(this).attr('id', nameCurrent);
		    }
		});
	}
	if ( $('body').find('ul.topMenu').length == 1 ) {
		$('.topMenu').find('a').each(function () {
		    var nameCurrent = $(this).text().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '');
		    nameCurrent = 'TopMenu-' + nameCurrent;
		    if ( $(this).attr('id') == '' || !$(this).attr('id') ) {
		    	$(this).attr('id', nameCurrent);
		    }
		});
	}
	if ( $('body').find('div.ft').length == 1 ) {
		$('.ft').find('a').each(function () {
		    var nameCurrent = $(this).text().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '');
		    nameCurrent = 'FooterMenu-' + nameCurrent;
		    if ( $(this).attr('id') == '' || !$(this).attr('id') ) {
		    	$(this).attr('id', nameCurrent);
		    }
		});
	}
	if ( $('body').find('div#fbar').length == 1 ) {
		$('#fbar').find('a').each(function () {
		    var nameCurrent = $(this).text().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '');
		    nameCurrent = 'FBarMenu-' + nameCurrent;
		    if ( $(this).attr('id') == '' || !$(this).attr('id') ) {
		    	$(this).attr('id', nameCurrent);
		    }
		});
	}
	if ( $('body').find('ul.silverMenu').length == 1 ) {
		$('.silverMenu').find('a').each(function () {
		    var nameCurrent = $(this).text().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '');
		    nameCurrent = 'SilverMenu-' + nameCurrent;
		    if ( $(this).attr('id') == '' || !$(this).attr('id') ) {
		    	$(this).attr('id', nameCurrent);
		    }
		});
	}
	$('body').find('a').each(function() {
		var thisText = $(this).text().replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '');
		if ( $(this).attr('id') == '' || !$(this).attr('id') ) {
		    $(this).attr( 'id', thisText );
		}
	})


});

// Avala Lead Form validation
jQuery(function($) {
	var invalidInputs = ["www", "http"];
    var states = null;
    var emailAddress = 'email';         // class for email address fields
    var phoneNumber = 'phonenumber';   // class for phone number fields
    var required = 'required';          // class for required fields
    var error = 'err';                  // class for displaying errors
    var success = 'validated';			// successful/validated entries

    // two-part form stuff
    $('form#leadForm input[rel="ShowNext"]').click( function(){
    	$('form#leadForm').blur();
    	var cancel = false;
        $("." + required).each(function () {
            if ($(this).val() === "" || $(this).hasClass(error) ) {
                $(this).addClass(error);
                if (!cancel) {
                    cancel = true;
                    $(this).focus();
                }
            }
        });
        if (cancel) {
        	e.preventDefault();
        } else {
			$('body').append('<div class="overlay" id="formpage-overlay"></div>');
			$('div#formpage-overlay').fadeIn('fast', function() {
				$('.form-page-two').fadeIn('slow');
			});
		}
    });
    $("form#leadForm .survey-no").click( function(){
    	$("form#leadForm").submit();
    });


    $("form#leadForm").submit(function(e) {
        var cancel = false;
        $("form#leadForm ." + required).each(function () {
            if ($(this).val() === "" || $(this).val() === 'XX') {
                $(this).addClass(error);
                if (!cancel) {
                    cancel = true;
                    $(this).focus();
                }
            }
        });
        if (cancel) {
        	e.preventDefault();
        } else {
        	$('form#leadForm input[type=submit]').attr('disabled', 'disabled');
        	$('form .form-page-two').fadeOut('slow');
        }
    });
    //download form auto start file download
    $("form#downloadForm").submit(function(e) {
        var cancel = false,
        	theDownload = $('form#downloadForm input[type="submit"]').attr('download');
        $("." + required).each(function () {
            if ($(this).val() === "" || $(this).val() === 'XX') {
                $(this).addClass(error);
                if (!cancel) {
                    cancel = true;
                    $(this).focus();
                }
            }
        });
        if (cancel) {
        	e.preventDefault();
        } else {
        	$('form#downloadForm input[type=submit]').attr('disabled', 'disabled').val('Thank You');
        	window.open( theDownload, "_blank", "width=720, height=600, menubar=no, toolbar=no");
        }
    });
    // Required field and email validation
    $("form ." + required).bind('blur keyup', function(e) {
    	if (e.keyCode != 9) {
	        var a = $(this).val();
	        var filter = new RegExp("\\b[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,4}\\b");
	        
	        $(this).removeClass(success);
	        
	        if ( a === "" || a === 'XX' )
	        {
	            $(this).addClass(error);
	            return;
	        }
	        
	        if ( $(this).hasClass(emailAddress) )
	        {
	            if ( !filter.test(a) )
	            {
	                $(this).addClass(error);
	                return;
	            }
	        }
	        
	        $(this).removeClass(error).addClass(success);
	    }
    });
    // Block invalid inputs
    $("form input[type=text]").bind('blur keyup', function() {
        var n = invalidInputs.length;
        for (var i = 0; i < n; i++) {
            if ($(this).val().toLowerCase().indexOf(invalidInputs[i]) > -1) {
                $(this).addClass(error);
                return false;
            }
        }
    });
    // Phone Number fields
    $("form ." + phoneNumber).keydown(function (event) {
        if (event.keyCode == 32 || event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
        event.keyCode == 190 || event.keyCode == 110 || 
        (event.keyCode == 189 && event.shiftKey === false) ||
        (event.keyCode == 65 && event.ctrlKey === true) ||
        (event.keyCode >= 35 && event.keyCode <= 39) ||
        (event.keyCode == 48 && event.shiftKey === true) ||
        (event.keyCode == 57 && event.shiftKey === true) ) {
            return;
        }
        else {
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)) {
                event.preventDefault();
            }
        }
    });
    // Select state/country fields
    if ( ("select.state").length > 0 ) {
	    $("select.state").change(function (e) {            
	        $("select.country").val($(this).find("option:selected").attr("data-country"));
	    });
	    $(".country").change(function (e) {
	        var country = $(this).val();
	        $("select.state option").remove();
	        if (country == "0") {
	            states.find("option").clone().appendTo("select.state");
	        } else {
	            states.find("[data-country=" + country + "]").clone().appendTo("select.state");
	        }
	    });
	    states = $("select.state").clone();
	}

	if ( $.isFunction($.fn.placeholder) ) {
    	$('input, textarea').placeholder(); // placeholder replacement text fix for old IE
	}

});

// Owners Corner stuff
jQuery(document).ready( function($) {
	$('.oc #ReceiveSavings').click( function() {
		$('.sign-up').addClass('active'); 
	});
	$('.oc #CLOSEX').click( function() {
		$('.sign-up').removeClass('active'); 
	});

	$('.splitrow4 div[href]').each(function() {
		var gotoit = $(this).attr('href');
		$(this).click(function(){
			window.location.href = gotoit;
		});
	});
});


// create video modal
jQuery(function($){
	$('div[goto="vidmodal"]').click(function(){
		var theVid = $(this).attr('rel');
		$('body').append('<div id="modaloverlay" class="black-out"><div id="vidmodal" class="video dialog big"><div class="thevid"><a id="x" href="#"></a><iframe width="640" height="480" src="' + theVid + '" frameborder="0" allowfullscreen></iframe></div></div></div>');
		$('div#vidmodal').fadeIn('slow');
	});
});


//destroy video modal
jQuery(function($){
	$('body').on('click', 'div#vidmodal a#x', function(){
		$('#modaloverlay').css('display', 'none').remove();
	});
});

// jQuery UI tooltips automation
jQuery(function($) {
	$('li.has-img-tooltip').each(function(){
		var tip = $('.tooltip-img', this).html();;
		$(this).tooltip({
			content: tip
		});
	});
});


//dynamic tub display on get pricing page
(function($){
	$('#custom_data_ProductIdList').on('change', function(){
		var img = $('option:selected', this).attr('img');
		var title = $('option:selected', this).attr('title');
		if (title) {
			$('div.side p').text(title);
		} else {
			$('div.side p').text('');
		}
		if (img) {
			$('div.side img').attr('src', img);
		} else {
			$('div.side img').attr('src', '/hot-tubs/wp-content/themes/jht/images/quote/RequestQuoteDefaultTubs.png');
		}
	});
})(jQuery);



(function($){
	$('#show-msrp').click(function(){
		if ( $(this).hasClass('close') ) { 
		    $('.container.msrp').hide(); 
		    $(this).removeClass('close').text('View MSRP'); 
		} else { 
		    $('.container.msrp').show(); 
		    $(this).addClass('close').text('Close'); 
		}
	});
})(jQuery);




/* GeoLocation with Google */
function getLocation() {
    	if (navigator.geolocation) {
	        navigator.geolocation.getCurrentPosition( function(position) {
	        	var theUrl = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+position.coords.latitude+','+position.coords.longitude+'&key=AIzaSyCpr2dLs45lmXetGPQRVtfd0CDkyKOjUhg';

	        	$.getJSON(theUrl, function(data) {
    				console.log(data); //data is the JSON string
				});

				var xmlHttp;
				if (window.XMLHttpRequest)
				{// code for IE7+, Firefox, Chrome, Opera, Safari
					xmlHttp=new XMLHttpRequest();
				}
				else
				{// code for IE6, IE5
					xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlHttp.open( "GET", theUrl, false );
				xmlHttp.send();
				
				var r = xmlHttp.responseXML;
				var s = JSON.stringify(r);
				jQuery.cookie('geoloc', s, { expires: 30, path: '/' });

				console.log(theUrl);
				console.log(r);
	        });
	    }
}


function codeLatLng() {
	var geocoder = new google.maps.Geocoder();

	if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition( function(position) {
        	var latlng = new google.maps.LatLng( position.coords.latitude, position.coords.longitude );
        	geocoder.geocode( {'location': latlng}, function(results, status) {
        		//console.log(results);
        		var zip = false;
        		var addy = results[0].address_components;
        		for (var i = 0; i < addy.length; i++) {
        			//console.log(addy[i]);
        			if( addy[i].types[0] == 'postal_code' ){
        				zip = addy[i].long_name;
        			}
        		};
        		//console.log(zip);
        		if(zip){
        			jQuery.cookie('geoz', zip, { expires: 30, path: '/' });
        		}
        	});
		});
	}
}


codeLatLng();

