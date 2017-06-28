<div class="panel-heading">
    Condiciones Biofísicas óptimas para el desarrollo del proyecto
</div>
<div class="panel-body">
    <div class="row">
        <div class="col-lg-6">
            <?php echo $this->Form->create("Proyect", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "condiciones_biofisicas", $this->data['Proyect']['id']))); ?>
            <?php echo $this->Form->hidden('Proyect.id'); ?>
            <table border="0" width="800">
                <thead>
                    <tr>
                        <th>PARAMETROS</th>
                        <th>REQUERIMIENTOS EDAFOCLIMATICOS PARA EL SISTEMA PRODUCTIVO</th>
                        <th>CONDICIONES DE LA ZONA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Temperatura promedio (C &deg)</td>
                        <td><?php echo $this->Form->input('Proyect.temperatura_promedio_p', array('label'=>'','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.temperatura_promedio_r', array('label'=>'','class' => 'form-control')); ?></td>
                    </tr>
                    <tr>
                        <td>Altitud: – m.s.n.m</td>
                        <td><?php echo $this->Form->input('Proyect.altitud_p', array('label'=>'','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.altitud_r', array('label'=>'','class' => 'form-control')); ?></td>
                    </tr>
                    <tr>
                        <td>Suelos (Textura, estructura, pH, profundidad efectiva, etc.):</td>
                        <td><?php echo $this->Form->input('Proyect.suelos_p', array('label'=>'','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.suelos_r', array('label'=>'','class' => 'form-control')); ?></td>
                    </tr>
                    <tr>
                        <td>Topografía: (ondulada, pendientes, planas, etc.) (Textura, estructura, pH, profundidad efectiva, etc.):</td>
                        <td><?php echo $this->Form->input('Proyect.topografia_p', array('label'=>'','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.topografia_r', array('label'=>'','class' => 'form-control')); ?></td>
                    </tr>
                    <tr>
                        <td>Disponibilidad  de recursos hídricos (acueducto. Pozo profundo, aljibes, canales de riego, etc.):</td>
                        <td><?php echo $this->Form->input('Proyect.disponibilidad_hidrica_p', array('label'=>'','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.disponibilidad_hidrica_r', array('label'=>'','class' => 'form-control')); ?></td>
                    </tr>
                    <tr>
                        <td>Precipitación anual ó régimen de lluvias:</td>
                        <td><?php echo $this->Form->input('Proyect.precipitacion_anual_p', array('label'=>'','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.precipitacion_anual_r', array('label'=>'','class' => 'form-control')); ?></td>
                    </tr>
                </tbody>
            </table>

            <h3>Enfermedades, Plagas y su Control. (Mencionar brevemente las plagas y enfermedades más relevantes en la región)</h3>
            <?php echo $this->Form->input('Proyect.plagas', array('label'=>'Plagas y enfermedades','class' => 'form-control')); ?>
            <?php echo $this->Form->input('Proyect.control_plagas', array('label'=>'Manejo y/o Control','class' => 'form-control')); ?>
            <br><br>
            <?php echo $this->Form->input('Proyect.cosecha', array('label'=>'Manejo de Cosecha: (Descripción del proceso de cosecha) *Si aplica','class' => 'form-control')); ?>
            <?php echo $this->Form->input('Proyect.post_cosecha', array('label'=>'Manejo de Post-Cosecha: (Descripción del proceso de post-cosecha) *Si aplica','class' => 'form-control')); ?>


            <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')) ?>
        </div>
    </div>
</div>