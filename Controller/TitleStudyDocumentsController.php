<?php

Class TitleStudyDocumentsController extends AppController {

    public $name = 'TitleStudyDocuments';

    public function index($title_study_id, $property_id) {
        //$this->layout = "ajax";
        $this->TitleStudyDocument->recursive = -1;
        $this->set('title_study_id', $title_study_id);
        $this->set('property_id', $property_id);
        $this->paginate = array('TitleStudyDocument' => array('recursive' => 1, 'maxLimit' => 500, 'limit' => 50, 'fields' => array('TitleStudyDocument.*')));
        $this->set('TitleStudyDocuments', $this->paginate(array('TitleStudyDocument.title_study_id' => $title_study_id)));
    }

    public function add($title_study_id, $property_id) {
        $this->layout = "ajax";
        $this->set('property_id', $property_id);
        $this->set('title_study_id', $title_study_id);
        if (!empty($this->data)) {
            if ($this->TitleStudyDocument->save($this->data)) {
                $this->Session->setFlash('Registro adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'TitleStudyDocuments', 'action' => 'index', $title_study_id, $property_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    public function edit($id, $property_id) {
        $this->layout = "ajax";
        $this->TitleStudyDocument->recursive = -1;
        $this->set('property_id', $property_id);
        if (empty($this->data)) {
            $this->data = $this->TitleStudyDocument->find('first', array('conditions' => array('TitleStudyDocument.id' => $id), 'fields' => array('TitleStudyDocument.*')));
        } else {
            if ($this->TitleStudyDocument->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'TitleStudyDocuments', 'action' => 'index', $this->data['TitleStudyDocument']['title_study_id'], property_id));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function delete($id, $title_study_id, $property_id) {
        $this->layout = "ajax";
        if ($this->TitleStudyDocument->delete($id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'TitleStudyDocuments', 'action' => 'index', $title_study_id, $property_id));
        } else {
            $this->Session->setFlash('Error Eliminando datos');
        }
    }

}