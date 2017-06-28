<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//phpinfo();


$link = mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db("ipdr", $link) or die(mysql_error());
mysql_query('SET NAMES \'utf8\'');
$table = "family_polls";
//$sqlink=mssql_connect("WILAVEL-PC\WILAVEL", 'sa', 'mabelitha1')or die();;
//$conexion=mssql_connect() or die("Error de conexión.");
//mssql_select_db( 'ipdr') or die("Error de selección de base de datos.");
$sql = "SELECT * FROM $table  ";

$res = mysql_query($sql, $link) or die(mysql_error());

$row = mysql_fetch_assoc($res);
$select = "";
$values = "";
if ($row) {

    foreach ($row as $key => $value) {
        $select.="$key,";
    }
}
$select = substr($select, 0, -1);
$select = "INSERT INTO $table ($select)";
$cad = '';
$c = new PDO("sqlsrv:Server=192.168.10.52\WILAVEL;Database=ipdr", "wilavel", "mabelitha1");
$c->exec("set IDENTITY_INSERT $table  on");
$consulta = "";
$cont = 1;
$res = mysql_query($sql, $link) or die(mysql_error());
while ($row1 = mysql_fetch_array($res)) {


    $cad = "";
    foreach ($row1 as $key => $value) {
        if (is_numeric($key)) {
            //$value=  utf8_decode($value);
            //$value= str_replace("??", "ñ", $value );
            //$value = addslashes($value);
            $value= str_replace("'", '´', $value);
            if (is_numeric($value))
                $cad.="$value,";
            else
                $cad.="'$value',";
        }
    }

    $cad = substr($cad, 0, -1);
    $consulta = $select . " VALUES ($cad);";

    //$statement= $c->prepare($consulta);

    try {
        //echo "$consulta";
        $c->exec($consulta) or die(print_r($c->errorInfo(), true));
        echo "Entro $consulta <br>";
    } catch (PDOException $Exception) {
        // PHP Fatal Error. Second Argument Has To Be An Integer, But PDOException::getCode Returns A
        // String.
        echo $Exception->getMessage() . " " . $Exception->getCode();
        echo "ERRORRRR<br>";
        throw new MyDatabaseException($Exception->getMessage(), $Exception->getCode());
    }


    $consulta = "";
    echo $consulta."<br>";
}

//echo $select."<br>";
?>
