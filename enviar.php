<?php 

	// include 'conexion.php';
 //  date_default_timezone_set("America/Lima");

  require 'sqlconexion.php';
  date_default_timezone_set("America/Lima");


  function cambiarFormatoFecha($fecha){ 
    list($anio,$mes,$dia)=explode("-",$fecha); 
    return $dia."-".$mes."-".$anio; 
	}  
  
	// $idpedido = $_GET['idped'];
	$idsalida = trim($_GET['idsal']);
	$fec_ini=$_GET["fecini"];
  $fec_fin=$_GET["fecfin"];
  $tipo_comp = $_GET["tcomp"];

  // echo $idsalida."-".$fec_ini."-".$fec_fin."-".$tipo_comp;
  // exit();


  $fec_ini=$_GET["fecini"];
  $fec_fin=$_GET["fecfin"];
  $tipo_comp = $_GET["tcomp"];

  // $query="SELECT serie, numero, comprobante, fecha FROM comprobantes WHERE fecha >= date('".$fec_ini."') and fecha <= date('".$fec_fin."') ORDER by fecha";

  // $resultado = $mysqli->query($query);
  // $numReg = $resultado->num_rows;

// echo $idsalida."<br>";


// $query = "SELECT * FROM detalle_comprobante WHERE comprob = '".$idsalida."'";

// $consulta = "SELECT R.Serie,R.Numero,(R.Serie +'-'+R.Numero) as comprob, 
//                  A.Cod_Alumno as cod_Alumno,
//                  A.Cod_Categoria as cod_Categoria,
// 					case when R.Nombre IS NULL then A.Nombres
// 					     when R.Nombre = '' then A.Nombres
// 					    else R.Nombre
// 					end Nombres,
// 					R.Fec_Crea as fec_crea,
// 					Fec_Emision as fec_emision,
// 					E.Nom_Escuela as nom_escuela,
// 					R.Cod_Ciclo as ciclo,
// 					A.Cod_Ciclo_Ingreso as ciclo_ingreso,
// 					MR.Cod_Concepto as cod_concepto,
// 					CR.Des_Concepto as descrip_concepto, 
// 					MR.Mto_Abono as mto_abono
// 					from Recibo_Caja R Inner join alumno A on R.cod_alumno=A.cod_alumno inner join Escuela E on R.Cod_Escuela=E.Cod_Escuela
// 					inner join Mov_recibo MR on R.Id_Recibo=MR.Id_Recibo inner join concepto_recibo CR on MR.Cod_Concepto=CR.Cod_Concepto
// 					where MR.Mto_Cargo=0 and R.Serie='010' and R.Numero='0006360'";

$consulta = "SELECT R.Serie,R.Numero,(R.Serie +'-'+R.Numero) as comprob, 
                 A.Cod_Alumno as cod_Alumno,
                 A.Cod_Categoria as cod_Categoria,
					case when R.Nombre IS NULL then A.Nombres
					     when R.Nombre = '' then A.Nombres
					    else R.Nombre
					end Nombres,
					R.Fec_Crea as fec_crea,
					Fec_Emision as fec_emision,
					E.Nom_Escuela as nom_escuela,
					R.Cod_Ciclo as ciclo,
					A.Cod_Ciclo_Ingreso as ciclo_ingreso,
					MR.Cod_Concepto as cod_concepto,
					CR.Des_Concepto as descrip_concepto, 
					MR.Mto_Abono as mto_abono
					from Recibo_Caja R Inner join alumno A on R.cod_alumno=A.cod_alumno inner join Escuela E on R.Cod_Escuela=E.Cod_Escuela
					inner join Mov_recibo MR on R.Id_Recibo=MR.Id_Recibo inner join concepto_recibo CR on MR.Cod_Concepto=CR.Cod_Concepto
					where MR.Mto_Cargo=0 and (R.Serie +'-'+R.Numero)='".$idsalida."'" ;



	// echo $consulta;
					
	$params = array();
  $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
  $resul=sqlsrv_query($conn,$consulta,$params,$options);

 
  $numReg = sqlsrv_num_rows($resul);

// $resultado = $mysqli->query($query);
// $numReg = $resultado->num_rows;

// echo "<br>";
// echo "numero de filas: ".$numReg;
// echo "<br>";


