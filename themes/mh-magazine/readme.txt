=== MH Magazine - Responsive WordPress Theme ===
Theme URI: https://www.mhthemes.com/themes/mh/magazine/
Tags: Blog, News, Magazine, Responsive
Requires at least: 4.5.0
Tested up to: 4.9.6
Stable tag: 3.8.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
MH Magazine WordPress Theme, Copyright 2013-2018 MH Themes
MH Magazine is distributed under the terms of the GNU GPL

==================================
Description
==================================

MH Magazine is a clean, modern and fully responsive premium magazine WordPress theme for blogs and news or editorial related websites. The theme includes custom widgets, several page templates and advanced theme options including colorpickers with unlimited colors to create your own color scheme.

==================================
Documentation & Theme Support
==================================

In case you have any questions regarding your WordPress theme, please visit our support center where you can find the theme documentation, tutorials and a lot of helpful information: https://www.mhthemes.com/support/

==================================
Licenses of bundled Resources
==================================

1.) Modernizr 3.5.0 (Custom Build) | MIT license
Source: http://modernizr.com/
License: http://modernizr.com/license/

2.) jQuery FlexSlider v2.5.0 | GPLv2 license and later | Copyright 2012 WooThemes
Contributing Author: Tyler Smith
Source: https://github.com/woothemes/FlexSlider
License: http://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html

3.) SlickNav Responsive Mobile Menu v1.0.7 | MIT license | Copyright 2016 Josh Cope
Source: http://slicknav.com/
License: http://opensource.org/licenses/mit-license.php

4.) Google Webfonts | SIL Open Font License (OFL)
Source: https://www.google.com/fonts
License: http://scripts.sil.org/OFL

5.) Font Awesome Icon Fonts | SIL OFL 1.1 | Code licensed under MIT License
Source: http://fontawesome.io/
License: http://opensource.org/licenses/mit-license.php
License: http://scripts.sil.org/OFL

6.) CSS3 Media Queries support for old browsers | MIT license
Source: https://code.google.com/p/css3-mediaqueries-js/
License: http://opensource.org/licenses/mit-license.php

7.) Images from Theme Screenshot
Source: http://pixabay.com/
License: Free Public Domain (GPL Compatible)
Overview: http://demo.mh-themes.com/magazine/credits/

==================================
Changelog
==================================

= v3.8.5 18-05-2018 =
* Added support for GDPR features in WP 4.9.6
* Updated translation files

= v3.8.4 15-03-2018 =
* Added LinkedIn to collection of built-in share buttons
* Added Frijole font to Google Webfonts collection
* Added print button to easily print post content
* Added CSS styles to hide inappropriate elements for print layout
* Added Apple / iTunes, Viadeo and WhatsApp icon support to social icons menu
* Updated brazilian portuguese translation - thanks to Luis Antonio Paludetti
* Updated german translation
* Updated translation files

= v3.8.3 26-11-2017 =
* Added support for Instagram in author box
* Added Instagram URL input field for user profile in WordPress dashboard
* Added Fira Sans font to Google Webfonts collection
* Removed code to support shortcodes in widgets due to support by default in WP 4.9
* Renamed .mh-ad-spot CSS class to .mh-info-spot to prevent blocking by ad blockers
* Added greek translation files - thanks to Kostas Arvanitidis
* Updated swedish translation - thanks to Torbjörn Palmberg
* Updated german translation
* Updated translation files

= v3.8.2 16-08-2017 =
* Added Medium icon support to social icons menu
* Updated Facebook JavaScript-SDK to v2.9
* Updated Modernizr script to v3.5.0
* Fixed typo in polish translation
* Updated romanian translation - thanks to Celeste K. Godwin

= v3.8.1 04-06-2017 =
* Added CSS to support new core widgets in WordPress 4.8
* Updated bulgarian translation - thanks to Petar Dimitrov
* Updated ukrainian translation - thanks to Yuriy Kaminskiy
* Updated translation files

= v3.8.0 08-05-2017 =
* Several minor CSS fixes, adjustments and improvements
* Improved compatibility with Disqus plugin
* Several modifications and improvements in comments.php
* Comment section now loads WordPress core markup instead of custom callback
* Added function for additional CSS classes in comment section
* Removed comment smooth scroll animation for improved plugin compatibility
* Added support for new product gallery feature in WooCommerce
* Fixed issue with archive ads displaying on WooCommerce shop page
* Combined functions for post meta data into mh_magazine_post_meta()
* Moved deprecated function mh_magazine_loop_meta() to mh-compatibility.php
* Moved deprecated function mh_magazine_comments() to mh-compatibility.php
* Highlighted dates with posts in WordPress Calendar widget
* Added norwegian (nynorsk) translation - thanks to Audun Skjervøy
* Updated polish translation - thanks to Andrzej Warzecha
* Updated german translation
* Updated translation files

= v3.7.0 05-03-2017 =
* Added full-width template support for posts
* Added Email & Spotify icons to social icons menu
* Improved encoding for built-in share buttons
* Improved styling for multisite registration form
* Fixed alignment of images in navigation menu (e.g. flags from multilingual plugins)
* Updated Font Awesome Icon Fonts to v4.7.0
* Added turkish translation files - thanks to Türker Yildirim
* Updated brazilian portuguese translation - thanks to Luis Antonio Paludetti
* Updated russian translation - thanks to Vitaly
* Updated italian translation - thanks to Filippo Rizzi
* Updated german translation
* Updated translation files

