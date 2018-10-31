<?php
	$serverName = "192.168.7.220"; 
	// $uid = 'sa';
	// $pwd = '9239541@infoudch2015';
	// $databaseName = 'UNITES';

	$params = array();

	// $connectionInfo = array("Database"=>$databaseName, "UID"=>$uid, "PWD"=>$pwd);
$connectionInfo = array("Database"=>"UNITES", "UID"=>"sa", "PWD"=>"9239541@infoudch2015");
$conn = sqlsrv_connect($serverName,$connectionInfo);

	if(sqlsrv_errors()){
		echo 'Conexion Fallida : ', sqlsrv_errors();
		exit();
	}


?>