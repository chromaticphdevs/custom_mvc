<?php 
	load(['UserService'], APPROOT.DS.'services');
	load(['UserForm'] , APPROOT.DS.'form');
	load(['BehaviorService'], SERVICES);

	use Form\UserForm;
	use Services\BehaviorService;
	use Services\UserService;
	class UserController extends Controller
	{

		public function __construct()
		{
			_requireAuth();
			parent::__construct();
			$this->model = model('UserModel');

			$this->data['page_title'] = ' Users ';
			$this->data['user_form'] = new UserForm();
			$this->data['behaviorService'] = new BehaviorService();
		}

		public function index()
		{
			$params = request()->inputs();

			if(!empty($params))
			{
				$this->data['users'] = $this->model->getAll([
					'where' => $params
				]);
			}else{
				$this->data['users'] = $this->model->getAll( );
			}
			

			return $this->view('user/index' , $this->data);
		}

		public function create()
		{
			$req = request()->inputs();

			if(isSubmitted()) {
				$post = request()->posts();
				$user_id = $this->model->create($post , 'profile');
				if(!$user_id){
					Flash::set( $this->model->getErrorString() , 'danger');
					return request()->return();
				}

				Flash::set('User Record Created');
				if( isEqual($post['user_type'] , 'patient') )
				{
					Flash::set('Patient Record Created');
					return redirect(_route('patient-record:create' , null , ['user_id' => $user_id]));
				}

				return redirect( _route('user:show' , $user_id , ['user_id' => $user_id]) );
			}
			$this->data['user_form'] = new UserForm('userForm');

			return $this->view('user/create' , $this->data);
		}

		public function edit($id)
		{
			if(isSubmitted()) {
				$post = request()->posts();
				$post['profile'] = 'profile';
				$res = $this->model->update($post , $post['id']);

				if($res) {
					Flash::set( $this->model->getMessageString());
					return redirect( _route('user:show' , $id) );
				}else
				{
					Flash::set( $this->model->getErrorString() , 'danger');
					return request()->return();
				}
			}

			$user = $this->model->get($id);

			$this->data['id'] = $id;
			$this->data['user_form']->init([
				'url' => _route('user:edit',$id)
			]);

			$this->data['user_form']->setValueObject($user);
			$this->data['user_form']->addId($id);
			$this->data['user_form']->remove('submit');
			$this->data['user_form']->add([
				'name' => 'password',
				'type' => 'password',
				'class' => 'form-control',
				'options' => [
					'label' => 'Password'
				]
			]);

			$this->data['user'] = $user;

			if(!isEqual(whoIs('user_type'), 'admin'))
				$this->data['user_form']->remove('user_type');

			return $this->view('user/edit' , $this->data);
		}

		public function show($id)
		{
			$behaviorService = $this->data['behaviorService'];
			$favGenre = $behaviorService->getFavoriteGenre();

			$user = $this->model->get($id);

			if(!$user) {
				Flash::set(" This user no longer exists " , 'warning');
				return request()->return();
			}

			$this->data['user'] = $user;
			$this->data['userDetail'] = [
				'favGenre' => $favGenre
			];
			
			return $this->view('user/show' , $this->data);
		}

		public function sendCredential($id)
		{
			$this->model->sendCredential($id);
			Flash::set("Credentials has been set to the user");
			return request()->return();
		}

		public function subAdmins() {

			$users = $this->model->getAll([
				'where' => [
					'user_type' => UserService::SUB_ADMIN
				]
			]);

			$this->data['users'] = $users;
			return $this->view('user/sub_admins', $this->data);
		}

		public function approveSubAdmin($id) {
			if(isAdmin()) {
				$user = $this->model->get($id);

				$this->model->update([
					'is_verified' => !$user->is_verified
				], $id);

				if(!$user->is_verified) {
					$message = "Sub admin has been approved";
				}else{
					$message = "User has been de-activated";
				}

				Flash::set($message);
				return redirect(_route('user:index'));
			} else {
				Flash::set("You are not allowed to take this action", 'danger');
				return request()->return();
			}
		}
	}