=== CSS Email Obfuscator ===
Contributors: nurtext
Donate link: https://blog.kastner.wtf/
Tags: css, email, address, obfuscator, obfuscation, spam, antispam
Requires at least: 3.0
Tested up to: 4.5
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Shortcode for simple email address obfuscation using CSS.

== Description ==

Obfuscate your email address by using a simple shortcode. Because the obfuscation is purely done in CSS, the email address remains readable for screen reader software.

**Usage**

*Email address only:*

`[css-email-obfuscator]you@example.com[/css-email-obfuscator]`

*Clickable email address:*

`[css-email-obfuscator mailto="yes"]you@example.com[/css-email-obfuscator]`

*Clickable email address with custom link text:*

`[css-email-obfuscator mailto="yes" email="you@example.com"]Contact me[/css-email-obfuscator]`

== Installation ==

1. Upload the `css-email-obfuscator` folder to `/wp-content/plugins/`
2. Activate the plugin (CSS Email Obfuscator) through the `Plugins` menu in WordPress
3. Use the shortcode in any post, page or custom post type.

== Frequently Asked Questions ==

= Is JavaScript required to obfuscate the email address? =

No. This solution is purely based on CSS and won't use JavaScript at all.

= Are screen readers able to read the obfuscated email address? =

Yes, because obfuscation is made using pure CSS.

= Is the clickable email address still obfuscated? =

Yes, but due to the limitations of CSS, the contents of the `href` attribute will be encoded as ASCII entities.

= Does the plugin work with punnycode (umlaut) domains in email addresses? =

Yes, as long as your blog's charset is set to UTF-8 (wich is default).

== Screenshots ==

1. Email address only
2. Clickable email address
3. Clickable email address with custom link text

== Changelog ==

= 1.0.0 =
* Initial release

== Upgrade Notice ==

= 1.0.0 =
Inititial release
