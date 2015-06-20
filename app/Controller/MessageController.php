<?php

class MessageController extends AppController{
	public $helpers = array('Html', 'Form', 'Session', 'Time');
	public $components = array('Session');
	
	public function index(){
		if ($this->Auth->login()) {
			$this->loadModel('User');
			$this->set('message', $this->Message->find('all'));
		}
	}
	
	public function add(){
		//$this->autoRender = false;
		
		$this->loadModel('User');
		$term = $this->request->query['q'];
		$users = $this->User->find('all',array(
			'conditions' => array(
				'User.name LIKE' => '%'.$term.'%'
			)
		));

		// Format the result for select2
		$result = array();
		foreach($users as $key => $user) {
			$result[$key]['id'] = (int) $user['User']['id'];
			$result[$key]['name'] = $user['User']['name'];
		}
		$users = $result;

		$this->set('users',json_encode($users));
				
		if ($this->request->is('post')) {
			if ($this->Message->save($this->request->data)) {
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to send.'));
		}
		$this->set('user', $this->Auth->user('id'));
	}
	
	public function search(){
		$this->autoRender = false;
		
		$this->loadModel('User');
		$term = $this->request->query['q'];
		$users = $this->User->find('all',array(
			'conditions' => array(
				'User.name LIKE' => '%'.$term.'%'
			)
		));

		// Format the result for select2
		$result = array();
		foreach($users as $key => $user) {
			$result[$key]['id'] = (int) $user['User']['id'];
			$result[$key]['name'] = $user['User']['name'];
		}
		$users = $result;

		$this->set('users',json_encode($users));
		}		
}
?>