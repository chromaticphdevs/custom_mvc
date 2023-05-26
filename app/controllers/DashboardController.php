<?php
	class DashboardController extends Controller
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function index()
		{
			// $this->data['page_title'] = 'Dashboard';
			// $this->data['totalCatalog'] = $this->itemModel->_getCount();
			// $this->data['totalUser'] = $this->userModel->_getCount();
			// $this->data['trends'] = $this->keywordModel->getTrends();
			// return $this->view('dashboard/index', $this->data);
		}

		public function create() {
			echo 'test';
		}

		public function show($id) {
			dump([
				request()->inputs(),
				$id
			]);
		}
	}