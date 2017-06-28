<?php

Class PointsController extends AppController {

    public $name = 'Points';

    public function add($property_id) {
        $this->layout = "ajax";
        $this->set('property_id', $property_id);
        if (!empty($this->data)) {
            if ($this->Point->saveAll($this->data)) {

                $last_id = $this->Point->getLastInsertId();
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Fotografias";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                    }
                }

                if (!empty($this->data['Point']['fotografia']['tmp_name'])) {
                    $nombrearchivo = "Fotografia-" . $last_id . ".jpg";
                    move_uploaded_file($this->data['Point']['fotografia']['tmp_name'], $rutaArchivo . DS . $nombrearchivo);
                }

                //$this->Session->write($property_id, $property_id);

                $this->Session->setFlash('Registro Adicionado correctamente', 'flash');
                //$this->redirect(array('controller' => 'properties', 'action' => 'index'));
                $this->redirect(array('controller' => 'Points', 'action' => 'index', $property_id));
            } else {
                $this->Session->setFlash('Error Guardando datos', 'flash_error');
                $this->redirect(array('controller' => 'Points', 'action' => 'index', $property_id));
            }
        }
    }

    public function edit($id) {
        $this->layout = "ajax";
        $this->Point->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->Point->find('first', array('conditions' => array('Point.id' => $id)));
        } else {
            if ($this->Point->save($this->data)) {

                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Fotografias";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                    }
                }

                if (!empty($this->data['Point']['fotografia']['tmp_name'])) {
                    $nombrearchivo = "Fotografia-" . $this->request->data['Point']['id'] . ".jpg";
                    move_uploaded_file($this->data['Point']['fotografia']['tmp_name'], $rutaArchivo . DS . $nombrearchivo);
                }

                $this->Session->setFlash('Registro editado correctamente', 'flash');
                $this->redirect(array('controller' => 'Points', 'action' => 'index', $this->data['Point']['property_id']));
            } else {
                $this->Session->setFlash('Error editando datos', 'flash_error');
                $this->redirect(array('controller' => 'Points', 'action' => 'index', $this->data['Point']['property_id']));
            }
        }
    }

    public function index($property_id = null) {
        if (!$this->RequestHandler->isAjax()) {
            $this->layout = "default";
        } else {
            $this->layout = "ajax";
        }
        $this->set('aleatorio', rand(1111, 9999999));
        $this->set('property_id', $property_id);
        $this->set('Points', $this->Point->find('all', array('recursive' => -1, 'conditions' => array('Point.property_id' => $property_id), 'fields' => array('Point.*'))));
    }

    public function delete($id, $property_id) {
        if ($this->Point->delete($id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash');
            $this->redirect(array('controller' => 'Points', 'action' => 'index', $property_id));
        } else {
            $this->Session->setFlash('Error eliminando registro, por favor intentelo nuevamente.', 'flash_error');
        }
    }

}

?>