<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of annotations_controller
 *
 * @author Fredy Bejarano
 */

Class AnnotationsController extends AppController {

    public $name = 'Annotations';

    public function index($title_study_id, $property_id) {
        //$this->layout = "ajax";
        $this->Annotation->recursive = -1;
        $this->set('title_study_id', $title_study_id);
        $this->set('property_id', $property_id);
        $this->paginate = array('Annotation' => array('recursive' => 1, 'maxLimit' => 500, 'limit' => 50, 'fields' => array('Annotation.*')));
        $this->set('Annotations', $this->paginate(array('Annotation.title_study_id' => $title_study_id)));
    }

    public function add($title_study_id, $property_id) {
        $this->layout = "ajax";
        $this->set('title_study_id', $title_study_id);
        $this->set('property_id', $property_id);
        if (!empty($this->data)) {
            $this->request->data['Annotation']['limita_ejecucion'] = "";
            switch ($this->data['Annotation']['tipo_principal']) {
                case 'Falsa tradición':
                    $this->request->data['Annotation']['tipo_secundario'] = $this->data['Annotation']['tipo_secundario1'];
                    break;
                case 'Gravamen':
                    $this->request->data['Annotation']['tipo_secundario'] = $this->data['Annotation']['tipo_secundario2'];
                    break;
                case 'Limitación al derecho de dominio':
                    $this->request->data['Annotation']['tipo_secundario'] = $this->data['Annotation']['tipo_secundario3'];
                    $this->request->data['Annotation']['limita_ejecucion'] = $this->data['Annotation']['limita_ejecucion1'];
                    break;
                case 'Medida cautelar':
                    $this->request->data['Annotation']['tipo_secundario'] = $this->data['Annotation']['tipo_secundario4'];
                    break;
                case 'Título de tenencia':
                    $this->request->data['Annotation']['tipo_secundario'] = $this->data['Annotation']['tipo_secundario5'];
                    break;
                case 'Otra circunstancia':
                    $this->request->data['Annotation']['tipo_secundario'] = $this->data['Annotation']['tipo_secundario6'];
                    break;

                default:
                    $this->request->data['Annotation']['tipo_secundario'] = "";
                    break;
            }
            if ($this->Annotation->save($this->data)) {
                $this->Session->setFlash('Registro adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Annotations', 'action' => 'index', $title_study_id, $property_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    public function edit($id, $property_id) {
        $this->layout = "ajax";
        $this->Annotation->recursive = -1;
        $this->set('property_id', $property_id);
        if (empty($this->data)) {
            $this->data = $this->Annotation->find('first', array('conditions' => array('Annotation.id' => $id), 'fields' => array('Annotation.*')));
            switch ($this->data['Annotation']['tipo_principal']) {
                case 'Falsa tradición':
                    $this->request->data['Annotation']['tipo_secundario1'] = $this->request->data['Annotation']['tipo_secundario'];
                    break;
                case 'Gravamen':
                    $this->request->data['Annotation']['tipo_secundario2'] = $this->request->data['Annotation']['tipo_secundario'];
                    break;
                case 'Limitación al derecho de dominio':
                    $this->request->data['Annotation']['tipo_secundario3'] = $this->request->data['Annotation']['tipo_secundario'];
                    $this->request->data['Annotation']['limita_ejecucion1'] = $this->request->data['Annotation']['limita_ejecucion'];
                    break;
                case 'Medida cautelar':
                    $this->request->data['Annotation']['tipo_secundario4'] = $this->request->data['Annotation']['tipo_secundario'];
                    break;
                case 'Título de tenencia':
                    $this->request->data['Annotation']['tipo_secundario5'] = $this->request->data['Annotation']['tipo_secundario'];
                    break;
                case 'Otra circunstancia':
                    $this->request->data['Annotation']['tipo_secundario6'] = $this->request->data['Annotation']['tipo_secundario'];
                    break;
                default:
                    $this->request->request->data['Annotation']['tipo_secundario'] = "";
                    break;
            }
        } else {
            $this->request->data['Annotation']['limita_ejecucion'] = "";
            switch ($this->data['Annotation']['tipo_principal']) {
                case 'Falsa tradición':
                    $this->request->data['Annotation']['tipo_secundario'] = $this->data['Annotation']['tipo_secundario1'];
                    break;
                case 'Gravamen':
                    $this->request->data['Annotation']['tipo_secundario'] = $this->data['Annotation']['tipo_secundario2'];
                    break;
                case 'Limitación al derecho de dominio':
                    $this->request->data['Annotation']['tipo_secundario'] = $this->data['Annotation']['tipo_secundario3'];
                    $this->request->data['Annotation']['limita_ejecucion'] = $this->data['Annotation']['limita_ejecucion1'];
                    break;
                case 'Medida cautelar':
                    $this->request->data['Annotation']['tipo_secundario'] = $this->data['Annotation']['tipo_secundario4'];
                    break;
                case 'Título de tenencia':
                    $this->request->data['Annotation']['tipo_secundario'] = $this->data['Annotation']['tipo_secundario5'];
                    break;
                case 'Otra circunstancia':
                    $this->request->data['Annotation']['tipo_secundario'] = $this->data['Annotation']['tipo_secundario6'];
                    break;

                default:
                    $this->request->data['Annotation']['tipo_secundario'] = "";
                    break;
            }

            if ($this->Annotation->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Annotations', 'action' => 'index', $this->data['Annotation']['title_study_id'], $property_id));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function delete($id, $title_study_id, $property_id) {
        $this->layout = "ajax";
        if ($this->Annotation->delete($id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Annotations', 'action' => 'index', $title_study_id, $property_id));
        } else {
            $this->Session->setFlash('Error Eliminando datos');
        }
    }

}