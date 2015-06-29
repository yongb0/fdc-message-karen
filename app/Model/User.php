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
				'rule' => array('isUnique', 'email'),
				'message' => 'Invalid email. Email already exists or invalid format.'
		),
		'password' => array(
				'rule' => 'passwordValidate',
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
	
	public function equalToField($array, $field){
		return strcmp($this->data[$this->alias][key($array)], $this->data[$this->alias][$field]) == 0;
	}
	
	public function passwordValidate($data){
		$value = array_values($data);
		$value = $value[0];
		return 	preg_match('/^[a-zA-Z0-9]{6,}+$/', $value);
	}
}
?>