/**
 * Fade the title on scroll if post has "Post Cover Title Style"
 */
jQuery(function($) {
    var post_title = $('.post-cover-title'),
        post_title_wrapper = $('.post-cover-title-wrapper');

    if($('body').hasClass('post-cover-overlay-post-title')) {
        $(window).on('scroll', function() {
            var st = $(this).scrollTop(),
                post_title_wrapper_height = post_title_wrapper.height(),
                post_title_height = post_title.height(),
                post_title_padding = ( post_title.innerHeight() - post_title_height) / 2;

            post_title.css({
                'margin-bottom' : -(st/post_title_wrapper_height) * post_title_padding +"px",
                'opacity' : 1 - st/post_title_wrapper_height
            });
        });
    }
});