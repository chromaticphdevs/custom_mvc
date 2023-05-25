<?php 

	class HomeController extends Controller
	{

		public function index()
		{
			$data = [
				'attachment_form' => $this->_attachmentForm
			];
			
			return $this->view('home/index' , $data);
		}
	}