= v3.6.1 03-01-2017 =
* Several minor CSS fixes, adjustments and improvements
* Replaced pagination on archives with WordPress core function the_posts_pagination()
* Removed redundant option to scale background image (core functionality in WP 4.7)
* Improved footer to display columns based on active number of footer widget areas
* Changed theme related links in WordPress dashboard to HTTPS
* Added backwards compatibility for custom CSS field in mh-compatibility.php
* Added custom CSS field only if it contains data (core functionality in WP 4.7)
* Added option to hide image caption with category name for posts on archives
* Improved included child theme to load RTL stylesheet of parent theme if enabled
* Added lithuanian translation files - thanks to Juras Rabačauskas
* Updated dutch translation
* Updated german translation
* Updated translation files

= v3.6.0 30-10-2016 =
* Several minor design fixes, adjustments and improvements
* Added new function mh_magazine_loop_layout() to handle archive layouts
* Added new archive layout to display large post and then list of posts (Layout 3)
* Added new archive layout to display grid of posts (Layout 4)
* Added new archive layout to display dynamic variation of posts (Layout 5)
* Added 4 new layouts for widget titles
* Added option to disable / hide tags on posts
* Added Quicksand font to Google Webfonts collection
* Added new function mh_magazine_copyright_notice() to handle footer copyright notice
* Added dismiss button to welcome notice in WordPress dashboard
* Added new theme support section within theme options panel in customizer
* Added excerpts to posts in MH Posts Grid widget
* Added options to display post meta and excerpts to MH Posts Grid widget
* Added has_category() check in template parts where appropriate
* Added Jetpack Infinite Scroll support for new archive layouts
* Improved function mh_magazine_infinite_scroll_render() to support archive layouts
* Improved handling of content on archives by reusing existing template parts
* Improved handling of advertisements on archives (including new archive layouts)
* Fixed rare syntax error message with older PHP versions before PHP 5.3
* Removed role attribute for nav and aside elements to fix warnings in W3C validation
* Removed redundant files content-loop-layout1.php and content-loop-layout2.php
* Removed redundant file mh-customizer.js
* Improved handling of ads on archives / within loop to avoid inclusion in feeds
* Improved structured data for custom logo to fix error in rich snippet testing tool
* Improved way of loading stylesheet for included child theme
* Updated theme screenshot of included child theme
* Updated content on theme info page in WordPress dashboard
* Updated brazilian portuguese translation - thanks to Luis Antonio Paludetti
* Updated german translation
* Updated translation files

= v3.5.0 17-09-2016 =
* Improved HTML semantics for several elements
* Improved header.php to load pingback URL only on posts
* Improved structured data in header to ensure W3C validation for custom logo
* Implemented additional structured data for better SEO
* Fixed 1px resizing issue of medium sized thumbnails in Home 3 / Home 4
* Fixed W3C validation for custom widgets in case of duplicate posts (post IDs)
* Fixed minor alignment issue with icons for menu items in navigation
* Added minor CSS tweaks to support WP User Avatar plugin (Gravatar alternative)
* Improved readability of list items in content area on posts and pages
* Added support for image, gallery, video and audio post formats
* Added support for icons on thumbnails based on post formats
* Added function to remove hentry CSS class from pages and custom widgets
* Added function to handle conditional CSS classes for grid of posts
* Removed redundant conditional tag in mh_magazine_scripts()
* Replaced random with latest posts on 404 page to avoid performance issues
* Improved archive.php to avoid duplicate author bio on author archives in WP 4.7
* Updated content on theme info page in WordPress dashboard
* Updated WordPress theme tags
* Added russian translation files - thanks to Denis
* Added arabic translation files - thanks to Salam Waddah
* Updated japanese translation - thanks to Noriko Oseko
* Updated brazilian portuguese translation - thanks to Luis Antonio Paludetti
* Updated french translation - thanks to Didier Demory
* Updated german translation
* Updated translation files

= v3.4.0 23-07-2016 =
* Several design adjustments and improvements
* Updated WordPress theme tags
* Added theme support for custom logo (introduced in WP 4.5)
* Changed position of custom header image to support additional custom logo feature
* Improved handling of Header 2 widget area for more flexibility
* Improved header navigation to display menu on mobile as well
* Added option to enable/disable transparent header
* Added notices to widget areas on Homepage template if no widgets have been placed
* Added notices to widget areas on WooCommerce pages if no widgets have been placed
* Added function to change default prefix of titles on archives
* Added new file mh-compatibility.php to handle backwards compatibility
* Added new file image.php to handle / display image attachments
* Added new files archive.php and search.php
* Added .mh-navigation class to optimize and improve CSS for navigation menus
* Added icons for menu items to indicate if menu items have sub-menus
* Added fields for LinkedIn and Xing to user profile in WordPress dashboard
* Added support for LinkedIn and Xing icons in author box
* Added email to friend button to share buttons on posts
* Added several fixes and improvements to comments.php
* Added thumbnails and post titles to post / attachment navigation
* Restyled author box, comment section and share buttons
* Improved markup and semantics for image attachments
* Improved JS performance of back to top button - thanks to Bernhard Kau
* Moved deprecated function mh_magazine_page_title() to mh-compatibility.php
* Removed deprecated file content-attachment.php (replaced by image.php)
* Updated SlickNav Mobile Menu to v1.0.7
* Updated Font Awesome Icon Fonts to v4.6.3
* Updated Modernizr script to v3.3.1
* Added portuguese translation files - thanks to José Ribeiro
* Added norwegian (bokmål) translation files - thanks to Jan Sandtrø & Ben Ormstad
* Updated german translation
* Updated translation files

