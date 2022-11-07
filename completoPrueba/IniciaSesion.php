<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesion</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="eCommerceDental.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">        
    <link rel="stylesheet" type="text/css" href="fuentes/iconic/css/material-design-iconic-font.min.css">
  </head>
  <body class="gradient-custom">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <img id="logo" class="navbar-brand" width="90" height="90" href="Index.html" src="Imagenes/logo.png">
      <a class="navbar-brand" href="Index.html">SmileLife</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Iniciar <span class="sr-only">Sesion</span></a>
          </li>
          <li class="nav-item">
            
          </li>
          <li class="nav-item">
            
          </li>
        </ul>
      </div>
    </nav>

    <div class="container-login">
        <div class="wrap-login">
            <form class="login-form validate-form" id="formLogin" action="" method="post">
                <span class="login-form-title">Iniciar Sesión</span>

                <!--Campo nombre de usuario con validación -->
                <div class="wrap-input100" data-validate = "Usuario incorrecto">
                    <input class="input100" type="text" id="usuario" name="usuario" placeholder="Usuario">
                    <span class="focus-efecto"></span>
                </div>

                <!--Campo contraseña con validación -->
                <div class="wrap-input100" data-validate="Password incorrecto">
                    <input class="input100" type="password" id="password" name="password" placeholder="Contraseña">
                    <span class="focus-efecto"></span>
                </div>

                <!--Formato para botón Ingresar -->
                <div class="container-login-form-btn">
                    <div class="wrap-login-form-btn">
                        <div class="login-form-bgbtn"></div>
                        <button name="submit" class="login-form-btn">INGRESAR</button>
                    </div>
                </div>
            </form>
        </div>
    </div>   
    <hr>
    <script src="jquery/jquery-3.3.1.min.js"></script>    
     <script src="bootstrap/js/bootstrap.min.js"></script>    
     <script src="popper/popper.min.js"></script>    
     <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="codigo.js"></script> 
  </body>
</html>