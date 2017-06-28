

<?php
if (empty($resultados)) {
    echo "<h1 style='color:red;font-size: large;'>No se encontraron resultados en Aspirantes</h1>";
    ?>


<?php } else { ?>
  <h1 style="font-size: large">Resultados en beneficiarios:</h1>
    <table  id="tabla" class="tabla" >
        <thead>
            <tr>
                <th>Proyecto</th>   
                <th>Predio</th>   
                <th>Tipo Documento</th>
                <th>Documento Identidad</th>
                <th>Primer nombre</th>
                <th>Primer Apellido</th>
                <th>Segundo Apellido</th>

            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($resultados as $ben):
                ?>

                <tr>
                    <td><?php echo $ben['Proyect']['codigo'] ?></td> 
                    <td><?php echo $ben['Property']['nombre'] ?></td> 
                    <td><?php echo $ben['Beneficiary']['tipo_identificacion'] ?></td>
                    <td><?php echo $ben['Beneficiary']['numero_identificacion'] ?></td>
                    <td><?php echo $ben['Beneficiary']['nombres'] ?></td>
                    <td><?php echo $ben['Beneficiary']['primer_apellido'] ?></td>
                    <td><?php echo $ben['Beneficiary']['segundo_apellido'] ?></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php } ?>          



<br><br>
<?php
if (empty($familiares)) {
    echo "<h1 style='color:red;font-size: large;'>No se encontraron resultados en familiares</h1>";
    ?>


<?php } else { ?>

   <h1 style="font-size: large">Resultados en familiares:</h1>    
    <table  id="tabla"  style="" >
        <thead>
            <tr>
                <th>Proyecto</th>   
                <th>Predio</th>   
                <th>Documento cabeza de familia</th>   
                <th>Tipo Documento</th>
                <th>Documento Identidad</th>
                <th>Nombres</th>
                <th>Primer Apellido</th>
                <th>Segundo Apellido</th>

            </tr>
        </thead>
        <tbody>  
            
            <?php
            foreach ($familiares as $ben):
                ?>

                <tr>
                    <td><?php echo $ben['Proyect']['codigo']?> </td>
                    <td><?php echo $ben['Property']['nombre']?> </td>
                    <td><?php echo $ben['Beneficiary']['numero_identificacion']?> </td>
                    <td><?php echo $ben['Family']['tipo_identificacion'] ?></td>
                    <td><?php echo $ben['Family']['numero_identificacion'] ?></td>
                    <td><?php echo $ben['Family']['nombres'] ?></td>
                    <td><?php echo $ben['Family']['primer_apellido'] ?></td>
                    <td><?php echo $ben['Family']['segundo_apellido'] ?></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>



<?php } ?>







<?php
if (empty($predios)) {
    echo "<h1 style='color:red;font-size: large'>No se encontraron resultados en Predios</h1>";
    ?>


<?php } else { ?>
    <h1 style="font-size: large">Resultados en predios:</h1>
    <table  id="tabla" class="tabla" >
        <thead>
            <tr>
                <th>Código</th>   
                <th>nombre</th>
                <th>Municipio</th>
                <th>Matrícula</th>
                <th>Número predial</th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($predios as $ben):
                ?>

                <tr>
                    <td><?php echo $ben['Proyect']['codigo'] ?></td> 
                    <td><?php echo $ben['Property']['nombre'] ?></td>
                    <td><?php echo  $ben['City']['name']." (". $ben['Departament']['name'].")" ?></td>
                    <td><?php echo $ben['Property']['matricula'] ?></td>
                    <td><?php echo $ben['Property']['cedula_catastral'] ?></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php } ?>          

