<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * 
 *
 * @author 250-1-405
 */
class ActionsGroupsController extends AppController {

    var $name = "ActionsGroups";

    public function edit($id) {
        $this->layout = "ajax";
        $this->set('id', $id);
        if (!empty($this->data)) {
            $this->ActionsGroup->deleteAll(array('ActionsGroup.group_id' => $id), false);
            $flag = 0;

            foreach ($this->data['actions'] as $act) {
                if ($act != 0) {
                    $data = array(
                        'ActionsGroup' => array(
                            'group_id' => $id,
                            'action_id' => $act
                        )
                    );
                    if ($this->ActionsGroup->saveAll($data)) {
                        $flag = 1;
                    }
                }
            }
            if ($flag == 1) {
                $this->Session->setFlash('Registros guardados correctamente', 'flash');
                $this->redirect(array('controller' => 'Groups', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error', 'flash_error');
                $this->redirect(array('controller' => 'Groups', 'action' => 'index'));
            }
        } else {
            $menus = $this->ActionsGroup->find('all', array('conditions' => array('ActionsGroup.group_id' => $id)));
            App::Import('model', 'Action');
            $action = new Action();
            $action->recursive = 1;
            $actions = $action->find('all', array('fields' => array('Action.*', 'Entity.name')));
            $this->set('actions', $actions);
        }
    }

}

?>
