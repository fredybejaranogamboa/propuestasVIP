<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController {

    var $name = 'Users';

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('*');
    }

    public function send() {

        $this->layout = "login";

        if (!empty($this->data)) {

            $this->User->recursive = 0;
            if ($user = $this->User->find('first', array('conditions' => array('User.email' => $this->data['User']['correo']), 'fields' => array('User.*')))) {

                $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
                $clave = "";
                for ($i = 0; $i < 8; $i++) {
                    $clave .= substr($str, rand(0, 62), 1);
                }

                $this->request->data['User']['password'] = $this->Auth->password($clave);
                $this->request->data['User']['branch_id'] = $user['User']['branch_id'];
                $this->request->data['User']['group_id'] = $user['User']['group_id'];
                $this->request->data['User']['id'] = $user['User']['id'];

                if ($this->User->save($this->data)) {
//                    $this->request->data['User']['group_id'] = $user['User']['group_id'];
//                    $this->User->save($this->data);
                    $Email = new CakeEmail('gmail');
                    $Email->from(array('pdret.soporte@gmail.com' => 'Aplicativo PDRET'));
                    $Email->addTo($user['User']['email']);
                    $Email->subject("Cambio de clave aplicativo PDRET");
                    $Email->emailFormat('html');

                    $body = "Se ha cambiado exitosamente su clave, los datos de su cuenta son: <br>";
                    $body .= " <strong>Usuario: " . $user['User']['nombre'] . " " . $user['User']['primer_apellido'] . " " . $user['User']['segundo_apellido'] . "</strong><br>";
                    $body .= " <strong>Username: " . $user['User']['username'] . "</strong><br>";
                    $body .= " <strong>Nueva Clave: " . $clave . "</strong><br>";
                    $exito = $Email->send($body);

                    if ($exito) {
                        $this->Session->setFlash("Sus datos fueron enviados al correo  " . $user['User']['email'], 'flash');
                    } else {
                        $this->Session->setFlash("Error :  " . $user['User']['email'] . " ", 'flash');
                    }
                    $this->redirect(array('controller' => 'Users', 'action' => "send"));
                } else {
                    $this->Session->setFlash("Error Guardando Datos", 'flash');
                }
            } else {
                $this->Session->setFlash("No existe un usuario asociado a este correo", 'flash');
                $this->redirect(array('controller' => 'Users', 'action' => "send"));
            }
        }
    }

    public function login() {
        $this->pageTitle = 'Inicio';
        $this->layout = "login";
        $this->User->recursive = -1;

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Session->write("convocatoria", $this->data['User']['call_id']);
                \clearstatcache();
                $this->redirect(array('controller' => 'Proyects', 'action' => 'index'));
                //$this->redirect($this->Auth->redirect());
                //return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Session->setFlash('Su usuario o contraseña no son correctos.', 'flash_error');
        }
    }

    public function logout() {
        $this->Session->setFlash('Su sesión ha expirado.', 'flash_error');
        $this->Session->destroy();
        $this->redirect($this->Auth->logout());
    }

    public function index() {
        if (!$this->RequestHandler->isAjax()) {
            $this->layout = "default";
        } else {
            $this->layout = "ajax";
        }
        if (empty($this->data) or empty($this->data['User']['busqueda'])) {

            $this->set('User', $this->User->find('all', array('recursive' => 1, 'fields' => array('User.username', 'User.id', 'User.email', 'User.primer_apellido', 'User.nombre', 'Group.name', 'Branch.nombre'))));
        } else {

            $this->set('User', $this->User->find('all', array(
                        'recursive' => 1,
                        'conditions' => array(
                            'or' => array('Branch.nombre LIKE' => "%" . $this->data['User']['busqueda'] . "%", 'User.username LIKE' => "%" . $this->data['User']['busqueda'] . "%", 'User.primer_apellido LIKE ' => "%" . $this->data['User']['busqueda'] .
                                "%", 'User.nombre LIKE ' => "%" . $this->data['User']['busqueda'] . "%",
                                'Group.name LIKE ' => "%" . $this->data['User']['busqueda'] . "%")
                        ),
                        'fields' => array('User.username', 'User.nombre', 'User.primer_apellido', 'User.id', 'Branch.nombre', 'User.email', 'Group.name')
            )));
        }
      
    }

    public function edit($id) {
        $this->layout = "ajax";

        if (!empty($this->data)) {
            if ($this->User->saveAll($this->data)) {
                $this->Session->setFlash("Usuario editado con éxito", 'flash');
                $this->redirect(array("controller" => 'users', 'action' => 'index'));
            } else {
                $this->Session->setFlash("Error guardando datos", 'flash_error');
                $this->set('branches', $this->User->Branch->find('list', array('order' => 'nombre ASC', 'fields' => array('id', 'nombre'))));
                $this->set('groups', $this->User->Group->find('list', array('conditions' => array('Group.id NOT' => array(1, 7)), 'order' => 'name ASC', 'fields' => array('id', 'name'))));
            }
        } else {
            $this->data = $this->User->find("first", array('recursive' => -1, "conditions" => array("User.id" => $id), 'fields' => array('user.*')));
            $this->set('branches', $this->User->Branch->find('list', array('order' => 'nombre ASC', 'fields' => array('id', 'nombre'))));
            $this->set('groups', $this->User->Group->find('list', array('order' => 'name ASC', 'fields' => array('id', 'name'))));
        }
    }

    public function edit_user() {
        $this->layout = "ajax";
        if (empty($this->data)) {
            $id = $this->Auth->user('id');
            $this->data = $this->User->find("first", array("recursive" => -1, "conditions" => array("User.id" => $id), 'fields' => array('User.*')));
        } else {

            if ($this->User->find('count', array('conditions' => array('User.email' => $this->data['User']['email'], 'User.id !=' => $this->data['User']['id']))) < 1) {
                if ($this->Auth->password($this->data['User']['password1']) != $this->Auth->password($this->data['User']['password_confirm'])) {
                    $this->redirect(array('controller' => 'Pages', 'action' => "error", "Las contraseñas no coinciden."));
                } else {
                    if ($this->request->data['User']['password1'] != "")
                        $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password1']);
                    if ($this->User->save($this->data)) {
                        $this->redirect(array('controller' => 'Pages', 'action' => "message", "Usuario editado con éxito."));
                    } else {
                        $this->redirect(array('controller' => 'Pages', 'action' => "error", "Error guardando los datos."));
                    }
                }
            } else {
                $this->redirect(array('controller' => 'Pages', 'action' => "error", "Ya existe un usuario con este correo. No es posible actualizar los datos."));
            }
        }
    }

    public function add() {

        $this->layout = "ajax";
        App::import('Vendor', 'ClassPhpmailer', array('file' => 'phpmailer/class.phpmailer.php'));
 
        if (!empty($this->data)) {

            //Generamos la nueva clave de forma aleatorea

            $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
            $clave = "";
            for ($i = 0; $i < 8; $i++) {
                $clave .= substr($str, rand(0, 62), 1);
            }

            $this->request->data['User']['password'] = $this->Auth->password($clave);

            if ($this->User->saveAll($this->data)) {
                $mail = new PHPMailer();

//Luego tenemos que iniciar la validación por SMTP: 
                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->Host = "ssl://smtp.gmail.com"; // SMTP a utilizar. Por ej. smtp.elserver.com 
                $mail->Username = "pdret.soporte@gmail.com"; // Correo completo a utilizar 
                $mail->Password = "Eldelfin74%"; // Contraseña 
                $mail->Port = 465; // Puerto a utilizar 
//Con estas pocas líneas iniciamos una conexión con el SMTP. Lo que ahora deberíamos hacer, es configurar el mensaje a enviar, el //From, etc. 
                $mail->From = "pdret.soporte@gmail.com"; // Desde donde enviamos (Para mostrar) 
                $mail->FromName = "Soporte aplicativo PDRET";

//Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo. 
                $mail->AddAddress($this->data['User']['email']);
                $mail->IsHTML(true);
//$mail->IsHTML(true); // El correo se envía como HTML 
                $mail->Subject = utf8_decode("Creación usuario aplicativo PDRET"); // Este es el titulo del email. 
                $body = "Se ha creado su usuario con los siguientes datos: <br>";
                $body .= "<strong>Nombre: " . utf8_decode($this->data['User']['nombre']) . " " . utf8_decode($this->data['User']['primer_apellido']) . " " . utf8_decode($this->data['User']['segundo_apellido']) . "</strong><br>";
                $body .= "<strong>Usuario: : " . utf8_decode($this->data['User']['username']) . "</strong><br>";
                $body .= "<strong>Clave: " . $clave . "</strong><br>";
                $body .= "<strong>" . utf8_decode("Puede ingresar desde la dirección: http://192.168.1.189:86/pdret") . "</strong><br>";
                $mail->Body = $body; // Mensaje a enviar 
//$mail->SMTPDebug = 1;

                $mail->Send(); // Envía el correo. print_r($this->data);

                $this->Session->setFlash("Usuario creado con éxito, se envió el correo a " . $this->data['User']['email'], 'flash');
                $this->redirect(array("controller" => 'users', 'action' => 'index'));
            } else {
                $this->Session->setFlash("Error guardando datos", 'flash_error');
                $this->set('branches', $this->User->Branch->find('list', array('order' => 'nombre ASC', 'fields' => array('id', 'nombre'))));
                $this->set('groups', $this->User->Group->find('list', array('conditions' => array('Group.id NOT' => array(1, 7)), 'order' => 'name ASC', 'fields' => array('id', 'name'))));
            }
        } else {
            
            $this->set('branches', $this->User->Branch->find('list', array('order' => 'nombre ASC', 'fields' => array('id', 'nombre'))));
            $this->set('groups', $this->User->Group->find('list', array('order' => 'name ASC')));
        }
    }

    public function delete($id) {
        if ($this->User->delete($id)) {
            $this->Session->setFlash('Usuario Borrado con éxito', 'flash');
            $this->redirect(array('controller' => 'Users', 'action' => 'index'));
        } else {
            $this->redirect(array('controller' => 'Pages', 'action' => 'error', "No es posible eliminar el usuario, por favor intentelo nuevamente."));
        }
    }

}

?>