= v3.3.1 31-05-2016 =
* Several minor design adjustments and improvements
* Added notice to sidebars and Home 12 widget area if no widgets have been placed
* Added Play and Quantico to collection of Google Webfonts
* Removed hentry class from custom widgets to prevent notices in GWT
* Changed links for social share buttons on posts to HTTPS
* Fixed user selection in MH Author Bio widget to display applicable users only
* Improved escaping of data in breadcrumbs
* Updated Facebook JavaScript-SDK to v2.6
* Added czech translation files - thanks to Aleš Bažout
* Added finnish translation files - thanks to Ville Polvela
* Updated polish translation - thanks to Andrzej Warzecha
* Updated french translation - thanks to Benjamin Bonhore
* Updated brazilian portuguese translation - thanks to Luis Antonio Paludetti
* Updated german translation
* Updated translation files

= v3.3.0 09-04-2016 =
* Minor CSS adjustments
* Fixed issue with date in header displaying in english language only
* Added workaround to fix 1px offset FlexSlider issue
* Added author name to posts on archives for better structured data
* Added selective refresh support for widgets (introduced in WP 4.5)
* Updated translation files
* Updated brazilian portuguese translation - thanks to Luis Antonio Paludetti
* Updated german translation

= v3.2.1 09-03-2016 =
* Minor CSS adjustments
* Fixed displaying issues with MH Posts Stacked widget in Chrome browser
* Updated theme screenshot

= v3.2.0 04-03-2016 =
* Several minor design adjustments and improvements
* Fixed issue where font size of tag cloud could not be modified in child themes
* Fixed issue with alt tag of image placeholders not being translatable
* Fixed minor alignment issues in RTL (Right-to-Left) layout
* Fixed incorrect padding for copyright notice when wide layout is enabled
* Several improvements for color options
* Renamed mh-options.php file to mh-customizer.php
* Decreased speed of MH Slider and MH Carousel widgets to 7000ms
* Reorganized layout options into separate sections
* Removed redundant options to enable/disable ticker and header search field
* Added 26 new fonts to Google Webfonts collection
* Added 2 new additional layouts for MH Slider widget
* Added support for new slider layouts to MH Custom Slider widget
* Added new additional layout for widget titles
* Added helpful links to theme options panel in customizer
* Added formatting support for descriptions on archives
* Added styling for WordPress RSS feed widget
* Added options to display content in header bars (top/bottom)
* Added optional date to header bar (top/bottom)
* Added optional news ticker to header bar (top/bottom)
* Added optional search to header bar (top/bottom)
* Added optional navigation to header bar (top/bottom)
* Added optional social icons to header bar (top/bottom)
* Added option to enable/disable caption with category name to several widgets
* Added MH Posts Stacked widget to display block with stacked posts
* Added MH Posts Horizontal widget to display small posts as horizontal grid
* Added MH Posts Digest widget to display an overview of posts
* Added MH Posts Focus widget to display 5 posts with focus on large post
* Added MH Posts Lineup widget to display featured post and list with additional posts
* Added MH Category Columns widget to display posts from specific categories
* Removed redundant HTML markup for stacked social icons
* Updated theme screenshot
* Fixed error in italian translation file (Cerca instead of Serca)
* Updated dutch translation - thanks to Jos van Oyen
* Updated brazilian portuguese translation - thanks to Luis Antonio Paludetti
* Updated romanian translation
* Updated german translation
* Updated translation files

= v3.1.0 16-12-2015 =
* Overall code maintenance
* Fixed issue with WordPress comments appearing on BuddyPress pages
* Fixed issue with unapproved comments displaying in MH Tabbed widget 
* Fixed incorrect placeholder image for MH Spotlight widget
* Fixed minor inconsistencies with changes through color options
* Fixed issue with pagination of paginated posts displaying in excerpts of widgets
* Fixed issue with max-width of main container in wide layout when two sidebars enabled
* Fixed issue with links in comments that were not highlighted anymore
* Fixed HTML5 validation notices for Google Webfonts
* Minor CSS fixes for right-to-left layout (rtl.css)
* Adjusted margins in comment form to support new layout in WordPress 4.4
* Improved handling of excerpts when more-tag is present
* Added missing structured data (hentry) on archives
* Added options to MH Tabbed widget to set number of posts, tags and comments
* Added option to MH YouTube Video widget to enable autoplay
* Added option to MH YouTube Video widget to display video title / information
* Added option to MH YouTube Video widget to display player controls
* Added option to MH YouTube Video widget to enable recommended videos
* Modified iframe of MH YouTube Video widget to allow fullscreen mode
* Escaped all translation strings in theme customizer
* Removed duplicate IDs for MH Slider and MH Carousel widgets (fixed W3C warning)
* Updated brazilian portuguese translation - thanks to Luis Antonio Paludetti
* Updated italian translation - thanks to Vakhtang Naskidashvili
* Updated german translation
* Updated translation files

