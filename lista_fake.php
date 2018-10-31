<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>FACTURAS Electrónicas MADAN XL</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="js/script.js" type="text/javascript" charset="utf-8"></script>
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

</head>
<body>
	<br>
 	<div id="container">
 
	  <div id="titulo" class="row">
      <div class="col-md-10">
        www.madan.pe     LISTADO DE FACTURAS - KM DATA     MaDan
      </div>
      <div class="col-md-2" style="text-align: right; ">
        <a href="index.php" title="salir">SALIR</a>
      </div>
    </div>

 		<div id="fra_opciones" class="row">
 			<div class="col-md-12">
 				<input type="date" id="fecini" name="fecini">
 				<input type="date" id="fecfin" name="fecfin">
 				<input type="hidden" id="tipocomp" name="tipocomp" value="F">
 				<button type="button" id="btnAceptar" class="btnAceptar">Aceptar</button>
 			</div>
 		</div>

 		<div id="hannconte"></div>

 </div>

</body>
</html>