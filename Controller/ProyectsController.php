<?php

Class ProyectsController extends AppController {

    public $name = 'Proyects';

    public function add() {
        $this->layout = "ajax";
        $this->set('departaments', $this->Proyect->Departament->find('list', array('order' => array('Departament.name' => 'ASC'))));
        $this->set('branches', $this->Proyect->Branch->find('list', array('order' => array('Branch.nombre' => 'ASC'))));
        App::import("Model", "Call");
        $Call = new Call();
        App::import("Model", "Asociation");
        $Asociation = new Asociation();
        App::import("Model", "Agreement");
        $a = new Agreement();
        $Call->recursive = -1;
        $this->set('calls', $Call->find('list', array('fields' => array('Call.id', 'Call.nombre'), 'order' => array('Call.id DESC'))));
        $Asociation->recursive = -1;
        $this->set('asociations', $Asociation->find('list', array('fields' => array('Asociation.id', 'Asociation.nit', 'Asociation.nombre'), 'order' => array('Asociation.nombre ASC'))));

        if (!empty($this->data)) {
            if ($this->Proyect->find('first', array('conditions' => array('Proyect.codigo' => strtoupper($this->request->data['Proyect']['codigo'])))) or empty($this->request->data['Proyect']['codigo'])) {
                $this->Session->setFlash('Ya existe un proyecto con ese código intente de nuevo', 'flash');
                $this->redirect(array('controller' => 'Proyects', 'action' => 'index'));
            }

//            $Departamento = new Departament();
//            $Departamento->recursive = -1;
//
//            $cod_departamento = $Departamento->field('code', array('id' => $this->request->data['Proyect']['departament_id']));
//
//            $anio = $Call->field('nombre', array('id' => $this->request->data['Proyect']['call_id']));
//
//            $consecutivoDepartamento = $Departamento->field('index', array('id' => $this->request->data['Proyect']['departament_id']));
//            $codigo = "P" . $this->request->data['Proyect']['tipo'] . substr($anio, -2) . "-" . $cod_departamento . "-" . $consecutivoDepartamento;
//            $this->request->data['Proyect']['codigo'] = strtoupper($codigo);

            $reemplazar = array('<', '>', '"', '–');
            $this->request->data['Proyect']['nombre'] = str_replace($reemplazar, "", $this->data['Proyect']['nombre']);

            if ($this->Proyect->save($this->data)) {

                $last_id = $this->Proyect->getLastInsertId();
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Propuestas";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                if (!empty($this->data['Proyect']['archivo_propuesta']['tmp_name'])) {
                    $nombrearchivo = "Propuesta-f2-" . $last_id . ".pdf";
                    if (move_uploaded_file($this->data['Proyect']['archivo_propuesta']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $update = array('Proyect' => array(
                                'id' => $last_id
                        ));
                        $this->Proyect->save($update);
                    } else {
                        $this->Session->setFlash('Error adjuntando archivo propuesta', 'flash_error');
                    }
                }

                if (!empty($this->data['Proyect']['f24']['tmp_name'])) {
                    $nombrearchivo = "f24-" . $last_id . ".pdf";
                    if (move_uploaded_file($this->data['Proyect']['f24']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $update = array('Proyect' => array(
                                'id' => $last_id
                        ));
                        $this->Proyect->save($update);
                    } else {
                        $this->Session->setFlash('Error adjuntando archivo propuesta f24', 'flash_error');
                    }
                }

                if (!empty($this->data['Proyect']['archivo_propuesta_calificacion']['tmp_name'])) {
                    $nombrearchivo = "Propuesta-calificacion-f3-" . $last_id . ".pdf";
                    if (move_uploaded_file($this->data['Proyect']['archivo_propuesta_calificacion']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $update = array('Proyect' => array(
                                'id' => $last_id
                        ));
                        $this->Proyect->save($update);
                    } else {
                        $this->Session->setFlash('Error adjuntando archivo calificación propuesta', 'flash_error');
                    }
                }

                if (!empty($this->data['Proyect']['archivo_propuesta_productiva']['tmp_name'])) {
                    $nombrearchivo = "Propuesta-productiva-f1-" . $last_id . ".pdf";
                    if (move_uploaded_file($this->data['Proyect']['archivo_propuesta_productiva']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $update = array('Proyect' => array(
                                'id' => $last_id
                        ));
                        $this->Proyect->save($update);
                    } else {
                        $this->Session->setFlash('Error adjuntando archivo propuesta productiva', 'flash_error');
                    }
                }

//                $update = array('Departament' => array(
//                        'id' => $this->data['Proyect']['departament_id'],
//                        'index' => $consecutivoDepartamento + 1
//                ));
//                $Departamento->save($update);
                $this->Session->setFlash('Se creó el proyecto ' . $this->data['Proyect']['codigo'], 'flash');
                $this->redirect(array('controller' => 'Proyects', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        } else {
            $this->set('agreements', $a->find('list', array('order' => 'Agreement.id ASC', 'fields' => array('Agreement.id', 'Agreement.numero', 'Agreement.suscriptor'))));
        }
    }

    public function edit($proyect_id = null) {

        $this->Set('group_id', $this->Auth->user('group_id'));
        if (!isset($proyect_id)) {
            $proyect_id = $this->Session->read('proyect_id');
        }

        $this->set('proyect_id', $proyect_id);

        if ($proyect_id != "") {
            App::import("Model", "Agreement");
            $a = new Agreement();
            $this->set('departaments', $this->Proyect->Departament->find('list', array('order' => array('Departament.name' => 'ASC'))));
            $this->set('branches', $this->Proyect->Branch->find('list', array('order' => array('Branch.nombre' => 'ASC'))));
            $this->set('group_id', $this->Auth->user('group_id'));
            $this->set('agreements', $a->find('list', array('order' => 'Agreement.id ASC', 'fields' => array('Agreement.id', 'Agreement.numero', 'Agreement.suscriptor'))));
            App::import("Model", "Asociation");
            $Asociation = new Asociation();
            $Asociation->recursive = -1;
            $this->set('asociations', $Asociation->find('list', array('fields' => array('Asociation.id', 'Asociation.nit', 'Asociation.nombre'), 'order' => array('Asociation.nombre ASC'))));
            $this->Proyect->recursive = -1;
            App::import("Model", "Call");
            $Call = new Call();
            $Call->recursive = -1;
            $this->set('calls', $Call->find('list', array('fields' => array('Call.id', 'Call.nombre'), 'order' => array('Call.id DESC'))));

            if (empty($this->data)) {
                $this->data = $this->Proyect->find('first', array('conditions' => array('Proyect.id' => $proyect_id), 'joins' => array(array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => array('Departament.id=Proyect.departament_id')), array('table' => 'calls', 'alias' => 'Call', 'type' => 'left', 'conditions' => array('Call.id=Proyect.call_id'))), 'fields' => array("Proyect.*", 'Departament.id')));
                $this->request->data['Proyect']['departament.id'] = $this->request->data['Departament']['id'];

                $proyect_id = $this->Session->read('proyect_id');
                $codigo = $this->Session->read('codigo');

                if ($this->Proyect->Resolution->find('count', array('conditions' => array('Resolution.proyect_id' => $proyect_id))) < 1 or $this->Auth->user('group_id') == 1) {
                    $this->set('permitir', true);
                } else {
                    $resolution_id = $this->Proyect->Resolution->field('id', array('Resolution.proyect_id' => $proyect_id, 'Resolution.tipo' => 'ADJUDICACIÓN'));
                    $rutaDocumento = APP . "webroot" . "/" . "files/resoluciones/SoporteResolucion-" . $codigo . "-" . $resolution_id . ".pdf";
                    if (file_exists("../webroot/files/resoluciones/SoporteResolucion-" . $codigo . "-" . $resolution_id . ".pdf")) {
                        $this->set('permitir', false);
                    } else {
                        $this->set('permitir', true);
                    }
                }
            } else {
                $reemplazar = array('<', '>', '"', '–');
                $this->request->data['Proyect']['nombre'] = str_replace($reemplazar, "", $this->data['Proyect']['nombre']);
                if ($this->Proyect->save($this->data)) {
                    $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Propuestas";
                    if (!is_dir($rutaArchivo)) {
                        if (!mkdir($rutaArchivo)) {
                            echo "error creando archivo";
                            //redirect
                        }
                    }

                    if (!empty($this->data['Proyect']['archivo_propuesta']['tmp_name'])) {
                        $nombrearchivo = "Propuesta-f2-" . $proyect_id . ".pdf";
                        if (move_uploaded_file($this->data['Proyect']['archivo_propuesta']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                            
                        } else {
                            $this->Session->setFlash('Error adjuntando archivo propuesta', 'flash');
                        }
                    }

                    if (!empty($this->data['Proyect']['f24']['tmp_name'])) {
                        $nombrearchivo = "f24-" . $proyect_id . ".pdf";
                        if (!move_uploaded_file($this->data['Proyect']['f24']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                            $this->Session->setFlash('Error adjuntando archivo propuesta f24', 'flash_error');
                        }
                    }

                    if (!empty($this->data['Proyect']['archivo_propuesta_productiva']['tmp_name'])) {
                        $nombrearchivo = "Propuesta-productiva-f1-" . $proyect_id . ".pdf";
                        if (move_uploaded_file($this->data['Proyect']['archivo_propuesta_productiva']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                            
                        } else {
                            $this->Session->setFlash('Error adjuntando archivo propuesta productiva', 'flash');
                        }
                    }

                    if (!empty($this->data['Proyect']['archivo_propuesta_calificacion']['tmp_name'])) {
                        $nombrearchivo = "Propuesta-calificacion-f3-" . $proyect_id . ".pdf";
                        if (move_uploaded_file($this->data['Proyect']['archivo_propuesta_calificacion']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                            
                        } else {
                            $this->Session->setFlash('Error adjuntando archivo propuesta', 'flash');
                        }
                    }

                    $this->Session->setFlash('Registro editado correctamente', 'flash');
                    $this->redirect(array('controller' => 'Proyects', 'action' => 'index'));
                } else {
                    $this->Session->setFlash('Error editando datos');
                }
            }
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        }
    }
    
    public function componente_tecnico($proyect_id = null) {

        $this->Set('group_id', $this->Auth->user('group_id'));
        if (!isset($proyect_id)) {
            $proyect_id = $this->Session->read('proyect_id');
        }

        $this->set('proyect_id', $proyect_id);

        if ($proyect_id != "") {
            App::import("Model", "Agreement");
            $a = new Agreement();
            $this->set('departaments', $this->Proyect->Departament->find('list', array('order' => array('Departament.name' => 'ASC'))));
            $this->set('branches', $this->Proyect->Branch->find('list', array('order' => array('Branch.nombre' => 'ASC'))));
            $this->set('group_id', $this->Auth->user('group_id'));
            $this->set('agreements', $a->find('list', array('order' => 'Agreement.id ASC', 'fields' => array('Agreement.id', 'Agreement.numero', 'Agreement.suscriptor'))));
            App::import("Model", "Asociation");
            $Asociation = new Asociation();
            $Asociation->recursive = -1;
            $this->set('asociations', $Asociation->find('list', array('fields' => array('Asociation.id', 'Asociation.nit', 'Asociation.nombre'), 'order' => array('Asociation.nombre ASC'))));
            $this->Proyect->recursive = -1;
            App::import("Model", "Call");
            $Call = new Call();
            $Call->recursive = -1;
            $this->set('calls', $Call->find('list', array('fields' => array('Call.id', 'Call.nombre'), 'order' => array('Call.id DESC'))));

            if (empty($this->data)) {
                $this->data = $this->Proyect->find('first', array('conditions' => array('Proyect.id' => $proyect_id), 'joins' => array(array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => array('Departament.id=Proyect.departament_id')), array('table' => 'calls', 'alias' => 'Call', 'type' => 'left', 'conditions' => array('Call.id=Proyect.call_id'))), 'fields' => array("Proyect.*", 'Departament.id')));
                $this->request->data['Proyect']['departament.id'] = $this->request->data['Departament']['id'];

                $proyect_id = $this->Session->read('proyect_id');
                $codigo = $this->Session->read('codigo');

                if ($this->Proyect->Resolution->find('count', array('conditions' => array('Resolution.proyect_id' => $proyect_id))) < 1 or $this->Auth->user('group_id') == 1) {
                    $this->set('permitir', true);
                } else {
                    $resolution_id = $this->Proyect->Resolution->field('id', array('Resolution.proyect_id' => $proyect_id, 'Resolution.tipo' => 'ADJUDICACIÓN'));
                    $rutaDocumento = APP . "webroot" . "/" . "files/resoluciones/SoporteResolucion-" . $codigo . "-" . $resolution_id . ".pdf";
                    if (file_exists("../webroot/files/resoluciones/SoporteResolucion-" . $codigo . "-" . $resolution_id . ".pdf")) {
                        $this->set('permitir', false);
                    } else {
                        $this->set('permitir', true);
                    }
                }
            } else {
                $reemplazar = array('<', '>', '"', '–');
                $this->request->data['Proyect']['nombre'] = str_replace($reemplazar, "", $this->data['Proyect']['nombre']);
                if ($this->Proyect->save($this->data)) {
                    $this->Session->setFlash('Registro editado correctamente', 'flash');
                    $this->redirect(array('controller' => 'Proyects', 'action' => 'index'));
                } else {
                    $this->Session->setFlash('Error editando datos');
                }
            }
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        }
    }
    
    public function condiciones_biofisicas($proyect_id = null) {

        $this->Set('group_id', $this->Auth->user('group_id'));
        if (!isset($proyect_id)) {
            $proyect_id = $this->Session->read('proyect_id');
        }

        $this->set('proyect_id', $proyect_id);

        if ($proyect_id != "") {
            if (empty($this->data)) {
                $this->Proyect->recursive = -1;
                $this->data = $this->Proyect->find('first', array('conditions' => array('Proyect.id' => $proyect_id), 'fields' => array("Proyect.*")));
            } else {
                $reemplazar = array('<', '>', '"', '–');
                $this->request->data['Proyect']['nombre'] = str_replace($reemplazar, "", $this->data['Proyect']['nombre']);
                if ($this->Proyect->save($this->data)) {
                    $this->Session->setFlash('Registro editado correctamente', 'flash');
                    $this->redirect(array('controller' => 'Proyects', 'action' => 'index'));
                } else {
                    $this->Session->setFlash('Error editando datos');
                }
            }
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        }
    }
    
    public function componente_comercial($proyect_id = null) {

        $this->Set('group_id', $this->Auth->user('group_id'));
        if (!isset($proyect_id)) {
            $proyect_id = $this->Session->read('proyect_id');
        }

        $this->set('proyect_id', $proyect_id);

        if ($proyect_id != "") {
            if (empty($this->data)) {
                $this->Proyect->recursive = -1;
                $this->data = $this->Proyect->find('first', array('conditions' => array('Proyect.id' => $proyect_id), 'fields' => array("Proyect.*")));
            } else {
                $reemplazar = array('<', '>', '"', '–');
                $this->request->data['Proyect']['nombre'] = str_replace($reemplazar, "", $this->data['Proyect']['nombre']);
                if ($this->Proyect->save($this->data)) {
                    $this->Session->setFlash('Registro editado correctamente', 'flash');
                    $this->redirect(array('controller' => 'Proyects', 'action' => 'index'));
                } else {
                    $this->Session->setFlash('Error editando datos');
                }
            }
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        }
    }
    
    public function componente_ambiental($proyect_id = null) {

        $this->Set('group_id', $this->Auth->user('group_id'));
        if (!isset($proyect_id)) {
            $proyect_id = $this->Session->read('proyect_id');
        }

        $this->set('proyect_id', $proyect_id);

        if ($proyect_id != "") {
            if (empty($this->data)) {
                $this->Proyect->recursive = -1;
                $this->data = $this->Proyect->find('first', array('conditions' => array('Proyect.id' => $proyect_id), 'fields' => array("Proyect.*")));
            } else {
                $reemplazar = array('<', '>', '"', '–');
                $this->request->data['Proyect']['nombre'] = str_replace($reemplazar, "", $this->data['Proyect']['nombre']);
                if ($this->Proyect->save($this->data)) {
                    $this->Session->setFlash('Registro editado correctamente', 'flash');
                    $this->redirect(array('controller' => 'Proyects', 'action' => 'index'));
                } else {
                    $this->Session->setFlash('Error editando datos');
                }
            }
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        }
    }
    
    public function indicadores_organizacion($proyect_id = null) {

        $this->Set('group_id', $this->Auth->user('group_id'));
        if (!isset($proyect_id)) {
            $proyect_id = $this->Session->read('proyect_id');
        }

        $this->set('proyect_id', $proyect_id);

        if ($proyect_id != "") {
            if (empty($this->data)) {
                $this->Proyect->recursive = -1;
                $this->data = $this->Proyect->find('first', array('conditions' => array('Proyect.id' => $proyect_id), 'fields' => array("Proyect.*")));
            } else {
                $reemplazar = array('<', '>', '"', '–');
                $this->request->data['Proyect']['nombre'] = str_replace($reemplazar, "", $this->data['Proyect']['nombre']);
                if ($this->Proyect->save($this->data)) {
                    $this->Session->setFlash('Registro editado correctamente', 'flash');
                    $this->redirect(array('controller' => 'Proyects', 'action' => 'index'));
                } else {
                    $this->Session->setFlash('Error editando datos');
                }
            }
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        }
    }

    public function index() {
        $this->layout = "default";
        if (!$this->Session->valid()) {
            $this->redirect(array('controller' => 'pages', 'action' => 'error', "Sesión no valida. Por favor salga del aplicativo y vuelva a ingresar sus datos."));
        }
        $this->set('aleatorio', rand(1111, 9999999));
        $autorizados = array(1, 17, 18);

        if (in_array($this->Auth->user('group_id'), $autorizados)) {
            $this->set('Proyects', $this->Proyect->find('all', array('recursive' => -1, 'joins' => array(array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => array('Departament.id=Proyect.departament_id')), array('table' => 'calls', 'alias' => 'Call', 'type' => 'left', 'conditions' => array('Call.id=Proyect.call_id')), array('table' => 'asociations', 'alias' => 'Asociation', 'type' => 'left', 'conditions' => array('Asociation.id=Proyect.asociation_id'))), 'order' => array('Proyect.id' => 'DESC'), 'fields' => array('Proyect.id', 'Proyect.codigo', 'Proyect.valor_solicitado', 'Proyect.estado', 'Proyect.nombre', 'Call.nombre', 'Departament.name', 'Asociation.nit', 'Asociation.nombre'))));
        } else {
            $this->set('Proyects', $this->Proyect->find('all', array('conditions' => array('Proyect.branch_id' => $this->Auth->user('branch_id')), 'recursive' => -1, 'joins' => array(array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => array('Departament.id=Proyect.departament_id')), array('table' => 'asociations', 'alias' => 'Asociation', 'type' => 'left', 'conditions' => array('Asociation.id=Proyect.asociation_id')), array('table' => 'calls', 'alias' => 'Call', 'type' => 'left', 'conditions' => array('Call.id=Proyect.call_id'))), 'order' => array('Proyect.id' => 'DESC'), 'fields' => array('Proyect.id', 'Proyect.codigo', 'Proyect.valor_solicitado', 'Proyect.nombre', 'Proyect.estado', 'Call.nombre', 'Departament.name', 'Asociation.nit', 'Asociation.nombre'))));
        }
    }

    public function view($proyect_id) {
        $this->layout = "ajax";
        $this->set("proyect_id", $proyect_id);
        $this->set('proyect', $this->Proyect->find('first', array('recursive' => -1, 'conditions' => array('Proyect.id' => $proyect_id), 'fields' => array('Proyect.*'))));
    }

    public function select_proyect() {
        if (!$this->Session->valid()) {
            $this->redirect(array('controller' => 'pages', 'action' => 'error', "Sesión no valida. Por favor salga del aplicativo y vuelva a ingresar sus datos."));
        }

        $this->pageTitle = 'Convocatorias 2011';
        $this->disableCache();
        $this->layout = "ajax";

        $codigo = strtoupper($this->data['Proyect']['codigo']);

        $this->Proyect->recursive = -1;

        if (!empty($this->data)) {
            if ($proyecto = $this->Proyect->find('first', array('conditions' => array('Proyect.codigo' => $codigo, 'Proyect.call_id' => $this->data['Proyect']['call_id']), 'fields' => array('Proyect.call_id', 'Proyect.codigo', 'Proyect.id', 'Proyect.tipo', 'Proyect.cerrado')))) {
                $this->Session->write('codigo', "$codigo");
                $this->Session->write('call_id', $this->data['Proyect']['call_id']);
                $this->Session->write('proyect_id', $proyecto['Proyect']['id']);
                $this->Session->write('proyect_tipo', $proyecto['Proyect']['tipo']);
                $this->Session->write('cerrado', $proyecto['Proyect']['cerrado']);
                $this->set("respuesta", "<h3>PROYECTO ACTIVO:<br>$codigo</h3>");
            } else {
                $this->Session->write('codigo', "");
                $this->Session->write('proyect_id', "");
                $this->Session->write('candidate_id', "");
                $this->Session->write('call_id', "");
                $this->Session->write('proyect_tipo', "");
                $this->Session->write('cerrado', "");
                $this->set("respuesta", "<h3>No ha seleccionado proyecto</h3>");
                $this->Session->setFlash("No existe proyecto con codigo '$codigo'", 'flash_error');
            }
        }
    }

    public function select_proyect2($proyect_id) {
        $this->layout = "ajax";
        if (!$this->Session->valid()) {
            $this->redirect(array('controller' => 'pages', 'action' => 'error', "Sesión no valida. Por favor salga del aplicativo y vuelva a ingresar sus datos."));
        }

        $this->disableCache();
        $this->Proyect->recursive = -1;
        $proyecto = $this->Proyect->find('first', array('conditions' => array('Proyect.id' => $proyect_id), 'fields' => array('Proyect.*')));
        $this->Session->write('codigo', $proyecto['Proyect']['codigo']);
        $this->Session->write('call_id', $proyecto['Proyect']['call_id']);
        $this->Session->write('proyect_id', $proyecto['Proyect']['id']);
        $codigo = strtoupper($proyecto['Proyect']['codigo']);
        $this->set("respuesta", "<h3>PROYECTO ACTIVO:<br>$codigo</h3>");
    }

    public function select() {
        $this->layout = "ajax";
        $this->set('cities', $this->Proyect->City->find('list', array(
                    'order' => array('name' => 'ASC'),
                    'conditions' => array('City.departament_id' => $this->data['Proyect']['departament_id'])
                        )
        ));
    }

    public function search() {
        if (!empty($this->data)) {
            App::Import('model', 'Beneficiary');
            $Beneficiary = new Beneficiary();
            $Beneficiary->recursive = -1;
            $ide = $this->data['Proyect']['busqueda'];
            if ($ide != "") {

                $resultados = $Beneficiary->find('all', array('conditions' => array(
                        "or" => array(
                            "Beneficiary.numero_identificacion LIKE" => "%$ide%",
                            "Beneficiary.nombres LIKE" => "%$ide%",
                            " (Beneficiary.nombres+' '+Beneficiary.primer_apellido) LIKE" => "%$ide%",
                            " (Beneficiary.nombres+' '+Beneficiary.primer_apellido+' '+Beneficiary.segundo_apellido) LIKE" => "%$ide%",
                            "(Beneficiary.nombres+' '+Beneficiary.primer_apellido) LIKE" => "%$ide%",
                            "Beneficiary.primer_apellido LIKE" => "%$ide%",
                            "Beneficiary.segundo_apellido LIKE" => "%$ide%",
                            "Beneficiary.nombres LIKE" => "%$ide%",
                        )
                    ),
                    'fields' => array('Proyect.codigo', 'Property.nombre', 'Beneficiary.tipo_identificacion', 'Beneficiary.numero_identificacion', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido'),
                    'joins' => array(
                        array('table' => 'properties', 'alias' => 'Property', 'type' => 'left', 'conditions' => 'Property.id=Beneficiary.property_id'),
                        array('table' => 'proyects', 'alias' => 'Proyect', 'type' => 'left', 'conditions' => 'Proyect.id=Property.proyect_id')
                    ),
                        )
                );

                $predios = $this->Proyect->Property->find('all', array('conditions' => array(
                        "or" => array(
                            "Property.nombre LIKE" => "%$ide%",
                            "Property.matricula LIKE" => "%$ide%",
                            "Property.cedula_catastral LIKE" => "%$ide%",
                        )
                    ),
                    'recursive' => -1,
                    'fields' => array('Proyect.codigo', 'Property.nombre', 'Property.matricula', 'Property.cedula_catastral', 'Property.vereda', 'City.name', 'Departament.name'),
                    'joins' => array(
                        array('table' => 'proyects', 'alias' => 'Proyect', 'type' => 'left', 'conditions' => 'Proyect.id=Property.proyect_id'),
                        array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => 'Property.city_id=City.id'),
                        array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => 'City.departament_id=Departament.id'),
                    ),
                ));

                //Busqueda de familiares

                $familiares = $Beneficiary->Family->find('all', array('conditions' => array(
                        "or" => array(
                            "Family.numero_identificacion LIKE" => "%$ide%",
                            "Family.nombres LIKE" => "%$ide%",
                            "(Family.nombres+' '+Family.primer_apellido) LIKE" => "%$ide%",
                            "(Family.nombres+' '+Family.primer_apellido+' '+Family.segundo_apellido) LIKE" => "%$ide%",
                            "(Family.nombres+' '+Family.segundo_apellido) LIKE" => "%$ide%",
                        )
                    ),
                    'recursive' => -1,
                    'fields' => array('Beneficiary.numero_identificacion', 'Proyect.codigo', 'Property.nombre', 'Family.tipo_identificacion', 'Family.numero_identificacion', 'Family.nombres', 'Family.primer_apellido', 'Family.segundo_apellido'),
                    'joins' => array(
                        array('table' => 'beneficiaries', 'alias' => 'Beneficiary', 'type' => 'left', 'conditions' => 'Beneficiary.id=Family.beneficiary_id'),
                        array('table' => 'properties', 'alias' => 'Property', 'type' => 'left', 'conditions' => 'Property.id=Beneficiary.property_id'),
                        array('table' => 'proyects', 'alias' => 'Proyect', 'type' => 'left', 'conditions' => 'Proyect.id=Property.proyect_id')
                    ),
                ));


                $this->set('resultados', $resultados);
                $this->set('predios', $predios);
                $this->set('familiares', $familiares);
                //$this->set('propietarios', $propietarios);
            }
        }
    }

    public function report($option) {
        $this->layout = "ajax";
        ini_set('max_execution_time', 600);
        $results = $this->Proyect->query('CALL proyectsReport()');
        $this->set('proyects', $results);
    }

}

?>