= v3.0.0 21-10-2015 =
* Recoded and optimized codebase for widgets, functions and template files
* Increased site width from 980px/1300px to 1080px/1431px
* Improved responsive layout on mobile devices
* Improved styling and added several CSS adjustments
* Improved markup and semantics on posts/pages
* Reorganized custom hooks in functions.php
* Renamed page template files to improve consistency
* Renamed image placeholder files to improve consistency
* Changed theme folder name to mh-magazine
* Changed text domain to mh-magazine
* Optimized functions to easily unhook in child themes
* Replaced and restyled social buttons on posts
* Fixed incorrect string for post count in author box
* Redesigned author box on posts
* Redesigned related content to display grid of posts
* Prefixed grid to improve plugin compatibility
* Improved handling of site title and tagline for better SEO
* Improved function for Google Webfonts to load fonts via HTTPS
* Improved and reorganized options panel in customizer
* Improved handling of slider and carousel widgets
* Improved and redesigned MH Social widget to support Font Awesome icons
* Improved options to enable/disable post meta data
* Improved names of widget areas for better usability
* Improved breadcrumb navigation to display parents of parent pages
* Improved existing color options and added new color options for more flexibility
* Moved color options to separate file/functions for better handling in child themes
* Moved typography options from file mh-options.php to mh-google-webfonts.php
* Added HTML5 markup support for search form, comments, gallery and image captions
* Added Google Webfonts character subsets for arabic, hebrew and vietnamese language
* Added several new Google Webfonts to fonts collection in customizer
* Added search box to header right next to news ticker
* Added option to hide search box in header
* Added back to top button to easily scroll back to top of the site
* Added option to enable/disable back to top button
* Added link to comment count to refer to comment section
* Added date to small posts in MH Custom Posts widget
* Added MH Author Bio widget to display user information in sidebar
* Added MH Posts Grid widget to display a grid of posts including thumbnails
* Added MH Posts Large widget to display a list of large sized posts
* Added MH Posts List widget to display a list of posts including thumbnails
* Added MH Tabbed widget to display latest posts, tags and comments
* Added category name to MH Slider (Layout 2) widget
* Added new additional style (Layout 3) for MH Slider widget
* Added widget area for advertisements in header next to logo
* Added hooks to header/footer for flexible layouts within child themes
* Added custom menu slot for social icons in header
* Added custom menu slot for social icons of MH Social widget
* Added option to MH YouTube Video widget to link title to custom URL
* Added support for Font Awesome icons v4.4.0
* Added CSS classes based on widgets to widget areas for flexible styling
* Added header navigation and social icons above header
* Added separate panel for theme options in customizer (introduced in WP 4.0.0)
* Changed excerpt length from characters to words for better support of exotic languages
* Removed modified wp_trim_excerpt(); function to improve support for 3rd party plugins
* Removed redundant social icons / image files
* Removed redundant layout options (due to improvements or new functionality in WP 4.3)
* Removed redundant files comments-pages.php, author.php and searchform.php
* Removed redundant custom controls for WP customizer
* Removed redundant MH Advertising widget (text widget can be used instead)
* Removed redundant MH Affiliate widget (text widget can be used instead)
* Removed option to add favicon in favor of Site Icon feature in WP 4.3
* Removed optional teaser text on posts
* Removed backwards compatibility of title tag (introduced in WP 4.1)
* Updated image dimensions to support increased site width
* Updated jQuery FlexSlider to v2.5.0
* Updated SlickNav Mobile Menu to v1.0.3
* Updated child theme files to support renamed template
* Updated grid in MH Magazine Shortcodes plugin
* Updated theme screenshot with new version
* Added romanian translation - thanks to Alice Calin
* Added indonesian translation files - thanks to Widiyanto Saputro
* Updated brazilian portuguese translation - thanks to Luis Antonio Paludetti
* Updated german translation
* Updated translation files

= v2.4.3 29-07-2015 =
* Several minor design improvements
* Updated constructor method for WP_Widget to fully support WordPress 4.3.0

= v2.4.2 27-06-2015 =
* Added missing escaping where necessary
* Added CSS class to image placeholders
* Added CSS class to body tag to replace redundant functions for sidebar position
* Added theme support for title tags (introduced in WP 4.1)
* Improved homepage template (Home 6 changes position like regular sidebar)
* Improved author box to allow HTML in author bio

= v2.4.1 27-05-2015 =
* Overall improved markup and code structure
* Improved sanitization of options in customizer
* Moved post titles on archives (layout 1) next to thumbnails
* Moved built-in shortcodes to MH Magazine Shortcodes plugin
* Added MH Magazine Shortcodes plugin to /add-ons folder
* Replaced default logo with new version
* Updated MH Affiliate widget with new banner
* Removed redundant banners of MH Affiliate widget
* Updated theme screenshot
* Updated child theme with new theme screenshot
* Added croatian translation files - thanks to Emir Kurtovic
* Updated brazilian portuguese translation with some corrections
* Updated french translation - thanks to Florent Guignard
* Updated german translation
* Updated translation files