// nro
// serie
// numero
// comprob
// cod_Alumno
// cod_Categoria
// nombres
// fec_crea
// fec_emision
// nom_escuela
// ciclo
// ciclo_ingreso
// cod_concepto
// descrip_concepto
// mto_abono
	
	$caditems = "";
	$salto="".PHP_EOL;

	if($numReg>0){
	echo "<table border='0' align='center'>
					<tr bgcolor='skyblue'>
						<th>nro</th>
						<th>serie</th>
						<th>numero</th>
						<th>comprob</th>
						<th>cod_Alumno</th>
						<th>cod_Categoria</th>
						<th>nombres</th>
						<th>fec_crea</th>
						<th>fec_emision</th>
						<th>nom_escuela</th>
						<th>ciclo</th>
						<th>ciclo_ingreso</th>
						<th>cod_concepto</th>
						<th>descrip_concepto</th>
						<th>mto_abono</th>
					</tr>";

    while ($fila = sqlsrv_fetch_array($resul)) {
    	echo "<tr>";
    		echo "<td>".$fila["nro"]."</td>";
    		echo "<td>".$fila["Serie"]."</td>";
    		echo "<td>".$fila["Numero"]."</td>";
    		echo "<td>".$fila["comprob"]."</td>";
    		echo "<td>".$fila["cod_Alumno"]."</td>";
    		echo "<td>".$fila["cod_Categoria"]."</td>";
    		echo "<td>".$fila["Nombres"]."</td>";
    		echo "<td>".date_format($fila["fec_crea"],'Y-m-d H:i:s')."</td>";
    		echo "<td>".date_format($fila["fec_emision"],'Y-m-d H:i:s')."</td>";
    		echo "<td>".$fila["nom_escuela"]."</td>";
    		echo "<td>".$fila["ciclo"]."</td>";
    		echo "<td>".$fila["ciclo_ingreso"]."</td>";
    		echo "<td>".$fila["cod_concepto"]."</td>";
    		echo "<td>".$fila["descrip_concepto"]."</td>";
    		echo "<td>".$fila["mto_abono"]."</td>";
      echo "</tr>";  



	$tipo_comp="BBB";
	// $serie = $fila["serie"];
	$serie = "1";
	$numero = $fila["Numero"];
	// $numero = "6360";


	// $codAlumno = $fila["cod_Alumno"];
	$codAlumno = "44831785";
	// $codAlumno = "";
	$nomAlumno = utf8_encode($fila["Nombres"]);
	// $fecemi=$fila["fec_crea"];
	$fecemi=date('Y-m-d');
	$moneda=1;
	$tipocambio=3.34;
	$valigv=18.00;
  $total = $total + $fila["mto_abono"];




  		$cantidad = 1;
			$prec_unit = round($fila["mto_abono"],2);

			$valorunitario = $prec_unit/(1+($valigv/100));
			$subtotal = $valorunitario*$cantidad;
			$tipoIGV=1;
			$totalIGV=$valorunitario*($valigv/100);
			$total_linea=$prec_unit*$cantidad;

//       1 | 2 | 3 |         4          |5| 6 | 7 | 8 | 9 |X|11|012|  13 |14|15|
//     item|NIU|001|DETALLE DEL PRODUCTO|1|500|590|___|500|1|90|590|false|__|__|


/***
CAMPO 1		Cada FILA debe empezar con la 
					palabra "item" (en SINGULAR) 

CAMPO 2		Unidad de medida:
					NIU = PRODUCTO
					ZZ = SERVICIO
					Si necesita mas unidades de medida debe crearlas primeramente en su cuenta de NUBEFACT para que estén disponible.
CAMPO 3		Código interno del producto o 
					servicio.
CAMPO 4		Descripción del producto o 
					servicio.
CAMPO 5		Cantidad.
CAMPO 6		Valor unitario.
CAMPO 7		Precio unitario.

CAMPO 8		Descuento de la línea, el 
					descuento ANTES de los impuestos.
CAMPO 9		Subtotal: Resultado de VALOR 	
					UNITARIO por la CANTIDAD menos el 
					DESCUENTO.
CAMPO 10	Tipo de IGV:
					1 = Gravado - Operación Onerosa
					2 = Gravado – Retiro por premio
					3 = Gravado – Retiro por donación
					4 = Gravado – Retiro
					5 = Gravado – Retiro por publicidad
					6 = Gravado – Bonificaciones
					7 = Gravado – Retiro por entrega a trabajadores.
					8 = Exonerado - Operación Onerosa
					9 = Inafecto - Operación Onerosa
					10 = Inafecto – Retiro por Bonificación.
					11 = Inafecto – Retiro
					12 = Inafecto – Retiro por Muestras Médicas.
					13 = Inafecto - Retiro por Convenio Colectivo.
					14 = Inafecto – Retiro por premio.
					15 = Inafecto - Retiro por publicidad
					16 = Exportación.
CAMPO 11	Total del IGV de la línea
CAMPO 12	Total de la línea
CAMPO 13	Para indicar que desea regularizar un anticipo.
					false = FALSO (En minúsculas)
					true = VERDADERO (En minúsculas)
CAMPO 14	Serie del documento que contiene el anticipo.
CAMPO 15	Número del documento que contiene el anticipo.
***/

		// $concepto = (string)$fila["cod_concepto"];
		$concepto = round($fila["cod_concepto"],2);
		// $descrip_concepto = trim($fila["descrip_concepto"]);
		$descrip_concepto = utf8_encode($fila["descrip_concepto"]);
		// $descrip_concepto = "PENSION DE ENSEÑANZA";

/***************  CADENA ORIGINAL   ******************/
			$cad1 = "item"."|".
							"ZZ"."|".
							$concepto."|".
	    				trim($descrip_concepto)."|".
							$cantidad."|".
							round($valorunitario,2)."|".
							$prec_unit."|".
							""."|".
							round($subtotal,2)."|".
							$tipoIGV."|".
							round($totalIGV,2)."|".
							round($total_linea,2)."|".
							"false"."|".
							""."|".
							""."|".$salto;
/******************************************************/

			$caditems = $caditems.$cad1;



}

// $dato = '2011-07-12 10:35:27';
$fecha = date('Y-m-d',strtotime($fecemi));
$hora = date('H:i:s',strtotime($fecemi));

$total_gravada = ($total/(1+($valigv/100)));
$total_igv = $total_gravada*($valigv/100);

echo "fecha: ".$fecha."<br>";
echo "hora: ".$hora."<br>";

echo "total: ".$total."<br>";
echo "total gravada: ".round($total_gravada,2)."<br>";
echo "total igv: ".round($total_igv,2);

echo "<br><br>";

$tipo_comprobante = "2";

// echo $tipo_comp."<br>";
// echo $serie."<br>";
// echo $numero."<br>";
// echo $codAlumno."<br>";
// echo $nomAlumno."<br>";
// echo $fecemi."<br>";
// echo $moneda."<br>";
// echo $tipocambio."<br>";
// echo $valigv."<br>";
// echo $total."<br>";



	// $salto="".PHP_EOL;
	// $salto="<br>";
/*****************************  Cadena ORIGINAL  **************************************************************/
	$cad = $cad.'operacion|generar_comprobante|'.$salto;
	$cad = $cad.'tipo_de_comprobante|'.$tipo_comprobante.'|'.$salto;
	$cad = $cad.'serie|'.$tipo_comp.$serie.'|'.$salto;
	$cad = $cad.'numero|'.$numero.'|'.$salto;
	$cad = $cad.'sunat_transaction|1|'.$salto;
	$cad = $cad.'cliente_tipo_de_documento|'.'1'.'|'.$salto;
	$cad = $cad.'cliente_numero_de_documento|'.$codAlumno.'|'.$salto;
	$cad = $cad.'cliente_denominacion|'.$nomAlumno.'|'.$salto;
	$cad = $cad.'cliente_direccion|'.''.'|'.$salto;
	$cad = $cad.'cliente_email||'.$salto;
	$cad = $cad.'cliente_email_1||'.$salto;
	$cad = $cad.'cliente_email_2||'.$salto;
	$cad = $cad.'fecha_de_emision|'.cambiarFormatoFecha($fecha).'|'.$salto;
	$cad = $cad.'fecha_de_vencimiento|'.cambiarFormatoFecha($fecha).'|'.$salto;
	$cad = $cad.'moneda|'.$moneda.'|'.$salto;
	$cad = $cad.'tipo_de_cambio|'.$tipocambio.'|'.$salto;
	$cad = $cad.'porcentaje_de_igv|'.$valigv.'|'.$salto;
	$cad = $cad.'descuento_global||'.$salto;
	$cad = $cad.'total_descuento||'.$salto;
	$cad = $cad.'total_anticipo||'.$salto;
	$cad = $cad.'total_gravada|'.round($total_gravada,2).'|'.$salto;
	$cad = $cad.'total_inafecta||'.$salto;
	$cad = $cad.'total_exonerada||'.$salto;
	$cad = $cad.'total_igv|'.round($total_igv,2).'|'.$salto;
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
	$cad = $cad.'generado_por_contingencia||'.$salto;

	// $cad = $cad.'operacion|generar_comprobante|'.$salto;
	// $cad = $cad.'tipo_de_comprobante|'.'2'.'|'.$salto;
	// $cad = $cad.'serie|'.'BBB1'.'|'.$salto;
	// $cad = $cad.'numero|'.'6360'.'|'.$salto;
	// $cad = $cad.'sunat_transaction|1|'.$salto;
	// $cad = $cad.'cliente_tipo_de_documento|'.'1'.'|'.$salto;
	// $cad = $cad.'cliente_numero_de_documento|'."44831785".'|'.$salto;
	// $cad = $cad.'cliente_denominacion|'.'OLAZABAL VALERA, MARCIA LORENA'.'|'.$salto;
	// $cad = $cad.'cliente_direccion|'.''.'|'.$salto;
	// $cad = $cad.'cliente_email||'.$salto;
	// $cad = $cad.'cliente_email_1||'.$salto;
	// $cad = $cad.'cliente_email_2||'.$salto;
	// $cad = $cad.'fecha_de_emision|'.'31-10-2018'.'|'.$salto;
	// $cad = $cad.'fecha_de_vencimiento|'.'31-10-2018'.'|'.$salto;
	// $cad = $cad.'moneda|'.'1'.'|'.$salto;
	// $cad = $cad.'tipo_de_cambio|'.'3.34'.'|'.$salto;
	// $cad = $cad.'porcentaje_de_igv|'.'18'.'|'.$salto;
	// $cad = $cad.'descuento_global||'.$salto;
	// $cad = $cad.'total_descuento||'.$salto;
	// $cad = $cad.'total_anticipo||'.$salto;
	// $cad = $cad.'total_gravada|'.'3457.63'.'|'.$salto;
	// $cad = $cad.'total_inafecta||'.$salto;
	// $cad = $cad.'total_exonerada||'.$salto;
	// $cad = $cad.'total_igv|'.'622.37'.'|'.$salto;
	// $cad = $cad.'total_gratuita||'.$salto;
	// $cad = $cad.'total_otros_cargos||'.$salto;
	// $cad = $cad.'total|'.'4080'.'|'.$salto;
	// $cad = $cad.'percepcion_tipo||'.$salto;
	// $cad = $cad.'percepcion_base_imponible||'.$salto;
	// $cad = $cad.'total_percepcion||'.$salto;
	// $cad = $cad.'total_incluido_percepcion||'.$salto;
	// $cad = $cad.'detraccion|false|'.$salto;
	// $cad = $cad.'observaciones||'.$salto;
	// $cad = $cad.'documento_que_se_modifica_tipo||'.$salto;
	// $cad = $cad.'documento_que_se_modifica_serie||'.$salto;
	// $cad = $cad.'documento_que_se_modifica_numero||'.$salto;
	// $cad = $cad.'tipo_de_nota_de_credito||'.$salto;
	// $cad = $cad.'tipo_de_nota_de_debito||'.$salto;
	// $cad = $cad.'enviar_automaticamente_a_la_sunat|true|'.$salto;
	// $cad = $cad.'enviar_automaticamente_al_cliente|false|'.$salto;
	// $cad = $cad.'codigo_unico||'.$salto;
	// $cad = $cad.'condiciones_de_pago||'.$salto;
	// $cad = $cad.'medio_de_pago||'.$salto;
	// $cad = $cad.'placa_vehiculo||'.$salto;
	// $cad = $cad.'orden_compra_servicio||'.$salto;
	// $cad = $cad.'tabla_personalizada_codigo||'.$salto;
	// $cad = $cad.'formato_de_pdf||'.$salto;
	// $cad = $cad.'generado_por_contingencia||'.$salto;

	/*****************************************************************************************************/

	// echo $cad;
	// exit();
	// }
	    echo "</table>";
	
	}else{
	    echo "No hay cabecera <br>";
	    exit();
	}

	echo "<br>";


	// $resultado->free();
	// $mysqli->close();

	$archivo = fopen("reporteOK.txt", "w") or die("Error al crear");
	fwrite($archivo, $cad.$caditems);
	fclose($archivo);

	// exit();


	//print_r($cad);

  header("Location: nubefact-txt.php");

?>