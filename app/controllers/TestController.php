<?php
	class TestController extends Controller
	{

		public function index() {

			return $this->view('test/form');
		}

		public function create($id = 3) {
			$post = request()->posts();

			dump([
				$post,
				$id
			]);
		}
	}