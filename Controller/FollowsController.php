<?php

Class FollowsController extends AppController {

    public $name = 'Follows';

    public function add($proyect_id) {
        $this->layout = "ajax";

        $this->set('proyect_id', $proyect_id);

        if (!empty($this->data)) {

            if ($this->Follow->saveAll($this->data)) {

                $last_id = $this->Follow->getLastInsertId();
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Seguimiento";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                if (!empty($this->data['Follow']['archivo']['tmp_name'])) {
                    $ext = explode(".", $this->data['Follow']['archivo']['name']);
                    $conteo = count($ext);
                    if (in_array($ext[$conteo - 1], array('pdf'))) {
                        $nombrearchivo = "PlanInversion-" . $last_id . ".pdf";
                        if (!move_uploaded_file($this->data['Follow']['archivo']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                            $this->Session->setFlash('Error adjuntando plan de inversión.', 'flash_error');
                        }
                    } else {
                        $this->Session->setFlash('El archivo del plan de inversión no se encuentra en un formato válido. Debe ser PDF.', 'flash_error');
                        $this->redirect(array('controller' => 'Follows', 'action' => 'index'));
                    }
                }

                $this->Session->setFlash('Plan de inversión guardado correctamente', 'flash');
                $this->redirect(array('controller' => 'Follows', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error guardando los datos', 'flash');
                $this->redirect(array('controller' => 'pages', 'action' => 'display'));
            }
        }
    }

    public function edit($id) {
        $this->layout = "ajax";
        if (!empty($this->data)) {
            if ($this->Follow->saveAll($this->data)) {
                $last_id = $this->data['Follow']['id'];
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Seguimiento";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                if (!empty($this->data['Follow']['archivo']['tmp_name'])) {
                    $ext = explode(".", $this->data['Follow']['archivo']['name']);
                    $conteo = count($ext);
                    if (in_array($ext[$conteo - 1], array('pdf'))) {
                        $nombrearchivo = "PlanInversion-" . $last_id . ".pdf";
                        if (!move_uploaded_file($this->data['Follow']['archivo']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                            $this->Session->setFlash('Error adjuntando plan de inversión.', 'flash_error');
                        }
                    } else {
                        $this->Session->setFlash('El archivo del plan de inversión no se encuentra en un formato válido. Debe ser PDF.', 'flash_error');
                        $this->redirect(array('controller' => 'Follows', 'action' => 'index'));
                    }
                }

                $this->Session->setFlash('Plan de inversión guardado correctamente', 'flash');
                $this->redirect(array('controller' => 'Follows', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error guardando los datos', 'flash');
                $this->redirect(array('controller' => 'pages', 'action' => 'display'));
            }
        } else {
            $this->data = $this->Follow->find('first', array('conditions' => array('Follow.id' => $id)));
        }
    }

    public function index() {
        if ($this->RequestHandler->isAjax()) {
            $this->layout = "ajax";
        } else {
            $this->layout = "default";
        }
        $this->set('aleatorio', rand(1111, 9999999));
        $this->set("codigo", $this->Session->read('codigo'));
        $proyect_id = $this->Session->read('proyect_id');
        $this->set('proyect_id', $proyect_id);

        if ($proyect_id == "") {
            $this->Session->setFlash('No ha seleccionado Proyecto', 'flash_error');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        } else {
            $this->set('Planes', $this->Follow->find('all', array('conditions' => array('Follow.proyect_id' => $proyect_id), 'recursive' => -1, 'fields' => array('Follow.*'), 'order' => array('Follow.id DESC'))));
        }
    }

    public function delete($id) {
        $path = ".." . DS . "webroot" . DS . "files" . DS . "Seguimiento" . DS . "PlanInversion-" . $id . ".pdf";
        if (file_exists($path)) {
            unlink($path);
        }
        if ($this->Follow->delete($id)) {
            $this->Session->setFlash('Plan de inversión eliminado correctamente', 'flash');
            $this->redirect(array('controller' => 'Follows', 'action' => 'index'));
        } else {
            $this->Session->setFlash('Error borrando datos', 'flash_error');
            $this->redirect(array('controller' => 'pages', 'action' => 'display'));
        }
    }

}

?>