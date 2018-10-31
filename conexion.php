<?php
	$mysqli=new mysqli("localhost","root","*123456*","dbfact"); 
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
?>