= v2.4.0 20-04-2015 =
* Minor CSS adjustments
* Improved handling of responsive embeds
* Added proper copyright attribution to readme.txt
* Added MH Facebook page widget (replaced MH Facebook likebox widget)
* Removed MH Facebook likebox widget (deprecated from June 23rd 2015)
* Updated Facebook SDK
* Updated child theme to load stylesheet with wp_enqueue_scripts() instead of @import
* Updated translation files
* Updated german translation

= v2.3.1 31-03-2015 =
* Fixed small CSS issue with copyright notice on some mobile devices

= v2.3.0 20-03-2015 =
* Several minor CSS adjustments
* Fixed issue with footer navigation if no footer content exists
* Fixed issue where category filter for news ticker did only accept one category ID
* Fixed small syntax error in mh_head_misc();
* Replaced theme screenshot
* Removed theme dashboard widget (replaced by theme info page)
* Added licensing information for images on theme screenshot
* Added theme info page to WordPress dashboard
* Added conditional for caption in MH Spotlight widget to check if title exists
* Added option to MH Spotlight widget to filter multiple categories by ID
* Added wpml-config.xml for future WPML compatibility
* Added MH YouTube widget to easily display responsive YouTube videos
* Added minor improvements to responsive layout
* Improved sanitization of data in custom widgets
* Improved handling of options in MH Facebook Likebox widget
* Improved function for prev/next post links to prevent unnecessary markup
* Improved function for breadcrumb navigation
* Included css3-mediaqueries.js because Google Code will cease operations
* Updated theme description
* Updated strings in translation files
* Updated german translation
* Updated brazilian portuguese translation - thanks to Luis Antonio Paludetti
* Added bulgarian translation files - thanks to Red Line Group ltd.

= v2.2.1 20-12-2014 =
* Improved handling of options for customizer in WP 4.1
* Fixed issue with audio attachments on attachment page
* Moved child theme to add-ons folder
* Added ukrainian translation files - thanks to Nestor

= v2.2.0 02-12-2014 =
* Minor CSS adjustments
* Fixed issue with colors of caption text in galleries
* Fixed another issue with content width on full-width page template
* Improved responsive layout for smartphones in landscape mode
* Improved validation for custom excerpt length
* Improved validation for custom font size (added fallback)
* Improved handling of FlexSlider
* Improved function for titles to support custom post types
* Simplified function for post / image navigation
* Added conditional for pagination markup
* Added support for Jetpack Infinite Scroll
* Added brazilian portuguese translation - thanks to Luis Antonio Paludetti
* Added dutch translation - thanks to Yves Wens
* Updated spanish translation - thanks to Xavier Lopez
* Updated italian translation - thanks to Vakhtang Naskidashvili

= v2.1.0 26-08-2014 =
* Several code improvements and CSS adjustments
* Reorganized file structure
* Reorganized and improved options panel
* Added CSS class to teaser text on posts for better styling
* Fixed issue with repeating teaser text on paginated posts
* Fixed issue with repeating featured image on paginated posts
* Fixed issue with $content_width variable when using full page template
* Fixed issue where image captions were not shown for gallery images
* Fixed issue where custom admin scripts were loaded on every admin page
* Improved navigation on mobile devices
* Improved responsive layout / handling of second sidebar
* Improved handling of page titles
* Improved author box function to prevent plugin conflicts
* Improved readability of footer copyright notice
* Improved functions/filters to handle ads on posts and archives
* Improved MH Recent Comments widget to not display trackbacks anymore
* Improved alignment of images
* Improved implementation of native WordPress gallery
* Improved support for WooCommerce 2.1
* Improved support for Contact Form 7
* Improved appearance of <input> elements on mobile and desktops
* Improved styling of news ticker
* Improved title of news ticker (is now optional and can be disabled)
* Improved implementation of Google Webfonts
* Improved color options
* Removed integration of prettyPhoto lightbox (plugin recommended)
* Removed optional slider on category archives (will be replaced with better solution)
* Removed redundant option to set site width to 1300px (depends on sidebars now)
* Added prefix to important CSS classes to improve plugin compatibility
* Added option to link featured image to attachment page
* Added option to MH Custom Slider widget to open links in new browser window / tab
* Added styling for default WordPress pages widget
* Added two more fonts to collection of Google Webfonts
* Added option to disable Google Webfonts
* Added option to choose character sets (subsets) for Google Webfonts
* Added option to modify imported font styles of Google Webfonts
* Added nofollow-tag to footer credit link
* Replaced the_title() with the_title_attribute() for link title attributes
* Reduced HTML markup of loop output
* Updated Modernizr script to latest version (v2.8.3)
* Updated FlexSlider to latest version (v2.2.2)
* Changed FlexSlider from fade to slide due to temporary bug in FlexSlider (v2.2.2)
* Updated readme.txt with licenses of bundled resources
* Updated stylesheet for RTL languages (rtl.css)
* i18n improvements for better translations
* Added japanese translation file
* Added .pot file for easier translations
* Updated translation strings
* Updated german translation
* Updated spanish translation - thanks to Xavier Lopez

