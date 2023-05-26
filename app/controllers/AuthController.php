<?php 

	class AuthController extends Controller
	{	

		public function __construct()
		{
			parent::__construct();
			/*
			*change the database here.
			*/
			$this->userModel = model('UserModel');
		}

		

		public function index()
		{
			$users = $this->userModel->getAll();
			dump($users);
		}

		public function register() {

			if(isSubmitted()) {
				$post = request()->posts();

				if(!isEqual($post['password'], $post['confirm_password'])) {
					Flash::set("Password does not match", 'warning');
					return request()->return();
				}
				if(!empty($post['user_identification'])) {
					$post['user_type'] = UserService::COMMON;
				} else {
					$post['user_type'] = UserService::STUDENT;
				}
				
				$post['is_verified'] = false;
				$isOkay = $this->user->save($post);
				if(!$isOkay) {
					Flash::set($this->user->getErrorString(),'danger');
					return request()->return();
				}
				$this->meta->createVerifyUserCode($this->user->retVal['id']);

				$href = URL.DS.'AuthController/code/?action=activate&code='.seal($this->meta->retVal['id']);
				$link = "<a href ='{$href}'> Link </a>";

				$emailContent = " Good day <strong>{$post['firstname']}</strong>,<br/>";
				$emailContent .= " You Recieved this email because you used your email to register on ". APP_NAME .'<br/>';
				$emailContent .= " Verify your registration and start navigating to our ".$this->itemModel->_getCount(). '++ lists of catalogs. <br/></br>';
				$emailContent .= " Click this {$link} or use this code to activate your account".$this->meta->retVal['code'];

				$emailBody = wEmailComplete($emailContent);
				_mail($post['email'], 'ACCOUNT VERIFICATION', $emailBody);

				Flash::set("User has been created, verification link and code has been sent to your email '{$post['email']}'");
				return redirect(_route('auth:code'));
			}

			$this->_form->add([
				'type' => 'text',
				'name' => 'user_identification',
				'class' => 'form-control',
				'options' => [
					'label' => "STUDENT ID (for-student only)"
				],

				'attributes' => [
					'id' => 'student_id',
					'placeholder' => 'User ID'
				]
			]);
			$data = [
				'_form' => $this->_form,
				'totalCatalog' => $this->itemModel->_getCount()
			];
			return $this->view('public/register', $data);
		}

		public function login()
		{
			$req = request()->inputs();

			if(isSubmitted())
			{
				$post = request()->posts();
				$user = $this->user->single([
					'email' => $post['email']
				]);

				$loginType = $post['login_type'] ?? 'common-user';
				if(isEqual($loginType, 'admin')) {
					if(!isEqual($user->user_type, [UserService::SUB_ADMIN, UserService::ADMIN])) {
						Flash::set("user not found", 'danger');
						return request()->return();
					}
				}

				if(isEqual($loginType, 'common-user')) {
					if(isEqual($user->user_type, [UserService::SUB_ADMIN, UserService::ADMIN])) {
						Flash::set("user not found", 'danger');
						return request()->return();
					}
				}				

				$res = $this->user->authenticate($post['email'] , $post['password']);

				if(!$res) {
					Flash::set( $this->user->getErrorString() , 'danger');
					return request()->return();
				}else
				{
					Flash::set( "Welcome Back !" . auth('firstname'), 'primary');
				}

				$lastPage = $req['lastPage'] ?? '';

				if($lastPage) {
					$lastPage = unseal($lastPage);
					if($lastPage != 'na') {
						return redirect($lastPage);
					}
				}
				return redirect('DashboardController');
			}

			$form = $this->_form;

			$form->init([
				'url' => _route('auth:login')
			]);

			$form->customSubmit('Login' , 'submit' , ['class' => 'btn btn-primary btn-sm']);

			$data = [
				'title' => 'Login Page',
				'form'  => $form,
				'loginType' => $req['login_type'] ?? 'common-user'
			];

			return $this->view('auth/login' , $data);
		}

		public function logout()
		{
			session_destroy();
			Flash::set("Thank you for using, ". APP_NAME);
			return redirect( _route('auth:login') );
		}

		public function code() {
			$req = request()->inputs();

			if(isSubmitted()) {
				$code = request()->post('verification_code');
				$codeValue = $this->meta->single([
					'meta_value' => $code
				]);
			}
			
			if(!empty($req['action']) && !empty($req['code'])) {
				$id = unseal($req['code']);
				$codeValue = $this->meta->get($id);
			}

			if(isset($codeValue)) {
				if(!$codeValue) {
					Flash::set("Invalid Code");
					return request()->return();
				}

				$this->meta->delete($codeValue->id);

				$isOkay = $this->user->update([
					'is_verified' => true
				], $codeValue->parent_id);

				if($isOkay) {
					Flash::set("Account Verified");
					$this->user->startAuth($codeValue->parent_id);
					return redirect(_route('item:index'));
				}
			}

			return $this->view('auth/code');
		}

		public function adminLogin(){
			return $this->admin();
		}

		public function admin() {

			$form = $this->_form;

			$form->init([
				'url' => _route('auth:login')
			]);

			$form->customSubmit('Login' , 'submit' , ['class' => 'btn btn-primary btn-sm']);

			$data = [
				'title' => 'Login Page',
				'form'  => $form,
				'loginType' => $req['login_type'] ?? 'common-user'
			];
			return $this->view('auth/admin_login' , $data);
		}
	}