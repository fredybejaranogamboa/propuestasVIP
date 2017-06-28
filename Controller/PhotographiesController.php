
<?php

Class PhotographiesController extends AppController {

    public $name = 'Photographies';

    public function add($visit_id) {
        $this->layout = "ajax";

        $this->set('visit_id', $visit_id);

        if (!empty($this->data)) {

            if ($this->Photography->saveAll($this->data)) {

                $last_id = $this->Photography->getLastInsertId();
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Seguimiento";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                if (!empty($this->data['Photography']['archivo']['tmp_name'])) {
                    $ext = explode(".", $this->data['Photography']['archivo']['name']);
                    $conteo = count($ext);
                    if ($ext[$conteo - 1] == 'jpg') {
                        $nombrearchivo = "Fotografia-" . $last_id . ".jpg";
                        if (!move_uploaded_file($this->data['Photography']['archivo']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                            $this->Session->setFlash('Error adjuntando fotografía.', 'flash_error');
                        }
                    } else {
                        $this->Session->setFlash('El archivo del extracto no se encuentra en un formato válido. Debe ser jpg.', 'flash_error');
                        $this->redirect(array('controller' => 'Photographies', 'action' => 'index', $visit_id));
                    }
                }

                $this->Session->setFlash('Fotografía guardada correctamente', 'flash');
                $this->redirect(array('controller' => 'Photographies', 'action' => 'index', $visit_id));
            } else {
                $this->Session->setFlash('Error guardando los datos', 'flash');
                $this->redirect(array('controller' => 'pages', 'action' => 'display'));
            }
        }
    }

    public function edit($id) {
        $this->layout = "ajax";
        if (!empty($this->data)) {
            if ($this->Photography->saveAll($this->data)) {
                $last_id = $this->data['Photography']['id'];
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Seguimiento";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                if (!empty($this->data['Photography']['archivo']['tmp_name'])) {
                    $ext = explode(".", $this->data['Photography']['archivo']['name']);
                    $conteo = count($ext);
                    if ($ext[$conteo - 1] == 'jpg') {
                        $nombrearchivo = "Fotografia-" . $last_id . ".jpg";
                        if (!move_uploaded_file($this->data['Photography']['archivo']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                            $this->Session->setFlash('Error adjuntando fotografía.', 'flash_error');
                        }
                    } else {
                        $this->Session->setFlash('El archivo del extracto no se encuentra en un formato válido. Debe ser jpg.', 'flash_error');
                        $this->redirect(array('controller' => 'Photographies', 'action' => 'index', $this->data['Photography']['visit_id']));
                    }
                }

                $this->Session->setFlash('Fotografía guardada correctamente', 'flash');
                $this->redirect(array('controller' => 'Photographies', 'action' => 'index', $this->data['Photography']['visit_id']));
            } else {
                $this->Session->setFlash('Error guardando los datos', 'flash');
                $this->redirect(array('controller' => 'pages', 'action' => 'display'));
            }
        } else {
            $this->data = $this->Photography->find('first', array('conditions' => array('Photography.id' => $id)));
        }
    }

    public function index($visit_id) {
        if ($this->RequestHandler->isAjax()) {
            $this->layout = "ajax";
        } else {
            $this->layout = "default";
        }
        $this->set('visit_id', $visit_id);
        $this->set('aleatorio', rand(1111, 9999999));
        $this->set('Photographies', $this->Photography->find('all', array('conditions' => array('Photography.visit_id' => $visit_id), 'recursive' => -1, 'fields' => array('Photography.*'))));
    }

    public function delete($id, $visit_id) {
        $path = ".." . DS . "webroot" . DS . "files" . DS . "Seguimiento" . DS . "Fotografia-" . $id . ".jpg";
        if (file_exists($path)) {
            unlink($path);
        }
        if ($this->Photography->delete($id)) {
            $this->Session->setFlash('Fotografía eliminada correctamente', 'flash');
            $this->redirect(array('controller' => 'Photographies', 'action' => 'index', $visit_id));
        } else {
            $this->Session->setFlash('Error borrando datos', 'flash_error');
            $this->redirect(array('controller' => 'pages', 'action' => 'display'));
        }
    }

}

?>