= v2.0.3 11-06-2014 =
* Reduced font size for blockquotes
* Several small improvements of responsive layout
* Added 404 template for improved handling of 404 errors
* Stopped duplicate loading of jQuery migrate
* Updated text of theme support dashboard widget
* Theme support dashboard widget will now only be shown for site admins
* Added danish translation - thanks to Niklas Andersen

= v2.0.2 29-03-2014 =
* Improved plugin compatibility
* Removed redundant [heading] shortcode
* Some small CSS adjustments

= v2.0.1 24-03-2014 =
* This is a maintenance update to improve the theme codebase and compatibility
* Fixed color option to change border-color of MH Carousel widget (Layout 1)
* Moved SEO options to optional child theme (recommended plugin: WordPress SEO by Yoast)
* Moved option to enable breadcrumbs from "SEO Options" to "Posts/Pages Options"
* Redesigned layout for archives (Layout 3)
* Changed size of small thumbnails back to 70x53px
* Switched to WordPress internal jQuery version

= v2.0.0 17-03-2014 =
* Several small code improvements and CSS adjustments
* Added custom excerpt support for pages
* Added MH Custom Pages widget to display pages based on page IDs
* Added optional slider for use on category pages
* Added option to set number of slides for category pages
* Added new layout option to set layout for category slider
* Added new layout option to enable sidebars
* Removed depreciated option to enable second sidebar
* Added new layout option to select responsive or fixed layout
* Removed depreciated option to disable responsive layout
* Added option to several custom widgets to filter posts by multiple categories
* Added option to link title of MH Custom Posts widget to custom URL
* Added MH Custom Slider widget to display custom content in slider
* Added option to ignore sticky posts for news ticker
* Improved slider widgets can now be used multiple times per page
* Improved slider shortcode can now be used multiple times per page
* Improved options for several custom widgets
* Improved handling of page title layouts
* Improved loading of stylesheet to prevent caching issues after theme updates
* Improved implementation of custom header support
* Custom header can now display a logo and site title / tagline at the same time
* Added option to change color of site title / tagline for custom header
* Added new additional layout (grid) for archives
* Increased size of small thumbnails to 80x60px
* Combined options to display social buttons on posts to one single option
* Combined options to display author box to one single option
* Combined options to display related articles to one single option
* Removed redundant [quote] shortcode
* Moved option to scale background from "General Options" to "Background Image Options"
* Moved option to disable prettyPhoto from "General Options" to "Posts/Pages Options"
* Updated translation strings
* Updated german translation

= v1.9.1 23-01-2014 =
* Several code improvements and CSS adjustments
* Changed theme tag flexible-width to responsive-layout (new in WP 3.8)
* Changed theme screenshot size to 880x660px due to new WordPress recommendations
* Optical improvements for breadcrumb navigation
* Fixed post title will no longer have border if no subheading is set
* Fixed color option to change link color now only affects links on posts and pages
* Fixed MH Slider Widget layout 2 navigation issues in Safari browser
* Fixed author box will no longer be displayed on attachments
* Fixed issue where MH Advertising widget did not output JavaScript properly
* Improved excerpts will now display more-link also for manual excerpts
* Improved 404 page template (content-none.php)
* Improved sitemap template (sitemap.php)
* Improved styling of header image / logo fallback
* Updated text of theme support dashboard widget 
* Added new file sidebar.php
* Added new additional layout for archives
* Properly hooked wp_link_pages() to fix issue with paginated posts
* Replaced jQuery Migrate v1.2.1 with minified version for better performance
* Updated translation strings
* Added polish translation - thanks to Elik Kamedula

= v1.9.0 12-12-2013 =
* Several CSS adjustments
* Improved responsive layout
* $content_width variable will now be set properly depending on site width
* Added featured image size to media gallery selection
* Added support for WooCommerce plugin
* Added widgetized sidebar on WooCommerce pages (only when plugin is active)
* Added option to disable featured image for specific posts
* Added options to disable date and comments for MH Custom Posts widget
* Added option to disable comments for MH Spotlight widget
* Added options to disable date, author, category and comments in post meta
* Added option to change position of share buttons on posts
* Added option to change layout of author box
* Added new additional layout for author box
* Added authors template to list all authors on a page
* Added option to change layout of MH Slider & MH Carousel widget
* Added new additional layout for MH Slider & MH Carousel widget
* Added option to disable large thumbnails in MH Custom Posts widget
* Added option to disable small thumbnails in MH Custom Posts widget
* Added additional navigation below main navigation menu
* Added Asap font to Google Webfonts collection
* Added MH Advertising widget to display ads (Square Buttons) very easily
* Changed color of widgets in admin dashboard to match design of WP 3.8
* Updated mh_page_title() does now support custom taxonomies
* Updated MH Affiliate widget to support Creative Market Affiliate Program
* Updated dashboard theme support widget with Creative Market access
* Updated markup for Facebook like button
* Updated translation strings

= v1.8.6 10-11-2013 =
* Fixed issue where disabling the prettyPhoto lightbox produced an error
* Fixed issue where author name was not displayed properly on author archives
* Fixed issues with news ticker markup
* Changed title of spotlight widget from H1 to H2
* Changed default excerpt length to 175 characters
* Replaced cp_large thumbnail for Facebook Open Graph with spotlight thumbnail
* Added option to change layout of archives / loop
* Added option to change layout of widget titles
* Added option to change layout of page titles
* Added option to change layout of related articles
* Added Tumblr and deviantART icons to social widget
* Added affiliate widget so users can earn money by promoting MH Themes
* Updated jQuery to v1.10.2
* Added italian translation
* Updated translation strings

