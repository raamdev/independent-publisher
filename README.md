Independent Publisher WordPress Theme
=====================

## Theme Options

Theme Options can be found in `Dashboard → Apperance → Customize → Theme Options`.

- **Multi Author Mode**. Enabling Multi Author Mode changes the behavior of the site to better support multiple authors. The author name is mentioned in the entry meta and the authors name always links to the author page instead of the home page. The Header Image (**WP Dashboard → Appearance → Customize → Header Image**) is treated as the site logo and placed as a small icon in top left of the single pages to provide a way of getting back to the home page.
- **Use Post Excerpts**. Turning this on will show post excerpts on the Blog, Archive, and Search pages instead of full post content. If no excerpt exists, a default excerpt is generated using the first 55 words (see [`the_excerpt()`](http://codex.wordpress.org/Function_Reference/the_excerpt)).
- **Use Enhanced Excerpts**. Enhanced Excerpts are the same as Post Excerpts except when no post excerpt is defined, one is generated using the first sentence in the post. A "Continue Reading →" link is also placed below the excerpt.
- **Show Post Word Count**. Shows the post word count in the entry meta on Blog, Archive, and Search pages. Only shows post word count for posts with the Standard Post Format.
- **Show Post Thumbnail**. When enabled, featured images are shown on the Blog, Archive, and Search pages. (Only applicable when Post Exceprts and Enhanced Excerpts are disabled.)

## Post Covers (Full Width Featured Images)

Post Covers are full-width featured images that stretch across the entire top of the page.

![screen shot 2013-10-09 at 3 01 54 pm](https://f.cloud.github.com/assets/53005/1300647/558b2740-3115-11e3-92cc-6e23dd750bcb.png)

When setting a Featured Image as a Post Cover, it's important that you use an image that works for displaying full-width; 1200x600 is a good starting point. WordPress contains an Image Editor that you can use to crop images to the necessary dimensions.

### How to set a Featured Image as a Post Cover

To set a Featured Image as a Post Cover, first select the image from the Featured Image meta box and then press the **Update** button. When the page reloads you will see a checkbox that says "Use as post cover (full-width)". Check the box and then save the changes by pressing the **Update** button again.

![screen shot 2013-10-22 at 7 02 05 pm](https://f.cloud.github.com/assets/53005/1386236/fe8bff74-3b6d-11e3-8320-22efd60f423e.png)

## Using a Child Theme to Customize Independent Publisher

If there are things you want to tweak in the Independent Publisher theme, a [Child Theme](http://codex.wordpress.org/Child_Themes) is the recommended method for doing so. By using a Child Theme, you can make changes without worrying about those changes being overwritten by a future update to the parent theme.

After you've installed the Independent Publisher theme, download the [Independent Publisher Child Theme](https://github.com/raamdev/independent-publisher-child-theme/) and install and activate it. You can then start making changes to the Child Theme's files to override the parent theme. The Independent Publisher Child Theme comes with a few examples to help you get started.

For more information on using Child Themes, see the [WordPress Codex](http://codex.wordpress.org/Child_Themes).
