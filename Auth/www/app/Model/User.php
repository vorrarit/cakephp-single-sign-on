<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'username';

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {

			if (isset($this->data[$this->alias]['id'])) {
				$id = $this->data[$this->alias]['id'];
				$user = $this->findById($id);
			} else {
				$id = false;
			}

			if (!$id || $user['User']['password'] != $this->data[$this->alias]['password']) {
				$passwordHasher = new BlowfishPasswordHasher();
				$this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
			}
		}
		return true;
	}
}
