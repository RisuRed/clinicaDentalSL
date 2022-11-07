<?php require_once "vistas/parte_superior.php"?>
<!--INICIO del cont Principal-->
<div class="container">
    <h1>Tratamientos en Curso</h1>
    
    <?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT t1.IdTC, t2.Nom, t2.AP, t2.AM, t1.IdP, t3.nomT, t1.IdT, t1.fechaI, t1.fechaF FROM tratamientoc t1 INNER JOIN paciente t2 INNER JOIN tratamiento t3 WHERE (t1.IdP=t2.IdP && t1.IdT=t3.IdT) ";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);


$IdP= (isset($_POST['IdP'])) ? $_POST['IdP'] : '';
//echo $IdP;
//echo json_encode($IdP, JSON_UNESCAPED_UNICODE);
//echo "console.log('Console: " . $IdP . "' );</script>";

?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevoTC" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaTratamientosC" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id Tratamiento Curso</th>
                                <th>Nombre Paciente</th>
                                <th>Id Paciente</th>
                                <th>Nombre Tratamiento</th>
                                <th>Id Tratamiento</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Termino</th>
                                <th>Acciones</th>  
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['IdTC'] ?></td>
                                <td><?php echo $dat['Nom'].' '.$dat['AP'].' '.$dat['AM'] ?></td>
                                <td><?php echo $dat['IdP']?></td>
                                <td><?php echo $dat['nomT']?></td>
                                <td><?php echo $dat['IdT'] ?></td>
                                <td><?php echo $dat['fechaI'] ?></td>
                                <td><?php echo $dat['fechaF'] ?></td>
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
      
<!--Modal para Agregar-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formTratamientosC">    
            <div class="modal-body">
                <div class="form-group">
                    <!--<label for="Nom" class="col-form-label">Nombre Paciente:</label>
                    <input type="text" id = "IdP" name ="IdP">-->
                </div>
                <!--<div class="form-group">
                <label for="Nomm" class="col-form-label">Nombre Tratamiento:</label>
                <input type="text" id = "IdT" name ="IdT">
                </div>-->

                <!--Tratamientos-->
                <div class="form-group">
                <label for="nomT" class="col-form-label">Nombre Tratamiento:</label>
                <datalist name="NomTratamientos" id="nombresTratamientos">
                    <?php
                        $consultaN = $conexion->prepare("SELECT * from tratamiento");
                        $consultaN->execute();
                        $datos=$consultaN->fetchAll();
                        ?>
                        <?php
                        foreach ($datos as $nombres){?>
                            <option data-value ="<?php echo $nombres['IdT'];?>" value="<?php echo $nombres['nomT'] ;?>"></option>
                        <?php
                        }
                        ?>
                </datalist>
                <input id="selected5" list="nombresTratamientos" name="nombres4" type="text">
                <input id="obtenerTratamiento2" type ="button" value = "Buscar">
                </div>
                <div class="form-group">
                <label for="IdT" class="col-form-label" style="display:none;">Id Médico:</label>
                <input type="text" id = "IdT" name ="IdT" style="display:none;" disabled>
                </div>

                <div class="form-group">
                <label for="fechaI" class="col-form-label">Fecha Inicio:</label>
                <input type="date" value="dd/mm/aaaa" class="form-control" id="fechaI">
                </div>

                <div class="form-group">
                <label for="fechaF" class="col-form-label">Fecha Final:</label>
                <input type="date" value="dd/mm/aaaa" class="form-control" id="fechaF">
                </div>
                     
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
 

    
</div>
<script type="text/javascript" src="tratamientosC.js"></script>
<!--FIN del cont principal
-->

<?php require_once "vistas/parte_inferior.php"?>