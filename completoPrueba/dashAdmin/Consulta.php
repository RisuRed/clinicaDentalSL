<?php require_once "vistas/parte_superior.php"?>
<!--INICIO del cont Principal-->
<div class="container">
    <h1>Consulta</h1>
    
    <?php
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT * FROM consulta";
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
            <button id="btnNuevaCon" type="button" class="btn btn-success" data-toggle="modal">Nueva</button>    
            </div>    
        </div>    
    </div>    
    <br>  
    <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaConsulta" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id Consulta</th>
                                <th>Id Cita</th>
                                <th>Cantidad tratamientos</th> <!--Cantidad de tratamientos que se haran en la consulta-->
                                <th>Tratamientos En Curso</th> <!--Cantidad de tratamientos que se haran en la consulta-->
                                <th>SubTotal</th> <!-- total se calcua a partir de los tratamientos que se realizaron???? -->
                                <th>Total</th> <!-- total se calcua a partir de los tratamientos que se realizaron + iva???? -->
                                <th>Acciones</th>  
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['IdCon'] ?></td>
                                <td><?php echo $dat['IdCit'] ?></td>
                                <td><?php echo $dat['CanT']?></td>
                                <td><?php echo $dat['tc']?></td>
                                <td><?php echo $dat['SubTotal']?></td>
                                <td><?php echo $dat['Total'] ?></td>
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
        <form id="formConsulta">    
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
                <label for="Nom" class="col-form-label">Nombre Paciente:</label>
                <datalist name="Nom" id="nombres2">
                    <?php
                        //include('bd/conexion.php');
                        $consultaN = $conexion->prepare ("SELECT t1.IdCit,t2.Nom,t2.AP,t2.AM from cita t1 INNER JOIN paciente t2 WHERE t1.IdP=t2.IdP");
                        $consultaN->execute();
                        $datos=$consultaN->fetchAll();
                        ?>
                        <?php
                        foreach ($datos as $nombres){?>
                            <option data-value ="<?php echo $nombres['IdCit'];?>" value="<?php echo $nombres['Nom'].' '.$nombres['AP'].' '.$nombres['AM'];?>"></option>
                        <?php
                        }
                        ?>
                </datalist>
                <input id="selected2" list="nombres2" name="nombres3" type="text">
                <input id="obtener2" type ="button" value = "Buscar">
                </div>
                <div class="form-group">
                <label for="IdCit" class="col-form-label" style="display:none;">Id Cita:</label>
                <input type="text" id = "IdCit" name ="IdCit" disabled/>
                </div>
                
                <div class="form-group" id="tC">
                <label for="CanT" class="col-form-label">Tratamientos en curso:</label>
                <?php
                        //include('bd/conexion.php');
                        $consultaN = $conexion->prepare ("SELECT nomT as TC from tratamiento t1 INNER join tratamientoc t2 INNER join paciente t3 where (t3.IdP=t2.IdP && t1.IdT=t2.IdT)");
                        $consultaN->execute();
                        $datos=$consultaN->fetchAll();

                        ?>
                        <?php
                        $tratamientosCurso="";
                        foreach ($datos as $tratamientos){
                            $tratamientosCurso = $tratamientos['TC'].'                                                  '.$tratamientosCurso;

                        ?>
                        <?php
                        }
                        ?>
                        <option data-value ="<?php echo $tratamientosCurso;?>" value="<?php echo $tratamientosCurso;?>"></option>
                        
                <textarea id ="tc" name ="tc" rows="6" cols="30" disabled></textarea>
                </div>
                


                <div class="form-group" id="tratamientosC">
                <label for="CanT" class="col-form-label">Cantidad de tratamientos:</label>
                <?php
                        //include('bd/conexion.php');
                        $consultaN = $conexion->prepare ("SELECT count(nomT) as CanT from tratamiento t1 INNER join tratamientoc t2 INNER join paciente t3 where (t3.IdP=t2.IdP && t1.IdT=t2.IdT)");
                        $consultaN->execute();
                        $datos=$consultaN->fetchAll();
                        ?>
                        <?php
                        foreach ($datos as $tratamientos){
                            ?>
                            <option data-value ="<?php echo $tratamientos['CanT'];?>" value="<?php echo $tratamientos['CanT'];?>"></option>
                        <?php
                        }
                        ?>
                
                <input type="text" id ="CanT" name ="CanT" disabled/>
                </div>

                <div class="form-group" id="tratamientosSub">
                <label for="SubTotal" class="col-form-label">Subtotal:</label>
                <?php
                        //include('bd/conexion.php');
                        $consultaN = $conexion->prepare ("SELECT SUM(costoT) as SubTotal from tratamiento t1 INNER join tratamientoc t2 INNER join paciente t3 where (t3.IdP=t2.IdP && t1.IdT=t2.IdT)");
                        $consultaN->execute();
                        $datos=$consultaN->fetchAll();
                        ?>
                        <?php
                        foreach ($datos as $tratamientos){
                            ?>
                            <option data-value ="<?php echo $tratamientos['SubTotal'];?>" value="<?php echo $tratamientos['SubTotal'];?>"></option>
                        <?php
                        }
                        ?>
                
                <input type="text" id ="SubTotal" name ="SubTotal" disabled/>
                </div>

                <div class="form-group" id="tratamientosTot">
                <label for="SubTotal" class="col-form-label">Total:</label>
                <?php
                        //include('bd/conexion.php');
                        $consultaN = $conexion->prepare ("SELECT (SUM(costoT)*0.16)+ SUM(costoT) as Total from tratamiento t1 INNER join tratamientoc t2 INNER join paciente t3 where (t3.IdP=t2.IdP && t1.IdT=t2.IdT) ");
                        $consultaN->execute();
                        $datos=$consultaN->fetchAll();
                        ?>
                        <?php
                        foreach ($datos as $tratamientos){
                            ?>
                            <option data-value ="<?php echo $tratamientos['Total'];?>" value="<?php echo $tratamientos['Total'];?>"></option>
                        <?php
                        }
                        ?>
                
                <input type="text" id ="Total" name ="Total" disabled/>
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
<script type="text/javascript" src="Consulta.js"></script>
<!--FIN del cont principal
-->

<?php require_once "vistas/parte_inferior.php"?>