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
				'rule' => array('isUnique', 'email', 'notEmpty'),
				'message' => 'Invalid email. Email already exists or invalid format. And must not be empty.')
		),
		'password' => array(
				'rule' => array('passwordValidate','notEmpty'),
				'message' => 'Invalid password. Only numbers, letters and at least 6 characters.'
		),
		're_password' => array(
				'rule' => array('equalToField', 'password'),
				'message' => 'Input does not match with password.'
		),
		'image' => array(
			'rule' => array(
				'extension', array('gif', 'jpeg', 'png', 'jpg')
			),
			'message' => 'Please supply a valid image.',
			'allowEmpty' => true
		),
		'birthdate' => array(
			'rule' => array('date', 'ymd')
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
	
	public function passwordValidate($data){
		$value = array_values($data);
		$value = $value[0];
		return 	preg_match('/^[a-zA-Z0-9]{6,}+$/', $value);
	}
}
?>