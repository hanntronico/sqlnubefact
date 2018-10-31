<?php 

 //phpinfo();
// echo extension_loaded('pgsql') ? 'yes':'no';
 //exit();


	include 'conecta.php';
  
  date_default_timezone_set("America/Lima");


  function cambiarFormatoFecha($fecha){ 
    list($anio,$mes,$dia)=explode("-",$fecha); 
    return $dia."-".$mes."-".$anio; 
	}  
  
	$idpedido = $_GET['idped'];

	$conexion = pg_connect($cadenaConexion) or die("Error en la Conexión: ".pg_last_error());
	// echo "<h3>Conexion Exitosa PHP - PostgreSQL</h3><hr><br>";

	// $query = "select idpedido, nrodoc, idvend, idalm, idcli 
	//           from tbpedido where idtiporef is not null";
 	// $query = "select * from tbpedido where idtiporef is not null";
 
	// $query = "select idtiporef, 
 // 	                 docref, 
 // 	                 position('-' in docref),
 // 	                 substring(docref from position('-' in docref)+1 for 2),
 // 	                 rtrim(substring(docref from 1 for position(' ' in docref)),' '),
 // 	                 substring(docref from position('-' in docref)+1),
 // 	                 (substring(docref from position('-' in docref)+1 for 2) || rtrim(substring(docref from 1 for position(' ' in docref)),' ')) as Serie,
 // 	                 idtipodocid, 
 // 	                 tbpersona.nrodoc, 
 // 	                 razonsocial, 
 // 	                 (nombres || ' ' || ape_pat || ' ' || ape_mat) as nombres,
 // 	                 tbpersona.direccion, 
 // 	                 fecemi, 
 // 	                 tipocambio, 
 // 	                 idigv, 
 // 	                 total, 
 // 	                 igv, 
 // 	                 percepcion,
 // 	                 idmoneda
	// 					from tbpedido, tbpersona where tbpedido.idcli = tbpersona.idpersona
	// 					and fecemi is not null and tbpedido.idpedido = ".$idpedido." order by 1";


	$query =	"select idtiporef, docref,
						position('-' in docref),
						substring(docref from position('-' in docref)+1 for 2),
						rtrim(substring(docref from 1 for position(' ' in docref)),' '),
						substring(docref from position('-' in docref)+1),
						(substring(docref from position('-' in docref)+1 for 2) 
						 || rtrim(substring(docref from 1 for position(' ' in docref)),' ')) as Serie,
						 idtipodocid, tbpersona.nrodoc, razonsocial, (nombres || ' ' || ape_pat || ' ' || ape_mat) as nombres,
						 tbpersona.direccion, fecemi, tipocambio, idigv, total, igv, percepcion, idmoneda, idpedido, SUBSTRING (docref, 8)
						from tbpedido, tbpersona where tbpedido.idcli = tbpersona.idpersona
						and fecemi is not null and fecemi >= date('2017-07-01') and fecemi <= date('2017-07-31')
						and rtrim(substring(docref from 1 for position(' ' in docref)),' ') = '010'
						and ltrim(substring(docref from position('-' in docref)+1 for 2)) = 'F'
						and tbpedido.idpedido = ".$idpedido."
						and idtiporef in (
						    select idref from tbctas_cobrar 
						    where fecemi >= date('2017-07-01') and fecemi <= date('2017-07-31') 
						    and estado = true) order by 1";

