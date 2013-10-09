/**
 * Hides the site logo when not at top of page (for use with multi-author site)
 */
jQuery(window).scroll(function () {

	if (jQuery(this).scrollTop() > 0) {
		jQuery('.site-master-logo').fadeOut();
	}
	else {
		jQuery('.site-master-logo').fadeIn();
	}
});