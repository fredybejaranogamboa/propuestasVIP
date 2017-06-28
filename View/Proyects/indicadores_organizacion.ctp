<div class="panel-heading">
    INDICADORES DE LA ORGANIZACIÓN
</div>
<div class="panel-body">
    <div class="row">
        <div class="col-lg-6">
            <?php echo $this->Form->create("Proyect", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "indicadores_organizacion", $this->data['Proyect']['id']))); ?>
            <?php echo $this->Form->hidden('Proyect.id'); ?>
            <table border="0" width="800">
                <tbody>
                    <tr>							
                        <td><?php echo $this->Form->input('Proyect.valor_total', array('label'=>'Inversión: (Valor total del Proyecto)','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.beneficiarios_definitivos', array('label'=>'Beneficiarios: (No definitivo de beneficiarios.)','class' => 'form-control')); ?></td>
                    </tr>
                    <tr>							
                        <td><?php echo $this->Form->input('Proyect.ventas_mensuales', array('label'=>'Valor Ventas Mensuales COP','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.utilidades', array('label'=>'Utilidades','class' => 'form-control')); ?></td>
                    </tr>
                    <tr>							
                        <td><?php echo $this->Form->input('Proyect.area_ampliacion', array('label'=>'Ampliación área productiva (No de Hectareas Nuevas a Intervenir)','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.area_acceso', array('label'=>'Acceso a tierras - Cantidad (No de hectareas intervenidas)','class' => 'form-control')); ?></td>
                    </tr>
                    <tr>							
                        <td><?php echo $this->Form->input('Proyect.valor_acceso', array('label'=>' Acceso a tierras - Valor (valor de los terrenos.)','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.acceso_credito', array('label'=>'Acceso crédito/valor/plazo/tasa: (Creditos adicionales para el desarrollo del Proyecto)','class' => 'form-control')); ?></td>
                    </tr>
                    <tr>							
                        <td><?php echo $this->Form->input('Proyect.empleo_directo', array('label'=>'Generación de empleo directo','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.empleo_indirecto', array('label'=>'Generación de empleo indirecto','class' => 'form-control')); ?></td>
                    </tr>
                </tbody>
            </table>
            <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')) ?>
        </div>
    </div>
</div>