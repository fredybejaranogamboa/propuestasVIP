<?php

Class DocumentsController extends AppController {

    public $name = 'Documents';

    public function add($property_id) {
        $this->layout = "ajax";

        if (!empty($this->data)) {
            if ($this->Document->saveAll($this->data)) {

                $last_id = $this->Document->getLastInsertId();
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "DocumentosPredios";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                if (!empty($this->data['Document']['documento']['tmp_name'])) {
                    $nombrearchivo = "otroDocumento-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Document']['documento']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando documento', 'flash_error');
                    }
                }

                $this->Session->setFlash('Documento guardado correctamente', 'flash');
                $this->redirect(array('controller' => 'Documents', 'action' => 'index', $property_id));
            } else {
                $this->redirect(array('controller' => 'pages', 'action' => 'error', "Error guardando los datos"));
            }
        } else {
            $this->set('documentTypes', $this->Document->DocumentType->find('list', array('fields' => array('DocumentType.id', 'DocumentType.nombre'), 'order' => array('DocumentType.nombre ASC'))));
            $this->set('property_id', $property_id);
        }
    }

    public function edit($id) {
        $this->layout = "ajax";
        $this->Document->recursive = -1;
        if (empty($this->data)) {
            $this->set('documentTypes', $this->Document->DocumentType->find('list', array('fields' => array('DocumentType.id', 'DocumentType.nombre'), 'order' => array('DocumentType.nombre ASC'))));

            $this->data = $this->Document->find('first', array('recursive' => 0, 'conditions' => array('Document.id' => $id), 'fields' => array('Document.*', 'DocumentType.*')));
        } else {


            if ($this->Document->save($this->data)) {

                $last_id = $this->data['Document']['id'];
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "DocumentosPredios";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                if (!empty($this->data['Document']['documento']['tmp_name'])) {
                    $nombrearchivo = "otroDocumento-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Document']['documento']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando documento', 'flash_error');
                    }
                }

                $this->Session->setFlash('Registro editado correctamente', 'flash');
                $this->redirect(array('controller' => 'Documents', 'action' => 'index', $this->data['Document']['property_id']));
            } else {
                $this->redirect(array('controller' => 'pages', 'action' => 'error', "Error guardando los datos"));
            }
        }
    }

    public function delete($id, $property_id) {
        if ($this->Document->delete($id)) {
            $this->Session->setFlash('Documento eliminado correctamente', 'flash');
            $this->redirect(array('controller' => 'Documents', 'action' => 'index', $property_id));
        } else {

            $this->redirect(array('controller' => 'pages', 'action' => 'error', "Error borrando los datos"));
        }
    }

    public function index($property_id) {

        if (!$this->RequestHandler->isAjax()) {
            $this->layout = "default";
        } else {
            $this->layout = "ajax";
        }
        $this->set('aleatorio', rand(1111, 9999999));
        $this->set('property_id', $property_id);
        $this->set('Documents', $this->Document->find('all', array('order' => array('Document.id' => 'DESC'), 'fields' => array('Document.*', 'DocumentType.*'), 'recursive' => 0, 'conditions' => array('Document.property_id' => $property_id))));
    }

}

?>