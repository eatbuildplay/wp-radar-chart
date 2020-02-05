<?php

class RadarChart {

	public $id = 0;
	public $post = false;
	public $datapointLabels = []; // labels per datapoint across all datasets
	public $data = []; // array of data or datasets
	public $labels = []; // array of labels
	public $backgroundColors = []; // array of backgroundColors

	public function __construct() {


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
		foreach( $this->datapointLabels as $label ) {
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
					label: '" . $this->labels[0] . "',
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
