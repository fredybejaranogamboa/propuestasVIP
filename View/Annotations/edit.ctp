<script>

    $(document).ready(function() {
        $('.tip').tinyTips('title');
        selectDiv();
        $('#tipo').change(function() {
            selectDiv();
        });
        $( "#calendario" ).datepicker();
        jQuery("#frm").validate({
            
        });
    }

)

    function selectDiv() {
        //borro el valor en tipo_secundario
        //$('#AnnotationTipoSecundario.input').attr('value') == ''
        
        switch($('#tipo option:selected').val()) {
            case 'Falsa tradición':
                $('#falsa').show("fast");
                $('#gravamen').hide("fast");
                $('#limitacion').hide("fast");
                $('#medida').hide("fast");
                $('#titulo').hide("fast");
                $('#otra').hide("fast");
                $('#observacion').hide("fast");
                break;
            case 'Gravamen':
                $('#gravamen').show("fast");
                $('#falsa').hide("fast");
                $('#limitacion').hide("fast");
                $('#medida').hide("fast");
                $('#titulo').hide("fast");
                $('#otra').hide("fast");
                $('#observacion').hide("fast");
                break;
            case 'Limitación al derecho de dominio':
                $('#limitacion').show("fast");
                $('#falsa').hide("fast");
                $('#gravamen').hide("fast");
                $('#medida').hide("fast");
                $('#titulo').hide("fast");
                $('#otra').hide("fast");
                $('#observacion').show("fast");
                break;
            case 'Medida cautelar':
                $('#medida').show("fast");
                $('#falsa').hide("fast");
                $('#gravamen').hide("fast");
                $('#limitacion').hide("fast");
                $('#titulo').hide("fast");
                $('#otra').hide("fast");
                $('#observacion').hide("fast");
                break;
            case 'Título de tenencia':
                $('#titulo').show("fast");
                $('#falsa').hide("fast");
                $('#gravamen').hide("fast");
                $('#limitacion').hide("fast");
                $('#medida').hide("fast");
                $('#otra').hide("fast");
                $('#observacion').hide("fast");
                break;
            case 'Otra circunstancia':
                $('#otra').show("fast");
                $('#falsa').hide("fast");
                $('#gravamen').hide("fast");
                $('#limitacion').hide("fast");
                $('#medida').hide("fast");
                $('#titulo').hide("fast");
                $('#observacion').hide("fast");
                break;
            default:
                $('#otra').hide("fast");
                $('#falsa').hide("fast");
                $('#gravamen').hide("fast");
                $('#limitacion').hide("fast");
                $('#medida').hide("fast");
                $('#titulo').hide("fast");
                $('#observacion').hide("fast");
                break;
                    
        }
    }
