<table class="table table-striped table-bordered table-hover">

    <tbody>
    <td colspan="5"><center>
        <h3>INFORMACIÓN DE BENEFICIARIOS</h3>
    </center></td>

<tr>
    <td>
        Identificación:
        <?php echo $beneficiary['Beneficiary']['tipo_identificacion'] ?>
        <?php echo $beneficiary['Beneficiary']['numero_identificacion'] ?>
    </td> 

    <td>
        Nombres:
        <?php echo $beneficiary['Beneficiary']['nombres'] ?>
    </td> 
    <td>
        Primer apellido:
        <?php echo $beneficiary['Beneficiary']['primer_apellido'] ?>
    </td> 
    <td>
        Segundo apellido:
        <?php echo $beneficiary['Beneficiary']['segundo_apellido'] ?>
    </td>
</tr>

<tr>
    <td>
        Fecha de nacimiento:
        <?php echo $beneficiary['Beneficiary']['fecha_nacimiento'] ?>
    </td> 
    <td>
        Genero:
        <?php echo $beneficiary['Beneficiary']['genero'] ?>
    </td> 
    <td>
        Tipo de beneficiario:
        <?php echo $beneficiary['Beneficiary']['tipo'] ?>
    </td> 
    <td>
        Teléfono:
        <?php echo $beneficiary['Beneficiary']['telefono'] ?>
    </td> 
<tr>
    <td colspan="2">
        Dirección:
        <?php echo $beneficiary['Beneficiary']['direccion'], " ", $beneficiary['City']['name'] ?>
    </td> 
    <td colspan="2">
        Predio:
        <?php echo $beneficiary['Property']['nombre'], " - Matrícula: ", $beneficiary['Property']['oficina_matricula'], "-", $beneficiary['Property']['numero_matricula'] ?>
    </td> 
</tr>

</tbody>
</table>