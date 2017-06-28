<?php

Class FamiliesController extends AppController {

    public $name = 'Families';

    public function add($beneficiary_id) {
        $this->set('beneficiary_id', $beneficiary_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->Family->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash');
                $this->redirect(array('controller' => 'Families', 'action' => 'baseline_index', $beneficiary_id));
            } else {
                $this->Session->setFlash('Error Guardando datos', 'flash_error');
            }
        }
    }

    public function edit($id) {
        $this->Family->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Family->find('first', array('conditions' => array('Family.id' => $id)));
        } else {

            if ($this->Family->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash');
                $this->redirect(array('controller' => 'Families', 'action' => 'baseline_index', $this->data['Family']['beneficiary_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function index($beneficiary_id, $property_id, $permitir= true) {
        $this->set('beneficiary_id', $beneficiary_id);
        $this->set('property_id', $property_id);
        if ($permitir == 0) {
            $this->set('permitir', false);
        } else {
            $this->set('permitir', true);
        }
        $this->set('aleatorio', rand(1111, 9999999));
        //$this->paginate = array('Family' => array('recursive' => -1, 'maxLimit' => 500, 'limit' => 50, 'fields' => array('Family.tipo_identificacion', 'Family.numero_identificacion', 'Family.nombres', 'Family.primer_apellido', 'Family.segundo_apellido', 'Family.id', 'Family.parentesco')));
        $this->set('families', $this->Family->find("all", array('recursive' => -1, "conditions" => array("Family.beneficiary_id" => $beneficiary_id))));
        $this->Family->Beneficiary->recursive = -1;
        $ben = $this->Family->Beneficiary->find('all', array('recursive' => -1, 'conditions' => array('Beneficiary.beneficiary_id' => $beneficiary_id)));
        $this->set('conteo', count($ben));
        $this->set('codigo', $this->Session->read('codigo'));

        $this->set('candidates', $ben);
        $nom = $this->Family->Beneficiary->field('nombres', array('id' => $beneficiary_id));
        $apel1 = $this->Family->Beneficiary->field('primer_apellido', array('id' => $beneficiary_id));
        $apel2 = $this->Family->Beneficiary->field('segundo_apellido', array('id' => $beneficiary_id));

        $this->set('nombre', "$nom $apel1 $apel2");
    }

    public function baseline_index($beneficiary_id) {
        $this->set('beneficiary_id', $beneficiary_id);
        $this->set('families', $this->Family->find("all", array('recursive' => -1, "conditions" => array('Family.activo' => 1, "Family.beneficiary_id" => $beneficiary_id))));
        $this->Family->Beneficiary->recursive = -1;
        $ben = $this->Family->Beneficiary->find('all', array('recursive' => -1, 'conditions' => array('Beneficiary.beneficiary_id' => $beneficiary_id)));
        $this->set('conteo', count($ben));
        $this->set('codigo', $this->Session->read('codigo'));

        $this->set('candidates', $ben);
        $nom = $this->Family->Beneficiary->field('nombres', array('id' => $beneficiary_id));
        $apel1 = $this->Family->Beneficiary->field('primer_apellido', array('id' => $beneficiary_id));
        $apel2 = $this->Family->Beneficiary->field('segundo_apellido', array('id' => $beneficiary_id));

        $this->set('nombre', "$nom $apel1 $apel2");
    }

    public function poll_index($beneficiary_id) {
        $this->set('beneficiary_id', $beneficiary_id);

        $this->set('families', $this->Family->find("all", array('recursive' => -1, "conditions" => array("Family.beneficiary_id" => $beneficiary_id))));
        $this->Family->Beneficiary->recursive = -1;
        $ben = $this->Family->Beneficiary->find('all', array('recursive' => -1, 'conditions' => array('Beneficiary.beneficiary_id' => $beneficiary_id)));
        $Beneficiario = $this->Family->Beneficiary->find('first', array('recursive' => -1, 'conditions' => array('Beneficiary.id' => $beneficiary_id), 'fields' => array('Beneficiary.property_id')));
        $this->set('conteo', count($ben));
        $this->set('property_id', $Beneficiario['Beneficiary']['property_id']);
        $this->set('codigo', $this->Session->read('codigo'));

        $this->set('candidates', $ben);
        $nom = $this->Family->Beneficiary->field('nombres', array('id' => $beneficiary_id));
        $apel1 = $this->Family->Beneficiary->field('primer_apellido', array('id' => $beneficiary_id));
        $apel2 = $this->Family->Beneficiary->field('segundo_apellido', array('id' => $beneficiary_id));

        $this->set('nombre', "$nom $apel1 $apel2");
    }

    public function delete($family_id, $beneficiary_id) {
//        $datos = array('Family' => array(
//                'id' => $family_id,
//                'sincronizado' => 0,
//                'activo' => 0
//                ));
//        if ($this->Family->save($datos)) {
//            $this->Session->setFlash('Registro borrado correctamente', 'flash');
//            $this->redirect(array('controller' => 'Families', 'action' => 'baseline_index', $beneficiary_id));
//        }
        if ($this->Family->delete($family_id)) {
            $this->Session->setFlash('Registro borrado correctamente', 'flash');
            $this->redirect(array('controller' => 'Families', 'action' => 'baseline_index', $beneficiary_id));
        }
    }

    public function view($family_id) {
        $this->layout = "default";
        $this->set('family', $this->Family->find('first', array('conditions' => array('Family.id' => $family_id))));
    }

}

?>