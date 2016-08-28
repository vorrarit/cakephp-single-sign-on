<?php
App::uses('AppController', 'Controller');

class OAuth2Controller extends AppController {

	public $uses = array('User', 'Application', 'AccessToken');
	public $components = array('Paginator', 'Flash', 'Session', 'RequestHandler');

	public function beforeFilter() {
		$this->Auth->allow('login', 'authRequest', 'tokenRequest', 'logout');
		parent::beforeFilter();
	}

	public function login($clientId) {
		header('X-Frame-Options: DENY');

		$application = $this->Application->findByClientId($clientId);

		if (empty($application)) {
			return $this->redirect('/');
		}

		if ($this->request->is('post')) {
			$this->request->data['User'] = $this->request->data['OAuth2'];
			if ($this->Auth->login()) {
				// $this->Session->write($application['Application']['id'] . '_redirect', $this->Session->read('redirect'));
				return $this->redirect('/OAuth2/authRequest/' . $clientId);
			} else {
				$this->Flash->error(
					__('Username or password is incorrect')
				);
			}
		}

		$this->set(compact('application'));
	}

	public function authRequest($clientId) {
		header('X-Frame-Options: DENY');

		$currentUser = AuthComponent::user();

		if (empty($currentUser)) {
			return $this->redirect(array('action'=>'login', $clientId));
		}

		$application = $this->Application->findByClientId($clientId);

		if (empty($application)) {
			return $this->redirect('/');
		}

		if ($this->request->is('post')) {
			$this->AccessToken->deleteAll(
				array(
					'application_id' => $application['Application']['id'],
					'resource_owner_id' => $currentUser['id']
				)
			);

			$authCode = $application['Application']['id'] . '_' . mt_rand(100000, 999999);
			$data = array('AccessToken'=>array(
				'application_id' => $application['Application']['id'],
				'resource_owner_id' => $currentUser['id'],
				'auth_code' => $authCode
			));

			$this->AccessToken->create();
			$this->AccessToken->save($data);

			$redirectUrl = $application['Application']['redirect_url'];
			$redirectUrl .= (strpos($redirectUrl, '?') !== FALSE? '': '?');
			return $this->redirect($redirectUrl . 'authCode=' . $authCode);
		}
	}

	public function tokenRequest() {
		$bError = false;
		$sErrorMessage = '';

		if ($this->request->is('post')) {
			$data = $this->request->input('json_decode', true);

			//TODO: validate input data

			if (!$bError) {
				$application = $this->Application->findByClientId($data['clientId']);

				if (empty($application)) {
					$bError = true;
					$sErrorMessage = 'Invalid client ID';
				}
			}

			if (!$bError) {
				$accessToken = $this->AccessToken->find('first', array('conditions'=>array(
					'client_id' => $data['clientId'],
					'auth_code' => $data['authCode'],
					'secret' => $data['secret'],
					'access_token is null'
				)));
			}

			if (empty($accessToken)) {
				$bError = true;
				$sErrorMessage = 'Cannot find a valid token';
			}

			if (!empty($accessToken)) {
				$token = $application['Application']['id'] . '_' . mt_rand(100000, 999999);
				$accessToken['AccessToken']['access_token'] = $token;
				$accessToken['AccessToken']['token_expiry_date'] = '2016-12-31 00:00:00';
				$this->AccessToken->save($accessToken);
			}
		} else {
			$bError = true;
			$sErrorMessage = 'Invalid request';
		}

		if (!$bError) {
			$result = array(
				'success' => 'OK',
				'accessToken' => $accessToken['AccessToken']['access_token']
			);
		} else {
			$result = array(
				'success' => 'Error',
				'errorMessage' => $sErrorMessage
			);
		}

		$this->set(compact('result'));
		$this->set('_serialize', array('result'));

	}

	public function getUser() {
		$bError = false;
		$sErrorMessage = '';

		if ($this->request->is('get')) {
			$data = $this->request->input('json_decode', true);

			//TODO: validate input data

			if (!$bError) {
				$accessToken = $this->AccessToken->find('first', array(
					'conditions' => array(
						'access_token' => $data['accessToken'],
						// 'access_token' => $this->request->query['accessToken'],
						'token_expiry_date > ' => date('Y-m-d H:i:s')
					)
				));

				if (empty($accessToken)) {
					$bError = true;
					$sErrorMessage = 'Cannot find a valid token';
				}
			}

			if (!$bError) {
				$user = $this->User->findById($accessToken['AccessToken']['resource_owner_id']);

				if (empty($user)) {
					$bError = true;
					$sErrorMessage = 'Invalid resource';
				} else {
					unset($user['User']['password']);
				}
			}

		}


		if (!$bError) {
			$result = array(
				'success' => 'OK',
				'data' => $user
			);
		} else {
			$result = array(
				'success' => 'Error',
				'errorMessage' => $sErrorMessage
			);
		}

		$this->set(compact('result'));
		$this->set('_serialize', array('result'));

	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}
}
