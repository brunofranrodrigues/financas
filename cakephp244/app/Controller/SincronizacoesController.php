<?php
App::uses('AppController', 'Controller');

class SincronizacoesController extends AppController {

	var $uses = array("Sincronizacao");
	

	public function financas_sinc(){
		$filename = WWW_ROOT. 'files' . DS . 'extrato.txt';

		if (file_exists($filename)) {
			$this->set('vw_dados',$this->Sincronizacao->executaSinc('extrato.txt'));
		} else {
			$this->Session->setFlash(__('O arquivo para a importacao nao existe'));
		}
		

	}
}
?>