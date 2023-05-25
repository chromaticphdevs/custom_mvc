<?php

	use Services\UserService;
	load(['UserService'], SERVICES);

	class UserModel extends Model
	{
		public $table = 'users';

		protected $_fillables = [
			'id',
			'firstname',
			'lastname',
			'gender',
			'address',
			'phone',
			'email',
			'username',
			'password',
			'created_at',
			'created_by',
			'user_type',
			'user_identification',
			'profile',
			'is_verified'
		];


		public function get($id)
		{
			if (is_array($id)) {
				return $this->getAll([
					'where' => $id
				])[0] ?? false;
			} else {
				return $this->getAll([
					'where' => [
						'id' => $id
					]
				])[0] ?? false;
			}
		}

		public function save($user_data , $id = null)
		{
			$user_id = $id;
			$fillable_datas = $this->getFillablesOnly($user_data);
			$validated = $this->validate($fillable_datas, $id);
			
			if(!$validated)
				return false;

			if(!is_null($id))
			{
				//change password also
				if(empty($fillable_datas['password']))
					unset($fillable_datas['password']);

				if(!empty($fillable_datas['profile'])){
					$this->uploadProfile('profile' , $id);
					unset($fillable_datas['profile']);
				}
				$res = parent::update($fillable_datas , $id);
				$user_id = $id;
			}else
			{
				if(empty($fillable_datas['user_identification'])) {
					$fillable_datas['user_identification'] = $this->generateCode();
				}else {
					$check = $this->generateCode($fillable_datas['user_identification']);

					if(!$check) {
						return false;
					}
				}
				$user_id = parent::store($fillable_datas);
			}
			
			$this->retVal['id'] = $user_id;
			return $user_id;
		}

		public function sendCredential($id)
		{
			$user = $this->model->get($id);

			$app_name = COMPANY_NAME;

			$login_href = URL.DS._route('auth:login');

			$anchor = "<a href='{$login_href}'>Login here.</a>";
			/**
			 * send auth to email*/
			$body = <<<EOF
				<div>
					Hi {$user->firstname} , Your Credentials
					for the {$app_name} Portal <br/>
					<strong>username/email : {$user->email}  </strong> <br/>
					<strong>password : {$user->password}  </strong>
					{$anchor}
				</div>
			EOF;

			_mail($user->email, 'User Credential' , $message);
		}

		private function validate($user_data , $id = null)
		{
			if(!empty($user_data['email']))
			{
				if(!filter_var($user_data['email'], FILTER_VALIDATE_EMAIL)) {
					$this->addError("Invalid Email");
					return false;
				}
				$is_exist = $this->getByKey('email' , $user_data['email'])[0] ?? '';

				if( $is_exist && !isEqual($is_exist->id , $id) ){
					$this->addError("Email {$user_data['email']} already used");
					return false;
				}
			}

			// if(isset($user_data['username']) && !empty($user_data['username']))
			// {
			// 	$is_exist = $this->getByKey('username' , $user_data['username'])[0] ?? '';

			// 	if( $is_exist && !isEqual($is_exist->id , $id) ){
			// 		$this->addError("Username {$user_data['username']} already used");
			// 		return false;
			// 	}
			// }

			if(!empty($user_data['phone']))
			{
				$phone = preg_replace('/[^0-9]/', '', $user_data['phone']);
				if(strlen($phone) != 11) {
					$this->addError("Invalid {$phone} Number");
					return false;
				    //Phone is 10 characters in length (###) ###-####
				}
				
				//check if email is valid
				$is_exist = $this->getByKey('phone' , $phone)[0] ?? '';

				if( $is_exist && !isEqual($is_exist->id , $id) ){
					$this->addError("Phonne Number {$phone} already used");
					return false;
				}
			}

			if(!empty($user_data['user_identification']))
			{
				$is_exist = $this->getByKey('user_identification' , $user_data['user_identification'])[0] ?? '';

				if( $is_exist && !isEqual($is_exist->id , $id) ){
					$this->addError("Student Id {$user_data['user_identification']} already exists");
					return false;
				}
			}

			return true;
		}

		public function create($user_data , $profile = '')
		{
			if(isEqual($user_data['user_type'], UserService::SUB_ADMIN)) {
				$user_data['is_verified'] = false;
			}

			$res = $this->save($user_data);
			if(!$res) {
				$this->addError("Unable to create user");
				return false;
			}
			if(!empty($profile) )
				$this->uploadProfile($profile , $res);

			$this->addMessage("User {$user_data['firstname']} Created");
			return $res;
		}

		public function uploadProfile($file_name , $id)
		{
			$is_empty = upload_empty($file_name);

			if($is_empty){
				$this->addError("No file attached upload profile failed!");
				return false;
			}
			
			$upload = upload_image($file_name, PATH_UPLOAD);
			
			if( !isEqual($upload['status'] , 'success') ){
				$this->addError(implode(',' , $upload['result']['err']));
				return false;
			}

			$res = parent::update([
				'profile' => GET_PATH_UPLOAD.DS.$upload['result']['name']
			] , $id);

			if($res) {
				if(whoIs('id') == $id) {
					$this->startAuth($id);
				}
				
				$this->addMessage("Profile uploaded!");
				return true;
			}
			$this->addError("UPLOAD PROFILE DATABASE ERROR");
			return false;
		}

		public function update($user_data , $id)
		{
			$res = $this->save($user_data , $id);

			if(!$res) {
				$this->addError("Unable to update user");
				return false;
			}
			$this->addMessage("User {$user_data['firstname']} has been updated!");

			return true;
		}

		public function getByKey($column , $key , $order = null)
		{
			if( is_null($order) )
				$order = $column;

			return parent::getAssoc($column , [
				$column => "{$key}"
			]);
		}


		public function getAll($params = [])
		{
			$where = null;
			$order = " ORDER BY firstname asc ";

			if(isset($params['order']))
				$order = " ORDER BY {$params['order']}";
			if(isset($params['where']))
				$where = " WHERE ".$this->conditionConvert($params['where']);

			$this->db->query(
				"SELECT * FROM {$this->table}
					{$where} {$order}"
			);

			return $this->db->resultSet();
		}

		public function generateCode($code = null)
		{
			if(is_null($code)) {
				$reference = null;

				while($reference == null) {
					$reference = referenceSeries(parent::lastId() + 1, 3, random_number(3).'-', date('y'));

					$isExist = parent::single([
						'user_identification' => $reference
					]);

					if($isExist) {
						$reference = null;
					}
				}
				return  $reference;
			} 

			$isExist = parent::single([
				'user_identification' => $code
			]);

			if($isExist) {
				$this->addError("User Identification already exists. ");
				return false;
			}

			return true;
		}


		public function authenticate($email , $password)
		{
			$errors = [];

			$user = parent::single(['email' => $email]);

			if(!$user) {
				$errors[] = " Email '{$email}' does not exists in any account";
			}

			if(!isEqual($user->password ?? '' , $password)){
				$errors[] = " Incorrect Password ";
			}

			if(!empty($errors)){
				$this->addError( implode(',', $errors));
				return false;
			}

			if(!$user->is_verified) {
				$this->addError("User is not verified");
				return false;
			}

			return $this->startAuth($user->id);
		}

		/*
		*can be used to reset and start auth
		*/
		public function startAuth($id)
		{
			$user = parent::get($id);

			if(!$user){
				$this->addError("Auth cannot be started!");
				return false;
			}

			$auth = null;

			while(is_null($auth))
			{
				Session::set('auth' , $user);
				$auth = Session::get('auth');
			}

			return $auth;
		}

		public function computeAge($birth_date)
		{
			$currentDate = date("d-m-Y");

			$age = date_diff(date_create($birth_date), date_create($currentDate));

			return $age->format("%y");
		}

		public function getPatients()
		{
			
		}

		public function totalUser(){
			$staff = [UserService::STAFF, UserService::SUPERVISOR];

			$this->db->query(
				"SELECT count(id) as total
					FROM {$this->table}
					WHERE user_type in ('".implode("','", $staff)."') "
			);
			return $this->db->single()->total ?? 0;
		}

		public function changePassword($password,$userId) {
			return parent::update([
				'password' => $password
			], $userId);
		}

		public function getSummary()
		{
			$patients = $this->getAll([
				'where' => [
					'user_type' => 'patient'
				]
			]);

			$summary = [
				'gender' => [
					'male' => 0,
					'female' => 0,
					'male_percentage' => 0,
					'female_percentage' => 0
				],

				'age_group' => [
					'20s' => '',
					'30s' => '',
					'40s' => '',
					'others' => ''
				]
			];

			foreach($patients as $key => $row) 
			{
				$age = intval($row->age);

				if( isEqual($row->gender, 'male') ){
					$summary['gender']['male']++;
				}else{
					$summary['gender']['female']++;
				}

				
				if( $age >= 40)
				{
					$summary['age_group']['40s']++;
				}else if($age >= 30){
					$summary['age_group']['30s']++;
				}else if($age >= 20)
				{
					$summary['age_group']['20s']++;
				}else{
					$summary['age_group']['others']++;
				}
			}

			//gender summary

			$gender_total = intval($summary['gender']['male']) + intval($summary['gender']['female']);

			if( $summary['gender']['male'] )
				$summary['gender']['male_percentage'] = ($summary['gender']['male'] / $gender_total) * 100;

			if( $summary['gender']['female'] )
				$summary['gender']['female_percentage'] = ($summary['gender']['female'] / $gender_total) * 100;

			return $summary;
		}
	}