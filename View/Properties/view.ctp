<?php echo $this->Html->link(' Volver', array('controller' => 'Properties', 'action' => 'index'), array('escape' => FALSE, 'update' => 'content', 'class' => 'btn btn-info fa fa-arrow-circle-left')); ?>
<br>
<table class="table table-striped table-bordered table-hover">
    <tbody>
    <td colspan="5"><center>
        <h3>INFORMACIÓN DEL PREDIO</h3>
    </center></td>
<tr>
    <td>
        Nombre del predio:
        <?php echo $property['Property']['nombre'] ?>
    </td>
    <td>
        Matrícula catastral:
        <?php echo $property['Property']['oficina_matricula'] . "-" . $property['Property']['numero_matricula'] ?>
    </td>
    <td>
        Código catastral:
        <?php echo $property['Property']['cedula_catastral'] ?>
    </td>
    <td>
        Departamento:
        <?php echo $property['Departament']['name'] ?>
    </td>
    <td>
        Municipio:
        <?php echo $property['City']['name'] ?>
    </td>
</tr> 
<tr>
    <td>
        Vereda:
        <?php echo $property['Property']['vereda'] ?>
    </td>
    <td>
        Corregimiento:
        <?php echo $property['Property']['corregimiento'] ?>
    </td>
    <td>
        Tipo tenencia:
        <?php echo $property['Property']['tipo_tenencia'] ?>    </td>
    <td>    </td>
    <td>    </td>
</tr>
<tr>
    <td>
        Total area en hectareas:
        <?php echo $property['Property']['area_total_ha'] ?>
    </td>
    <td>
        Total area en metros:
        <?php echo $property['Property']['area_total_m'] ?>
    </td>
    <td>   </td>
    <td>    </td>

    <td>    </td>
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
<?php echo $this->Html->link(' Volver', array('controller' => 'Properties', 'action' => 'index'), array('escape' => FALSE, 'update' => 'content', 'class' => 'btn btn-info fa fa-arrow-circle-left')); ?>