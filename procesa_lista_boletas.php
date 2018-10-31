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

  // require 'conexion.php';
  // date_default_timezone_set("America/Lima");

  require 'sqlconexion.php';
  date_default_timezone_set("America/Lima");

  $fec_ini=$_GET["fecini"];
  $fec_fin=$_GET["fecfin"];
  $tipo_comp = $_GET["tcomp"];

  $consulta="SELECT Serie, numero, (Serie+'-'+numero) as comprobante, Fec_Crea as fecha 
             FROM Recibo_Caja 
             WHERE convert(date,Fec_Crea) 
             BETWEEN '".$fec_ini."' AND '".$fec_fin."' and serie<>1 and Estado='P' ORDER BY 4";

  // echo $consulta;
  // exit();
  $params = array();
  $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
  $resul=sqlsrv_query($conn,$consulta,$params,$options);

  // $resul=sqlsrv_query($conn,$consulta);
  // $row = sqlsrv_fetch_array($resul);
  
  $numReg = sqlsrv_num_rows($resul);


  // $query="SELECT serie, numero, comprobante, fecha FROM comprobantes WHERE fecha >= date('".$fec_ini."') and fecha <= date('".$fec_fin."') and serie<>1 ORDER by fecha";

  // $resultado = $mysqli->query($query);
  // $numReg = $resultado->num_rows;
?>

<?php if($numReg>0){ ?>

<table id="example" class="table table-striped responsive-table" style="width:100%">
  <thead>
    <tr>
      <th>serie</th>
      <th>numero</th>
      <th>comprobante</th>
      <th>fecha</th>
      <th>ACCION</th>
    </tr>
  </thead>

<?php 
      while ($fila = sqlsrv_fetch_array($resul)) {
      echo "<tr>";
        echo "<td>".$fila["Serie"]."</td>";
        echo "<td>".$fila["numero"]."</td>";
        echo "<td>".$fila["comprobante"]."</td>";
        echo "<td>".date_format($fila["fecha"],'Y-m-d H:i:s')."</td>";
        echo "<td align='center'><a href='enviar.php?idsal=".$fila["comprobante"]."&fecini=$fec_ini&fecfin=$fec_fin&tcomp=$tipo_comp' style='text-decoration:none;' target='_blank'>"."ENVIAR"."</a></td>";
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