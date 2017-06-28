<?php

Class PropertiesController extends AppController {

    public $name = 'Properties';

//    public $helpers = array('PhpExcel');
//    public $components = array('PhpExcel');

    public function select() {
        $this->layout = "ajax";
        $this->set('cities', $this->Property->City->find('list', array(
                    'order' => 'name ASC',
                    'conditions' => array('City.departament_id' => $this->data['Property']['departament_id'])
                        )
        ));
    }

    public function upload_files($property_id) {
        $this->layout = "ajax";
        $this->set('property_id', $property_id);
        if (empty($this->data)) {
            $this->data = $this->Property->find('first', array('recursive' => -1, 'conditions' => array('Property.id' => $property_id), 'fields' => array('Property.*')));
        } else {
            $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Predio-" . $this->data['Property']['id'];
            if (!is_dir($rutaArchivo)) {
                if (!mkdir($rutaArchivo)) {
                    echo "error creando archivo";
                    //redirect
                }
            }

            $rutaMatricula = $rutaArchivo;
            $rutaDistrito = $rutaArchivo;
            $rutaResguardo = $rutaArchivo;
            $rutaConsejo = $rutaArchivo;
            $rutaUso = $rutaArchivo;

            $rutaDeclaracionExtrajuicio = $rutaArchivo;
            $rutaJuntaAccionComunal = $rutaArchivo;
            $rutaSanaPosesion = $rutaArchivo;
            $rutaManifiestoColindancias = $rutaArchivo;
            $rutaVerificacionPredial = $rutaArchivo;
            $rutaTramiteAmbiental = $rutaArchivo;

            if (empty($this->request->data['Property']['archivo_matricula']['tmp_name']) and
                    empty($this->request->data['Property']['distrito']['tmp_name']) and
                    empty($this->request->data['Property']['resguardo']['tmp_name']) and
                    empty($this->request->data['Property']['consejo']['tmp_name']) and
                    empty($this->request->data['Property']['uso_suelo']['tmp_name']) and
                    empty($this->request->data['Property']['tramites_ambientales']['tmp_name']) and
                    empty($this->request->data['Property']['declaracion_extrajuicio']['tmp_name']) and
                    empty($this->request->data['Property']['junta_accion_comunal']['tmp_name']) and
                    empty($this->request->data['Property']['sana_posesion']['tmp_name']) and
                    empty($this->request->data['Property']['tramites_ambientales']['tmp_name']) and
                    empty($this->request->data['Property']['verificacion_predial']['tmp_name']) and
                    empty($this->request->data['Property']['manifiesto_colindancias']['tmp_name']) and
                    empty($this->request->data['Property']['f25']['tmp_name']) and
                    empty($this->request->data['Property']['f4']['tmp_name'])
            ) {
                $this->Session->setFlash('Error cargando los archivos.', 'flash');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            } else {

                $exito = 1;
                if (!empty($this->request->data['Property']['verificacion_predial']['tmp_name'])) {
                    $nombreVerificacion = "verificacion_predial.pdf";
                    $rutaVerificacionPredial.=DS . $nombreVerificacion;
                    if (move_uploaded_file($this->data['Property']['verificacion_predial']['tmp_name'], $rutaVerificacionPredial)) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Error adjuntando verificación predial', 'flash_error');
                    }
                }

                if (!empty($this->request->data['Property']['f25']['tmp_name'])) {
                    if (move_uploaded_file($this->data['Property']['f25']['tmp_name'], $rutaArchivo . DS . "f25.pdf")) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Error adjuntando f25', 'flash_error');
                    }
                }

                if (!empty($this->request->data['Property']['f4']['tmp_name'])) {
                    if (move_uploaded_file($this->data['Property']['f4']['tmp_name'], $rutaArchivo . DS . "f4.pdf")) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Error adjuntando f4', 'flash_error');
                    }
                }

                if (!empty($this->request->data['Property']['tramites_ambientales']['tmp_name'])) {
                    $nombreTramiteAmbiental = "tramites_ambientales.pdf";
                    $rutaTramiteAmbiental.=DS . $nombreTramiteAmbiental;
                    if (move_uploaded_file($this->data['Property']['tramites_ambientales']['tmp_name'], $rutaTramiteAmbiental)) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Error adjuntando tramite ambiental', 'flash_error');
                    }
                }

                if (!empty($this->request->data['Property']['archivo_matricula']['tmp_name'])) {
                    $nombreMatricula = "Matricula.pdf";
                    $rutaMatricula.=DS . $nombreMatricula;
                    if (move_uploaded_file($this->data['Property']['archivo_matricula']['tmp_name'], $rutaMatricula)) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Error adjuntando matricula', 'flash_error');
                    }
                }

                if (!empty($this->request->data['Property']['distrito']['tmp_name'])) {
                    $nombreDistrito = "Distrito.pdf";
                    $rutaDistrito.=DS . $nombreDistrito;
                    if (move_uploaded_file($this->data['Property']['distrito']['tmp_name'], $rutaDistrito)) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Error adjuntando distrito de riego', 'flash_error');
                    }
                }

                if (!empty($this->request->data['Property']['resguardo']['tmp_name'])) {
                    $nombreResguardo = "Resguardo.pdf";
                    $rutaResguardo.=DS . $nombreResguardo;
                    if (move_uploaded_file($this->data['Property']['resguardo']['tmp_name'], $rutaResguardo)) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Error adjuntando resguardo', 'flash_error');
                    }
                }

                if (!empty($this->request->data['Property']['consejo']['tmp_name'])) {
                    $nombreConsejo = "Consejo.pdf";
                    $rutaConsejo.=DS . $nombreConsejo;
                    if (move_uploaded_file($this->data['Property']['consejo']['tmp_name'], $rutaConsejo)) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Error adjuntando resguardo', 'flash_error');
                    }
                }

                if (!empty($this->request->data['Property']['uso_suelo']['tmp_name'])) {
                    $nombreUso = "Uso_suelo.pdf";
                    $rutaUso.=DS . $nombreUso;
                    if (move_uploaded_file($this->data['Property']['uso_suelo']['tmp_name'], $rutaUso)) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Error adjuntando resguardo', 'flash_error');
                    }
                }

                if (!empty($this->request->data['Property']['junta_accion_comunal']['tmp_name'])) {
                    $nombreJuntaAccionComunal = "junta_accion_comunal.pdf";
                    $rutaJuntaAccionComunal.=DS . $nombreJuntaAccionComunal;
                    if (move_uploaded_file($this->data['Property']['junta_accion_comunal']['tmp_name'], $rutaJuntaAccionComunal)) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Error adjuntando junta_accion_comunal', 'flash_error');
                    }
                }

                if (!empty($this->request->data['Property']['sana_posesion']['tmp_name'])) {
                    $nombreSanaPosesion = "sana_posesion.pdf";
                    $rutaSanaPosesion.=DS . $nombreSanaPosesion;
                    if (move_uploaded_file($this->data['Property']['sana_posesion']['tmp_name'], $rutaSanaPosesion)) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Error adjuntando sana posesión', 'flash_error');
                    }
                }

                if (!empty($this->request->data['Property']['manifiesto_colindancias']['tmp_name'])) {
                    $nombreManifiestoColindancias = "manifiesto_colindancias.pdf";
                    $rutaManifiestoColindancias.=DS . $nombreManifiestoColindancias;
                    if (move_uploaded_file($this->data['Property']['manifiesto_colindancias']['tmp_name'], $rutaManifiestoColindancias)) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Error adjuntando manifiesto colindancias', 'flash_error');
                    }
                }

                if (!empty($this->request->data['Property']['declaracion_extrajuicio']['tmp_name'])) {
                    $nombreDeclaracionExtrajuicio = "declaracion_extrajuicio.pdf";
                    $rutaDeclaracionExtrajuicio.=DS . $nombreDeclaracionExtrajuicio;
                    if (move_uploaded_file($this->data['Property']['declaracion_extrajuicio']['tmp_name'], $rutaDeclaracionExtrajuicio)) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Error adjuntando declaración extrajuicio', 'flash_error');
                    }
                }

                if ($exito == 1) {
                    $this->Session->setFlash('Archivo cargado correctamente', 'flash');
                    $this->redirect(array('controller' => 'Properties', 'action' => 'index'));
                } else {

                    $this->Session->setFlash('Error Guardando archivo', 'flash_error');
                    $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
                }
            }
        }
    }

    public function index() {
        if (!$this->RequestHandler->isAjax()) {
            $this->layout = "default";
        } else {
            $this->layout = "ajax";
        }

        $proyect_id = $this->Session->read('proyect_id');
        $codigo = $this->Session->read('codigo');

        if ($this->Property->Proyect->Resolution->find('count', array('conditions' => array('Resolution.proyect_id' => $proyect_id))) < 1 or $this->Auth->user('group_id') == 1) {
            $this->set('permitir', true);
        } else {
            $resolution_id = $this->Property->Proyect->Resolution->field('id', array('Resolution.proyect_id' => $proyect_id, 'Resolution.tipo' => 'ADJUDICACIÓN'));
            $rutaDocumento = APP . "webroot" . "/" . "files/resoluciones/SoporteResolucion-" . $codigo . "-" . $resolution_id . ".pdf";
            if (file_exists("../webroot/files/resoluciones/SoporteResolucion-" . $codigo . "-" . $resolution_id . ".pdf")) {
                $this->set('permitir', false);
            } else {
                $this->set('permitir', true);
            }
        }

        if ($proyect_id != "") {
            $this->set('proyect_id', $proyect_id);
            $this->set('Properties', $this->Property->find('all', array('recursive' => -1,
                        'order' => array('Property.id' => 'DESC'),
                        'fields' => array('City.name', 'Departament.name', 'Property.id', 'Property.nombre', 'Property.*'),
                        'conditions' => array('Property.proyect_id' => $proyect_id),
                        'joins' => array(
                            array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => array('City.id=Property.city_id')),
                            array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => array('Departament.id=City.departament_id')),
            ))));
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash');
            $this->redirect(array('controller' => 'pages', 'action' => 'display'));
        }
    }

    public function view_files($property_id) {
        $this->layout = "ajax";
        $this->set("property_id", $property_id);
        $this->Property->recursive = -1;
        $this->set('Property', $this->Property->find('first', array('conditions' => array('Property.id' => $property_id), 'fields' => array('Property.*'))));
        $this->set('aleatorio', rand(1111, 9999999));
        if ($this->Auth->user('group_id') == 1 or $this->Auth->user('group_id') == 18) {
            $this->set('admin', true);
        } else {
            $this->set('admin', false);
        }
    }

    public function add_property() {
        $this->layout = "ajax";
        $proyect_id = $this->Session->read('proyect_id');
        $this->set('proyect_id', $proyect_id);
        if (empty($this->data)) {
            App::Import('model', 'Departament');
            $Departament = new Departament();
            $this->set('departaments', $Departament->find('list'));
        } else {
            if ($this->Property->save($this->data)) {
                $this->Session->setFlash('Predio creado correctamente', 'flash');
                $this->redirect(array('controller' => 'Properties', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error guardando datos', 'flash_error');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            }
        }
    }

    public function edit_property($id) {
        $this->layout = "ajax";
        $this->Property->recursive = -1;
        $this->set('departaments', $this->Property->Departament->find('list'));
        if (empty($this->data)) {
            $this->data = $this->Property->find('first', array('conditions' => array('Property.id' => $id),));
            $this->set('cities', $this->Property->City->find('list', array('conditions' => array('City.departament_id' => $this->data['Property']['departament_id']))));
        } else {

            if ($this->Property->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash');
                $this->redirect(array('controller' => 'Properties', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error editando datos', 'flash_error');
            }
        }
    }

    public function delete($property_id) {
        if ($this->Property->delete($property_id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash');
            $this->redirect(array('controller' => 'Properties', 'action' => 'index'));
        } else {
            $this->Session->setFlash('Error al intentar borrar el predio, por favor intentelo nuevamente.', 'flash_error');
            $this->redirect(array('controller' => 'Properties', 'action' => 'index'));
        }
    }

    public function view($property_id) {
        $this->layout = "ajax";
        $this->set("property_id", $property_id);
        $this->set('property', $this->Property->find('first', array('recursive' => -1, 'conditions' => array('Property.id' => $property_id), 'joins' => array(array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => array('City.id=Property.city_id')), array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => array('Departament.id=City.departament_id'))), 'fields' => array('Property.*', 'City.name', 'Departament.name'))));
    }

    public function report($option) {
        $this->layout = "ajax";
        ini_set('max_execution_time', 600);
        $this->set('properties', $this->Property->find('all', array('recursive' => 1, 'fields' => array('Property.*', 'Proyect.codigo', 'City.name', 'Departament.name'), 'order' => array('Property.nombre' => 'ASC'))));
    }

    public function delete_file($tipo, $id) {
        $path = ".." . DS . "webroot" . DS . "files" . DS . "Predio-" . $id . DS;
        switch ($tipo) {
            case 1:
                $path .= "verificacion_predial" . ".pdf";
                break;
            case 2:
                $path .= "f25" . ".pdf";
                break;
            case 3:
                $path .= "f4" . ".pdf";
                break;
            case 4:
                $path .= "tramites_ambientales" . ".pdf";
                break;
            case 5:
                $path .= "Matricula" . ".pdf";
                break;
            case 6:
                $path .= "Distrito" . ".pdf";
                break;
            case 7:
                $path .= "Resguardo" . ".pdf";
                break;
            case 8:
                $path .= "Consejo" . ".pdf";
                break;
            case 9:
                $path .= "Uso_suelo" . ".pdf";
                break;
            case 10:
                $path .= "junta_accion_comunal" . ".pdf";
                break;
            case 11:
                $path .= "sana_posesion" . ".pdf";
                break;
            case 12:
                $path .= "manifiesto_colindancias" . ".pdf";
                break;
            case 13:
                $path .= "declaracion_extrajuicio" . ".pdf";
                break;
            default:
                break;
        }
        if (file_exists($path)) {
            unlink($path);
            $this->Session->setFlash('Archivo  borrado correctamente', 'flash');
            $this->redirect(array('action' => "view_files", $id));
        } else {
            $this->redirect(array('controller' => 'Pages', 'action' => "error", "Error borrando el archivo."));
        }
    }

}

?>