<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('CakeTime', 'Utility');

class UserController extends AppController{
	public $helpers = array('Html', 'Form', 'Session');
	public $components = array('Session', 'RequestHandler');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('register', 'logout', 'thankyou');
	}
	
	public function index() {
		if ($this->Auth->login()) {
			$this->set('user', $this->User->findById($this->Auth->user('id')));
		}
	}
	
	public function register() {
		$data = null;
		if ($this->request->is('post','put')) {
		
			if ($this->User->save($this->request->data)) {
				date_default_timezone_set('US/Pacific');
				$this->User->saveField('created', date('Y:m:d H:i:s'));
				$this->User->saveField('image', 'user-default.png');
				return $this->redirect(array('action' => 'thankyou'));
			} else {
				$data = "Check input for error message."."\r\n"; //for alert message when error occurs
			}
		}
		$this->set('data', $data);
	}
	
	public function update() {
		if ($this->Auth->login()){
			$data['alert'] = null;
			if ($this->request->is(array('post', 'put'))) {
				$this->User->id = $this->request->data['User']['id'];
				
				if (isset($this->request->data['User']['birthdate'])) {
					$this->request->data['User']['birthdate'] = CakeTime::format($this->request->data['User']['birthdate'], '%Y-%m-%d', 'Invalid Date');
				} 
				
				if ($this->request->data['User']['image']['size'] != 0)	 {	
					$tmp_name = $this->request->data['User']['image']['tmp_name'];
					$name = $this->request->data['User']['image']['name'];
					$destination = WWW_ROOT.'img/tmp/'.$name;
					
					$path = pathinfo($name);
					$path_ext = $path['extension'];
					if ($path_ext == ('gif' || 'jpeg' || 'png' || 'jpg')) {
						move_uploaded_file($tmp_name, $destination);
						$this->request->data['User']['image'] = $this->request->data['User']['image']['name'];
					}
				} else { 
					unset($this->request->data['User']['image']);
				}
				if ($this->User->save($this->request->data)) {
					date_default_timezone_set('US/Pacific');
					$this->User->saveField('modified', date('Y:m:d H:i:s'));
					return $this->redirect(array('action' => 'index'));
				} else {
						$data['alert'] = 1;
				} 
			}
			$data['user'] = $this->User->findById($this->Auth->user('id'));
			$this->set('data', $data);
		}
	}
	
	public function thankyou() {
		$this->render();
	}
	
	
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->User->id = $this->Auth->user('id');
				date_default_timezone_set('US/Pacific');
				$this->User->saveField('last_login_time', date('Y:m:d H:i:s'));
				$this->User->saveField('created_ip', $this->request->clientIp());
				$this->User->saveField('modified_ip', $this->request->clientIp());
				$this->Session->write('user_id', $this->Auth->user('id'));
				return $this->redirect($this->Auth->redirectUrl());
			} else {
				$data = 1; //for alert message when error occurs
				$this->set('data', $data);
			} 
		} else {
			$this->set('data', $data = null);
		}
	}
	
	public function logout() {
		$this->Auth->logout();
		return $this->redirect(array('action' => 'login'));
	}
}
?>