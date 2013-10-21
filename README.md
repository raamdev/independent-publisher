Independent Publisher WordPress Theme
=====================

## Theme Options

Theme Options can be found in `Dashboard → Apperance → Customize → Theme Options`.

- **Multi Author Mode**. Enabling Multi Author Mode changes the behavior of the site to better support multiple authors. The author name is mentioned in the entry meta and the authors name always links to the author page instead of the home page. The Header Image (**WP Dashboard → Appearance → Customize → Header Image**) is treated as the site logo and placed as a small icon in top left of the single pages to provide a way of getting back to the home page.
- **Use Post Excerpts**. Turning this on will show post excerpts on the Blog, Archive, and Search pages instead of full post content. If no excerpt exists, a default excerpt is generated using the first 55 words (see [`the_excerpt()`](http://codex.wordpress.org/Function_Reference/the_excerpt)).
- **Use Enhanced Excerpts**. Enhanced Excerpts are the same as Post Excerpts except when no post exceprt is defined, one is generated using the first sentence in the post. A "Continue Reading →" link is also placed below the excerpt.
- **Show Post Word Count**. Shows the post word count in the entry meta on Blog, Archive, and Search pages. Only shows post word count for posts with the Standard Post Format.
- **Show Post Thumbnail**. When enabled, featured images are shown on the Blog, Archive, and Search pages. (Only applicable when Post Exceprts and Enhanced Excerpts are disabled.)

## Using a Child Theme to Customize Independent Publisher

If there are things you want to tweak in the Independent Publisher theme, a [Child Theme](http://codex.wordpress.org/Child_Themes) is the recommended method for doing so. By using a Child Theme, you can make changes without worrying about those changes being overwritten by a future update to the parent theme.

After you've installed the Independent Publisher theme, download the [Independent Publisher Child Theme](https://github.com/raamdev/independent-publisher-child-theme/) and install and activate it. You can then start making changes to the Child Theme's files to override the parent theme. The Independent Publisher Child Theme comes with a few examples to help you get started.

For more information on using Child Themes, see the [WordPress Codex](http://codex.wordpress.org/Child_Themes).
