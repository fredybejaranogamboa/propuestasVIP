<?php

Class ServicesController extends AppController {

    public $name = 'Services';

    public function add($property_id) {
        $this->layout = "ajax";
        $this->set('property_id', $property_id);
        if (!empty($this->data)) {
            if ($this->Service->saveAll($this->data)) {

                $last_id = $this->Service->getLastInsertId();
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Fotografias";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                    }
                }

                if (!empty($this->data['Service']['fotografia']['tmp_name'])) {
                    $nombrearchivo = "Fotografia-" . $last_id . ".jpg";
                    move_uploaded_file($this->data['Service']['fotografia']['tmp_name'], $rutaArchivo . DS . $nombrearchivo);
                }

                //$this->Session->write($property_id, $property_id);

                $this->Session->setFlash('Registro Adicionado correctamente', 'flash');
                //$this->redirect(array('controller' => 'properties', 'action' => 'index'));
                $this->redirect(array('controller' => 'Services', 'action' => 'index', $property_id));
            } else {
                $this->Session->setFlash('Error Guardando datos', 'flash_error');
                $this->redirect(array('controller' => 'Services', 'action' => 'index', $property_id));
            }
        }
    }

    public function edit($id) {
        $this->layout = "ajax";
        $this->Service->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->Service->find('first', array('conditions' => array('Service.id' => $id)));
        } else {
            if ($this->Service->save($this->data)) {

                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Fotografias";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                    }
                }

                if (!empty($this->data['Service']['fotografia']['tmp_name'])) {
                    $nombrearchivo = "Fotografia-" . $this->request->data['Service']['id'] . ".jpg";
                    move_uploaded_file($this->data['Service']['fotografia']['tmp_name'], $rutaArchivo . DS . $nombrearchivo);
                }

                $this->Session->setFlash('Registro editado correctamente', 'flash');
                $this->redirect(array('controller' => 'Services', 'action' => 'index', $this->data['Service']['property_id']));
            } else {
                $this->Session->setFlash('Error editando datos', 'flash_error');
                $this->redirect(array('controller' => 'Services', 'action' => 'index', $this->data['Service']['property_id']));
            }
        }
    }

    public function index($property_id = null) {
        if (!$this->RequestHandler->isAjax()) {
            $this->layout = "default";
        } else {
            $this->layout = "ajax";
        }
        $this->set('property_id', $property_id);
        $this->set('Services', $this->Service->find('all', array('recursive' => -1, 'conditions' => array('Service.property_id' => $property_id), 'fields' => array('Service.*'))));
    }

    public function delete($id, $property_id) {
        if ($this->Service->delete($id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash');
            $this->redirect(array('controller' => 'Services', 'action' => 'index', $property_id));
        } else {
            $this->Session->setFlash('Error eliminando registro, por favor intentelo nuevamente.', 'flash_error');
        }
    }

}

?>