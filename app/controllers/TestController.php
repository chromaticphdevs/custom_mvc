<?php
	class TestController extends Controller
	{

		public function index() {

			return $this->view('test/form');
		}

		public function create() {
			$post = request()->posts();
		}
	}