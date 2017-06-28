<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class EntitiesController extends AppController {

    var $name = 'Entities';

    public function index() {
        if (!$this->RequestHandler->isAjax()) {
            $this->layout = "default";
        } else {
            $this->layout = "ajax";
        }
        $this->Entity->recursive = -1;
        $this->set('entities', $this->Entity->find("all", array('fields' => array('Entity.*'))));
    }

    public function add() {
        $this->layout = 'ajax';
        if (!empty($this->data)) {
            if ($this->Entity->save($this->data)) {
                $this->Session->setFlash("Controlador creado con éxito", 'flash');
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function edit($id) {
        if (empty($this->data)) {
            $this->Entity->recursive = -1;
            $this->data = $this->Entity->find("first", array("conditions" => array("Entity.id" => $id)));
        } else {
            if ($this->Entity->save($this->data)) {
                $this->Session->setFlash('Controlador editado con éxito', 'flash');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash("Error guardando datos", 'flash');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            }
        }
    }

    public function delete($id) {
        if ($this->Entity->delete($id)) {
            $this->Session->setFlash('Controlador borrado con éxito', 'flash');
            $this->redirect(array('action' => 'index'));
        } else {
            $this->Session->setFlash("Error guardando datos", 'flash');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        }
    }

}

?>