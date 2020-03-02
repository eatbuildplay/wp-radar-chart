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

	public function prepareDatasets() {

		$data = '';
		foreach( $this->data as $index => $dataSet ) {
			$data .= '{';

			// data
			$data .= 'data: [';
			foreach( $dataSet as $dataPoint ) {
				$data .= '"' . $dataPoint . '",';
			}
			$data = substr( $data, 0, -1 );
			$data .= '],';

			// label
			$data .= 'label: "' . $this->labels[ $index ] . '",';

			// backgroundColor
			$data .= 'backgroundColor: "' . $this->backgroundColors[ $index ] . '",';

			$data .= '},';
		}
		$data = substr( $data, 0, -1 );
		return $data;

	}

	public function renderData() {

		return "var data = {
			labels: " . $this->prepareLabels() . ",
			datasets: [
				" . $this->prepareDatasets() . "
			]
		}";
	}

	public function renderChartSetup() {
		return "var radarChart = new Chart(ctx, {
			type: 'radar',
			data: data,
			options: options
		});";
	}

	public function renderSetCanvasElement() {
		return 'var ctx = document.getElementById("radar-chart-' . $this->id . '").getContext("2d");';
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
		$content = '';
		$content .= '<div id="radar-chart-wrap-' . $this->id . '" class="radar-chart-wrap">';
		$content .= '<canvas id="radar-chart-' . $this->id . '" class="radar-chart"></canvas>';
		$content .= '</div>';
		return $content;
	}

	public function setLabels( $labels ) {

		$this->labels = $labels;

	}


}
