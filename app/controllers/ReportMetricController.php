<?php 

	class ReportMetricController extends Controller
	{
		public function __construct() {

			parent::__construct();

		}

		public function productivity() {
			

			return $this->view('report_metric/productivity');			
		}
	}