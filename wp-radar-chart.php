<?php

/**
 * Plugin Name:			WP Radar Chart
 * Plugin URI:			http://eatbuildplay.com
 * Description:			Create radar charts using chart.js.
 * Version:					1.0.0
 * Author:					Casey Milne, Eat/Build/Play
 * Author URI:			http://eatbuildplay.com
 *
 * Text Domain: wp-radar-chart
 * Domain Path: /languages/
 *
 */

 define('WP_RADAR_CHART_PATH', plugin_dir_path( __FILE__ ));

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

		/*
		$datapointLabels = rwmb_meta( 'datapoint_labels', '', 175 );
		$datasets = rwmb_meta( 'radar_chart_datasets', '', 175 );
		print '<pre>';
		var_dump( $datapointLabels );
		var_dump( $datasets );
		print '</pre>';
		*/

	}

	public static function scripts() {

		wp_enqueue_script(
			'chart-js',
			'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js',
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

			$datapointLabels = rwmb_meta( 'datapoint_labels', '', $radarChart->id );
			$radarChart->datapointLabels = $datapointLabels;

			$datasets = rwmb_meta( 'radar_chart_datasets', '', $radarChart->id );
			foreach( $datasets as $dataset ) {
				$radarChart->data[] = $dataset['data'];
				$radarChart->labels[] = $dataset['label'];
				$radarChart->backgroundColors[] = $dataset['background_color'];
			}

		}

		/*
		 * Set labels
		 */
		if( $params['labels'] ) {
			$labels = str_replace(' ', '', $params['labels'] );
			$labels = explode( ',', $labels );
			$radarChart->labels = $labels;
		} elseif( $radarChart->post ) {
			$value = rwmb_get_value( $field_id );
		}

		if( $params['background-colors'] ) {
			$backgroundColors = str_replace(' ', '', $params['background-colors'] );
			$backgroundColors = explode( ',', $backgroundColors );
			$radarChart->backgroundColors = $backgroundColors;
		}

		if( $params['data'] ) {
			$data = str_replace(' ', '', $params['data'] );
			$data = explode( ',', $data );
			$radarChart->data = $data;
		}

		return $radarChart->render();

	}



}

new WP_RadarChartPlugin();

require_once( WP_RADAR_CHART_PATH . '/src/RadarChart.php' );
