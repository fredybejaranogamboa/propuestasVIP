<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pline_proyects_controller
 *
 * @author Fredy Bejarano
 */
class PlineProyectsController extends AppController {

    var $name = "PlineProyects";

    public function index($proyect_id = null) {
        $this->set('proyect_id', $proyect_id);
        $this->PlineProyect->recursive = 1;
        $this->set('codigo', $this->PlineProyect->Proyect->field('codigo', array('Proyect.id' => $proyect_id)));
        $this->set('plines', $this->PlineProyect->find('all', array('conditions' => array('PlineProyect.proyect_id' => $proyect_id), 'fields' => array('Pline.*', 'PlineProyect.*'))));
    }

    public function add($proyect_id) {
        $this->set('proyect_id', $proyect_id);
        $this->set('plines', $this->PlineProyect->Pline->find('list', array('fields' => array('Pline.id', 'Pline.nombre'), 'order' => array('Pline.nombre ASC'))));
        if (!empty($this->data)) {
            if (!$this->PlineProyect->find('first', array('conditions' => array('PlineProyect.proyect_id' => $proyect_id, 'PlineProyect.pline_id' => $this->request->data['PlineProyect']['pline_id'])))) {
                if ($this->PlineProyect->saveAll($this->data)) {
                    $this->Session->setFlash('Línea productiva adicionada con éxito', 'flash');
                    $this->redirect(array('controller' => 'PlineProyects', 'action' => 'index', $proyect_id));
                } else {
                    $this->Session->setFlash('Error guardando los datos', 'flash_error');
                    $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
                }
            } else {
                $this->Session->setFlash('La línea productiva ya esta asociada al proyecto', 'flash_error');
                $this->redirect(array('controller' => 'PlineProyects', 'action' => 'index', $proyect_id));
            }
        }
    }

    public function delete($id, $proyect_id = null) {
        if ($this->PlineProyect->delete($id)) {
            $this->Session->setFlash('Línea productiva eliminada con éxito', 'flash');
            $this->redirect(array('controller' => 'PlineProyects', 'action' => 'index', $proyect_id));
        }
    }

}

?>
