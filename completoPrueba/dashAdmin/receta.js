$(document).ready(function(){
    tablaReceta = $("#tablaReceta").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarR'>Editar</button><button class='btn btn-danger btnBorrarR'>Cancelar</button><button class='btn btn-warning btnImprimirR'>Imprimir</button></div></div>"  
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

    //Obtener el nombre del paciente
    var data = {};
    $("#nombresPacientes option").each(function(i,el) {  
    data[$(el).data("value")] = $(el).val();
    });
    console.log(data, $("#browsers option").val());

        $('#obtenerConsulta').click(function()
        {
            var value = $('#selected4').val();
            document.getElementById("id_Con").value = ($('#nombresPacientes [value="' + value + '"]').data('value'));
            //alert($('#nombresP [value="' + value + '"]').data('value'));
            //$("#modalCRUD").modal("show");
        });
    
    //Obtener el nombre del médico
    $("#nombresMedicos option").each(function(i,el) {  
        data[$(el).data("value")] = $(el).val();
    });
    console.log(data, $("#browsers option").val());
        
    $('#obtenerMedico2').click(function()
    {
        var value = $('#selected5').val();
        document.getElementById("id_Med").value = ($('#nombresMedicos [value="' + value + '"]').data('value'));
                    //alert($('#nombresP [value="' + value + '"]').data('value'));
                    //$("#modalCRUD").modal("show");
    });

    $("#nombresMedi option").each(function(i,el) {  
        data[$(el).data("value")] = $(el).val();
    });
    console.log(data, $("#browsers option").val());

    //var valueF="";
    $("#obtenerMedicamento").click(function(){ 
        var value = $('#selected6').val();
        //$("#idDelDiv").html(texto);
        //valueF = value + valueF;
        //$cadena = str_replace(array("\r\n", "\n\r", "\r", "\n"), "<br />", value);
        document.getElementById("id_Medi").value += ($('#nombresMedi [value="' + value +'"]').data('value'));
        $('#selected6').val(null); 
    })
 
//Boton nuevo
$("#btnNuevaR").click(function(){
    $("#formReceta").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Receta");            
    $("#modalCRUD").modal("show");
    id_rece=null;
    opcion=1;        
});
var fila;

//botón EDITAR    
$(document).on("click", ".btnEditarR", function(){
    fila = $(this).closest("tr");
    id_rece = parseInt(fila.find('td:eq(0)').text());
    Nom = parseInt(fila.find('td:eq(1)').text());
    id_Con = parseInt(fila.find('td:eq(2)').text());
    Nom_Med = fila.find('td:eq(3)').text();
    id_Med= fila.find('td:eq(4)').text();
    id_Medi = fila.find('td:eq(5)').text();
    Obse = fila.find('td:eq(6)').text();
    
    $("#Nom").val(Nom);
    $("#id_Con").val(id_Con);
    $("#Nom_Med").val(Nom_Med);
    $("#id_Med").val(id_Med);
    $("#id_Medi").val(id_Medi);
    $("#Obse").val(Obse);
    
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Receta");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrarR", function(){    
    fila = $(this);
    id_rece = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3; //borrar
    var respuesta = confirm("¿Está seguro de cancelar la receta: "+id_rece+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crudRecetas.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id_rece:id_rece},
            success: function(){
                tablaReceta.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});

$(document).on("click", ".btnImprimirR", function(){
    //e.preventDefault(); 
    fila = $(this).closest("tr");
    id_rece = parseInt(fila.find('td:eq(0)').text());
    Nom = fila.find('td:eq(1)').text();
    id_Con = parseInt(fila.find('td:eq(2)').text());
    Nom_Med = fila.find('td:eq(3)').text();
    id_Med= fila.find('td:eq(4)').text();
    id_Medi = fila.find('td:eq(5)').text();
    Obse = fila.find('td:eq(6)').text();

    console.log(Nom);
    window.location = "imprimir.php?id_rece=" + id_rece + "&Nom=" + Nom + "&id_Con=" + id_Con + "&Nom_Med="+ Nom_Med + "&id_Med=" + id_Med + "&id_Medi=" + id_Medi + "&Obse=" + Obse;
   
});


$('#formReceta').submit(function(e){
    e.preventDefault();    
    id_Con = $.trim($("#id_Con").val());
    id_Med = $.trim($("#id_Med").val());
    id_Medi = $.trim($("#id_Medi").val());
    Obse = $.trim($("#Obse").val());

    $.ajax({
        url: "bd/crudRecetas.php",
        type: "POST",
        dataType: "json",
        data: {id_Con:id_Con, id_Med:id_Med, id_Medi:id_Medi, Obse:Obse, id_rece:id_rece, opcion:opcion},
        success: function(data){  
            console.log(data);
            id_rece = data[0].id_rece;            
            id_Con = data[0].id_Con;
            id_Med = data[0].id_Med;
            id_Medi = data[0].id_Medi;
            Obse = data[0].Obse;
            if(opcion == 1){tablaReceta.row.add([id_rece, id_Con, id_Med, id_Medi, Obse]).draw();}
            else{tablaReceta.row(fila).data([id_rece, id_Con, id_Med, id_Medi, Obse]).draw();}           
            
        }        
    });
    $("#modalCRUD").modal("hide");     
}); 
   
});

