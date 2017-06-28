<?php

App::uses('CakeEmail', 'Network/Email');

Class EvaluationsController extends AppController {

    public $name = 'Evaluations';

    public function add($proyect_id) {
        $this->layout = "ajax";

        $this->set('proyect_id', $proyect_id);
        $this->set('user_id', $this->Auth->user('id'));

        date_default_timezone_set("America/Bogota");
        $this->set('fecha', date("Y-m-d"));

        if (!empty($this->data)) {

            if ($this->Evaluation->saveAll($this->data)) {

                $last_id = $this->Evaluation->getLastInsertId();
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Evaluaciones";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                if (!empty($this->data['Evaluation']['f10']['tmp_name'])) {
                    $ext = explode(".", $this->data['Evaluation']['f10']['name']);
                    $conteo = count($ext);
                    $nombrearchivo = "f10-" . $last_id . "." . $ext[$conteo - 1];
                    if (in_array($ext[$conteo - 1], array('docx', 'pdf'))) {
                        if (!move_uploaded_file($this->data['Evaluation']['f10']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                            $this->Session->setFlash('Error adjuntando f10', 'flash_error');
                        }
                    } else {
                        $this->Session->setFlash('El archivo del plan de negocio no se encuentra en un formato válido. Debe ser docx o pdf.', 'flash_error');
                    }
                }

                if (!empty($this->data['Evaluation']['f11']['tmp_name'])) {
                    $nombrearchivo = "f11-" . $last_id . ".xlsx";
                    if (!move_uploaded_file($this->data['Evaluation']['f11']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando estudios', 'flash_error');
                    }
                }

                if (!empty($this->data['Evaluation']['estudios']['tmp_name'])) {
                    $nombrearchivo = "estudios-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Evaluation']['estudios']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando estudios', 'flash_error');
                    }
                }

                if (!empty($this->data['Evaluation']['disenos']['tmp_name'])) {
                    $nombrearchivo = "disenos-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Evaluation']['disenos']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando diseños', 'flash_error');
                    }
                }

                if (!empty($this->data['Evaluation']['licencias']['tmp_name'])) {
                    $nombrearchivo = "licencias-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Evaluation']['licencias']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando licencias', 'flash_error');
                    }
                }

                if (!empty($this->data['Evaluation']['permisos_ambientales']['tmp_name'])) {
                    $nombrearchivo = "permisos_ambientales-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Evaluation']['permisos_ambientales']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando permisos ambientales', 'flash_error');
                    }
                }

                if (!empty($this->data['Evaluation']['f30']['tmp_name'])) {
                    $nombrearchivo = "f30-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Evaluation']['f30']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando f30', 'flash_error');
                    }
                }

                if (!empty($this->data['Evaluation']['f27']['tmp_name'])) {
                    $nombrearchivo = "f27-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Evaluation']['f27']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando f27', 'flash_error');
                    }
                }

                if (!empty($this->data['Evaluation']['f22']['tmp_name'])) {
                    $nombrearchivo = "f22-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Evaluation']['f22']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando f22', 'flash_error');
                    }
                }

                $this->send($this->data['Evaluation']['proyect_id'], 'add', $last_id, "");

                $this->Session->setFlash('Evaluación guardada correctamente', 'flash');
                $this->redirect(array('controller' => 'Evaluations', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error guardando los datos', 'flash');
                $this->redirect(array('controller' => 'pages', 'action' => 'display'));
            }
        }
    }

    public function edit($id) {
        $this->layout = "ajax";
        App::Import('model', 'Resolution');

        $this->Evaluation->recursive = -1;
        if (empty($this->data)) {
            $r = new Resolution();
            $r->recursive = -1;
            $proyect_id = $this->Session->read('proyect_id');
            $codigo = $this->Session->read('codigo');

            if ($r->find('count', array('conditions' => array('Resolution.proyect_id' => $proyect_id))) < 1 or $this->Auth->user('group_id') == 1) {
                $this->set('habilitado', true);
            } else {
                $resolution_id = $r->field('id', array('Resolution.proyect_id' => $proyect_id, 'Resolution.tipo' => 'ADJUDICACIÓN'));
                $rutaDocumento = APP . "webroot" . "/" . "files/resoluciones/SoporteResolucion-" . $codigo . "-" . $resolution_id . ".pdf";
                if (file_exists("../webroot/files/resoluciones/SoporteResolucion-" . $codigo . "-" . $resolution_id . ".pdf")) {
                    $this->set('habilitado', false);
                } else {
                    $this->set('habilitado', true);
                }
            }
            date_default_timezone_set("America/Bogota");
            $this->set('fecha', date("Y-m-d"));
            $this->set('user_id', $this->Auth->user('id'));
            $this->data = $this->Evaluation->find('first', array('conditions' => array('Evaluation.id' => $id), 'fields' => array('Evaluation.*')));
        } else {
            if ($this->Evaluation->save($this->data)) {

                $last_id = $this->data['Evaluation']['id'];
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Evaluaciones";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                if (!empty($this->data['Evaluation']['f10']['tmp_name'])) {
                    $ext = explode(".", $this->data['Evaluation']['f10']['name']);
                    $conteo = count($ext);
                    $nombrearchivo = "f10-" . $last_id . "." . $ext[$conteo - 1];
                    if (in_array($ext[$conteo - 1], array('docx', 'pdf'))) {
                        if (!move_uploaded_file($this->data['Evaluation']['f10']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                            $this->Session->setFlash('Error adjuntando f10', 'flash_error');
                        }
                    } else {
                        $this->Session->setFlash('El archivo del plan de negocio no se encuentra en un formato válido. Debes er docx o pdf.', 'flash_error');
                    }
                }

                if (!empty($this->data['Evaluation']['f11']['tmp_name'])) {
                    $nombrearchivo = "f11-" . $last_id . ".xlsx";
                    if (!move_uploaded_file($this->data['Evaluation']['f11']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando estudios', 'flash_error');
                    }
                }

                if (!empty($this->data['Evaluation']['estudios']['tmp_name'])) {
                    $nombrearchivo = "estudios-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Evaluation']['estudios']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando estudios', 'flash_error');
                    }
                }

                if (!empty($this->data['Evaluation']['disenos']['tmp_name'])) {
                    $nombrearchivo = "disenos-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Evaluation']['disenos']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando diseños', 'flash_error');
                    }
                }

                if (!empty($this->data['Evaluation']['licencias']['tmp_name'])) {
                    $nombrearchivo = "licencias-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Evaluation']['licencias']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando licencias', 'flash_error');
                    }
                }

                if (!empty($this->data['Evaluation']['permisos_ambientales']['tmp_name'])) {
                    $nombrearchivo = "permisos_ambientales-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Evaluation']['permisos_ambientales']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando permisos ambientales', 'flash_error');
                    }
                }

                if (!empty($this->data['Evaluation']['d7']['tmp_name'])) {
                    $nombrearchivo = "d7-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Evaluation']['d7']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando d7', 'flash_error');
                    }
                }

                if (!empty($this->data['Evaluation']['f30']['tmp_name'])) {
                    $nombrearchivo = "f30-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Evaluation']['f30']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando f30', 'flash_error');
                    }
                }

                if (!empty($this->data['Evaluation']['f27']['tmp_name'])) {
                    $nombrearchivo = "f27-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Evaluation']['f27']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando f27', 'flash_error');
                    }
                }

                if (!empty($this->data['Evaluation']['f22']['tmp_name'])) {
                    $nombrearchivo = "f22-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Evaluation']['f22']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando f22', 'flash_error');
                    }
                }

                $this->send($this->data['Evaluation']['proyect_id'], 'edit', $last_id, "");

                $this->Session->setFlash('Registro editado correctamente', 'flash');
                $this->redirect(array('controller' => 'Evaluations', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error editando datos', 'flash_error');
            }
        }
    }

    public function concepto_final($id) {
        $this->layout = "ajax";
        App::Import('model', 'Resolution');

        $this->Evaluation->recursive = -1;

        if (empty($this->data)) {
            $r = new Resolution();
            $r->recursive = -1;
            $proyect_id = $this->Session->read('proyect_id');
            $codigo = $this->Session->read('codigo');
            if ($r->find('count', array('conditions' => array('Resolution.proyect_id' => $proyect_id))) < 1) {
                $this->set('habilitado', true);
            } else {
                $resolution_id = $r->field('id', array('Resolution.proyect_id' => $proyect_id, 'Resolution.tipo' => 'ADJUDICACIÓN'));
                $rutaDocumento = APP . "webroot" . "/" . "files/resoluciones/SoporteResolucion-" . $codigo . "-" . $resolution_id . ".pdf";
                if (file_exists("../webroot/files/resoluciones/SoporteResolucion-" . $codigo . "-" . $resolution_id . ".pdf")) {
                    $this->set('habilitado', false);
                } else {
                    $this->set('habilitado', true);
                }
            }
            date_default_timezone_set("America/Bogota");
            $this->set('fecha', date("Y-m-d"));
            $this->set('user_id', $this->Auth->user('id'));
            $this->data = $this->Evaluation->find('first', array('conditions' => array('Evaluation.id' => $id), 'fields' => array('Evaluation.*')));
        } else {
            if ($this->Evaluation->save($this->data)) {

                $last_id = $this->data['Evaluation']['id'];
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Evaluaciones";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                $f13Cargado = false;
                $f29Cargado = false;

                if (!empty($this->data['Evaluation']['f13']['tmp_name'])) {
                    $nombrearchivo = "f13-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Evaluation']['f13']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando f13', 'flash_error');
                    } else {
                        $f13Cargado = true;
                    }
                }

                if (!empty($this->data['Evaluation']['f29']['tmp_name'])) {
                    $nombrearchivo = "f29-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Evaluation']['f29']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando f29', 'flash_error');
                    } else {
                        $f29Cargado = false;
                    }
                }

                if ($f13Cargado and $f29Cargado) {
                    $observaciones = "Se modificaron los archivos F13 y F29";
                } else if (!$f13Cargado) {
                    $observaciones = "Se modificó el archivo F29";
                } else {
                    $observaciones = "Se modificó el archivo F13";
                }

                $this->send($this->data['Evaluation']['proyect_id'], 'concepto_final', $id, $observaciones);

                $this->Session->setFlash('Concepto final editado correctamente', 'flash');
                $this->redirect(array('controller' => 'Evaluations', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error editando datos', 'flash_error');
            }
        }
    }

    public function index() {
        App::Import('model', 'UserProyect');
        App::Import('model', 'Resolution');

        if (!$this->RequestHandler->isAjax()) {
            $this->layout = "default";
        } else {
            $this->layout = "ajax";
        }

        $proyect_id = $this->Session->read('proyect_id');
        $codigo = $this->Session->read('codigo');

        $this->set('aleatorio', rand(1111, 9999999));

        if ($proyect_id != "") {
            $r = new Resolution();
            $r->recursive = -1;
            $proyect_id = $this->Session->read('proyect_id');
            if ($r->find('count', array('conditions' => array('Resolution.proyect_id' => $proyect_id))) < 1) {
                $this->set('habilitado', true);
            } else {
                $resolution_id = $r->field('id', array('Resolution.proyect_id' => $proyect_id, 'Resolution.tipo' => 'ADJUDICACIÓN'));
                $rutaDocumento = APP . "webroot" . "/" . "files/resoluciones/SoporteResolucion-" . $codigo . "-" . $resolution_id . ".pdf";
                if (file_exists("../webroot/files/resoluciones/SoporteResolucion-" . $codigo . "-" . $resolution_id . ".pdf")) {
                    $this->set('habilitado', false);
                } else {
                    $this->set('habilitado', true);
                }
            }
            if ($this->Auth->user('group_id') != 1 and $this->Auth->user('group_id') != 18 and $this->Auth->user('group_id') != 16) {
                $up = new UserProyect();
                $up->recursive = -1;
                if ($up->find('count', array('conditions' => array('UserProyect.proyect_id' => $proyect_id, 'UserProyect.user_id' => $this->Auth->user('id')))) > 0) {
                    $this->set('proyect_id', $proyect_id);
                    $this->paginate = array('Evaluation' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Evaluation.*', 'User.*'), 'order' => array('Evaluation.id' => 'DESC')));
                    $this->set('Evaluations', $this->paginate(array('Evaluation.proyect_id' => $proyect_id)));
                } else {
                    $this->Session->setFlash('No tiene asignado el proyecto.', 'flash');
                    $this->redirect(array('controller' => 'pages', 'action' => 'denied'));
                }
            } else {
                $this->set('proyect_id', $proyect_id);
                $this->set('Evaluations', $this->Evaluation->find('all', array('conditions' => array('Evaluation.proyect_id' => $proyect_id), 'recursive' => 0, 'fields' => array('Evaluation.*', 'User.*'), 'order' => array('Evaluation.id' => 'DESC'))));
            }
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash');
            $this->redirect(array('controller' => 'pages', 'action' => 'display'));
        }
    }

    public function delete($id, $proyect_id) {
        if ($this->Evaluation->delete($id)) {
            $this->send($proyect_id, 'delete', $id, "");
            $this->Session->setFlash('Evaluación eliminada correctamente', 'flash');
            $this->redirect(array('controller' => 'pages', 'action' => 'display'));
        } else {
            $this->Session->setFlash('Error borrando datos', 'flash_error');
            $this->redirect(array('controller' => 'pages', 'action' => 'display'));
        }
    }

    private function send($proyect_id, $tipo, $evaluation_id, $observaciones) {
        App::Import('model', 'UserProyect');
        App::Import('model', 'BranchUser');
        App::Import('model', 'Proyect');
        App::Import('model', 'User');

        $Email = new CakeEmail('gmail');
        $Email->from(array('pdret.soporte@gmail.com' => 'Aplicativo PDRET'));

        $up = new UserProyect();
        $correos_asignados = $up->find('all', ['fields' => ['User.email'], 'recursive' => 1, 'conditions' => ['UserProyect.proyect_id' => $proyect_id]]);

        $p = new Proyect();
        $proyect = $p->find('first', array('fields' => array('Proyect.branch_id', 'Proyect.codigo'), 'recursive' => -1, 'conditions' => array('Proyect.id' => $proyect_id)));

        if ($tipo == 'concepto_final') {
            $bu = new BranchUser();
            $correos_supervisores = $bu->find('all', ['fields' => ['User.email'], 'recursive' => 1, 'conditions' => ['BranchUser.branch_id' => $proyect['Proyect']['branch_id']]]);

            foreach ($correos_supervisores as $correo_supervisor) {
                $Email->addTo($correo_supervisor['User']['email']);
            }
        }

        $u = new User();
        $usuario_actual = $u->find('first', array('fields' => array('User.nombre', 'User.primer_apellido', 'User.segundo_apellido', 'User.email'), 'recursive' => -1, 'conditions' => array('User.id' => $this->Auth->user('id'))));

        foreach ($correos_asignados as $correo_asignado) {
            $Email->addTo($correo_asignado['User']['email']);
        }

        $Email->addTo($usuario_actual['User']['email']);

        $evaluacion = $this->Evaluation->find('first', array('fields' => array('Evaluation.*'), 'recursive' => -1, 'conditions' => array('Evaluation.id' => $evaluation_id)));

        $body = "";
        $subject = "";
        switch ($tipo) {
            case 'add':
                $subject = "Adición de evaluación proyecto " . $proyect['Proyect']['codigo'];
                $body = "<p>Se ha agregado una evaluación al proyecto " . $proyect['Proyect']['codigo'] . " por parte del usuario"
                        . "<br>" . $usuario_actual['User']['nombre'] . " " . $usuario_actual['User']['primer_apellido'] . " " . $usuario_actual['User']['segundo_apellido']
                        . "<br>Observación:" . $evaluacion['Evaluation']['observaciones']
                        . "<br>" . $observaciones
                        . "</p>";
                break;
            case 'delete':
                $subject = "Eliminación de evaluación proyecto " . $proyect['Proyect']['codigo'];
                $body = "<p>Se ha eliminado la evaluación del proyecto " . $proyect['Proyect']['codigo'] . " por parte del usuario"
                        . "<br>" . $usuario_actual['User']['nombre'] . " " . $usuario_actual['User']['primer_apellido'] . " " . $usuario_actual['User']['segundo_apellido']
                        . "<br>Observación: " . $evaluacion['Evaluation']['observaciones']
                        . "</p>";
                break;
            case 'edit':
                $subject = "Modificación de evaluación proyecto " . $proyect['Proyect']['codigo'];
                $body = "<p>Se ha modificado la evaluación del proyecto " . $proyect['Proyect']['codigo'] . " por parte del usuario"
                        . "<br>" . $usuario_actual['User']['nombre'] . " " . $usuario_actual['User']['primer_apellido'] . " " . $usuario_actual['User']['segundo_apellido']
                        . "<br>" . $observaciones
                        . "</p>";
                break;
            case 'concepto_final':
                $subject = "Calificación de evaluación proyecto " . $proyect['Proyect']['codigo'];
                $body = "<p>Se ha modificado la evaluación del proyecto " . $proyect['Proyect']['codigo'] . " por parte del usuario"
                        . "<br>" . $usuario_actual['User']['nombre'] . " " . $usuario_actual['User']['primer_apellido'] . " " . $usuario_actual['User']['segundo_apellido']
                        . "<br>Calificación: " . $evaluacion['Evaluation']['calificacion_concepto_final']
                        . "<br>Observación calificación: " . $evaluacion['Evaluation']['observacion_concepto_final']
                        . "<br>" . $observaciones
                        . "</p>";
                break;
            default:
                break;
        }

        $Email->subject($subject);
        $Email->emailFormat('html');
        $Email->send($body);
    }

}

?>