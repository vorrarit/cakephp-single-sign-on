<?php
App::uses('AppController', 'Controller');
/**
 * AccessTokens Controller
 *
 * @property AccessToken $AccessToken
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class AccessTokensController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->AccessToken->recursive = 0;
		$this->set('accessTokens', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AccessToken->exists($id)) {
			throw new NotFoundException(__('Invalid access token'));
		}
		$options = array('conditions' => array('AccessToken.' . $this->AccessToken->primaryKey => $id));
		$this->set('accessToken', $this->AccessToken->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AccessToken->create();
			if ($this->AccessToken->save($this->request->data)) {
				$this->Flash->success(__('The access token has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The access token could not be saved. Please, try again.'));
			}
		}
		$applications = $this->AccessToken->Application->find('list');
		$this->set(compact('applications'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->AccessToken->exists($id)) {
			throw new NotFoundException(__('Invalid access token'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->AccessToken->save($this->request->data)) {
				$this->Flash->success(__('The access token has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The access token could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AccessToken.' . $this->AccessToken->primaryKey => $id));
			$this->request->data = $this->AccessToken->find('first', $options);
		}
		$applications = $this->AccessToken->Application->find('list');
		$this->set(compact('applications'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->AccessToken->id = $id;
		if (!$this->AccessToken->exists()) {
			throw new NotFoundException(__('Invalid access token'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->AccessToken->delete()) {
			$this->Flash->success(__('The access token has been deleted.'));
		} else {
			$this->Flash->error(__('The access token could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
