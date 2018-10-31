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

<div class="box" style="overflow-x: auto;">
<?php  
//echo $_GET["fecini"]." - ".$_GET["fecfin"];
  include 'conecta.php';
  date_default_timezone_set("America/Lima");
  $conexion = pg_connect($cadenaConexion) or die("Error en la Conexión: ".pg_last_error());
  
  $fec_ini=$_GET["fecini"];
  $fec_fin=$_GET["fecfin"];
  $tipo_comp = $_GET["tcomp"];

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
            and fecemi is not null and fecemi >= date('".$fec_ini."') and fecemi <= date('".$fec_fin."')
            and rtrim(substring(tbsalida.nrodoc from 1 for position(' ' in tbsalida.nrodoc)),' ') = '010'
            and ltrim(substring(tbsalida.nrodoc from position('-' in tbsalida.nrodoc)+1 for 2)) = '".$tipo_comp."'
            and idsalida in (
                select idref from tbctas_cobrar 
                where fecemi >= date('".$fec_ini."') and fecemi <= date('".$fec_fin."') 
                and estado = true) order by 2";

  $resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL");
  $numReg = pg_num_rows($resultado);
  
?>

<?php if($numReg>0){ ?>

<table id="example" class="table table-striped responsive-table" style="width:100%">
  <thead>
      <tr>
        <th>DOC</th>
        <th>docref</th>
        <th>Sub cadena 2</th>
        <th>serie</th>
        <th>Nro</th>
        <th>NRO RUC</th>
        <th>RAZ. SOCIAL</th>
        <th>NOMBRE</th>
        <th>DIRECCION</th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;FECHA&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th>T.C.</th>
        <th>TIPO</th>
        <th>MONTO</th>
        <th>IGV</th>
        <th>NUBEFACT</th>
      </tr>
  </thead>

<?php 
      echo "";
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
        echo "<td align='right'>".round($fila[15],2)."</td>";
        echo "<td align='right'>".round($fila[16],2)."</td>";
        echo "<td align='center'><a href='enviar.php?idsal=$fila[0]&fecini=$fec_ini&fecfin=$fec_fin&tcomp=$tipo_comp' style='text-decoration:none;' target='_blank'>"."ENVIAR"."</a></td>";
      echo "</tr>";
      
      }
?>  
</table>


<?php  
  }else{
      echo "No se encontraron registros <br>";
  }
?>
</div>