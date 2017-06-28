<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of candidate_requirements_controller
 *
 * @author wilson
 */
class BeneficiaryRequirementscontroller extends AppController {

    //put your code here
    var $name = "BeneficiaryRequirements";

    public function index($beneficiary_id = null) {
        $this->layout = "ajax";
        $call_id = 2;
        $tipo = "Beneficiario";
        $beneficiario = $this->BeneficiaryRequirement->Beneficiary->find('first', array('recursive' => -1, 'conditions' => array('Beneficiary.id' => $beneficiary_id), 'fields' => array('Beneficiary.property_id','Beneficiary.tipo', 'Beneficiary.id', 'Beneficiary.nombres', 'Beneficiary.primer_apellido')));
        if ($beneficiario['Beneficiary']['tipo'] == "Desplazado") {
            $tipo = "Desplazado";
        }
        $requerimientos = $this->BeneficiaryRequirement->InitialRequirement->find(
                'all', array(
            'conditions' => array('InitialRequirement.tipo' => $tipo, 'InitialRequirement.call_id' => $call_id),
            'fields' => array('InitialRequirement.id'),
            'recursive' => -1,
        ));

        $cargados = true;

        foreach ($requerimientos as $req) {

            $r = $req['InitialRequirement']['id'];

            $cont = $this->BeneficiaryRequirement->find('count', array('conditions' => array('BeneficiaryRequirement.initial_requirement_id' => $req['InitialRequirement']['id'], 'BeneficiaryRequirement.beneficiary_id' => $beneficiary_id)));
            if ($cont == 0) {
                $this->BeneficiaryRequirement->query("INSERT INTO beneficiary_requirements (beneficiary_id,initial_requirement_id,sincronizado)values($beneficiary_id,$r,0)");
            }
        }
        $this->loadModel('Property');
        $cerrado=0;
        if($cal0=$this->Property->field('Property.calificacion_fase0',array('Property.id'=>$beneficiario['Beneficiary']['property_id']))){
            if($cal0=="Cumple" ||$cal0=="No cumple"){
                $cerrado=1;
            }
            
        }
        
        $requerimientos = $this->BeneficiaryRequirement->find('all', array('recursive' => 0, 'conditions' => array('BeneficiaryRequirement.beneficiary_id' => $beneficiary_id), 'fields' => array('Beneficiary.nombres', 'Beneficiary.property_id', 'Beneficiary.primer_apellido', 'BeneficiaryRequirement.beneficiary_id','BeneficiaryRequirement.id', 'InitialRequirement.texto', 'BeneficiaryRequirement.calificacion', 'BeneficiaryRequirement.concepto')));
        $this->set('requisitos', $requerimientos);
        $this->set('cerrado', $cerrado);
    }

    public function delete($id,$beneficiary_id) {
        if ($this->BeneficiaryRequirement->delete($id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'BeneficiaryRequirements', 'action' => 'index',$beneficiary_id));
        } else {
            $this->Session->setFlash('Error borrando datos', 'flash_custom');
        }
    }

    function edit($id) {

        if (empty($this->data)) {

            $this->data = $this->BeneficiaryRequirement->find('first', array('conditions' => array('BeneficiaryRequirement.id' => $id), 'fields' => array('BeneficiaryRequirement.id', 'BeneficiaryRequirement.calificacion', 'BeneficiaryRequirement.beneficiary_id', 'BeneficiaryRequirement.initial_requirement_id', 'BeneficiaryRequirement.concepto', 'InitialRequirement.texto', 'Beneficiary.nombres')));
        } else {
            $benId=$this->data['BeneficiaryRequirement']['beneficiary_id'];  
            if ($this->BeneficiaryRequirement->saveAll($this->data)) {
                $this->Session->setFlash('Registro guardado exitosamente');
                if ($nextId = $this->BeneficiaryRequirement->field('BeneficiaryRequirement.id', array('BeneficiaryRequirement.id >' => $id, 'BeneficiaryRequirement.beneficiary_id' => $benId))) {
                    $this->redirect(array('controller' => 'BeneficiaryRequirements', 'action' => 'edit', $nextId));  
                }else{
                  $this->redirect(array('controller' => 'BeneficiaryRequirements', 'action' => 'index', $benId));  
                }
                
             
            }
        }
    }

}

?>