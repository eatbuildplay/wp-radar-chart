<?php

class RadarChartCustomPostType {

	public function init() {

		add_action( 'init', array('RadarChartCustomPostType', 'register'), 0 );
		add_action( 'rwmb_meta_boxes', array('RadarChartCustomPostType', 'fields' ));

	}

	public function fetchById( $id ) {
		$post = get_post( $id );
		if( !$post || $post->post_type != 'radar_chart' ) {
			return false;
		}
		return $post;
	}

	public static function register() {

		$labels = array(
			'name'                  => _x( 'Radar Charts', 'Post Type General Name', 'wp-radar-chart' ),
			'singular_name'         => _x( 'Radar Chart', 'Post Type Singular Name', 'wp-radar-chart' ),
			'menu_name'             => __( 'Radar Charts', 'wp-radar-chart' ),
			'name_admin_bar'        => __( 'Radar Charts', 'wp-radar-chart' ),
			'archives'              => __( 'Item Archives', 'wp-radar-chart' ),
			'attributes'            => __( 'Item Attributes', 'wp-radar-chart' ),
			'parent_item_colon'     => __( 'Parent Item:', 'wp-radar-chart' ),
			'all_items'             => __( 'All Radar Charts', 'wp-radar-chart' ),
			'add_new_item'          => __( 'Add New Item', 'wp-radar-chart' ),
			'add_new'               => __( 'Add New', 'wp-radar-chart' ),
			'new_item'              => __( 'New Item', 'wp-radar-chart' ),
			'edit_item'             => __( 'Edit Item', 'wp-radar-chart' ),
			'update_item'           => __( 'Update Item', 'wp-radar-chart' ),
			'view_item'             => __( 'View Item', 'wp-radar-chart' ),
			'view_items'            => __( 'View Items', 'wp-radar-chart' ),
			'search_items'          => __( 'Search Item', 'wp-radar-chart' ),
			'not_found'             => __( 'Not found', 'wp-radar-chart' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'wp-radar-chart' ),
			'featured_image'        => __( 'Featured Image', 'wp-radar-chart' ),
			'set_featured_image'    => __( 'Set featured image', 'wp-radar-chart' ),
			'remove_featured_image' => __( 'Remove featured image', 'wp-radar-chart' ),
			'use_featured_image'    => __( 'Use as featured image', 'wp-radar-chart' ),
			'insert_into_item'      => __( 'Insert into item', 'wp-radar-chart' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'wp-radar-chart' ),
			'items_list'            => __( 'Items list', 'wp-radar-chart' ),
			'items_list_navigation' => __( 'Items list navigation', 'wp-radar-chart' ),
			'filter_items_list'     => __( 'Filter items list', 'wp-radar-chart' ),
		);
		$args = array(
			'label'                 => __( 'Radar Chart', 'wp-radar-chart' ),
			'description'           => __( 'Create a radar chart using the chart.js library.', 'wp-radar-chart' ),
			'labels'                => $labels,
			'supports'              => array( 'title' ),
			'taxonomies'            => array(),
			'hierarchical'          => false,
			'public'                => false,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 80,
			'menu_icon'             => 'dashicons-chart-area',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'radar_chart', $args );

	}

	public static function fields() {

		$prefix = 'prefix-';

		$meta_boxes[] = array(
			'id' => 'radar_chart_settings',
			'title' => esc_html__( 'Radar Chart Settings', 'wp-radar-charts' ),
			'post_types' => array( 'radar_chart' ),
			'context' => 'advanced',
			'priority' => 'high',
			'autosave' => 'true',
			'fields' => array(
				array(
					'name'  	 => 'Data Point Labels',
					'id'    	 => 'datapoint_labels',
					'type' 		 => 'text'
				),
				array(
            'name'   => 'DataSet Options',
            'id'     => 'radar_chart_datasets',
            'type'   => 'group',
						'clone'  => true,
            'fields' => array(
								array(
									'name' => 'Data',
									'id'   => 'data',
									'type' => 'text',
								),
								array(
                  'name' => 'Label',
                  'id'   => 'label',
                  'type' => 'text',
                ),
								array(
									'id' => $prefix . 'color_1',
									'name' => esc_html__( 'Color Picker', 'wp-radar-charts' ),
									'type' => 'color',
								),
            ),
        ),
			),
		);

		return $meta_boxes;

	}

}
