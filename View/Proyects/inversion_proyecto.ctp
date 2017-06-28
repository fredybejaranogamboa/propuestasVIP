<div class="panel-heading">
    INVERSIÓN DEL PROYECTO
</div>
<div class="panel-body">
    <div class="row">
        <div class="col-lg-6">
            <?php echo $this->Form->create("Proyect", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "inversion_proyecto", $this->data['Proyect']['id']))); ?>
            <?php echo $this->Form->hidden('Proyect.id'); ?>
            <table border="0">
                <tbody>
                    <tr>							
                        <td><?php echo $this->Form->input('Proyect.destinacion', array('label'=>'Destinación principal de la inversión (Siembra; ampliación; mejoramiento, adquisición, adecuación, producción, comercialización, transformación, etc., mencionar en que sistema(s) productivo(s)).','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.transformacion', array('label'=>'Transformación Productiva Valor Agregado (Detalle maquinaria, equipos y producto)','class' => 'form-control')); ?></td>
                    </tr>
                    <tr>							
                        <td><?php echo $this->Form->input('Proyect.presentacion', array('label'=>'Presentación final del producto (nombre, Variedad, Cantidade(s), Peso, Presentación, Empaque o Embalaje)','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.incremento_proyectado', array('label'=>'Incremento Productividad/Rendimiento proyectada con la Inversión Kg/Ha; ton/Ha, etc. (Solo lo proyectado)','class' => 'form-control')); ?></td>
                    </tr>
                </tbody>
            </table>
            <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')) ?>
        </div>
    </div>
</div>