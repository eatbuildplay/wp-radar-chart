<?php

class RadarChart {

	public $id = 0;
	public $post = false;
	public $dataPointLabels = []; // labels per datapoint across all datasets
	public $labels = []; // array of labels
	public $backgroundColors = []; // array of backgroundColors
	public $data = []; // array of data or datasets

	public function __construct() {

		// set default labels
		$this->labels = array(
			'Label 1',
			'Label 2',
			'Label 3'
		);

	}

	public function render() {

		$output = '';

		$output .= $this->renderCanvas();
		$output .= "\r";
		$output .= $this->renderOpenScript();
		$output .= "\r";
		$output .= $this->renderSetCanvasElement();
		$output .= "\r";
		$output .= $this->renderData();
		$output .= "\r";
		$output .= $this->renderOptions();
		$output .= "\r";
		$output .= $this->renderChartSetup();
		$output .= "\r";
		$output .= $this->renderCloseScript();
		$output .= "\r";
		$output .= $this->renderStyles();

		return $output;

	}

	public function prepareLabels() {

		$labels = '[';
		foreach( $this->labels as $label ) {
			$labels .= '"' . $label . '",';
		}
		$labels = substr( $labels, 0, -1 );
		$labels .= ']';
		return $labels;

	}

	public function prepareData() {

		$data = '[';
		foreach( $this->data as $dataPoint ) {
			$data .= '"' . $dataPoint . '",';
		}
		$data = substr( $data, 0, -1 );
		$data .= ']';
		return $data;

	}

	public function renderData() {

		return "var data = {
			labels: " . $this->prepareLabels() . ",
			datasets: [
				{
					label: 'Data Set 1',
					data: " . $this->prepareData() . ",
					backgroundColor: '" . $this->backgroundColors[0] . "',
				},
			]
		}";
	}

	public function renderStyles() {
		return "
			<style>
				#radarChart {
					width: 100%;
					min-width: 600px;
					min-height: 300px;
				}
			</style>
		";
	}

	public function renderChartSetup() {
		return "var radarChart = new Chart(ctx, {
			type: 'radar',
			data: data,
			options: options
		});";
	}

	public function renderSetCanvasElement() {
		return 'var ctx = document.getElementById("radarChart").getContext("2d");';
	}

	public function renderOptions() {
		return "var options = {}";
	}

	public function renderOpenScript() {
		return '<script>';
	}

	public function renderCloseScript() {
		return '</script>';
	}

	public function renderCanvas() {
		return '<canvas id="radarChart"></canvas>';
	}

	public function setLabels( $labels ) {

		$this->labels = $labels;

	}


}
