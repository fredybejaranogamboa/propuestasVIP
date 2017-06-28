
<?php

Class VisitsController extends AppController {

    public $name = 'Visits';

    public function add($proyect_id) {
        $this->layout = "ajax";

        $this->set('proyect_id', $proyect_id);

        if (!empty($this->data)) {

            if ($this->Visit->saveAll($this->data)) {

                $last_id = $this->Visit->getLastInsertId();
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Seguimiento";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                if (!empty($this->data['Visit']['archivo']['tmp_name'])) {
                    $nombrearchivo = "Visita-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Visit']['archivo']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando extracto.', 'flash_error');
                    }
                }

                $this->Session->setFlash('Visita de seguimiento guardado correctamente', 'flash');
                $this->redirect(array('controller' => 'Visits', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error guardando los datos', 'flash');
                $this->redirect(array('controller' => 'pages', 'action' => 'display'));
            }
        }
    }

    public function edit($id) {
        $this->layout = "ajax";
        if (!empty($this->data)) {
            if ($this->Visit->saveAll($this->data)) {
                $last_id = $this->data['Visit']['id'];
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Seguimiento";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                if (!empty($this->data['Visit']['archivo']['tmp_name'])) {
                    $nombrearchivo = "Visita-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Visit']['archivo']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando extracto.', 'flash_error');
                    }
                }

                $this->Session->setFlash('Visita de seguimiento guardado correctamente', 'flash');
                $this->redirect(array('controller' => 'Visits', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error guardando los datos', 'flash');
                $this->redirect(array('controller' => 'pages', 'action' => 'display'));
            }
        } else {
            $this->data = $this->Visit->find('first', array('conditions' => array('Visit.id' => $id)));
        }
    }

    public function index() {
        if ($this->RequestHandler->isAjax()) {
            $this->layout = "ajax";
        } else {
            $this->layout = "default";
        }

        $proyect_id = $this->Session->read('proyect_id');
        $this->set('proyect_id', $proyect_id);

        if ($proyect_id == "") {
            $this->Session->setFlash('No ha seleccionado Proyecto', 'flash_error');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        } else {
            $planes = $this->Visit->Proyect->Follow->find('count', array('conditions' => array('Follow.proyect_id' => $proyect_id)));
            if ($planes < 1) {
                $this->Session->setFlash('Antes de cargar un extracto debe cargar un plan de inversión.', 'flash_error');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            } else {
                $this->set('aleatorio', rand(1111, 9999999));
                $this->set("codigo", $this->Session->read('codigo'));
                $this->set('Visitas', $this->Visit->find('all', array('conditions' => array('Visit.proyect_id' => $proyect_id), 'recursive' => -1, 'fields' => array('Visit.*'), 'order'=>array('Visit.id DESC'))));
            }
        }
    }

    public function delete($id) {
        $path = ".." . DS . "webroot" . DS . "files" . DS . "Seguimiento" . DS . "Visita-" . $id . ".pdf";
        if (file_exists($path)) {
            unlink($path);
        }
        if ($this->Visit->delete($id)) {
            $this->Session->setFlash('Visita de seguimiento eliminada correctamente', 'flash');
            $this->redirect(array('controller' => 'Visits', 'action' => 'index'));
        } else {
            $this->Session->setFlash('Error borrando datos', 'flash_error');
            $this->redirect(array('controller' => 'pages', 'action' => 'display'));
        }
    }

}

?>