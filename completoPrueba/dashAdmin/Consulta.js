$(document).ready(function(){
    tablaTratamientosC = $("#tablaConsulta").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-danger btnBorrarCon'>Cancelar</button><button class='btn btn-warning btnImprimir'>Imprimir</button></div></div>"  
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
    $("#nombres2 option").each(function(i,el) {  
    data[$(el).data("value")] = $(el).val();
    });

    $("#tratamientosC option").each(function(i,el) {  
        data[$(el).data("value")] = $(el).val();
    });

    $("#tratamientosSub option").each(function(i,el) {  
        data[$(el).data("value")] = $(el).val();
    });

    $("#tC option").each(function(i,el) {  
        data[$(el).data("value")] = $(el).val();
    });

    $("#tratamientosTot option").each(function(i,el) {  
        data[$(el).data("value")] = $(el).val();
    });

    console.log(data, $("#browsers option").val());

        $('#obtener2').click(function()
        {
            var value = $('#selected2').val();
            var value2 = $('#tratamientosC option').val();
            var value3 = $('#tratamientosSub option').val();
            var value4 = $('#tC option').val();
            console.log(value4);
            var value5 = $('#tratamientosTot option').val();

            document.getElementById("IdCit").value = ($('#nombres2 [value="' + value + '"]').data('value'));
            //alert($('#nombres [value="' + value + '"]').data('value'));
            //$("#modalCRUD").modal("show");

            document.getElementById("CanT").value = ($('#tratamientosC [value="' + value2 + '"]').data('value'));

            document.getElementById("SubTotal").value = ($('#tratamientosSub [value="' + value3 + '"]').data('value'));

            document.getElementById("tc").value = ($('#tC [value="' + value4 + '"]').data('value'));

            document.getElementById("Total").value = ($('#tratamientosTot [value="' + value5 + '"]').data('value'));

        });



//Boton nuevo
$("#btnNuevaCon").click(function(){
    $("#formConsulta").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Consulta");            
    $("#modalCRUD").modal("show");
    IdCon=null;
    opcion=1;        
});
var fila;


$(document).on("click", ".btnImprimir", function(){
    //e.preventDefault(); 
    fila = $(this).closest("tr");
    IdCon = parseInt(fila.find('td:eq(0)').text());
    IdCit = fila.find('td:eq(1)').text();
    CanT = parseInt(fila.find('td:eq(2)').text());
    tc = fila.find('td:eq(3)').text();
    SubTotal = fila.find('td:eq(4)').text();
    Total= fila.find('td:eq(5)').text();

    console.log(IdCon);
    window.location = "imprimir.php?IdCon=" + IdCon + "&IdCit=" + IdCit + "&CanT=" + CanT + "&tc="+ tc +"&SubTotal="+ SubTotal + "&Total=" + Total;
   
});

$(document).on("click", ".btnBorrarCon", function(){    
    fila = $(this);
    IdCon = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3; //borrar
    var respuesta = confirm("¿Está seguro de cancelar la Consulta: "+IdCon+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crudConsulta.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, IdCon:IdCon},
            success: function(){
                tablaReceta.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});

$('#formConsulta').submit(function(e){
    e.preventDefault();    
    IdCon = $.trim($("#IdCon").val());
    IdCit = $.trim($("#IdCit").val());
    CanT = $.trim($("#CanT").val());
    tc = $.trim($("#tc").val());
    SubTotal = $.trim($("#SubTotal").val());
    Total = $.trim($("#Total").val());

    $.ajax({
        url: "bd/crudConsulta.php",
        type: "POST",
        dataType: "json",
        data: {IdCon:IdCon, IdCit:IdCit, CanT:CanT,tc:tc, SubTotal:SubTotal, Total:Total, opcion:opcion},
        success: function(data){  
            console.log(data);
            IdCon = data[0].IdCon; 
            IdCit = data[0].IdCit; 
            CanT = data[0].CanT;           
            tc = data[0].tc;           
            SubTotal = data[0].SubTotal;
            Total = data[0].Total;
            if(opcion == 1){tablaConsulta.row.add([IdCit, CanT, tc, SubTotal, Total]).draw();}
            else{tablaConsulta.row(fila).data([IdCit, CanT,tc,SubTotal, Total]).draw();}           
            
        }        
    });
    $("#modalCRUD").modal("hide");     
}); 
   
});
