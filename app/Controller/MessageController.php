<?php

class MessageController extends AppController{
	public $helpers = array('Html', 'Form', 'Session', 'Time');
	public $components = array('Session', 'RequestHandler');
	
	public function index(){
		if ($this->Auth->login()) {
			$this->loadModel('User');
			$data['messages'] = $this->Message->find('all', array(
				'conditions' => array('Message.to_id' => $this->Auth->user('id')),
				'order' => array('Message.created' => 'desc')));
			$data['user'] = $this->User->find('all');
			$this->set('data', $data);
		}
	}
	
	public function add(){
		if ($this->Auth->login()) {
			$this->loadModel('User');
			if ($this->request->is('post')) {
				$this->request->data['Message']['from_id'] = $this->Auth->user('id');
				$this->request->data['Message']['to_id'] = $this->request->data['to_id'];
				if ($this->Message->save($this->request->data)) {
					return $this->redirect(array('action' => 'index'));
				}
				$this->Session->setFlash(__('Unable to send.'));
			}
			$this->set('users', $this->User->find('all'));
		}
	}
	
	public function details($id = null){
		debug($id); die();
		if ($this->Auth->login()) {
			if (isset($id)) {
				$this->loadModel('User');
				$data['messages'] = $this->Message->findById($id);
				$data['user'] = $this->User->find('all');
				$this->set('data', $data);
			}
		}
	}
	
	public function reply($id = null){
		$this->autoRender = false;
		if(isset($id)){
			$message = $this->Message->findById($id);
			$this->request->data['Message']['to_id'] = $message['Message']['from_id'];
			$this->request->data['Message']['from_id'] = $this->Auth->user('id');
			if($this->Message->save($this->request->data)){
				return $this->redirect(array('action' => 'details'));
			} else {
				$this->Session->setFlash(__('Unable to send.'));
				return $this->redirect(array('action' => 'index'));
			}
		}
	}
}
?>