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
		$this->request->data['Message']['to_id'] = $message['Message']['from_id'];
		$this->request->data['Message']['from_id'] = $message['Message']['to_id'];
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
						'limit' => 5);
		$this->Paginator->settings = $options;
		//debug($this->Message->find('all'));
		$message_list = $this->Paginator->paginate('Message');
		$data['messages'] = $this->filter($message_list);
		$data['user'] = $this->User->find('all');
		$this->set('data', $data);
	}
	
	public function filter($array) { //function to filter messages to get unique and latest messages
		$tempArray = array();
		
		foreach ($array as $array1) {
			if ($tempArray == null) {
				$tempArray[] = $array1; //insert the first element from the passed array to put value in tempArray
			} else {
				foreach ($tempArray as $array2) {
					if (($array1['Message']['to_id'] == $array2['Message']['to_id']) || ($array1['Message']['to_id'] == $array2['Message']['from_id'])) {
						if (($array1['Message']['from_id'] == $array2['Message']['to_id']) || ($array1['Message']['from_id'] == $array2['Message']['from_id'])) {
							if ($array1['Message']['created'] > $array2['Message']['created']) {	
								for ($i = 0; $i < count($tempArray); $i++){
									unset($tempArray[$i]);
									$tempArray[] = $array1;
									
								}
							}
							break;
						} 	
					} else {
						$tempArray[] = $array1; // if not match to existing element in temp array, insert new element to array
						break; }	
				}
			}
		}
		
		return $tempArray;
	}
	
}
?>