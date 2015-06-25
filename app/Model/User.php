<?php 
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
	
class User extends AppModel{
	public $validate = array(
		'name' => array(
			'required' => array(
				'rule' => array('between', 5, 20),
				'message' => 'Name should be 5 to 20 characters.')
		),
		'email' => array(
			'required' => array(
				'rule' => array('isUnique', 'email'),
				'message' => 'Invalid e-mail or e-mail already exists.')
		),
		'password' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Password is required')
		),
		're_password' => array(
			'required' => array(
				'rule' => array('equalToField', 'password'),
				'message' => 'Re-type password')
		),
		'image' => array(
			'rule' => array(
				'extension', array('gif', 'jpeg', 'png', 'jpg')
			),
			'message' => 'Please supply a valid image.',
			'allowEmpty' => true
		),
		'birthdate' => array(
			'rule' => array('date', 'ymd'),
			'allowEmpty' => true,
			'message' => 'Enter a valid date in YYYY/MM/DD.'
		)
	);
	
	public function beforeSave($options = array()){
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
		}
		return true;
	}
	
	public function equalToField($array, $field) {
		return strcmp($this->data[$this->alias][key($array)], $this->data[$this->alias][$field]) == 0;
}
}
?>