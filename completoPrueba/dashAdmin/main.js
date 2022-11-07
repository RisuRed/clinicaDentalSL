console.log("h");
$(document).ready(function(){
    //Hace referencia a la tabla pacientes
    tablaPacientes = $("#tablaPacientes").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarP'>Editar</button><button class='btn btn-danger btnBorrarP'>Borrar</button><button class='btn btn-warning btnTratamientosC'>Tratamientos</button></div></div>"  
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

    document.getElementById("Nom").addEventListener("keydown", teclear);
    document.getElementById("AP").addEventListener("keydown", teclear);
    document.getElementById("AM").addEventListener("keydown", teclear);
    document.getElementById("Calle").addEventListener("keydown", teclear);
    document.getElementById("Col").addEventListener("keydown", teclear);
    document.getElementById("Ciudad").addEventListener("keydown", teclear);
    var ban = false;
    var teclaAnt = "";
    function teclear(event){
        teclaAnt = teclaAnt + " " + event.keyCode;
        var arregloTA = teclaAnt.split(" ");
        if ((event.keyCode == 32 && arregloTA[arregloTA.length - 2] == 32)){
            event.preventDefault();
        }

    }
    document.getElementById("Nom").addEventListener("keydown",teclearPunto);
    document.getElementById("AP").addEventListener("keydown",teclearPunto);
    document.getElementById("AM").addEventListener("keydown",teclearPunto);
    document.getElementById("Calle").addEventListener("keydown",teclearPunto);
    document.getElementById("Col").addEventListener("keydown", teclear);
    document.getElementById("Ciudad").addEventListener("keydown", teclear);
    var teclaPunto = "";
    function teclearPunto(event){
        teclaPunto = teclaPunto + " " + event.keyCode;
        var arregloTM = teclaPunto.split(" ");
        //Si es igual a punto y el siguente es igual al anterior   
        if((event.keyCode == 190 && arregloTM[arregloTM.length - 2] == 190)){
                event.preventDefault();
        }
    }
 
//Boton nuevo paciente
$("#btnNuevoP").click(function(){
    $("#formPaciente").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Paciente");            
    $("#modalCRUD").modal("show");        
    IdP=null;
    opcion = 1; //alta
});    


var fila; //capturar la fila para editar o borrar el registro

//botón TRATAMIENTOS 
$(document).on("click", ".btnTratamientosC", function(){
    fila = $(this).closest("tr");
    IdP = parseInt(fila.find('td:eq(0)').text());
    //$("#IdP").val(IdP);
    console.log(IdP);
    $.ajax({
        type: "POST",
        url:"tratamientosC.php",
        //dataType: "json",
        data: {IdP:IdP},
        success: function(){
            console.log("dato enviado");
        }
    });
    window.location.href="tratamientosC.php";
    //window.location.href="tratamientosC.php?$IdP=" + document.IdP;
    
});

//botón EDITAR    
$(document).on("click", ".btnEditarP", function(){
    fila = $(this).closest("tr");
    IdP = parseInt(fila.find('td:eq(0)').text());
    Nom = fila.find('td:eq(1)').text();
    AP = fila.find('td:eq(2)').text();
    AM = fila.find('td:eq(3)').text();
    Edad = parseInt(fila.find('td:eq(4)').text());
    TelP = parseInt(fila.find('td:eq(5)').text());
    CorreoP = fila.find('td:eq(6)').text();
    Calle = fila.find('td:eq(7)').text();
    Col = fila.find('td:eq(8)').text();
    Ciudad = fila.find('td:eq(9)').text();
    CP = parseInt(fila.find('td:eq(10)').text());
    
    $("#Nom").val(Nom);
    $("#AP").val(AP);
    $("#AM").val(AM);
    $("#Edad").val(Edad);
    $("#TelP").val(TelP);
    $("#CorreoP").val(CorreoP);
    $("#Calle").val(Calle);
    $("#Col").val(Col);
    $("#Ciudad").val(Ciudad);
    $("#CP").val(CP);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Paciente");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrarP", function(){    
    fila = $(this);
    IdP = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el paciente: "+IdP+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, IdP:IdP},
            success: function(){
                tablaPaciente.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});

//Botón generar historial

//Almacena la información capturada, y la envía al archivo crud.php junto con la opción ya sea agregar o modificar 
$('#formPaciente').submit(function(e){
    e.preventDefault();    
    Nom = $.trim($("#Nom").val());
    AP = $.trim($("#AP").val());
    AM = $.trim($("#AM").val()); 
    Edad = $.trim($("#Edad").val()); 
    TelP = $.trim($("#TelP").val());
    CorreoP = $.trim($("#CorreoP").val()); 
    Calle = $.trim($("#Calle").val()); 
    Col = $.trim($("#Col").val()); 
    Ciudad = $.trim($("#Ciudad").val()); 
    CP = $.trim($("#CP").val()); 
    $.ajax({
        url: "bd/crud.php",   //Manda la información al archivo
        type: "POST",
        dataType: "json",
        data: {Nom:Nom, AP:AP, AM:AM, Edad:Edad, TelP:TelP, CorreoP:CorreoP, Calle:Calle, Col:Col, Ciudad:Ciudad, CP:CP, IdP:IdP, opcion:opcion},
        success: function(data){  
            console.log(data);
            IdP = data[0].IdP;            
            Nom = data[0].Nom;
            AP = data[0].AP;
            AM = data[0].AM;
            Edad = data[0].Edad;
            TelP = data[0].TelP;
            CorreoP = data[0].CorreoP;
            Calle = data[0].Calle;
            Col = data[0].Col;
            Ciudad = data[0].Ciudad;
            CP = data[0].CP;
            if(opcion == 1){tablaPacientes.row.add([IdP,Nom,AP,AM,Edad,TelP,CorreoP,Calle,Col,Ciudad,CP]).draw();}
            else{tablaPacientes.row(fila).data([IdP,Nom,AP,AM,Edad,TelP,CorreoP,Calle,Col,Ciudad,CP]).draw();}           
            
        }        
    });
    $("#modalCRUD").modal("hide");   //Oculta el formulario al término de la captura 
});    
    
});