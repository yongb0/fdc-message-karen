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
	
	public function afterFind($results, $primary = false){
		if($this->controllerAction == 'show') {
			$tempArray = array();
			
			foreach ($results as $array1) {
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
	
}	
?>