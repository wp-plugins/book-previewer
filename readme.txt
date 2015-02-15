=== Book Previewer ===

Contributors:      jhanbackjr
Plugin Name:       Book Previewer
Plugin URI:        http://www.timetides.com/book-previewer-plugin-wordpress
Tags:              books,google,previewer,previews,sample,free,inside
Author URI:        http://www.timetides.com
Author:            James R. Hanback, Jr.
Donate link: 	   http://www.timetides.com/donate
Requires at least: 3.6
Tested up to:      4.1
Stable tag:        1.0.5
License:           GPLv3

Retrieve and display Google Books previews for an ISBN, OCLC, LCCN, or GGKEY you specify on any WordPress page or post.

== Description ==

Book Previewer enables you to use a shortcode to retrieve and display Google Books previews of titles you specify. To use the shortcode, you must have an International Standard Book Number (ISBN), Online Computer Library Center (OCLC) ID, Library of Congress Control Number (LCCN), or Google Play Generated Key (GGKEY) for the title you want to display. Additionally, a Google Books preview of that title must exist.

Features:

* Uses a shortcode and the Google Books Embedded Viewer API to display a free preview for a book you specify
* Includes a “Book Preview” widget that can be used in place of the shortcode
* Includes a text editor button that enables you to insert the majority of the shortcode without typing
* Supports WordPress localization (i18n)
* Supports displaying the preview as an embedded page element, a popup, or a direct link to the title on the Google Books site
* Supports site performance protection mechanisms, including caching of elements and an option to defer loading until the page footer

== Installation ==

This section describes how to install the plugin and get it working.

1. If you have a previous version of Book Previewer installed, deactivate and delete it from the '/wp-content/plugins/' directory
2. Upload the Book Previewer folder to the '/wp-content/plugins/' directory
3. Activate Book Previewer by using the 'Plugins' menu
4. Add the bookpreviewer shortcode to the page or post where you want to display the book preview

== Frequently Asked Questions ==

= Who is this plugin for? =

Book Previewer is designed to enable authors and publishers to provide free previews of their book titles on their own WordPress sites. All previews are retrieved by using the Google Books Previewer API.

= Why would I use this plugin instead of the Google Books Preview Wizard? =

The primary reason would be because it's simpler to use the shortcode within WordPress than to revisit, regenerate, copy, and paste scripts from the Google Books Preview Wizard page. That said, the plugin is most convenient for sites that have multiple titles for which to display Google previews. If you have only a single title and are not likely to add more, the Google Books Preview Wizard is available here:

https://developers.google.com/books/docs/preview-wizard

= What are the terms for using this plugin? =

By installing and using this plugin, you agree to allow the plugin to display Google Books branding (including images and text) on your WordPress site. If you do not agree to these terms, you cannot use the plugin.

= Must my book be in the Google Books Partner Program to use this plugin? =

Yes. This plugin displays book previews by using the Google Embedded Viewer API. In order to use Book Previewer, your title must be available for preview through Google Books/Google Play. If you are not a Google Books/Google Play author or publisher, this plugin will be of no use for displaying free samples of your titles.

= How do I configure the shortcode to preview a specific title? =

Issue the `[bookpreviewer idtype="`idtype`" bookid="`bookid`" previewer="`previewer`"]` shortcode in any page or post, where "idtype" is `ISBN`, `OCLC`, `LCCN`, or `GGKEY`; "bookid" is the actual ISBN, OCLC, LCCN, or GGKEY of the book you want to preview; and "previewer" is the type of Google Books previewer you want to display.

= That's a lot of typing. Are there any shortcuts to the shortcode? =

Yes. The Book Previewer plugin adds a `bookpreviewer` button to the WordPress Text/HTML editor. A default `bookpreviewer` shortcode with an empty `bookid` parameter is inserted into your page or post when you click that button. 

= Is the `idtype` parameter required? =

No, you are not required to issue the `idtype` parameter with the shortcode. However, if you do not issue the `idtype` parameter, the plugin will configure the `idtype` to ISBN by default.

= What does the book preview look like? =

Depending on how you configure the shortcode's previewer parameter, the previewer can be any of the following:

* `popup`: a Google Preview button that, when clicked, pops up the previewer in an overlay in the center of your site

* `link`: a Google Preview button that, when clicked, redirects the user to the preview as it appears on the Google Books site

* `embedded`: an iframe of a custom width or height that is embedded in a specific area of your site

= I'm using the embedded previewer. How can I control the height and width of it? =

If you have configured the `previewer` parameter as `embedded`, the Google Books previewer will default to a width of 600 pixels and a height of 500 pixels. You can adjust this by issuing the `width` parameter and the `height` parameter with the shortcode. For example, to display an embedded previewer of 300x500 pixels, you could use the following shortcode:

`[bookpreviewer idtype="ISBN" bookid="9781938271168" previewer="embedded" width="300" height="500"]`

The `width` and `height` parameters can also be used to adjust the size of the popup.

= Can I localize the Google Books preview? =

To a certain extent, yes. By using the Book Previewer's `language` parameter along with any of the codes from this page of documentation: https://developers.google.com/books/docs/viewer/developers_guide#Localization 

= I am a Google Books partner and have an established cobrand under that agreement. Can I use my cobrand with this plugin? =

Yes, you can use the Book Previewer shortcode's `cobrand` parameter to specify your Google Books cobrand name/ID.

= What do the options in Book Previewer’s Settings page do? =

There are three options in Book Previewer’s WordPress Settings that can be used to adjust how WordPress performs when Book Previewer is used on your site. These options include:

* `Cache Expires In`: The number of hours allowed to pass before Book Previewer cached information expires and can be refreshed.

* `Defer Until Footer`: This option causes Book Previewer to load all its JavaScript in the footer of your WordPress site rather than the header. Loading scripts in the footer can increase site performance. However, this option only works if your WordPress theme uses the wp_footer function.

* `Clear Cache`: This option removes Book Previewer cached information from your WordPress database. However, this option only works if you are not using a caching plugin. If you are using a caching plugin, you should clear Book Previewer’s cached information by using the caching plugin’s options.

== Upgrade Notice ==

= 1.0.5 =
Adds image width and height parameters for Google Previewer button to improve Page Speed scores.

= 1.0.4 =
Fixes a WP_DEBUG notice that could be displayed on WordPress content types that are not pages or posts.

= 1.0.3 =
Adds responsive setting to improve appearance of embedded previewer on responsive sites.

= 1.0.1 =
Fixes a popup issue that causes unwanted scrolling on parent pages and a lower margin issue with the embedded viewer.

= 1.0 =
This is the first version of the plugin

== Screenshots ==

1. The Book Previewer Settings page
2. The shortcode in a post
3. The plugin in action as a popup button

== Changelog ==

= 1.0.5 =
* Added image width and height parameters for Google Previewer button to improve Page Speed scores
* Changed `bookpreviewer` button in WordPress text editor to the shorter `BPr`

= 1.0.4 =
* Fixed a WP_DEBUG notice that could be displayed on WordPress content types that are not pages or posts
* Added a Donate link to the plugin page
* Updated POT file

= 1.0.3 =

* Added responsive setting to improve appearance of embedded previewer on responsive sites.
* Modified script loading so that scripts are loaded only on the home page or any page/post that contains the bookpreviewer shortcode
* Updated minimum WordPress version to 3.6

= 1.0.1 =

* Fixed an issue with the popup button that could cause unwanted parent page scrolling
* Fixed a lower margin issue with the embedded viewer that could cause it to overlap with elements that follow it on a page.]

= 1.0 =

* Initial release

