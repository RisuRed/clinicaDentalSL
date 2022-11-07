<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$IdP= (isset($_POST['IdP'])) ? $_POST['IdP'] : '';
$IdT = (isset($_POST['IdT'])) ? $_POST['IdT'] : '';
$fechaI = (isset($_POST['fechaI'])) ? $_POST['fechaI'] : '';
$fechaF = (isset($_POST['fechaF'])) ? $_POST['fechaF'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$IdTC = (isset($_POST['IdTC'])) ? $_POST['IdTC'] : '';


switch($opcion){
    case 1: //alta
        //$consulta = "call insertarCi ('$id_P','$Hor_C','$Fec_Cit') ";
        $consulta = "INSERT INTO tratamientoc (IdP, IdT, fechaI, fechaF) VALUES('IdP', '$IdT', '$fechaI', '$fechaF') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        /*$consulta = "DELETE FROM citasdis WHERE hora='$Hor_C'";
        //$consulta = "INSERT INTO citas (id_P,Hor_C,Fec_Cit) VALUES('$id_P','$Hor_C', '$Fec_Cit') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); */

        //$consulta = "SELECT t1.id_P,t1.id_Cit,t2.Nom,t2.AP,t2.AM,t1.Hor_C,t1.Fec_Cit from citas t1 INNER JOIN pacientes t2 WHERE '$id_P'=t2.id_P"; 

        //$consulta = "SELECT id_Cit,id_P,Hor_C,Fec_Cit FROM citas ORDER BY id_Cit DESC LIMIT 1";
        /*$consulta = "SELECT t1.id_Cit,t2.Nom,t2.AP,t2.AM,t1.id_P,t1.Hor_C,t1.Fec_Cit FROM citas t1 INNER JOIN pacientes t2 WHERE '$id_P'=t2.id_P";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);*/
        break;
    case 2: //modificación
        //$consulta = "call modificarCi ('$id_Cit', '$Hor_C', '$Fec_Cit')";
        $consulta = "UPDATE tratamientoc SET IdP='$IdP', IdT='$IdT', fechaI='$fechaI', fechaF='$fechaF' WHERE IdTC='$IdTC' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
            
        //$consulta = "SELECT * FROM citas WHERE id_P='$id_P'"; 
        //$consulta = "SELECT t1.id_P,t1.id_Cit,t2.Nom,t2.AP,t2.AM,t1.Hor_C,t1.Fec_Cit from citas t1 INNER JOIN pacientes t2 WHERE '$id_P'=t2.id_P";     
        /*$resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);*/
        break;        
    case 3://baja
        //$consulta = "call eliminarCi ('$id_Cit') ";
        $consulta = "DELETE FROM tratamientoc WHERE IdTC='$IdTC' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        
       /* $consulta = "INSERT INTO citasdis (hora) VALUES ('$Hor_C') ";
        //$consulta = "INSERT INTO citas (id_P,Hor_C,Fec_Cit) VALUES('$id_P','$Hor_C', '$Fec_Cit') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT t1.id_P,t1.id_Cit,t2.Nom,t2.AP,t2.AM,t1.Hor_C,t1.Fec_Cit from citas t1 INNER JOIN pacientes t2 WHERE '$id_P'=t2.id_P";  
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);*/
        break; 

}


print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;