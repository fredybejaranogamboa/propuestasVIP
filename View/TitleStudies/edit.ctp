<script>

    $(document).ready(function() {
        $('.tip').tinyTips('title');
        $('.upper').keyup(function() {
            $(this).val($(this).val().toUpperCase());
        });
        $( "#calendario" ).datepicker();
        jQuery("#frm").validate({
            
        });
    }

)

</script>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'TitleStudies', 'action' => 'index', $this->data['TitleStudy']['property_id']), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>
<fieldset>
    <?php echo $this->Form->create("TitleStudy", array('id' => 'formulario', "action" => "edit/" . $this->data['TitleStudy']['id'])); ?>
    <legend>Edición de Estudio de título</legend>
    <?php echo $this->Form->hidden('TitleStudy.id') ?>   
    <?php echo $this->Form->hidden('TitleStudy.property_id'); ?>
    <?php echo $this->Form->input('TitleStudy.fecha', array('label' => 'Fecha estudio de título', 'class' => 'calendario', 'type' => 'text')); ?>
    <?php echo $this->Form->input('TitleStudy.pleno_dominio', array('label' => '¿Tiene pleno dominio?', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?>
    <?php
    echo $this->Form->input('TitleStudy.modo_adquisicion', array('label' => 'Modo de adquisición', 'empty' => '',
        'options' => array(
            '101' => '0101.- ACCESIÓN DEL SUELO',
            '102' => '0102.- ACTA ENTREGA DE INMUEBLES A ENTIDAD',
            '103' => '0103.- ADJUDICACIÓN BALDÍOS',
            '104' => '0104.- ADJUDICACIÓN BALDÍOS EN PROPIEDAD COLECTIVA A COMUNIDADES NEGRAS',
            '105' => '0105.- ADJUDICACIÓN BALDÍOS RESGUARDOS INDIGENAS',
            '106' => '0106.- ADJUDICACIÓN DE BIENES VACANTES',
            '107' => '0107.- ADJUDICACIÓN DE LA COSA HIPOTECADA',
            '108' => '0108.- ADJUDICACIÓN EN REMATE',
            '109' => '0109.- ADJUDICACIÓN EN SUCESIÓN',
            '110' => '0110.- ADJUDICACIÓN LIQUIDACIÓN DE LA COMUNIDAD',
            '111' => '0111.- ADJUDICACIÓN LIQUIDACIÓN SOCIEDAD COMERCIAL',
            '112' => '0112.- ADJUDICACIÓN LIQUIDACIÓN SOCIEDAD CONYUGAL',
            '113' => '0113.- ADJUDICACIÓN LIQUIDACIÓN SOCIEDAD PATRIMONIAL DE HECHO',
            '114' => '0114.- ADJUDICACIÓN POR EXPROPIACIÓN',
            '115' => '0115.- ADJUDICACIÓN SUCESIÓN PARTICIÓN ADICIONAL',
            '116' => '0116.- ADJUDICACIÓN UNIDAD AGRÍCOLA FAMILIAR --UAF--',
            '117' => '0117.- ADQUISICIÓN POR ABSORCIÓN DE ACCIONES Y PATRIMONIO DE ENTIDADES FINANCIERAS',
            '118' => '0118.- APORTE A SOCIEDAD',
            '119' => '0119.- APORTE DE SUBSIDIO EN ESPECIE',
            '120' => '0120.- CADUCIDAD ADMINISTRATIVA',
            '121' => '0121.- CESION A TITULO GRATUITO DE BIENES FISCALES',
            '122' => '0122.- CESION DE BIENES OBLIGATORIA',
            '123' => '0123.- CESION DE CONTRATO',
            '124' => '0124.- CESION OBLIGATORIA DE ZONAS CON DESTINO A USO PUBLICO',
            '125' => '0125.- COMPRAVENTA',
            '126' => '0126.- COMPRAVENTA PARCIAL',
            '127' => '0127.- CONSOLIDACION DE DOMINIO PLENO',
            '128' => '0128.- CONSTITUCIÓN DE FIDUCIA MERCANTIL',
            '129' => '0129.- DACION EN PAGO',
            '130' => '0130.- DACION EN PAGO OBLIGATORIA',
            '131' => '0131.- DECLARACION JUDICIAL DE PERTENENCIA',
            '132' => '0132.- DECLARATORIA DE NULIDAD DE ESCRITURA PUBLICA',
            '133' => '0133.- DECLARATORIA DE PROPIEDAD PUBLICA SOBRE ZONAS DE CESION OBLIGATORIA GRATUITA.',
            '134' => '0134.- DECLARATORIA RECUPERACION TITULARIDAD DE BIEN EXPROPIADO',
            '135' => '0135.- DECLARATORIA SIMULACION DE CONTRATO',
            '136' => '0136.- DECRETO DE POSESION EFECTIVA',
            '137' => '0137.- DESTINACION DEFINITIVA',
            '138' => '0138.- DONACION',
            '139' => '0139.- ESCISION',
            '140' => '0140.- EXPROPIACION POR VIA ADMINISTRATIVA',
            '141' => '0141.- EXPROPIACION POR VIA JUDICIAL',
            '142' => '0142.- EXTINCION DEL DERECHO DE DOMINIO PRIVADO',
            '143' => '0143.- FUSION',
            '144' => '0144.- PERMUTA',
            '145' => '0145.- PRESCRIPCION AGRARIA',
            '146' => '0146.- RATIFICACION CONTRATO',
            '147' => '0147.- RECUPERACION PARCIAL TITULARIDAD BIEN EXPROPIADO',
            '148' => '0148.- RECUPERACION TOTAL TITULARIDAD BIEN EXPROPIADO',
            '149' => '0149.- REINVINDICACION',
            '150' => '0150.- RENTA VITALICIA',
            '151' => '0151.- RESCILIACION',
            '152' => '0152.- RESCISION CONTRATO',
            '153' => '0153.- RESOLUCION CONTRATO',
            '154' => '0154.- RESTITUCION FIDEICOMISO CIVIL',
            '155' => '0155.- RESTITUCION EN FIDUCIA MERCANTIL',
            '156' => '0156.- REVERSION DEL BALDIO',
            '157' => '0157.- REVOCACION ADJUDICACION BALDIOS EN PROPIEDAD COLECTIVA A COMUNIDADES NEGRAS.',
            '158' => '0158.- REVOCATORIA ADMINISTRATIVA',
            '159' => '0159.- REVOCATORIA CONCURSAL',
            '160' => '0160.- REVOCATORIA JUDICIAL',
            '161' => '0161.- REVOCATORIA VOLUNTARIA',
            '162' => '0162.- TITULO DE MINAS CON ANTECEDENTE REGISTRAL',
            '163' => '0163.- TRANSACCIÓN',
            '164' => '0164.- TRANSFERENCIA DE DOMINIO A TITULO DE BENEFICIO EN FIDUCIA MERCANTIL',
            '165' => '0165.- TRANSFERENCIA DE DOMINO POR SOLUCIÓN O PAGO EFECTIVO.',
            '168' => '0168.- TRANSFERENCIA DE DOMINIO A TITULO DE LEASING HABITACIONAL DE VIVIENDA FAMILIAR. (Resolución No. 6851 de 2004)',
            '169' => '0169.- TRANSFERENCIA DE DOMINIO A TITULO DE LEASING HABITACIONAL DE VIVIENDA NO FAMILIAR. (Resolución No. 6851 de 2004)',
            '170' => '0170.- TITULACIÓN POR SANEAMIENTO CONTABLE. (Resolución No. 7520 de 2005).',
            '171' => '0171.- ENTREGA ANTICIPADA DE CESIONES. (Resolución No. 7520 de 2005).'
            )));
    ?>
    <?php echo $this->Form->input('TitleStudy.titulo_tipo', array('label' => 'Tipo de título', 'empty' => '', 'class' => '', 'options' => array('Escritura' => 'Escritura', 'Resolución' => 'Resolución', 'Sentencia' => 'Sentencia'))); ?>
    <?php echo $this->Form->input('TitleStudy.titulo_numero', array('label' => 'Número del título')); ?>
    <?php echo $this->Form->input('TitleStudy.titulo_fecha', array('label' => 'Fecha título', 'class' => 'calendario', 'type' => 'text')); ?>
    <?php echo $this->Form->input('TitleStudy.quien_expide_titulo', array('label' => 'Entidad que expide el título', 'class'=>'upper')); ?>
    
    <legend>Concepto y calificación final</legend>
    <?php echo $this->Form->input('TitleStudy.concepto_final', array('class' => 'txtarea', 'label' => 'Concepto final')); ?>
    <?php echo $this->Form->input('TitleStudy.calificacion', array('title'=>'Si la calificación es suspendido, cargue los documentos para el levantamiento de la suspensión','class'=>'tip','label' => 'calificación final', 'empty' => '', 'options' => array('Cumple' => 'Cumple', 'No cumple' => 'No cumple', 'Suspendido' => 'Suspendido'))); ?>
    <?php echo $this->Form->end("Guardar") ?>
</fieldset>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'TitleStudies', 'action' => 'index', $this->data['TitleStudy']['property_id']), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>