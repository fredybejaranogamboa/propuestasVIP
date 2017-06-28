<?php

Class TitleStudiesController extends AppController {

    public $name = 'TitleStudies';

    public function index($property_id) {
        //$this->layout = "ajax";
        $this->TitleStudy->recursive = -1;
        $this->set('property_id', $property_id);
        $this->paginate = array('TitleStudy' => array('recursive' => 1, 'maxLimit' => 500, 'limit' => 50, 'fields' => array('TitleStudy.*')));
        $this->set('TitleStudies', $this->paginate(array('TitleStudy.property_id' => $property_id)));
    }

    public function add($property_id) {
        $this->layout = "ajax";
        $this->set('property_id', $property_id);
        if (!empty($this->data)) {
            if ($this->TitleStudy->save($this->data)) {
                $this->Session->setFlash('Registro adicionado correctamente', 'flash_custom');
                //$this->redirect(array('controller' => 'Properties', 'action' => 'property_index', $property_id));

                $this->redirect(array('controller' => 'TitleStudies', 'action' => 'index', $property_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    public function edit($id) {
        $this->layout = "ajax";
        $this->TitleStudy->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->TitleStudy->find('first', array('conditions' => array('TitleStudy.id' => $id), 'fields' => array('TitleStudy.*')));
        } else {
            if ($this->TitleStudy->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'TitleStudies', 'action' => 'index', $this->data['TitleStudy']['property_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function delete($id, $property_id) {
        $this->layout = "ajax";
        if ($this->TitleStudy->delete($id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'TitleStudies', 'action' => 'index', $property_id));
        } else {
            $this->Session->setFlash('Error Eliminando datos');
        }
    }

}