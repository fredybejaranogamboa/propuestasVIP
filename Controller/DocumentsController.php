<?php

Class DocumentsController extends AppController {

    public $name = 'Documents';

    public function add($foreign_id, $entity_id) {
        $this->layout = "ajax";

        if (!empty($this->data)) {
            if ($this->Document->saveAll($this->data)) {

                $nombre_entidad = $this->Document->Entity->field('name', array('id' => $entity_id));
                $extension = $this->Document->DocumentType->field('extension', array('id' => $this->data['Document']['document_type_id']));
                $last_id = $this->Document->getLastInsertId();
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . $nombre_entidad;

                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                if (!empty($this->data['Document']['documento']['tmp_name'])) {
                    $nombrearchivo = $this->data['Document']['document_type_id'] . "_" . $foreign_id . "_" . $last_id . "." . $extension;

                    if (!move_uploaded_file($this->data['Document']['documento']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando documento', 'flash_error');
                    }
                }

                $this->Session->setFlash('Documento guardado correctamente', 'flash');
                $this->redirect(array('controller' => 'Documents', 'action' => 'index', $foreign_id, $entity_id));
            } else {
                $this->redirect(array('controller' => 'pages', 'action' => 'error', "Error guardando los datos"));
            }
        } else {
            $this->set('documentTypes', $this->Document->DocumentType->find('list', array('fields' => array('DocumentType.id', 'DocumentType.nombre'), 'conditions' => array('DocumentType.entity_id' => $entity_id, 'DocumentType.enable' => 1), 'order' => array('DocumentType.nombre ASC'))));
            $this->set('foreign_id', $foreign_id);
            $this->set('entity_id', $entity_id);
        }
    }

    public function edit($id) {
        $this->layout = "ajax";
        $this->Document->recursive = -1;
        $entity_id = $this->Document->field('entity_id', array('id' => $id));
        $foreign_id = $this->Document->field('foreign_id', array('id' => $id));
        $document_type_id = $this->Document->field('document_type_id', array('id' => $id));
        $extension = $this->Document->DocumentType->field('extension', array('id' => $document_type_id));

        if (empty($this->data)) {
            $this->set('documentTypes', $this->Document->DocumentType->find('list', array('fields' => array('DocumentType.id', 'DocumentType.nombre'), 'conditions' => array('DocumentType.entity_id' => $entity_id, 'DocumentType.enable' => 1), 'order' => array('DocumentType.nombre ASC'))));
            $this->data = $this->Document->find('first', array('recursive' => 0, 'conditions' => array('Document.id' => $id), 'fields' => array('Document.*', 'DocumentType.*')));
        } else {
            if ($this->Document->save($this->data)) {

                $nombre_entidad = $this->Document->Entity->field('name', array('id' => $entity_id));
                $last_id = $this->data['Document']['id'];
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . $nombre_entidad;

                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                if (!empty($this->data['Document']['documento']['tmp_name'])) {
                    $nombrearchivo = $this->data['Document']['document_type_id'] . "_" . $foreign_id . "_" . $last_id . "." . $extension;

                    if (!move_uploaded_file($this->data['Document']['documento']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando documento', 'flash_error');
                    }
                }

                $this->Session->setFlash('Documento guardado correctamente', 'flash');
                $this->redirect(array('controller' => 'Documents', 'action' => 'index', $foreign_id, $entity_id));
            } else {
                $this->redirect(array('controller' => 'pages', 'action' => 'error', "Error guardando los datos"));
            }
        }
    }

    public function delete($id, $entity_id, $foreign_id, $document_type_id) {
        if ($this->Document->delete($id)) {
            $extension = $this->Document->DocumentType->field('extension', array('id' => $document_type_id));
            $nombre_entidad = $this->Document->Entity->field('name', array('id' => $entity_id));
            $path = ".." . DS . "webroot" . DS . "files" . DS . $nombre_entidad . DS;
            $nombrearchivo = $document_type_id . "_" . $foreign_id . "_" . $id . "." . $extension;

            $path .= $nombrearchivo;
            if (file_exists($path)) {
                unlink($path);
                $this->Session->setFlash('Documento eliminado correctamente', 'flash');
                $this->redirect(array('controller' => 'Documents', 'action' => 'index', $foreign_id, $entity_id));
            } else {
                $this->Session->setFlash('Error eliminando archivo', 'flash');
                $this->redirect(array('controller' => 'Documents', 'action' => 'index', $foreign_id, $entity_id));
            }
        } else {

            $this->Session->setFlash('Error eliminando archivo', 'flash');
            $this->redirect(array('controller' => 'Documents', 'action' => 'index', $foreign_id, $entity_id));
        }
    }

    public function index($foreign_id, $entity_id) {

        if (!$this->RequestHandler->isAjax()) {
            $this->layout = "default";
        } else {
            $this->layout = "ajax";
        }
        $this->set('aleatorio', rand(1111, 9999999));
        $this->set('foreign_id', $foreign_id);
        $this->set('entity_id', $entity_id);
        $this->set('Documents', $this->Document->find('all', array('order' => array('Document.id' => 'DESC'),
                    'fields' => array('Document.*', 'DocumentType.*'),
                    'recursive' => 0,
                    'conditions' => array('Document.foreign_id' => $foreign_id, 'DocumentType.entity_id' => $entity_id, 'DocumentType.enable' => 1))));
        $nombre_entidad = $this->Document->Entity->field('name', array('id' => $entity_id));
        $this->set('nombre_entidad', $nombre_entidad);
    }

    public function select() {
        $this->layout = "ajax";
        $this->set('extension', $this->Document->DocumentType->field('extension', array('DocumentType.id' => $this->data['Document']['document_type_id'])));
        $this->set('accept', $this->Document->DocumentType->field('accept', array('DocumentType.id' => $this->data['Document']['document_type_id'])));
    }

}

?>