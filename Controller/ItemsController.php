<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ItemsController extends AppController {

    var $name = "Items";
    var $components = array('RequestHandler');

    public function index() {
        if (!$this->RequestHandler->isAjax()) {
            $this->layout = "default";
        } else {
            $this->layout = "ajax";
        }
        $this->set('items', $this->Item->find("all", array('recursive' => 0, 'order' => array('Item.menu_id ASC', 'Item.orden ASC'))));
    }

    public function add() {
        $this->layout = "ajax";
        $this->set('menus', $this->Item->Menu->find('list', array('order' => 'nombre ASC', 'fields' => array('Menu.id', 'Menu.nombre'))));

        if (!empty($this->data)) {
            if ($this->Item->save($this->data)) {
                $this->Session->setFlash("Item adicionado con éxito");
                $this->redirect(array('controller' => 'Items', 'action' => 'index'));
            } else {
                $this->Session->setFlash("Error Guardando Datos");
            }
        }
    }

    public function edit($id = null) {
        $this->layout = "ajax";
        if (!empty($this->data)) {
            if ($this->Item->save($this->data)) {
                $this->Session->setFlash("Item editado con éxito");
                $this->redirect(array('controller' => 'Items', 'action' => 'index'));
            } else {
                $this->set('menus', $this->Item->Menu->find('list', array('order' => 'nombre ASC', 'fields' => array('Menu.id', 'Menu.nombre'))));
            }
        } else {
            $this->data = $this->Item->find("first", array("conditions" => array("Item.id" => $id)));
            //$this->data=$this->Item->findById($id);
            $this->set('menus', $this->Item->Menu->find('list', array('order' => 'nombre ASC', 'fields' => array('Menu.id', 'Menu.nombre'))));
        }
    }

    public function delete($id) {
        $this->layout = "ajax";
        if ($this->Item->delete($id)) {
            $this->Session->setFlash('Item Borrado con exito');
            $this->redirect(array('controller' => 'Items', 'action' => 'index'));
        }
    }

}

?>
