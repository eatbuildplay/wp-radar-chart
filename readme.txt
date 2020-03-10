=== WP Radar Chart ===
Contributors: eatbuildplay
Donate link: https://eatbuildplay.com/donate/
Tags: charts
Requires at least: 5.0
Tested up to: 5.3.2
Stable tag: 1.4.0
Requires PHP: 5.6.0
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

WP Radar Charts is a plugin that enables you to create radar charts.

== Description ==

WP Radar Charts utilizes chart.js to create radar charts, this is a unique and often under-utilized form of chart. No coding is required to create a chart as WP Radar Chart provides a custom post type named Radar Chart. You'll be able to create, edit and delete charts using the familiar WP Admin interface.

You will then be able to use the WP Radar Chart shortcode to drop the chart in any page, post or other WP component that can render a shortcode.

# Shortcode usage

The shortcode [radar-chart] can be used one of 2 ways. Either set an ID for a Radar Chart you created in the WP Admin, or by passing all the data required to display a radar chart as shortcode attributes. The shortcode DOES NOT support using a mixture of post type and attributes, if you want to use attributes avoid using an "id" attribute and instead provide all 4 of the attributes required to define a radar chart.

Example of using a Radar Chart post ID
Example shortcode: [radar-chart id="1"]
The example above works for a radar chart with post ID 1.

The shortcode requires 4 attributes to define a radar chart.

datapoints: title for each datapoint in the datasets, example "Oranges, Bananas, Papayas".
labels: the label for each dataset, example: "Dave, Mary"
data: the data for each dataset, example: "(50,75,100), (25,50,125)"
background-colors: the background color for each dataset in hex format, example: "#333333, #666666, #999999"

== Installation ==

1. Upload the plugin files to the '/wp-content/plugins/wp-radar-chart/' directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Visit Radar Charts from the WP Admin menu to begin creating radar charts using the interface provided, or read how to create a radar chart only using the shortcode.

== Frequently Asked Questions ==

= How can I style the chart? =

You can use CSS to style the chart. You may want to visit chart.js to find out about styling suggestions. WP Radar Charts provides only very minimal CSS styling to wrap the chart, all other styling is provided by chart.js. Some styling options are configurable through the Radar Chart settings such as the background color for each data set.

== Screenshots ==

1. Radar chart rendered in the theme twentytwenty.

== Changelog ==

= 1.4.0 =
Contains quality control fixes required after code review including data sanitation and local script loading in place of CDN usage.

= 1.3.1 =
This version contains improved handling of shortcode attributes. It was submitted to the WordPress plugins directory and was rejected :(

= 1.0.0 =
The plugin was born, thanks to our sponsors for the project who wish to remain anonymous.

== Upgrade Notice ==

This is the first public release.
