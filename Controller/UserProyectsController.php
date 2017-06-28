<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_proyects_controller
 *
 * @author root
 */
App::uses('CakeEmail', 'Network/Email');

class UserProyectsController extends AppController {

    //put your code here
    var $name = "UserProyects";

    public function index($user_id) {
        $this->set('user_id', $user_id);
        $this->UserProyect->recursive = -1;
        $this->set('asignados', $this->UserProyect->find('all', array('conditions' => array('UserProyect.user_id' => $user_id), 'fields' => array('User.username', 'Proyect.codigo', 'UserProyect.*', 'Call.nombre'),
                    'joins' => array(
                        array('table' => 'users', 'type' => 'left', 'alias' => 'User', 'conditions' => array('User.id=UserProyect.user_id')),
                        array('table' => 'proyects', 'type' => 'left', 'alias' => 'Proyect', 'conditions' => array('Proyect.id=UserProyect.proyect_id')),
                        array('table' => 'calls', 'type' => 'left', 'alias' => 'Call', 'conditions' => array('Call.id=Proyect.call_id')),
        ))));
    }

    public function add($user_id) {
        $this->set('user_id', $user_id);
        if (!empty($this->data)) {
            if ($ide = $this->UserProyect->Proyect->field('id', array('Proyect.codigo' => $this->data['UserProyect']['codigo'], 'Proyect.call_id' => $this->data['UserProyect']['convocatoria']))) {
                $this->request->data['UserProyect']['proyect_id'] = $ide;

                if (!$this->UserProyect->find('first', array('conditions' => array('UserProyect.proyect_id' => $ide, 'UserProyect.user_id' => $user_id)))) {

                    if ($this->UserProyect->saveAll($this->data)) {

                        $usuario = $this->UserProyect->User->find('first', array('recursive' => -1, 'conditions' => array('User.id' => $this->data['UserProyect']['user_id']), 'fields' => array('User.email', 'User.branch_id', 'User.nombre', 'User.primer_apellido')));
                        $Email = new CakeEmail('gmail');
                        $Email->from(array('pdret.soporte@gmail.com' => 'Aplicativo PDRET'));
                        $body = "<p>Se le ha asignado el proyecto " . $this->data['UserProyect']['codigo'] . " para ser  evaluado.</p>";
                        $Email->addTo($usuario['User']['email']);
                        $Email->addTo($this->Auth->user('email'));
                        $Email->subject("ASIGNACIÓN  PROYECTO PARA EVALUACIÓN PDRET " . $this->data['UserProyect']['codigo']);
                        $Email->emailFormat('html');

                        if ($Email->send($body)) {

                            $this->Session->setFlash('Proyecto adicionado con éxito', 'flash');
                            $this->redirect(array('controller' => 'UserProyects', 'action' => 'index', $user_id));
                        } else {
                            $this->Session->setFlash("Error enviando el correo:  " . $mail->ErrorInfo);
                            $this->redirect(array('controller' => 'UserProyects', 'action' => 'index', $user_id));
                        }
                    } else {
                        $this->Session->setFlash('Error guardando los datos, intentelo nuevamente.', 'flash_error');
                    }
                } else {
                    $this->Session->setFlash('El usuario ya tiene asignado el proyecto ' . $this->data['UserProyect']['codigo'], 'flash_error');
                    $this->redirect(array('controller' => 'UserProyects', 'action' => 'index', $user_id));
                }
            } else {
                $this->Session->setFlash('No existe el proyecto', 'flash_error');
                $this->redirect(array('controller' => 'UserProyects', 'action' => 'add', $user_id));
            }
        } else {
            App::Import('model', 'Call');
            $call = new Call();
            $call->recursive = -1;
            $convocatorias = $call->find('all', array('fields' => array('Call.id', 'Call.nombre')));
            $this->set('convocatorias', $convocatorias);
            $this->request->data['UserProyect']['user_id'] = $user_id;
        }
    }

    public function delete($id, $user_id) {
        if ($this->UserProyect->delete($id)) {
            $this->Session->setFlash('Proyecto eliminado con éxito', 'flash');

            $this->redirect(array('controller' => 'UserProyects', 'action' => 'index', $user_id));
        } else {
            $this->Session->setFlash('Error eliminando la asignación', 'flash_error');
            $this->redirect(array('controller' => 'UserProyects', 'action' => 'index', $user_id));
        }
    }

}

?>
