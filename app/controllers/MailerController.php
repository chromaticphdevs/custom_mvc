<?php 

	class MailerController extends Controller
	{

		public function __construct()
		{
			$this->model = model('MailerModel');
		}

		public function send()
		{
			$post = request()->posts();

			$route = request()->input('route');

			$response = $this->model->send($post['recipients'] , $post['subject'] , $post['body']);

			if(!$response)
			{
				Flash::set( $this->model->getErrorString() , 'danger');
			}else{
				Flash::set( $this->model->getMessageString() );
			}

			if( !empty($route)){
				return redirect( unseal($route) );
			}

			return request()->return();
		}
	}