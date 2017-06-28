<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of groups_controller
 *
 * @author 250-1-405
 */
class GroupsItemsController extends AppController {

    var $name = "GroupsItems";

    function edit($id) {
        $this->layout = "ajax";
        $this->set('id', $id);
        if (!empty($this->data)) {
            $this->GroupsItem->deleteAll(array('GroupsItem.group_id' => $id), false);
            $flag = 0;
            foreach ($this->data['items'] as $itm) {
                if ($itm != 0) {
                    //$this->GroupsItem->create();
                    $data = array(
                        'GroupsItem' => array(
                            'group_id' => $id,
                            'item_id' => $itm
                        )
                    );
                    if ($this->GroupsItem->save($data)) {
                        $flag = 1;
                    }
                }
            }
            if ($flag == 1) {
                $this->Session->setFlash('Registros guardados correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Groups', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error', 'flash_custom');
                $this->redirect(array('controller' => 'Groups', 'action' => 'index'));
            }
        } else {
            $menus = $this->GroupsItem->find('all', array('conditions' => array('GroupsItem.group_id' => $id)));
            App::Import('model', 'Item');
            $item = new Item();
            $items = $item->find('all', array('fields' => array('Item.id', 'Item.nombre', 'Item.controlador', 'Item.accion')));
            $this->set('items', $items);
        }
    }

//function beforeFilter() {parent::beforeFilter();$this->Auth->allowedActions = array('*');}
}

?>
