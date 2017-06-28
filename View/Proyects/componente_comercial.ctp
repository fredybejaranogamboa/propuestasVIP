<div class="panel-heading">
    COMPONENTE COMERCIAL
</div>
<div class="panel-body">
    <div class="row">
        <div class="col-lg-6">
            <?php echo $this->Form->create("Proyect", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "componente_comercial", $this->data['Proyect']['id']))); ?>
            <?php echo $this->Form->hidden('Proyect.id'); ?>
            <table border="0" width="800">
                <tbody>
                    <tr>
                        <td><?php echo $this->Form->input('Proyect.compradores_actuales', array('label'=>'Compradores actuales y alianzas comerciales','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.ubicacion_comprador', array('label'=>'Ubicación Comprador (ubicados en la misma zona o son externos)','class' => 'form-control')); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $this->Form->input('Proyect.potencial_compradores', array('label'=>'Potencial Nuevos Compradores: (Posibles o Nuevos)','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.valor_agregado', array('label'=>'Valor Agregado (Empaques al vacio, procesos de precocido, congelación, registros, etc)','class' => 'form-control')); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $this->Form->input('Proyect.porcentaje_ventas', array('label'=>'Porcentaje de Ventas Mercado Local y Externo (%)','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.valor_ventas', array('label'=>'Valor ventas mensuales/ semestrales /anuales','class' => 'form-control')); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $this->Form->input('Proyect.red_distribucion', array('label'=>'Red de distribución','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.flete_interno', array('label'=>'Costos flete interno','class' => 'form-control')); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $this->Form->input('Proyect.flete_externo', array('label'=>'Costos flete externo','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.empaque', array('label'=>'Precio empaque y embalaje','class' => 'form-control')); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $this->Form->input('Proyect.oferta', array('label'=>'Oferta (Volumen)','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.demanda', array('label'=>'Demanda (Volumen)','class' => 'form-control')); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $this->Form->input('Proyect.canal_distribucion', array('label'=>'Principal Canal de Comercialización y distribución','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.otro_distribucion', array('label'=>'Otros canales de comercialización y distribución','class' => 'form-control')); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $this->Form->input('Proyect.precio_producto', array('label'=>'Precio producto (Histórico)','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.competidores', array('label'=>'Principales Competidores','class' => 'form-control')); ?></td>
                    </tr>
                </tbody>
            </table>
            <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')) ?>
        </div>
    </div>
</div>