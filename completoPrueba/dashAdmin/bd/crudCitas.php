<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$IdP = (isset($_POST['IdP'])) ? $_POST['IdP'] : '';
$FechaC = (isset($_POST['FechaC'])) ? $_POST['FechaC'] : '';
$HoraC = (isset($_POST['HoraC'])) ? $_POST['HoraC'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$IdCit = (isset($_POST['IdCit'])) ? $_POST['IdCit'] : '';

switch($opcion){
    case 1: //alta
        //Consulta para dar de alta
        $consulta = "INSERT INTO cita (IdP, FechaC, HoraC) VALUES('$IdP','$FechaC','$HoraC')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        
        $consulta = "DELETE FROM citasdis WHERE hora='$HoraC'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        break;

    case 2: //modificación
        //Consulta para modificar
        $consulta = "UPDATE cita SET IdP='$IdP', FechaC='$FechaC', HoraC='$HoraC' WHERE IdCit='$IdCit' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        //Consulta para consultar un paciente en especifico 
        $consulta = "SELECT IdCIt, IdP, FechaC, HoraC FROM cita WHERE IdCit='$IdCit' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        //Consulta para eliminar
        $consulta = "DELETE FROM cita WHERE IdCit='$IdCit' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        
        $consulta = "INSERT INTO citasdis (hora) VALUES ('$HoraC') ";
        //$consulta = "INSERT INTO citas (id_P,Hor_C,Fec_Cit) VALUES('$id_P','$Hor_C', '$Fec_Cit') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT IdCit, IdP, FechaC, HoraC FROM cita WHERE IdCit='$IdCit' ";   
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    
}


print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;

