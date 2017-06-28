<script>
    $(document).ready(function() {
        $( "#accordion" ).accordion(
        {
            autoHeight: false,
            collapsible: true ,
            active: false
        }
    );
        jQuery("#form2").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content"
                });
            }
            
        });
        jQuery("#form1").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content"
                });
            }
            
        });
        jQuery("#form3").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content"
                });
            }
            
          
            
        });
        jQuery("#form4").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content"
                });
            }
            
        });
        jQuery("#form5").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content"
                });
            }
            
           
            
        });
        jQuery("#form6").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content"
                });
            }
            
        });
        jQuery("#form7").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content"
                });
            }
            
        });
        $( '#roads' ).load('<?php echo $this->Html->url(array('controller' => 'Roads', 'action' => 'index', $this->data['Property']['id'])) ?>');
        $( '#organizacion' ).load('<?php echo $this->Html->url(array('controller' => 'Organizations', 'action' => 'index', $this->data['Property']['id'])) ?>');
        $( '#hidricos' ).load('<?php echo $this->Html->url(array('controller' => 'WaterResources', 'action' => 'index', $this->data['Property']['id'])) ?>');
        $( '#cobertura' ).load('<?php echo $this->Html->url(array('controller' => 'Coverages', 'action' => 'index', $this->data['Property']['id'])) ?>');
        $( '#actividad' ).load('<?php echo $this->Html->url(array('controller' => 'Activities', 'action' => 'index', $this->data['Property']['id'])) ?>');
        $( '#area' ).load('<?php echo $this->Html->url(array('controller' => 'DegradedAreas', 'action' => 'index', $this->data['Property']['id'])) ?>');
        $( '#adicional' ).load('<?php echo $this->Html->url(array('controller' => 'Environments', 'action' => 'index', $this->data['Property']['id'])) ?>');
        $( '#unidad' ).load('<?php echo $this->Html->url(array('controller' => 'FloorUnits', 'action' => 'index', $this->data['Property']['id'])) ?>');
        $( '#actual' ).load('<?php echo $this->Html->url(array('controller' => 'FloorUtilities', 'action' => 'index', $this->data['Property']['id'])) ?>');
        $( '#control' ).load('<?php echo $this->Html->url(array('controller' => 'PropertyControls', 'action' => 'index', $this->data['Property']['id'])) ?>');
        $( '#explotacion' ).load('<?php echo $this->Html->url(array('controller' => 'ExploitationTypes', 'action' => 'index', $this->data['Property']['id'])) ?>');
    }
);

