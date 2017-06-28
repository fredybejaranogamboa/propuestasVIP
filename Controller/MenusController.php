<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class MenusController extends AppController {

    var $name = 'Menus';

    public function index() {
        if (!$this->RequestHandler->isAjax()) {
            $this->layout = "default";
        } else {
            $this->layout = "ajax";
        }
        $this->Menu->recursive = 0;
        $menus = $this->Menu->find("all", array('order' => array('Menu.orden ASC'), "fields" => array("Menu.id", "Menu.nombre", "Menu.url", "Menu.icono", 'Menu.alias', 'Menu.orden')));
        $this->set('menus', $menus);
    }

    public function add() {
        $this->layout = 'ajax';
        if (!empty($this->data)) {
            if ($this->Menu->save($this->data)) {
                $this->Session->setFlash("Menú Creado con exito", 'flash');
                $this->redirect(array('controller' => 'Menus', 'action' => 'index'));
            };
        }
    }

//    public function ver($id) {
//        error_reporting(0);
//        $this->layout = 'ajax';
//        $grupo = $this->Auth->user('group_id');
//
//        $options['conditions'] = array('Menu.tab_id' => $id, 'GroupsItem.group_id' => $grupo);
//        $options['fields'] = array('Menu.id', 'Menu.icono', 'Menu.nombre', 'Item.nombre', 'Item.controlador', 'Item.accion');
//        $options['joins'] = array(
//            array('table' => 'items',
//                'alias' => 'Item',
//                'type' => 'LEFT',
//                'conditions' => array(
//                    'Menu.id = Item.menu_id',
//                )
//            ),
//            array('table' => 'groups_items',
//                'alias' => 'GroupsItem',
//                'type' => 'LEFT',
//                'conditions' => array(
//                    'Item.id = GroupsItem.item_id',
//                )
//            )
//        );
//        $options['order'] = array('Menu.orden ASC', 'Item.orden ASC');
//
//        $lista = $this->Menu->find('all', $options);
//        $this->set('listado', $lista);
//    }

    public function edit($id = null) {
        $this->layout = "ajax";
        if (empty($this->data)) {
            $this->data = $this->Menu->find("first", array("conditions" => array("Menu.id" => $id)));
        } else {
            if ($this->Menu->save($this->data)) {
                $this->Session->setFlash('Menu Editado con éxito', 'flash');
                $this->redirect(array('controller' => 'Menus', 'action' => 'index'));
            }
        }
    }

    public function delete($id) {
        if ($this->Menu->delete($id)) {
            $this->Session->setFlash('Menú Borrado con exito', 'flash');
            $this->redirect(array('controller' => 'Menus', 'action' => 'index'));
        }
    }

}

?>