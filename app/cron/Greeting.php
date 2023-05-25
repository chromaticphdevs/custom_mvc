<?php 

	class Greeting extends Controller
	{
		public function __construct()
		{
			$this->patient_record_model = model('PatientRecordModel');
		}
		public function index()
		{
			$this->greetOnQuarantine();
		}

		private function greetOnQuarantine()
		{
			/*
			*greet all patients that are 
			*on quarantine
			*/
			$patient_records = $this->patient_record_model->getAll([
				'where' => [
					'is_deployed' => true,
					'report_status' => 'pending'
				]
			]);

			$company_name = COMPANY_NAME;

			foreach($patient_records as $key => $row )
			{
				$message = <<<EOF
					"Hi {$row->first_name} , 
						Good Sending healthy vibes your way for a speedy recovery!
						Here at {$company_name} we are Hoping you find strength with each new day."
				EOF;
				_notify_email($message , $row->email);
			}
		}
	}