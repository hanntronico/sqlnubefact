    $("#btnAceptar").click(function (){
        // alert($('#fecini').val()+" - "+$('#fecfin').val());

      if ($('#tipocomp').val()=="F") {
        if ($('#fecini').val()!="" && $('#fecfin').val()!="") {
          var content = jQuery("#hannconte");
          content.fadeIn('slow').load("procesa_lista.php?fecini="+
                                      $('#fecini').val()+
                                      "&fecfin="+
                                      $('#fecfin').val()+
                                      "&tcomp="+$('#tipocomp').val());
          $('#fecini').val("");
          $('#fecfin').val("");
        } else {
          alert("Por favor ingrese fechas validas");
          return false;
        }

      }else if ($('#tipocomp').val()=="B") {
        if ($('#fecini').val()!="" && $('#fecfin').val()!="") {
          var content = jQuery("#hannconte");
          content.fadeIn('slow').load("procesa_lista_boletas.php?fecini="+
                                      $('#fecini').val()+
                                      "&fecfin="+
                                      $('#fecfin').val()+
                                      "&tcomp="+$('#tipocomp').val());
          $('#fecini').val("");
          $('#fecfin').val("");
        } else {
          alert("Por favor ingrese fechas validas");
          return false;
        }
      }


    });    


