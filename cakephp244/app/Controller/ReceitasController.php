<?php
App::uses('AppController', 'Controller');
/**
 * Receitas Controller
 *
 * @property Receita $Receita
 * @property PaginatorComponent $Paginator
 */
class ReceitasController extends AppController {

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
		$this->Receita->recursive = 0;
		$this->set('receitas', $this->Paginator->paginate());
	}

// /**
//  * view method
//  *
//  * @throws NotFoundException
//  * @param string $id
//  * @return void
//  */
// 	public function financas_view($id = null) {
// 		if (!$this->Receita->exists($id)) {
// 			throw new NotFoundException(__('Invalid receita'));
// 		}
// 		$options = array('conditions' => array('Receita.' . $this->Receita->primaryKey => $id));
// 		$this->set('receita', $this->Receita->find('first', $options));
// 	}

	public function financas_relatorio($usuario=null,$categoria=null,$periodo=null) {
		
		$params='';
		
		if (!is_null($usuario)){
				$params = array(
				'conditions' => array(
				'Receita.usuario_id' => $usuario,
	 			),
			);
		}

		if (!is_null($categoria)){
				$params = array(
				'conditions' => array(
				'Receita.cartipo_id' => $categoria,
	 			),
			);
		}

		if (!is_null($periodo)){
				$params = array(
				'conditions' => array(
				'Receita.data_pg LIKE' => $periodo
	 			),
			);
		}

		if ($this->request->is('post')) {
			$this->set('receitas', $this->Receita->find('all', $params));
		}
		$cartipos = $this->Receita->Cartipo->find('list');
		$usuarios = $this->Receita->Usuario->find('list');
		$situacoes = $this->Receita->Situacao->find('list');
		$this->set(compact('cartipos', 'usuarios', 'situacoes'));
	}

/**
 * add method
 *
 * @return void
 */
	public function financas_add() {
		if ($this->request->is('post')) {
			$this->Receita->create();
			if ($this->Receita->save($this->request->data)) {
				$this->Session->setFlash(__('The receita has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The receita could not be saved. Please, try again.'));
			}
		}
		$cartipos = $this->Receita->Cartipo->find('list');
		$usuarios = $this->Receita->Usuario->find('list');
		$situacoes = $this->Receita->Situacao->find('list');
		$this->set(compact('cartipos', 'usuarios', 'situacoes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function financas_edit($id = null) {
		if (!$this->Receita->exists($id)) {
			throw new NotFoundException(__('Invalid receita'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Receita->save($this->request->data)) {
				$this->Session->setFlash(__('The receita has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The receita could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Receita.' . $this->Receita->primaryKey => $id));
			$this->request->data = $this->Receita->find('first', $options);
		}
		$cartipos = $this->Receita->Cartipo->find('list');
		$usuarios = $this->Receita->Usuario->find('list');
		$situacoes = $this->Receita->Situacao->find('list');
		$this->set(compact('cartipos', 'usuarios', 'situacoes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function financas_delete($id = null) {
		$this->Receita->id = $id;
		if (!$this->Receita->exists()) {
			throw new NotFoundException(__('Invalid receita'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Receita->delete()) {
			$this->Session->setFlash(__('The receita has been deleted.'));
		} else {
			$this->Session->setFlash(__('The receita could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
