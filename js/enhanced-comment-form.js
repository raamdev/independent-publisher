/*
 * jQuery for Comment Form Enhancements
 * */

jQuery(document).ready(function () {

	var identifier = window.location.hash;

	if (identifier === "#respond") {
		jQuery('#cancel-comment-reply-link').click();
		jQuery('#commentform-top').append(jQuery('#respond'));
		jQuery('#respond').show();
		jQuery('#share-comment-button').hide();
		jQuery('#share-comment-button-bottom').show();
		jQuery('.comment-form-reply-title').hide();
		jQuery('#main-reply-title').show();
		jQuery('#comment').focus();
	} else {
		jQuery('#respond').hide();
		jQuery('#share-comment-button').show();
		jQuery('#share-comment-button-bottom').show();
	}

	/* Share Comment Button (Top) */

	jQuery('#share-comment-button').live('click', function (event) {
		jQuery('#cancel-comment-reply-link').click();
		jQuery('#commentform-top').append(jQuery('#respond'));
		jQuery('#respond').show();
		jQuery('#share-comment-button').toggle('hide');
		jQuery('#share-comment-button-bottom').show();
		jQuery('.comment-form-reply-title').hide();
		jQuery('#main-reply-title').show();
		jQuery('#comment').focus();
	});

	/* Share Comment Button (Bottom)*/

	jQuery('#share-comment-button-bottom').live('click', function (event) {
		jQuery('#cancel-comment-reply-link').click();
		jQuery('#commentform-bottom').append(jQuery('#respond'));
		jQuery('#share-comment-button-bottom').toggle('hide');
		jQuery('#respond').show();
		jQuery('#share-comment-button').show();
		jQuery('.comment-form-reply-title').hide();
		jQuery('#main-reply-title').show();
		jQuery('#comment').focus();
	});

	jQuery('.comment-reply-link').live('click', function (event) {
		jQuery('#respond').show();
		jQuery('#share-comment-button').show();
		jQuery('#share-comment-button-bottom').show();
		jQuery('.comment-form-reply-title').show();
		jQuery('#main-reply-title').hide();
		jQuery('#comment').focus();
	});

	jQuery('#cancel-comment-reply-link').live('click', function (event) {
		jQuery('#respond').hide();
		jQuery('#share-comment-button').show();
	});

});
