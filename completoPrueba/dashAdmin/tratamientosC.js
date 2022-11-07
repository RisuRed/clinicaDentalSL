$(document).ready(function(){
    tablaTratamientosC = $("#tablaTratamientosC").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarR'>Editar</button><button class='btn btn-danger btnBorrarR'>Cancelar</button></div></div>"  
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

    var data = {};
    $("#nombresTratamientos option").each(function(i,el) {  
        data[$(el).data("value")] = $(el).val();
    });
    console.log(data, $("#browsers option").val());
        
    $('#obtenerTratamiento2').click(function()
    {
        var value = $('#selected5').val();
        document.getElementById("IdT").value = ($('#nombresTratamientos [value="' + value + '"]').data('value'));
                    //alert($('#nombresP [value="' + value + '"]').data('value'));
                    //$("#modalCRUD").modal("show");
    });



//Boton nuevo
$("#btnNuevoTC").click(function(){
    $("#formTratamientosC").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Tratamiento en Curso");            
    $("#modalCRUD").modal("show");
    IdTC=null;
    opcion=1;        
});
var fila;

//botón EDITAR    
$(document).on("click", ".btnEditarR", function(){
    fila = $(this).closest("tr");
    IdTC = parseInt(fila.find('td:eq(0)').text());
    IdP = parseInt(fila.find('td:eq(2)').text());
    IdT = parseInt(fila.find('td:eq(4)').text());
    fechaI = fila.find('td:eq(5)').text();
    fechaF= fila.find('td:eq(6)').text();
    
    $("#IdP").val(IdP);
    $("#IdT").val(IdT);
    $("#fechaI").val(fechaI);
    $("#fechaF").val(fechaF);
    
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Tratamiento en Curso");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrarR", function(){    
    fila = $(this);
    IdTC = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3; //borrar
    var respuesta = confirm("¿Está seguro de cancelar el tratamiento en curso: "+IdTC+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crudTratamientosC.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, IdTC:IdTC},
            success: function(){
                tablaReceta.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});




$('#formTratamientosC').submit(function(e){
    e.preventDefault();    
    IdP = $.trim($("#IdP").val());
    IdT = $.trim($("#IdT").val());
    fechaI = $.trim($("#fechaI").val());
    fechaF = $.trim($("#fechaF").val());

    $.ajax({
        url: "bd/crudTratamientosC.php",
        type: "POST",
        dataType: "json",
        data: {IdP:IdP, IdT:IdT, fechaI:fechaI, fechaF:fechaF, IdTC:IdTC, opcion:opcion},
        success: function(data){  
            console.log(data);
            IdTC = data[0].IdTC;            
            IdP = data[0].IdP;
            IdT = data[0].IdT;
            fechaI = data[0].fechaI;
            fechaF = data[0].fechaF;
            if(opcion == 1){tablaTratamientosC.row.add([IdTC, IdP, IdT, fechaI, fechaF]).draw();}
            else{tablaTratamientosC.row(fila).data([IdTC, IdP, IdT, fechaI, fechaF]).draw();}           
            
        }        
    });
    $("#modalCRUD").modal("hide");     
}); 
   
});
