<?php

class MessageController extends AppController{
	public $helpers = array('Html', 'Form', 'Session', 'Time', 'Js');
	public $components = array('Session', 'RequestHandler', 'Paginator');


	public function index() {
		if ($this->Auth->login()) {
		}
	}
	
	public function add() {
		if ($this->Auth->login()) {
			$data['alert'] = null;
			$this->loadModel('User');
			if ($this->request->is('post')) {
				$this->request->data['Message']['from_id'] = $this->Auth->user('id');
				$this->request->data['Message']['to_id'] = $this->request->data['to_id'];
				if ($this->Message->save($this->request->data)) {
					return $this->redirect(array('action' => 'index'));
				}
				$data['alert'] = 1; //for alert message when error occurs
			}
			$data['users'] = $this->User->find('all');
			$this->set('data', $data);
		}
	}
	
	public function details() {
		if ($this->Auth->login()) {
			$this->loadModel('User');
			
			$message = $this->Message->findById($this->request->params['id']);
			$data['messages'] = $this->Message->findAllByToIdAndFromId(
								 array($message['Message']['to_id'], $message['Message']['from_id']),
								 array($message['Message']['to_id'], $message['Message']['from_id']),
								 array(), array('Message.created' => 'desc'));
			$this->Session->write('message_id', $this->request->params['id']);
			$data['user'] = $this->User->find('all');
			$this->set('data', $data);
		}
	}
	
	public function reply() {
		$message = $this->Message->findById($this->request->params['named']['id']);
		if ($message['Message']['from_id'] == $this->Auth->user('id')){
			$this->request->data['Message']['from_id'] = $message['Message']['from_id'];
			$this->request->data['Message']['to_id'] = $message['Message']['to_id'];
		} else {
			$this->request->data['Message']['to_id'] = $message['Message']['from_id'];
			$this->request->data['Message']['from_id'] = $message['Message']['to_id'];
		}
		if($this->Message->save($this->request->data)){
			return $this->redirect(array('action' => 'index'));
		}
	}
	
	public function delete_list() {
		// insert line to put value for $message based on id passed from parameter 
		$this->autoRender = false;
		$message = $this->Message->findById($this->request->params['named']['id']);
		$data =  $this->Message->findAllByToIdAndFromId(
								 array($message['Message']['to_id'], $message['Message']['from_id']),
								 array($message['Message']['to_id'], $message['Message']['from_id']),
								 array(), array('Message.created' => 'desc'));
		foreach ($data as $list) {
			$this->Message->delete($list['Message']['id']);
		}
	}
	
	public function delete() {
		// insert line to put value for $message based on id passed from parameter 
		$this->autoRender = false;
		$id = $this->request->params['named']['id'];
		$this->Message->delete($id);
	}
	
	public function show() { //function for paginating messages
		$this->loadModel('User');
		$this->Message->setControllerAction('show');
		$options = array (
						'conditions' => array(
									  'or' => array('Message.to_id' => $this->Auth->user('id'),
													'Message.from_id' => $this->Auth->user('id'))),
						'order' => array('Message.created' => 'desc'),
						'limit' => 10);
		$this->Paginator->settings = $options;
		$message_list = $this->Paginator->paginate('Message');
		$data['messages'] = $this->filter();
		$data['user'] = $this->User->find('all');
		$this->set('data', $data);
	}
	
	public function filter() { //function to filter messages to get unique and latest messages
		$tempArray = array();
		$results = $this->Message->find('all', array(
												'fields' => array('Message.to_id', 'Message.from_id'), 
												'order' => array('Message.created' => 'desc')) );
		$results = array_map('unserialize', array_unique(array_map('serialize',$results)));
		foreach ($results as $array) {
			$tempArray[] = $this->Message->find('first', array(
						'order' => array('Message.created' => 'desc'),
						'conditions' => array('Message.to_id' => $array['Message']['to_id'],
											  'Message.from_id' => $array['Message']['from_id']) ));
		}
		return $tempArray;
	}
}
?>