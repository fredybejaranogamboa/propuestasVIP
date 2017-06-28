<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of City_proyects_controller
 *
 * @author root
 */
class BranchUsersController extends AppController {

    //put your code here
    var $name = "BranchUsers";

    public function index($branch_id = null) {
        $this->set('branch_id', $branch_id);
        $this->BranchUser->recursive = 1;
        $this->set('territorial', $this->BranchUser->Branch->field('nombre', array('Branch.id' => $branch_id)));
        $this->set('users', $this->BranchUser->find('all', array('conditions' => array('BranchUser.branch_id' => $branch_id), 'fields' => array('User.username', 'User.nombre', 'User.email', 'User.primer_apellido', 'User.segundo_apellido', 'BranchUser.*'))));
    }

    public function add($branch_id) {
        $this->set('users', $this->BranchUser->User->find('all', array('order' => array('User.primer_apellido' => 'ASC'), 'fields' => array('User.id', 'User.nombre', 'User.primer_apellido', 'User.segundo_apellido'), 'recursive' => -1, 'conditions' => array('User.group_id' => array(18, 1, 17)))));
        $this->set('branch_id', $branch_id);
        if (!empty($this->data)) {
            if (!$this->BranchUser->find('first', array('conditions' => array('BranchUser.branch_id' => $branch_id, 'BranchUser.user_id' => $this->request->data['BranchUser']['user_id'])))) {
                if ($this->BranchUser->saveAll($this->data)) {
                    $this->Session->setFlash('Usuario adicionado con éxito', 'flash');
                    $this->redirect(array('controller' => 'BranchUsers', 'action' => 'index', $branch_id));
                } else {
                    $this->Session->setFlash('Error guardando los datos', 'flash_error');
                    $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
                }
            } else {
                $this->Session->setFlash('El usuario ya se encuentra asociado a la DT', 'flash_error');
                $this->redirect(array('controller' => 'BranchUsers', 'action' => 'index', $branch_id));
            }
        }
    }

    public function delete($id, $branch_id = null) {
        if ($this->BranchUser->delete($id)) {
            $this->Session->setFlash('Usuario desasociado con éxito', 'flash');
            $this->redirect(array('controller' => 'BranchUsers', 'action' => 'index', $branch_id));
        }
    }

}

?>
