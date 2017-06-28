<?php

Class RelativesController extends AppController {

    public $name = 'Relatives';

    function add($candidate_id) {
        $this->layout = "ajax";
        $this->set('candidate_id', $candidate_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->Relative->save($this->data)) {
                $this->Session->setFlash('Registro adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Relatives', 'action' => 'index', $candidate_id));
            } else {
                $this->Session->setFlash('Error guardando datos');
            }
        }
    }

    function edit($id) {
        $this->layout = "ajax";
        $this->layout = "ajax";
        $this->Relative->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Relative->find('first', array('conditions' => array('Relative.id' => $id), 'fields' => array('Relative.primer_nombre', 'Relative.segundo_nombre', 'Relative.primer_apelllido', 'Relative.segundo_apellido', 'Relative.genero', 'Relative.estado_civil', 'Relative.escolaridad', 'Relative.seguridad_social', 'Relative.ocupacion', 'Relative.nivel_sisben', 'Relative.prestadora_salud', 'Relative.discapacidad', 'Relative.fecha_nacimiento', 'Relative.edad', 'Relative.candidate_id', 'Relative.parentesco', 'Relative.id')));
        } else {

            if ($this->Relative->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Relatives', 'action' => 'index', $this->data['Relative']['candidate_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($candidate_id=null) {
        $this->layout = "ajax";
        $this->Relative->Candidate->recursive=-1;
        $this->set('aspirante', $this->Relative->Candidate->find('first',array('conditions'=>array('Candidate.id'=>$candidate_id),'fields'=>array('Candidate.primer_nombre','Candidate.primer_apellido') )) ) ;
        if (isset($candidate_id)) {
            $this->Relative->recursive = -1;
            $this->set('candidate_id', $candidate_id);
            $this->paginate = array('Relative' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Relative.primer_nombre', 'Relative.segundo_nombre', 'Relative.primer_apelllido', 'Relative.segundo_apellido', 'Relative.parentesco', 'Relative.id', 'Relative.candidate_id')));
            $this->set('Relatives', $this->paginate(array('Relative.candidate_id' => $candidate_id)));
        } else {
            $this->Session->setFlash('No ha seleccionado una Familia', 'flash_custom');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        }
    }

    function delete($relative_id, $candidate_id) {
        $this->layout = "ajax";
        if ($this->Relative->delete($relative_id)) {
            $this->Session->setFlash('Registro borrado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Relatives', 'action' => 'index', $candidate_id));
        } else {
            $this->Session->setFlash('Error editando datos');
        }
    }

}

?>