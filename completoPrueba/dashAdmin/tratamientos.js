console.log("h");
$(document).ready(function(){
    //Hace referencia a la tabla pacientes
    tablaTratamientos = $("#tablaTratamientos").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarT'>Editar</button><button class='btn btn-danger btnBorrarT'>Borrar</button></div></div>"  
       }],
        
        //Para cambiar el lenguaje a español
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });

 
//Boton nuevo paciente
$("#btnNuevoT").click(function(){
    $("#formTratamiento").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Tratamiento");            
    $("#modalCRUD").modal("show");        
    IdT=null;
    opcion = 1; //alta
});    


var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditarT", function(){
    fila = $(this).closest("tr");
    IdT = parseInt(fila.find('td:eq(0)').text());
    nomT = fila.find('td:eq(1)').text();
    numSes = fila.find('td:eq(2)').text();
    costoT = fila.find('td:eq(3)').text();
    
    $("#nomT").val(nomT);
    $("#numSes").val(numSes);
    $("#costoT").val(costoT);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Tratamiento");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrarT", function(){    
    fila = $(this);
    IdT = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el Tratamiento: "+ IdT +"?");
    if(respuesta){
        $.ajax({
            url: "bd/crudTratamientos.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, IdT:IdT},
            success: function(){
                tablaTratamientos.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});

/*
$(document).on("click", ".btnHistorial", function(){
    fila = $(this).closest("tr");
    id_P = parseInt(fila.find('td:eq(0)').text());
    Nom = fila.find('td:eq(1)').text();
    AP = fila.find('td:eq(2)').text();
    AM = fila.find('td:eq(3)').text();

    console.log(Nom);
    //Abre el documento pdf del historial
    window.location = "imprimirHistorial.php?id_P=" + id_P + "&Nom=" + Nom + "&AP=" + AP + "&AM=" + AM;
   
});*/

//Almacena la información capturada, y la envía al archivo crud.php junto con la opción ya sea agregar o modificar 
$('#formTratamiento').submit(function(e){
    e.preventDefault();    
    nomT = $.trim($("#nomT").val());
    numSes = $.trim($("#numSes").val());
    costoT = $.trim($("#costoT").val()); 
    $.ajax({
        url: "bd/crudTratamientos.php",   //Manda la información al archivo
        type: "POST",
        dataType: "json",
        data: {nomT:nomT, numSes:numSes, costoT:costoT, IdT:IdT, opcion:opcion},
        success: function(data){  
            console.log(data);
            IdT = data[0].IdT;            
            nomT = data[0].nomT;
            numSes = data[0].numSes;
            costoT = data[0].costoT;
            if(opcion == 1){tablaTratamientos.row.add([IdT,nomT,numSes,costoT]).draw();}
            else{tablaTratamientos.row(fila).data([IdT,nomT,numSes,costoT]).draw();}           
            
        }        
    });
    $("#modalCRUD").modal("hide");   //Oculta el formulario al término de la captura 
});    
    
});