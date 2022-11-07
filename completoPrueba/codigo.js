$('#formLogin').submit(function(e){
   e.preventDefault();
   var usuario = $.trim($("#usuario").val());    //Obtiene el valor capturado en el campo usuario
   var password =$.trim($("#password").val());    //Obtiene el valor capturado en el campo contraseña
    
   if(usuario.length == "" || password == ""){  //Verifica que los campos no sean nulos
      Swal.fire({
          type:'warning',
          title:'Debe ingresar un usuario y/o contraseña',  //Arroja un aviso de campos vacíos
      });
      return false; 
    }else{
        if(usuario=="Admin" && password=="admin12345"){      //Verifica la información para el uauario admin
            window.location.href = "dashAdmin/pacientes.php";  //Abre la interfaz del usuario admin
        }
        else if(usuario=="Recepcionista" && password=="recep12345"){   //Verifica la información para el uauario recepcionista
            window.location.href = "dashRecepcionista/citas.php";   //Abre la interfaz del usuario recepcionista
        }
        else if(usuario=="Medico" && password=="medico12345"){   //Verifica la información para el uauario médico
            window.location.href = "dashMedico/consultas.php";  //Abre la interfaz del usuario médico
        }
        else{
            Swal.fire({
                type:'error',
                title:'Usuario y/o password incorrecta',   //Arroja mensaje de error si se ingresan datos diferntes
            });
        }
    }
});