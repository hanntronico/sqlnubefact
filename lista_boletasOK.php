<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>BOLETAS Electrónicas MADAN XL</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<br>
 	<div id="container">	

 		<!-- <div class="titulo">LISTADO DE BOLETAS - KM DATA - Sistema MaDan 2018 - www.madan.pe</div> -->

	  <div id="titulo" class="row">
      <div class="col-md-10">
        www.madan.pe     LISTADO DE BOLETAS - KM DATA     MaDan
      </div>
      <div class="col-md-2" style="text-align: right; ">
        <a href="index.php" title="salir">SALIR</a>
      </div>
    </div>

    <br>

<?php  

	include 'conecta.php';
  date_default_timezone_set("America/Lima");
  $conexion = pg_connect($cadenaConexion) or die("Error en la Conexión: ".pg_last_error());
  // $query =	"select idtiporef, docref,
		// 				position('-' in docref),
		// 				substring(docref from position('-' in docref)+1 for 2),
		// 				rtrim(substring(docref from 1 for position(' ' in docref)),' '),
		// 				substring(docref from position('-' in docref)+1),
		// 				(substring(docref from position('-' in docref)+1 for 2) 
		// 				 || rtrim(substring(docref from 1 for position(' ' in docref)),' ')) as Serie,
		// 				 idtipodocid, tbpersona.nrodoc, razonsocial, (coalesce(nombres,'') || ' ' || coalesce(ape_pat,'') || ' ' || coalesce(ape_mat,'')) as nombres,
		// 				 tbpersona.direccion, fecemi, tipocambio, idigv, total, igv, percepcion, idmoneda, idpedido, SUBSTRING (docref, 8), otrodoc
		// 				from tbpedido, tbpersona where tbpedido.idcli = tbpersona.idpersona
		// 				and fecemi is not null and fecemi >= date('2018-07-24') and fecemi <= date('2018-07-27')
		// 				and rtrim(substring(docref from 1 for position(' ' in docref)),' ') = '010'
		// 				and ltrim(substring(docref from position('-' in docref)+1 for 2)) = 'B'
		// 				and idtiporef in (
		// 				    select idref from tbctas_cobrar 
		// 				    where fecemi >= date('2018-07-24') and fecemi <= date('2018-07-27') 
		// 				    and estado = true) order by 1";

  $query = "select idsalida,
						       tbsalida.nrodoc,
						       position('-' in tbsalida.nrodoc),
						       substring(tbsalida.nrodoc from position('-' in tbsalida.nrodoc)+1 for 2),
						       rtrim(substring(tbsalida.nrodoc from 1 for position(' ' in tbsalida.nrodoc)),' '),
						       substring(tbsalida.nrodoc from position('-' in tbsalida.nrodoc)+1),
						       (substring(tbsalida.nrodoc from position('-' in tbsalida.nrodoc)+1 for 2) || rtrim(substring(tbsalida.nrodoc from 1 for position(' ' in tbsalida.nrodoc)),' ')) as Serie,
						       idtipodocid, 
						       tbpersona.nrodoc, 
						       razonsocial, 
						       (coalesce(nombres,'') || ' ' || coalesce(ape_pat,'') || ' ' || coalesce(ape_mat,'')) as nombres,
						       tbpersona.direccion, 
						       fecemi, 
						       tipocambio, 
						       idigv, 
						       totalsalida, 
						       igv, 
						       percepcion, 
						       idmoneda, 
						       SUBSTRING (tbsalida.nrodoc, 8), 
						       otrodoc 
						from tbsalida, tbpersona
						where tbsalida.iddestino = tbpersona.idpersona
						and fecemi is not null and fecemi >= date('2018-07-27') and fecemi <= date('2018-08-01')
						and rtrim(substring(tbsalida.nrodoc from 1 for position(' ' in tbsalida.nrodoc)),' ') = '010'
						and ltrim(substring(tbsalida.nrodoc from position('-' in tbsalida.nrodoc)+1 for 2)) = 'B'
						and idsalida in (
								select idref from tbctas_cobrar 
								where fecemi >= date('2018-07-27') and fecemi <= date('2018-08-01') 
								and estado = true) order by 2";

	$resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL");
	$numReg = pg_num_rows($resultado);
	
	
?>


<!-- 	<table> 
		<thead>
			<tr>
				<th colspan="3" align="center">Facturas Electrónicas</th>
			</tr>
		</thead>
		<tbody> -->

<?php 

		if($numReg>0){
			echo "<table border='0' align='center'>
							<tr bgcolor='skyblue'>
								<th>DOC</th>
								<th>docref</th>
								<th>Sub cadena 2</th>
								<th>serie</th>
								<th>Nro</th>
								<th>RUC</th>
								<th>DNI</th>
								<th>RAZ. SOCIAL</th>
								<th>NOMBRES</th>
								<th>DIRECCION</th>
								<th>&nbsp;&nbsp;&nbsp;&nbsp;FECHA&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th>T.C.</th>
								<th>TIPO</th>
								<th>MONTO</th>
								<th>IGV</th>
								<th align='center'>IDPEDIDO</th>
								<th>NUBEFACT</th>
							</tr>";
			while ($fila=pg_fetch_array($resultado)) {
			


			echo "<tr>";
				echo "<td>".$fila[0]."</td>";
				echo "<td>".$fila[1]."</td>";
				echo "<td>".$fila[5]."</td>";
				echo "<td>".$fila[6]."</td>";
				echo "<td>".$fila[7]."</td>";
				echo "<td>".$fila[8]."</td>";
				echo "<td>".$fila['otrodoc']."</td>";
				echo "<td>".$fila[9]."</td>";
				echo "<td>".$fila[10]."</td>";
				echo "<td>".$fila[11]."</td>";
				echo "<td>".$fila[12]."</td>";
				echo "<td>".$fila[13]."</td>";
				echo "<td>".$fila[14]."</td>";
				echo "<td align='right'>".round($fila[15],2)."</td>";
				echo "<td align='right'>".round($fila[16],2)."</td>";
				echo "<td align='center'>".$fila[19]."</td>";
				echo "<td align='center'><a href='enviar.php?idsal=$fila[0]' style='text-decoration:none;' target='_blank'>"."ENVIAR"."</a></td>";
			echo "</tr>";
			
			}
	
			echo "</table>";
	
	}else{
	    echo "No hay cabecera <br>";
	}


?>



<!-- 			<tr>
				<td>data</td>
				<td>data</td>
				<td>data</td>
			</tr>
		</tbody>
	</table> -->
	</div>
</body>
</html>