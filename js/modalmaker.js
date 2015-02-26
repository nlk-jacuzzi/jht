/* Modal maker javascript */

/*
	Usage:

	Create an element with class="open-modal" and rel="your-content-id"

	Create your content in a containing div with id="your-content-id"

	Script will automatically hide your content on page load

	Clicking .open-modal will append a transparent overlay, and move the modal content inside the overlay

	Clicking outside the content will close the modal

*/


jQuery(function($) {

	// hides all modal sub-content on page load
	$('.open-modal').each( function() {
		var modalContentId = $(this).attr('rel');
		$('#' + modalContentId).addClass('hiddenModal');
	});
	// creates overlay and copies content inside, centers
	$('.open-modal').click( function() {
		$('body').append('<div class="black-out">');
		var importModalContentId = $(this).attr('rel');
		$('#' + importModalContentId).clone().appendTo('.black-out').addClass('shownModal').removeClass('hiddenModal');
		$('#' + importModalContentId + '.shownModal').append('<div class="close-modal"></div>');
		var wl		= $('#' + importModalContentId).width() / 2,
			wt		= $('#' + importModalContentId).height() / 2,
			ww		= $( window ).width() / 2,
			wh		= $( window ).height() / 2,
			left	= ww - wl,
			top		= wh - wt;
		$('#' + importModalContentId + '.shownModal').css('margin-left', left + 'px').css('margin-top', top + 'px');
		$('div.black-out').fadeIn();
	});
	// destroys modal content on click outside of content
	$(document).on( 'click', '.close-modal', function() {
		$('div.black-out').fadeOut().remove();
	});

});