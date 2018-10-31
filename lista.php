<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>FACTURAS Electrónicas MADAN XL</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

		<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript" charset="utf-8"></script>
		<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" type="text/javascript" charset="utf-8"></script>

		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <script type="text/javascript">
      $(document).ready(function() {
          $('#example').DataTable();
      } );      

    </script>			
</head>
<body>
	<br>
 	<div id="container">
 
	  <div id="titulo" class="row">
      <div class="col-md-10">
        www.udch.edu.pe   |  GESION DE COMPROBANTES ELECTRONICOS - UDCH
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
 <script type="text/javascript" src="js/script.js"></script> 
</body>
</html>