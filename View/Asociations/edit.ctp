<script>
    $(document).ready(function () {
        $("#formulario").validate({
            rules: {
                'data[Asociation][email]': {
                    email: true
                }
            }
        });
    });
    $(function () {
        $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "1990:2017"
        });
    });
</script>
<fieldset>
    <?php echo $this->Form->create("Asociation", array('novalidate' => '', 'id' => 'formulario', 'role' => "form", "class" => "form", 'enctype' => 'multipart/form-data', 'type' => 'file', 'url' => array("action" => "edit", $this->data['Asociation']['id']))); ?>
    <h3>Datos asociación</h3>
    <div>
        <?php echo $this->Form->hidden('Asociation.proyect_id'); ?>
        <?php echo $this->Form->hidden('Asociation.id'); ?>
        <?php echo $this->Form->input('Asociation.direccion', array('label' => 'Dirección de correspondencia', 'class' => 'form-control')); ?>
        <?php echo $this->Form->input('Asociation.email', array('label' => 'Correo electrónico', 'class' => 'form-control')); ?>
        <?php echo $this->Form->input('Asociation.telefono', array('label' => 'Teléfono de contacto', 'class' => 'form-control')); ?>
    <?php
    echo $this->Ajax->observeField('AsociationDepartamentId', array(
        'url' => array('action' => 'select', 'controller' => 'Asociations'),
        'frequency' => 0.2,
        'update' => 'ciudades',
            )
    );
    ?>

    <?php echo $this->Form->input('Asociation.departament_id', array('label' => ' Departamento', 'required' => '', 'class' => 'form-control', 'empty' => 'Seleccione departamento', 'options' => $departaments, 'selected' => $departament_id)); ?>
    <div id="ciudades">
        <?php
        echo $this->Form->input('Asociation.city_id', array(
            'label' => __(' Municipio', true),
            'empty' => __('Seleccione ciudad', true),
            'class' => 'form-control',
            'required' => ''
                )
        );
        ?>
    </div>   
        <?php echo $this->Form->input('Asociation.vereda', array('label'=>'Vereda', 'class'=>'form-control')); ?>
 </div>   
    <br><br>
    <table border="0">
        <tbody>
            <tr>
                <td>Certificado de existencia y representación legal o el que haga sus veces</td>
                <td><?php
                    echo $this->Form->file('Asociation.existencia', array('label' => 'Certificado de existencia y representación legal',
                        'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'aria-required' => 'true',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>RUT</td>
                <td><?php
                    echo $this->Form->file('Asociation.rut', array('label' => 'RUT', 'accept' => 'pdf', 'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'aria-required' => 'true',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>Fotocopia cédula representante legal</td>
                <td><?php
                    echo $this->Form->file('Asociation.cedulaRepresentante', array('label' => 'Cédula representante legal', 'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'aria-required' => 'true',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>VIP-F1 certificación y autorización potenciales beneficiarios</td>
                <td><?php
                    echo $this->Form->file('Asociation.certificado', array('label' => 'Certificado asociación', 'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'aria-required' => 'true',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>Acta de posesión</td>
                <td><?php
                    echo $this->Form->file('Asociation.posesion', array('label' => 'Acta de posesión', 'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'aria-required' => 'true',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>Certificación contrapartida</td>
                <td><?php
                    echo $this->Form->file('Asociation.certificacion_contrapartida', array('label' => 'Certificación contrapartida', 'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'aria-required' => 'true',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
            <tr>
                <td>Resolución adjudicación</td>
                <td><?php
                    echo $this->Form->file('Asociation.f28', array('label' => 'Resolución adjudicación', 'class' => 'form-control',
                        'accept' => 'application/pdf',
                        'aria-required' => 'true',
                        'extension' => 'pdf'));
                    ?></td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <?php echo $this->Form->input('Asociation.observacion', array('label' => 'Observación', 'class' => 'form-control')); ?>
    <br>
    <?php if ($permitir) echo $this->Form->end(array('label' => "Guardar", 'class' => 'btn btn-default')) ?>
</fieldset>