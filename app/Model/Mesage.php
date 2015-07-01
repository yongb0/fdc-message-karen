<?php

class Message extends AppModel{
	public $validate = array(
		'content' => array(
			'required' => array(
				'rule' => 'notEmpty')
			),
		'from_id' => array(
			'required' => array(
				'rule' => 'notEmpty')
			),
		'to_id' => array(
			'required' => array(
				'rule' => 'notEmpty')
			)
	);
	
	public function beforeSave($option = array()) {
		if(isset($this->data[$this->alias]['to_id'])) {
			return true;
		} else {
			return false;
		}
	}
}	
?>