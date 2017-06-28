<?php

Class BranchesController extends AppController {

    public $name = 'Branches';

    public function add() {
        if (!empty($this->data)) {
            if ($this->Branch->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash');
                $this->redirect(array('controller' => 'Branches', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error Guardando datos', 'flash_error');
            }
        }
    }

    public function edit($id) {
        if (empty($this->data)) {
            $this->Branch->recursive = -1;
            $this->data = $this->Branch->find('first', array('fields' => array('Branch.*'), 'conditions' => array('Branch.id' => $id)));
        } else {
            if ($this->Branch->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash');
                $this->redirect(array('controller' => 'Branches', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error editando datos', 'flash_error');
            }
        }
    }

    public function index() {
        if (!$this->RequestHandler->isAjax()) {
            $this->layout = "default";
        } else {
            $this->layout = "ajax";
        }
        $this->set('Branches', $this->Branch->find('all', array('order' => array('Branch.nombre' => 'ASC'), 'recursive' => -1, 'fields' => array('Branch.*'))));
    }

    public function delete($id) {
        if ($this->Branch->delete($id)) {
            $this->Session->setFlash('Territorial eliminada correctamente', 'flash');
            $this->redirect(array('controller' => 'Branches', 'action' => 'index'));
        } else {
            $this->Session->setFlash('Error borrando datos', 'flash_error');
            $this->redirect(array('controller' => 'pages', 'action' => 'display'));
        }
    }

}

?>