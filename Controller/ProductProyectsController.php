<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product_proyects_controller
 *
 * @author Fredy Bejarano
 */
class ProductProyectsController extends AppController {

    var $name = "ProductProyects";

    public function index($proyect_id = null) {
        $this->set('proyect_id', $proyect_id);
        $this->ProductProyect->recursive = 1;
        $this->set('codigo', $this->ProductProyect->Proyect->field('codigo', array('Proyect.id' => $proyect_id)));
        $this->set('products', $this->ProductProyect->find('all', array('conditions' => array('ProductProyect.proyect_id' => $proyect_id), 'fields' => array('Product.*', 'ProductProyect.*'))));
    }

    public function add($proyect_id) {
        $this->set('proyect_id', $proyect_id);
        $this->set('products', $this->ProductProyect->Product->find('list', array('fields' => array('Product.id', 'Product.nombre'), 'order' => array('Product.nombre ASC'))));
        if (!empty($this->data)) {
            if (!$this->ProductProyect->find('first', array('conditions' => array('ProductProyect.proyect_id' => $proyect_id, 'ProductProyect.product_id' => $this->request->data['ProductProyect']['product_id'])))) {
                if ($this->ProductProyect->saveAll($this->data)) {
                    $this->Session->setFlash('Producto adicionado con éxito', 'flash');
                    $this->redirect(array('controller' => 'ProductProyects', 'action' => 'index', $proyect_id));
                } else {
                    $this->Session->setFlash('Error guardando los datos', 'flash_error');
                    $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
                }
            } else {
                $this->Session->setFlash('El producto ya esta asociado al proyecto', 'flash_error');
                $this->redirect(array('controller' => 'ProductProyects', 'action' => 'index', $proyect_id));
            }
        }
    }

    public function delete($id, $proyect_id = null) {
        if ($this->ProductProyect->delete($id)) {
            $this->Session->setFlash('Producto eliminado con éxito', 'flash');
            $this->redirect(array('controller' => 'ProductProyects', 'action' => 'index', $proyect_id));
        }
    }

}

?>
