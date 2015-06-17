<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('CakeTime', 'Utility');

class UserController extends AppController{
	public $helpers = array('Html', 'Form', 'Session');
	public $components = array('Session');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('register', 'logout');
	}
	
	public function index(){
		if ($this->Auth->login()) {
			$this->render('index');
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
	
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->User->id = $this->Auth->user('id');
				$this->User->saveField('last_login_time', date('Y:m:d H:i:s'));
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Session->setFlash(__('Invalid username or password. Try Again.'));
		} 
	}
	
	public function logout() {
		$this->Auth->logout();
		return $this->redirect(array('action' => 'login'));
	}
}
?>