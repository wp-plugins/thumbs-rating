=== Thumbs Rating ===
Contributors: quicoto
Tags: ratings, thumbs, votes, AJAX, rating, thumb, vote, page, post
Requires at least: 3.0
Tested up to: 3.6
Stable tag: 1.4
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

= Roadmap = 

*   Create shortcode (to use in Widgets, posts, pages...) to show the Top most positive/negative voted posts (filtered by category?)

= Languages =

*	English
*	Spanish: es_ES
*	Catalan: ca
* 	Czech: cs_CZ (by [togur](http://wordpress.org/support/profile/togur))
* 	German: de_DE

Give me a hand and translate the plugin in your language, it's just a few words.

= Requests =

Feel free to post a request but let's keep it simple and light.

= Ping me / Blame me =

Are you using the plugin? Do you like it? Do you hate it? Let me know!

* Twitter: [@ricard_dev](http://twitter.com/ricard_dev)
* Blog: [CodeGround](http://php.quicoto.com/) 

== Installation ==

First of all activate the Plugin, then:

A) If you want to show the thumbs after your content (posts, pages, custom post types) paste this snippet at the end of your __functions.php__ file of your theme:

`function thumbs_rating_print($content)
{
	return $content.thumbs_rating_getlink();
}
add_filter('the_content', 'thumbs_rating_print');`

B) Alternatively you can print the Thumbs in certain parts of your theme. Paste the following snippet wherever you want it to show:

`<?=function_exists('thumbs_rating_getlink') ? thumbs_rating_getlink() : ''?>`

__NOTE__: If you don't want to mess with php files you can use the [Code Snippets](http://wordpress.org/plugins/code-snippets/) plugin (or similar) which allows you to make these changes from within the WordPress Admin without editing your functions.php file.

== Frequently Asked Questions ==

= I activated the plugin and nothing happens =

You must specify where do you want to show the thumbs within your theme, check out the Installation instructions.

= Can I customize the colors? =

Absolutely. Check out the CSS within the plugin (__thumbs-rating/css/style.css__) and override the classes from your theme __style.css__ file.

= When I sort the admin columns some posts disappear =

If the post/page has 0 votes for the column your trying to sort, WordPress hides it.
It only shows the posts/pages with at least +1 or -1 votes.

= How do I show the number of votes in other parts of my theme? =

Paste the following snippets inside the loop:

`<?=function_exists('thumbs_rating_show_up_votes') ? thumbs_rating_show_up_votes() : ''?>`

`<?=function_exists('thumbs_rating_show_down_votes') ? thumbs_rating_show_down_votes() : ''?>`

(Both functions accept the post ID as a parameter in case you need it)

== Screenshots ==

1. Basic output with the default CSS with the TwentyThirteen theme.
2. This text is shown if you try to vote again.

== Changelog ==

= 1.5 =
* Fixed warning in the Admin (only when WP_DEBUG = true).
* Added German de_DE translation.

= 1.4 =
* Improved security: prevent access to the file outside WordPress.
* Improved security: sanatize the parameters we receive from the JavaScript.
* Added two functions to print the thumbs values in your theme.

= 1.3 =
* Added a CSS class to the button after voting and on page load. You can use it to style the button different so the users knows he already voted.  This feature does not apply the CSS class to old votes, just the new ones after updating to the 1.3 version.

= 1.2 =
* Added "Up Votes" and "Down Votes" admin columns (they're shiny and sortable!)
* Deleted translation for: German and French. I used Google Translator and they didn't look correct.
* Updated translatations for: Spanish and Catalan.

= 1.1 =
* Added French, Catalan, German and Czech.

= 1.0 =
* First release.

== Upgrade Notice ==

= 1.4 =
Security update, please read the changelog.

= 1.3 =
You can style the buttons after clicking on them and after reloading the page.

= 1.2 =
Added admin columns: now you can see the number of votes from your admin screen!

= 1.1 =
Added French, Catalan, German and Czech.

= 1.0 =
First release, you'll love it.
