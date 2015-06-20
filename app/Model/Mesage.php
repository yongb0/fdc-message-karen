<?php

class Message extends AppModel{
	public $hasAndBelongsToMany = array(
		'User' => array(
			'className' => 'User')
	);	
	
	public $validate = array(
		'content' => array(
			'required' => array(
				'rule' => 'notEmpty')
			),
		'from_id' => array(
			'required' => array(
				'rule' => 'notEmpty')
			)
	);
	
}	
?>