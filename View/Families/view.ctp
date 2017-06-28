<table border=1 width="4">

    <tbody>
        <td colspan="5"><center>
            <h1>INFORMACION DE FAMILIARES</h1>
        </center></td>
        
        <tr>
           <td>
            Identificacion:
            <?php echo  $family['Beneficiary']['tipo_identificacion']?>
            <?php echo $family['Beneficiary']['numero_identificacion'] ?>
            </td> 
            
            <td>
            Nombres:
            <?php echo  $family['Beneficiary']['nombres']?>
            </td> 
            <td>
            Primer apellido:
            <?php echo  $family['Beneficiary']['primer_apellido']?>
            </td> 
            <td>
            Segundo apellido:
            <?php echo  $family['Beneficiary']['segundo_apellido']?>
            </td>
            
            
        </tr>
        
         <tr>
            <td>
            Fecha de nacimiento:
            <?php echo  $family['Beneficiary']['fecha_nacimiento']?>
            </td> 
            <td>
            Genero:
            <?php echo  $family['Beneficiary']['genero']?>
            </td> 
            <td>
            Tipo de beneficiario:
            <?php echo  $family['Beneficiary']['tipo']?>
            </td> 
            <td>
            Telefono:
            <?php echo  $family['Beneficiary']['telefono']?>
            </td> 
         <tr>
             <td colspan="4">
            Direccion:
            <?php echo  $family['Beneficiary']['direccion']?>
            </td> 
         </tr>
            
            <tr>
            <td colspan="2">
            Numero de resolucion:
            <?php echo  $family['Beneficiary']['numero_resolucion']?>
            </td> 
            <td colspan="2">
            Fecha de resolucion:
            <?php echo  $family['Beneficiary']['fecha_resolucion']?>
            </td> 
            </tr>
        
        
        
         </tr>
        
         </tbody>
</table>

