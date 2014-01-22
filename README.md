Independent Publisher WordPress Theme
=====================

## Theme Options

Theme Options can be found in `Dashboard → Apperance → Customize`.

### Colors

The following colors can be changed via the Colors section:

- Text Color
- Background Color
- Link Color
- Title and Header Text Color
- Primary Meta Text Color
- Secondary Meta Text Color

### Excerpts

- **Default Excerpts**. Generate an excerpt using the first 55 words (see [`the_excerpt()`](http://codex.wordpress.org/Function_Reference/the_excerpt)) on the Blog, Archive, and Search pages and show that instead of the full post content. 
- **One-Sentence Excerpts**. When no post excerpt is defined, one is generated using the first sentence of the post. A "Continue Reading →" link is also placed below the excerpt.
- **Always Show Full Content for First Post**. When Post Excerpts are enabled, this option ensures that the very first post on the Latest Posts page shows the full post content instead of the excerpt.

### General Options

- **Show Widgets on Single Pags**. By default, widgets are hidden from single pages to improve readability. If you prefer to show widgets on single pages, you can enable that here.
- **Show Post Word Count in Entry Meta**. Shows the post word count in the entry meta on Blog, Archive, and Search pages. Only shows post word count for posts with the Standard Post Format.

### Hidden Options

- **Multi Author Mode**. Enabling Multi Author Mode changes the behavior of the site to better support multiple authors. The author name is mentioned in the entry meta and the authors name always links to the author page instead of the home page. The Header Image (**WP Dashboard → Appearance → Customize → Header Image**) is treated as the site logo and placed as a small icon in top left of the single pages to provide a way of getting back to the home page. Multi Author Mode can be enabled using a Child Theme. See `functions.php` in the [Independent Publisher Child Theme](https://github.com/raamdev/independent-publisher-child-theme) for instructions.

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

If there are things you want to tweak in the Independent Publisher theme, a [Child Theme](http://codex.wordpress.org/Child_Themes) is the recommended method for doing so. By using a Child Theme, you can make changes without worrying about those changes being overwritten by a future update to the parent theme.

After you've installed the Independent Publisher theme, download the [Independent Publisher Child Theme](https://github.com/raamdev/independent-publisher-child-theme/) and install and activate it. You can then start making changes to the Child Theme's files to override the parent theme. The Independent Publisher Child Theme comes with a few examples to help you get started.

For more information on using Child Themes, see the [WordPress Codex](http://codex.wordpress.org/Child_Themes).

## Known Issues

* If you're using the [W3 Total Cache](http://wordpress.org/plugins/w3-total-cache/) plugin, you must disable the JS/CSS Minify option, as that [doesn't play well with jQuery](http://wordpress.org/support/topic/plugin-w3-total-cache-jquery-conflicts-when-added-to-minify?replies=6), which Independent Publisher makes use of. See also [Issue 46](https://github.com/raamdev/independent-publisher/issues/46#issuecomment-31478382).

## Frequently Asked Questions

### Why is my Header Image not showing on Single posts?

On Single pages, the Gravatar image for the author of the post is shown. The Header Image (**Dashboard → Appearance → Header**) is only shown on non-Single pages.

If there is only one author on your site, you probably want to set the Header Image to be the same as the author Gravatar. (You also probably want the site Tagline, **Dashboard → Settings → General → Tagline**, to be the same as your bio in **Dashboard → Users → Your Profile → Biographical Info**.)

### How do I get the small logo to show up in the top-left corner?

![screen shot 2014-01-22 at 5 56 22 pm](https://f.cloud.github.com/assets/53005/1979978/a4360d06-83b8-11e3-95e6-2fba9c982761.png)

There is a hidden feature called "Multi-Author Mode" that when enabled places the theme Header Image (**Dashboard → Appearance → Header**) in the top-left corner on all Single pages. 

You can enable Multi-Author Mode by adding the following to a Child Theme's `functions.php`:

```
function independent_publisher_is_multi_author_mode() { return true; }
```

The [Independent Publisher Child Theme](https://github.com/raamdev/independent-publisher-child-theme) includes an example in the `functions.php` file.

### How do I make the JetPack Sharing Buttons look better?

If you clear the JetPack Sharing Buttons "Sharing label" field so that it's empty, Independent Publisher will force the sharing buttons to float right and will remove the right padding so that the buttons look nicer.

