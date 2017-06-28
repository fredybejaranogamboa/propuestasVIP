<?php

Class DepartamentsController extends AppController {

    public $name = 'Departaments';

    public function add() {
        $this->layout = "ajax";
        if (empty($this->data)) {
            
        } else {

            if ($this->Departament->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente');
                $this->redirect(array('controller' => 'Departaments', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    public function edit($id) {
        $this->layout = "ajax";
        $this->Departament->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->Departament->find('first', array('conditions' => array('Departament.id' => $id), 'fields' => array('Departament.*')));
        } else {
            if ($this->Departament->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash');
                $this->redirect(array('controller' => 'Departaments', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function index() {
        if (!$this->RequestHandler->isAjax()) {
            $this->layout = "default";
        } else {
            $this->layout = "ajax";
        }
        $this->Departament->recursive = -1;
        $departaments = $this->Departament->find('all', array('order' => array('Departament.name ASC'), 'fields' => array('Departament.*')));
        $this->set('Departaments', $departaments);
    }

}

?>