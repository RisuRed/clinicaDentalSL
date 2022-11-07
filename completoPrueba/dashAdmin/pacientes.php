<?php require_once "vistas/parte_superior.php"?>
<!--INICIO del contenedor Principal-->
<div class="container">
    <h1>Pacientes</h1>    
    <?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT * FROM paciente";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


?>
   
    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevoP" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <!--Creación de la tabla pacientes-->
                    <div class="table-responsive">        
                        <table id="tablaPacientes" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                        <!--Columnas de la tabla pacientes-->    
                        <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Edad</th>
                                <th>Telefono</th>
                                <th>Correo</th>
                                <th>Calle</th>
                                <th>Colonia</th>
                                <th>Ciudad</th>
                                <th>Codigo Postal</th>
                                <th>Acciones</th> 
                            </tr>
                        </thead>
                        <!--Datos de las filas de la tabla pacientes-->
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['IdP'] ?></td>
                                <td><?php echo $dat['Nom'] ?></td>
                                <td><?php echo $dat['AP'] ?></td>
                                <td><?php echo $dat['AM'] ?></td>
                                <td><?php echo $dat['Edad'] ?></td>
                                <td><?php echo $dat['TelP'] ?></td>
                                <td><?php echo $dat['CorreoP'] ?></td>
                                <td><?php echo $dat['Calle'] ?></td>
                                <td><?php echo $dat['Col'] ?></td>
                                <td><?php echo $dat['Ciudad'] ?></td>
                                <td><?php echo $dat['CP'] ?></td>
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
      
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Formulario para agregar y modificar unpacientes-->
        <form id="formPaciente">    
            <div class="modal-body">
                <div class="form-group">
                <label for="Nom" class="col-form-label">Nombre:</label>
                <input type="text" onKeypress="if ((event.keyCode < 65 || event.keyCode > 90) && (event.keyCode < 97 || event.keyCode > 122) && (event.keyCode < 1 || event.keyCode > 33) && (event.keyCode != 46) && (event.keyCode < 164 || event.keyCode > 165)) event.returnValue =false;" class="form-control" id="Nom">
                </div>
                <div class="form-group">
                <label for="AP" class="col-form-label">Apellido Paterno:</label>
                <input type="text" onKeypress="if ((event.keyCode < 65 || event.keyCode > 90) && (event.keyCode < 97 || event.keyCode > 122) && (event.keyCode < 1 || event.keyCode > 33) && (event.keyCode < 164 || event.keyCode > 165)) event.returnValue = false;" class="form-control" id="AP">
                </div>                
                <div class="form-group">
                <label for="AM" class="col-form-label">Apellido Materno:</label>
                <input type="text" onKeypress="if ((event.keyCode < 65 || event.keyCode > 90) && (event.keyCode < 97 || event.keyCode > 122) && (event.keyCode < 1 || event.keyCode > 33) && (event.keyCode < 164 || event.keyCode > 165)) event.returnValue = false;" class="form-control" id="AM">
                </div>
                <div class="form-group">
                <label for="Edad" class="col-form-label">Edad:</label>
                <input type="text" maxlength="2" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" class="form-control" id="Edad">
                </div>
                <div class="form-group">
                <label for="TelP" class="col-form-label">Telefono:</label>
                <input type="text" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" class="form-control" id="TelP">
                </div>
                <div class="form-group">
                <label for="CorreoP" class="col-form-label">Correo Electronico:</label>
                <input type="email" class="form-control" id="CorreoP">
                </div>
                <div class="form-group">
                <label for="Calle" class="col-form-label">Calle:</label>
                <input type="text" onKeypress="if ((event.keyCode < 65 || event.keyCode > 90) && (event.keyCode < 97 || event.keyCode > 122) && (event.keyCode < 1 || event.keyCode > 33) && (event.keyCode < 164 || event.keyCode > 165)) event.returnValue = false;" class="form-control" id="Calle">
                </div>
                <div class="form-group">
                <label for="Col" class="col-form-label">Colonia:</label>
                <input type="text" onKeypress="if ((event.keyCode < 65 || event.keyCode > 90) && (event.keyCode < 97 || event.keyCode > 122) && (event.keyCode < 1 || event.keyCode > 33) && (event.keyCode < 164 || event.keyCode > 165)) event.returnValue = false;" class="form-control" id="Col">
                </div>
                <div class="form-group">
                <label for="Ciudad" class="col-form-label">Ciudad:</label>
                <input type="text" onKeypress="if ((event.keyCode < 65 || event.keyCode > 90) && (event.keyCode < 97 || event.keyCode > 122) && (event.keyCode < 1 || event.keyCode > 33) && (event.keyCode < 164 || event.keyCode > 165)) event.returnValue = false;" class="form-control" id="Ciudad">
                </div>
                <div class="form-group">
                <label for="CP" class="col-form-label">Codigo Postal:</label>
                <input type="text" maxlength="5" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" class="form-control" id="CP">
                </div>     
            </div>
            <!--Botones para guardar o cancelar el alta o modificación del paciente-->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>
        
        </div>
    </div>
</div>  
   
    
</div>
<script type="text/javascript" src="main.js"></script>
<!--FIN del cont principal
-->

<?php require_once "vistas/parte_inferior.php"?>