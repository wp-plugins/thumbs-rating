=== Thumbs Rating ===
Contributors: quicoto
Tags: rating, thumbs, votes
Requires at least: 3.0
Tested up to: 3.6
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Thumbs Rating does what you'd expect. It allows you to add a thumbs up/down to your content (posts, pages, custom post types...).

== Description ==

I needed a simple and light plugin to add Thumbs Rating, I couldn't find any so I built my own.

This plugin allows you to add a thumb up/down rating to your content. You can set it up to show anywhere you want, check the Installation tab.

The output is very basic, no images, no fonts, no fancy CSS. Customize the ouput overriding the CSS classes in your __style.css__ file.

= Features =

*   Stores the votes values for each content.
*   Uses HTML5 LocalStorage to prevent the users from voting twice.
*   No output printed by default, check the Installation tab.
*   Easy to customize the output using CSS.

= Languages =

*	English
*	Spanish (es_ES)

= Requests =

Feel free to post a request but let's keep it simple and light.

= Patches are welcome =

I welcome any contributions to the plugin. At long as we keep it light and simple.

Add some love on Github https://github.com/quicoto/thumbs-rating

= Ping me =

* [Follow me on Twitter: @ricard_dev](http://twitter.com/ricard_dev). 

== Installation ==

First of all activate the Plugin, then:

A) If you want to show the thumbs after your content (posts, pages, custom post types) paste this snippet at the end of your __functions.php__ file of your theme:

`function thumbs_rating_print($content)
{
	return $content.thumbs_rating_getlink();
}
add_filter('the_content', thumbs_rating_print);`

B) Alternatively you can print the Thumbs in certain parts of your theme. Paste the following snippet wherever you want it to show:

`<?=function_exists('thumbs_rating_getlink') ? thumbs_rating_getlink() : ''?>`

== Frequently Asked Questions ==

= I activated the plugin and nothing happens =

You must specify where do you want to show the thumbs within your theme, check out the Installation instructions.

= Can I customize the colors? =

Absolutely. Check out the CSS within the plugin (__thumbs-rating/css/style.css__) and override the classes from your theme __style.css__ file.

== Screenshots ==

1. Basic output with the default CSS with the TwentyThirteen theme.
2. This text is shown if you try to vote again.

== Changelog ==

= 1.0 =
* First release.

== Upgrade Notice ==

= 1.0 =
First release, you'll love it.
