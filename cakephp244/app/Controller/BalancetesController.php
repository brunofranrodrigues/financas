<?php
App::uses('AppController', 'Controller');
/**
 * Balancetes Controller
 *
 * @property Balancete $Balancete
 * @property PaginatorComponent $Paginator
 */
class BalancetesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');


	function financas_import() {
        $messages = $this->Balancete->import('extrato.csv');
        //debug($messages);
    }

/**
 * index method
 *
 * @return void
 */
	public function financas_index() {
		$this->Balancete->recursive = 0;
		$this->set('balancetes', $this->Paginator->paginate());
	}

// /**
//  * view method
//  *
//  * @throws NotFoundException
//  * @param string $id
//  * @return void
//  */
// 	public function financas_view($id = null) {
// 		if (!$this->Balancete->exists($id)) {
// 			throw new NotFoundException(__('Invalid balancete'));
// 		}
// 		$options = array('conditions' => array('Balancete.' . $this->Balancete->primaryKey => $id));
// 		$this->set('balancete', $this->Balancete->find('first', $options));
// 	}

/**
 * add method
 *
 * @return void
 */
	public function financas_add() {
		if ($this->request->is('post')) {
			$this->Balancete->create();
			if ($this->Balancete->save($this->request->data)) {
				$this->Session->setFlash(__('The balancete has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The balancete could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function financas_edit($id = null) {
		if (!$this->Balancete->exists($id)) {
			throw new NotFoundException(__('Invalid balancete'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Balancete->save($this->request->data)) {
				$this->Session->setFlash(__('The balancete has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The balancete could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Balancete.' . $this->Balancete->primaryKey => $id));
			$this->request->data = $this->Balancete->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function financas_delete($id = null) {
		$this->Balancete->id = $id;
		if (!$this->Balancete->exists()) {
			throw new NotFoundException(__('Invalid balancete'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Balancete->delete()) {
			$this->Session->setFlash(__('The balancete has been deleted.'));
		} else {
			$this->Session->setFlash(__('The balancete could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
