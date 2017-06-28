<?php

Class ResolutionsController extends AppController {

    public $name = 'Resolutions';
    var $components = array('RequestHandler');
    var $helpers = array('Js' => array('jquery'));

    public function index() {
        if ($this->RequestHandler->isAjax()) {
            $this->layout = "ajax";
        } else {
            $this->layout = "default";
        }
        $this->set("codigo", $this->Session->read('cod'));
        $proyect_id = $this->Session->read('proy_id');
        $this->set('proyect_id', $proyect_id);

        App::Import('model', 'FinalEvaluation');
        $evaluacionFinal = new FinalEvaluation();

        $calificacion_faseIIB = $evaluacionFinal->field('FinalEvaluation.calificacion_elegibilidad_integral', array('FinalEvaluation.proyect_id' => $proyect_id), 'FinalEvaluation.id DESC');
        if ($calificacion_faseIIB == 'Sin registro' or $calificacion_faseIIB == 'No elegible') {
            $this->Session->setFlash('Este proyecto no superó fase IIB.', 'flash_custom');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        }

        if ($proyect_id == "") {
            $this->Session->setFlash('No ha seleccionado Proyecto');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        } else {
            $this->paginate = array('Resolution' => array('maxLimit' => 20, 'limit' => 20, 'fields' => array('Resolution.id', 'Resolution.fecha', 'Resolution.numero')));
            $this->set('Resolutions', $this->paginate(array('Resolution.proyect_id' => $proyect_id)));
        }
    }

    public function add($proyect_id) {
        $this->set('proyect_id', $proyect_id);
        if (empty($this->data)) {

            $this->Resolution->Proyect->FinalEvaluation->recursive = -1;
            if ($evaluation = $this->Resolution->Proyect->FinalEvaluation->find('first', array('conditions' => array('FinalEvaluation.proyect_id' => $proyect_id), 'order' => array('FinalEvaluation.id DESC'), 'fields' => array('FinalEvaluation.familias_habilitadas', 'FinalEvaluation.id', 'FinalEvaluation.calificacion_elegibilidad_integral')))) {
                if ($evaluation['FinalEvaluation']['calificacion_elegibilidad_integral'] == "Elegible") {

                    $condicionamientos = $this->Resolution->Proyect->FinalEvaluation->EvaluationConstraint->find('count', array('conditions' => array('final_evaluation_id' => $evaluation['FinalEvaluation']['id'], 'EvaluationConstraint.calificacion != ' => 'LEVANTADO')));
                    if ($condicionamientos > 0) {
                        $this->Session->setFlash("Este proyecto tiene condicionamientos sin levantar ");
                        $this->redirect(array('controller' => 'Resolutions', 'action' => 'index'));
                    }
                    $this->data['Resolution']['final_evaluation_id'] = $evaluation['FinalEvaluation']['id'];
                } else {
                    $this->Session->setFlash('Este proyecto no ha sido calificado como elegible');
                    $this->redirect(array('controller' => 'Resolutions', 'action' => 'index'));
                }
            } else {
                $this->Session->setFlash('No se ha realizado evaluación final a este proyecto');
                $this->redirect(array('controller' => 'Resolutions', 'action' => 'index'));
            }
        } else {
            App::Import('model', 'Payment');
            App::Import('model', 'FinalEvaluation');
            App::Import('model', 'Call');

            $pago = new Payment();

            $evaluacion_final = new FinalEvaluation();

            $valores_evaluacion_final = $evaluacion_final->find('first', array('conditions' => array('FinalEvaluation.id' => $this->data['Resolution']['final_evaluation_id']), 'fields' => array('FinalEvaluation.familias_habilitadas', 'FinalEvaluation.subsidio_proyecto_real', 'FinalEvaluation.subsidio_predios_real', 'FinalEvaluation.proyect_id')));

            $call_id = $evaluacion_final->Proyect->find('first', array('conditions' => array('Proyect.id' => $valores_evaluacion_final['FinalEvaluation']['proyect_id']), 'fields' => array('Proyect.call_id')));

            $c = new Call();

            $valor_smlv = $c->find('first', array('conditions' => array('Call.id' => $call_id['Proyect']['call_id']), 'fields' => array('Call.valor_smmv')));

            $valor_notarial = $valor_smlv['Call']['valor_smmv'] * $valores_evaluacion_final['FinalEvaluation']['familias_habilitadas'];

            $notarial = array(
                'Payment' => array(
                    'proyect_id' => $valores_evaluacion_final['FinalEvaluation']['proyect_id'],
                    'monto' => $valor_notarial,
                    'tipo' => 'GASTOS NOTARIALES',
                    'fecha_pago_programado' => date("Y-m-d")
                )
            );

            $pago->saveAll($notarial);

            $predio = array(
                'Payment' => array(
                    'proyect_id' => $valores_evaluacion_final['FinalEvaluation']['proyect_id'],
                    'monto' => $valores_evaluacion_final['FinalEvaluation']['subsidio_predios_real'],
                    'tipo' => 'DESEMBOLSO PREDIO',
                    'fecha_pago_programado' => date("Y-m-d")
                )
            );

            $pago->saveAll($predio);

            $proyecto_productivo = array(
                'Payment' => array(
                    'proyect_id' => $valores_evaluacion_final['FinalEvaluation']['proyect_id'],
                    'monto' => $valores_evaluacion_final['FinalEvaluation']['subsidio_proyecto_real'],
                    'tipo' => 'PROYECTO PRODUCTIVO',
                    'fecha_pago_programado' => date("Y-m-d")
                )
            );

            $pago->saveAll($proyecto_productivo);

            if ($this->Resolution->saveAll($this->data)) {

                App::import('Vendor', 'ClassPhpmailer', array('file' => 'phpmailer/class.phpmailer.php'));
                $body = "<p>Se ha creado la resolución con los siguientes datos:<br>Código:" . $this->Session->read('cod') . " Número: " . $this->data['Resolution']['numero'] . "<br>Proyectó: " . $this->data['Resolution']['proyecto'] . "<br>Revisó: " . $this->data['Resolution']['reviso'] . "</p>";
                $mail = new PHPMailer();

                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->Host = "ssl://smtp.gmail.com"; // SMTP a utilizar. Por ej. smtp.elserver.com 
                $mail->Username = "sitrural@gmail.com"; // Correo completo a utilizar 
                $mail->Password = "laropavieja.net.co"; // Contraseña 
                $mail->Port = 465; // Puerto a utilizar 
                $mail->From = "sitrural@gmail.com"; // Desde donde enviamos (Para mostrar) 
                $mail->FromName = "Soporte aplicativo tierras";

                $mail->AddAddress('jrevelo@incoder.gov.co');
                $mail->AddAddress('rgarzon@incoder.gov.co');
                $mail->AddAddress('drendon@incoder.gov.co');
                $mail->AddAddress('magaleano@incoder.gov.co');
                //$mail->AddAddress('lafonseca@incoder.gov.co');
                //$mail->AddAddress('jneira@incoder.gov.co');
                //$mail->AddAddress('blalvarez@incoder.gov.co');
                //$mail->AddAddress('earizah@gmail.com');
                //$mail->AddAddress('ogomez@incoder.gov.co');

                $mail->IsHTML(true);
                $mail->Subject = utf8_decode("SE HA CREADO RESOLUCIÓN PARA EL PROYECTO " . $this->Session->read('cod')); // Este es el titulo del email. 

                $mail->Body = utf8_decode($body); // Mensaje a enviar 

                $exito = $mail->Send(); // Envía el correo.
                if ($exito) {

                    $this->Session->setFlash('Registro creado correctamente', 'flash_custom');
                } else {
                    $this->Session->setFlash("Error :  " . $mail->ErrorInfo);
                    $this->redirect(array('controller' => 'Resolutions', 'action' => 'index'));
                }
                $this->Session->setFlash('Registro Adicionado correctamente');
                $this->redirect(array('controller' => 'Resolutions', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    public function edit($resolution_id) {
        App::Import('model', 'UserProyect');
        $proyect_id = $this->Session->read('proy_id');
        $this->set('resolution_id', $resolution_id);
        $this->Resolution->recursive = -1;

        $codigo = $this->Resolution->Proyect->field('codigo', array('Proyect.id' => $proyect_id));

        if (empty($this->data)) {
            $this->data = $this->Resolution->find('first', array('conditions' => array('Resolution.id' => $resolution_id)));
        } else {

            if ($this->Resolution->saveAll($this->data)) {

                if (stristr($this->data['Resolution']['archivo']['name'], ".pdf")) {

                    $codigo = $this->Session->read('cod');
                    $rutaArchivo = APP . "webroot" . "/" . "files" . "/" . $codigo;
                    if (!is_dir($rutaArchivo)) {
                        if (!mkdir($rutaArchivo)) {
                            echo "error creando archivo";
                            //redirect
                        }
                    }
                    $nombreArchivo = "SoporteResolucion-$codigo-$resolution_id.pdf";
                    $rutaArchivo.= "/" . $nombreArchivo;
                    if (move_uploaded_file($this->data['Resolution']['archivo']['tmp_name'], $rutaArchivo)) {
                        $UserProyect = new UserProyect();

                        $responsable = $UserProyect->find('first', array('conditions' => array('UserProyect.proyect_id' => $proyect_id), 'fields' => array('User.email', 'User.nombre', 'User.primer_apellido', 'User.segundo_apellido'), 'order' => array('UserProyect.id' => 'DESC')));


                        //Se envia un correo informando que se cargo la resolución escaneada
                        App::import('Vendor', 'ClassPhpmailer', array('file' => 'phpmailer/class.phpmailer.php'));
                        $body = "<p>Se ha cargado el archivo de la resolución del proyecto <br/>
                            Código:" . $this->Session->read('cod') . " Número: " . $this->data['Resolution']['numero'] . "<br/>
                            Proyectó: " . $this->data['Resolution']['proyecto'] . "<br/>
                            Revisó: " . $this->data['Resolution']['reviso'] . "<br/>
                            Asignado a:" . $responsable['User']['nombre'] . " " . $responsable['User']['primer_apellido'] . " " . $responsable['User']['segundo_apellido'] . " " . $responsable['User']['email'] . "</p>";
                        $mail = new PHPMailer();

                        $mail->IsSMTP();
                        $mail->SMTPAuth = true;
                        $mail->Host = "ssl://smtp.gmail.com"; // SMTP a utilizar. Por ej. smtp.elserver.com 
                        $mail->Username = "sitrural@gmail.com"; // Correo completo a utilizar 
                        $mail->Password = "laropavieja.net.co"; // Contraseña 
                        $mail->Port = 465; // Puerto a utilizar 
                        $mail->From = "sitrural@gmail.com"; // Desde donde enviamos (Para mostrar) 
                        $mail->FromName = "Soporte aplicativo tierras";

                        $mail->AddAddress('jrevelo@incoder.gov.co');
                        $mail->AddAddress('rgarzon@incoder.gov.co');
                        $mail->AddAddress('lafonseca@incoder.gov.co');
                        $mail->AddAddress('drendon@incoder.gov.co');
                        $mail->AddAddress('magaleano@incoder.gov.co');
                        //$mail->AddAddress('jneira@incoder.gov.co');
                        //$mail->AddAddress('blalvarez@incoder.gov.co');
                        //$mail->AddAddress('earizah@gmail.com');
                        //$mail->AddAddress('ogomez@incoder.gov.co');

                        $mail->AddAddress($responsable['User']['email']);
                        $mail->IsHTML(true);
                        $mail->Subject = utf8_decode("SE HA CARGADO EL ARCHIVO DE LA RESOLUCIÓN PARA EL PROYECTO " . $this->Session->read('cod')); // Este es el titulo del email. 

                        $mail->Body = utf8_decode($body); // Mensaje a enviar 

                        $mail->Send(); // Envía el correo.

                        $this->Resolution->id = $this->data['Resolution']['id'];
                        $this->Resolution->saveField('adjunto', 1);
                        $this->Session->setFlash('Registro Adicionado correctamente con archivo', 'flash_custom');
                        $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
                    }
                }
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            } else {
                $this->Session->setFlash('Error Guardando datos', 'flash_custom');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            }
        }
    }

    public function print_letter($resolution_id) {
        $this->layout = "ajax";
        $proyect_id = $this->Session->read('proy_id');
        $this->set('proyect_id', $proyect_id);

        $options = array();
        $options['joins'] = array(
            array(
                'table' => 'proyects',
                'type' => 'left',
                'alias' => 'Proyect',
                'conditions' => array('Proyect.id=Resolution.proyect_id'),
            ),
            array(
                'table' => 'calls',
                'type' => 'left',
                'alias' => 'Call',
                'conditions' => array('Call.id=Proyect.call_id'),
            ),
            array(
                'table' => 'branches',
                'type' => 'left',
                'alias' => 'Branch',
                'conditions' => array('Branch.id=Proyect.branch_id'),
            ),
            array(
                'table' => 'cities',
                'type' => 'left',
                'alias' => 'City',
                'conditions' => array('City.id=Proyect.city_id'),
            )
            ,
            array(
                'table' => 'departaments',
                'type' => 'left',
                'alias' => 'Departament',
                'conditions' => array('City.departament_id=Departament.id'),
            )
        );
        $options['conditions'] = array('Resolution.id' => $resolution_id);
        $options['fields'] = array('Departament.capital', 'Resolution.reviso', 'Resolution.final_evaluation_id', 'Resolution.proyecto', 'Departament.name', 'City.name', 'Branch.director', 'Proyect.codigo', 'Proyect.id', 'Resolution.id', 'Resolution.fecha', 'Resolution.numero', 'Resolution.final_evaluation_id', 'Call.nombre', 'Branch.nombre');
        $this->Resolution->recursive = -1;
        $resolucion = $this->Resolution->find('first', $options);

        $condicionamientos = $this->Resolution->Proyect->FinalEvaluation->EvaluationConstraint->find('count', array('conditions' => array('final_evaluation_id' => $resolucion['Resolution']['final_evaluation_id'], 'EvaluationConstraint.calificacion != ' => 'LEVANTADO')));
        $condicionadoArea = false;

        if ($condicionamientos > 0) {
            $this->Session->setFlash("Este proyecto tiene condicionamientos sin levantar ");
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        } else {
            $conteo = $this->Resolution->Proyect->FinalEvaluation->EvaluationConstraint->find('count', array('conditions' => array('final_evaluation_id' => $resolucion['Resolution']['final_evaluation_id'], 'Constraint.id' => 4)));
            if ($conteo > 0) {
                $condicionadoArea = true;
            }
            $this->Resolution->Proyect->Property->recursive = -1;
            $predios = $this->Resolution->Proyect->Property->find('all', array('conditions' => array('Property.proyect_id' => $proyect_id), 'fields' => array('Property.*', 'City.name', 'Departament.name'), 'joins' => array(array('table' => 'cities', 'type' => 'left', 'alias' => 'City', 'conditions' => array('Property.city_id=City.id')), array('table' => 'departaments', 'type' => 'left', 'alias' => 'Departament', 'conditions' => 'Departament.id=City.departament_id'))));
            $this->Resolution->Proyect->FinalEvaluation->recursive = -1;
            $evaluacion = $this->Resolution->Proyect->FinalEvaluation->find('first', array('conditions' => array('FinalEvaluation.id' => $resolucion['Resolution']['final_evaluation_id']), 'fields' => array('FinalEvaluation.id', 'FinalEvaluation.calificacion_elegibilidad_integral', 'FinalEvaluation.familias_habilitadas', 'FinalEvaluation.nombre_proyecto', 'FinalEvaluation.subsidio_proyecto_real', 'FinalEvaluation.subsidio_predios_real'), 'order' => array('FinalEvaluation.id DESC')));
            $this->set('predios', $predios);
            $this->set('resolucion', $resolucion);
            $this->set('evaluacion', $evaluacion);
            $this->set('condicionadoArea', $condicionadoArea);
        }
    }

    public function comunication_letter($resolution_id) {
        $this->layout = 'pdf';

        $options = array();
        $options['joins'] = array(
            array(
                'table' => 'proyects',
                'type' => 'left',
                'alias' => 'Proyect',
                'conditions' => array('Proyect.id=Resolution.proyect_id'),
            ),
            array(
                'table' => 'calls',
                'type' => 'left',
                'alias' => 'Call',
                'conditions' => array('Call.id=Proyect.call_id'),
            ),
            array(
                'table' => 'branches',
                'type' => 'left',
                'alias' => 'Branch',
                'conditions' => array('Branch.id=Proyect.branch_id'),
            ),
            array(
                'table' => 'cities',
                'type' => 'left',
                'alias' => 'City',
                'conditions' => array('City.id=Proyect.city_id'),
            )
            ,
            array(
                'table' => 'departaments',
                'type' => 'left',
                'alias' => 'Departament',
                'conditions' => array('City.departament_id=Departament.id'),
            )
        );
        $options['conditions'] = array('Resolution.id' => $resolution_id);
        $options['fields'] = array('Departament.capital', 'Resolution.numero', 'Resolution.fecha', 'Resolution.final_evaluation_id', 'Departament.name', 'City.name', 'Branch.director', 'Branch.direccion', 'Proyect.codigo', 'Proyect.id', 'Resolution.id', 'Resolution.final_evaluation_id', 'Call.nombre', 'Branch.nombre', 'Branch.director');
        $this->Resolution->recursive = -1;
        $resolucion = $this->Resolution->find('first', $options);
        $evaluacion = $this->Resolution->Proyect->FinalEvaluation->find('first', array('conditions' => array('FinalEvaluation.id' => $resolucion['Resolution']['final_evaluation_id']), 'fields' => array('FinalEvaluation.id', 'FinalEvaluation.familias_habilitadas')));
        App::Import('model', 'Candidate');
        $Candidate = new Candidate();
        $Candidate->recursive = -1;
        $aspirantes = $Candidate->find('all', array('conditions' => array('Candidate.proyect_id' => $resolucion['Proyect']['id'], 'Candidate.jerarquia !=' => 0, 'Candidate.estado_filtro' => array(1, 5), 'Candidate.renuncio' => 0), 'fields' => array('Candidate.id', 'Candidate.tipo_ident', 'Candidate.nro_ident', 'Candidate.1er_apellido', 'Candidate.2do_apellido', 'Candidate.1er_nombre', 'Candidate.2do_nombre', 'Candidate.jerarquia', 'Candidate.telefono', 'Candidate.direccion'), 'order' => array('Candidate.jerarquia ASC')));

        $this->set('resolucion', $resolucion);
        $this->set('aspirantes', $aspirantes);
        $this->set('evaluacion', $evaluacion);
    }

}

?>