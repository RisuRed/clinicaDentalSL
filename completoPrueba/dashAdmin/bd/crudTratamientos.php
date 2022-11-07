<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$nomT = (isset($_POST['nomT'])) ? $_POST['nomT'] : '';
$numSes = (isset($_POST['numSes'])) ? $_POST['numSes'] : '';
$costoT = (isset($_POST['costoT'])) ? $_POST['costoT'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$IdT = (isset($_POST['IdT'])) ? $_POST['IdT'] : '';

switch($opcion){
    case 1: //alta
        //Consulta para dar de alta
        $consulta = "INSERT INTO tratamiento (nomT, numSes, costoT) VALUES('$nomT','$numSes','$costoT')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT IdT, nomT, numSes, costoT FROM tratamiento ORDER BY IdT DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        //$consulta = "DELETE FROM citasdis WHERE hora='$HoraC'";			
        //$resultado = $conexion->prepare($consulta);
        //$resultado->execute(); 

        //Consulta para mostrar todos los datos
        //$consulta = "SELECT IdCit, IdP, FechaC, HoraC FROM cita ORDER BY IdCIt DESC LIMIT 1";
        //$resultado = $conexion->prepare($consulta);
        //$resultado->execute();
        //$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

    case 2: //modificación
        //Consulta para modificar
        $consulta = "UPDATE tratamiento SET nomT='$nomT', numSes='$numSes', costoT='$costoT' WHERE IdT='$IdT' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        //Consulta para consultar un paciente en especifico 
        $consulta = "SELECT IdT, nomT, numSes, costoT FROM tratamiento WHERE IdT='$IdT' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        //Consulta para eliminar
        $consulta = "DELETE FROM tratamiento WHERE IdT='$IdT' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        
        $consulta = "SELECT * FROM tratamiento";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        
        //$consulta = "INSERT INTO citasdis(hora) VALUES ('$HoraC')";			
        //$resultado = $conexion->prepare($consulta);
        //$resultado->execute(); 

        $consulta = "SELECT IdT, nomT, numSes, costoT FROM tratamiento WHERE IdT='$IdT' ";   
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    
}


print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;

