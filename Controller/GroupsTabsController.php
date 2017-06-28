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
class GroupsTabsController extends AppController {

    var $name = "GroupsTabs";

    function edit($id) {
        $this->set('id', $id);
        if (!empty($this->data)) {
            $this->GroupsTab->deleteAll(array('GroupsTab.group_id' => $id), false);
            $flag = 0;
            foreach ($this->data['tabs'] as $tab) {
                if ($tab != 0) {
                    $data = array(
                        'GroupsTab' => array(
                            'group_id' => $id,
                            'tab_id' => $tab
                        )
                    );
                    if ($this->GroupsTab->save($data)) {
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
            $menus = $this->GroupsTab->find('all', array('conditions' => array('GroupsTab.group_id' => $id)));
            App::Import('model', 'Tab');
            $tab = new Tab();
            $tabs = $tab->find('all', array('fields' => array('Tab.id', 'Tab.titulo')));
            $this->set('tabs', $tabs);
        }
    }

}

?>
