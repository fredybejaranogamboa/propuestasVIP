<div class="panel-heading">
    COMPONENTE AMBIENTAL
</div>
<div class="panel-body">
    <div class="row">
        <div class="col-lg-6">
            <?php echo $this->Form->create("Proyect", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "componente_ambiental", $this->data['Proyect']['id']))); ?>
            <?php echo $this->Form->hidden('Proyect.id'); ?>

            <?php echo $this->Form->input('Proyect.componente_ambiental', array('label'=>'Componente Ambiental y Sanitario (POT, CAR, normativa legal vigente, Min Ambiente,  INVIMA, ICA, AUNAP)','class' => 'form-control')); ?>
            <?php echo $this->Form->input('Proyect.uso_potencial_suelo', array('label'=>'Uso Potencial del Suelo','class' => 'form-control')); ?>

            <h3>Certificaciones a Obtener</h3>
            <table border="0">
                <thead>													
                    <tr>
                        <th>Nombre</th>
                        <th>Tiempo certificación</th>
                        <th>Inversión</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>							
                        <td>BPA</td>
                        <td><?php echo $this->Form->input('Proyect.bpa_tiempo', array('label'=>'','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.bpa_inversion', array('label'=>'','class' => 'form-control')); ?></td>
                    </tr>
                    <tr>							
                        <td>BPG</td>
                        <td><?php echo $this->Form->input('Proyect.bpg_tiempo', array('label'=>'','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.bpg_inversion', array('label'=>'','class' => 'form-control')); ?></td>
                    </tr>
                    <tr>							
                        <td>BPM</td>
                        <td><?php echo $this->Form->input('Proyect.bpm_tiempo', array('label'=>'','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.bpm_inversion', array('label'=>'','class' => 'form-control')); ?></td>
                    </tr>
                    <tr>							
                        <td>ORGANICA</td>
                        <td><?php echo $this->Form->input('Proyect.organica_tiempo', array('label'=>'','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.organica_inversion', array('label'=>'','class' => 'form-control')); ?></td>
                    </tr>
                    <tr>							
                        <td>RAINFOREST</td>
                        <td><?php echo $this->Form->input('Proyect.rainforest_tiempo', array('label'=>'','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.rainforest_inversion', array('label'=>'','class' => 'form-control')); ?></td>
                    </tr>
                    <tr>							
                        <td>OTRAS</td>
                        <td><?php echo $this->Form->input('Proyect.otra_cert_tiempo', array('label'=>'','class' => 'form-control')); ?></td>
                        <td><?php echo $this->Form->input('Proyect.otra_cert_inversion', array('label'=>'','class' => 'form-control')); ?></td>
                    </tr>
                </tbody>
            </table>
            <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')) ?>
        </div>
    </div>
</div>