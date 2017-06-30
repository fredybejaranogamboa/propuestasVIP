<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of beneficiaries_controller
 *
 * @author Fredy Bejarano
 */
class BeneficiariesController extends AppController {

    var $name = 'Beneficiaries';

    public function index() {
        $proyect_id = $this->Session->read('proyect_id');

        if (!$this->RequestHandler->isAjax()) {
            $this->layout = "default";
        } else {
            $this->layout = "ajax";
        }

        if ($proyect_id != "") {
            $this->set('aleatorio', rand(1111, 9999999));
            if ($this->Auth->user('group_id') == 1 or $this->Auth->user('group_id') == 18) {
                $this->set('admin', true);
            } else {
                $this->set('admin', false);
            }
            $codigo = $this->Session->read('codigo');
            $grupos_habilitados = array(1);
            if ($this->Beneficiary->Proyect->Resolution->find('count', array('conditions' => array('Resolution.proyect_id' => $proyect_id))) < 1 or in_array($this->Auth->user('group_id'), $grupos_habilitados)) {
                $this->set('permitir', true);
            } else {
                $resolution_id = $this->Beneficiary->Proyect->Resolution->field('id', array('Resolution.proyect_id' => $proyect_id, 'Resolution.tipo' => 'ADJUDICACIÓN'));
                $rutaDocumento = APP . "webroot" . "/" . "files/resoluciones/SoporteResolucion-" . $codigo . "-" . $resolution_id . ".pdf";
                if (file_exists("../webroot/files/resoluciones/SoporteResolucion-" . $codigo . "-" . $resolution_id . ".pdf")) {
                    $this->set('permitir', false);
                } else {
                    $this->set('permitir', true);
                }
            }

            $this->loadModel('Proyect');
            $call_id = $this->Proyect->field('call_id', array('Proyect.id' => $proyect_id));
            $this->set("call_id", $call_id);
            $this->set("beneficiaries", $this->Beneficiary->find('all', array(
                        'conditions' => array('Beneficiary.proyect_id' => $proyect_id, 'Beneficiary.beneficiary_id' => 0),
                        'recursive' => -1,
                        'fields' => array('Beneficiary.numero_identificacion', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.id', 'Beneficiary.tipo'),
                        'order' => array('Beneficiary.nombres' => 'ASC'))));
            $this->set('proyecto', $this->Beneficiary->Proyect->find('first', array('recursive' => -1, 'conditions' => array('Proyect.id' => $proyect_id), 'fields' => array('Proyect.codigo'))));
            $this->set('proyect_id', $proyect_id);
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash');
            $this->redirect(array('controller' => 'pages', 'action' => 'display'));
        }
    }

    public function add($proyect_id, $beneficiary_id) {
        $this->layout = "ajax";
        //$this->set('asociations', $this->Beneficiary->Asociation->find('all', array('conditions' => array('Asociation.proyect_id' => $proyect_id), 'fields' => array('Asociation.*'), 'order' => array('Asociation.nombre' => 'ASC'))));
        $this->set('properties', $this->Beneficiary->Property->find('all', array('conditions' => array('Property.proyect_id' => $proyect_id), 'fields' => array('Property.*'), 'order' => array('Property.nombre' => 'ASC'))));
        $this->set('beneficiary_id', $beneficiary_id);
        $this->set('proyect_id', $proyect_id);

        if (!empty($this->data)) {

            if ($this->Beneficiary->find('count', array('conditions' => array('Beneficiary.numero_identificacion' => $this->data['Beneficiary']['numero_identificacion']))) > 1) {
                $this->Session->setFlash('Ya existe una persona registrada con el número de identificación ' . $this->data['Beneficiary']['numero_identificacion'], 'flash_error');
                $this->redirect(array('action' => 'index'));
            }

            $reemplazar = array(',', '.', '<', '>', '"');
            $this->request->data['Beneficiary']['numero_identificacion'] = str_replace($reemplazar, "", $this->data['Beneficiary']['numero_identificacion']);
            $this->request->data['Beneficiary']['nombres'] = str_replace($reemplazar, "", $this->data['Beneficiary']['nombres']);
            $this->request->data['Beneficiary']['primer_apellido'] = str_replace($reemplazar, "", $this->data['Beneficiary']['primer_apellido']);
            $this->request->data['Beneficiary']['segundo_apellido'] = str_replace($reemplazar, "", $this->data['Beneficiary']['segundo_apellido']);
            $this->request->data['Beneficiary']['telefono'] = str_replace($reemplazar, "", $this->data['Beneficiary']['telefono']);
            $this->request->data['Beneficiary']['direccion'] = str_replace($reemplazar, "", $this->data['Beneficiary']['direccion']);

            if ($this->Beneficiary->saveAll($this->data)) {

                $last_id = $this->Beneficiary->getLastInsertId();
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Beneficiarios";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                if (!empty($this->data['Beneficiary']['cedula']['tmp_name'])) {
                    $nombrearchivo = "documento_identidad-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Beneficiary']['cedula']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando cedula', 'flash_error');
                    }
                }

                if (!empty($this->data['Beneficiary']['policia']['tmp_name'])) {
                    $nombrearchivo = "policia-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Beneficiary']['policia']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando policia', 'flash_error');
                    }
                }

                if (!empty($this->data['Beneficiary']['contraloria']['tmp_name'])) {
                    $nombrearchivo = "contraloria-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Beneficiary']['contraloria']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando contraloría', 'flash_error');
                    }
                }

