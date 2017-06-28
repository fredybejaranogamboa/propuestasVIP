
<?php

Class CommitteesController extends AppController {

    public $name = 'Committees';

    public function add($proyect_id) {
        $this->layout = "ajax";

        $this->set('proyect_id', $proyect_id);

        if (!empty($this->data)) {

            if ($this->Committee->saveAll($this->data)) {

                $last_id = $this->Committee->getLastInsertId();
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Seguimiento";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                $archivos = array(
                    array("campo" => "soporte", "nombre_archivo" => "Comite", "mensaje_error" => "Error adjuntando soporte"),
                    array("campo" => "cotizacion", "nombre_archivo" => "Cotizacion", "mensaje_error" => "Error adjuntando cotizaciones."),
                    array("campo" => "factura", "nombre_archivo" => "Factura", "mensaje_error" => "Error adjuntando facturas.")
                );

                $error_adjuntado = FALSE;
                $archivos_error = "";

                foreach ($archivos as $archivo) {
                    if (!empty($this->data['Committee'][$archivo['campo']]['tmp_name'])) {

                        $ext = explode(".", $this->data['Committee'][$archivo['campo']]['name']);
                        $conteo = count($ext);
                        $nombrearchivo = $archivo['nombre_archivo'] . "-" . $last_id . "." . $ext[$conteo - 1];

                        if ($ext[$conteo - 1] == 'pdf') {
                            if (!move_uploaded_file($this->data['Committee'][$archivo['campo']]['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                                $this->Session->setFlash($archivo['mensaje_error'], 'flash_error');
                                $this->redirect(array('controller' => 'Committees', 'action' => 'index'));
                            }
                        } else {
                            $error_adjuntado = TRUE;
                            $archivos_error .= $archivo['nombre_archivo'] . " ";
                        }
                    }
                }

                if ($error_adjuntado) {
                    $this->Session->setFlash('El archivo ' . $archivos_error . ' no se encuentra en un formato válido. Debe ser PDF.', 'flash_error');
                    $this->redirect(array('controller' => 'Committees', 'action' => 'index'));
                }

                $this->Session->setFlash('Comité de compras guardado correctamente', 'flash');
                $this->redirect(array('controller' => 'Committees', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error guardando los datos', 'flash');
                $this->redirect(array('controller' => 'pages', 'action' => 'display'));
            }
        }
    }

    public function edit($id) {
        $this->layout = "ajax";
        if (!empty($this->data)) {
            if ($this->Committee->saveAll($this->data)) {
                $last_id = $this->data['Committee']['id'];
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Seguimiento";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                $archivos = array(
                    array("campo" => "soporte", "nombre_archivo" => "Comite", "mensaje_error" => "Error adjuntando soporte"),
                    array("campo" => "cotizacion", "nombre_archivo" => "Cotizacion", "mensaje_error" => "Error adjuntando cotizaciones."),
                    array("campo" => "factura", "nombre_archivo" => "Factura", "mensaje_error" => "Error adjuntando facturas.")
                );

                $error_adjuntado = FALSE;
                $archivos_error = "";

                foreach ($archivos as $archivo) {
                    if (!empty($this->data['Committee'][$archivo['campo']]['tmp_name'])) {

                        $ext = explode(".", $this->data['Committee'][$archivo['campo']]['name']);
                        $conteo = count($ext);
                        $nombrearchivo = $archivo['nombre_archivo'] . "-" . $last_id . "." . $ext[$conteo - 1];

                        if ($ext[$conteo - 1] == 'pdf') {
                            if (!move_uploaded_file($this->data['Committee'][$archivo['campo']]['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                                $this->Session->setFlash($archivo['mensaje_error'], 'flash_error');
                                $this->redirect(array('controller' => 'Committees', 'action' => 'index'));
                            }
                        } else {
                            $error_adjuntado = TRUE;
                            $archivos_error .= $archivo['nombre_archivo'] . " ";
                        }
                    }
                }

                if ($error_adjuntado) {
                    $this->Session->setFlash('El archivo ' . $archivos_error . ' no se encuentra en un formato válido. Debe ser PDF.', 'flash_error');
                    $this->redirect(array('controller' => 'Committees', 'action' => 'index'));
                }

                $this->Session->setFlash('Comité de compras guardado correctamente', 'flash');
                $this->redirect(array('controller' => 'Committees', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error guardando los datos', 'flash');
                $this->redirect(array('controller' => 'pages', 'action' => 'display'));
            }
        } else {
            $this->data = $this->Committee->find('first', array('conditions' => array('Committee.id' => $id)));
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
            $planes = $this->Committee->Proyect->Follow->find('count', array('conditions' => array('Follow.proyect_id' => $proyect_id)));
            if ($planes < 1) {
                $this->Session->setFlash('Antes de cargar un comité de compras debe cargar un plan de inversión.', 'flash_error');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            } else {
                $this->set('aleatorio', rand(1111, 9999999));
                $this->set("codigo", $this->Session->read('codigo'));
                $this->set('Comites', $this->Committee->find('all', array('conditions' => array('Committee.proyect_id' => $proyect_id), 'recursive' => -1, 'fields' => array('Committee.*'), 'order' => array('Committee.id DESC'))));
            }
        }
    }

    public function delete($id) {
        $archivos = array('Comite', 'Cotizacion', 'Factura');

        foreach ($archivos as $archivo) {
            $path = ".." . DS . "webroot" . DS . "files" . DS . "Seguimiento" . DS . $archivo . "-" . $id . ".pdf";
            if (file_exists($path)) {
                unlink($path);
            }
        }

        if ($this->Committee->delete($id)) {
            $this->Session->setFlash('Comité de compras eliminado correctamente', 'flash');
            $this->redirect(array('controller' => 'Committees', 'action' => 'index'));
        } else {
            $this->Session->setFlash('Error borrando datos', 'flash_error');
            $this->redirect(array('controller' => 'pages', 'action' => 'display'));
        }
    }

}

?>