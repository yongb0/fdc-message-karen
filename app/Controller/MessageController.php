<?php

class MessageController extends AppController{
	public $helpers = array('Html', 'Form', 'Session', 'Time');
	public $components = array('Session', 'RequestHandler', 'Paginator');
	
		
	public function index(){
		if ($this->Auth->login()) {
			$this->loadModel('User');
			$data['messages'] = $this->Message->findAllByToIdOrFromId(
								 $this->Auth->user('id'), 
								 $this->Auth->user('id'), 
								 array(), array('Message.created' => 'desc'));
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
	
	public function details(){
		if ($this->Auth->login()) {
			$this->loadModel('User');
			 $message = $this->Message->findById($this->request->params['id']);
			
			$data['messages'] = $this->Message->findAllByToIdAndFromId(
								 array($this->Auth->user('id'), $message['Message']['from_id']),
								 array($this->Auth->user('id'), $message['Message']['from_id']),
								 array(), array('Message.created' => 'desc'));
			$this->Session->write('message_id', $this->request->params['id']);
			$data['user'] = $this->User->find('all');
			$this->set('data', $data);
		}
	}
	
	public function reply(){
		$message = $this->Message->findById($this->request->params['named']['id']);
		$this->request->data['Message']['to_id'] = $message['Message']['from_id'];
		$this->request->data['Message']['from_id'] = $this->Auth->user('id');
		if($this->Message->save($this->request->data)){
			return $this->redirect(array('action' => 'index'));
		}
	}
	
	public function delete(){
		$this->Message->delete($this->request->params['named']['id']);
	}
	
}
?>