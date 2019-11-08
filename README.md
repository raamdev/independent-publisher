![screenshot](https://cloud.githubusercontent.com/assets/53005/3689770/d0d6eb0e-1342-11e4-901d-392ed565905f.png)

Independent Publisher
=====================

Independent Publisher is a WordPress Theme. This README contains documentation for theme options and features, along with a list of known issues and frequently asked questions. It also contains a list of theme filters and action hooks that can be used to modify and hook into various areas of the theme, as well as a list of functions that can be overidden in a Child Theme.

 The main site for this project, along with a demo of this theme, is located at [http://independentpublisher.me](http://independentpublisher.me).
 
**Note:** There are two versions of this theme: the primary version, which is being developed _here_ on GitHub, is also on [WordPress.org](https://wordpress.org/themes/independent-publisher/), and the secondary (forked) version is on [WordPress.com](https://wordpress.com/themes/independent-publisher). 

WordPress.com took the original Independent Publisher theme from WordPress.org and changed it a bit to make it work on WordPress.com. I have no control over the WordPress.com version, as that's a closed-system, so if you have issues with that version, please post your support related questions [there](https://en.support.wordpress.com/). You can read more about the WordPress.com [version here](http://independentpublisher.me/2015/independent-publisher-announced-on-wordpress-com/).

## Table of Contents

* [Theme Options](https://github.com/raamdev/independent-publisher#theme-options)
* [Post Covers (Full-Width Featured Images)](https://github.com/raamdev/independent-publisher#post-covers-full-width-featured-images)
* [Post Subtitles](https://github.com/raamdev/independent-publisher#post-subtitles)
* [Using a Child Theme to Customize Independent Publisher](https://github.com/raamdev/independent-publisher#using-a-child-theme-to-customize-independent-publisher)
* [Known Issues](https://github.com/raamdev/independent-publisher#known-issues)
* [Frequently Asked Questions](https://github.com/raamdev/independent-publisher#frequently-asked-questions)
    * [Why is my Header Image not showing on Single posts?](https://github.com/raamdev/independent-publisher#why-is-my-header-image-not-showing-on-single-posts)
    * [How do I get the small logo to show up in the top-left corner?](https://github.com/raamdev/independent-publisher#how-do-i-get-the-small-logo-to-show-up-in-the-top-left-corner)
    * [Why is my Author Bio and picture at the top of my home page (or below a blog post) and not on the side?](https://github.com/raamdev/independent-publisher#why-is-my-author-bio-and-picture-at-the-top-of-my-home-page-or-below-a-blog-post-and-not-on-the-side)
    * [How do I add Social Media Buttons below the Logo?](https://github.com/raamdev/independent-publisher#how-do-i-add-social-media-buttons-below-the-logo)
    * [How do I make the Subscribe to Comments Reloaded Advanced Options look better?](https://github.com/raamdev/independent-publisher#how-do-i-make-the-subscribe-to-comments-reloaded-advanced-options-look-better)
    * [How do I make MailChimp Signup Forms look better?](https://github.com/raamdev/independent-publisher#how-do-i-make-mailchimp-signup-forms-look-better)
    * [How do I add an Archive Page?](https://github.com/raamdev/independent-publisher#how-do-i-add-an-archive-page)
    * [How do I show a menu on the Single Post pages?](https://github.com/raamdev/independent-publisher#how-do-i-show-a-menu-on-the-single-post-pages)
    * [How do I change the footer credits?](https://github.com/raamdev/independent-publisher#how-do-i-change-the-footer-credits)
    * [How do I add my own Social Icons to the Social Menu?](https://github.com/raamdev/independent-publisher#how-do-i-add-my-own-social-icons-to-the-social-menu)
    * [How can I enable "Single-Column Layout" on only the home page?](https://github.com/raamdev/independent-publisher#how-can-i-enable-single-column-layout-on-only-the-home-page)
    * [Why is the Navigation Menu and/or Widgets not Appearing on Single Post Pages?](https://github.com/raamdev/independent-publisher#why-is-the-navigation-menu-andor-widgets-not-appearing-on-single-post-pages)
    * [How can I obfuscate my email address in the Social Menu?](https://github.com/raamdev/independent-publisher/#how-can-i-obfuscate-my-email-address-in-the-social-menu)
    * [How can I use a Full Size Image for the Post Cover?](https://github.com/raamdev/independent-publisher/#how-can-i-use-a-full-size-image-for-the-post-cover)
    * [How can I use the Full Size Image for Featured Images?](https://github.com/raamdev/independent-publisher/#how-can-i-use-a-full-size-image-for-featured-images)
* [Color Schemes](https://github.com/raamdev/independent-publisher#color-schemes)
* [Theme Filters and Actions](https://github.com/raamdev/independent-publisher#theme-filters-and-actions)
* [Functions you can Override in a Child Theme](https://github.com/raamdev/independent-publisher#functions-you-can-override-in-a-child-theme)

## Theme Options

Theme Options can be found in `Dashboard → Appearance → Customize`.

### Colors

![screen shot 2014-01-24 at 7 28 45 pm](https://f.cloud.github.com/assets/53005/2000340/b0fbe268-8557-11e3-9579-ca95e3f07ee8.png)

The following colors can be changed via the Colors section:

- Text Color
- Background Color
- Link Color
- Title and Header Text Color
- Primary Meta Text Color
- Secondary Meta Text Color


### Layout Options

![screen shot 2014-02-11 at 7 19 46 pm](https://f.cloud.github.com/assets/53005/2143949/6c319bdc-937b-11e3-8e03-9af57e672ac8.png)

- **Single-Column Layout**. Disabled by default. This option allows you to force the site layout to a single-column, regardless of the browser width.

### Excerpt Options

![screen shot 2014-02-11 at 7 14 43 pm](https://f.cloud.github.com/assets/53005/2143914/c9a14fd4-937a-11e3-9a95-ff023ebf120f.png)

- **Post Excerpts**. Disabled by default. If you enable Post Excerpts the post excerpt will be shown on Blog, Archive, and Search pages instead of the full post content. If no excerpt is set, one is generated using the first 55 words (see [`the_excerpt()`](http://codex.wordpress.org/Function_Reference/the_excerpt)). This setting only applies to Standard and Chat post formats.
- **Generate One-Sentence Excerpts**. Disabled by default. When this option is enabled, a one-sentence excerpt will be generated for all posts that don't have an excerpt set. A "Continue Reading →" link is also placed below the generated excerpt. This setting only applies to Standard post formats and is only relevant when Post Excerpts are enabled.
- **Always Show Full Content for First Post**. When Post Excerpts are enabled, this option ensures that the very first post on the home page (or Posts Page, if different) shows the full post content instead of the excerpt.

### General Options

![screen shot 2014-04-23 at 4 30 50 pm](https://cloud.githubusercontent.com/assets/53005/2782883/40146740-cb26-11e3-9c54-80301a57e3ac.png)

- **Show Widgets on Single Posts**. Disabled by default. When this option is enabled, sidebar widgets will also be shown on Single Post pages.
- **Show Post Date in Entry Meta**. Disabled by default. When this option is enabled, the post date will be shown in the entry meta on Blog, Archive, and Search pages. It uses the date format specified in *Dashboard → Settings → General → Date Format*.
- **Show Post Word Count in Entry Meta**. Disabled by default. Shows the post word count in the entry meta on Blog, Archive, and Search pages. Only shows post word count for posts with the Standard Post Format.
- **Show Nav Menu on Single Posts**. Disabled by default. When this option is enabled, the primary navigation menu will also be shown on Single Post pages.
- **Show Updated Date on Single Posts**. Disabled by default. When this option is enabled, the post's last modified date will be shown underneath the published date. If you enable this, you can disable this on a per-post basis by adding a Custom Field to a post with the name `independent_publisher_hide_updated_date` and any value (`yes` or `true` will do).
- **Auto-Set Featured Image as Post Cover**. Disabled by default. When this option is enabled, any Featured Image set for a post will automatically be used as a Post Cover (see [Post Covers (Full-Width Featured Images)](https://github.com/raamdev/independent-publisher#post-covers-full-width-featured-images)).
- **Show Page Load Progress Bar**. Disabled by default. When enabled, a progress bar will appear across the top of the page as the page is loading. The color of the progress bar is determined by the Link Color setting in *Appearance → Customizer → Colors*.
- **Enable Multi-Author Mode**. Disabled by default. Enabling Multi Author Mode changes the behavior of the site to better support multiple authors. The author name is mentioned in the entry meta and the authors name always links to the author page instead of the home page. The Header Image (*Dashboard → Appearance → Customize → Header Image*) is treated as the site logo and placed as a small icon in top left of the single pages to provide a way of getting back to the home page.
- **Comments Call to Action**. "Write a Comment" by default. This allows you to change the label that shows up on the 'Write a Comment' button and also changes the title of the comment form itself.

## Post Covers (Full Width Featured Images)

Post Covers are full-width featured images that stretch across the entire top of the page.

![screen shot 2013-10-09 at 3 01 54 pm](https://f.cloud.github.com/assets/53005/1300647/558b2740-3115-11e3-92cc-6e23dd750bcb.png)

When setting a Featured Image as a Post Cover, it's important that you use an image that works for displaying full-width; 1200x600 is a good starting point. WordPress contains an Image Editor that you can use to crop images to the necessary dimensions.

### How to set a Featured Image as a Post Cover

To set a Featured Image as a Post Cover, first select the image from the Featured Image meta box and then press the **Update** button. When the page reloads you will see a checkbox that says "Use as post cover (full-width)". Check the box and then save the changes by pressing the **Update** button again.

![screen shot 2013-10-22 at 7 02 05 pm](https://f.cloud.github.com/assets/53005/1386236/fe8bff74-3b6d-11e3-8320-22efd60f423e.png)

## Post Subtitles

You can add a post subtitle at the top of your post content like this:

```
<h2 class="subtitle">Do what you love and do it often.</h2>
```

The `subtitle` class will style it like so:

![screen shot 2013-10-24 at 4 17 57 pm](https://f.cloud.github.com/assets/53005/1416672/d3f96c40-3f61-11e3-88eb-47428b696af4.png)

## Using a Child Theme to Customize Independent Publisher

If there are things you want to tweak in the Independent Publisher theme, a [Child Theme](https://developer.wordpress.org/themes/advanced-topics/child-themes/) is the recommended method for doing so. By using a Child Theme, you can make changes without worrying about those changes being overwritten by a future update to the parent theme.

After you've installed the Independent Publisher theme, download the [Independent Publisher Child Theme](https://github.com/raamdev/independent-publisher-child-theme/) and install and activate it. You can then start making changes to the Child Theme's files to override the parent theme. The Independent Publisher Child Theme comes with a few examples to help you get started.

For more information on using Child Themes, see the [WordPress Codex](https://developer.wordpress.org/themes/advanced-topics/child-themes/).

## Known Issues

* If you're using the [W3 Total Cache](http://wordpress.org/plugins/w3-total-cache/) plugin, you must disable the JS/CSS Minify option, as that [doesn't play well with jQuery](http://wordpress.org/support/topic/plugin-w3-total-cache-jquery-conflicts-when-added-to-minify?replies=6), which Independent Publisher makes use of. See also [Issue 46](https://github.com/raamdev/independent-publisher/issues/46#issuecomment-31478382).

## Frequently Asked Questions

### Why is my Header Image not showing on Single posts?

![screen shot 2014-05-15 at 6 53 32 pm](https://cloud.githubusercontent.com/assets/53005/2991763/cfad8b34-dc83-11e3-8f30-7ad98ac13486.png)


On Single Post pages, the Author Image (the image of the post author) is shown. On non-Single pages like the Home Page, the Header Image (*Dashboard → Appearance → Header*) is shown. If you see something like the screenshot above on your Single Post pages, that means you haven't configured an Author Image.

WordPress uses [Gravatar](http://gravatar.com) to link your email address with the image you want to show up when posting comments and publishing posts. If you don't already have a Gravatar account, signup using the same email address that you have configured in *Dashboard → Users → Your Profile*. After you upload and associate an image with the email address you have configured in WordPress, you should see the new image appear on your Single Post pages. (Sometimes it take a little while for Gravatar to update things, so if you don't see it immediately, give it some time.)

Note that if there is only one author on your site, you probably want to set the Header Image to be the same as the author Gravatar. (You also probably want the site Tagline, *Dashboard → Settings → General → Tagline*, to be the same as your bio in *Dashboard → Users → Your Profile → Biographical Info*.)

### How do I get the small logo to show up in the top-left corner?

![a4360d06-83b8-11e3-95e6-2fba9c982761](https://f.cloud.github.com/assets/53005/2000384/67f60ef8-8558-11e3-97be-09c9f3b7ec16.png)

First you need to enable **Multi-Author Mode** in *Dashboard → Appearance → Customizer → General Options* . With Multi-Author Mode enabled, the theme Header Image (*Dashboard → Appearance → Header Image*) will be placed in the top-left corner on all Single pages.

### Why is my Author Bio and picture at the top of my home page (or below a blog post) and not on the side?

Independent Publisher is a *responsive* theme, which fits the size of your browser depending on the size of your screen.  If you are on a computer, making your browser window wider will automatically move the Author Bio and picture to the side instead of at the top on your homepage or at the bottom of a blog post.

### How do I add Social Media Buttons below the Logo?

![screen shot 2014-02-03 at 12 54 31 pm](https://f.cloud.github.com/assets/5318719/2192243/00f7d5ec-9863-11e3-833f-3f28cd3d8cf4.png)

First you need to go to *Dashboard → Appearance → Menu*. Once there, create a new menu called Social. After that, add your social media links to it. For example:

![screen shot 2014-02-18 at 11 27 24 am](https://f.cloud.github.com/assets/5318719/2192161/ad89e3ca-9860-11e3-91b4-c416265854ce.png)

After you're done, below in **Theme Locations** (located in the **Menu Settings** tab), choose **Social**.

![screen shot 2014-02-18 at 11 42 31 am](https://f.cloud.github.com/assets/5318719/2192202/dcd5a848-9861-11e3-8e96-85cc4cdee1cb.png)

### How do I make the Subscribe to Comments Reloaded Advanced Options look better?

Go to *Settings -> Subscribe to Comments -> Comment Form -> Custom HTML* and wrap the contents in a paragraph tag with the `comment-form-subscriptions` class. For example:

```
<p class='comment-form-subscriptions'><label for='subscribe-reloaded'>[checkbox_label]</label> [checkbox_field]</p>
```

Note that double-quotes are not allowed in that field and that you *must* use single quotes, i.e., `class='comment-form-subscriptions'`, NOT `class="comment-form-subscriptions"`.

### How do I make MailChimp Signup Forms look better?

MailChimp includes its own CSS in the HTML embed code that, by default, doesn't look quite right with Independent Publisher. To fix the MailChimp CSS, you can add the following to the `style.css` file of a [Child Theme](https://github.com/raamdev/independent-publisher-child-theme/) (or if you're using Jetpack, simply go to *Appearance → Edit CSS* and insert the following):

```
#mc_signup .button {
	margin-top: 0 !important;
	padding-left: 15px !important;
	padding-right: 15px !important;
	padding-top: 2px !important;
	padding-bottom: 3px !important;
	line-height: 1.45 !important;
	height: 36px !important;
	font-weight: normal !important;
	width: 100% !important;
}

.entry-content #mc_signup h2 {
	font-size: 1.8em !important;
}
.entry-content #mc_signup input.email {
	width: 100% !important;
}
.entry-content #mc_signup label {
	padding-bottom: 0 !important;
}
.entry-content #mc_signup .mc-field-group {
	width: 99% !important;
}

.widget #mc_signup form {
	text-align: center !important;
	font-family: "Myriad Pro", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Geneva, Verdana, sans-serif;
}
.widget #mc_signup input.email {
	width: 100% !important;
	text-align: center;
}
.widget #mc_signup input.button {
	width: 100% !important;
}
```

![screen shot 2014-01-28 at 4 53 37 pm](https://f.cloud.github.com/assets/53005/2024233/c5642e38-8866-11e3-9d70-555eacbcb243.png)

### How do I add an Archive page?

The Independent Publisher theme includes a Page Template called "Archive Page" that you can use to create an Archive page. Simply create a new Page (*Pages -> Add New*), give it a title (e.g., "Archives"), then select the "Archive Page" template from the Template section in the Page Attributes meta box:

![screen shot 2014-04-28 at 3 51 36 pm](https://cloud.githubusercontent.com/assets/53005/2822091/a3c75ba8-cf0e-11e3-9ba4-62f2e81f6c04.png)

By default, the Archives Page Template will load the following:

- Recent Posts
- Most Used Categories
- Yearly Archives
- Monthly Archives
- Search
- Explore by Tag

If you'd like to use your own custom set of widgets, you can simply add widgets to the Archive Page widget area (*Appearance -> Widgets*):

![screen shot 2014-04-28 at 3 55 48 pm](https://cloud.githubusercontent.com/assets/53005/2822132/296236d4-cf0f-11e3-82e8-0fea749dcc3d.png)

To get the default set of widgets back, simply remove all widgets from the Archive Page widget area.

### How do I show a menu on the Single Post pages?

By default, the main navigation menu (Primary Menu) only appears on non-Single pages. This is meant to keep the Single Post pages clean and simple. You can change this default behavior by enabling "Show Nav Menu on Single Posts" in *Appearance -> Customize -> General Options*.

If you want your Single Posts menu to be differnet than your Primary Navigation menu, you can select a different menu for Single Posts in *Apperanace -> Menus -> Manage Locations -> Single Posts Menu*. 

### How do I change the footer credits?

You can change the footer credits by overriding the function that displays them (`independent_publisher_footer_credits()`) and making that function return something else (or return blank to remove footer content entirely).

Before making such a change, you'll want make sure you're using a [Child Theme](https://github.com/raamdev/independent-publisher#using-a-child-theme-to-customize-independent-publisher) so that future theme updates don't override your modifications. The `functions.php` file that comes with the [Independent Publisher Child Theme](https://github.com/raamdev/independent-publisher-child-theme/) includes [an example](https://github.com/raamdev/independent-publisher-child-theme/blob/master/functions.php#L36) for overriding the footer credits function.

### How do I add my own Social Icons to the Social Menu?

The [Social Menu](https://github.com/raamdev/independent-publisher#how-do-i-add-social-media-buttons-below-the-logo) works by detecting the social media URL you're using and matching that URL to an icon. If you want to add a new social media icon to use on the Social Menu, you can do so by adding the following block of code to your child theme's `style.css` file:

```css
#menu-social li a[href*="example.com"]::before {
	content: url('http://example.com/logo.png');
	opacity: 0.5;
}

#menu-social li a[href*="example.com"]:hover::before {
	opacity: 1;
}
```

You'll simply need to replace `example.com` and `http://example.com/logo.png` in the code with the domain for the new social media site and the URL to the logo you want to appear on the social menu.

### How can I enable "Single-Column Layout" on only the home page?

Add the following code to child theme's `functions.php` file to enable the Single-Column layout for only the home page:

```php
/**
 * Add single-column-layout to body class when on home page
 */
function __custom_independent_publisher_single_column_layout_body_class( $classes ) {
	if ( is_home() || is_front_page() ) {
		$classes[] = 'single-column-layout';
	}

	return $classes;
}

add_filter( 'body_class', '__custom_independent_publisher_single_column_layout_body_class' );
```

### Why is the Navigation Menu and/or Widgets not appearing on Single Post pages?

By default, the main navigation menu and all widges are hidden from the Single Post pages to keep things clean and simple, however, if you prefer to show these there, you can enable _Show Nav Menu on Single Posts_ and _Show Widgets on Single Posts_ in **Dashboard → Apperance → Customize → General Options**:

![2014-09-02_16-00-24](https://cloud.githubusercontent.com/assets/53005/4124836/faeaf062-32db-11e4-8e5b-b4f04be33ffb.png)

### How can I obfuscate my email address in the Social Menu?

The Social Menu uses the WordPress menu system and most email obfuscation plugins don't filter those for email addresses.

I've written a special filter that will tell the [Email Address Encoder plugin](https://wordpress.org/plugins/email-address-encoder/) to encode any navigation menu items in the Social menu that contain `mailto:<email-address>` or `<email-address>`. 

Add the following to a Child Theme `functions.php` file:

```php
add_filter( 'wp_nav_menu_objects', '__social_menu_eae_encode_emails', 10, 2 );
/**
 * Filters the Social Menu navigation items looking for email addresses and
 * filters those email addresses through the Email Address Encoder plugin.
 *
 * @since 1.0.0
 *
 * @param object $objects An array of nav menu objects
 * @param object $args    Nav menu object args
 *
 * @return object $objects Amended array of nav menu objects with items containing email addresses filtered through Email Address Encoder plugin
 */
function __social_menu_eae_encode_emails( $objects, $args ) {

	// Only apply the social navigation menu
	if ( isset( $args->theme_location ) ) {
		if ( 'social' !== $args->theme_location || ! function_exists( 'eae_encode_emails' ) ) {
			return $objects;
		}
	}

	// Find any menu items with an email address and run them through the Email Address Encoder plugin
	foreach ( $objects as $object ) {
		if ( is_email( $object->url ) ) {
			$object->url = eae_encode_emails( $object->url );
		}
		if ( stristr( $object->url, 'mailto:' ) ) {
			$email = substr( $object->url, 7 );
			if ( is_email( $email ) ) {
				$object->url = 'mailto:' . eae_encode_emails( $email );
			}
		}
	}

	// Return the modified objects
	return $objects;
```

### How can I use a Full Size Image for the Post Cover?

By default, the theme will use a maximum of `700x700` pixels for the Post Cover image. You can override this and use the full image size by adding the following to your Child Theme's `functions.php` file:

```php
function __custom_independent_publisher_full_width_featured_image_size() {
    return "full";
}

add_filter( 'independent_publisher_full_width_featured_image_size', '__custom_independent_publisher_full_width_featured_image_size' );
```

### How can I use a Full Size Image for Featured Images?

The theme uses the default of `700px` for various reasons, including bandwidth considerations. However, you can easily override the default featured image width and show the `full` width (or any of the [WordPress thumbnail sizes](http://codex.wordpress.org/Function_Reference/the_post_thumbnail#Thumbnail_Sizes)).

First, you'll need to update the CSS. By default, the theme CSS will use a 100% width for featured images (which means `700px` wide by default). You can override this and use whatever the full image size is by adding the following to your Child Theme's `style.css` file:

```php
.single .wp-post-image,
.page .wp-post-image,
.blog .wp-post-image,
.archive .wp-post-image {
	width: auto;
}
```

You'll also need to add the following code to a Child Theme's `functions.php` file (instead of `full`, you can use any of the [WordPress thumbnail sizes](http://codex.wordpress.org/Function_Reference/the_post_thumbnail#Thumbnail_Sizes)):

``` php
function __custom_independent_publisher_full_width_featured_image_size() {
    return "full";
}

add_filter( 'independent_publisher_full_width_featured_image_size', '__custom_independent_publisher_full_width_featured_image_size' );
```

If you add the above PHP code and discover that your post Featured Images are too big, try removing the CSS that you added above so that images get a 100% width.

## Color Schemes

You can modify the color scheme in *Appearance → Customize → Colors*. Here are a few recommended color schemes:

### Blue

* Set Link Color to `#26759e`

### Black

* Set Text color to `#f7f7f7`
* Set Background Color to `#000000`
* Set Link Color to `#1a609e`
* Set Title and Header Text Color to `#d1d1d1`
* Set Primary Meta Text Color to `#8e8e8e`
* Set Secondary Meta Text color to `#666666`

## Theme Filters and Actions

WordPress Filters and Actions allow you to modify the theme without actually modifying any theme code. To use any of these filters or actions, start by creating a [Child Theme](#using-a-child-theme-to-customize-independent-publisher) and then adding the relevant function to the `functions.php` file. See also [add_filter()](http://codex.wordpress.org/Function_Reference/add_filter) and [add_action()](http://codex.wordpress.org/Function_Reference/add_action) on the WordPress Codex.

### Filters

- `independent_publisher_taxonomy_category_stats` - Allows you to override the Category Archive stats that are appended to the category archive description.
- `independent_publisher_taxonomy_tag_stats` - Allows you to override the Tag Archive stats that are appended to the Tag Archive description.
- `independent_publisher_entry_meta_separator` - Allows you to override the default separator character that is used in the Entry Title Meta and Entry Post Meta (default is '|').
- `independent_publisher_entry_meta_category_prefix` - Allows you to override the default Category prefix (default is 'in'; e.g., "<author name> in <category name>").
- `independent_publisher_entry_meta_author_prefix` - Allows you to override the default Author prefix (default is 'by'; e.g., "by <author name>").
- `independent_publisher_search_stats` - Allows you to override the Search stats shown on Search pages.
- `independent_publisher_tag_list_title` - Allows you to override the default Tag List Title of 'Related Content by Tag' at the bottom of Single posts.
- `independent_publisher_webmentions_title` - Allows you to override the default Webmentions title of 'Webmentions' at the bottom of Single posts.

### Action Hooks

- `independent_publisher_entry_meta_top` - Located at the top of post Entry Meta, just before the 'Write a Comment' button.
- `independent_publisher_before_bottom_comment_button` - Located just before the second 'Write a Comment' button that shows up underneath post comments when there are more than 4 comments visible.
- `independent_publisher_before_post_bottom_tag_list` - Located before the bottom 'Related Content by Tag' tag list on Single posts.

## Functions you can Override in a Child Theme

### Functions in `inc/template-tags.php`:

- `independent_publisher_content_nav()` - Display navigation to next/previous pages when applicable
- `independent_publisher_comment()` - Template for comments and pingbacks.
- `independent_publisher_mentions()` - Creates a custom query for webmentions, pings, and trackbacks and displays them. Using this custom query instead of `wp_list_comments()` allows us to always show all mentions, even when we're showing paginated comments.
- `independent_publisher_posted_author()` - Prints HTML with meta information for the current author.
- `independent_publisher_posted_author_cats()` - Prints HTML with meta information for the current author and post categories. Only prints author name when Multi-Author Mode is enabled.
- `independent_publisher_posted_on_date()` - Prints HTML with meta information for the current post-date/time.
- `independent_publisher_post_updated_date()` - Prints HTML with meta information for the current post's last updated date/time.
- `independent_publisher_continue_reading_link()` - Prints HTML with Continue Reading link
- `independent_publisher_continue_reading_text()` - Returns Continue Reading text for usage in `the_content()`
- `independent_publisher_categorized_blog()` - Returns true if a blog has more than 1 category
- `independent_publisher_wp_title()` - Filters `wp_title` to print a neat `<title>` tag based on what is being viewed.
- `independent_publisher_post_categories()` - Returns categories for current post with separator. Optionally returns only a single category.
- `independent_publisher_site_info()` - Outputs site info for display on non-single pages
- `independent_publisher_posted_author_card()` - Outputs post author info for display on single posts
- `independent_publisher_posted_author_bottom_card()` - Outputs post author info for display on bottom of single posts
- `independent_publisher_get_post_word_count()` - Returns number of words in a post formatted for display in theme
- `independent_publisher_full_width_featured_image()` - Show Full Width Featured Image on single pages if post has full width featured image selected
- `independent_publisher_search_stats()` - Returns stats for search results
- `independent_publisher_taxonomy_archive_stats()` - Returns taxonomy archive stats and current page info for use in taxonomy archive descriptions
- `independent_publisher_date_archive_description()` - Returns the Date Archive description
- `independent_publisher_min_comments_bottom_comment_button()` - Returns the minimum number of comments that must exist for the bottom 'Write a Comment' button to appear
- `independent_publisher_min_comments_comment_title()` - Returns the minimum number of comments that must exist for the comments title to appear
- `independent_publisher_hide_comments()` - Determines if the comments and comment form should be hidden altogether. This differs from disabling the comments by also hiding the "Comments are closed." message and allows for easily overriding this function in a Child Theme.
- `independent_publisher_footer_credits()` - Echoes the theme footer credits. Overriding this function in a Child Theme also applies the changes to Jetpack's Infinite Scroll footer.

### Functions in `functions.php`:

- `independent_publisher_setup()` - Sets up theme defaults and registers support for various WordPress features.
- `independent_publisher_stylesheet()` - Enqueue the main stylesheet.
- `independent_publisher_wp_fullscreen_title_editor_style()` - Enqueue the stylesheet for styling the full-screen visual editor post title so that it closely matches the front-end theme design. To disable, simply override this function in a Child Theme and return nothing.
- `independent_publisher_author_comment_reply_link()` - Change the comment reply link to use 'Reply to [Author First Name]'
- `independent_publisher_comment_form_args()` - Arguments for `comment_form()`
- `independent_publisher_remove_textarea()` - Move the comment form textarea above the comment fields
- `independent_publisher_add_textarea()` - Recreates the comment form textarea HTML for reinclusion in comment form
- `independent_publisher_enhanced_comment_form()` - Enqueue enhanced comment form JavaScript
- `independent_publisher_site_logo_icon_js()` - Enqueue Site Logo Icon JavaScript if Multi-Author Site enabled
- `independent_publisher_is_multi_author_mode()` - Returns true if Multi-Author Mode is enabled
- `independent_publisher_single_author_link()` - Returns the author link; defaults to home page when not using multi-author mode
- `independent_publisher_post_word_count()` - Returns number of words in a post
- `independent_publisher_first_sentence_excerpt()` - Return the post excerpt. If no excerpt set, generates an excerpt using the first sentence.
- `independent_publisher_clean_content()` - Cleans the content for display as a Quote or Aside by stripping anything that might screw up formatting
- `independent_publisher_maybe_linkify_the_content()` - Returns the post content for Asides and Quotes with the content linked to the permalink, for display on non-Single pages
- `independent_publisher_maybe_linkify_the_excerpt()` - Returns the excerpt with the excerpt linked to the permalink, for display on non-Single pages
- `independent_publisher_html_tag_schema()` - Returns the proper schema type
- `independent_publisher_show_page_load_progress_bar()` - Echos the HTML and JavScript necessary to enable page load progress bar
