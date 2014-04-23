Independent Publisher is a beautiful reader-focused WordPress theme, for you.

Version history:

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
* Fixed JetPack Infinite Scroll theme support so that new posts display properly
* Fixed independent_publisher_footer_credits() so that it could overridden in a Child Theme. This also allows for overriding JetPack's Infinite Scroll footer credits.

1.1

* Update default language files
* Remove erroneous __MACOSX direcories

1.0

* Initial Release, after six months of life in beta.