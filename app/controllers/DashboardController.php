<?php
	class DashboardController extends Controller
	{
		public function __construct()
		{
			parent::__construct();

			$this->itemModel = model('ItemModel');
			$this->userModel = model('userModel');
			$this->keywordModel = model('KeywordModel');
			_requireAuth();
		}

		public function index()
		{
			$this->data['page_title'] = 'Dashboard';
			$this->data['totalCatalog'] = $this->itemModel->_getCount();
			$this->data['totalUser'] = $this->userModel->_getCount();
			$this->data['trends'] = $this->keywordModel->getTrends();
			return $this->view('dashboard/index', $this->data);
		}
	}