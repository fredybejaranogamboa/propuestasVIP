<?php

Class ExpenseNotarialsController extends AppController {

    public $name = 'ExpenseNotarials';

    public function edit($id) {
        App::Import('Model', 'Proyect');
        $proyect_id = $this->ExpenseNotarial->field('ExpenseNotarial.proyect_id', array('ExpenseNotarial.id' => $id));
        $proyecto = new Proyect();
        $proyecto->recursive = -1;
        $codigoProyecto = $proyecto->field('Proyect.codigo', array('Proyect.id' => $proyect_id));

        $this->set('codigo', $codigoProyecto);
        $this->layout = "ajax";
        $this->ExpenseNotarial->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->ExpenseNotarial->find('first', array('conditions' => array('ExpenseNotarial.id' => $id), 'fields' => array('ExpenseNotarial.*')));
        } else {
            date_default_timezone_set("America/Bogota");
            $this->data['ExpenseNotarial']['fecha'] = date("Y-m-d-h-i-s");
            $this->data['ExpenseNotarial']['user_id'] = $this->Auth->user('id');
            //SE GUARDA EL ARCHIVO ACTA DE NOTIFICACION
            $aviso = "";
            if (stristr($this->data['ExpenseNotarial']['archivoActaNotificacion']['name'], ".pdf")) {

                // $codigo = $this->Session->read('cod');
                $rutaArchivo = APP . "webroot" . "/" . "files" . "/" . $codigoProyecto . "/Pagos";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }
                $nombreArchivo = "ActaNotificacion-$codigoProyecto-$id.pdf";
                $rutaArchivo.= "/" . $nombreArchivo;

                if (move_uploaded_file($this->data['ExpenseNotarial']['archivoActaNotificacion']['tmp_name'], $rutaArchivo)) {
                    $aviso.="<h1>Se ha cargado el  archivo autorizaciones acta notificación </h1> ";
                    $this->data['ExpenseNotarial']['acta_notificacion'] = 1;
                } else {
                    $this->data['ExpenseNotarial']['acta_notificacion'] = 0;
                    $aviso.="<h1>Error cargando archivo autorizaciones acta notificación </h1> ";
                };
            }
            //SE GUARDA EL ARCHIVO AUTORIZACIONES ESPECIALES
            if (stristr($this->data['ExpenseNotarial']['archivoAutorizacionesEspeciales']['name'], ".pdf")) {

                //$codigo = $this->Session->read('cod');
                $rutaArchivo = APP . "webroot" . "/" . "files" . "/" . $codigoProyecto . "/Pagos";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }
                $nombreArchivo = "AutorizacionEspecial-$codigoProyecto-$id.pdf";
                $rutaArchivo.= "/" . $nombreArchivo;

                if (move_uploaded_file($this->data['ExpenseNotarial']['archivoAutorizacionesEspeciales']['tmp_name'], $rutaArchivo)) {

                    $aviso.="<h1>Se ha cargado el  archivo autorizaciones especiales </h1> ";
                    $this->data['ExpenseNotarial']['autorizaciones_especiales'] = 1;
                } else {
                    $aviso.="<h1>Hubo un error cargando  archivo autorizaciones especiales</h1> ";
                    $this->data['ExpenseNotarial']['autorizaciones_especiales'] = 1;
                }
            }
            //SE GUARDA EL ARCHIVO AUTORIZACIONES ESPECIALES
            if (stristr($this->data['ExpenseNotarial']['archivoAnexos']['name'], ".pdf")) {

                //$codigo = $this->Session->read('cod');
                $rutaArchivo = APP . "webroot" . "/" . "files" . "/" . $codigoProyecto . "/Pagos";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }
                $nombreArchivo = "Anexos-$codigoProyecto-$id.pdf";
                $rutaArchivo.= "/" . $nombreArchivo;

                if (move_uploaded_file($this->data['ExpenseNotarial']['archivoAnexos']['tmp_name'], $rutaArchivo)) {
                    $this->data['ExpenseNotarial']['anexos'] = 1;
                    $aviso.="<h1>Se ha cargado el  archivo anexos - cédulas </h1> ";
                } else {
                    $aviso.="<h1>Hubo un error cargando  archivo anexos - cédulas </h1> ";
                    $this->data['ExpenseNotarial']['anexos'] = 0;
                }
            }

            if ($aviso != "") {
                App::import('Vendor', 'ClassPhpmailer', array('file' => 'phpmailer/class.phpmailer.php'));

                $UserProyect = new UserProyect();
                $UserProyect->recursive = 2;

                $Proyect2 = new Proyect();
                $Proyect2->recursive = -1;

                //Buscar información sobre el código del proyecto y el correo del director territorial
                $proyecto1 = $Proyect2->find('first', array('joins' => array(array('table' => 'branches', 'alias' => 'Branch', 'type' => 'left', 'conditions' => array('Branch.id=Proyect.branch_id'))), 'conditions' => array('Proyect.id' => $proyect_id), 'fields' => array('Branch.email')));

                //Buscar información sobre la persona que tiene asignado el proyecto.
                $revisor = $UserProyect->find('first', array('conditions' => array('UserProyect.proyect_id' => $proyect_id), 'fields' => array('User.email'), 'order' => array('UserProyect.id' => 'DESC')));

                $responsable = $this->ExpenseNotarial->User->find('first', array('recursive' => -1, 'conditions' => array('User.id' => $this->Auth->user('id')), 'fields' => array('User.email', 'User.nombre', 'User.primer_apellido')));
                $body = "<p>Encargado de adjuntar documentos: " . $responsable['User']['nombre'] . " " . $responsable['User']['primer_apellido'] . " " . $responsable['User']['email'] . "</p>";

                $mail = new PHPMailer();

                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->Host = "ssl://smtp.gmail.com"; // SMTP a utilizar. Por ej. smtp.elserver.com 
                $mail->Username = "sitrural@gmail.com"; // Correo completo a utilizar 
                $mail->Password = "laropavieja.net.co"; // Contraseña 
                $mail->Port = 465; // Puerto a utilizar 
                $mail->From = "sitrural@gmail.com"; // Desde donde enviamos (Para mostrar) 
                $mail->FromName = "Soporte aplicativo tierras";

                $mail->AddAddress($responsable['User']['email']);
                $mail->AddAddress($proyecto1['Branch']['email']);
                //$mail->AddAddress('lafonseca@incoder.gov.co');
                //$mail->AddAddress('blalvarez@incoder.gov.co');
                $mail->AddAddress('rgarzon@incoder.gov.co');
                $mail->AddAddress('drendon@incoder.gov.co');
                $mail->AddAddress('magaleano@incoder.gov.co');
                $mail->AddAddress($revisor['User']['email']);

                $mail->IsHTML(true);
                $mail->Subject = utf8_decode("CARGA DE DOCUMENTOS GASTO NOTARIAL PROYECTO " . $codigoProyecto . "."); // Este es el titulo del email. 

                $mail->Body = $body . " $aviso"; // Mensaje a enviar 

                $exito = $mail->Send(); // Envía el correo. 
                if ($exito) {


                    echo ('Archivos adjuntados');
                } else {
                    $this->Session->setFlash("Error :  " . $mail->ErrorInfo) . "XXX";
                    $this->redirect(array('controller' => 'ExpenseNotarials', 'action' => 'index'));
                }
            }

            if ($this->ExpenseNotarial->saveAll($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'ExpenseNotarials', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error editando datos', 'flash_custom');
                $this->redirect(array('controller' => 'ExpenseNotarials', 'action' => 'index'));
            }
        }
    }

    public function add($proyect_id) {
        App::Import('Model', 'FinalEvaluation');
        App::Import('Model', 'Proyect');
        App::Import('Model', 'Call');
        App::Import('Model', 'UserProyect');

        $this->layout = "ajax";
        $this->ExpenseNotarial->recursive = -1;
        $this->ExpenseNotarial->BankAccount->recursive = -1;
        //Se busca la ultima cuenta ingresada para de los beneficiarios
        if ($cuenta = $this->ExpenseNotarial->BankAccount->find('first', array('conditions' => array('BankAccount.proyect_id' => $proyect_id, 'BankAccount.tipo_titular' => 'Beneficiario'), 'order' => array('BankAccount.id DESC'), 'fields' => array('BankAccount.id')))) {
            if (empty($this->data)) {
                $this->set('proyect_id', $proyect_id);
            } else {
                $proyecto = new Proyect();
                $codigoProyecto = $proyecto->field('Proyect.codigo', array('Proyect.id' => $proyect_id));

                $evaluacionFinal = new FinalEvaluation();
                $familiasHabilitadas = $evaluacionFinal->field('familias_habilitadas', array('FinalEvaluation.proyect_id' => $proyect_id), 'FinalEvaluation.id DESC');
                $call_id = $proyecto->field('Proyect.call_id', array('Proyect.id' => $proyect_id));
                $convocatoria = new Call();
                $salarioMinimo = $convocatoria->field('Call.valor_smmv', array('Call.id' => $call_id));
                //guardo el id de la persona que hizo el ultimo cambio.
                $this->data['ExpenseNotarial']['valor'] = $salarioMinimo * $familiasHabilitadas;
                $this->data['ExpenseNotarial']['bank_account_id'] = $cuenta['BankAccount']['id'];
                $this->data['ExpenseNotarial']['user_id'] = $this->Auth->user('id');
                date_default_timezone_set("America/Bogota");
                $this->data['ExpenseNotarial']['fecha'] = date("Y-m-d-h-i-s");

                if (stristr($this->data['ExpenseNotarial']['archivoActaNotificacion']['name'], ".pdf")) {
                    $this->data['ExpenseNotarial']['acta_notificacion'] = 1;
                }

                if (stristr($this->data['ExpenseNotarial']['archivoAutorizacionesEspeciales']['name'], ".pdf")) {
                    $this->data['ExpenseNotarial']['autorizaciones_especiales'] = 1;
                }

                if ($this->ExpenseNotarial->saveAll($this->data)) {
                    $lastId = $this->ExpenseNotarial->getInsertID();

                    //SE GUARDA EL ARCHIVO ACTA DE NOTIFICACION
                    $aviso = "";
                    if (stristr($this->data['ExpenseNotarial']['archivoActaNotificacion']['name'], ".pdf")) {

                        //$codigo = $this->Session->read('cod');
                        $rutaArchivo = APP . "webroot" . "/" . "files" . "/" . $codigoProyecto . "/Pagos";
                        if (!is_dir($rutaArchivo)) {
                            if (!mkdir($rutaArchivo)) {
                                echo "error creando archivo";
                                //redirect
                            }
                        }
                        $nombreArchivo = "ActaNotificacion-$codigoProyecto-$lastId.pdf";
                        $rutaArchivo.= "/" . $nombreArchivo;

                        if (move_uploaded_file($this->data['ExpenseNotarial']['archivoActaNotificacion']['tmp_name'], $rutaArchivo)) {
                            $aviso.="<h1>Se ha cargado el  archivo autorizaciones acta notificación </h1> ";
                        } else {
                            $aviso.="<h1>Error cargando archivo autorizaciones acta notificación </h1> ";
                        }
                    }
                    //SE GUARDA EL ARCHIVO AUTORIZACIONES ESPECIALES
                    if (stristr($this->data['ExpenseNotarial']['archivoAutorizacionesEspeciales']['name'], ".pdf")) {

                        //$codigo = $this->Session->read('cod');
                        $rutaArchivo = APP . "webroot" . "/" . "files" . "/" . $codigoProyecto . "/Pagos";
                        if (!is_dir($rutaArchivo)) {
                            if (!mkdir($rutaArchivo)) {
                                echo "error creando archivo";
                                //redirect
                            }
                        }
                        $nombreArchivo = "AutorizacionEspecial-$codigoProyecto-$lastId.pdf";
                        $rutaArchivo.= "/" . $nombreArchivo;

                        if (move_uploaded_file($this->data['ExpenseNotarial']['archivoAutorizacionesEspeciales']['tmp_name'], $rutaArchivo)) {

                            $aviso.="<h1>Se ha cargado el  archivo autorizaciones especiales </h1> ";
                        } else {
                            $aviso.="<h1>Hubo un error cargando  archivo autorizaciones especiales</h1> ";
                        }
                    }

                    //se envia un correo informando los archivos que se cargaron.

                    if ($aviso != "") {
                        App::import('Vendor', 'ClassPhpmailer', array('file' => 'phpmailer/class.phpmailer.php'));
                        $UserProyect = new UserProyect();
                        $UserProyect->recursive = 2;

                        $Proyect2 = new Proyect();
                        $Proyect2->recursive = -1;

                        //Buscar información sobre el código del proyecto y el correo del director territorial
                        $proyecto1 = $Proyect2->find('first', array('joins' => array(array('table' => 'branches', 'alias' => 'Branch', 'type' => 'left', 'conditions' => array('Branch.id=Proyect.branch_id'))), 'conditions' => array('Proyect.id' => $proyect_id), 'fields' => array('Proyect.codigo', 'Branch.email')));

                        //Buscar información sobre la persona que tiene asignado el proyecto.
                        $revisor = $UserProyect->find('first', array('conditions' => array('UserProyect.proyect_id' => $proyect_id), 'fields' => array('User.email', 'User.nombre', 'User.primer_apellido', 'User.segundo_apellido'), 'order' => array('UserProyect.id' => 'DESC')));

                        $responsable = $this->ExpenseNotarial->User->find('first', array('recursive' => -1, 'conditions' => array('User.id' => $this->Auth->user('id')), 'fields' => array('User.email', 'User.nombre', 'User.primer_apellido')));

                        $body = "<p>Encargado de adjuntar documentos: " . $responsable['User']['nombre'] . " " . $responsable['User']['primer_apellido'] . " " . $responsable['User']['email'] . "</p>";

                        $mail = new PHPMailer();

                        $mail->IsSMTP();
                        $mail->SMTPAuth = true;
                        $mail->Host = "ssl://smtp.gmail.com"; // SMTP a utilizar. Por ej. smtp.elserver.com 
                        $mail->Username = "sitrural@gmail.com"; // Correo completo a utilizar 
                        $mail->Password = "laropavieja.net.co"; // Contraseña 
                        $mail->Port = 465; // Puerto a utilizar 
                        $mail->From = "sitrural@gmail.com"; // Desde donde enviamos (Para mostrar) 
                        $mail->FromName = "Soporte aplicativo tierras";
                        $mail->AddAddress($responsable['User']['email']);
                        $mail->AddAddress($proyecto1['Branch']['email']);
                        $mail->AddAddress('lafonseca@incoder.gov.co');
                        //$mail->AddAddress('blalvarez@incoder.gov.co');
                        $mail->AddAddress('rgarzon@incoder.gov.co');
                        $mail->AddAddress('drendon@incoder.gov.co');
                        $mail->AddAddress('magaleano@incoder.gov.co');
                        $mail->AddAddress($revisor['User']['email']);
                        $mail->IsHTML(true);
                        $mail->Subject = utf8_decode("CARGA DOCUMENTOS GASTO NOTARIAL PROYECTO " . $codigoProyecto . ". "); // Este es el titulo del email. 

                        $mail->Body = $body . " $aviso"; // Mensaje a enviar 

                        $exito = $mail->Send(); // Envía el correo. 
                        if ($exito) {

                            $this->Session->setFlash('Registro creado correctamente', 'flash_custom');
                        } else {
                            $this->Session->setFlash("Error :  " . $mail->ErrorInfo) . "";
                            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
                        }
                    }
                    $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
                } else {
                    $this->Session->setFlash('Error editando datos', 'flash_custom');
                    $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
                }
            }
        } else {
            $this->Session->setFlash('No hay cuentas bancarias registradas para el pago notarial', 'flash_custom');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        }
    }

    public function qualify($id) {
        App::Import('Model', 'Payment');

        $this->layout = "ajax";
        $this->ExpenseNotarial->recursive = -1;

        App::Import('Model', 'Proyect');
        $proyect_id = $this->ExpenseNotarial->field('ExpenseNotarial.proyect_id', array('ExpenseNotarial.id' => $id));

        App::Import('Model', 'UserProyect');
        $userProyect = new UserProyect();
        $userProyect->recursive = -1;
        $cont = $userProyect->find('count', array('conditions' => array('UserProyect.user_id' => $this->Auth->user('id'), 'UserProyect.proyect_id' => $proyect_id)));

        $proyecto = new Proyect();
        $codigoProyecto = $proyecto->field('Proyect.codigo', array('Proyect.id' => $proyect_id));

        $this->set('codigo', $codigoProyecto);

        if (empty($this->data)) {

            $this->data = $this->ExpenseNotarial->find('first', array('conditions' => array('ExpenseNotarial.id' => $id), 'fields' => array('ExpenseNotarial.*')));
            $rutaCuenta = "";
            $cuenta = $this->ExpenseNotarial->BankAccount->find('first', array('recursive' => -1, 'conditions' => array('BankAccount.id' => $this->data['ExpenseNotarial']['bank_account_id']), 'fields' => array('BankAccount.adjunto')));
            $rutaCuenta = $cuenta['BankAccount']['adjunto'];
            $this->set('rutaCuenta', $rutaCuenta);
        } else {

            $this->data['ExpenseNotarial']['reviso'] = $this->Auth->user('id');
            if ($this->ExpenseNotarial->saveAll($this->data)) {

                if ($this->data['ExpenseNotarial']['calificacion_total'] == 'Cumple') {

                    $pago = new Payment();
                    $id_registro = $pago->find('first', array('conditions' => array('Payment.proyect_id' => $this->data['ExpenseNotarial']['proyect_id'], 'Payment.tipo' => 'GASTOS NOTARIALES'), 'fields' => array('Payment.id')));
                    $valor = $this->data['ExpenseNotarial']['valor'];
                    $this->data['Payment']['id'] = $id_registro['Payment']['id'];
                    $this->data['Payment']['monto'] = $valor;
                    $data = array(
                        'Payment' => array(
                            'id' => $id_registro['Payment']['id'],
                            'monto' => $valor
                        )
                    );

                    if ($pago->saveAll($data)) {
                        $this->Session->setFlash('Se actualizó el valor del pago.');
                    } else {
                        $this->Session->setFlash('No se actualizó el valor pago.');
                    }
                    //Se envía un correo informando que el proyecto ya esta listo para hacer un desmbolso
                    $this->send_mail($id, 0);
                } elseif ($this->data['ExpenseNotarial']['calificacion_total'] == 'No cumple') {
                    //Se envía un correo informando por que no cumple
                    $this->send_mail($id, 1);
                }
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'ExpenseNotarials', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error editando datos', 'flash_custom');
                $this->redirect(array('controller' => 'ExpenseNotarials', 'action' => 'index'));
            }
        }
    }

    public function index() {
        if ($this->RequestHandler->isAjax()) {
            $this->layout = "ajax";
        } else {
            $this->layout = "default";
        }
        $proyect_id = $this->Session->read('proy_id');
        $this->set('proyect_id', $proyect_id);
        if ($proyect_id == "") {
            $this->Session->setFlash('Por favor seleccione un proyecto', 'flash_custom');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        } else {
            App::Import('model', 'Resolution');
            $Resolution = new Resolution();
            $resolucion = $Resolution->find('count', array('conditions' => array('Resolution.proyect_id' => $proyect_id)));

            if ($resolucion < 1) {
                $this->Session->setFlash('No se tienen datos de la resolución.', 'flash_custom');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            } else {
                $this->ExpenseNotarial->recursive = -1;
                $this->set('ExpenseNotarials', $this->ExpenseNotarial->find('all', array('order' => 'ExpenseNotarial.id DESC', 'conditions' => array('ExpenseNotarial.proyect_id' => $proyect_id), 'fields' => array('ExpenseNotarial.id', 'ExpenseNotarial.calificacion_total', 'ExpenseNotarial.observacion_total', 'ExpenseNotarial.valor'))));
            }
        }
    }

    public function qualify_view($id) {
        App::Import('Model', 'User');
        App::Import('Model', 'Proyect');
        App::Import('Model', 'Resolutions');
        App::Import('Model', 'Candidates');

        $proyect_id = $this->ExpenseNotarial->field('ExpenseNotarial.proyect_id', array('ExpenseNotarial.id' => $id));
        $proyecto = new Proyect();
        $codigoProyecto = $proyecto->field('Proyect.codigo', array('Proyect.id' => $proyect_id));

        $resolution = new Resolution();
        $resolution->recursive = -1;
        $idResolution = $resolution->field('id', array('Resolution.proyect_id' => $proyect_id), 'id DESC');
        $this->set('idResolution', $idResolution);


        $this->layout = "ajax";
        $this->ExpenseNotarial->recursive = -1;
        $this->data = $this->ExpenseNotarial->find('first', array('conditions' => array('ExpenseNotarial.id' => $id), 'fields' => array('ExpenseNotarial.acta_notificacion_calificacion', 'ExpenseNotarial.acta_notificacion_observacion',
                'ExpenseNotarial.autorizaciones_especiales_calificacion', 'ExpenseNotarial.autorizaciones_especiales_observacion', 'ExpenseNotarial.anexos_observacion', 'ExpenseNotarial.calificacion_cuenta', 'ExpenseNotarial.observacion_cuenta',
                'ExpenseNotarial.reviso', 'ExpenseNotarial.observacion_total', 'ExpenseNotarial.calificacion_total', 'ExpenseNotarial.anexos_calificacion')));

        $this->set('proyect_id', $proyect_id);
        $this->set('codigo', $codigoProyecto);
        //el id de la persona que reviso
        $user_id = $this->ExpenseNotarial->field('reviso', array('ExpenseNotarial.id' => $id));
        $bank_account_id = $this->ExpenseNotarial->field('ExpenseNotarial.bank_account_id', array('ExpenseNotarial.id' => $id));

        $c = new Candidate();
        $beneficiarios = $c->find('all', array('fields' => array('Candidate.id', 'Candidate.nro_ident', 'Candidate.1er_nombre', 'Candidate.1er_apellido', 'Candidate.2do_apellido'), 'recursive' => -1, 'conditions' => array('Candidate.proyect_id' => $proyect_id)));
        $this->set('beneficiarios', $beneficiarios);


        $cuenta = $this->ExpenseNotarial->BankAccount->find('first', array('recursive' => -1, 'conditions' => array('BankAccount.id' => $bank_account_id), 'fields' => array('BankAccount.adjunto')));
        $rutaCuenta = $cuenta['BankAccount']['adjunto'];
        $this->set('rutaCuenta', $rutaCuenta);
        $this->set('id', $id);

        $usuario = new User();
        $usuario->recursive = -1;
        $datos_usuario = $usuario->find('first', array('conditions' => array('User.id' => $user_id), 'fields' => array('User.email', 'User.nombre', 'User.primer_apellido', 'User.segundo_apellido')));
        $this->set('datos_usuario', $datos_usuario);
    }

    private function send_mail($notarial_id, $tipo) {
        App::import('Vendor', 'ClassPhpmailer', array('file' => 'phpmailer/class.phpmailer.php'));
        App::Import('model', 'Payment');

        $this->layout = "ajax";
        $gasto = $this->ExpenseNotarial->find('first', array('order' => 'ExpenseNotarial.id DESC', 'conditions' => array('ExpenseNotarial.id' => $notarial_id), 'fields' => array('ExpenseNotarial.acta_notificacion_calificacion', 'ExpenseNotarial.acta_notificacion_observacion', 'ExpenseNotarial.autorizaciones_especiales_calificacion',
                'ExpenseNotarial.autorizaciones_especiales_observacion', 'ExpenseNotarial.anexos_observacion', 'ExpenseNotarial.calificacion_cuenta', 'ExpenseNotarial.observacion_cuenta', 'ExpenseNotarial.reviso', 'ExpenseNotarial.observacion_total', 'ExpenseNotarial.calificacion_total', 'ExpenseNotarial.user_id', 'ExpenseNotarial.reviso',
                'ExpenseNotarial.proyect_id', 'ExpenseNotarial.anexos_calificacion', 'ExpenseNotarial.anexos_observacion')));
        $cal_cuenta = $gasto['ExpenseNotarial']['calificacion_cuenta'];
        $obs_cuenta = $gasto['ExpenseNotarial']['observacion_cuenta'];
        $cal_acta = $gasto['ExpenseNotarial']['acta_notificacion_calificacion'];
        $obs_acta = $gasto['ExpenseNotarial']['acta_notificacion_observacion'];
        $cal_esp = $gasto['ExpenseNotarial']['autorizaciones_especiales_calificacion'];
        $obs_esp = $gasto['ExpenseNotarial']['autorizaciones_especiales_observacion'];
        $cal_anexos = $gasto['ExpenseNotarial']['anexos_calificacion'];
        $obs_anexos = $gasto['ExpenseNotarial']['anexos_observacion'];

        $cal_total = $gasto['ExpenseNotarial']['calificacion_total'];
        $obs_total = $gasto['ExpenseNotarial']['observacion_total'];

        $body = "<table border='1' width='80%' cellspacing='5' cellpadding='5'>
    <tbody>
        <tr>
            <td>Cuenta Bancaria calificación</td>
            <td>$cal_cuenta</td>
        </tr>
        <tr>
            <td>Cuenta Bancaria observación</td>
            <td>$obs_cuenta</td>
        </tr>
        <tr>
            <td>Acta notificación calificación</td>
            <td>$cal_acta</td>
        </tr>
        <tr>
            <td>Acta notificación observación</td>
            <td>$obs_acta</td>
        </tr>
        <tr>
            <td>Autorizaciones Especiales calificación</td>
            <td>$cal_esp</td>
        </tr>
        <tr>
            <td>Autorizaciones Especiales observación</td>
            <td>$obs_esp</td>
        </tr>
        <tr>
            <td>Anexos - cédulas calificación</td>
            <td>$cal_anexos</td>
        </tr>
        <tr>
            <td>Anexos - cédulas observación</td>
            <td>$obs_anexos</td>
        </tr>
        <tr>
            <td>Calificación total</td>
            <td>$cal_total</td>
        </tr>
        <tr>
            <td>Observación  total</td>
            <td>$obs_total</td>
        </tr>
    </tbody>
</table>";

//Buscando usuario responsable
        $proyecto = $this->ExpenseNotarial->Proyect->find('first', array('recursive' => -1, 'joins' => array(array('table' => 'branches', 'alias' => 'Branch', 'type' => 'left', 'conditions' => array('Branch.id=Proyect.branch_id'))), 'conditions' => array('Proyect.id' => $gasto['ExpenseNotarial']['proyect_id']), 'fields' => array('Proyect.codigo', 'Branch.email')));

        $responsable = $this->ExpenseNotarial->User->find('first', array('recursive' => -1, 'conditions' => array('User.id' => $gasto['ExpenseNotarial']['user_id']), 'fields' => array('User.email', 'User.nombre', 'User.primer_apellido', 'User.segundo_apellido')));
        $revisor = $this->ExpenseNotarial->User->find('first', array('recursive' => -1, 'conditions' => array('User.id' => $gasto['ExpenseNotarial']['reviso']), 'fields' => array('User.email', 'User.nombre', 'User.primer_apellido', 'User.segundo_apellido')));
        $body.="<p>Encargado de adjuntar documentos: " . $responsable['User']['nombre'] . " " . $responsable['User']['primer_apellido'] . " " . $responsable['User']['segundo_apellido'] . " " . $responsable['User']['email'] . "</p>";
        $body.="<p>Encargado de la revisión de documentos: " . $revisor['User']['nombre'] . " " . $revisor['User']['primer_apellido'] . " " . $revisor['User']['segundo_apellido'] . " " . $revisor['User']['email'] . "</p>";
        //director territorial
        $body.="<p>Correo director territorial: " . $proyecto['Branch']['email'] . "</p>";

//Se obtiene el valor del desembolso si la calificación de los documentos fue positiva, esto para asegurar que el valor este actualizado

        if ($cal_total == "Cumple") {
            $pago = new Payment();
            $pago->recursive = -1;
            $valor_pago_notarial = $pago->field('Payment.monto', array('Payment.proyect_id' => $gasto['ExpenseNotarial']['proyect_id'], 'Payment.tipo' => "GASTOS NOTARIALES"));
            $body.="<p>Valor: $" . number_format($valor_pago_notarial, 2, ',', '.') . "</p>";
        }

        $mail = new PHPMailer();

//Luego tenemos que iniciar la validación por SMTP: 
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "ssl://smtp.gmail.com"; // SMTP a utilizar. Por ej. smtp.elserver.com 
        $mail->Username = "sitrural@gmail.com"; // Correo completo a utilizar 
        $mail->Password = "laropavieja.net.co"; // Contraseña 
        $mail->Port = 465; // Puerto a utilizar 
//Con estas pocas líneas iniciamos una conexión con el SMTP. Lo que ahora deberíamos hacer, es configurar el mensaje a enviar, el //From, etc. 
        $mail->From = "sitrural@gmail.com"; // Desde donde enviamos (Para mostrar) 
        $mail->FromName = "Soporte aplicativo tierras";

//Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo. 

        if ($tipo == 0) {
            $mail->AddAddress($responsable['User']['email']);
            $mail->AddAddress($proyecto['Branch']['email']);
            $mail->AddAddress($revisor['User']['email']);
            $mail->AddAddress('lafonseca@incoder.gov.co');
            //$mail->AddAddress('blalvarez@incoder.gov.co');
            $mail->AddAddress('rgarzon@incoder.gov.co');
            $mail->AddAddress('drendon@incoder.gov.co');
            $mail->AddAddress('magaleano@incoder.gov.co');
        } else if ($tipo == 1) {
            $mail->AddAddress($responsable['User']['email']);
            $mail->AddAddress($proyecto['Branch']['email']);
            $mail->AddAddress($revisor['User']['email']);
            $mail->AddAddress('lafonseca@incoder.gov.co');
            //$mail->AddAddress('blalvarez@incoder.gov.co');
            $mail->AddAddress('rgarzon@incoder.gov.co');
            $mail->AddAddress('drendon@incoder.gov.co');
            $mail->AddAddress('magaleano@incoder.gov.co');
        }

        $mail->IsHTML(true);
//$mail->IsHTML(true); // El correo se envía como HTML 
        $mail->Subject = utf8_decode("RESULTADO REVISIÓN DE DOCUMENTOS PARA GASTO NOTARIAL. " . $proyecto['Proyect']['codigo'] . " "); // Este es el titulo del email. 

        $mail->Body = utf8_decode($body); // Mensaje a enviar 
//$mail->SMTPDebug = 1;

        $exito = $mail->Send(); // Envía el correo. 
//También podríamos agregar simples verificaciones para saber si se envió: 
        if ($exito) {
            $this->Session->setFlash("Sus datos fueron enviados correctamente ");
        } else {
            $this->Session->setFlash("Error :  " . $mail->ErrorInfo);
        }
    }

    public function print_certification($notarial_id) {
        $this->layout = "pdf";

        $notarial = $this->ExpenseNotarial->find('first', array('conditions' => array('ExpenseNotarial.id' => $notarial_id), 'fields' => array('ExpenseNotarial.id', 'BankAccount.candidate_id', 'ExpenseNotarial.valor', 'ExpenseNotarial.proyect_id', 'ExpenseNotarial.calificacion_total')));

        $this->set('proyecto', $this->ExpenseNotarial->Proyect->find('first', array('recursive' => 0, 'conditions' => array('Proyect.id' => $notarial['ExpenseNotarial']['proyect_id']), 'fields' => array('Proyect.codigo', 'Call.*'))));

        App::Import('model', 'Resolution');
        $Resolution = new Resolution();
        $resolucion = $Resolution->find('first', array('recursive' => -1, 'conditions' => array('Resolution.proyect_id' => $notarial['ExpenseNotarial']['proyect_id']), 'fields' => array('Resolution.fecha', 'Resolution.numero', 'Resolution.final_evaluation_id'), 'order' => array('Resolution.id DESC')));
        $this->set('resolucion', $resolucion);

        App::Import('model', 'BankAccount');
        $BankAccount = new BankAccount();
        $cuenta = $BankAccount->find('first', array('recursive' => 0, 'conditions' => array('BankAccount.candidate_id' => $notarial['BankAccount']['candidate_id']), 'fields' => array('BankAccount.*', 'Candidate.*')));
        $this->set('cuenta', $cuenta);

        App::Import('model', 'Candidate');
        $c = new Candidate();
        $beneficiarios = $c->find('all', array('fields' => array('Candidate.id', 'Candidate.nro_ident', 'Candidate.1er_nombre', 'Candidate.2do_nombre', 'Candidate.1er_apellido', 'Candidate.2do_apellido', 'City.name', 'Departament.name', 'Candidate.telefono', 'Candidate.direccion', 'Candidate.obligacion_numero', 'Candidate.cdp', 'Candidate.rp'), 'recursive' => 1, 'conditions' => array('Candidate.proyect_id' => $notarial['ExpenseNotarial']['proyect_id'], 'Candidate.candidate_id' => 0, 'Candidate.resolucion_numero !=' => 0)));
        $this->set('beneficiarios', $beneficiarios);

        App::Import('model', 'City');
        $city = new City();

        App::Import('model', 'Departament');
        $departament = new Departament();


        if ($cuenta['BankAccount']['candidate_id'] == 0 or is_null($cuenta['BankAccount']['candidate_id'])) {
            App::Import('model', 'Proposer');
            $pr = new Proposer();

            $proponente = $pr->find('first', array('fields' => array('Proposer.*'), 'recursive' => -1, 'conditions' => array('Proposer.proyect_id' => $notarial['ExpenseNotarial']['proyect_id'])));
            $ciudadRepresentante = $city->find('first', array('fields' => array('City.name', 'City.departament_id'), 'recursive' => -1, 'conditions' => array('City.id' => $proponente['Proposer']['city_id'])));
            $DepartamentoRepresentante = $departament->field('name', array('Departament.id' => $ciudadRepresentante['City']['departament_id']));
            $this->set('proponente', $proponente);
        } else {
            $ciudadRepresentante = $city->find('first', array('fields' => array('City.name', 'City.departament_id'), 'recursive' => -1, 'conditions' => array('City.id' => $cuenta['Candidate']['city_id'])));
            $DepartamentoRepresentante = $departament->field('name', array('Departament.id' => $ciudadRepresentante['City']['departament_id']));
        }

        $this->set('ciudadRepresentante', $ciudadRepresentante['City']['name']);
        $this->set('DepartamentoRepresentante', $DepartamentoRepresentante);

        App::Import('model', 'Payment');
        $p = new Payment();

        $otrosPagos = $p->find('all', array('fields' => array('Payment.monto', 'Payment.tipo', 'Payment.fecha_pago_real', 'Payment.fecha_solicitud_desembolso'), 'recursive' => -1, 'conditions' => array('Payment.proyect_id' => $notarial['ExpenseNotarial']['proyect_id'])));
        $this->set('otrosPagos', $otrosPagos);

        $pagoActual = $p->find('first', array('fields' => array('Payment.monto', 'Payment.tipo', 'Payment.fecha_pago_real', 'Payment.fecha_solicitud_desembolso'), 'recursive' => -1, 'conditions' => array('Payment.proyect_id' => $notarial['ExpenseNotarial']['proyect_id'], 'Payment.tipo' => 'GASTOS NOTARIALES')));
        $this->set('pagoActual', $pagoActual);

        App::Import('model', 'FinalEvaluation');
        $fe = new FinalEvaluation();
        $numeroBeneficiarios = $fe->field('FinalEvaluation.familias_habilitadas', array('FinalEvaluation.proyect_id' => $notarial['ExpenseNotarial']['proyect_id']), 'FinalEvaluation.id DESC');
        $this->set('numeroBeneficiarios', $numeroBeneficiarios);
    }

    function equipo_desembolsos() {

        //Importamos modelos que no esten a UNA relacion de expense_notarials
        App::Import('model', 'Candidate');
        App::Import('model', 'BankAccount');

        //Inicializamos variables
        $documento_desembolsado = 0;

        $this->layout = "csv";
        ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large
//create a file
        $filename = "Equipo_Desembolsos_Notariales" . date("Y.m.d") . ".csv";
        $csv_file = fopen('php://output', 'w');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        //Se crea el arreglo de las cabeceras
        $header_row = array("PROYECTO", "RESOLUCIÓN", "DESEMBOLSO",
            "VALOR", "NOMBRES", "IDENTIFICACIÓN", "CUENTA CORRIENTE", "CUENTA DE AHORROS",
            "NÚMERO", "BANCO",
        );

        $newRow = array();

        foreach ($header_row as $a) {
            $newRow[] = iconv('UTF-8', 'Windows-1252', $a);
        }

        //Se ponen las cabeceras en el archivo
        fputcsv($csv_file, $newRow, ';', '"');

        //Hacemos la consulta
        $sql = "SELECT proyect.`codigo`, resolution.`fecha`, resolution.`numero`, notarial.`valor`,  account.`numero_cuenta`,
                account.`tipo_cuenta`, account.`nombre_banco`,
                account.`candidate_id`, candidate.`1er_apellido`, candidate.`2do_apellido`, candidate.`1er_nombre`, candidate.`nro_ident` 
                FROM `expense_notarials` notarial 
                LEFT JOIN `proyects` proyect on (notarial.proyect_id=proyect.id)
                LEFT JOIN `bank_accounts` account on (account.id=notarial.bank_account_id)
                LEFT JOIN `candidates` candidate on (candidate.id=account.candidate_id)
                LEFT JOIN `resolutions` resolution on (resolution.proyect_id=proyect.id)
                WHERE 1";
        $results = $this->ExpenseNotarial->query($sql);
        // Each iteration of this while loop will be a row in your .csv file where each field corresponds to the heading of the column


        foreach ($results as $result) {
            // Array indexes correspond to the field names in your db table(s)
            //DOS Columnas de CUENTAS

            $tipo_cuenta_cte = "";
            switch ($result['account']['tipo_cuenta']) {
                case 'Corriente':
                    $tipo_cuenta_cte = "X";
                    break;
                case 'Ahorros':
                    $tipo_cuenta_cte = "";
                    break;
                default:
                    $tipo_cuenta_cte = "Sin Registro";
                    break;
            }

            $tipo_cuenta_ahs = "";
            switch ($result['account']['tipo_cuenta']) {
                case 'Ahorros':
                    $tipo_cuenta_ahs = "X";
                    break;
                case 'Corriente':
                    $tipo_cuenta_ahs = "";
                    break;
                default:
                    $tipo_cuenta_ahs = "Sin Registro";
                    break;
            }
            //INFO DE LA PERSONA DESEMBOLSADA
//            //documento 
            // $documento_desembolsado = $this->ExpenseNotarial->BankAccount->Candidate->find('first', array('conditions' => array('Candidate.id' => $result['account']['candidate_id']), 'fields' => array('Candidate.nro_ident')));

            $row = array(
                //1
                $result['proyect']['codigo'],
                //2. resolucion
                $result['resolution']['numero'] . " de " . $result['resolution']['fecha'],
                //3 tipo desembolso
                "GASTOS NOTARIALES",
                //4 valor desembolsado
                $result['notarial']['valor'],
                //5 Nombre de la persona a la que se le desembolsara el dinero.
                $result['candidate']['1er_nombre'] . " " . $result['candidate']['1er_apellido'] . " " . $result['candidate']['2do_apellido'],
                //6 Cédula de ciudadanía de la persona a la que se le desembolsara el dinero.
                $result['candidate']['nro_ident'],
                //7 CTE
                $tipo_cuenta_cte,
                //8 AHorros
                $tipo_cuenta_ahs,
                //9 Numero Cuenta
                $result['account']['numero_cuenta'],
                //Nombre Banco
                $result['account']['nombre_banco'],
            );

            $newRow = array();

            foreach ($row as $a) {
                $newRow[] = iconv('UTF-8', 'Windows-1252', $a);
            }

            fputcsv($csv_file, $newRow, ';', '"');
        }

        fclose($csv_file);
    }

}

?>
