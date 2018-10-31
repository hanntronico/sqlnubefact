<?php
	require 'sqlconexion.php';
	date_default_timezone_set("America/Lima");

	$consulta="SELECT * FROM alumno where cod_alumno="."'201510123'";

	// $params = array();
	// $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	// $resul=sqlsrv_query($conn,$consulta,$params,$options);

	$resul=sqlsrv_query($conn,$consulta);
	$row=sqlsrv_fetch_array($resul);
	$num_filas=sqlsrv_num_rows($resul);
	
	$row_count = sqlsrv_num_rows($resul);
	
	echo $row_count;
	echo "<br>";
// // var_dump($row);
	echo $row[0]." - ".$row[1]." - ".$row[2]." - ".$row[3]." - ".$row[4]." - ".$row[5];
?>