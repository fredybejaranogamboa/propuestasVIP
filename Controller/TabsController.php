<?php

class TabsController extends AppController {

    var $name = "Tabs";

    function index() {
        $this->layout = "ajax";
        //$this->set("tabs",$this->Tab->findAll());
        //$this->set("tabs", $this->Tab->find("all"));
        $this->set("tabs", $this->Tab->find("all", array("fields" => array("Tab.id", "Tab.titulo", "Tab.icono", 'Tab.orden'), 'order' => array('Tab.orden ASC'))));
    }

    function add() {
        $this->layout = "ajax";
        if (!empty($this->data)) {
            if ($this->Tab->save($this->data)) {
                $this->Session->setFlash("Pestaña adicioanda con exito", 'flash_custom');
                $this->redirect(array('controller' => 'Tabs', 'action' => 'index'));
            };
        }
    }

    function edit($id) {
        $this->layout = "ajax";
        if (!empty($this->data)) {

            if ($this->Tab->save($this->data)) {
                $this->Session->setFlash("Pestaña editada con  éxito", 'flash_custom');
                $this->redirect(array('controller' => 'Tabs', 'action' => 'index'));
            };
        } else {
            //$this->data = $this->Tab->findById($id);
            $this->data = $this->Tab->find("first", array("conditions" => array("Tab.id" => $id)));
        }
    }

    function delete($id) {
        $this->layout = "ajax";
        if ($this->Tab->delete($id)) {
            $this->Session->setFlash('Pestaña Borrada con exito', 'flash_custom');
            $this->redirect(array('controller' => 'Tabs', 'action' => 'index'));
        }
    }

    function view() {
        $this->layout = "pdf";
        $grupo = $this->Auth->user('group_id');

        $options['conditions'] = array('GroupsTab.group_id' => $grupo);
        $options['joins'] = array(
                    array('table' => 'groups_tabs',
                        'alias' => 'GroupsTab',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Tab.id = GroupsTab.tab_id',
                        )
                    )
        );
        $options['order'] = array('Tab.orden ASC');
        $lista = $this->Tab->find('all', $options);

        $this->set('lista', $lista);
    }

}

?>
