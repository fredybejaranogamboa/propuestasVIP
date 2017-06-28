<?php

Class AgreementsController extends AppController {

    public $name = 'Agreements';

    public function add() {
        $this->layout = "ajax";
        if (!empty($this->data)) {
            if ($this->Agreement->save($this->data)) {
                $last_id = $this->Agreement->getLastInsertId();
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Convenios";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                if (!empty($this->data['Agreement']['archivo']['tmp_name'])) {
                    $nombrearchivo = "Convenio-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Agreement']['archivo']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando archivo', 'flash_error');
                    }
                }

                $this->Session->setFlash('Se creó el convenio', 'flash');
                $this->redirect(array('controller' => 'Agreements', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    public function edit($id = null) {

        if (empty($this->data)) {
            $this->data = $this->Agreement->find('first', array('recursive' => -1, 'conditions' => array('Agreement.id' => $id), 'fields' => array("Agreement.*")));
        } else {

            if ($this->Agreement->save($this->data)) {
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Convenios";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                if (!empty($this->data['Agreement']['archivo']['tmp_name'])) {
                    $nombrearchivo = "Convenio-" . $id . ".pdf";
                    if (!move_uploaded_file($this->data['Agreement']['archivo']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando archivo', 'flash_error');
                    }
                }

                $this->Session->setFlash('Registro editado correctamente', 'flash');
                $this->redirect(array('controller' => 'Agreements', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error editando datos', 'flash_error');
            }
        }
    }

    public function index() {
        if (!$this->RequestHandler->isAjax()) {
            $this->layout = "default";
        } else {
            $this->layout = "ajax";
        }
        $this->set('aleatorio', rand(1111, 9999999));
        $this->set('Agreements', $this->Agreement->find('all', array('recursive' => -1, 'order' => array('Agreement.suscriptor' => 'DESC'), 'fields' => array('Agreement.*'))));
    }

    public function delete($id) {
        if ($this->Agreement->delete($id)) {
            $this->Session->setFlash('Convenio eliminado correctamente', 'flash');
            $this->redirect(array('controller' => 'Agreements', 'action' => 'index'));
        } else {
            $this->Session->setFlash('Error borrando datos', 'flash');
            $this->redirect(array('controller' => 'pages', 'action' => 'display'));
        }
    }

}

?>