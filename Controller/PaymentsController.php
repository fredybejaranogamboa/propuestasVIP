<?php

App::uses('CakeEmail', 'Network/Email');

Class PaymentsController extends AppController {

    public $name = 'Payments';

    public function add($proyect_id) {
        $this->layout = "ajax";

        $this->request->data['Payment']['proyect_id'] = $proyect_id;

        if ($this->Payment->saveAll($this->data)) {
            $this->redirect(array('action' => 'index'));
        } else {
            $this->redirect(array('controller' => 'pages', 'action' => 'error', 'Error agregando los datos.'));
        }
    }

    public function edit($id) {
        $this->layout = "ajax";
        $this->Payment->recursive = -1;
        if (empty($this->data)) {
            App::Import('model', 'Evaluation');
            $e = new Evaluation();
            $e->recursive = 1;

            $this->data = $this->Payment->find('first', array('conditions' => array('Payment.id' => $id), 'fields' => array('Payment.*')));

            $this->set('cofinanciacion', $e->find('first', array('conditions' => array('Evaluation.proyect_id' => $this->data['Payment']['proyect_id']), 'fields' => array('Evaluation.cofinanciacion', 'Evaluation.id'), 'order' => array('Evaluation.id' => 'DESC'))));
            //$this->set('asociations', $this->Payment->Proyect->Asociation->find('all', array('conditions' => array('Asociation.proyect_id' => $this->data['Payment']['proyect_id']), 'fields' => array('Asociation.nombre', 'Asociation.nit'), 'order' => array('Asociation.nombre' => 'ASC'))));
            $this->set('beneficiaries', $this->Payment->Proyect->Beneficiary->find('all', array('conditions' => array('Beneficiary.proyect_id' => $this->data['Payment']['proyect_id']), 'fields' => array('Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido'), 'order' => array('Beneficiary.primer_apellido' => 'ASC'))));
            $this->set('user_id', $this->Auth->user('id'));
        } else {
            if ($this->Payment->save($this->data)) {

                $last_id = $this->data['Payment']['id'];
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Pagos";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                if (!empty($this->data['Payment']['poliza']['tmp_name'])) {
                    $nombrearchivo = "poliza-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Payment']['poliza']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando poliza', 'flash_error');
                    }
                }

                if (!empty($this->data['Payment']['acta_aprobacion_poliza']['tmp_name'])) {
                    $nombrearchivo = "acta_aprobacion_poliza-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Payment']['acta_aprobacion_poliza']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando acta_aprobacion_poliza', 'flash_error');
                    }
                }

                if (!empty($this->data['Payment']['certificacion_bancaria']['tmp_name'])) {
                    $nombrearchivo = "certificacion_bancaria-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Payment']['certificacion_bancaria']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando certificacion_bancaria', 'flash_error');
                    }
                }

                if (!empty($this->data['Payment']['notificacion']['tmp_name'])) {
                    $nombrearchivo = "notificacion-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Payment']['notificacion']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando notificacion', 'flash_error');
                    }
                }

                if (!empty($this->data['Payment']['poder']['tmp_name'])) {
                    $nombrearchivo = "poder-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Payment']['poder']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando poder', 'flash_error');
                    }
                }

                if (!empty($this->data['Payment']['f12']['tmp_name'])) {
                    $nombrearchivo = "f12-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Payment']['f12']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando f12', 'flash_error');
                    }
                }
                if (!empty($this->data['Payment']['cuenta_gobernacion']['tmp_name'])) {
                    $nombrearchivo = "cuenta_gobernacion-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Payment']['cuenta_gobernacion']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando cuenta_gobernacion', 'flash_error');
                    }
                }
                if (!empty($this->data['Payment']['cdp_respaldo']['tmp_name'])) {
                    $nombrearchivo = "cdp_respaldo-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Payment']['cdp_respaldo']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando cdp_respaldo', 'flash_error');
                    }
                }
                if (!empty($this->data['Payment']['poder_asociaciones']['tmp_name'])) {
                    $nombrearchivo = "poder_asociaciones-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Payment']['poder_asociaciones']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando poder_asociaciones', 'flash_error');
                    }
                }
                $this->send($this->data['Payment']['proyect_id'], 'edit', $id);
                $this->Session->setFlash('Registro editado correctamente', 'flash');
                $this->redirect(array('controller' => 'Payments', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error editando datos', 'flash_error');
            }
        }
    }

    public function view($id, $option) {
        $this->layout = "ajax";
        $this->Payment->recursive = -1;
        if (empty($this->data)) {
            $this->set('aleatorio', rand(1111, 9999999));
            $this->data = $this->Payment->find('first', array('conditions' => array('Payment.id' => $id), 'fields' => array('Payment.*')));
            $payment = $this->Payment->find('first', array('recursive' => 1, 'fields' => array('Payment.*', 'User.nombre', 'User.primer_apellido', 'Evaluation.cofinanciacion', 'Evaluation.id'), 'order' => array('Payment.id' => 'DESC'),
                'joins' => array(array(
                        'table' => 'evaluations',
                        'alias' => 'Evaluation',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Evaluation.proyect_id = Payment.proyect_id',
                        )
                    )),
                'conditions' => array('Payment.id' => $id)
            ));

            $this->set('Payment', $payment);

            $this->set('asociation', $this->Payment->Proyect->Asociation->find('first', array('conditions' => array('Asociation.id' => $payment['Payment']['asociation_id']), 'fields' => array('Asociation.nombre', 'Asociation.nit'))));
            $this->set('beneficiary', $this->Payment->Proyect->Beneficiary->find('first', array('conditions' => array('Beneficiary.id' => $payment['Payment']['beneficiary_id']), 'fields' => array('Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido'))));
            $this->set('beneficiaries', $this->Payment->Proyect->Beneficiary->find('all', array('conditions' => array('Beneficiary.proyect_id' => $payment['Payment']['proyect_id']), 'order' => array('Beneficiary.primer_apellido' => 'ASC'), 'fields' => array('Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.id', 'Beneficiary.numero_identificacion'))));
            $this->set('properties', $this->Payment->Proyect->Property->find('all', array('conditions' => array('Property.proyect_id' => $payment['Payment']['proyect_id']), 'order' => array('Property.nombre' => 'ASC'), 'fields' => array('Property.*'))));
            $this->set('option', $option);
        } else {
            if ($this->Payment->save($this->data)) {

                $this->send($this->data['Payment']['proyect_id'], 'view', $this->data['Payment']['id']);

                $this->Session->setFlash('Calificaciones registradas correctamente', 'flash');
                $this->redirect(array('controller' => 'Payments', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error editando datos', 'flash_error');
            }
        }
    }

    public function dates($id) {
        $this->layout = "ajax";
        $this->Payment->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->Payment->find('first', array('conditions' => array('Payment.id' => $id), 'fields' => array('Payment.*')));
            $payment = $this->Payment->find('first', array('recursive' => 1, 'fields' => array('Payment.*', 'User.nombre', 'User.primer_apellido', 'Evaluation.cofinanciacion', 'Evaluation.id'), 'order' => array('Payment.id' => 'DESC'),
                'joins' => array(array(
                        'table' => 'evaluations',
                        'alias' => 'Evaluation',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Evaluation.proyect_id = Payment.proyect_id',
                        )
                    )),
                'conditions' => array('Payment.id' => $id)
            ));

            $this->set('Payment', $payment);
            $this->set('asociation', $this->Payment->Proyect->Asociation->find('first', array('conditions' => array('Asociation.id' => $payment['Payment']['asociation_id']), 'fields' => array('Asociation.nombre', 'Asociation.nit'))));
            $this->set('beneficiary', $this->Payment->Proyect->Beneficiary->find('first', array('conditions' => array('Beneficiary.id' => $payment['Payment']['beneficiary_id']), 'fields' => array('Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido'))));
        } else {
            if ($this->Payment->save($this->data)) {
                $this->Session->setFlash('Fechas registradas correctamente', 'flash');
                $this->redirect(array('controller' => 'Payments', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error editando datos', 'flash_error');
            }
        }
    }

    public function index() {
        App::Import('model', 'UserProyect');
        if (!$this->RequestHandler->isAjax()) {
            $this->layout = "default";
        } else {
            $this->layout = "ajax";
        }
        $proyect_id = $this->Session->read('proyect_id');
        if ($proyect_id != "") {

            $up = new UserProyect();
            $up->recursive = -1;
            if (in_array($this->Auth->user('group_id'), array(1, 18)) or ( $this->Auth->user('group_id') == 17 and $up->find('count', array('conditions' => array('UserProyect.proyect_id' => $proyect_id, 'UserProyect.user_id' => $this->Auth->user('id')))) > 0)) {
                $this->set('calificar', true);
            } else {
                $this->set('calificar', false);
            }

            $cal_evaluacion = $this->Payment->Proyect->Evaluation->find('first', array('conditions' => array('Evaluation.proyect_id' => $proyect_id), 'fields' => array('Evaluation.calificacion_concepto_final'), 'order' => array('Evaluation.id' => 'DESC')));
            if ($cal_evaluacion['Evaluation']['calificacion_concepto_final'] == "Cumple") {
                $this->set('permitir', true);
            } else {
                $this->set('permitir', false);
            }

            $this->set('proyect_id', $proyect_id);

            $this->set('Payments', $this->Payment->find('all', array('recursive' => 1, 'fields' => array('Payment.*', 'User.nombre', 'User.primer_apellido', 'Evaluation.cofinanciacion'), 'order' => array('Payment.id' => 'DESC'),
                        'joins' => array(array(
                                'table' => 'evaluations',
                                'alias' => 'Evaluation',
                                'type' => 'LEFT',
                                'conditions' => array(
                                    'Evaluation.proyect_id = Payment.proyect_id',
                                )
                            )),
                        'conditions' => array('Payment.proyect_id' => $proyect_id)
            )));
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash');
            $this->redirect(array('controller' => 'pages', 'action' => 'display'));
        }
    }

    public function delete($id, $proyect_id) {
        if ($this->Payment->delete($id)) {
            $this->send($proyect_id, 'delete', $id);
            $this->Session->setFlash('Pago eliminado correctamente', 'flash');
            $this->redirect(array('controller' => 'Payments', 'action' => 'index'));
        } else {
            $this->Session->setFlash('Error borrando datos', 'flash_error');
            $this->redirect(array('controller' => 'pages', 'action' => 'display'));
        }
    }

    private function send($proyect_id, $tipo, $payment_id) {
        App::Import('model', 'UserProyect');
        App::Import('model', 'BranchUser');
        App::Import('model', 'Proyect');
        App::Import('model', 'User');

        $pago = $this->Payment->find('first', array('fields' => array('Payment.*'), 'recursive' => -1, 'conditions' => array('Payment.id' => $payment_id)));

        $up = new UserProyect();
        $correos_asignados = $up->find('all', ['fields' => ['User.email'], 'recursive' => 1, 'conditions' => ['UserProyect.proyect_id' => $proyect_id]]);

        $p = new Proyect();
        $proyect = $p->find('first', array('fields' => array('Proyect.branch_id', 'Proyect.codigo'), 'recursive' => -1, 'conditions' => array('Proyect.id' => $proyect_id)));

        $bu = new BranchUser();
        $correos_supervisores = $bu->find('all', ['fields' => ['User.email'], 'recursive' => 1, 'conditions' => ['BranchUser.branch_id' => $proyect['Proyect']['branch_id']]]);

        $u = new User();
        $usuario_actual = $u->find('first', array('fields' => array('User.nombre', 'User.primer_apellido', 'User.segundo_apellido', 'User.email'), 'recursive' => -1, 'conditions' => array('User.id' => $this->Auth->user('id'))));
        $usuario_cargador = $u->find('first', array('fields' => array('User.nombre', 'User.primer_apellido', 'User.segundo_apellido', 'User.email'), 'recursive' => -1, 'conditions' => array('User.id' => $pago['Payment']['user_id'])));

        $Email = new CakeEmail('gmail');
        $Email->from(array('pdret.soporte@gmail.com' => 'Aplicativo PDRET'));

        foreach ($correos_asignados as $correo_asignado) {
            $Email->addTo($correo_asignado['User']['email']);
        }
        foreach ($correos_supervisores as $correo_supervisor) {
            $Email->addTo($correo_supervisor['User']['email']);
        }
        $Email->addTo($usuario_actual['User']['email']);
        $Email->addTo($usuario_cargador['User']['email']);


        $body = "";
        $subject = "";
        switch ($tipo) {
            case 'add':
                $subject = "Información desembolso proyecto " . $proyect['Proyect']['codigo'];
                $body = "<p>Se ha agregado información para el desembolso del proyecto " . $proyect['Proyect']['codigo'] . " por parte del usuario"
                        . "<br>" . $usuario_actual['User']['nombre'] . " " . $usuario_actual['User']['primer_apellido'] . " " . $usuario_actual['User']['segundo_apellido']
                        . "<br>Cuenta :" . $pago['Payment']['numero_cuenta'] . " Banco " . $pago['Payment']['nombre_banco']
                        . ".</p>";
                break;
            case 'delete':
                $subject = "Eliminación desembolso del proyecto " . $proyect['Proyect']['codigo'];
                $body = "<p>Se ha modificado información para el desembolso del proyecto " . $proyect['Proyect']['codigo'] . " por parte del usuario"
                        . "<br>Cuenta :" . $pago['Payment']['numero_cuenta'] . " Banco " . $pago['Payment']['nombre_banco']
                        . ".</p>";
                break;
            case 'edit':
                $subject = "Modificación desembolso proyecto " . $proyect['Proyect']['codigo'];
                $body = "<p>Se ha modificado la información para el desembolso del proyecto " . $proyect['Proyect']['codigo'] . " por parte del usuario"
                        . "<br>Cuenta :" . $pago['Payment']['numero_cuenta'] . " Banco " . $pago['Payment']['nombre_banco']
                        . ".</p>";
                break;
            case 'view':
                $subject = "Calificación desembolso " . $proyect['Proyect']['codigo'];
                $body = "<p>Se han calificado los documentos para el desembolso del proyecto " . $proyect['Proyect']['codigo'] . " por parte del usuario"
                        . "<br><br><b>" . $usuario_actual['User']['nombre'] . " " . $usuario_actual['User']['primer_apellido'] . " " . $usuario_actual['User']['segundo_apellido'] . "</b>"
                        . "<br><br><b>Documentos cargados por" . $usuario_cargador['User']['nombre'] . " " . $usuario_cargador['User']['primer_apellido'] . " " . $usuario_cargador['User']['segundo_apellido'] . "</b>"
                        . "<br><br>Documentos de asignación de recursos:                        " . $pago['Payment']['asignacion_recursos']
                        . "<br><br>Cédulas beneficiarios:                                       " . $pago['Payment']['cedulas']
                        . "<br><br>Certificación de cumplimiento de requisitos por parte"
                        . "de beneficiarios, predios y/o persona jurídica:                  " . $pago['Payment']['certificacion_requisitos']
                        . "<br><br>Verificación jurídica de los predios vinculados al proyecto: " . $pago['Payment']['verificacion_juridica']
                        . "<br><br>Certificación de documentación de proyecto:                  " . $pago['Payment']['certificacion_proyecto']
                        . "<br><br>Certificación representacion legal:                          " . $pago['Payment']['certificacion_rep_legal']
                        . "<br><br>Autorizaciones especiales:                                   " . $pago['Payment']['autorizaciones_especiales']
                        . "<br><br>Contrapartidas:                                              " . $pago['Payment']['contrapartidas']
                        . "<br><br>Formato de evaluación del proyecto productivo:               " . $pago['Payment']['evaluacion_pp']
                        . "<br><br>Póliza y aprobación de la misma:                             " . $pago['Payment']['poliza_aprobacion']
                        . "<br><br>Certificación bancaria cuenta controlada:                    " . $pago['Payment']['certificacion_bancaria_cal']
                        . "<br><h2>Observación calificación:                                " . $pago['Payment']['observacion_calificacion'] . "</h2>"
                        . "<br><h2>Calificación final:                                      " . $pago['Payment']['calificacion_final'] . "</h2>"
                        . "<br><br>Si tiene alguna duda por favor comunicarse al correo   " . $usuario_actual['User']['email'] . "<br>"
                        . ".</p>";
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