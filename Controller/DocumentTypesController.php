<?php

Class DocumentTypesController extends AppController {

    public $name = 'DocumentTypes';

    public function add() {
        $this->layout = "ajax";
        if (empty($this->data)) {
            
        } else {

            if ($this->DocumentType->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente');
                $this->redirect(array('controller' => 'DocumentTypes', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    public function edit($id) {
        $this->layout = "ajax";
        $this->DocumentType->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->DocumentType->find('first', array('conditions' => array('DocumentType.id' => $id), 'fields' => array('DocumentType.name', 'DocumentType.id')));
        } else {

            if ($this->DocumentType->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente');
                $this->redirect(array('controller' => 'DocumentTypes', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function index() {
        $this->layout = "ajax";
        $this->DocumentType->recursive = -1;
        $this->paginate = array('DocumentType' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('DocumentType.name', 'DocumentType.id')));
        $this->set('DocumentTypes', $this->paginate());
    }

    public function delete($id) {
        if ($this->DocumentType->delete($id)) {
            $this->Session->setFlash('Tipo de documento eliminado correctamente', 'flash');
            $this->redirect(array('controller' => 'DocumentType', 'action' => 'index'));
        } else {
            $this->redirect(array('controller' => 'pages', 'action' => 'error', "Error borrando los datos"));
        }
    }

}

?>