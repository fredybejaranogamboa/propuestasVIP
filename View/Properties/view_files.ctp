<h2>Documentos predio <?php echo $Property['Property']['nombre'] ?> </h2>
<?php echo $this->Html->link(' Volver', array('controller' => 'Properties', 'action' => 'index'), array('escape' => FALSE, 'update' => 'content', 'class' => 'btn btn-info fa fa-arrow-circle-left')); ?>
<br>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>ARCHIVOS PARA DESCARGAR</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <?php
                if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/f25.pdf")) {
                    echo $this->Html->link('Análisis jurídico de predios F25/F7', "../files/Predio-" . $Property["Property"]["id"] . "/f25.pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o', 'download' => "Analisis_juridico-" . $aleatorio . ".pdf"));
                    if ($admin) {
                        echo $this->Ajax->link(" Eliminar", array('controller' => 'Properties', "action" => "delete_file", 2, $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Seguro de borrar el archivo?');
                    }
                }
                ?>
                <br><br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/f4.pdf")) {
                    echo $this->Html->link('Visita de verificación a predio f4', "../files/Predio-" . $Property["Property"]["id"] . "/f4.pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o', 'download' => "Visita_verificacion-" . $aleatorio . ".pdf"));
                    if ($admin) {
                        echo $this->Ajax->link(" Eliminar", array('controller' => 'Properties', "action" => "delete_file", 3, $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Seguro de borrar el archivo?');
                    }
                }
                ?>
                <br>
                <br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/Matricula.pdf")) {
                    echo $this->Html->link('Matrícula inmobiliaria', "../files/Predio-" . $Property["Property"]["id"] . "/Matricula.pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o', 'download' => "Matricula_inmobiliaria-" . $aleatorio . ".pdf"));
                    if ($admin) {
                        echo $this->Ajax->link(" Eliminar", array('controller' => 'Properties', "action" => "delete_file", 5, $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Seguro de borrar el archivo?');
                    }
                }
                ?>
                <br>
                <br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/Resguardo.pdf")) {
                    echo $this->Html->link('Certificación resguardo indígena.', "../files/Predio-" . $Property["Property"]["id"] . "/Resguardo.pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o', 'download' => "Certificacion_resguardo-" . $aleatorio . ".pdf"));
                    if ($admin) {
                        echo $this->Ajax->link(" Eliminar", array('controller' => 'Properties', "action" => "delete_file", 7, $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Seguro de borrar el archivo?');
                    }
                }
                ?>
                <br>
                <br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/Consejo.pdf")) {
                    echo $this->Html->link('Certificación consejo comunitario.', "../files/Predio-" . $Property["Property"]["id"] . "/Consejo.pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o', 'download' => "Certificacion_consejo_comunitario-" . $aleatorio . ".pdf"));
                    if ($admin) {
                        echo $this->Ajax->link(" Eliminar", array('controller' => 'Properties', "action" => "delete_file", 8, $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Seguro de borrar el archivo?');
                    }
                }
                ?>
                <br>
                <br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/sana_posesion.pdf")) {
                    echo $this->Html->link('Sana posesión.', "../files/Predio-" . $Property["Property"]["id"] . "/sana_posesion.pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o', 'download' => "Sana_posesion-" . $aleatorio . ".pdf"));
                    if ($admin) {
                        echo $this->Ajax->link(" Eliminar", array('controller' => 'Properties', "action" => "delete_file", 11, $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Seguro de borrar el archivo?');
                    }
                }
                ?>
                <br>
                <br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/manifiesto_colindancias.pdf")) {
                    echo $this->Html->link('Manifiesto de colindancias.', "../files/Predio-" . $Property["Property"]["id"] . "/manifiesto_colindancias.pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o', 'download' => "Manifiesto_colindancias-" . $aleatorio . ".pdf"));
                    if ($admin) {
                        echo $this->Ajax->link(" Eliminar", array('controller' => 'Properties', "action" => "delete_file", 12, $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Seguro de borrar el archivo?');
                    }
                }
                ?>
                <br>
                <br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/Distrito.pdf")) {
                    echo $this->Html->link('Certificación distrito de riego.', "../files/Predio-" . $Property["Property"]["id"] . "/Distrito.pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o', 'download' => "Certificacion_distrito_riego-" . $aleatorio . ".pdf"));
                    if ($admin) {
                        echo $this->Ajax->link(" Eliminar", array('controller' => 'Properties', "action" => "delete_file", 6, $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Seguro de borrar el archivo?');
                    }
                }
                ?>
                <br>
                <br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/declaracion_extrajuicio.pdf")) {
                    echo $this->Html->link('Declaración extrajuicio.', "../files/Predio-" . $Property["Property"]["id"] . "/declaracion_extrajuicio.pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o', 'download' => "Declaracion_extrajuicio-" . $aleatorio . ".pdf"));
                    if ($admin) {
                        echo $this->Ajax->link(" Eliminar", array('controller' => 'Properties', "action" => "delete_file", 13, $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Seguro de borrar el archivo?');
                    }
                }
                ?>
                <br>
                <br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/junta_accion_comunal.pdf")) {
                    echo $this->Html->link('Junta acción comunal.', "../files/Predio-" . $Property["Property"]["id"] . "/junta_accion_comunal.pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o', 'download' => "Junta_accion_comunal-" . $aleatorio . ".pdf"));
                    if ($admin) {
                        echo $this->Ajax->link(" Eliminar", array('controller' => 'Properties', "action" => "delete_file", 10, $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Seguro de borrar el archivo?');
                    }
                }
                ?>
                <br>
                <br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/Uso_suelo.pdf")) {
                    echo $this->Html->link('Uso del suelo.', "../files/Predio-" . $Property["Property"]["id"] . "/Uso_suelo.pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o', 'download' => "Uso_del_suelo-" . $aleatorio . ".pdf"));
                    if ($admin) {
                        echo $this->Ajax->link(" Eliminar", array('controller' => 'Properties', "action" => "delete_file", 9, $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Seguro de borrar el archivo?');
                    }
                }
                ?>
                <?php
                if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/verificacion_predial.pdf")) {
                    echo $this->Html->link('Cruce ambiental preliminar.', "../files/Predio-" . $Property["Property"]["id"] . "/verificacion_predial.pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o', 'download' => "Cruce_ambiental_preliminar-" . $aleatorio . ".pdf"));
                    if ($admin) {
                        echo $this->Ajax->link(" Eliminar", array('controller' => 'Properties', "action" => "delete_file", 1, $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Seguro de borrar el archivo?');
                    }
                }
                ?>
                <br>
                <br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $Property["Property"]["id"] . "/tramites_ambientales.pdf")) {
                    echo $this->Html->link('Tramites y permisos ambientales', "../files/Predio-" . $Property["Property"]["id"] . "/tramites_ambientales.pdf", array('target' => 'blank', 'indicator' => 'loading', 'class' => 'btn btn-success fa fa-file-pdf-o', 'download' => "Tramites_permisos_ambientales-" . $aleatorio . ".pdf"));
                    if ($admin) {
                        echo $this->Ajax->link(" Eliminar", array('controller' => 'Properties', "action" => "delete_file", 4, $Property["Property"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'btn btn-danger fa fa-trash'), '¿Seguro de borrar el archivo?');
                    }
                }
                ?>
            </td>
        </tr>
    </tbody>
</table>
<?php echo $this->Html->link(' Volver', array('controller' => 'Properties', 'action' => 'index'), array('escape' => FALSE, 'update' => 'content', 'class' => 'btn btn-info fa fa-arrow-circle-left')); ?>