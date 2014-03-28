/*
 * jQuery for Comment Form Enhancements
 * */

jQuery(document).ready(function () {

	/* Checks if this is a link to reply directly to a comment */
	function is_replytocom() {
		var field = 'replytocom';
		var url = window.location.href;
		if(url.indexOf('?' + field + '=') != -1 || url.indexOf('&' + field + '=') != -1 )
			return true;
		else
			return false;
	}

	var identifier = window.location.hash;

	if (identifier === "#respond") {
		jQuery('#respond').show();
		jQuery('#share-comment-button-bottom').show();
		jQuery('.comment-form-reply-title').hide();

		if(is_replytocom()) { // If this is a link to reply directly to a comment
			jQuery('#commentform-top').hide();
			jQuery('#commentform-bottom').hide();
			jQuery('#share-comment-button').show();
		} else {  // Otherwise, load the normal comment reply form
			jQuery('#commentform-top').show();
			jQuery('#commentform-top').append(jQuery('#respond'));
			jQuery('#commentform-bottom').hide();
		}

	} else { // Set the default state (forms hidden, buttons showing)
		jQuery('#respond').hide();
		jQuery('#share-comment-button').show();
		jQuery('#share-comment-button-bottom').show();
		jQuery('#commentform-top').hide();
		jQuery('#commentform-bottom').hide();
	}

	/* Share Comment Button (Top) */

	jQuery( document ).on('click', '#share-comment-button', function (event) {
		jQuery('#commentform-top').show();
		jQuery('#commentform-bottom').hide();
		jQuery('#cancel-comment-reply-link').click();
		jQuery('#commentform-top').append(jQuery('#respond'));
		jQuery('#respond').show();
		jQuery('#share-comment-button').toggle('hide');
		jQuery('#share-comment-button-bottom').show();
		jQuery('.comment-form-reply-title').hide();
		jQuery('#main-reply-title').show();
		jQuery('#comment').focus();
		if(is_replytocom())
			jQuery('#reply-title').hide();
	});

	/* Share Comment Button (Bottom)*/

	jQuery( document ).on('click', '#share-comment-button-bottom', function (event) {
		jQuery('#commentform-bottom').show();
		jQuery('#commentform-top').hide();
		jQuery('#cancel-comment-reply-link').click();
		jQuery('#commentform-bottom').append(jQuery('#respond'));
		jQuery('#share-comment-button-bottom').toggle('hide');
		jQuery('#respond').show();
		jQuery('#share-comment-button').show();
		jQuery('.comment-form-reply-title').hide();
		jQuery('#main-reply-title').show();
		jQuery('#comment').focus();
		if(is_replytocom())
			jQuery('#reply-title').hide();
	});

	jQuery( document ).on('click', '.comment-reply-link', function (event) {
		jQuery('#respond').show();
		jQuery('#share-comment-button').show();
		jQuery('#share-comment-button-bottom').show();
		jQuery('.comment-form-reply-title').show();
		jQuery('#main-reply-title').hide();
		jQuery('#comment').focus();
		jQuery('#commentform-top').hide();
		jQuery('#commentform-bottom').hide();
		if(is_replytocom())
			jQuery('#reply-title').hide();
	});

	jQuery( document ).on('click', '#cancel-comment-reply-link', function (event) {
		jQuery('#respond').hide();
		jQuery('#share-comment-button').show();
		if(is_replytocom())
			jQuery('#reply-title').hide();
	});

});
