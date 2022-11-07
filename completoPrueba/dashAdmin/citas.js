$(document).ready(function(){
    tablaCita = $("#tablaCita").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarC'>Editar</button><button class='btn btn-danger btnBorrarC'>Cancelar</button></div></div>"  
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
    $("#nombres option").each(function(i,el) {  
    data[$(el).data("value")] = $(el).val();
    });
    console.log(data, $("#browsers option").val());

        $('#obtener').click(function()
        {
            var value = $('#selected').val();
            document.getElementById("IdP").value = ($('#nombres [value="' + value + '"]').data('value'));
            //alert($('#nombres [value="' + value + '"]').data('value'));
            //$("#modalCRUD").modal("show");
        });
 
//Boton nuevo
$("#btnNueva").click(function(){
    $("#formCitas").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Cita");            
    $("#modalCRUD").modal("show");
    IdCit=null;
    opcion=1;        
});
var fila;

//botón EDITAR    
$(document).on("click", ".btnEditarC", function(){
    fila = $(this).closest("tr");
    IdCit = parseInt(fila.find('td:eq(0)').text());
    Nom = fila.find('td:eq(1)').text();
    IdP= fila.find('td:eq(2)').text();
    FechaC = fila.find('td:eq(3)').text();
    HoraC = fila.find('td:eq(4)').text();
    
    
    $("#Nom").val(Nom);
    $("#IdP").val(IdP);
    $("#FechaC").val(FechaC);
    $("#HoraC").val(HoraC);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Cita");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrarC", function(){    
    fila = $(this);
    IdCit = parseInt($(this).closest("tr").find('td:eq(0)').text());
    HoraC = parseInt($(this).closest("tr").find('td:eq(4)').text());
    HoraC = HoraC+":"+"00";
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de cancelar la cita: "+IdCit+" que será a las"+HoraC+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crudCitas.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, IdCit:IdCit, HoraC:HoraC},
            success: function(){
                tablaCita.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});

$('#formCitas').submit(function(e){
    e.preventDefault();    
    IdP = $.trim($("#IdP").val());
    FechaC = $.trim($("#FechaC").val());
    HoraC = $.trim($("#HoraC").val());  
    $.ajax({
        url: "bd/crudCitas.php",
        type: "POST",
        dataType: "json",
        data: {IdP:IdP, FechaC:FechaC, HoraC:HoraC, IdCit:IdCit, opcion:opcion},
        success: function(data){  
            console.log(data);
            IdCit = data[0].IdCit;            
            IdP = data[0].IdP;
            Nom = data[0].Nom;
            FechaC = data[0].FechaC;
            HoraC = data[0].HoraC;
            if(opcion == 1){tablaCita.row.add([IdCit,IdP,FechaC,HoraC]).draw();}
            else{tablaCita.row(fila).data([IdCit,IdP,FechaC,HoraC]).draw();}           
            
        }        
    });
    $("#modalCRUD").modal("hide");     
});    
   
});

