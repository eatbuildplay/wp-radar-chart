<?php

/**
 * Plugin Name:			WP Radar Chart
 * Plugin URI:			http://eatbuildplay.com/plugins/wp-radar-chart/
 * Description:			Create radar charts using chart.js.
 * Version:					1.3.1
 * Author:					Casey Milne, Eat/Build/Play
 * Author URI:			http://eatbuildplay.com
 *
 * Text Domain: wp-radar-chart
 * Domain Path: /languages/
 *
 */

define('WP_RADAR_CHART_PATH', plugin_dir_path( __FILE__ ));
define('WP_RADAR_CHART_URL', plugin_dir_url( __FILE__ ));

class WP_RadarChartPlugin {

	public function __construct() {

		// include metabox framework
		require( WP_RADAR_CHART_PATH . 'vendor/meta-box/meta-box.php');
		require( WP_RADAR_CHART_PATH . 'vendor/meta-box-group/meta-box-group.php');

		// init cpt
		include( WP_RADAR_CHART_PATH . 'src/RadarChartCustomPostType.php' );
		$cpt = new RadarChartCustomPostType;
		$cpt->init();

		// include chart.js via enqueue
		add_action( 'wp_enqueue_scripts', array('WP_RadarChartPlugin', 'scripts'));

		// register shortcode
		add_action( 'init', array('WP_RadarChartPlugin', 'initShortcode' ));

	}

	public static function scripts() {

		wp_enqueue_script(
			'chart-js',
			'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js',
			array(),
			true
		);

    wp_enqueue_style(
			'radar-chart-style',
			WP_RADAR_CHART_URL . 'assets/radar-chart-style.css',
			array(),
			true
		);


	}

	public static function initShortcode() {
		add_shortcode( 'radar-chart', array( 'WP_RadarChartPlugin', 'shortcode' ), 10, 3 );
	}

	// Shortcode [radar-chart]
	public static function shortcode( $atts, $content, $tag ) {

		$radarChart = new RadarChart;

		// setup params from shortcode attributes
		$params = shortcode_atts(
			[
				'id' => 0,
				'datapoints' => false,
				'labels' => false,
				'background-colors' => false,
				'data' => false
			],
			$atts
		);

		/*
		 * Set post ID if provided and valid
		 */
		if( $params['id'] ) {
			$id = $params['id'];
			$postType = new RadarChartCustomPostType;
			$post = $postType->fetchById( $id );
			if( $post ) {
				$radarChart->id = $id;
				$radarChart->post = $post;
			}
		}

		/*
		 * Extract post field values if available
		 */
		if( $radarChart->post ) {

			// set datapoint labels
			$datapoints = rwmb_meta( 'datapoint_labels', '', $radarChart->id );
			$datapoints = str_replace(' ', '', $datapoints );
			$datapoints = explode( ',', $datapoints );
			$radarChart->datapoints = $datapoints;

			$datasets = rwmb_meta( 'radar_chart_datasets', '', $radarChart->id );

			$radarChart->data = [];
			foreach( $datasets as $index => $dataset ) {

				$radarChart->data[ $index ] = [];
				$data = '[' . $dataset['data'] . ']';
				$data = str_replace(' ', '', $data );
				$dataArray = json_decode( $data );
				$radarChart->data[ $index ] = $dataArray;

				$radarChart->labels[] = $dataset['label'];
				$radarChart->backgroundColors[] = $dataset['background_color'];

			}

		}

		/*
		 * Set datapoint labels
		 */
		if( $params['datapoints'] ) {
			$labels = str_replace(' ', '', $params['datapoints'] );
			$labels = explode( ',', $labels );
			$radarChart->datapoints = $labels;
		}

		/*
		 * Set labels
		 */
		if( $params['labels'] ) {
			$labels = str_replace(' ', '', $params['labels'] );
			$labels = explode( ',', $labels );
			$radarChart->labels = $labels;
		}

		/*
		 * Set background colors
		 */
		if( $params['background-colors'] ) {
			$backgroundColors = str_replace(' ', '', $params['background-colors'] );
			$backgroundColors = explode( ',', $backgroundColors );
			$radarChart->backgroundColors = $backgroundColors;
		}

		/*
		 * Set data
		 */
		if( $params['data'] ) {

			$data = str_replace('(', '[', $params['data'] );
			$data = str_replace(')', ']', $data );
			$data = str_replace(' ', '', $data );
			$jsonWrap = '[' . $data . ']';
			$jsonData = json_decode( $jsonWrap );
			$radarChart->data = $jsonData;

		}

		return $radarChart->render();

	}



}

require_once( WP_RADAR_CHART_PATH . '/src/RadarChart.php' );
new WP_RadarChartPlugin();
