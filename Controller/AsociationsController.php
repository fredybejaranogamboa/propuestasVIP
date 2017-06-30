<?php

Class AsociationsController extends AppController {

    public $name = 'Asociations';

    public function add() {
        $this->layout = "ajax";

        if (!empty($this->data)) {

            $reemplazar = array('<', '>', '"', '–');
            $this->request->data['Asociation']['nombre'] = str_replace($reemplazar, "", $this->data['Asociation']['nombre']);

            if ($this->Asociation->saveAll($this->data)) {

                $last_id = $this->Asociation->getLastInsertId();
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Asociaciones";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                if (!empty($this->data['Asociation']['existencia']['tmp_name'])) {
                    $nombrearchivo = "existencia-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Asociation']['existencia']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando existencia', 'flash');
                    }
                }

                if (!empty($this->data['Asociation']['rut']['tmp_name'])) {
                    $nombrearchivo = "rut-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Asociation']['rut']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando rut', 'flash');
                    }
                }

                if (!empty($this->data['Asociation']['cedulaRepresentante']['tmp_name'])) {
                    $nombrearchivo = "cedulaRepresentante-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Asociation']['cedulaRepresentante']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando cedula.', 'flash');
                    }
                }

                if (!empty($this->data['Asociation']['certificado']['tmp_name'])) {
                    $nombrearchivo = "certificacion-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Asociation']['certificado']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando certificación.', 'flash');
                    }
                }

                if (!empty($this->data['Asociation']['certificacion_contrapartida']['tmp_name'])) {
                    $nombrearchivo = "certificacion_contrapartida-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Asociation']['certificacion_contrapartida']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando certificación contrapartida.', 'flash');
                    }
                }

                if (!empty($this->data['Asociation']['posesion']['tmp_name'])) {
                    $nombrearchivo = "posesion-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Asociation']['posesion']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando posesion.', 'flash');
                    }
                }
                
                if (!empty($this->data['Asociation']['resolucion']['tmp_name'])) {
                    $nombrearchivo = "resolucion-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Asociation']['resolucion']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando resolucion.', 'flash');
                    }
                }

                $this->Session->setFlash('Asociación guardada correctamente', 'flash');
                $this->redirect(array('controller' => 'Asociations', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error guardando los datos', 'flash');
                $this->redirect(array('controller' => 'pages', 'action' => 'display'));
            }
        } else {
            App::Import('model', 'Departament');
            $Departament = new Departament();
            $this->set('departaments', $Departament->find('list'));
        }
    }

    public function edit($id) {
        $this->layout = "ajax";
        $this->Asociation->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Asociation->find('first', array('conditions' => array('Asociation.id' => $id), 'fields' => array('Asociation.*')));
//            $proyect_id = $this->Session->read('proyect_id');
            $codigo = $this->Session->read('codigo');
            $grupos_habilitados = array(1, 17);
//            if ($this->Asociation->Proyect->Resolution->find('count', array('conditions' => array('Resolution.proyect_id' => $proyect_id))) < 1 or in_array($this->Auth->user('group_id'), $grupos_habilitados)) {
//                $this->set('permitir', true);
//            } else {
//                $resolution_id = $this->Asociation->Proyect->Resolution->field('id', array('Resolution.proyect_id' => $proyect_id, 'Resolution.tipo' => 'ADJUDICACIÓN'));
//                $rutaDocumento = APP . "webroot" . "/" . "files/resoluciones/SoporteResolucion-" . $codigo . "-" . $resolution_id . ".pdf";
//                if (file_exists("../webroot/files/resoluciones/SoporteResolucion-" . $codigo . "-" . $resolution_id . ".pdf")) {
//                    $this->set('permitir', false);
//                } else {
//                    $this->set('permitir', true);
//                }
//            }


            App::Import('model', 'Departament');
            $Departament = new Departament();
            $this->set('departaments', $Departament->find('list'));

            $departament_id = $this->Asociation->City->field('departament_id', array('City.id' => $this->data['Asociation']['city_id']));
            $this->set('departament_id', $departament_id);
            $this->set('cities', $this->Asociation->City->find('list', array('conditions' => array('City.departament_id' => $departament_id))));


            $this->set('permitir', true);
        } else {
            if ($this->Asociation->save($this->data)) {

                $last_id = $this->data['Asociation']['id'];
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Asociaciones";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                if (!empty($this->data['Asociation']['existencia']['tmp_name'])) {
                    $nombrearchivo = "existencia-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Asociation']['existencia']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando cedula', 'flash_error');
                    }
                }

                if (!empty($this->data['Asociation']['rut']['tmp_name'])) {
                    $nombrearchivo = "rut-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Asociation']['rut']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando cedula', 'flash_error');
                    }
                }

                if (!empty($this->data['Asociation']['cedulaRepresentante']['tmp_name'])) {
                    $nombrearchivo = "cedulaRepresentante-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Asociation']['cedulaRepresentante']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando cedula', 'flash_error');
                    }
                }

                if (!empty($this->data['Asociation']['certificado']['tmp_name'])) {
                    $nombrearchivo = "certificacion-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Asociation']['certificado']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando certificación.', 'flash_error');
                    }
                }

                if (!empty($this->data['Asociation']['certificacion_contrapartida']['tmp_name'])) {
                    $nombrearchivo = "certificacion_contrapartida-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Asociation']['certificacion_contrapartida']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando certificación contrapartida.', 'flash_error');
                    }
                }

                if (!empty($this->data['Asociation']['posesion']['tmp_name'])) {
                    $nombrearchivo = "posesion-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Asociation']['posesion']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando posesion.', 'flash_error');
                    }
                }
                
                if (!empty($this->data['Asociation']['resolucion']['tmp_name'])) {
                    $nombrearchivo = "resolucion-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Asociation']['resolucion']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando resolución.', 'flash');
                    }
                }

                $this->Session->setFlash('Registro editado correctamente', 'flash');
                $this->redirect(array('controller' => 'Asociations', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error editando datos', 'flash_error');
            }
        }
    }
    
    public function representante($id) {
        $this->layout = "ajax";
        $this->Asociation->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Asociation->find('first', array('conditions' => array('Asociation.id' => $id), 'fields' => array('Asociation.*')));
            $codigo = $this->Session->read('codigo');
            $grupos_habilitados = array(1, 17);

            App::Import('model', 'Departament');
            $Departament = new Departament();
            $this->set('departaments', $Departament->find('list'));

            $departament_id = $this->Asociation->City->field('departament_id', array('City.id' => $this->data['Asociation']['city_id']));
            $this->set('departament_id', $departament_id);
            $this->set('cities', $this->Asociation->City->find('list', array('conditions' => array('City.departament_id' => $departament_id))));

            $this->set('permitir', true);
        } else {
            if ($this->Asociation->save($this->data)) {

                $this->Session->setFlash('Registro editado correctamente', 'flash');
                $this->redirect(array('controller' => 'Asociations', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error editando datos', 'flash_error');
            }
        }
    }
    
    public function socio_organizacional($id) {
        $this->layout = "ajax";
        $this->Asociation->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Asociation->find('first', array('conditions' => array('Asociation.id' => $id), 'fields' => array('Asociation.*')));
            $codigo = $this->Session->read('codigo');
            $grupos_habilitados = array(1, 17);

            App::Import('model', 'Departament');
            $Departament = new Departament();
            $this->set('departaments', $Departament->find('list'));

            $departament_id = $this->Asociation->City->field('departament_id', array('City.id' => $this->data['Asociation']['city_id']));
            $this->set('departament_id', $departament_id);
            $this->set('cities', $this->Asociation->City->find('list', array('conditions' => array('City.departament_id' => $departament_id))));
            $this->set('permitir', true);
        } else {
            $reemplazar = array('<', '>', '"', '–');
            $this->request->data['Asociation']['nombre'] = str_replace($reemplazar, "", $this->data['Asociation']['nombre']);
            if ($this->Asociation->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash');
                $this->redirect(array('controller' => 'Asociations', 'action' => 'index'));
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


        $this->paginate = array('Asociation' => array('maxLimit' => 500, 'limit' => 500, 'fields' => array('Asociation.*')));
        //$this->set('Asociations', $this->paginate(array('Asociation.proyect_id' => $proyect_id)));
        $this->set('Asociations', $this->paginate());

//        $codigo = $this->Session->read('codigo');
//        $grupos_habilitados = array(1, 17);
        //$resolution_id = $this->Asociation->Proyect->Resolution->field('id', array('Resolution.proyect_id' => $proyect_id, 'Resolution.tipo' => 'ADJUDICACIÓN'));
        //$rutaDocumento = APP . "webroot" . "/" . "files/resoluciones/SoporteResolucion-" . $codigo . "-" . $resolution_id . ".pdf";
//        if (file_exists("../webroot/files/resoluciones/SoporteResolucion-" . $codigo . "-" . $resolution_id . ".pdf")) {
//            if (in_array($this->Auth->user('group_id'), $grupos_habilitados)) {
//                $this->set('permitir', true);
//            } else {
//                $this->set('permitir', false);
//            }
//        } else {
//            $this->set('permitir', true);
//        }
        $this->set('permitir', true);
    }

    public function delete($id) {
        if ($this->Asociation->delete($id)) {
            $this->Session->setFlash('Asociación eliminada correctamente', 'flash');
            $this->redirect(array('controller' => 'Asociations', 'action' => 'index'));
        } else {
            $this->Session->setFlash('Error borrando datos', 'flash');
            $this->redirect(array('controller' => 'pages', 'action' => 'display'));
        }
    }

    public function select() {
        $this->layout = "ajax";
        $this->set('cities', $this->Asociation->City->find('list', array(
                    'order' => 'name ASC',
                    'conditions' => array('City.departament_id' => $this->data['Asociation']['departament_id'])
                        )
        ));
    }

}

?>