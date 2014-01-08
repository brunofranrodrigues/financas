<?php
App::uses('AppController', 'Controller');
/**
 * Despesas Controller
 *
 * @property Despesa $Despesa
 * @property PaginatorComponent $Paginator
 */
class DespesasController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function financas_index() {
		$this->Despesa->recursive = 0;
		$this->set('despesas', $this->Paginator->paginate());
	}

// /**
//  * view method
//  *
//  * @throws NotFoundException
//  * @param string $id
//  * @return void
//  */
// 	public function financas_view($id = null) {
// 		if (!$this->Despesa->exists($id)) {
// 			throw new NotFoundException(__('Invalid despesa'));
// 		}
// 		$options = array('conditions' => array('Despesa.' . $this->Despesa->primaryKey => $id));
// 		$this->set('despesa', $this->Despesa->find('first', $options));
// 	}

/**
 * add method
 *
 * @return void
 */
	public function financas_add() {
		if ($this->request->is('post')) {
			$this->Despesa->create();
			if ($this->Despesa->save($this->request->data)) {
				$this->Session->setFlash(__('The despesa has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The despesa could not be saved. Please, try again.'));
			}
		}
		$capgtipos = $this->Despesa->Capgtipo->find('list');
		$usuarios = $this->Despesa->Usuario->find('list');
		$situacoes = $this->Despesa->Situacao->find('list');
		$this->set(compact('capgtipos', 'usuarios', 'situacoes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function financas_edit($id = null) {
		if (!$this->Despesa->exists($id)) {
			throw new NotFoundException(__('Invalid despesa'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Despesa->save($this->request->data)) {
				$this->Session->setFlash(__('The despesa has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The despesa could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Despesa.' . $this->Despesa->primaryKey => $id));
			$this->request->data = $this->Despesa->find('first', $options);
		}
		$capgtipos = $this->Despesa->Capgtipo->find('list');
		$usuarios = $this->Despesa->Usuario->find('list');
		$situacoes = $this->Despesa->Situacao->find('list');
		$this->set(compact('capgtipos', 'usuarios', 'situacoes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function financas_delete($id = null) {
		$this->Despesa->id = $id;
		if (!$this->Despesa->exists()) {
			throw new NotFoundException(__('Invalid despesa'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Despesa->delete()) {
			$this->Session->setFlash(__('The despesa has been deleted.'));
		} else {
			$this->Session->setFlash(__('The despesa could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
