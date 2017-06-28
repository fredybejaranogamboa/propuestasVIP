<?php

Class ObservationsController extends AppController {

    public $name = 'Observations';

    public function add($evaluation_id) {
        $this->layout = "ajax";
        $this->set('user_id', $this->Auth->user('id'));
        $this->set('evaluation_id', $evaluation_id);
        date_default_timezone_set("America/Bogota");
        $this->set('fecha', date("Y-m-d"));
        if (!empty($this->data)) {

            if ($this->Observation->saveAll($this->data)) {

                $this->Session->setFlash('Evaluación guardada correctamente', 'flash');
                $this->redirect(array('controller' => 'Observations', 'action' => 'index', $this->data['Observation']['evaluation_id']));
            } else {
                $this->Session->setFlash('Error guardando los datos', 'flash');
                $this->redirect(array('controller' => 'pages', 'action' => 'display'));
            }
        }
    }

    public function edit($id) {
        $this->layout = "ajax";
        $this->Observation->recursive = -1;
        if (empty($this->data)) {
            $this->set('user_id', $this->Auth->user('id'));
            date_default_timezone_set("America/Bogota");
            $this->set('fecha', date("Y-m-d"));
            date_default_timezone_set("America/Bogota");
            $this->set('fecha', date("Y-m-d"));
            $this->data = $this->Observation->find('first', array('conditions' => array('Observation.id' => $id), 'fields' => array('Observation.*')));
        } else {
            if ($this->Observation->save($this->data)) {

                $this->Session->setFlash('Registro editado correctamente', 'flash');
                $this->redirect(array('controller' => 'Observations', 'action' => 'index', $this->data['Observation']['evaluation_id']));
            } else {
                $this->Session->setFlash('Error editando datos', 'flash_error');
            }
        }
    }

    public function index($evaluation_id) {
        if (!$this->RequestHandler->isAjax()) {
            $this->layout = "default";
        } else {
            $this->layout = "ajax";
        }
        $this->set('evaluation_id', $evaluation_id);

        $this->paginate = array('Observation' => array('maxLimit' => 500, 'limit' => 50, 'recursive' => 2, 'fields' => array('Observation.*', 'User.*')));
        $this->set('Observations', $this->paginate(array('Observation.evaluation_id' => $evaluation_id)));
    }

    public function delete($id, $evaluation_id) {
        if ($this->Observation->delete($id)) {
            $this->Session->setFlash('Observación eliminada correctamente', 'flash');
            $this->redirect(array('controller' => 'Observations', 'action' => 'index', $evaluation_id));
        } else {
            $this->Session->setFlash('Error borrando datos', 'flash_error');
            $this->redirect(array('controller' => 'pages', 'action' => 'display'));
        }
    }

}

?>