                if (!empty($this->data['Beneficiary']['procuraduria']['tmp_name'])) {
                    $nombrearchivo = "procuraduria-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Beneficiary']['procuraduria']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando procuraduría', 'flash_error');
                    }
                }

                if (!empty($this->data['Beneficiary']['f26']['tmp_name'])) {
                    $nombrearchivo = "f26-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Beneficiary']['f26']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando f26', 'flash_error');
                    }
                }

                
                $this->Session->setFlash('Beneficiario guardado correctamente', 'flash');
                if ($beneficiary_id == 0) {
                    $this->redirect(array('controller' => 'Beneficiaries', 'action' => 'index', $proyect_id));
                } elseif ($beneficiary_id != 0) {
                    $this->redirect(array('controller' => 'Families', 'action' => 'index', $beneficiary_id, $proyect_id));
                }
            } else {
                $this->Session->setFlash('Error guardando los datos', 'flash_error');
                $this->redirect(array('controller' => 'pages', 'action' => 'display'));
            }
        } else {
            App::Import('model', 'Departament');
            $Departament = new Departament();
            $this->set('departaments', $Departament->find('list'));
        }
    }

    public function edit($id, $beneficiary_id) {
        $this->set('beneficiary_id', $beneficiary_id);
        $this->layout = "ajax";
        $this->Beneficiary->recursive = -1;

        if (empty($this->data)) {
            $proyect_id = $this->Session->read('proyect_id');
            $codigo = $this->Session->read('codigo');
            $grupos_habilitados = array(1, 17);
            if ($this->Beneficiary->Proyect->Resolution->find('count', array('conditions' => array('Resolution.proyect_id' => $proyect_id))) < 1 or in_array($this->Auth->user('group_id'), $grupos_habilitados)) {
                $this->set('permitir', true);
            } else {
                $resolution_id = $this->Beneficiary->Proyect->Resolution->field('id', array('Resolution.proyect_id' => $proyect_id, 'Resolution.tipo' => 'ADJUDICACIÓN'));
                $rutaDocumento = APP . "webroot" . "/" . "files/resoluciones/SoporteResolucion-" . $codigo . "-" . $resolution_id . ".pdf";
                if (file_exists("../webroot/files/resoluciones/SoporteResolucion-" . $codigo . "-" . $resolution_id . ".pdf")) {
                    $this->set('permitir', false);
                } else {
                    $this->set('permitir', true);
                }
            }

            $this->data = $this->Beneficiary->find("first", array("conditions" => array("Beneficiary.id" => $id)));
           // $this->set('asociations', $this->Beneficiary->Asociation->find('all', array('conditions' => array('Asociation.proyect_id' => $this->data['Beneficiary']['proyect_id']), 'fields' => array('Asociation.*'), 'order' => array('Asociation.nombre' => 'ASC'))));
            $this->set('properties', $this->Beneficiary->Property->find('all', array('conditions' => array('Property.proyect_id' => $this->data['Beneficiary']['proyect_id']), 'fields' => array('Property.*'), 'order' => array('Property.nombre' => 'ASC'))));

            $departament_id = $this->Beneficiary->City->field('departament_id', array('City.id' => $this->data['Beneficiary']['city_id']));
            $this->set('departament_id', $departament_id);

            App::Import('model', 'Departament');
            $Departament = new Departament();
            $this->set('departaments', $Departament->find('list'));

            $this->set('cities', $this->Beneficiary->City->find('list', array('conditions' => array('City.departament_id' => $departament_id))));
        } else {


            if ($this->Beneficiary->find('count', array('conditions' => array('Beneficiary.numero_identificacion' => $this->data['Beneficiary']['numero_identificacion']))) > 1) {
                $this->Session->setFlash('Ya existe una persona registrada con el número de identificación ' . $this->data['Beneficiary']['numero_identificacion'], 'flash_error');
                $this->redirect(array('action' => 'index'));
            }

            $reemplazar = array(',', '.', '<', '>', '"');
            $this->request->data['Beneficiary']['numero_identificacion'] = str_replace($reemplazar, "", $this->data['Beneficiary']['numero_identificacion']);
            $this->request->data['Beneficiary']['nombres'] = str_replace($reemplazar, "", $this->data['Beneficiary']['nombres']);
            $this->request->data['Beneficiary']['primer_apellido'] = str_replace($reemplazar, "", $this->data['Beneficiary']['primer_apellido']);
            $this->request->data['Beneficiary']['segundo_apellido'] = str_replace($reemplazar, "", $this->data['Beneficiary']['segundo_apellido']);
            $this->request->data['Beneficiary']['telefono'] = str_replace($reemplazar, "", $this->data['Beneficiary']['telefono']);
            $this->request->data['Beneficiary']['direccion'] = str_replace($reemplazar, "", $this->data['Beneficiary']['direccion']);

            if ($this->Beneficiary->save($this->data)) {
                $last_id = $this->data['Beneficiary']['id'];
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Beneficiarios";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                if (!empty($this->data['Beneficiary']['cedula']['tmp_name'])) {
                    $nombrearchivo = "documento_identidad-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Beneficiary']['cedula']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {


                        $this->Session->setFlash('Error adjuntando cedula', 'flash_error');
                    }
                }

                if (!empty($this->data['Beneficiary']['policia']['tmp_name'])) {
                    $nombrearchivo = "policia-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Beneficiary']['policia']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando policia', 'flash_error');
                    }
                }

                if (!empty($this->data['Beneficiary']['contraloria']['tmp_name'])) {
                    $nombrearchivo = "contraloria-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Beneficiary']['contraloria']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando contraloría', 'flash_error');
                    }
                }

                if (!empty($this->data['Beneficiary']['procuraduria']['tmp_name'])) {
                    $nombrearchivo = "procuraduria-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Beneficiary']['procuraduria']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando procuraduría', 'flash_error');
                    }
                }

                if (!empty($this->data['Beneficiary']['sisben']['tmp_name'])) {
                    $nombrearchivo = "sisben-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Beneficiary']['sisben']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando sisben', 'flash_error');
                    }
                }

                if (!empty($this->data['Beneficiary']['f26']['tmp_name'])) {
                    $nombrearchivo = "f26-" . $last_id . ".pdf";
                    if (!move_uploaded_file($this->data['Beneficiary']['f26']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Session->setFlash('Error adjuntando f26', 'flash_error');
                    }
                }

                $this->Session->setFlash('Beneficiario guardado correctamente', 'flash');
                if ($beneficiary_id == 0) {
                    $this->redirect(array('controller' => 'Beneficiaries', 'action' => 'index', $this->data['Beneficiary']['proyect_id']));
                } else {
                    $this->redirect(array('controller' => 'Families', 'action' => 'index', $beneficiary_id, $this->data['Beneficiary']['proyect_id']));
                }
            } else {
                $this->Session->setFlash('Error guardando los datos', 'flash_error');
                $this->redirect(array('controller' => 'pages', 'action' => 'display'));
            }
        }
    }

    public function delete($beneficiary_id, $proyect_id, $redirect) {
        $this->Beneficiary->BeneficiaryRequirement->deleteAll(array('BeneficiaryRequirement.beneficiary_id' => $beneficiary_id));
        if ($this->Beneficiary->delete($beneficiary_id)) {
            $this->Beneficiary->BeneficiaryRequirement->deleteAll(array('BeneficiaryRequirement.beneficiary_id' => $beneficiary_id));

            if ($conyuge = $this->Beneficiary->find('first', array('recursive' => -1, 'conditions' => array('Beneficiary.beneficiary_id' => $beneficiary_id), 'fields' => array('Beneficiary.id')))) {
                if ($this->Beneficiary->delete($conyuge['Beneficiary']['id'])) {
                    $this->Beneficiary->BeneficiaryRequirement->deleteAll(array('BeneficiaryRequirement.beneficiary_id' => $conyuge['Beneficiary']['id']));
                    $this->Session->setFlash('Beneficiario y conyuge borrado correctamente', 'flash');
                    $this->redirect(array('controller' => 'Beneficiaries', 'action' => 'index', $proyect_id));
                }
            } else {
                $this->Session->setFlash('Beneficiario  borrado correctamente', 'flash');
                if ($redirect == 0)
                    $this->redirect(array('controller' => 'Beneficiaries', 'action' => 'index', $proyect_id));
                if ($redirect == 1)
                    $this->redirect(array('controller' => 'Beneficiaries', 'action' => 'total_index'));
            }
        }
    }

    public function view($beneficiary_id) {
        $this->layout = "ajax";
        $this->set('beneficiary', $this->Beneficiary->find('first', array('recursive' => 0, 'conditions' => array('Beneficiary.id' => $beneficiary_id), 'fields' => array('Beneficiary.*', 'Property.*', 'City.*'))));
    }

    public function add_conyuge($beneficiary_id) {
        $this->set('beneficiary_id', $beneficiary_id);
        if (!empty($this->data)) {

            if ($this->Beneficiary->save($this->data)) {

                $this->Session->setFlash('Beneficiario guardado correctamente', 'flash');
                $this->redirect(array('controller' => 'Families', 'action' => 'poll_index', $beneficiary_id));
            }
        }
    }

    public function select() {
        $this->layout = "ajax";
        $this->set('cities', $this->Beneficiary->City->find('list', array(
                    'order' => 'name ASC',
                    'conditions' => array('City.departament_id' => $this->data['Beneficiary']['departament_id'])
                        )
        ));
    }

    public function report($option) {
        $this->layout = "ajax";
        ini_set('max_execution_time', 600);

        $conditions = array(
            'recursive' => -1,
            'fields' => array('Beneficiary.id', 'Beneficiary.tipo_identificacion', 'Beneficiary.numero_identificacion', 'Beneficiary.nombres', 'Beneficiary.primer_apellido',
                'Beneficiary.segundo_apellido', 'Beneficiary.genero', 'Beneficiary.fecha_nacimiento', 'Beneficiary.tipo',
                'Proyect.codigo', 'City.name', 'Departament.name',
                'Beneficiary2.id', 'Beneficiary2.tipo_identificacion', 'Beneficiary2.numero_identificacion', 'Beneficiary2.nombres', 'Beneficiary2.primer_apellido',
                'Beneficiary2.segundo_apellido', 'Beneficiary2.genero', 'Beneficiary2.fecha_nacimiento', 'Beneficiary2.tipo'),
            'joins' => array(
                array('table' => 'beneficiaries',
                    'alias' => 'Beneficiary2',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Beneficiary.id = Beneficiary2.beneficiary_id'
                    )
                ),
                array('table' => 'cities',
                    'alias' => 'City',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Beneficiary.city_id = City.id'
                    )
                ),
                array('table' => 'proyects',
                    'alias' => 'Proyect',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Beneficiary.proyect_id = Proyect.id'
                    )
                ),
                array('table' => 'departaments',
                    'alias' => 'Departament',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'City.departament_id = Departament.id'
                    )
                )
            ),
            'order' => array('Proyect.codigo' => 'ASC', 'Beneficiary.nombres' => 'ASC', 'Beneficiary.primer_apellido' => 'ASC'));

        if ($this->Auth->user('group_id') == 1) {
            $conditions['conditions'] = array('Beneficiary.beneficiary_id' => 0);
        } else {
            $conditions['conditions'] = array('Beneficiary.beneficiary_id' => 0, 'Proyect.branch_id' => $this->Auth->user('branch_id'));
        }

        $this->set('beneficiaries', $this->Beneficiary->find('all', $conditions));
    }

    public function delete_file($tipo, $id) {
        $path = ".." . DS . "webroot" . DS . "files" . DS . "Beneficiarios" . DS;
        switch ($tipo) {
            case 1:
                $path .= "documento_identidad-" . $id . ".pdf";
                break;
            case 2:
                $path .= "policia-" . $id . ".pdf";
                break;
            case 3:
                $path .= "contraloria-" . $id . ".pdf";
                break;
            case 4:
                $path .= "procuraduria-" . $id . ".pdf";
                break;
            case 5:
                $path .= "sisben-" . $id . ".pdf";
                break;
            case 6:
                $path .= "f26-" . $id . ".pdf";
                break;
            default:
                break;
        }
        if (file_exists($path)) {
            unlink($path);
            $this->Session->setFlash('Archivo  borrado correctamente', 'flash');
            $this->redirect(array('action' => "index"));
        } else {
            $this->redirect(array('controller' => 'Pages', 'action' => "error", "Error borrando el archivo."));
        }
    }

}

?>