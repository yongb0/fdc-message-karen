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
				date_default_timezone_set('US/Pacific');
				$this->request->data['Message']['created'] = date('Y:m:d H:i:s');
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
		date_default_timezone_set('US/Pacific');
		$this->Message->saveField('created', date('Y:m:d H:i:s'));
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
		$item_per_page = 1;
		$data['page_number'] = 1;
		
		$message_list = $this->filter();
		$data['total_rows'] = count($message_list);
		$data['total_pages'] = ceil($data['total_rows']/$item_per_page);
		for($i = 0; $i < $item_per_page; $i++){
			if ($i < count($message_list)){
				$data['messages'][$i] = $message_list[$i]; //first page records
			}
		}
		if (isset($this->request->params['page'])) {
			$page = $this->request->params['page'];
			$index = 0;
			for($i = $item_per_page*$page; $i < $item_per_page*($page+1); $i++ ) {
				$data['messages'][$index] = $message_list[$i]; //add data
				$index++;
			}
			$data['page_number']+=1;
		}
		$data['user'] = $this->User->find('all'); 
		$this->set('data', $data);
	}
	
	public function filter() { //function to filter messages to get unique and latest messages
		$tempArray = array();
		$dummyArray = array();
		//filter to get only messages that the user is included
		$results = $this->Message->find('all', array(
												'conditions' => array(
													'or' => array('Message.to_id' => $this->Auth->user('id'),
																  'Message.from_id' => $this->Auth->user('id')) ),
												'fields' => array('Message.to_id', 'Message.from_id'), 
												'order' => array('Message.created' => 'desc')) );
		//remove duplicate entries
		$results = array_map('unserialize', array_unique(array_map('serialize',$results)));
		
		//filter the result to get only the latest between conversations
		foreach ($results as $array) {
			$tempArray[] = $this->Message->find('first', array(
						'order' => array('Message.created' => 'desc'),
						'conditions' => array('Message.to_id' => $array['Message']['to_id'],
											  'Message.from_id' => $array['Message']['from_id']) ));
			foreach ($tempArray as $array1) {
				if ($dummyArray == null) {
					$dummyArray[] = $array1; //insert the first element from the passed array to put value in dummyArray
				} else {
					foreach ($tempArray as $array2) {
						if (($array1['Message']['to_id'] == $array2['Message']['to_id']) || ($array1['Message']['to_id'] == $array2['Message']['from_id'])) {
							if (($array1['Message']['from_id'] == $array2['Message']['to_id']) || ($array1['Message']['from_id'] == $array2['Message']['from_id'])) {
								if ($array1['Message']['created'] > $array2['Message']['created']) {	
									for ($i = 0; $i < count($tempArray); $i++){
										unset($tempArray[$i]);
										$dummyArray[] = $array1;
									}
								}
								break;
							} 	
						} else {
							$dummyArray[] = $array1; // if not match to existing element in temp array, insert new element to array
							break; }	
					}
				}
			}
		}
		//to make sure there are no duplicate entries
		$finalList = array_map('unserialize', array_unique(array_map('serialize',$dummyArray)));
		
		//return the final list
		return $finalList;
	}
}
?>