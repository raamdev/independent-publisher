/*
 * jQuery for Comment Form Enhancements
 * */

 jQuery(document).ready(function(){

	jQuery('#respond').hide();
	jQuery('#share-comment-button').show();

	jQuery('#share-comment-button').live('click', function(event) {
		jQuery('#respond').toggle('show');
		jQuery('#share-comment-button').toggle('hide');
	});

	jQuery('.comment-reply-link').live('click', function(event) {
		jQuery('#respond').show();
		jQuery('#share-comment-button').hide();
	});

	jQuery('#cancel-comment-reply-link').live('click', function(event) {
		jQuery('#respond').hide();
		jQuery('#share-comment-button').show();
	});
});
