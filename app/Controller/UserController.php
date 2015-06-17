<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('CakeTime', 'Utility');

class UserController extends AppController{
	public $helpers = array('Html', 'Form', 'Session');
	public $components = array('Session');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('register', 'logout', 'login');
	}
	
	public function index($id = null){
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				debug($this->Auth->user()); die();
				$this->User->id = $this->Auth->user('id');
				$this->User->saveField('last_login_time', 'date(DATE_ATOM)');
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Session->setFlash(__('Invalid username or password. Try Again.'));
		} 
	}
	
	public function register() {
		if ($this->request->is('post')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('Successfully saved.'));
				return $this->redirect(array('action' => 'thankyou'));
			}
			$this->Session->setFlash(__('Unable to save.'));
		}
	}
	
	public function thankyou() {
		$this->render('thankyou');
	}
	
	public function view() {
		$this->render('view');
	}
	
	public function login() {
	}
	
	public function logout() {
		return $this->redirect($this->Auth->logout());
	}
}
?>