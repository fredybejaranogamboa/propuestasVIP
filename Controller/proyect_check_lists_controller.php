<?php

Class ProyectCheckListsController extends AppController {

    public $name = 'ProyectCheckLists';

    public function add($notarial_id) {
        $this->layout = "ajax";
        App::Import('Model', 'FinalEvaluation');
        App::Import('Model', 'ExpenseNotarial');
        $this->set('notarial_id', $notarial_id);
        if (empty($this->data)) {
            $pagoNotarial = $this->ProyectCheckList->ExpenseNotarial->find('first', array('recursive' => -1, 'conditions' => array('ExpenseNotarial.id' => $notarial_id), 'fields' => array('ExpenseNotarial.calificacion_total', 'ExpenseNotarial.proyect_id')));
            if ($pagoNotarial['ExpenseNotarial']['calificacion_total'] != "Cumple") {
                $this->Session->setFlash('El proyecto no cumple respecto al pago notarial');
                $this->redirect(array('controller' => 'ProyectCheckLists', 'action' => 'index', $notarial_id));
            } else {
                $this->set('proyect_id', $pagoNotarial['ExpenseNotarial']['proyect_id']);
            }
        } else {
            $evaluacionFinal = new FinalEvaluation();
            $gastoNotarial = new ExpenseNotarial();
            $proyect_id = $gastoNotarial->field('proyect_id', array('ExpenseNotarial.id' => $notarial_id));
            $valorSubsidioProyecto = $evaluacionFinal->field('subsidio_proyecto_real', array('FinalEvaluation.proyect_id' => $proyect_id), 'FinalEvaluation.id DESC');
            //se asigna el valor del subsidio del proyecto productivo
            $this->data['ProyectCheckList']['valor'] = $valorSubsidioProyecto;
            $this->data['ProyectCheckList']['user_id'] = $this->Auth->user('id');
            if ($this->ProyectCheckList->saveAll($this->data)) {
                $lastId = $this->ProyectCheckList->getInsertID();
                App::Import('Model', 'Proyect');
                $Proyect = new Proyect();
                $Proyect->recursive = -1;
                $proyecto = $Proyect->find('first', array('conditions' => array('Proyect.id' => $this->data['ProyectCheckList']['proyecto']), 'fields' => array('Proyect.codigo')));
                $codigo = $proyecto['Proyect']['codigo'];
                $rutaArchivo = APP . "webroot" . "/" . "files" . "/" . $codigo;

                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }
                $rutaArchivo = APP . "webroot" . "/" . "files" . "/" . $codigo . "/Pagos";

                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                $nombreArchivo1 = "Solicitud-$codigo-$lastId";
                $nombreArchivo2 = "Acta-inicio-$codigo-$lastId";
                $nombreArchivo3 = "Liquidacion-$codigo-$lastId";
                $this->ProyectCheckList->id = $lastId;
                $this->ProyectCheckList->saveField('ruta_informe', 'files/' . $codigo . "/Pagos/" . $nombreArchivo1);
                $this->ProyectCheckList->saveField('ruta_acta', 'files/' . $codigo . "/Pagos/" . $nombreArchivo2);
                $this->ProyectCheckList->saveField('ruta_liquidacion', 'files/' . $codigo . "/Pagos/" . $nombreArchivo3);
                $nombreArchivo1 = $nombreArchivo1 . ".pdf";
                $rutaArchivo1 = $rutaArchivo;
                $rutaArchivo1.= "/" . $nombreArchivo1;
                $rutaArchivo2 = $rutaArchivo;
                $nombreArchivo2 = $nombreArchivo2 . ".pdf";
                $rutaArchivo2.= "/" . $nombreArchivo2;
                $adjuntados = true;
                $nombreArchivo3 = $nombreArchivo3 . ".pdf";
                $rutaArchivo3 = $rutaArchivo;
                $rutaArchivo3.= "/" . $nombreArchivo3;
                $adjuntados = true;
                $mensaje = "";
                if (!empty($this->data['ProyectCheckList']['informe']['tmp_name'])) {
                    try {

                        if (move_uploaded_file($this->data['ProyectCheckList']['informe']['tmp_name'], $rutaArchivo1)) {
                            $mensaje.="<h1>Se ha cargado el archivo Informe de solicitud de desembolso del subsidio para proyecto productivo F33-PM-OS-01</h1><br>";
                        } else {
                            $mensaje.="Error cargando el archivo Informe de solicitud de desembolso del subsidio para proyecto productivo F33-PM-OS-01";
                        }
                    } catch (Exception $exc) {
                        echo $exc->getMessage();
                        $adjuntados = false;
                        $this->Session->setFlash('No se pudo adjuntar archivo', 'flash_custom');
                    }
                }


                if (!empty($this->data['ProyectCheckList']['liquidacion']['tmp_name'])) {
                    try {

                        if (move_uploaded_file($this->data['ProyectCheckList']['liquidacion']['tmp_name'], $rutaArchivo3)) {
                            $mensaje.="<h1>Se ha cargado el archivo Liquidación de los Gastos Notariales según Formato F30-OM-OS-01</h1><br>";
                        } else {
                            $mensaje.="Error cargando el archivo Liquidación de los Gastos Notariales según Formato F30-OM-OS-01";
                        }
                    } catch (Exception $exc) {
                        echo $exc->getMessage();
                        $adjuntados = false;
                        $this->Session->setFlash('No se pudo adjuntar archivo', 'flash_custom');
                    }
                }


                if ($mensaje != "") {
                    App::import('Vendor', 'ClassPhpmailer', array('file' => 'phpmailer/class.phpmailer.php'));
                    $responsable = $this->ProyectCheckList->User->find('first', array('recursive' => -1, 'conditions' => array('User.id' => $this->Auth->user('id')), 'fields' => array('User.email', 'User.nombre', 'User.primer_apellido')));

                    $UserProyect = new UserProyect();
                    $UserProyect->recursive = 2;

                    //Buscar información sobre la persona que tiene asignado el proyecto.
                    $revisor2 = $UserProyect->find('first', array('conditions' => array('UserProyect.proyect_id' => $proyect_id), 'fields' => array('User.email'), 'order' => array('UserProyect.id' => 'DESC')));

                    $Proyect2 = new Proyect();
                    $Proyect2->recursive = -1;

                    //Buscar información sobre el código del proyecto y el correo del director territorial
                    $proyecto1 = $Proyect2->find('first', array('joins' => array(array('table' => 'branches', 'alias' => 'Branch', 'type' => 'left', 'conditions' => array('Branch.id=Proyect.branch_id'))), 'conditions' => array('Proyect.id' => $proyect_id), 'fields' => array('Proyect.codigo', 'Branch.email')));

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
                    $mail->AddAddress($revisor2['User']['email']);
                    $mail->AddAddress($proyecto1['Branch']['email']);
                    $mail->AddAddress($responsable['User']['email']);
                    //$mail->AddAddress('lafonseca@incoder.gov.co');
                    //$mail->AddAddress('blalvarez@incoder.gov.co');
                    $mail->AddAddress('rgarzon@incoder.gov.co');
                    $mail->AddAddress('drendon@incoder.gov.co');
                    $mail->AddAddress('magaleano@incoder.gov.co');
                    $mail->IsHTML(true);
                    $mail->Subject = utf8_decode("CARGA DE DOCUMENTOS PROYECTO PRODUCTIVO " . $codigo); // Este es el titulo del email. 

                    $mail->Body = $body . $mensaje; // Mensaje a enviar 

                    $exito = $mail->Send(); // Envía el correo.
                    if ($exito) {

                        $this->Session->setFlash('Registro creado correctamente', 'flash_custom');
                    } else {
                        $this->Session->setFlash("Error :  " . $mail->ErrorInfo) . "XXX";
                        $this->redirect(array('controller' => 'ExpenseNotarials', 'action' => 'index'));
                    }
                }

                if ($adjuntados) {
                    $this->Session->setFlash('Registro y archivos Adicionados correctamente', 'flash_custom');
                    $this->redirect(array('controller' => 'ProyectCheckLists', 'action' => 'index', $notarial_id));
                }
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    public function edit($id) {
        $this->layout = "ajax";
        $this->ProyectCheckList->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->ProyectCheckList->find('first', array('conditions' => array('ProyectCheckList.id' => $id), 'fields' => array('ProyectCheckList.id', 'ProyectCheckList.expense_notarial_id', 'ProyectCheckList.valor', 'ProyectCheckList.saldo', 'ProyectCheckList.ruta_informe', 'ProyectCheckList.ruta_acta', 'ProyectCheckList.ruta_liquidacion')));

            $pagoNotarial = $this->ProyectCheckList->ExpenseNotarial->find('first', array('recursive' => -1, 'conditions' => array('ExpenseNotarial.id' => $this->data['ProyectCheckList']['expense_notarial_id']), 'fields' => array('ExpenseNotarial.proyect_id', 'ExpenseNotarial.valor')));
            $this->set('valorGastoNotarial', $pagoNotarial['ExpenseNotarial']['valor']);

            $this->set('proyect_id', $pagoNotarial['ExpenseNotarial']['proyect_id']);
        } else {
            $this->data['ProyectCheckList']['user_id'] = $this->Auth->user('id');

            App::Import('Model', 'Proyect');
            $Proyect = new Proyect();
            $Proyect->recursive = -1;
            $proyecto = $Proyect->find('first', array('conditions' => array('Proyect.id' => $this->data['ProyectCheckList']['proyecto']), 'fields' => array('Proyect.codigo')));
            $codigo = $proyecto['Proyect']['codigo'];
            $nombreArchivo1 = "Solicitud-$codigo-" . $this->data['ProyectCheckList']['id'];
            $nombreArchivo2 = "Acta-inicio-$codigo-" . $this->data['ProyectCheckList']['id'];
            $nombreArchivo3 = "Liquidacion-$codigo-" . $this->data['ProyectCheckList']['id'];

            if (!empty($this->data['ProyectCheckList']['informe']['tmp_name'])) {
                $this->data['ProyectCheckList']['ruta_informe'] = "files/$codigo/Pagos/" . $nombreArchivo1;
            }

            if (!empty($this->data['ProyectCheckList']['acta']['tmp_name'])) {
                $this->data['ProyectCheckList']['ruta_acta'] = "files/$codigo/Pagos/" . $nombreArchivo2;
            }
            if (!empty($this->data['ProyectCheckList']['liquidacion']['tmp_name'])) {
                echo $this->data['ProyectCheckList']['ruta_liquidacion'] = "files/$codigo/Pagos/" . $nombreArchivo3;
            }

            if ($this->ProyectCheckList->saveAll($this->data)) {
                $rutaArchivo = APP . "webroot" . "/" . "files" . "/" . $codigo;
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }
                $rutaArchivo = APP . "webroot" . "/" . "files" . "/" . $codigo . "/Pagos";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                $nombreArchivo1 = $nombreArchivo1 . ".pdf";
                $rutaArchivo1 = $rutaArchivo;
                $rutaArchivo1.= "/" . $nombreArchivo1;
                $rutaArchivo2 = $rutaArchivo;
                $nombreArchivo2 = $nombreArchivo2 . ".pdf";
                $rutaArchivo2.= "/" . $nombreArchivo2;
                $rutaArchivo3 = $rutaArchivo;
                $nombreArchivo3 = $nombreArchivo3 . ".pdf";
                $rutaArchivo3.= "/" . $nombreArchivo3;
                $adjuntados = true;
                $mensaje = "";
                if (!empty($this->data['ProyectCheckList']['informe']['tmp_name'])) {
                    try {

                        if (move_uploaded_file($this->data['ProyectCheckList']['informe']['tmp_name'], $rutaArchivo1)) {
                            $mensaje.="<h1>Se ha cargado el archivo Informe de solicitud de desembolso del subsidio para proyecto productivo F33-PM-OS-01</h1><br>";
                        } else {
                            $mensaje.="Error cargando el archivo Informe de solicitud de desembolso del subsidio para proyecto productivo F33-PM-OS-01";
                        }
                    } catch (Exception $exc) {
                        echo $exc->getMessage();
                        $adjuntados = false;
                        $this->Session->setFlash('No se pudo adjuntar archivo', 'flash_custom');
                    }
                }

                if (!empty($this->data['ProyectCheckList']['acta']['tmp_name'])) {
                    try {

                        if (move_uploaded_file($this->data['ProyectCheckList']['acta']['tmp_name'], $rutaArchivo2)) {
                            $mensaje.="<h1>Se ha cargado el archivo Acta de Inicio del Proyecto Productivo F32-PM-OS-01</h1><br>";
                        } else {
                            $mensaje.="Error cargando el archivo Acta de Inicio del Proyecto Productivo F32-PM-OS-01";
                        }
                    } catch (Exception $exc) {
                        echo $exc->getMessage();
                        $adjuntados = false;
                        $this->Session->setFlash('No se pudo adjuntar archivo', 'flash_custom');
                    }
                }

                if (!empty($this->data['ProyectCheckList']['liquidacion']['tmp_name'])) {
                    try {
                        if (move_uploaded_file($this->data['ProyectCheckList']['liquidacion']['tmp_name'], $rutaArchivo3)) {
                            $mensaje.="<h1>Se ha cargado el archivo Liquidación de los Gastos Notariales según Formato F30-OM-OS-01</h1><br>";
                        } else {
                            $mensaje.="Error cargando el archivo Liquidación de los Gastos Notariales según Formato F30-OM-OS-01";
                        }
                    } catch (Exception $exc) {
                        echo $exc->getMessage();
                        $adjuntados = false;
                        $this->Session->setFlash('No se pudo adjuntar archivo', 'flash_custom');
                    }
                }

                if ($mensaje != "") {
                    App::import('Vendor', 'ClassPhpmailer', array('file' => 'phpmailer/class.phpmailer.php'));
                    $responsable = $this->ProyectCheckList->User->find('first', array('recursive' => -1, 'conditions' => array('User.id' => $this->Auth->user('id')), 'fields' => array('User.email', 'User.nombre', 'User.primer_apellido')));

                    $UserProyect = new UserProyect();
                    $UserProyect->recursive = 2;

                    //Buscar información sobre la persona que tiene asignado el proyecto.
                    $revisor2 = $UserProyect->find('first', array('conditions' => array('UserProyect.proyect_id' => $this->data['ProyectCheckList']['proyecto']), 'fields' => array('User.email'), 'order' => array('UserProyect.id' => 'DESC')));

                    $Proyect2 = new Proyect();
                    $Proyect2->recursive = -1;

                    //Buscar información sobre el código del proyecto y el correo del director territorial
                    $proyecto1 = $Proyect2->find('first', array('joins' => array(array('table' => 'branches', 'alias' => 'Branch', 'type' => 'left', 'conditions' => array('Branch.id=Proyect.branch_id'))), 'conditions' => array('Proyect.id' => $this->data['ProyectCheckList']['proyecto']), 'fields' => array('Branch.email')));

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
                    $mail->AddAddress($revisor2['User']['email']);
                    $mail->AddAddress('lafonseca@incoder.gov.co');
                    $mail->AddAddress('rgarzon@incoder.gov.co');
                    $mail->AddAddress('drendon@incoder.gov.co');
                    $mail->AddAddress('magaleano@incoder.gov.co');
                    //$mail->AddAddress('blalvarez@incoder.gov.co');
                    $mail->IsHTML(true);
                    $mail->Subject = utf8_decode("CARGA DE DOCUMENTOS PROYECTO PRODUCTIVO " . $codigo); // Este es el titulo del email. 

                    $mail->Body = $body . $mensaje; // Mensaje a enviar 

                    $exito = $mail->Send(); // Envía el correo.
                    if ($exito) {

                        $this->Session->setFlash('Registro creado correctamente', 'flash_custom');
                    } else {
                        $this->Session->setFlash("Error :  " . $mail->ErrorInfo) . "";
                        $this->redirect(array('controller' => 'ExpenseNotarials', 'action' => 'index'));
                    }
                }

                if ($adjuntados) {
                    $this->Session->setFlash('Registro editado  correctamente', 'flash_custom');
                    $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
                }
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function qualify($id) {
        App::Import('Model', 'Proyect');
        App::Import('Model', 'ExpenseNotarial');
        App::Import('Model', 'Payment');
        $this->layout = "ajax";

        $gastoNotarial = new ExpenseNotarial();
        $gastoNotarial->recursive = -1;

        $notarial_id = $this->ProyectCheckList->field('ProyectCheckList.expense_notarial_id', array('ProyectCheckList.id' => $id));
        $proyect_id = $gastoNotarial->field('ExpenseNotarial.proyect_id', array('ExpenseNotarial.id' => $notarial_id));

        App::Import('Model', 'UserProyect');
        $userProyect = new UserProyect();
        $userProyect->recursive = -1;
        $cont = $userProyect->find('count', array('conditions' => array('UserProyect.user_id' => $this->Auth->user('id'), 'UserProyect.proyect_id' => $proyect_id)));


        if (empty($this->data)) {

            $this->data = $this->ProyectCheckList->find('first', array('conditions' => array('ProyectCheckList.id' => $id), 'fields' => array('ProyectCheckList.*', 'ExpenseNotarial.bank_account_id', 'ExpenseNotarial.proyect_id')));
            $this->ProyectCheckList->ExpenseNotarial->BankAccount->recursive = -1;
            $rutaCuenta = $this->ProyectCheckList->ExpenseNotarial->BankAccount->field('adjunto', array('BankAccount.id' => $this->data['ExpenseNotarial']['bank_account_id']));
            $this->set('rutaCuenta', $rutaCuenta);

            $Proyect = new Proyect();
            $Proyect->recursive = -1;
            $codigo = $Proyect->field('Proyect.codigo', array('Proyect.id' => $this->data['ExpenseNotarial']['proyect_id']));
            $this->set('codigo', $codigo);
        } else {
            $this->data['ProyectCheckList']['reviso'] = $this->Auth->user('id');

            if ($this->ProyectCheckList->saveAll($this->data)) {

                if ($this->data['ProyectCheckList']['calificacion_total'] == 'Cumple') {
                    $gasto_notarial = new ExpenseNotarial();
                    $proyect_id = $gasto_notarial->field('ExpenseNotarial.proyect_id', array('ExpenseNotarial.id' => $this->data['ProyectCheckList']['expense_notarial_id']));
                    $pago = new Payment();
                    $id_registro = $pago->find('first', array('conditions' => array('Payment.proyect_id' => $proyect_id, 'Payment.tipo' => 'PROYECTO PRODUCTIVO'), 'fields' => array('Payment.id')));
                    $valor = $this->data['ProyectCheckList']['valor'] - $this->data['ProyectCheckList']['saldo'];
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
                    $this->send_mail($id);
                } else {
                    $this->send_mail($id);
                }
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'ProyectCheckLists', 'action' => 'index', $this->data['ProyectCheckList']['expense_notarial_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function index($notarial_id) {
        if ($this->RequestHandler->isAjax()) {
            $this->layout = "ajax";
        } else {
            $this->layout = "default";
        }
        $this->ProyectCheckList->recursive = -1;
        $this->set('notarial_id', $notarial_id);
        $this->paginate = array('ProyectCheckList' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('ProyectCheckList.id', 'ProyectCheckList.calificacion_total', 'ProyectCheckList.observacion_total')));
        $this->set('ProyectCheckLists', $this->paginate('ProyectCheckList', array('ProyectCheckList.expense_notarial_id' => $notarial_id)));
    }

    public function qualify_view($id) {
        App::Import('Model', 'User');

        $this->layout = "ajax";
        //$this->ProyectCheckList->recursive = 0;
        $this->data = $this->ProyectCheckList->find('first', array('conditions' => array('ProyectCheckList.id' => $id), 'fields' => array('ProyectCheckList.*', 'ExpenseNotarial.bank_account_id', 'ExpenseNotarial.proyect_id')));

        //el id de la persona que reviso
        $user_id = $this->ProyectCheckList->field('reviso', array('ProyectCheckList.id' => $id));
        $usuario = new User();
        $usuario->recursive = -1;
        $datos_usuario = $usuario->find('first', array('conditions' => array('User.id' => $user_id), 'fields' => array('User.email', 'User.nombre', 'User.primer_apellido', 'User.segundo_apellido')));
        $this->set('datos_usuario', $datos_usuario);
        $rutaCuenta = $this->ProyectCheckList->ExpenseNotarial->BankAccount->field('adjunto', array('BankAccount.id' => $this->data['ExpenseNotarial']['bank_account_id']));
        $this->set('rutaCuenta', $rutaCuenta);
        $Proyect = new Proyect();
        $Proyect->recursive = -1;
        $codigo = $Proyect->field('Proyect.codigo', array('Proyect.id' => $this->data['ExpenseNotarial']['proyect_id']));
        $this->set('codigo', $codigo);
    }

    private function send_mail($list_id) {
        App::import('Vendor', 'ClassPhpmailer', array('file' => 'phpmailer/class.phpmailer.php'));
        App::Import('model', 'Payment');

        $this->layout = "ajax";
        $gasto = $this->ProyectCheckList->find('first', array('order' => 'ProyectCheckList.id DESC', 'conditions' => array('ProyectCheckList.id' => $list_id), 'fields' => array('ProyectCheckList.calificacion_informe', 'ProyectCheckList.observacion_informe', 'ProyectCheckList.calificacion_acta', 'ProyectCheckList.observacion_acta', 'ProyectCheckList.calificacion_poder', 'ProyectCheckList.observacion_poder', 'ProyectCheckList.calificacion_cuenta', 'ProyectCheckList.observacion_cuenta', 'ProyectCheckList.reviso', 'ProyectCheckList.observacion_total', 'ProyectCheckList.calificacion_total', 'ProyectCheckList.user_id', 'ProyectCheckList.reviso', 'ProyectCheckList.expense_notarial_id', 'ProyectCheckList.calificacion_liquidacion', 'ProyectCheckList.observacion_liquidacion', 'ExpenseNotarial.proyect_id', 'User.nombre', 'User.id', 'User.primer_apellido', 'User.email')));
        $cal_cuenta = $gasto['ProyectCheckList']['calificacion_cuenta'];
        $obs_cuenta = $gasto['ProyectCheckList']['observacion_cuenta'];
        $cal_informe = $gasto['ProyectCheckList']['calificacion_informe'];
        $obs_informe = $gasto['ProyectCheckList']['observacion_informe'];
        $cal_acta = $gasto['ProyectCheckList']['calificacion_acta'];
        $obs_acta = $gasto['ProyectCheckList']['observacion_acta'];
        $cal_liq = $gasto['ProyectCheckList']['calificacion_liquidacion'];
        $obs_liq = $gasto['ProyectCheckList']['observacion_liquidacion'];
        $cal_total = $gasto['ProyectCheckList']['calificacion_total'];
        $obs_total = $gasto['ProyectCheckList']['observacion_total'];
        $body = "<table border='1' width='80%'  cellspacing='5' cellpadding='5'>
    <tbody>
        <tr>
            <td>Cuenta Bancaria </td>
            <td>$cal_cuenta</td>
        </tr>
        <tr>
            <td></td>
            <td>$obs_cuenta</td>
        </tr>
        <tr>
            <td>Informe de solicitud de desembolso del subsidio para proyecto productivo F33-PM-OS-01</td>
            <td>$cal_informe</td>
        </tr>
        <tr>
            <td></td>
            <td>$obs_informe</td>
        </tr>
        <tr>
            <td>Acta de Inicio del Proyecto Productivo F32-PM-OS-01</td>
            <td>$cal_acta</td>
        </tr>
        <tr>
            <td>Folio matrícula inmobiliaria concepto</td>
            <td>$obs_acta</td>
        </tr>
       <tr>
            <td>Liquidación de los Gastos Notariales según Formato F30-OM-OS-01</td>
            <td>$cal_liq</td>
        </tr>
        <tr>
            <td></td>
            <td>$obs_liq</td>
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

        $UserProyect = new UserProyect();
        $UserProyect->recursive = 2;

        //Buscar información sobre la persona que tiene asignado el proyecto.
        $revisor2 = $UserProyect->find('first', array('conditions' => array('UserProyect.proyect_id' => $gasto['ExpenseNotarial']['proyect_id']), 'fields' => array('User.email'), 'order' => array('UserProyect.id' => 'DESC')));

        $Proyect2 = new Proyect();
        $Proyect2->recursive = -1;

        //Buscar información sobre el código del proyecto y el correo del director territorial
        $proyecto1 = $Proyect2->find('first', array('joins' => array(array('table' => 'branches', 'alias' => 'Branch', 'type' => 'left', 'conditions' => array('Branch.id=Proyect.branch_id'))), 'conditions' => array('Proyect.id' => $gasto['ExpenseNotarial']['proyect_id']), 'fields' => array('Proyect.codigo', 'Branch.email')));

//Buscando usuario responsable

        $revisor = $this->ProyectCheckList->User->find('first', array('recursive' => -1, 'conditions' => array('User.id' => $gasto['ProyectCheckList']['reviso']), 'fields' => array('User.email', 'User.nombre', 'User.primer_apellido')));
//director territorial
        $body.="<p>Encargado de adjuntar documentos:  " . $gasto['User']['nombre'] . " " . $gasto['User']['primer_apellido'] . " " . $gasto['User']['email'] . "</p>";
        $body.="<p>Encargado de la revisión de documentos:  " . $revisor['User']['nombre'] . " " . $revisor['User']['primer_apellido'] . " " . $revisor['User']['email'] . "</p>";

        if ($cal_total == "Cumple") {
            $pago = new Payment();
            $pago->recursive = -1;
            $valor_pago_notarial = $pago->field('Payment.monto', array('Payment.proyect_id' => $gasto['ExpenseNotarial']['proyect_id'], 'Payment.tipo' => "PROYECTO PRODUCTIVO"));
            $body.="<p>Valor: $" . number_format($valor_pago_notarial, 2, ',', '.') . "</p>";
        }

        $mail = new PHPMailer();

//Luego tenemos que iniciar la validación por SMTP: 
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPDebug = 1;
        $mail->Host = "ssl://smtp.gmail.com"; // SMTP a utilizar. Por ej. smtp.elserver.com 
        $mail->Username = "sitrural@gmail.com"; // Correo completo a utilizar 
        $mail->Password = "laropavieja.net.co"; // Contraseña 
        $mail->Port = 465; // Puerto a utilizar 
//Con estas pocas líneas iniciamos una conexión con el SMTP. Lo que ahora deberíamos hacer, es configurar el mensaje a enviar, el //From, etc. 
        $mail->From = "sitrural@gmail.com"; // Desde donde enviamos (Para mostrar) 
        $mail->FromName = "Soporte aplicativo tierras";

//Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo. 
// Esta es la dirección a donde enviamos 

        $mail->AddAddress($revisor2['User']['email']);
        $mail->AddAddress($proyecto1['Branch']['email']);
        $mail->AddAddress($gasto['User']['email']);
        $mail->AddAddress($revisor['User']['email']);
        $mail->AddAddress('lafonseca@incoder.gov.co');
        //$mail->AddAddress('blalvarez@incoder.gov.co');
        $mail->AddAddress('rgarzon@incoder.gov.co');
        $mail->AddAddress('drendon@incoder.gov.co');
        $mail->AddAddress('magaleano@incoder.gov.co');
        if ($cal_total == "Cumple") {
            $mail->AddAddress('ggarcia@incoder.gov.co');
        }
        $mail->IsHTML(true);
//$mail->IsHTML(true); // El correo se envía como HTML 
        $mail->Subject = utf8_decode("RESULTADO REVISIÓN DE DOCUMENTOS PARA PAGO DE PROYECTO PRODUCTIVO. " . $proyecto1['Proyect']['codigo'] . ""); // Este es el título del email. 

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

    public function print_certification($expense_id) {
        $this->layout = "ajax";

        $expense = $this->ProyectCheckList->find('first', array('recursive' => 2, 'conditions' => array('ProyectCheckList.id' => $expense_id), 'fields' => array('ProyectCheckList.id', 'ExpenseNotarial.proyect_id', 'ExpenseNotarial.bank_account_id', 'ProyectCheckList.valor', 'ProyectCheckList.saldo')));

        $this->set('proyecto', $this->ProyectCheckList->ExpenseNotarial->Proyect->find('first', array('recursive' => 0, 'conditions' => array('Proyect.id' => $expense['ExpenseNotarial']['proyect_id']), 'fields' => array('Proyect.codigo', 'Call.*'))));

        App::Import('model', 'Resolution');
        $Resolution = new Resolution();
        $resolucion = $Resolution->find('first', array('recursive' => -1, 'conditions' => array('Resolution.proyect_id' => $expense['ExpenseNotarial']['proyect_id']), 'fields' => array('Resolution.fecha', 'Resolution.numero', 'Resolution.final_evaluation_id'), 'order' => array('Resolution.id DESC')));
        $this->set('resolucion', $resolucion);

        App::Import('model', 'BankAccount');
        $BankAccount = new BankAccount();
        $cuenta = $BankAccount->find('first', array('recursive' => 0, 'conditions' => array('BankAccount.id' => $expense['ExpenseNotarial']['bank_account_id']), 'fields' => array('BankAccount.nombre_banco', 'BankAccount.numero_cuenta', 'BankAccount.sucursal', 'BankAccount.tipo_cuenta', 'BankAccount.candidate_id', 'Candidate.1er_nombre', 'Candidate.2do_apellido', 'Candidate.nro_ident', 'Candidate.1er_apellido', 'Candidate.city_id', 'Candidate.telefono', 'Candidate.direccion')));
        $this->set('cuenta', $cuenta);

        App::Import('model', 'City');
        $city = new City();
        $ciudadRepresentante = $city->find('first', array('fields' => array('City.name', 'City.departament_id'), 'recursive' => -1, 'conditions' => array('City.id' => $cuenta['Candidate']['city_id'])));
        $this->set('ciudadRepresentante', $ciudadRepresentante['City']['name']);

        App::Import('model', 'Departament');
        $departament = new Departament();
        $DepartamentoRepresentante = $departament->field('name', array('Departament.id' => $ciudadRepresentante['City']['departament_id']));
        $this->set('DepartamentoRepresentante', $DepartamentoRepresentante);

        if ($cuenta['BankAccount']['candidate_id'] == 0 or is_null($cuenta['BankAccount']['candidate_id'])) {
            App::Import('model', 'Proposer');
            $pr = new Proposer();
            $proponente = $pr->find('first', array('fields' => array('Proposer.*', 'City.name', 'Departament.name'), 'recursive' => -1, 'conditions' => array('Propser.proyect_id' => $expense['ExpenseNotarial']['proyect_id'])));
            $this->set('proponente', $proponente);
        }

        App::Import('model', 'Payment');
        $p = new Payment();

        $otrosPagos = $p->find('all', array('fields' => array('Payment.monto', 'Payment.tipo', 'Payment.fecha_pago_real', 'Payment.fecha_solicitud_desembolso'), 'recursive' => -1, 'conditions' => array('Payment.proyect_id' => $expense['ExpenseNotarial']['proyect_id'])));
        $this->set('otrosPagos', $otrosPagos);

        $pagoActual = $p->find('first', array('fields' => array('Payment.monto', 'Payment.tipo', 'Payment.fecha_pago_real', 'Payment.fecha_solicitud_desembolso'), 'recursive' => -1, 'conditions' => array('Payment.proyect_id' => $expense['ExpenseNotarial']['proyect_id'], 'Payment.tipo' => 'PROYECTO PRODUCTIVO')));
        $this->set('pagoActual', $pagoActual);

        App::Import('model', 'FinalEvaluation');
        $fe = new FinalEvaluation();
        $numeroBeneficiarios = $fe->field('FinalEvaluation.familias_habilitadas', array('FinalEvaluation.proyect_id' => $expense['ExpenseNotarial']['proyect_id']), 'FinalEvaluation.id DESC');
        $this->set('numeroBeneficiarios', $numeroBeneficiarios);

        App::Import('model', 'Candidate');
        $c = new Candidate();
        $beneficiarios = $c->find('all', array('fields' => array('Candidate.id', 'Candidate.nro_ident', 'Candidate.1er_nombre', 'Candidate.2do_nombre', 'Candidate.1er_apellido', 'Candidate.2do_apellido', 'City.name', 'Departament.name', 'Candidate.telefono', 'Candidate.direccion', 'Candidate.obligacion_numero', 'Candidate.cdp', 'Candidate.rp'), 'recursive' => 1, 'conditions' => array('Candidate.proyect_id' => $expense['ExpenseNotarial']['proyect_id'], 'Candidate.candidate_id' => 0, 'Candidate.resolucion_numero !=' => 0)));
        $this->set('beneficiarios', $beneficiarios);
    }

}

?>
