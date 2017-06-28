<?php

Class CertificationsController extends AppController {

    public $name = 'Certifications';

    public function add($payment_id) {
        $this->layout = "ajax";
        $this->set('user_id', $this->Auth->user('id'));
        $this->set('payment_id', $payment_id);
        date_default_timezone_set("America/Bogota");
        $this->set('fecha', date("Y-m-d"));
        if (!empty($this->data)) {
            if ($this->Certification->saveAll($this->data)) {
                $this->Session->setFlash('Datos guardados correctamente', 'flash');
                $this->redirect(array('controller' => 'Certifications', 'action' => 'index', $this->data['Certification']['payment_id']));
            } else {
                $this->Session->setFlash('Error guardando los datos', 'flash');
                $this->redirect(array('controller' => 'pages', 'action' => 'display'));
            }
        } else {
            $pago = $this->Certification->Payment->find('first', array('recursive' => -1, 'fields' => array('Payment.id', 'Payment.proyect_id', 'Payment.nombre_banco', 'Payment.numero_cuenta', 'Payment.observacion_calificacion'), 'conditions' => array('Payment.id' => $payment_id)));
            $this->set('pago', $pago);

            App::Import('model', 'Evaluation');
            $e = new Evaluation();
            $evaluacion = $e->find('first', array('recursive' => -1, 'conditions' => array('Evaluation.proyect_id' => $pago['Payment']['proyect_id']), 'fields' => array('Evaluation.*'), 'order' => array('Evaluation.id' => 'DESC')));
            $this->set('evaluacion', $evaluacion);
        }
    }

    public function edit($id) {
        $this->layout = "ajax";
        $this->Certification->recursive = -1;
        if (empty($this->data)) {
            $this->set('user_id', $this->Auth->user('id'));
            $this->data = $this->Certification->find('first', array('conditions' => array('Certification.id' => $id), 'fields' => array('Certification.*')));

            $pago = $this->Certification->Payment->find('first', array('recursive' => -1, 'fields' => array('Payment.id', 'Payment.proyect_id', 'Payment.nombre_banco', 'Payment.numero_cuenta', 'Payment.observacion_calificacion'), 'conditions' => array('Payment.id' => $this->data['Certification']['payment_id'])));
            $this->set('pago', $pago);

            App::Import('model', 'Evaluation');
            $e = new Evaluation();
            $evaluacion = $e->find('first', array('recursive' => -1, 'conditions' => array('Evaluation.proyect_id' => $pago['Payment']['proyect_id']), 'fields' => array('Evaluation.*'), 'order' => array('Evaluation.id' => 'DESC')));
            $this->set('evaluacion', $evaluacion);
        } else {
            if ($this->Certification->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash');
                $this->redirect(array('controller' => 'Certifications', 'action' => 'index', $this->data['Certification']['payment_id']));
            } else {
                $this->Session->setFlash('Error editando datos', 'flash_error');
            }
        }
    }

    public function index($payment_id) {
        if (!$this->RequestHandler->isAjax()) {
            $this->layout = "default";
        } else {
            $this->layout = "ajax";
        }

        $this->set('payment_id', $payment_id);
        $this->paginate = array('Certification' => array('maxLimit' => 500, 'limit' => 50, 'recursive' => 0, 'fields' => array('Certification.*', 'User.*')));
        $this->set('Certifications', $this->paginate(array('Certification.payment_id' => $payment_id)));
    }

    public function delete($id, $payment_id) {
        if ($this->Certification->delete($id)) {
            $this->Session->setFlash('Certificación eliminada correctamente', 'flash');
            $this->redirect(array('controller' => 'Certifications', 'action' => 'index', $payment_id));
        } else {
            $this->Session->setFlash('Error borrando datos', 'flash_error');
            $this->redirect(array('controller' => 'pages', 'action' => 'display'));
        }
    }

    public function pdf($id) {
        $this->layout = "pdf";

        $pago = $this->Certification->find('first', array('recursive' => 0, 'conditions' => array('Certification.id' => $id), 'fields' => array('Certification.*', 'Payment.*')));
        $this->set('proyecto', $this->Certification->Payment->Proyect->find('first', array('recursive' => 0, 'conditions' => array('Proyect.id' => $pago['Payment']['proyect_id']), 'fields' => array('Proyect.codigo', 'Call.*', 'Proyect.tipo'))));
        $this->set('pago', $pago);

        App::Import('model', 'Resolution');
        $Resolution = new Resolution();
        $resolucion = $Resolution->find('first', array('recursive' => -1, 'conditions' => array('Resolution.proyect_id' => $pago['Payment']['proyect_id'], 'Resolution.tipo' => 'ADJUDICACIÓN'), 'fields' => array('Resolution.*'), 'order' => array('Resolution.id ASC')));
        $this->set('resolucion', $resolucion);

        App::Import('model', 'Beneficiary');
        $b = new Beneficiary();
        $representante = $b->find('first', array('recursive' => 0, 'conditions' => array('Beneficiary.id' => $pago['Payment']['beneficiary_id']), 'fields' => array('Beneficiary.*', 'City.name', 'City.departament_id')));
        $this->set('representante', $representante);
        
        App::Import('model', 'Asociation');
        $a= new Asociation();
        $asociacion = $a->find('first', array('recursive' => -1, 'conditions' => array('Asociation.id' => $pago['Payment']['asociation_id']), 'fields' => array('Asociation.*')));
        $this->set('asociacion', $asociacion);

        App::Import('model', 'Departament');
        $d = new Departament();
        $this->set('departamento', $d->field('name', array('Departament.id' => $representante['City']['departament_id'])));

        $pagosAnteriores = $this->Certification->field('Sum(Certification.valor)', array('Certification.id <' => $id, 'Certification.payment_id' => $pago['Payment']['id']));
        $this->set('pagosAnteriores', $pagosAnteriores);

        App::Import('model', 'Evaluation');
        $e = new Evaluation();
        $evaluacion = $e->find('first', array('recursive' => -1, 'conditions' => array('Evaluation.proyect_id' => $pago['Payment']['proyect_id']), 'fields' => array('Evaluation.*'), 'order' => array('Evaluation.id' => 'DESC')));
        $this->set('evaluacion', $evaluacion);
    }
    
        public function report($option) {
        $this->layout = "ajax";
        ini_set('max_execution_time', 600);
        $results = $this->Certification->query('CALL certificationsReport()');
//        var_dump($results); exit;
        
        $this->set('certifications', $results);
        
    }

}

?>