//	echo $query;
//	exit();

	$resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL");

	$numReg = pg_num_rows($resultado);



	if($numReg>0){
	echo "<table border='0' align='center'>
					<tr bgcolor='skyblue'>
						<th>DOC</th>
						<th>docref</th>
						<th>Sub cadena 2</th>
						<th>serie</th>
						<th>Nro</th>
						<th>ID CLIENTE</th>
						<th>ID CLIENTE</th>
						<th>ID CLIENTE</th>
						<th>ID CLIENTE</th>
						<th>ID CLIENTE</th>
						<th>T.C.</th>
						<th>TIPO</th>
						<th>ID CLIENTE</th>
						<th>ID CLIENTE</th>
					</tr>";
	while ($fila=pg_fetch_array($resultado)) {
	echo "<tr>";
	echo "<td>".$fila[0]."</td>";
	echo "<td>".$fila[1]."</td>";
	echo "<td>".$fila[5]."</td>";
	echo "<td>".$fila[6]."</td>";
	echo "<td>".$fila[7]."</td>";
	echo "<td>".$fila[8]."</td>";
	echo "<td>".$fila[9]."</td>";
	echo "<td>".$fila[10]."</td>";
	echo "<td>".$fila[11]."</td>";
	echo "<td>".$fila[12]."</td>";
	echo "<td>".$fila[13]."</td>";
	echo "<td>".$fila[14]."</td>";
	echo "<td>".$fila[15]."</td>";
	echo "<td>".$fila[16]."</td>";
	echo "</tr>";
	
	$idtiporef = $fila[0];
	$docref = $fila[1];
 	$pos = $fila[2];
 	$subcadena = $fila[3];
 	$dertrim = $fila[4];
 	$subcadena2 = $fila[5];
 	$serie = trim($fila[6]);
 	$idtipodocid = $fila[7];
 	$cli_nrodoc = $fila[8];
 	$razonsocial = $fila[9];
 	$nombres = $fila[10];
 	$direccion = $fila[11];
 	$fecemi = $fila[12]; 	
 	$tipocambio = $fila[13];
 	$idigv = $fila[14];
 	$total = $fila[15];
 	$igv = $fila[16];
 	$percepcion = $fila[17];
 	$moneda = $fila[18];

  $numcomprob = ltrim($fila[20], "0");

	}
	    echo "</table>";
	
	}else{
	    echo "No hay cabecera <br>";
	}

	echo "<br>";


	pg_close($conexion);
	

	// $cadena1 = $cadena1 . PHP_EOL; 
  // $cad = '{'.PHP_EOL;
	
	// echo $idtiporef."<br>";
	// echo $docref."<br>";
 // 	echo $pos."<br>";
 // 	echo $subcadena."<br>";
 // 	echo $dertrim."<br>";
 // 	echo $subcadena2."<br>";
 // 	echo $serie."<br>";
 // 	echo $idtipodocid."<br>";

 // 	echo $cli_nrodoc."<br>";
 // 	echo $razonsocial."<br>";
 	
 // 	echo $nombres."<br>";
 	
 // 	echo $direccion."<br>";
 // 	echo $fecemi."<br>";
 // 	echo $tipocambio."<br>";
 // 	echo $idigv."<br>";
 // 	echo $total."<br>";

 // 	echo $igv."<br>";
 	
 	if ($idigv == 1) {
 		$valigv=19;
 	} elseif ($idigv == 2) {
 		$valigv=18;
 	} 

 // 	echo $percepcion."<br>";
 // 	echo $moneda."<br>";

	// echo "<br>";

	// $salto="<br>".PHP_EOL;
	$salto="".PHP_EOL;

	// date_format(date_create($fecemi), 'd-m-Y')
	// date("d-m-Y",strtotime($fecemi))

	$cad = $cad.'operacion|generar_comprobante|'.$salto;
	$cad = $cad.'tipo_de_comprobante|1|'.$salto;
	$cad = $cad.'serie|'.'B001'.'|'.$salto;
	$cad = $cad.'numero|'.$numcomprob.'|'.$salto;
	$cad = $cad.'sunat_transaction|1|'.$salto;
	$cad = $cad.'cliente_tipo_de_documento|6|'.$salto;
	$cad = $cad.'cliente_numero_de_documento|'.$cli_nrodoc.'|'.$salto;
	$cad = $cad.'cliente_denominacion|'.$razonsocial.'|'.$salto;

	$cad = $cad.'cliente_direccion|'.$direccion.'|'.$salto;
	$cad = $cad.'cliente_email||'.$salto;
	$cad = $cad.'cliente_email_1||'.$salto;
	$cad = $cad.'cliente_email_2||'.$salto;
	// $cad = $cad.'fecha_de_emision|'.cambiarFormatoFecha($fecemi).'|'.$salto;
	//$cad = $cad.'fecha_de_emision|'.date('d-m-Y').'|'.$salto;
	$cad = $cad.'fecha_de_emision|'.'31-07-2017'.'|'.$salto;
	$cad = $cad.'fecha_de_vencimiento||'.$salto;
	$cad = $cad.'moneda|'.$moneda.'|'.$salto;
	$cad = $cad.'tipo_de_cambio|'.$tipocambio.'|'.$salto;
	$cad = $cad.'porcentaje_de_igv|'.$valigv.'|'.$salto;
	$cad = $cad.'descuento_global||'.$salto;
	$cad = $cad.'total_descuento||'.$salto;
	$cad = $cad.'total_anticipo||'.$salto;
	$cad = $cad.'total_gravada|'.round(($total-$igv),2).'|'.$salto;
	$cad = $cad.'total_inafecta||'.$salto;
	$cad = $cad.'total_exonerada||'.$salto;
	$cad = $cad.'total_igv|'.round($igv,2).'|'.$salto;
	$cad = $cad.'total_gratuita||'.$salto;
	$cad = $cad.'total_otros_cargos||'.$salto;
	$cad = $cad.'total|'.round($total,2).'|'.$salto;
	$cad = $cad.'percepcion_tipo||'.$salto;
	$cad = $cad.'percepcion_base_imponible||'.$salto;
	$cad = $cad.'total_percepcion||'.$salto;
	$cad = $cad.'total_incluido_percepcion||'.$salto;
	$cad = $cad.'detraccion|false|'.$salto;
	$cad = $cad.'observaciones||'.$salto;
	$cad = $cad.'documento_que_se_modifica_tipo||'.$salto;
	$cad = $cad.'documento_que_se_modifica_serie||'.$salto;
	$cad = $cad.'documento_que_se_modifica_numero||'.$salto;
	$cad = $cad.'tipo_de_nota_de_credito||'.$salto;
	$cad = $cad.'tipo_de_nota_de_debito||'.$salto;
	$cad = $cad.'enviar_automaticamente_a_la_sunat|true|'.$salto;
	$cad = $cad.'enviar_automaticamente_al_cliente|false|'.$salto;
	$cad = $cad.'codigo_unico||'.$salto;
	$cad = $cad.'condiciones_de_pago||'.$salto;
	$cad = $cad.'medio_de_pago||'.$salto;
	$cad = $cad.'placa_vehiculo||'.$salto;
	$cad = $cad.'orden_compra_servicio||'.$salto;
	$cad = $cad.'tabla_personalizada_codigo||'.$salto;
	$cad = $cad.'formato_de_pdf||'.$salto;

	

	$conexion = pg_connect($cadenaConexion) or die("Error en la Conexión: ".pg_last_error());

	$query = "select * from tbdetpedpres, tbproducto where tbdetpedpres.idpresprod = tbproducto.idprod and idpedido = ".$idpedido;

	$resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL");

	$numReg = pg_num_rows($resultado);

	$caditems = "";
	
	if($numReg>0){
	// echo "<table border='1' align='center'>
	// 				<tr bgcolor='skyblue'>
	// 					<th>uno</th>
	// 					<th>dos</th>
	// 					<th>tres</th>
	// 					<th>cantidad</th>
	// 					<th>cinco</th>
	// 					<th>Sub cadena 2</th>
	// 					<th>serie</th>
	// 					<th>ID CLIENTE</th>
	// 					<th>ID CLIENTE</th>
	// 					<th>ID CLIENTE</th>
	// 					<th>ID CLIENTE</th>
	// 					<th>ID CLIENTE</th>
	// 					<th>ID CLIENTE</th>
	// 					<th>ID CLIENTE</th>
	// 					<th>ID CLIENTE</th>
	// 				</tr>";
	while ($fila=pg_fetch_array($resultado)) {
	// echo "<tr>";
	// echo "<td>".$fila[0]."</td>";
	// echo "<td>".$fila[1]."</td>";
	// echo "<td>".$fila[2]."</td>";
	// echo "<td>".$fila[3]."</td>";
	// echo "<td>".$fila[4]."</td>";
	// echo "<td>".$fila[5]."</td>";
	// echo "<td>".$fila[6]."</td>";
	// echo "<td>".$fila[7]."</td>";
	// echo "<td>".$fila[8]."</td>";
	// echo "<td>".$fila[9]."</td>";
	// echo "<td>".$fila[10]."</td>";
	// echo "<td>".$fila[11]."</td>";
	// echo "<td>".$fila[12]."</td>";
	// echo "<td>".$fila[13]."</td>";
	// echo "<td>".$fila[14]."</td>";
	// echo "</tr>";
		if (round($fila[5],0)!=0 || round($fila[6],0)!=0){
			// $cad1 = "item"."|".
			// 				"NIU"."|".
			// 				$fila[13]."|".
			// 				$fila[12]."|".
			// 				round($fila[3],0)."|".
			// 				round($fila[5], 2)."|".
			// 				round($fila[6], 2)."|".
			// 				""."|".
			// 				round($fila[5],2)."|".
			// 				"1"."|".
			// 				round(($fila[6]-$fila[5]),2)."|".
			// 				round($fila[6],2)."|".
			// 				"false"."|".
			// 				""."|".
			// 				""."|".$salto;

			$cantidad = round($fila[3],0);
			// $prec_unit = round(($subtotal/1.18),2);
			$valorunitario = round($fila[5], 2);
			$prec_unit = round($fila[6],2);
			$subtotal = round(($cantidad * $prec_unit), 2);

			$cad1 = "item"."|".
							"NIU"."|".
							$fila[13]."|".
							$fila[12]."|".
							$cantidad."|".
							$valorunitario."|".
							$prec_unit."|".
							""."|".
							$subtotal."|".
							"1"."|".
							round(($fila[6]-$fila[5])*$cantidad,2)."|".
							$subtotal."|".
							"false"."|".
							""."|".
							""."|".$salto;

			// echo $cad1;	
			$caditems = $caditems.$cad1;
		}


	}
	  
	  // echo "</table>";
	
	}else{
	  echo "No hay Registros detalle <br>";
	}

