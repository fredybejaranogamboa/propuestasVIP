
<?php

Class ExtractsController extends AppController {

    public $name = 'Extracts';

    public function add($proyect_id) {
        $this->layout = "ajax";

        $this->set('proyect_id', $proyect_id);

        if (!empty($this->data)) {

            if ($this->Extract->saveAll($this->data)) {

                $last_id = $this->Extract->getLastInsertId();
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Seguimiento";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                if (!empty($this->data['Extract']['archivo']['tmp_name'])) {
                    $ext = explode(".", $this->data['Extract']['archivo']['name']);
                    $conteo = count($ext);
                    if (in_array($ext[$conteo - 1], array('pdf'))) {
                        $nombrearchivo = "Extracto-" . $last_id . ".pdf";
                        if (!move_uploaded_file($this->data['Extract']['archivo']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                            $this->Session->setFlash('Error adjuntando extracto.', 'flash_error');
                        }
                    } else {
                        $this->Session->setFlash('El archivo del extracto no se encuentra en un formato válido. Debe ser PDF.', 'flash_error');
                        $this->redirect(array('controller' => 'Extracts', 'action' => 'index'));
                    }
                }

                $this->Session->setFlash('Extracto guardado correctamente', 'flash');
                $this->redirect(array('controller' => 'Extracts', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error guardando los datos', 'flash');
                $this->redirect(array('controller' => 'pages', 'action' => 'display'));
            }
        }
    }

    public function edit($id) {
        $this->layout = "ajax";
        if (!empty($this->data)) {
            if ($this->Extract->saveAll($this->data)) {
                $last_id = $this->data['Extract']['id'];
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Seguimiento";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                if (!empty($this->data['Extract']['archivo']['tmp_name'])) {
                    $ext = explode(".", $this->data['Extract']['archivo']['name']);
                    $conteo = count($ext);
                    if (in_array($ext[$conteo - 1], array('pdf'))) {
                        $nombrearchivo = "Extracto-" . $last_id . ".pdf";
                        if (!move_uploaded_file($this->data['Extract']['archivo']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                            $this->Session->setFlash('Error adjuntando extracto.', 'flash_error');
                        }
                    } else {
                        $this->Session->setFlash('El archivo del extracto no se encuentra en un formato válido. Debe ser PDF.', 'flash_error');
                        $this->redirect(array('controller' => 'Extracts', 'action' => 'index'));
                    }
                }

                $this->Session->setFlash('Extracto guardado correctamente', 'flash');
                $this->redirect(array('controller' => 'Extracts', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error guardando los datos', 'flash');
                $this->redirect(array('controller' => 'pages', 'action' => 'display'));
            }
        } else {
            $this->data = $this->Extract->find('first', array('conditions' => array('Extract.id' => $id)));
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
            $planes = $this->Extract->Proyect->Follow->find('count', array('conditions' => array('Follow.proyect_id' => $proyect_id)));
            if ($planes < 1) {
                $this->Session->setFlash('Antes de cargar un extracto debe cargar un plan de inversión.', 'flash_error');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            } else {
                $this->set('aleatorio', rand(1111, 9999999));
                $this->set("codigo", $this->Session->read('codigo'));
                $this->set('Extractos', $this->Extract->find('all', array('conditions' => array('Extract.proyect_id' => $proyect_id), 'recursive' => -1, 'fields' => array('Extract.*'), 'order' => array('Extract.id DESC'))));
            }
        }
    }

    public function delete($id) {
        $path = ".." . DS . "webroot" . DS . "files" . DS . "Seguimiento" . DS . "Extracto-" . $id . ".pdf";
        if (file_exists($path)) {
            unlink($path);
        }
        if ($this->Extract->delete($id)) {
            $this->Session->setFlash('Extracto eliminado correctamente', 'flash');
            $this->redirect(array('controller' => 'Extracts', 'action' => 'index'));
        } else {
            $this->Session->setFlash('Error borrando datos', 'flash_error');
            $this->redirect(array('controller' => 'pages', 'action' => 'display'));
        }
    }

}

?>