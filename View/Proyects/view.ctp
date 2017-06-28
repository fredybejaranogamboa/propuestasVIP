<?php

echo $this->Html->link(' Volver', array('controller' => 'Proyects', 'action' => 'index'), array('escape' => FALSE, 'update' => 'content', 'class' => 'btn btn-info fa fa-arrow-circle-left')); ?>
<br>
<table class="table table-striped table-bordered table-hover">
    <tbody>
    <td colspan="5"><center>
        <h3>INFORMACIÓN DEL PROYECTO</h3>
    </center></td>
<tr>
    <td>
        Codigo:
        <?php echo $proyect['Proyect']['codigo'] ?>
    </td>
    <td>
        Tipo:
        <?php echo $proyect['Proyect']['codigo'] ?>
    </td>
    <td>
        Nombre:
        <?php echo $proyect['Proyect']['nombre'] ?>
    </td>
</tr> 

</tbody>
</table>
<br><br>
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
                if (file_exists("../webroot/files/Predio-" . $property["Property"]["id"] . "/" . $property['Property']['ruta_resolucion']) and $property['Property']['ruta_resolucion'] != "")
                    echo $this->Html->link('Resolución', "../files/Predio-" . $property["Property"]["id"] . "/" . $property['Property']['ruta_resolucion'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                ?>
                <br>
                <br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $property["Property"]["id"] . "/" . $property['Property']['ruta_matricula']) and $property['Property']['ruta_matricula'] != "")
                    echo $this->Html->link('Matrícula inmobiliaria', "../files/Predio-" . $property["Property"]["id"] . "/" . $property['Property']['ruta_matricula'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                ?>
                <br><br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $property["Property"]["id"] . "/" . $property['Property']['archivo_distrito']) and $property['Property']['archivo_distrito'] != "")
                    echo $this->Html->link('Certificación_distrito_de_riego.', "../files/Predio-" . $property["Property"]["id"] . "/" . $property['Property']['archivo_distrito'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                ?>
                <br>
                <br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $property["Property"]["id"] . "/" . $property['Property']['archivo_uso_suelo']) and $property['Property']['archivo_uso_suelo'] != "")
                    echo $this->Html->link('Uso del suelo.', "../files/Predio-" . $property["Property"]["id"] . "/" . $property['Property']['archivo_uso_suelo'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                ?>
                <br>
                <br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $property["Property"]["id"] . "/" . $property['Property']['archivo_resguardo']) and $property['Property']['archivo_resguardo'] != "")
                    echo $this->Html->link('Certificación resguardo indígena.', "../files/Predio-" . $property["Property"]["id"] . "/" . $property['Property']['archivo_resguardo'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                ?>
                <br>
                <br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $property["Property"]["id"] . "/" . $property['Property']['archivo_consejo']) and $property['Property']['archivo_consejo'] != "")
                    echo $this->Html->link('Certificación consejo comunitario.', "../files/Predio-" . $property["Property"]["id"] . "/" . $property['Property']['archivo_consejo'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                ?>
            </td>
        </tr>
    </tbody>
</table>
<br>
<?php echo $this->Html->link(' Volver', array('controller' => 'Proyect', 'action' => 'index'), array('escape' => FALSE, 'update' => 'content', 'class' => 'btn btn-info fa fa-arrow-circle-left')); ?>