= v1.8.5 28-10-2013 =
* Several code improvements
* Improved readability of typography
* Reorganized file structure to improve performance
* Added "Theme Support" dashboard widget to WordPress admin
* Removed option to change layout - layouts will be available as separate themes
* Fixed issue where shortcodes for content ad on posts did not work
* Removed option to change position of share buttons
* News in Pictures widget now only displays posts which have a featured image
* Improved [box] shortcode / new attributes "toggle" and "height"
* Highlighted MH widgets with a darker color in WordPress admin 
* Added multi-purpose [slider] shortcode to insert e.g. custom image sliders
* Added [testimonial] shortcode to display styled testimonials
* Added some useful theme action hooks
* Added breadcrumb rich snippet support
* Added swedish translation - thanks to Joel Sannemalm
* Added hebrew translation - thanks to Yosi Avneri

= v1.8.1 25-09-2013 =
* Several CSS adjustments
* Improved options panel of several widgets for better usability
* Improved responsive layout for "MH Custom Posts" widget
* Added option to several widgets to ignore sticky posts
* Added option to several widgets to select a category
* Added option to several widgets to set custom excerpt length
* Added option to "MH Spotlight" widget to change image size
* Added option to "MH Spotlight" widget to disable excerpt
* Added option to "MH Spotlight" widget to disable post meta
* Title of "MH Custom Posts" widget will now link to category archive
* Improved handling of automatic excerpts
* Changed option for excerpt lengths from words to characters
* Removed option to use more-tag for excerpts
* Added option to enter custom more text for excerpts
* Moved CSS for RTL support to separate stylesheet rtl.css
* Changed image size of small thumbnails back to 70x53px
* Custom CSS won't be included anymore if font size is set to default
* Updated french translation - thanks to Olivier Copetto
* Updated translation strings

= v1.8.0 16-09-2013 =
* Several code improvements
* Several CSS adjustments
* Improved typography
* Changed default font from Droid Sans & Droid Serif to Open Sans
* Converted font-sizes from % to rem
* Removed Customizer link in appearance menu because it's now default in WP 3.6
* Renamed responsive [video] shortcode to [flexvid] due to conflicts in WP 3.6
* Added new file loop.php to handle content output of loop / archives
* Added new options section for typography settings
* Added option to choose from a selection of Google Webfonts for headings and body text
* Added option to change default font size on posts and pages
* Added new options section for advertising settings
* Added option to display ads after every x posts on archives
* Added new options section for layout settings
* Added option to select a different layout / CSS styling
* Added option to increase site width to 1300px
* Added option to enable a second sidebar (will force site width to 1300px)
* Featured image on posts will be replaced by slider image size if site width is 1300px
* Slightly changed responsive layout to support new large site width
* Slightly changed layout of "Homepage" template and added "Home 11" widget area
* Removed "Homepage 2" template because same can now be done with "Homepage" template
* Added "Home 12" widget area to "Homepage" template if site width is 1300px
* Added "Contact 2" widget area for contact template when second sidebar is enabled
* Position of sidebar on default page template can now be changed
* Removed "Page - Left Sidebar" template because it does not make sense anymore
* Breadcrumb navigation does now support custom post types
* Added "entry-title", "author" and "updated" structured data for Google Rich Snippets
* Added option to "MH Slider Widget" to change slider image size
* Removed option of "MH Custom Posts" widget to enable mobile excerpts - it's useless now
* Increased image size of small images on "MH Custom Posts" widget to 100x75px
* Increased image size of "MH News in Pictures" widget to 100x75px
* Removed date in post meta of "MH Custom Posts" widget (small size)
* Main content now always will be displayed first before sidebars on mobile devices
* Updated translation strings

= v1.7.6 23-07-2013 =
* Slightly changed markup of slider to solve issue if caption contains links
* Fixed issue where widget areas on posts/pages did not work since v1.7.5
* Added fallback in case that no main navigation/menu is set
* Improved breadcrumbs by adding parent categories on category archives
* Fixed content ad now will be displayed properly if paragraphs are HTML formatted
* Reduced the number of HTTP requests to improve performance
* Updated translation strings

= v1.7.5 12-07-2013 =
* Several small CSS adjustments
* Several code improvements
* Changed image ratio of spotlight and carousel widget to 16:9
* Main color of fonts is now darker
* Increased size of dropcap a bit
* Added responsive header and footer navigation menu
* Added option to custom posts widget to enable responsive excerpts
* Disabling post meta now affects archives too
* Fixed some small CSS issues with the RTL layout
* Improved handling of long titles in navigation
* Added fallback in case that no header image is set
* Added [video] shortcode to embed responsive videos
* Added jQuery migrate plugin to restore deprecated and removed functionality
* Added function to take care of page title output
* Added filter to output wp_title()
* Added missing <li> tags to social widget
* Added navigation with previous/next links to single post and attachment view
* Added option to enable navigation links on posts / attachments
* Combined breadcrumb options to one single option (enable/disable)
* Improved breadcrumb output
* Select elements with long texts will no longer be cut off
* Removed markup of footer when no footer widgets are active
* Updated translation strings