pg_close($conexion);

//item|NIU|432|SUMINISTRO TINTA EPSON 664 NEGRO T664120|2|23.73|28||23.73|1|4.27|28|false|||

 //                        "unidad_de_medida"          => "NIU",
 //                        "codigo"                    => "001",
 //                        "descripcion"               => "DETALLE DEL PRODUCTO",
 //                        "cantidad"                  => "2",
 //                        "valor_unitario"            => "23.73",
 //                        "precio_unitario"           => "28", (subtotal / 1.18)
 //                        "descuento"                 => "",
 //                        "subtotal"                  => "56", (cantidad * valor unitario)
 //                        "tipo_de_igv"               => "1",
 //                        "igv"                       => "8.54", igv * cantidad 4.27*2
 //                        "total"                     => "56",
 //                        "anticipo_regularizacion"   => "false",
 //                        "anticipo_serie"            => "",
 //                        "anticipo_documento_numero" => ""

	// item|NIU|001|DETALLE DEL PRODUCTO|1|500|590||500|1|90|590|false|||

 //                        "unidad_de_medida"          => "NIU",
 //                        "codigo"                    => "001",
 //                        "descripcion"               => "DETALLE DEL PRODUCTO",
 //                        "cantidad"                  => "1",
 //                        "valor_unitario"            => "500",
 //                        "precio_unitario"           => "590",
 //                        "descuento"                 => "",
 //                        "subtotal"                  => "500",
 //                        "tipo_de_igv"               => "1",
 //                        "igv"                       => "90",
 //                        "total"                     => "590",
 //                        "anticipo_regularizacion"   => "false",
 //                        "anticipo_serie"            => "",
 //                        "anticipo_documento_numero" => ""
  
	// echo "<br>";
	echo $cad.$caditems;
	
	$archivo = fopen("reporteOK.txt", "w") or die("Error al crear");
	fwrite($archivo, $cad.$caditems);
	fclose($archivo);

	// print_r($cad);

?>