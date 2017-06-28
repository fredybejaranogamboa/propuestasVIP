<?php

App::uses('CakeEmail', 'Network/Email');

Class ResolutionsController extends AppController {

    public $name = 'Resolutions';

    public function index() {
        if ($this->RequestHandler->isAjax()) {
            $this->layout = "ajax";
        } else {
            $this->layout = "default";
        }
        $this->set('aleatorio', rand(1111, 9999999));
        $this->set("codigo", $this->Session->read('codigo'));
        $proyect_id = $this->Session->read('proyect_id');
        $this->set('proyect_id', $proyect_id);

        if ($proyect_id == "") {
            $this->Session->setFlash('No ha seleccionado Proyecto', 'flash_error');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        } else {
            $this->set('Resolutions', $this->Resolution->find('all', array('conditions' => array('Resolution.proyect_id' => $proyect_id), 'recursive' => -1, 'fields' => array('Resolution.*'))));
            $this->Resolution->Proyect->Evaluation->recursive = -1;
            $this->Resolution->Proyect->Payment->recursive = -1;
            $cal_evaluacion = $this->Resolution->Proyect->Evaluation->find('first', array('conditions' => array('Evaluation.proyect_id' => $proyect_id), 'fields' => array('Evaluation.calificacion_concepto_final'), 'order' => array('Evaluation.id' => 'DESC')));
            $cal_pago = $this->Resolution->Proyect->Payment->find('first', array('conditions' => array('Payment.proyect_id' => $proyect_id), 'fields' => array('Payment.calificacion_final'), 'order' => array('Payment.id' => 'DESC')));
            if ($cal_evaluacion['Evaluation']['calificacion_concepto_final'] == "Cumple" and $cal_pago['Payment']['calificacion_final'] != "Cumple") {
                $this->set('permitir', true);
            } else {
                $this->set('permitir', false);
            }
        }
    }

    public function add($proyect_id) {
        $this->layout = "ajax";
        $this->set('proyect_id', $proyect_id);

        if (!empty($this->data)) {

            if ($this->data['Resolution']['tipo'] != 'ADJUDICACIÓN') {
                $this->request->data['Resolution']['numero_acta'] = null;
                $this->request->data['Resolution']['fecha_acta'] = null;
                $this->request->data['Resolution']['numero_convenio'] = null;
                $this->request->data['Resolution']['fecha_convenio'] = null;
            }

            if ($this->Resolution->save($this->data)) {
                $last_id = $this->Resolution->getLastInsertId();
                $this->send($this->data['Resolution']['proyect_id'], 'add', $last_id, "");
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash');
                $this->redirect(array('controller' => 'Resolutions', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error Guardando datos', 'flash_error');
            }
        } else {
            $cont = $this->Resolution->find('count', array('conditions' => array('Resolution.tipo' => 'ADJUDICACIÓN', 'Resolution.proyect_id' => $proyect_id)));
            $this->set('cont', $cont);
        }
    }

    public function edit($resolution_id) {
        $this->layout = "ajax";
        $proyect_id = $this->Session->read('proyect_id');
        $this->set('resolution_id', $resolution_id);
        $this->Resolution->recursive = -1;

        if (empty($this->data)) {

            $cont = $this->Resolution->find('count', array('conditions' => array('Resolution.proyect_id' => $proyect_id), 'fields' => array('Resolution.*')));
            $this->set('cont', $cont);
            $this->data = $this->Resolution->find('first', array('conditions' => array('Resolution.id' => $resolution_id)));
            $this->Resolution->Proyect->Evaluation->recursive = -1;
            $this->Resolution->Proyect->Payment->recursive = -1;
            $cal_evaluacion = $this->Resolution->Proyect->Evaluation->find('first', array('conditions' => array('Evaluation.proyect_id' => $proyect_id), 'fields' => array('Evaluation.calificacion_concepto_final'), 'order' => array('Evaluation.id' => 'DESC')));
            $cal_pago = $this->Resolution->Proyect->Payment->find('first', array('conditions' => array('Payment.proyect_id' => $proyect_id), 'fields' => array('Payment.calificacion_final'), 'order' => array('Payment.id' => 'DESC')));
            if ($cal_evaluacion['Evaluation']['calificacion_concepto_final'] == "Cumple" and $cal_pago['Payment']['calificacion_final'] != "Cumple") {
                $this->set('permitir', true);
            } else {
                $this->set('permitir', false);
            }
        } else {

            if ($this->data['Resolution']['tipo'] != 'ADJUDICACIÓN') {
                $this->request->data['Resolution']['numero_acta'] = null;
                $this->request->data['Resolution']['fecha_acta'] = null;
                $this->request->data['Resolution']['numero_convenio'] = null;
                $this->request->data['Resolution']['fecha_convenio'] = null;
            }

            if ($this->Resolution->saveAll($this->data)) {
                $codigo = $this->Resolution->Proyect->field('codigo', array('Proyect.id' => $proyect_id));
                $rutaArchivo = APP . "webroot" . "/" . "files" . "/resoluciones";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }
                $nombreArchivo = "SoporteResolucion-$codigo-$resolution_id.pdf";
                $rutaArchivo.= "/" . $nombreArchivo;
                if (move_uploaded_file($this->data['Resolution']['archivo']['tmp_name'], $rutaArchivo)) {
                    $this->Resolution->id = $this->data['Resolution']['id'];
                    $this->send($this->data['Resolution']['proyect_id'], 'edit', $this->data['Resolution']['id'], " Archivo pdf cargado");
                    $this->Session->setFlash('Registro adicionado correctamente con archivo', 'flash');
                    $this->redirect(array('controller' => 'Resolutions', 'action' => 'index'));
                } else {
                    $this->send($this->data['Resolution']['proyect_id'], 'edit', $this->data['Resolution']['id'], " Archivo pdf no cargado");
                    $this->Session->setFlash('Registro Adicionado correctamente', 'flash');
                    $this->redirect(array('controller' => 'Resolutions', 'action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Error Guardando datos', 'flash_error');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            }
        }
    }

    public function print_letter($resolution_id) {
        $this->layout = "pdf";
        ini_set('max_execution_time', 600);
        $resolucion = $this->Resolution->find('first', array('conditions' => array('Resolution.id' => $resolution_id), 'fields' => array('Resolution.*', 'Proyect.codigo', 'Proyect.nombre', 'Proyect.departament_id', 'Proyect.branch_id', 'Proyect.tipo')));
        $this->set('resolucion', $resolucion);

        $this->Resolution->Proyect->Property->recursive = -1;
        $predios = $this->Resolution->Proyect->Property->find('all', array('conditions' => array('Property.proyect_id' => $resolucion['Resolution']['proyect_id']), 'fields' => array('Property.nombre', 'Property.tipo_tenencia', 'Property.oficina_matricula', 'Property.numero_matricula','City.name', 'Departament.name'), 'joins' => array(array('table' => 'cities', 'type' => 'left', 'alias' => 'City', 'conditions' => array('Property.city_id=City.id')), array('table' => 'departaments', 'type' => 'left', 'alias' => 'Departament', 'conditions' => 'Departament.id=City.departament_id'))));
        $this->set('predios', $predios);

        $this->Resolution->Proyect->Beneficiary->recursive = -1;
        $beneficiarios = $this->Resolution->Proyect->Beneficiary->find('all', array('conditions' => array('Beneficiary.proyect_id' => $resolucion['Resolution']['proyect_id'], 'Beneficiary.beneficiary_id' => 0), 'fields' => array('Beneficiary.tipo_identificacion', 'Beneficiary.numero_identificacion', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.tipo', 'Beneficiary.grupo', 'Beneficiary.id')));
        $this->set('beneficiarios', $beneficiarios);

        $totalFamiilias = $this->Resolution->Proyect->Beneficiary->find('count', array('recursive' => -1, 'conditions' => array('Beneficiary.proyect_id' => $resolucion['Resolution']['proyect_id'])));
        $this->set('totalFamiilias', $totalFamiilias);

        $departamento = $this->Resolution->Proyect->Departament->field('name', array('Departament.id' => $resolucion['Proyect']['departament_id']));
        $this->set('departamento', $departamento);

        $director = $this->Resolution->Proyect->Branch->field('director', array('Branch.id' => $resolucion['Proyect']['branch_id']));
        $this->set('director', $director);

        $capital = $this->Resolution->Proyect->Branch->field('capital', array('Branch.id' => $resolucion['Proyect']['branch_id']));
        $this->set('capital', $capital);

        $this->Resolution->Proyect->Asociation->recursive = -1;
        $asociaciones = $this->Resolution->Proyect->Asociation->find('all', array('conditions' => array('Asociation.proyect_id' => $resolucion['Resolution']['proyect_id']), 'fields' => array('Asociation.*')));
        $this->set('asociaciones', $asociaciones);

        $this->Resolution->Proyect->Evaluation->recursive = -1;
        $evaluacion = $this->Resolution->Proyect->Evaluation->find('first', array('conditions' => array('Evaluation.proyect_id' => $resolucion['Resolution']['proyect_id']), 'fields' => array('Evaluation.*'), 'order' => array('Evaluation.id' => 'DESC')));
        $this->set('evaluacion', $evaluacion);

        App::Import('model', 'Payment');
        $pa = new Payment();
        $pa->recursive = -1;
        $payment_id = $pa->field('id', array('Payment.proyect_id' => $resolucion['Resolution']['proyect_id']));

        App::Import('model', 'Certification');
        $p = new Certification();
        $p->recursive = -1;
        $this->set('certificaciones', $p->find('all', array('conditions' => array('Certification.payment_id' => $payment_id))));

        switch ($resolucion['Proyect']['tipo']) {
            case 'F':
                $this->render('familia');
                break;
            case 'A':
                $this->render('asociativo');
                break;
            case 'T':
                $this->render('territorial');
                break;
            case 'R':
                $this->render('resguardo');
                break;
            default:
                $this->redirect(array('controller' => 'Pages', 'action' => 'error', 'Opción no válida.'));
                break;
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
        $evaluacion = $this->Resolution->Proyect->InitialEvaluation->find('first', array('conditions' => array('InitialEvaluation.id' => $resolucion['Resolution']['final_evaluation_id']), 'fields' => array('InitialEvaluation.id', 'InitialEvaluation.familias_habilitadas')));
        App::Import('model', 'Candidate');
        $Candidate = new Candidate();
        $Candidate->recursive = -1;
        $aspirantes = $Candidate->find('all', array('conditions' => array('Candidate.proyect_id' => $resolucion['Proyect']['id'], 'Candidate.jerarquia !=' => 0, 'Candidate.estado_filtro' => array(1, 5), 'Candidate.renuncio' => 0), 'fields' => array('Candidate.id', 'Candidate.tipo_ident', 'Candidate.nro_ident', 'Candidate.1er_apellido', 'Candidate.2do_apellido', 'Candidate.1er_nombre', 'Candidate.2do_nombre', 'Candidate.jerarquia', 'Candidate.telefono', 'Candidate.direccion'), 'order' => array('Candidate.jerarquia ASC')));

        $this->set('resolucion', $resolucion);
        $this->set('aspirantes', $aspirantes);
        $this->set('evaluacion', $evaluacion);
    }

    public function delete($id, $proyect_id) {
        $this->layout = "ajax";
        if ($this->Resolution->delete($id)) {
            $this->send($proyect_id, 'delete', $id, "");
            $this->Session->setFlash('Registro eliminado correctamente', 'flash');
            $this->redirect(array('controller' => 'Resolutions', 'action' => 'index'));
        } else {
            $this->Session->setFlash('Error eliminando datos', 'flash_error');
        }
    }

    private function send($proyect_id, $tipo, $resolution_id, $observaciones) {
        App::Import('model', 'UserProyect');
        App::Import('model', 'BranchUser');
        App::Import('model', 'Proyect');
        App::Import('model', 'User');

        $up = new UserProyect();
        $correos_asignados = $up->find('all', ['fields' => ['User.email'], 'recursive' => 1, 'conditions' => ['UserProyect.proyect_id' => $proyect_id]]);

        $p = new Proyect();
        $proyect = $p->find('first', array('fields' => array('Proyect.branch_id', 'Proyect.codigo'), 'recursive' => -1, 'conditions' => array('Proyect.id' => $proyect_id)));

        $bu = new BranchUser();
        $correos_supervisores = $bu->find('all', ['fields' => ['User.email'], 'recursive' => 1, 'conditions' => ['BranchUser.branch_id' => $proyect['Proyect']['branch_id']]]);

        $u = new User();
        $usuario_actual = $u->find('first', array('fields' => array('User.nombre', 'User.primer_apellido', 'User.segundo_apellido', 'User.email'), 'recursive' => -1, 'conditions' => array('User.id' => $this->Auth->user('id'))));

        $Email = new CakeEmail('gmail');
        $Email->from(array('pdret.soporte@gmail.com' => 'Aplicativo PDRET'));

        foreach ($correos_asignados as $correo_asignado) {
            $Email->addTo($correo_asignado['User']['email']);
        }
        foreach ($correos_supervisores as $correo_supervisor) {
            $Email->addTo($correo_supervisor['User']['email']);
        }
        $Email->addTo($usuario_actual['User']['email']);

        $resolucion = $this->Resolution->find('first', array('fields' => array('Resolution.*'), 'recursive' => -1, 'conditions' => array('Resolution.id' => $resolution_id)));

        $body = "";
        $subject = "";
        switch ($tipo) {
            case 'add':
                $subject = "Adición de resolución " . $resolucion['Resolution']['tipo'] . " proyecto " . $proyect['Proyect']['codigo'];
                $body = "<p>Se ha agregado una resolución al proyecto " . $proyect['Proyect']['codigo'] . " por parte del usuario"
                        . "<br>" . $usuario_actual['User']['nombre'] . " " . $usuario_actual['User']['primer_apellido'] . " " . $usuario_actual['User']['segundo_apellido']
                        . "<br>Número " . $resolucion['Resolution']['numero'] . " Fecha " . $resolucion['Resolution']['fecha']
                        . "<br>Revisó " . $resolucion['Resolution']['reviso'] . " - Proyectó " . $resolucion['Resolution']['proyecto']
                        . "<br>Comentario: " . $resolucion['Resolution']['comentario']
                        . "<br>" . $observaciones
                        . "</p>";
                break;
            case 'delete':
                $subject = "Eliminación de resolución " . $resolucion['Resolution']['tipo'] . "proyecto " . $proyect['Proyect']['codigo'];
                $body = "<p>Se ha eliminado la resolución del proyecto " . $proyect['Proyect']['codigo'] . " por parte del usuario"
                        . "<br>" . $usuario_actual['User']['nombre'] . " " . $usuario_actual['User']['primer_apellido'] . " " . $usuario_actual['User']['segundo_apellido']
                        . "</p>";
                break;
            case 'edit':
                $subject = "Modificación de resolución " . $resolucion['Resolution']['tipo'] . " proyecto " . $proyect['Proyect']['codigo'];
                $body = "<p>Se ha modificado la resolución del proyecto " . $proyect['Proyect']['codigo'] . " por parte del usuario"
                        . "<br>" . $usuario_actual['User']['nombre'] . " " . $usuario_actual['User']['primer_apellido'] . " " . $usuario_actual['User']['segundo_apellido']
                        . "<br>Número " . $resolucion['Resolution']['numero'] . " Fecha " . $resolucion['Resolution']['fecha']
                        . "<br>Revisó " . $resolucion['Resolution']['reviso'] . " - Proyectó " . $resolucion['Resolution']['proyecto']
                        . "<br>Comentario: " . $resolucion['Resolution']['comentario']
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
