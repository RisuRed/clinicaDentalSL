<?php require_once "vistas/parte_superior.php"?>
<!--INICIO del cont Principal-->
<div class="container">
    <h1>Citas</h1>
    
    <?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT t1.IdP,t1.IdCit,t2.Nom,t2.AP,t2.AM,t1.HoraC,t1.FechaC from cita t1 INNER JOIN paciente t2 WHERE t1.IdP=t2.IdP";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNueva" type="button" class="btn btn-success" data-toggle="modal">Nueva</button>    
            </div>    
        </div>    
    </div>    
    <br>  
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaCita" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id Cita</th>
                                <th>Nombre Paciente</th>
                                <th>Id Paciente</th>
                                <th>Fecha Cita</th>
                                <th>Hora Cita</th>
                                <th>Acciones</th>  
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['IdCit'] ?></td>
                                <td><?php echo $dat['Nom'].' '.$dat['AP'].' '.$dat['AM'] ?></td>
                                <td><?php echo $dat['IdP']?></td>
                                <td><?php echo $dat['FechaC'] ?></td>
                                <td><?php echo $dat['HoraC'] ?></td>
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
        <form id="formCitas">    
            <div class="modal-body">
            <div class="form-group">
                <label for="Nom" class="col-form-label">Nombre Paciente:</label>
                <datalist name="Nom" id="nombres">
                    <?php
                        //include('bd/conexion.php');
                        $consultaN = $conexion->prepare("SELECT * FROM paciente");
                        $consultaN->execute();
                        $datos=$consultaN->fetchAll();
                        ?>
                        <?php
                        foreach ($datos as $nombres){?>
                            <option data-value ="<?php echo $nombres['IdP'];?>" value="<?php echo $nombres['Nom'].' '.$nombres['AP'].' '.$nombres['AM'];?>"></option>
                        <?php
                        }
                        ?>
                </datalist>
                <input id="selected" list="nombres" name="nombres2" type="text">
                <input id="obtener" type ="button" value = "Buscar">
                </div>
                <div class="form-group">
                <label for="IdP" class="col-form-label" style="display:none;">Id Paciente:</label>
                <input type="text" id = "IdP" name ="IdP" style="display:none;" disabled/>
                </div>
                <div class="form-group">
                <label for="FechaC" class="col-form-label">Fecha Cita:</label>
                <input type="date" min="2021-11-04" value="dd/mm/aaaa" class="form-control" id="FechaC">
                </div>
                <div class="form-group">
                <label for="HoraC" class="col-form-label" style="display:none;">Hora:</label>
                <input type="time" id="HoraC" name="HoraC" min="07:00" max="18:00" step="3600" required>
                <!--codigo hora-->
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
 
<!--Modal para modificar -->

    
</div>
<script type="text/javascript" src="citas.js"></script>
<!--FIN del cont principal
-->

<?php require_once "vistas/parte_inferior.php"?>