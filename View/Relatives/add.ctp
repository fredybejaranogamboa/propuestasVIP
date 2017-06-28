<fieldset>
    <?php echo $this->Form->create("Relative", array('class' => 'form', "action" => "add/$candidate_id")); ?>
    <legend>3.1 Composición de la familia: </legend>
    <?php echo $this->Form->hidden('Relative.candidate_id', array('empty' => '', 'label' => '', 'value' => $candidate_id, 'type' => 'text')); ?>
    <?php echo $this->Form->input('Relative.primer_nombre', array('empty' => '', 'label' => '3.1.1 Primer Nombre', 'class' => 'required')); ?>
    <?php echo $this->Form->input('Relative.segundo_nombre', array('empty' => '', 'label' => '3.1.1 Segundo Nombre', 'class' => '')); ?>
    <?php echo $this->Form->input('Relative.primer_apelllido', array('empty' => '', 'label' => '3.1.1 Primer Apelllido', 'class' => 'required')); ?>
    <?php echo $this->Form->input('Relative.segundo_apellido', array('empty' => '', 'label' => '3.1.1 Segundo Apellido', 'class' => '')); ?>
    <?php echo $this->Form->input('Relative.genero', array('empty' => '', 'label' => '3.1.2 Género', 'class' => 'required', 'options' => array('Hombre' => 'Hombre', 'Mujer' => 'Mujer',))); ?>
    <?php echo $this->Form->input('Relative.edad', array('empty' => '', 'label' => '3.1.3 Edad', 'type' => 'number')); ?>
    <?php echo $this->Form->input('Relative.parentesco', array('empty' => '', 'label' => '3.1.4 Parentesco', 'class' => 'required', 'options' => array('Jefe de hogar' => 'Jefe de hogar', 'Esposo(a)/Conpañero(a)' => 'Esposo(a)/Conpañero(a)', 'Padre' => 'Padre', 'Madre' => 'Madre', 'Abuelo(a)' => 'Abuelo(a)', 'Hijo(a)' => 'Hijo(a)', 'Hermano(a)' => 'Hermano(a)', 'Nieto(a)' => 'Nieto(a)', 'Tio(a)' => 'Tio(a)', 'Sobrino(a)' => 'Sobrino(a)', 'Ahijado(a)' => 'Ahijado(a)', 'Cuñado(a)' => 'Cuñado(a)', 'Primo(a)' => 'Primo(a)', 'Otro' => 'Otro',))); ?>
    <?php echo $this->Form->input('Relative.estado_civil', array('empty' => '', 'label' => '3.1.5 Estado civil', 'class' => '', 'options' => array('Soltero' => 'Soltero(a)', 'Casado' => 'Casado(a)', 'Union libre' => 'Unión libre', 'Viudo' => 'Viudo(a)', 'Divorciado' => 'Divorciado(a)'))); ?>
    <?php echo $this->Form->input('Relative.ocupacion', array('empty' => '', 'label' => '3.1.6 Ocupación', 'class' => '', 'options' => array('Agricultor' => 'Agricultor', 'Ganadero' => 'Ganadero', 'Comerciante' => 'Comerciante', 'Artesano' => 'Artesano', 'Ama de casa' => 'Ama de casa', 'Estudiante' => 'Estudiante', 'Desempleado' => 'Desempleado', 'Pensionado' => 'Pensionado', 'Otro'))); ?>
    <?php echo $this->Form->input('Relative.escolaridad', array('empty' => '', 'label' => '3.1.7 Escolaridad', 'class' => 'required', 'options' => array('Ninguna' => 'Ninguna', 'Primaria' => 'Primaria', 'Secundaria' => 'Secundaria', 'Técnico' => 'Técnico', 'Tecnólogo' => 'Tecnólogo', 'Universitario' => 'Universitario'))); ?>
    <?php echo $this->Form->input('Relative.seguridad_social', array('empty' => '', 'label' => '3.1.8 Seguridad Social', 'class' => '', 'options' => array('Cotizante regimen contributivo' => 'Cotizante régimen contributivo', 'Beneficiario regimen contributivo' => 'Beneficiario régimen contributivo', 'Sisben' => 'Rég. Subsidiado (Sisben)', 'Otro' => 'Otro', 'Ninguno' => 'Ninguno'))); ?>
    <?php echo $this->Form->input('Relative.nivel_sisben', array('empty' => '', 'label' => '3.1.9 Nivel Sisben', 'class' => 'numeric')); ?>
    <?php echo $this->Form->input('Relative.prestadora_salud', array('empty' => '', 'label' => '3.1.10 EPS O ARS', 'class' => '')); ?>
    <?php echo $this->Form->input('Relative.discapacidad', array('empty' => '', 'label' => '3.1.11 Enfermedad o Discapacidad', 'class' => '')); ?>
    <?php echo $this->Form->end("Guardar") ?>
</fieldset>
    <table width="100%" border="0"  CellSpacing=10  align="center" >
        <tbody>
            <tr>          
                <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Relatives', 'action' => 'index', $candidate_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
            </tr>
        </tbody>
    </table>