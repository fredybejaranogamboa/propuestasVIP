<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of actions
 *
 * @author Fredy Bejarano
 */
class ActionsController extends AppController {

    //put your code here
    var $name = "Actions";

    public function index() {
        if (!$this->RequestHandler->isAjax()) {
            $this->layout = "default";
        } else {
            $this->layout = "ajax";
        }
        $this->Action->recursive = 1;
        $this->set('actions', $this->Action->find("all", array("fields" => array("Action.*", "Entity.name"))));
    }

    public function add() {
        $this->layout = "ajax";

        if (!empty($this->data)) {

            if ($this->Action->save($this->data)) {
                $this->Session->setFlash("Acción creada con éxito", 'flash');
                $this->redirect(array('action' => 'index'));
            }
        } else {
            $this->set('entities', $this->Action->Entity->find('list', array('order' => 'Entity.name ASC', 'fields' => array('Entity.id', 'Entity.name'))));
        }
    }

    public function edit($id) {
        $this->layout = "ajax";
        if (!empty($this->data)) {
            if ($this->Action->save($this->data)) {
                $this->Session->setFlash("Acción editada con éxito");
                $this->redirect(array('action' => 'index'));
            }
        } else {
            $this->set('entities', $this->Action->Entity->find('list', array('order' => 'Entity.name ASC', 'fields' => array('Entity.id', 'Entity.name'))));
            $this->data = $this->Action->find('first', array('conditions' => array('Action.id' => $id)));
        }
    }

    public function delete($id) {
        $this->layout = "ajax";
        if ($this->Action->delete($id)) {
            $this->Session->setFlash("Acción borrada con éxito", 'flash');
            $this->redirect(array('action' => 'index'));
        }
    }

}

?>
