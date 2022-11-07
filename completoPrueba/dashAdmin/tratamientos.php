<?php require_once "vistas/parte_superior.php"?>
<!--INICIO del contenedor Principal-->
<div class="container">
    <h1>Tratamientos</h1>
    
    <?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT * FROM tratamiento";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


?>
   
    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevoT" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <!--Creación de la tabla pacientes-->
                    <div class="table-responsive">        
                        <table id="tablaTratamientos" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                        <!--Columnas de la tabla pacientes-->    
                        <tr>
                                <th>Identificador</th>
                                <th>Nombre</th>
                                <th>Sesiones</th>
                                <th>Costo Total</th>
                                <th>Acciones</th> 
                            </tr>
                        </thead>
                        <!--Datos de las filas de la tabla pacientes-->
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['IdT'] ?></td>
                                <td><?php echo $dat['nomT'] ?></td>
                                <td><?php echo $dat['numSes'] ?></td>
                                <td><?php echo $dat['costoT'] ?></td>
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
            <!--Formulario para agregar y modificar un tratamiento-->
        <form id="formTratamiento">    
            <div class="modal-body">
                <div class="form-group">
                <label for="Nom" class="col-form-label">Nombre:</label>
                <input type="text" onKeypress="if ((event.keyCode < 65 || event.keyCode > 90) && (event.keyCode < 97 || event.keyCode > 122) && (event.keyCode < 1 || event.keyCode > 33) && (event.keyCode < 164 || event.keyCode > 165) && (event.keyCode < 46 || event.keyCode > 46)) event.returnValue =false; this.value=this.value.replace(' ',' ');" class="form-control" id="nomT" onkeyup="">
                </div>
                <div class="form-group">
                <label for="Edad" class="col-form-label">Sesiones:</label>
                <input type="text" maxlength="2" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" class="form-control" id="numSes">
                </div>
                <div class="form-group">
                <label for="TelP" class="col-form-label">Costo:</label>
                <input type="text" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" class="form-control" id="costoT">
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
<script type="text/javascript" src="tratamientos.js"></script>
<!--FIN del cont principal
-->

<?php require_once "vistas/parte_inferior.php"?>