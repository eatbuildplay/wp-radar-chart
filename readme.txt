# WP Radar Charts

Thank you for choosing WP Radar Charts for all your radar charting requirements. Radar charts are an under-appreciated chart. 

## Installation

1. Download or clone from https://github.com/goldhat/wp-radar-chart.
2. Upload unzipped files to your WP site plugin folder at wp-content/plugins/.
3. Activate through the WP Admin plugins list.
4. Look for the "Radar Charts" section in the main menu of your site WP Admin. 
5. See usage section in this document to begin creating Radar Charts.

## Usage

# Radar Chart Shortcode

The shortcode [radar-chart] can be used one of 2 ways. Either set an ID for a Radar Chart you created in the WP Admin, or by passing all the data required to display a radar chart as shortcode attributes. The shortcode DOES NOT support using a mixture of post type and attributes, if you want to use attributes avoid using an "id" attribute and instead provide all 4 of the attributes required to define a radar chart.

# Example of using a Radar Chart post ID
Example shortcode: [radar-chart id="1"]
The example above works for a radar chart with post ID 1.

The shortcode requires 4 attributes to define a radar chart.

datapoints: title for each datapoint in the datasets, example "Oranges, Bananas, Papayas".
labels: the label for each dataset, example: "Dave, Mary"
data: the data for each dataset, example: "(50,75,100), (25,50,125)"
background-colors: the background color for each dataset in hex format, example: "#333333, #666666, #999999"
