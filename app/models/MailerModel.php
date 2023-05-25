<?php 

	class MailerModel extends Model
	{
		protected $view = null;

		public function send( $recipients = [] , $subject , $body )
		{
			if(empty($recipients))
			{
				$this->addError("No recipients found!");
				return false;
			}
			
			$recipients = explode(',' , $recipients);

			$message = '';

			foreach($recipients as $key => $row) {

				if( is_email($row) ){
					$message .= "sent to {$row}.";
				}
			}

			$this->addMessage($message);

			_mail($recipients , $subject , $body);

			return true;
		}		

		public function sendWithCCAndBCC( $recipients , $subject , $body , $cc , $bcc)
		{

		}
	}