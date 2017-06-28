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
class CityProyectsController extends AppController {

    //put your code here
    var $name = "CityProyects";

    public function index($proyect_id = null) {
        $this->set('proyect_id', $proyect_id);
        $this->CityProyect->recursive = 1;
        $this->set('codigo', $this->CityProyect->Proyect->field('codigo', array('Proyect.id' => $proyect_id)));
        $this->set('cities', $this->CityProyect->find('all', array('conditions' => array('CityProyect.proyect_id' => $proyect_id), 'fields' => array('City.name', 'City.divipol', 'CityProyect.*'))));
    }

    public function add($proyect_id) {
        $this->set('departaments', $this->CityProyect->Proyect->Departament->find('list'));
        $this->set('proyect_id', $proyect_id);
        if (!empty($this->data)) {
            if (!$this->CityProyect->find('first', array('conditions' => array('CityProyect.proyect_id' => $proyect_id, 'CityProyect.city_id' => $this->request->data['CityProyect']['city_id'])))) {
                if ($this->CityProyect->saveAll($this->data)) {
                    $this->Session->setFlash('Municipio adicionado con éxito', 'flash');
                    $this->redirect(array('controller' => 'CityProyects', 'action' => 'index', $proyect_id));
                } else {
                    $this->Session->setFlash('Error guardando los datos', 'flash_error');
                    $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
                }
            } else {
                $this->Session->setFlash('El municipio ya esta asociado al proyecto', 'flash_error');
                $this->redirect(array('controller' => 'CityProyects', 'action' => 'index', $proyect_id));
            }
        }
    }

    public function delete($id, $proyect_id = null) {
        if ($this->CityProyect->delete($id)) {
            $this->Session->setFlash('Municipio eliminado con éxito', 'flash');
            $this->redirect(array('controller' => 'CityProyects', 'action' => 'index', $proyect_id));
        }
    }

    public function select() {
        $this->layout = "ajax";
        $this->set('cities', $this->CityProyect->City->find('list', array(
                    'order' => array('name' => 'ASC'),
                    'conditions' => array('City.departament_id' => $this->data['CityProyect']['departament_id'])
                        )
        ));
    }

}

?>