</script>
<fieldset >
    <?php echo $this->Form->create("Annotation", array('id' => 'formulario', "action" => "edit/" . $this->data['Annotation']['id'] . "/" . $property_id)); ?>
    <legend>Edición de Estudio de título</legend>
    <?php echo $this->Form->hidden('Annotation.title_study_id'); ?>
    <?php echo $this->Form->hidden('Annotation.id') ?>   

    <?php
    echo $this->Form->input('Annotation.tipo_principal', array('label' => 'Tipo anotación', 'empty' => '', 'id' => 'tipo',
        'options' => array(
            'Gravamen' => 'Gravamen',
            'Limitación al derecho de dominio' => 'Limitación al derecho de dominio',
            'Medida cautelar' => 'Medida cautelar',
            'Otra circunstancia' => 'Otra circunstancia que se advierte en el certificado de tradición'
            )));
    ?>
    <div id="falsa">
        <?php
        echo $this->Form->input('Annotation.tipo_secundario1', array('label' => 'Tipo falsa tradición', 'empty' => '',
            'options' => array(
                '601' => '0601.- ADJUDICACION SUCESION DERECHOS Y ACCIONES',
                '602' => '0602.- ADJUDICACION SUCESION GANANCIALES',
                '603' => '0603.- AFECTACION A VIVIENDA FAMILIAR SOBRE MEJORAS EN PREDIO AJENO. PAR. ART. 5º LEY 258/96.',
                '604' => '0604.- COMPRAVENTA DE COSA AJENA',
                '605' => '0605.- COMPRAVENTA DE CUERPO CIERTO TENIENDO SOLO DERECHOS DE CUOTA CON ANTECEDENTE REGISTRAL',
                '606' => '0606.- COMPRAVENTA DERECHOS GANANCIALES',
                '607' => '0607.- COMPRAVENTA DERECHOS Y ACCIONES',
                '608' => '0608.- COMPRAVENTA POSESION CON ANTECEDENTE REGISTRAL',
                '609' => '0609.- DECLARACION MEJORAS EN PREDIO AJENO. PAR. ART 5º LEY 258/96',
                '610' => '0610.- DONACION DERECHOS Y ACCIONES',
                '611' => '0611.- DONACION GANANCIALES',
                '612' => '0612.- PATRIMONIO DE FAMILIA SOBRE MEJORAS EN PREDIO AJENO. PAR. ART 5º LEY 258/96',
                '613' => '0613.- REMATE DERECHOS Y ACCIONES',
                '614' => '0614.- REMATE GANACIALES',
                '615' => '0615.- ADJUDICACIÓN LIQUIDACIÓN SOCIEDAD CONYUGAL DERECHOS Y ACCIONES. (Creado Res. 2708 de 2001).',
                '616' => '0616.- COMPRAVENTA MEJORAS SUELO AJENO CON ANTECEDENTE REGISTRAL. (Creado Res. 2708 de 2001).',
                '617' => '0617.- DACION EN PAGO DE DERECHOS Y ACCIONES. (Creado Res. 2708 de 2001).',
                '618' => '0618.- TRANSFERENCIA DE POSESION CON ANTECEDENTE REGISTRAL. (Creado Res. 0625 de 2002).'
                )));
        ?>
    </div>
    <div id="gravamen">
        <?php
        echo $this->Form->input('Annotation.tipo_secundario2', array('label' => 'Tipo gravamen', 'empty' => '',
            'options' => array(
                '201' => '0201.- AMPLIACIÓN DE HIPOTECA',
                '202' => '0202.- CONSTITUCIÓN DE MOBILIZACIÓN',
                '203' => '0203.- HIPOTECA',
                '204' => '0204.- HIPOTECA ABIERTA',
                '205' => '0205.- HIPOTECA CON CUANTÍA INDETERMINADA',
                '206' => '0206.- HIPOTECA DE BIENES EN USUFRUCTO',
                '207' => '0207.- HIPOTECA DE DERECHOS Y ACCIONES',
                '208' => '0208.- HIPOTECA DE GANANCIALES',
                '209' => '0209.- HIPOTECA DE MINAS CON ANTECEDENTE REGISTRAL',
                '210' => '0210.- HIPOTECA DE UNIDAD AGRICOLA FAMILIAR',
                '211' => '0211.- HIPOTECA DE DERECHOS DE CUOTA.',
                '212' => '0212.- VALORIZACIÓN',
                '213' => '213.- HIPOTECA NUDA PROPIEDAD. (Creado Res. 2708/2001)',
                '214' => '0214.- LIQUIDACIÓN DEL EFECTO PLUSVALÍA. (Resolución No. 6851 de 2004)'
                )));
        ?>
    </div>
    <div id="limitacion">
        <?php
        echo $this->Form->input('Annotation.tipo_secundario3', array('label' => 'Tipo Limitación al derecho de dominio', 'empty' => '',
            'options' => array(
                '301' => '0301.- ADJUDICACIÒN SUCESIÒN DERECHOS DE CUOTA',
                '302' => '0302.- ADJUDICACION SUCESION NUDA PROPIEDAD',
                '303' => '0303.- ADJUDICACION SUCESION SUBSUELO CON ANTECEDENTE REGISTRAL.',
                '304' => '0304.- AFECTACION A VIVIENDA FAMILIAR.',
                '305' => '0305.- AFECTACION POR CAUSA DE UNA OBRA PUBLICA.',
                '306' => '0306.- CAMBIO REGIMEN DE COPROPIEDAD.',
                '307' => '0307.- COMPRAVENTA DERECHOS DE CUOTA',
                '308' => '0308.- COMPRAVENTA NUDA PROPIEDAD',
                '309' => '0309.- COMPRAVENTA SUBSUELO CON ANTECEDENTE REGISTRAL',
                '310' => '0310.- COMPRAVENTA USUFRUCTO',
                '311' => '0311.- CONDICION RESOLUTORIA EXPRESA',
                '312' => '0312.- CONDICION SUSPENSIVA.',
                '313' => '0313.- CONSTITUCION DE FIDEICOMISO CIVIL.',
                '314' => '0314.- CONSTITUCION DE USUFRUCTO',
                '315' => '0315.- CONSTITUCION PATRIMONIO DE FAMILIA.',
                '316' => '0316.- CONSTITUCION REGIMEN DE CONDOMINIO.',
                '317' => '0317.- CONSTITUCIÓN REGLAMENTO DE PROPIEDAD HORIZONTAL.',
                '318' => '0318.- DECLARATORIA DE INDIVISION',
                '319' => '0319.- DERECHO DE HABITACION',
                '320' => '0320.- DERECHO DE USO',
                '321' => '0321.- DESLINDE Y AMOJONAMIENTO',
                '322' => '0322.- -DONACION NUDA PROPIEDAD',
                '323' => '0323.- DONACION DE USUFRUCTO',
                '324' => '0324.- LIQUIDACION DEL EFECTO DE PLUSVALIA',
                '325' => '0325.- MEDIANERIA',
                '326' => '0326.- PACTO COMISORIO',
                '327' => '0327.- PACTO DE INDIVISION',
                '328' => '0328.- PACTO DE RESERVA DE DOMINIO',
                '329' => '0329.- PACTO DE RETROVENTA',
                '330' => '0330.- REFORMA REGIMEN DE CONDOMINIO',
                '331' => '0331.- REFORMA REGLAMENTO DE PROPIEDAD HORIZONTAL',
                '332' => '0332.- REMATE DERECHO DE CUOTA',
                '333' => '0333.- RESERVA DERECHO DE USUFRUCTO',
                '334' => '0334.- SERVIDUMBRE DE ACUEDUCTO ACTIVA.',
                '335' => '0335.- SERVIDUMBRE DE ACUEDUCTO PASIVA',
                '336' => '0336.-SERVIDUMBRE DE AGUAS NEGRAS ACTIVA',
                '337' => '0337.- SERVIDUMBRE DE AGUAS NEGRAS PASIVA',
                '338' => '0338.- SERVIDUMBRE DE AIRE',
                '339' => '0339.- SERVIDUMBRE DE ENERGÌA ELÈCTRICA',
                '340' => '0340.- SERVIDUMBRE DE GASODUCTO',
                '341' => '0341.- SERVIDUMBRE DE LUZ.',
                '342' => '0342.- SERVIDUMBRE DE OLEODUCTO',
                '343' => '0343.- SERVIDUMBRE DE TRANSITO ACTIVA',
                '344' => '0344.- SERVIDUMBRE DE TRANSITO PASIVA',
                '345' => '0345.- SERVIDUMBRE ECOLÓGICA',
                '345' => '0345.- AFECTACIÓN POR CAUSA DE CATEGORÍAS AMBIENTALES (SERVIDUMBRE ECOLÓGICA). (Mod. Res. 2708 de 2001).',
                '346' => '0346.- ADICION REGIMEN DE CONDOMINIO. (Creado Res. 2708/2001)',
                '347' => '0347.- ADICION REGIMEN DE PROPIEDAD HORIZONTAL. (Creado Res. 2708/2001)',
                '348' => '0348.- ADJUDICACION LIQUIDACIÓN DE LA SOCIEDAD CONYUGAL DERECHO DE CUOTA.',
                '349' => '0349.- ADJUDICACION LIQUIDACIÓN DE LA SOCIEDAD CONYUGAL NUDA PROPIEDAD. (Creado Res. 2708/2001).',
                '350' => '0350.- SERVIDUMBRE DE AGUA ACTIVA. (Creado Res. 2708/2001).',
                '351' => '0351.- SERVIDUMBRE DE AGUA PASIVA. (Creado Res. 2708/2001).',
                '352' => '0352.- DECLARATORIA DE ZONAS DE INMINENCIA DE RIESGO DE DESPLAZAMIENTO Y DE DESPLAZAMIENTO FORZADO. (Resolución No. 7520 de 2005)',
                '353' => '0353.- DECLARATORIA DE ZONA DE DESPLAZAMIENTO FORZADO. (Creado Res. 4043/2002).',
                '354' => '0354.- SERVIDUMBRE MINERA. (Resolución No. 6851 de 2004)'
                )));
        ?>
    </div>
    <div id="medida">
        <?php
        echo $this->Form->input('Annotation.tipo_secundario4', array('label' => 'Tipo Medida cautelar', 'empty' => '',
            'options' => array(
                '401' => '0401.- COMISO ESPECIAL',
                '402' => '0402.- DECLARACION NO PODRA REMATARSE, ADJUDICARSE, NI ENAJENARSE A NINGUN TITULO BIENES DEL GARANTE',
                '403' => '0403.- DECLARATORIA DE INTERES SOCIAL',
                '404' => '0404.- DECLARATORIA DE UTILIDAD PUBLICA',
                '405' => '0405.- DECOMISO DE BIENES',
                '406' => '0406.- DEMANDA EN ACCION DE SIMULACION',
                '407' => '0407.- DEMANDA EN ACCION REVOCATORIA',
                '408' => '0408.- DEMANDA EN ACUERDO DE REESTRUCTURACION',
                '409' => '0409.- DEMANDA EN PROCESO DE DECLARATORIA DE UNION MARITAL DE HECHO',
                '410' => '0410.- DEMANDA EN PROCESO DE DESLINDE Y AMOJONAMIENTO',
                '411' => '0411.- DEMANDA EN PROCESO DE DIVORCIO',
                '412' => '0412.- DEMANDA EN PROCESO DE PERTENENCIA',
                '413' => '0413.- DEMANDA EN PROCESO DE SEPARACION DE CUERPOS',
                '414' => '0414.- DEMANDA EN PROCESO DE SERVIDUMBRES',
                '415' => '0415.- DEMANDA EN PROCESO DIVISORIO',
                '416' => '0416.- DEMANDA EN PROCESO DE SEPARACION DE BIENES',
                '417' => '0417.- DEMANDA ORDINARIA DE ENRIQUECIMIENTO SIN JUSTA CAUSA',
                '418' => '0418.- DEMANDA ORDINARIA POR LESION ENORME',
                '419' => '0419.- DEMANDA POR EXPROPIACION',
                '420' => '0420.-DEMANDA POR INEFICACIA DEL ACUERDO DE REESTRUCTURACION',
                '421' => '0421.- DERECHO DE PREFERENCIA',
                '422' => '0422.- EMBARGO CONCORDATARIO',
                '423' => '0423.- EMBARGO DE ALIMENTOS',
                '424' => '0424.-EMBARGO DE BIENES Y HABERES DE PROPIEDAD DEL INTERVENIDO',
                '425' => '0425.- EMBARGO DE LA SUCESION',
                '426' => '0426.- EMBARGO DE DERECHOS Y ACCIONES POR GARANTIA HIPOTECARIA',
                '427' => '0427.- EMBARGO EJECUTIVO CON ACCION PERSONAL',
                '428' => '0428.- EMBARGO EJECUTIVO CON ACCION MIXTA',
                '429' => '0429.- EMBARGO EJECUTIVO CON ACCION REAL',
                '430' => '0430.- EMBARGO EJECUTIVO DERECHOS DE CUOTA',
                '431' => '0431.- EMBARGO EN ACCION DE SIMULACION',
                '432' => '0432.- EMBARGO EN ACCION REVOCATORIA',
                '433' => '0433.-EMBARGO EN ACUERDO DE REESTRUCTURACION',
                '434' => '0434.- EMBARGO EN LIQUIDACION OBLIGATORIA',
                '435' => '0435.- EMBARGO EN PROCESO DE DIVORCIO',
                '436' => '0436.- EMBARGO EN PROCESO DE FISCALIA',
                '437' => '0437.- EMBARGO EN PROCESO DE SEPARACION DE BIENES',
                '438' => '0438.- EMBARGO ESPECIAL ART. 341 CODIGO DE PROCEDIMIENTO PENAL',
                '438' => '0438.- EMBARGO ESPECIAL ART. 66. CODIGO DE PROCEDIMIENTO PENAL. (LEY 600 DE 2000) EMBARGO ESPECIAL ART. 341 CODIGO DE PROCEDIMIENTO PENAL.',
                '439' => '0439.- EMBARGO LABORAL',
                '440' => '0440.- EMBARGO PENAL',
                '441' => '0441.- EMBARGO POR IMPUESTOS MUNICIPALES',
                '442' => '0442.- EMBARGO POR IMPUESTOS NACIONALES',
                '443' => '0443.- EMBARGO POR INEFICACIA DEL ACUERDO DE REESTRUCTURACIÓN',
                '444' => '0444.- EMBARGO POR JURISDICCION COACTIVA',
                '445' => '0445.- EMBARGO POR VALORIZACION',
                '446' => '0446.- INICIACION DEL PROCESO DE ENAJENACION FORZOSA',
                '447' => '0447.- INICIACION DILIGENCIAS ADMINISTRATIVAS DE CLARIFICACION DE LA PROPIEDAD',
                '448' => '0448.- INICIACION DILIGENCIAS ADMINISTRATIVAS DESLINDE TIERRAS DE PROPIEDAD DE LA NACION',
                '449' => '0449.- INICIACION DILIGENCIAS ADMINISTRATIVAS POR INDEBIDA OCUPACION DE BALDIOS',
                '450' => '0450.- INICIACION PROCEDIMIENTO DE EXPROPIACION POR VIA ADMINISTRATIVA',
                '451' => '0451.- INICIACION PROCEDIMIENTO DE EXTINCION DEL DERECHO DE DOMINIO',
                '452' => '0452.- INICIACION PROCESO ADMINISTRATIVO DE ADQUISICION',
                '453' => '0453.- INSCRIPCION DEL PROCESO ARBITRAL',
                '454' => '0454.- OFERTA DE COMPRA EN BIEN RURAL',
                '455' => '0455.- OFERTA DE COMPRA EN BIEN URBANO',
                '456' => '0456.- PREVENCION NO PROCEDE LA REALIZACION DE NUEVOS EMBARGOS SOBRE BIENES DE LA INTERVENIDA',
                '457' => '0457.- PREVENCION REGISTRADORES ABSTENERSE CANCELAR GRAVAMENES SALVO AUTORIZACION AGENTE ESPECIAL',
                '458' => '0458.- PROHIBICION ADMINISTRATIVA',
                '459' => '0459.- PROHIBICION CANCELACION GRAVAMENES CONSTITUIDOS A FAVOR DE INTERVENIDA SIN AUTORIZACION LIQUIDADOR',
                '460' => '0460.- PROHIBICION DE ENAJENAR SIN AUTORIZACION',
                '461' => '0461.- PROHIBICION GRAVAR, CEDER, LIMITAR O ARRENDAR SIN AUTORIZACION',
                '462' => '0462.- PROHIBICION INSCRIPCION ACTOS AFECTEN DOMINIO DE BIENES INTERVENIDA SALVO LO REALIZADO POR AGENTE ESPECIAL',
                '463' => '0463.- PROHIBICION JUDICIAL',
                '464' => '0464.- PROHIBICION REGISTRO ACTOS AFECTEN DOMINIO BIENES PROPIEDAD DE INTERVENIDA SALVO AUTORIZACION LIQUIDADOR',
                '465' => '0465.- SUSPENSION EXIGIBILIDAD DE GRAVAMENES Y GARANTIAS REALES Y FIDUCIARIAS',
                '466' => '0466.- TOMA DE POSESION INMEDIATA DE BIENES, HABERES Y NEGOCIOS DE ENTIDAD VIGILADA',
                '467' => '0467.- DEMANDA EN ACCION DE PETICIÓN DE HERENCIA. (Creado Res. 2708 de 2001).',
                '468' => '0468.- DEMANDA EN PROCESO ORDINARIO. (Creado Res. 2708 de 2001).',
                '469' => '0469.- DEMANDA EN PROCESO REIVINDICATORIO. (Creado Res. 2708 de 2001).',
                '470' => '0470.- PREVENCIÓN REGISTRADORES ABSTENERSE DE INSCRIBIR ACTOS DE ENAJENACIÓN O TRANSFERENCIA A CUALQUIER TITULO DE BIENES RURALES. DECRETO 2007 DE 2001. (Creado Res. 4043 de 2002).',
                '471' => '0471.- EMBARGO EN PROCESO DE JURIDICCIÓN VOLUNTARIA. (Resolución No. 6851 de 2004).',
                '472' => '0472.- EMBARGO EN PROCESO ORDINARIO. (Resolución No. 7520 de 2005).',
                '473' => '0473.- DEMANDA EN PROCESO LIQUIDATORIO. (Resolución No. 7520 de 2005).'
                )));
        ?>
    </div>
    <div id="titulo">
        <?php
        echo $this->Form->input('Annotation.tipo_secundario5', array('label' => 'Tipo Título de tenencia', 'empty' => '',
            'options' => array(
                '0501' => '0501.- ADMINISTRACION ANTICRETICA',
                '0502' => '0502. - ARRENDAMIENTO',
                '0503' => '0503.- COMODATO.',
                '0504' => '0504.- COMODATO A TITULO PRECARIO',
                '0505' => '0505.- CONSTITUCION DE LEASING INMOBILIARIO',
                '0506' => '0506.- DESTINACION PROVISIONAL'
                )));
        ?>
    </div>
    <div id="otra">
        <?php
        echo $this->Form->input('Annotation.tipo_secundario6', array('label' => 'Tipo Otra circunstancia que se advierte en el certificado de tradición', 'id' => 'tipo', 'empty' => '',
            'options' => array(
                '0901' => '0901.- ACLARACION',
                '0902' => '0902.- ACTUALIZACION AREA',
                '0903' => '0903.- ACTUALIZACION DE LINDEROS',
                '0904' => '0904.- ACTUALIZACION DE NOMENCLATURA',
                '0905' => '0905.- AUTORIZACION REGISTRO.',
                '0906' => '0906.- CAMBIO DE NOMBRE.',
                '0907' => '0907.- CAMBIO DE RAZON SOCIAL.',
                '0908' => '0908.- CONFIRMACION SENTENCIA',
                '0909' => '0909.- CONSTITUCION DE URBANIZACION',
                '0910' => '0910.- DECLARACION DE CONSTRUCCION CON SUBSIDIO FAMILIAR DE VIVIENDA',
                '0911' => '0911.- DECLARACION DE CONSTRUCCION EN SUELO PROPIO',
                '0912' => '0912.- DECLARACION DE MEJORAS EN SUELO PROPIO',
                '0913' => '0913.- DECLARACION PARTE RESTANTE',
                '0914' => '0914.- DELIMITACION UNIDAD DE ACTUACION URBANISTICA',
                '0915' => '0915.- DESENGLOBE',
                '0916' => '0916.- DESLINDE DE TERRENO DE PROPIEDAD DE LA NACION',
                '0917' => '0917.- DETERMINACION AREA Y LINDEROS PREDIO DEL MUNICIPIO',
                '0918' => '0918.- DIVISION MATERIAL',
                '0919' => '0919.- ENGLOBE',
                '0920' => '0920.- LOTEO',
                '0921' => '0921.- PERMISO CONSTITUIR GRAVAMEN',
                '0922' => '0922.- PERMISO VENTA',
                '0923' => '0923.- REGLAMENTACION URBANISTICA ESPECIAL',
                '0924' => '0924.- RELOTEO',
                '0925' => '0925.- DECALARACION EXTINCION OBLIGACION HIPOTECARIA. (Creado Res. 4043 de 2002)',
                '0926' => '0926.- AUTORIZACIÓN CAMBIO DE DESTINACIÓN Y SUSTRACCIÓN DEL RÉGIMEN DE UNIDAD AGRÍCOLA FAMILIAR. (Resolución No. 6851 de 2004)'
                )));
        ?>
    </div>

    <?php echo $this->Form->input('Annotation.observacion', array('class'=>'tip','title'=>'En este campo debe indicar como podría impactar la opción en el proyecto productivo','label' => 'Observación')); ?>

    <?php echo $this->Form->input('Annotation.anotacion', array('label' => 'Anotación del certificado de tradición')); ?>
    <div id="observacion">
        <?php
        echo $this->Form->input('Annotation.limita_ejecucion1', array('label' => '¿Limita la ejecución del proyecto productivo?', 'empty' => '',
            'options' => array('Si' => 'Si', 'No' => 'No'
            )
        ));
        ?>
    </div>
    <?php echo $this->Form->end("Guardar") ?>
</fieldset>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'TitleStudyDocuments', 'action' => 'index', $this->data['Annotation']['title_study_id'], $property_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>