
function agregarDatos(numero,nombre,fecha,estado) {
    cadena =
      "numero=" + numero +
      "&nombre=" + nombre +
      "&fecha=" + fecha +
      "&estado=" + estado;
      console.log(numero,nombre,fecha,estado);
    $.ajax({
      type: "POST",
      url: "tablaAgregar.php",
      data: cadena,
      success: function(r) {
        if (r == 1) {
          $("#tablaEntradas").load("tablaEntradas.php");
                  
          alertify.success("agregado con exito ");
          location.reload();
          
        } else {
          alertify.error("fallo el servidor");
        }
      }
    });
  }
  function editarEmpleado(datos){
    d=datos.split('||');
    $('#idE').val(d[0]);
    $('#identificacionE').val(d[1]);
    $('#nombreE').val(d[2]);
    $('#areaE').val(d[3]);
    $('#observacionesE').val(d[4]);
  }
  function guardarEdicionEmpleado(){
    idE=$('#idE').val();
    id_empleado=$('#identificacionE').val();
    nombre=$('#nombreE').val();
    area=$('#areaE').val();
    observaciones=$('#observacionesE').val();

    cadena= "idE=" + idE + 
            "&identificacionE=" + id_empleado + 
            "&nombreE=" + nombre + 
            "&areaE=" + area + 
            "&observacionesE=" + observaciones;
           
    $.ajax({
      type:"post",
      url:"edicionEmpleado.php",
      data:cadena,
      success:function(r){
        if(r==1){
         
          $('#tablaEmpleados').load('tablaEmpleados.php');
          alertify.success("actualizado con exito:");
        }else{
          alertify.success("no se actualizo");
          console.log(r)
        }
      }
    });
  }
function preguntaSiNo(id)  {
  alertify.confirm('Eliminar Registro', 'Esta seguro de Eliminar?',
                  function(){ 
                    eliminarDatos(id) }
                , function(){
                   alertify.error('Cancel')});


}

function eliminarDatos(id){
 cadena= "id=" + id;
 $.ajax({
  type:"post",
  url:"eliminarEmpleado.php",
  data:cadena,
  success:function(r){
    if(r==1){
     
      $('#tablaEmpleados').load('tablaEmpleados.php');
      alertify.success("Eliminado con exito:");
    }else{
      alertify.success("Fallo el servidor");
      console.log(r)
    }
  }
});

}

function preguntaSiNoTiempos(id)  {
  alertify.confirm('Eliminar Registro', 'Esta operacion no es reversible, desea Eliminar?',
                  function(){ 
                    eliminarDatosTiempos(id) }
                , function(){
                   alertify.error('Cancel')});


}
function eliminarDatosTiempos(id){
  cadena= "id=" + id;
  $.ajax({
   type:"post",
   url:"eliminarTiempos.php",
   data:cadena,
   success:function(r){
     if(r==1){
      
      location.reload();
       alertify.success("Eliminado con exito:");
     }else{
       alertify.success("Fallo el servidor");
       console.log(r)
     }
   }
 });
 
 }
 function agregarFormulario(inputfecha1,inputfecha2,SelectArea,diasProgramacion,inputHora1,inputHora2) {
  cadena =
    "inputfecha1=" + inputfecha1 +
    "&inputfecha2=" + inputfecha2 +
    "&SelectArea=" + SelectArea +
    "&diasProgramacion=" + diasProgramacion +
    "&inputHora1=" + inputHora1 +
    "&inputHora2=" + inputHora2 ;
   
  $.ajax({
    type: "POST",
    url: "datosDeProgramacion.php",
    data: cadena,
    success: function(r) {
      if (r == 1) {
        console.log(r);
        alertify.success("salio ok");
        
      } else {
        alertify.error("fallo el servidor");
      }
    }
  });
}
function enviarAlerta(){
      var closable = alertify.alert().setting();

      alertify.alert('tabla')
        .setting({
          'label':'Cerrar',
          'message': 'o' + (closable ? ' ' : ' no es ') + 'validada.' ,
          'onok': function(){ alertify.success('Verifica');}
        }).show();


}

    
