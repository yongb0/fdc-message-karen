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
		if ($this->request->is('post')) {
			if ($this->User->save($this->request->data)) {
				$this->User->saveField('image', 'user-default.png');
				return $this->redirect(array('action' => 'thankyou'));
			} else {
				$data = 1;
				$this->set('data', $data);
			} 
		}
		$this->set('data', $data=null);
	}
	
	public function update() {
		if ($this->Auth->login()){
			if ($this->request->is('post')) {
				$this->User->id = $this->request->data['User']['id'];
				$this->request->data['User']['birthdate'] = CakeTime::format($this->request->data['User']['birthdate'], '%Y-%m-%d', 'invalid');;
				if ($this->User->save($this->request->data)) {
					return $this->redirect(array('action' => 'index'));
				}
			$this->Session->setFlash(__('Unable to update.'));
			}
			$this->set('user', $this->User->findById($this->Auth->user('id')));
		}
	}
	
	public function thankyou() {
		$this->render();
	}
	
	
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->User->id = $this->Auth->user('id');
				$this->User->saveField('last_login_time', date('Y:m:d H:i:s'));
				$this->User->saveField('created_ip', $this->request->clientIp());
				$this->User->saveField('modified_ip', $this->request->clientIp());
				$this->Session->write('user_id', $this->Auth->user('id'));
				return $this->redirect($this->Auth->redirectUrl());
			} else {
				$data = 1;
				$this->set('data', $data);
			} 
		} else {
			$this->set('data', $data=null);
		}
	}
	
	public function logout() {
		$this->Auth->logout();
		return $this->redirect(array('action' => 'login'));
	}
}
?>