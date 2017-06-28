<?php

Class CitiesController extends AppController {

    public $name = 'Cities';

    public function edit($id) {
        $this->layout = "ajax";
        $this->set('departaments', $this->City->Departament->find('list'));
        $this->City->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->City->find('first', array('conditions' => array('City.id' => $id), 'fields' => array('City.*')));
        } else {

            if ($this->City->save($this->data)) {
                $this->Session->setFlash('Municipio editado con éxito.', 'flash');
                $this->redirect(array('controller' => 'Cities', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function add() {
        $this->layout = "ajax";
        $this->set('departaments', $this->City->Departament->find('list'));
        if (empty($this->data)) {
            
        } else {

            if ($this->City->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente');
                $this->redirect(array('controller' => 'Cities', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    public function index() {
        if (!$this->RequestHandler->isAjax()) {
            $this->layout = "default";
        } else {
            $this->layout = "ajax";
        }
        $cities = $this->City->find('all', array('order'=>array('City.name ASC'), 'fields'=>array('City.id', 'City.name', 'City.divipol', 'Departament.name')));
        $this->set('Cities', $cities);
    }

}

?>