</script>
<div id="accordion">
    <h3><a href="#">CONTROL OPERATIVO</a></h3>
    <div id="control" >


    </div>
    <h3><a href="#">IDENTIFICACIÓN</a></h3>
    <div >
        <fieldset>
            <?php echo $this->Form->create("Property", array('id' => 'form1', "action" => "edit/" . $this->data['Property']['id'])); ?>
            <?php echo $this->Form->hidden('Property.id') ?>   
             <?php echo $this->Form->hidden('Property.sincronizado', array('value' => 0)); ?>
            <?php echo $this->Form->input('Property.proyect_id',array('empty'=>0)) ?>   
            <?php echo $this->Form->input('Property.nombre', array('label' => '2.1 Nombre del predio', 'class' => 'required')); ?>
            <?php echo $this->Form->input('Property.matricula', array('label' => '2.2 Número de Matrícula', 'class' => 'required')); ?>
            <?php echo $this->Form->input('Property.cedula_catastral', array('label' => '2.3 Número de Cédula Catastral', 'class' => 'required', 'type' => 'number')); ?>
            <?php echo $this->Form->input('Property.encuestado', array('label' => '2.4 Nombre del encuestado', )); ?>
            <?php echo $this->Form->input('Property.documento', array('label' => '2.5 Documento de identidad',)); ?>
            <?php
            echo $this->Ajax->observeField('PropertyDepartamentId', array(
                'url' => array('action' => 'select'),
                'frequency' => 0.2,
                'update' => 'ciudades',
                    )
            );
            ?>

            <?php echo $this->Form->input('Property.departament_id', array('label' => '2.6.1 Departamento', 'empty' => 'Seleccione departamento', 'class' => 'required')); ?>
            <div id="ciudades">
                <?php
                echo $this->Form->input('Property.city_id', array(
                    'label' => __('2.6.1 Municipio', true),
                    'empty' => __('Seleccione ciudad', true),
                        )
                );
                ?>
            </div>
            <?php echo $this->Form->input('Property.corregimiento', array('label' => '2.6.2 Corregimiento')); ?>
            <?php echo $this->Form->input('Property.vereda', array('label' => '2.6.3 Vereda')); ?>
            <?php echo $this->Form->input('Property.origen', array('label' => '2.7 Origen del predio', 'empty' => '', 'options' => array('FNA' => 'FNA (Fondo Nacional del Ahorro)', 'DNE' => 'DNE (Dirección Nacional de Estupefacientes)', 'Baldíos' => 'Baldíos', 'Acuicultura' => 'Acuicultura', 'Compra Directa' => 'Compra Directa'))); ?>
            <?php echo $this->Form->end("Guardar") ?>
        </fieldset> 

    </div>
    <h3><a href="#">VÍAS DE ACCESO</a></h3>
    <div id="roads" >


    </div>
    <h3><a href="#">UBICACIÓN</a></h3>
    <div  >
        <?php echo $this->Form->create("Property", array('id' => 'form2', "action" => "edit/" . $this->data['Property']['id'])); ?>
        <fieldset>
             <?php echo $this->Form->hidden('Property.sincronizado', array('value' => 0)); ?>     
            <?php echo $this->Form->hidden('Property.id', array('type' => 'text')) ?> 
            <?php echo $this->Form->hidden('Property.proyect_id') ?>  
            <?php echo $this->Form->input('Property.georeferencia1', array('label' => '2.10 Georeferenciación (escribir coordenada latitud-grado)', 'class' => 'required', 'type' => 'number')); ?>
            <?php echo $this->Form->input('Property.georeferencia2', array('label' => '2.10 Georeferenciación (escribir coordenadas latitud-minuto)', 'class' => 'required', 'type' => 'number')); ?>
            <?php echo $this->Form->input('Property.georeferencia3', array('label' => '2.10 Georeferenciación (escribir coordenadas latitud-segundo)', 'class' => 'required', 'type' => 'number')); ?>
            <?php echo $this->Form->input('Property.georeferencia4', array('label' => '2.10 Georeferenciación (escribir coordenadas longitud-grado)', 'class' => 'required', 'type' => 'number')); ?>
            <?php echo $this->Form->input('Property.georeferencia5', array('label' => '2.10 Georeferenciación (escribir coordenadas longitud-minuto)', 'class' => 'required', 'type' => 'number')); ?>
            <?php echo $this->Form->input('Property.georeferencia6', array('label' => '2.10 Georeferenciación (escribir coordenadas longitud-segundo)', 'class' => 'required', 'type' => 'number')); ?>
            <?php echo $this->Form->input('Property.extension', array('label' => '2.11 Extensión', 'class' => 'required', 'type' => 'number')); ?>
            <fieldset><legend>Predios Colindantes (Según Resolución)</legend>
                <?php echo $this->Form->input('Property.colindante_norte', array('label' => '2.12a Norte', 'class' => '')); ?>
                <?php echo $this->Form->input('Property.colindante_sur', array('label' => '2.12b Sur', 'class' => '')); ?>
                <?php echo $this->Form->input('Property.colindante_oriente', array('label' => '2.12c Oriente', 'class' => '')); ?>
                <?php echo $this->Form->input('Property.colindante_occidente', array('label' => '2.12d Occidente', 'class' => '')); ?>
            </fieldset>
            <fieldset><legend>III. Información social</legend>
                <?php echo $this->Form->input('Property.fam_beneficiaria_campesina', array('label' => '3.1a Familias beneficiarias campesinas', 'type' => 'number')); ?>
                <?php echo $this->Form->input('Property.fam_beneficiaria_desplazada', array('label' => '3.1b Familias beneficiarias desplazadas', 'type' => 'number')); ?>
                <?php echo $this->Form->input('Property.habitante_beneficiario_campesino', array('label' => '3.1c Habitantes beneficiarios campesinos', 'type' => 'number')); ?>
                <?php echo $this->Form->input('Property.habitante_beneficiario_desplazado', array('label' => '3.1d Habitantes beneficiarios desplazados', 'type' => 'number')); ?>
                <?php echo $this->Form->input('Property.habitante_no_beneficiario_campesino', array('label' => '3.1e Habitantes no beneficiarios campesinos', 'type' => 'number')); ?>
                <?php echo $this->Form->input('Property.habitante_no_beneficiario_desplazado', array('label' => '3.1f Habitantes no beneficiarios desplazados', 'type' => 'number')); ?>
                <?php echo $this->Form->input('Property.organization', array('label' => '3.2 ¿Las familias de este predio hacen parte de alguna organización?', 'class' => 'required', 'empty' => '', 'options' => array('SI' => 'SI', 'NO' => 'NO'))); ?>
            </fieldset>

        </fieldset>
        <?php echo $this->Form->end("Guardar") ?>
    </div>
    <h3><a href="#">ASOCIATIVIDAD Y/0 ORGANIZACIÓN</a></h3>
    <div id="organizacion">

    </div>
    <h3><a href="#">VIVIENDA</a></h3>
    <fieldset>
        <?php echo $this->Form->create("Property", array('id' => 'form3', "action" => "edit/" . $this->data['Property']['id'])); ?>
        <?php echo $this->Form->hidden('Property.id') ?>   
         <?php echo $this->Form->hidden('Property.sincronizado', array('value' => 0)); ?>
        <?php echo $this->Form->hidden('Property.proyect_id') ?>  
        <?php echo $this->Form->input('Property.vivienda', array('label' => '¿El predio cuenta con viviendas?', 'class' => 'required', 'empty' => '', 'options' => array('SI' => 'SI', 'NO' => 'NO'))); ?>
        <?php echo $this->Form->input('Property.vivienda_numero', array('label' => 'Número de viviendas', 'empty' => '', 'options' => array( 'Ninguna'=>'Ninguna', 'De 1 a 10' => 'De 1 a 10', 'De 11 a 20' => 'De 11 a 20', 'De 21 a 30' => 'De 21 a 30', 'De 31 a 40' => 'De 31 a 40', 'De 41 a 50' => 'De 41 a 50', 'De 51 a 70' => 'De 51 a 70', 'De 71 a 100' => 'De 71 a 100', 'Más de 100' => 'Más de 100'))); ?>
        <?php echo $this->Form->end("Guardar") ?>
    </fieldset>

    <h3><a href="#">SANEAMIENTO BÁSICO</a></h3>
    <fieldset>
        <?php echo $this->Form->create("Property", array('id' => 'form4', "action" => "edit/" . $this->data['Property']['id'])); ?>
        <?php echo $this->Form->hidden('Property.id') ?>  
        <?php echo $this->Form->hidden('Property.proyect_id') ?>  
        <?php echo $this->Form->input('Property.agua', array('label' => 'Abastecimiento de agua', 'class' => 'required', 'empty' => '', 'options' => array('Acueducto público' => 'Acueducto público', 'Pila pública' => 'Pila pública', 'Río, quebrada, manantial, nacimiento' => 'Río, quebrada, manantial, nacimiento', 'Agua lluvia' => 'Agua lluvia', 'Aguatero' => 'Aguatero', 'Acueducto comunal o veredal' => 'Acueducto comunal o veredal', 'Pozo sin bomba, aljibe o barreno' => 'Pozo sin bomba, aljibe o barreno', 'Pozo con bomba' => 'Pozo con bomba', 'Carrotanque' => 'Carrotanque', 'Otra' => 'Otra'))); ?>
        <?php echo $this->Form->end("Guardar") ?>
    </fieldset>
    <h3><a href="#">SERVICIOS PÚBLICOS</a></h3>
    <fieldset>
        <?php echo $this->Form->create("Property", array('id' => 'form5', "action" => "edit/" . $this->data['Property']['id'])); ?>
        <?php echo $this->Form->hidden('Property.id') ?>  
         <?php echo $this->Form->hidden('Property.sincronizado', array('value' => 0)); ?>
        <?php echo $this->Form->hidden('Property.proyect_id') ?>  
        <?php echo $this->Form->input('Property.electricidad', array('label' => 'Electricidad', 'class' => '', 'type' => 'checkbox')); ?>
        <?php echo $this->Form->input('Property.gas', array('label' => 'Gas', 'class' => '', 'type' => 'checkbox')); ?>
        <?php echo $this->Form->input('Property.telefono_fijo', array('label' => 'Telefonía fija', 'class' => '', 'type' => 'checkbox')); ?>
        <?php echo $this->Form->input('Property.ninguno', array('label' => 'Ninguno', 'class' => '', 'type' => 'checkbox')); ?>
        <?php echo $this->Form->end("Guardar") ?>
    </fieldset>
    <h3><a href="#">ASPECTOS BIOFÍSICOS</a></h3>
    <fieldset><legend>3.10 Adición de Aspectos biofísicos</legend>
        <?php echo $this->Form->create("Property", array('id' => 'form6', "action" => "edit/" . $this->data['Property']['id'])); ?>
        <?php echo $this->Form->hidden('Property.id') ?>  
         <?php echo $this->Form->hidden('Property.sincronizado', array('value' => 0)); ?>
        <?php echo $this->Form->hidden('Property.proyect_id') ?>  
        <?php echo $this->Form->input('Property.altitud_max', array('label' => 'Altitud máxima (msnm)', 'class' => 'required', 'type' => 'number')); ?>
        <?php echo $this->Form->input('Property.altitud_min', array('label' => 'Altitud mínima (msnm)', 'class' => 'required', 'type' => 'number')); ?>
        <?php echo $this->Form->input('Property.temperatura_max', array('label' => 'Temperatura máxima (ºC)', 'class' => 'required', 'type' => 'number')); ?>
        <?php echo $this->Form->input('Property.temperatura_min', array('label' => 'Temperatura mínima (ºC)', 'class' => 'required', 'type' => 'number')); ?>
        <?php echo $this->Form->input('Property.piso', array('label' => 'Piso Térmico', 'class' => 'required', 'empty' => '', 'options' => array('Cálido' => 'Cálido', 'Templado' => 'Templado', 'Frío' => 'Frío'))); ?>
        <?php echo $this->Form->input('Property.lluvias', array('label' => 'Distribución de las lluvias', 'class' => '', 'empty' => '', 'options' => array('Bimodal' => 'Bimodal', 'Monomodal' => 'Monomodal'))); ?>
        <?php echo $this->Form->end("Guardar") ?>
    </fieldset>
    <h3><a href="#">RECURSOS HÍDRICOS</a></h3>
    <div id="hidricos">

    </div>
    <h3><a href="#">UNIDADES DE SUELO</a></h3>
    <fieldset>
        <div id="unidad">

        </div>
    </fieldset>
    <h3><a href="#">TIPOS DE EXPLOTACIÓN</a></h3>
    <div id="explotacion">
        <fieldset>
        </fieldset>
    </div>
    <h3><a href="#">USO ACTUAL DEL SUELO</a></h3>
    <div id="actual">

    </div>
    <h3><a href="#">USO POTENCIAL DE PREDIO</a></h3>
    <fieldset>
        <?php echo $this->Form->create("Property", array('id' => 'form7', "action" => "edit/" . $this->data['Property']['id'])); ?>
        <?php echo $this->Form->hidden('Property.id') ?>   
        <?php echo $this->Form->hidden('Property.proyect_id') ?>  
         <?php echo $this->Form->hidden('Property.sincronizado', array('value' => 0)); ?>
        <?php echo $this->Form->input('Property.origen_productivo', array('label' => '3.15 Origen del predio', 'class' => '', 'empty' => '', 'options' => array('Agrícola' => 'Agrícola', 'Pecuaría' => 'Pecuaría', 'Acuícola' => 'Acuícola'))); ?>
        <?php echo $this->Form->input('Property.tipo_otro', array('label' => 'Otro ¿Cuál?', 'class' => '')); ?>
        <?php echo $this->Form->input('Property.lineas_productivas', array('label' => '3.16 Mencionar la(s) línea(s) productiva(s) posible(s) a implementar', 'class' => 'required')); ?>
        <?php echo $this->Form->input('Property.area_explotacion', array('label' => '3.17 Áreas de explotación (Ha)', 'class' => 'required', 'type' => 'number')); ?>
        <?php echo $this->Form->input('Property.infraestructura', array('label' => '3.18 a De acuerdo a su experiencia y las líneas productivas que desea implementar responda, ¿Existe infraestructura?', 'class' => 'required', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
        <?php echo $this->Form->input('Property.infraestructura_tipo', array('label' => 'b Tipo de infraestructura', 'class' => 'required', 'options' => array('empty' => '', 'Beneficiadero' => 'Beneficiadero', 'Establos' => 'Establos', 'Bodega' => 'Bodega'))); ?>
        <?php echo $this->Form->input('Property.tipo_otro2', array('label' => 'Otro ,¿Cuál?')); ?>
        <?php echo $this->Form->input('Property.observacion', array('label' => 'Observaciones')); ?>
        <?php echo $this->Form->end("Guardar") ?>
    </fieldset>
    <h3><a href="#">INFORMACIÓN AMBIENTAL</a></h3>
    <fieldset><legend>3.19 Cobertura del predio (Colocar Área  y Porcentaje en el espacio)</legend>
        <div id="cobertura">

        </div>
        <fieldset><legend>3.20 Existencia de áreas degradadas o en deterioro (Colocar Área  y Porcentaje en el espacio)</legend>
            <div id="area">

            </div>
        </fieldset>
        <fieldset><legend>3.21 Actividades realizadas en el predio</legend>
            <div id="actividad">

            </div>
        </fieldset>

        <fieldset><legend>INFORMACIÓN ADICIONAL</legend>
            <div id="adicional">

            </div>
        </fieldset>
    </fieldset>


</div>    
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Properties', 'action' => 'index'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>