= v1.7.1 20-06-2013 =
* Switched back to 4:3 image ratio for large images of custom posts widget
* Changed default excerpt length to 60 words
* Improved media queries for custom posts widget
* Code improvements
* Updated translation strings

= v1.7.0 18-06-2013 =
* Code improvements
* Improvements in layout, design and font-size
* Changed order of related posts from date to random
* Changed file structure to prepare for implementation of post formats
* Changed layout of custom posts widget
* Extended options of custom posts widget to display excerpts for every post
* Extended options of slider and spotlight widget to display random or popular posts 
* Added option to disable post meta
* Added option to disable post meta of custom posts widget
* Updated Facebook Likebox code to new version
* Added options to disable faces, stream, header and border of Facebook Likebox widget
* Added option to upload a favicon
* Added option to enable comments on pages (disabled by default)
* Added feature to display teaser text at the beginning of posts
* Added option to disable teaser text on posts
* Added option to use more-tag instead of automatic excerpts
* Added option to social widget to open links in new window / tab
* Added option to social widget to set links to nofollow
* Replaced icons of social widget - thanks to G. Pritiranjan Das
* Added YouTube, Flickr, Vimeo, SoundCloud, Pinterest, Instagram, Myspace to social widget
* Removed Xing from social widget
* Reduced amount of image ratios to two (4:3 and 1:2.35)
* Fixed rel="prettyPhoto" now will be added automatically
* Added option to disable prettyPhoto lightbox
* Comments and pingbacks / trackbacks are now displayed separate
* Added caption text to featured images on posts
* Improved output of alt and title of featured images on posts
* Improved output of image captions
* Improved support for post attachments
* Fixed links of carousel widget now work on mobile devices
* index.php is now more generic and has replaced several archive templates

= v1.6.0 17-05-2013 =
* Some minor code improvements
* Some minor CSS adjustments
* Added SEO option to set several archives to noindex to prevent duplicate content
* Added SEO option to set attachments to noindex
* Added option to verify site for Google Webmaster Tools
* Added comments support on static pages
* Replaced theme logo and theme screenshot in wp dashboard
* Fixed og:type now gets correct data on archives
* Fixed og:title now gets correct data on archives
* Fixed authorbox now gets properly displayed on author archives
* Moved child theme files to parent folder to prevent upload issues using wp uploader
* Updated spanish translation - thanks to Samuel Galiano Parras
* Updated translation strings
* Replaced changelog.txt with readme.txt

= v1.5.0 22-04-2013 =
* Removed unused tags for page title on index.php when no static front page is set
* Enabled threaded comments in functions.php instead of header.php
* Some minor CSS improvements
* Several code improvements
* Fixed CSS after Contact Form 7 plugin update
* Fixed CSS ordered lists
* Fixed message box animation
* Fixed automatic formatting of shortcodes
* Reorganized theme options
* Removed option to set social language because theme recognizes automatically now
* Added posts/pages options section
* Added SEO options section
* Added SEO option to set a custom meta description on posts/pages
* Added SEO option to use post tags as meta tags/keywords
* Added SEO option to set meta keywords manually for each post/page
* Added SEO option to set a seo optimized title tag on posts/pages
* Added SEO option to set Google Publisher Page
* Added SEO option to clean up head section from "junk"
* Added Google Authorship support
* Added Facebook Open Graph support
* Added option to display content ads on posts
* Added option to disable featured image on posts
* Added option to disable images on custom posts widget
* Added option to recent comments widget to change size of avatars
* Added widget area/sidebar on contact page template
* Added new widget to display authors including the number of posts published
* Added new widget to display linked social media icons
* Added new fields to user profile (Facebook, Twitter, Google+, YouTube)
* Added contact information of authors to author box
* Added option to disable author box on posts/archives
* Added option to hide contact information in author box
* Added spanish translation - thanks to Samuel Galiano Parras
* Updated translation strings
* Added child theme files

= v1.3.0 27-03-2013 =
* Some minor improvements for better SEO
* Some minor CSS adjustments
* Added Droid Sans webfont to style headings
* Improved typography
* Added option to set position of share buttons
* Related posts are now displayed as list including title and subheading
* Removed jQuery PowerTip support because of problems on mobile devices
* Added option to scale background image to full size of browser window
* Fixed issue wpSEO plugin regarding remove_action('shutdown', 'wp_ob_end_flush_all', 1);
* Updated translation strings

= v1.2.0 17-03-2013 =
* Updated translation strings
* Added dynamic copyright date to footer
* Added option to set language for social buttons and likebox

= v1.1.1 20-02-2013 =
* Replaced blog template with homepage templates 

= v1.1.0 19-02-2013 =
* Minor code improvements
* Minor CSS fixes
* Added flex-height and flex-width to custom header support
* Deleted shortcodes for slider, spotlight and carousel because they will be replaced with custom widgets
* Replaced homepage templates with fully widgetized homepage templates
* Added 3 new widgets -> slider, spotlight and carousel to build your custom homepage template with little effort and without coding
* Updated translation strings
* Added slider to blog template

= v1.0.0 15-02-2013 =
* Initial release