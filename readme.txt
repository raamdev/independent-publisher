Independent Publisher is a beautiful reader-focused WordPress theme, for you.

Version history:

1.8

- **Bug Fix**: Fixed bug where Microformats 2 support was not being loaded during theme setup. Props @Ruxton. See [Issue #231](https://github.com/raamdev/independent-publisher/issues/231).
- **Bug Fix:** Fixed CSS padding for WP-PageNavi integration that was breaking in Firefox. Props @johlym and @vskjefst. See [Issue #229](https://github.com/raamdev/independent-publisher/issues/229).
- **Bug Fix**: Removed an extra space after the opening parenthesis in the pagination page count on Archive Views, e.g., "( this is page 1 of 2)". Props @vskjefst and @jimmymansaray. See [Issue #263](https://github.com/raamdev/independent-publisher/issues/263).
- **Bug Fix**: Fixed a bug where an empty parenthesis would be displayed when archive views have more than one item, but less than enough items to require pagination. Props @vskjefst and @Furgelnod. See [Issue #249](https://github.com/raamdev/independent-publisher/issues/249).
- **Bug Fix**: Fixed a bug where leaving a comment with a Site URL that contains a percent sign would generate a PHP Notice indicating "Warning: printf(): Too few arguments". Props @mritzmann. See [Issue #248](https://github.com/raamdev/independent-publisher/issues/248).
- **Bug Fix**: Fixed a bug where the `aria-label` attribute in the comment "Reply to" link contained a duplicate copy of the author name, which affected users with screen readers. Props to [Alex](https://raamdev.com/2013/personalizing-the-wordpress-comment-reply-link/#comment-11983) for reporting. See [Issue #252](https://github.com/raamdev/independent-publisher/issues/252).
- **Bug Fix**: Fixed a bug when using RTL mode that prevented the Customizer CSS from being applied. See [Issue #230](https://github.com/raamdev/independent-publisher/issues/230).
- **Enhancement:** Improved compliance with WP coding standards. Props @jeherve. See [Issue #232](https://github.com/raamdev/independent-publisher/pull/232).
- **Enhancement:** Added additional `if ( ! function_exists() )` checks to allow overriding from a Child Theme. Props @jeherve. See [Issue #232](https://github.com/raamdev/independent-publisher/pull/232).
- **Enhancement:** Moved "Related Tags" to its own function so that it could be easily overwritten with a Child Theme. Props @jeherve. See [Issue #233](https://github.com/raamdev/independent-publisher/pull/233).
- **Enhancement**: Added a new option to Show Post Thumbnails when displaying excerpts. By default, this option is disabled but if you have excerpts enabled and you want show the Post Thumbnail above the excerpt, you can enable this option in Dashboard → Appearance → Customize → Excerpt Options. See [Issue #218](https://github.com/raamdev/independent-publisher/issues/218).
- **Enhancement:** Added new option to Show Full Name in Comment Reply-to Link. By default, Independent Publisher only shows the First Name of the commenter in the "Reply to..." link below each comment. This new option lets you always show the Full Name (first name + last name), if available. Props @vskjefst. See [Issue #237](https://github.com/raamdev/independent-publisher/pull/237).
- **Enhancement**: Improved handling of Customizer default colors. Props @vskjefst. See [Issue #240](https://github.com/raamdev/independent-publisher/pull/240).
- **Enhancement**: Refactored code that outputs the `title=""` attribute for Post Title and Post Thumbnail links. The functions `independent_publisher_post_link_title()` and `independent_publisher_post_thumbnail_link_title()` can now be easily overridden in a Child Theme. Props @vskjefst. See [Issue #241](https://github.com/raamdev/independent-publisher/pull/241).
- **Enhancement**: Upgraded Genericons to v3.4.1. Props @vskjefst. See [Issue #245](https://github.com/raamdev/independent-publisher/pull/245).
- **Enhancement**: Updated the Archive Page Template (`page_archive-template.php`) to only show "Most Used Categories" list when there are more than one. Props @FokkeZB. See [Issue #255](https://github.com/raamdev/independent-publisher/pull/255).
- **Translations:** Updated Italian translation. Props @kOoLiNuS. See [this commit](https://github.com/raamdev/independent-publisher/commit/4f236641c0721aa79aaed70b9b62c35232a27fcd).
- **Translations:** Added Armenian translation. Props @hanumanum. See [Issue #265](https://github.com/raamdev/independent-publisher/pull/265).
- **Validation**: The Site Title and Site Description now use `div`'s instead of `h1` and `h2`, which should be reserved for the post content. Props @PedroFumero. See [Issue #261](https://github.com/raamdev/independent-publisher/issues/261).
- **Deprecated:** `independent_publisher_pings()` has been deprecated in favor of `independent_publisher_mentions()`, which also supports Webmentions. See [this commit](https://github.com/raamdev/independent-publisher/commit/59709196f701832feb23db225ffeabb83a1cb768)
- **Removed:** Removed Jetpack Sharing enhancements. These enhancements are no longer necessary as the Jetpack sharing output has improved since these were implemented. Any desired changes to the Jetpack Sharing buttons should now be applied on a case-by-case basis using a Child Theme. See [this commit](https://github.com/raamdev/independent-publisher/commit/f0aa17b7ce96242e76e3af1d43c6f4c214baeb01).
- **New Filter:** Added filter for the 'Webmentions' title section at the bottom of Single posts. This can now be filtered using `independent_publisher_webmentions_title`. Also removed `independent_publisher_pingslist_*` filters from `README.md` as those filters were removed when webmention support was added in v1.7. See [this commit](https://github.com/raamdev/independent-publisher/commit/92e9d0ddcd2068ababa026e36386d4d03dadef3f).

1.7

* **Bug Fix**: When using the Single-column Layout, there was an unnecessary margin between the top of the post content and the bottom of the featured image. This has been removed.
* **Bug Fix**: Fixed a missing closing `</li>` element in the Pings List function.
* **Bug Fix**: When "Show Avatars" was disabled, the Header Image would appear on all pages except the Single Posts (where the Author Avatar shows up). For Single-Author Blogs who want to disable Avatars for the comments section, this resulted in the Header Image (often set to the single author's personal avatar) would show everywhere except on Single Posts. This was fixed by using the Header Image on Single Posts when Show Avatars is disabled and "Enable Multi-Author Mode" (in Appearance --> Customize --> General Options) was also disabled (i.e., the blog is a single-author blog). Props to @rmorabia for reporting this. See [#187](https://github.com/raamdev/independent-publisher/issues/187).
* **Bug Fix**: Fixed an erroneous closing `</div>` in `inc/template-tags.php`. Props to @poolghost. See [#195](https://github.com/raamdev/independent-publisher/issues/195).
* **Bug Fix**: Fixed an XSS vulnerability in `independent_publisher_replytocom()`. Props to @henryk. See [#200](https://github.com/raamdev/independent-publisher/pull/200).
* **Bug Fix**: Fixed a bug where the post excerpts on the home page would use the Link Color instead of the Text Color. Props @adamcroom and Jakub Kapusnak. See [Issue #188](https://github.com/raamdev/independent-publisher/issues/188).
* **Bug Fix**: Fixed a bug with changing Comment Form Background color in Customizer. Props @manishsuwal and @diogeneskelsen. See [Issue #173](https://github.com/raamdev/independent-publisher/issues/173).
* **Bug Fix**: Fixed a bug where only one category would appear above the title on the Single Post Page when more than one category was selected; now all of categories appear. If you prefer the old behavior of only showing one category even when multiple categories have been selected, see [Issue #196](https://github.com/raamdev/independent-publisher/issues/196).
* **Enhancement**: Pages now support Featured Images and Full-Width Featured Images (i.e., Post Covers). See [#171](https://github.com/raamdev/independent-publisher/issues/171).
* **Enhancement**: Posts with a Gallery Post Format that include a Featured Image now display the Featured Image in Archive views (home page, date-based archives, category/tag-based archives, etc.). Props to @joch. See [#178](https://github.com/raamdev/independent-publisher/pull/178).
* **Enhancement**: Added RSS Icon support to Social Menu. You can now add menu items to the Social Menu that have URLs containing `/feed` and those will show the RSS Icon. See [Issue #190](https://github.com/raamdev/independent-publisher/issues/190).
* **Enhancement**: Theme Customizer CSS is now compressed and loaded via an external file. This increases page load time and cleans up the main HTML source. See [#116](https://github.com/raamdev/independent-publisher/issues/116).
* **Enhancement**: Deprecated the `wp_title()` function. The WordPress Core `wp_title()` function has been deprecated as of WordPress v4.1. See [this post](https://make.wordpress.org/core/2015/10/20/document-title-in-4-4/) for more information.
* **Enhancement**: Optimized several escape and translation functions, replacing `esc_attr( __() )` with `esc_html_e()`. Props @stevenatwork. See [Issue #214](https://github.com/raamdev/independent-publisher/pull/214) and [Issue #215](https://github.com/raamdev/independent-publisher/pull/215).
* **Enhancement**: Improved the Link Post Format style. The title is now shown and includes an external link icon. Props @iksa01 and @kOoLiNuS for feedback. See [Issue #160](https://github.com/raamdev/independent-publisher/issues/160).
* **Enhancement**: Added a new "Show Author Card on Single Posts" option to the Theme Customizer General Options. The default is enabled (the original behavior) but this can be disabled if you prefer not to show the author card at the bottom of Single posts. (Note that the author card only appears at the bottom of Single posts when using Single-Column Layout or when the browser resizes to less than 1200px wide.) See [Issue #134](https://github.com/raamdev/independent-publisher/issues/134).
* **Enhancement**: Added support for [WP-PageNavi](https://wordpress.org/plugins/wp-pagenavi/). Props @tarampampam. See [Issue #179](https://github.com/raamdev/independent-publisher/issues/179).
* **Enhancement**: Pings/trackbacks at the bottom of Single Posts are now shown even if the post has no comments. (Previously they only appeared when there was at least one comment.)
* **Enhancement**: Added support for [Webmentions](https://indiewebcamp.com/Webmention) via the [IndieWebCamp WordPress plugins](https://indiewebcamp.com/wordpress). Props to @chrisaldrich, @dshanske, @raaphorst, @raumzeit77 for help and ideas. See Issues [#201](https://github.com/raamdev/independent-publisher/issues/201), [#197](https://github.com/raamdev/independent-publisher/issues/197), and [#155](https://github.com/raamdev/independent-publisher/issues/155).
* **Enhancement**: Added [Microformats 2](http://microformats.org/wiki/microformats-2) markup. This includes a change to the classes applied to the content DIV on listings of posts: If an excerpt is being shown, the classes are `entry-summary e-summary`; if the full content is being shown, `entry-content e-content` is used. If you have a Child Theme with custom CSS targeting `entry-content`, you may need to update it to include `entry-summary`. Props @dshanske. See [Issue #221](https://github.com/raamdev/independent-publisher/issues/221).
* **Translations**: Added Indonesian language translation (props to @ekajogja). See [#159](https://github.com/raamdev/independent-publisher/pull/159).
* **Translations**: Added Dutch language translation (props to @raaphorst). See [#151]
(https://github.com/raamdev/independent-publisher/issues/151).
* **Translations**: Improved Dutch language translation (props to @SpaceK33z). See [#174](https://github.com/raamdev/independent-publisher/pull/174).
* **Translations**: Added Mongolian translation (props @uugankhuu). See [#175](https://github.com/raamdev/independent-publisher/issues/175).
* **Translations**: Added Portuguese-Brazil language translation (props to @rmmartins). See [#183](https://github.com/raamdev/independent-publisher/pull/183).
* **Translations**: Added Simplified Chinese language translation (props to @iwillhappy1314). See [#193](https://github.com/raamdev/independent-publisher/pull/193).
* **Translations:** Added Turkish language translation (props @pekermert). See [#207](https://github.com/raamdev/independent-publisher/pull/207).
* **Translations**: Added Italian translations. Props Nicola.

1.6

* **New Feature**: Overlay Post Title on Post Cover. You can now choose to have the Post Title overlayed on top of the Post Cover, when setting a featured image to be full-width (Post Cover). See [#47](https://github.com/raamdev/independent-publisher/issues/47). (Thanks to @descubraomundo)
* **Enhancement**: Social Menu now includes support for `mailto:` links. When you add a menu item with a `mailto:` link, an envelope icon will be displayed on the Social Menu. See [#105](https://github.com/raamdev/independent-publisher/pull/105). (Thanks to @bitzl)
* **Enhancement**: When a Post has multiple categories, you can now define a single category to be shown in the post meta using a custom field called `independent_publisher_primary_category` and then the name of the category you want to show. See [#122](https://github.com/raamdev/independent-publisher/pull/122). (Thanks to @tlongren)
* **Enhancement**: It is now possible to override the default maximum resolution of 700px for featured images. This is useful if you use Full-Width Featured Images (Post Covers) and want to use higher resolution images. See [#129](https://github.com/raamdev/independent-publisher/issues/129)
* **Enhancement**: Add support for Audio post format. See [#140](https://github.com/raamdev/independent-publisher/issues/140).
* **Enhancement**: Added support for Jetpack Responsive Videos. See [#124](https://github.com/raamdev/independent-publisher/issues/124).
* **Enhancement**: Images with captions inside the Visual Editor now appear styled like they do when published. See [#103](https://github.com/raamdev/independent-publisher/issues/103). (Reported by @saddington)
* **Style Change**: Removed long-dash prepend from `<cite>` elements. See [#115](https://github.com/raamdev/independent-publisher/issues/115).
* **Bug Fix**: When using the Visual Editor, quotes now display newlines properly. See [#108](https://github.com/raamdev/independent-publisher/issues/108). (Reported by @saddington)
* **Bug FIx**: Fixed a missing closing div that was causing validation errors. See [#113](https://github.com/raamdev/independent-publisher/pull/113). (Thanks to @peterk)
* **Bug Fix**: The Jetpack Infinite Scroll loading wheel no longer displays at the top of the page, but rather at the bottom. See [#104](https://github.com/raamdev/independent-publisher/issues/104). (Reported by @manishsuwal)
* **Bug FIx**: When using the Jetpack Infinite Scroll module, the archive pages no longer display the irrelevant current page number content. See [#110](https://github.com/raamdev/independent-publisher/issues/110). (Reported by @manishsuwal)
* **Bug Fix**: When a visitor submits a comment on a page without comments, and their comment requires moderation, the visitor will now see their unapproved comment on the page. See [#119](https://github.com/raamdev/independent-publisher/issues/119). (Reported by @manishsuwal)
* **Bug Fix**: Fixed an issue footnotes inside Aside and Quote format posts. See [#125](https://github.com/raamdev/independent-publisher/issues/125). (Reported by @manishsuwal)
* **Bug Fix**: Main navigation menu and widget menu anchor elements are no longer set as block elements. This fixes an issue with browser plugins that utilize anchor elements for on-screen hints. See [#127](https://github.com/raamdev/independent-publisher/issues/127).
* **Translations**: Added Czech language translation. (Thanks to @Tajdik)
* **Translations**: Added Spanish language translation. (Thanks to @mkiramu)
* **Translations**: Added German language translation. (Thanks to @JHillert)
* **Translations**: Updated French language translation. (Thanks to @EddyLB)

1.5.1

* Bug Fix: Fixed a nasty bug with Galleries where all galleries were one-column, instead of following the default 3-column layout. This also affected 4-column, 5-column, etc., layouts.
* Bug Fix: Fixed issue with content not resizing properly on mobile devices when using the Jetpack Infinite Scroll module.
* Enhancement: Gallery image captions are now hidden by default and hovering over the image shows the caption overlayed on top of the image.
* Translations: Updated French translations (thanks to @EddyLB)
* Translations: Fixed Russian translations (thanks to @rad96)
* Translations: Allowed "Enabled" and "Disabled" strings in Theme Customizer to be translated.
* Misc: Fixed printf() warning in single.php. (Props to Zhuo)

1.5

* New Feature: Auto-Set Featured Image as Post Cover. There is a new "Auto-Set Featured Image as Post Cover" option in Appearance -> Customize -> General Options. When enabled, the featured image selected for a post will automatically become the Post Cover. This saves time by not needing to check the "Use as post cover" option in the Featured Image meta box. When this option is enabled, you can disable the Post Cover on a post-by-post basis using the "Disable post cover" checkbox that appears in the Featured Image meta box.
* New Feature: Single Posts menu location. If you want your Single posts menu to be different than your Primary navigation menu, you can now create a new menu and assign it to the Single Posts menu location.
* New Translation: Russian translation (thanks to Артем Рябков).
* Bug Fix: Added missing Featured Image support from Single posts. This was accidentally removed in an earlier update. If you have a featured image, and you're not using it as the Post Cover, it will now properly appear at the top of the post.
* Bug Fix: Fixed a bug with oEmbeds not working on Quote and Aside Post Formats.

1.4.1

* Fix hidden progress bar when Admin Bar is loaded
* Santize Customizer settings

1.4

* New Feature: Progress Bar. There is a new "Show Page Load Progress Bar" option in Appearance -> Customize -> General Options. Enabling this shows a thin progress bar across the top of the page while loading. The color of the bar is determined by the Link Color chosen in the Customizer. See https://github.com/raamdev/independent-publisher/issues/35 (Thanks to Tyler Longren)
* New Feature: The last modified date of a post can now be shown underneath the Published date on Single Post pages. There is a new "Show Updated Date on Single Posts" option in Appearance -> Customize -> General Options. This will only appear when the published date and the modified date are different (i.e., you've modified a post).
* Enhancement: Featured Images are now properly linked to the post permalink. (Thanks to Tyler Longren)
* Enhancement: The Primary Navigation menu can now be shown on Single Post pages. There is a new "Show Nav Menu on Single Posts" option in Appearance -> Customize -> General Options. See https://github.com/raamdev/independent-publisher/issues/82
* Fixed "Reply to", "Published", and "Updated" strings; they can now be translated
* Updated French translation. (Contributed by Eddy Lelièvre-Berna)
* Fixed inconsistencies with the text-domain for translations. See https://github.com/raamdev/independent-publisher/issues/75
* Bug fix: Fixed "dark overlay" bug. This was related to a conflict with Jetpack's Infinite Scroll module. See https://github.com/raamdev/independent-publisher/issues/72
* Changed the default value for the Customizer option "Show Post Word Count" from true to false. This does not affect theme upgrades; it only applies to new installations of the theme.


1.3.1

* Added French translation (contributed by Eddy Lelièvre-Berna)
* Updated default language file (it was missing several strings)

1.3

* Fixed spelling mistake in theme description
* Fixed Jetpack Infinite Scroll when browser width < 1200px
* Fixed comment form bugs when using comment reply links
* Added props to theme project contributors in style.css
* Fixed issue with Theme Customizer Live Preview incorrectly changing the color of the Continue Reading link when modifying the Secondary Meta Text color
* Fixed Sticky post alignment on browsers < 500px

1.2

* Properly escaped all occurrences of home_url()
* Added copyright and license info, as required by WordPress.org Themes Repository
* Added credit and license info for bundled Genericons, as required by WordPress.org Themes Repository
* Updated footer credits with proper anchor text for WordPress.org link, as required by WordPress.org Themes Repository
* Fixed wpstats smiley position when browser width < 1200px
* Fixed require() statements so they use get_template_directory() to properly support Child Themes
* Fixed Jetpack Infinite Scroll theme support so that new posts display properly
* Fixed independent_publisher_footer_credits() so that it could overridden in a Child Theme. This also allows for overriding Jetpack's Infinite Scroll footer credits.

1.1

* Update default language files
* Remove erroneous __MACOSX direcories

1.0

* Initial Release, after six months of life in beta.
