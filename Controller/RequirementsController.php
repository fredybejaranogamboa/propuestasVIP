<?php

Class RequirementsController extends AppController {

    public $name = 'Requirements';

    function edit($id) {
        $this->Requirement->recursive = -1;
        if (empty($this->data)) {
   App::Import('model','Call');
            $Call=new Call ();
            $Call->recursive=-1;
            $this->set('calls', $Call->find('list', array('fields' => array('Call.id', 'Call.nombre'))));
            $this->data = $this->Requirement->find('first', array('conditions' => array('Requirement.id' => $id), 'fields' => array('Requirement.*')));
        } else {

            if ($this->Requirement->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Requirements', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function add() {
        if (empty($this->data)) {
            App::Import('model','Call');
            $Call=new Call ();
            $Call->recursive=-1;
             $this->set('calls',$Call->find('list',array('fields'=>array('Call.id','Call.nombre')))) ;
        } else {

            if ($this->Requirement->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Requirements', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function index() {
        $this->paginate = array('Requirement' => array('maxLimit' => 500, 'limit' => 50, 'order'=>array('Requirement.id'=>'DESC'), 'fields' => array('Requirement.id', 'Requirement.nombre', 'Requirement.tipo', 'Requirement.texto_ayuda', 'Requirement.id')));
        $this->set('Requirements', $this->paginate());
    }

}

?>