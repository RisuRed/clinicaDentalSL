<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$IdCit = (isset($_POST['IdCit'])) ? $_POST['IdCit'] : '';
$CanT = (isset($_POST['CanT'])) ? $_POST['CanT'] : '';
$tc = (isset($_POST['tc'])) ? $_POST['tc'] : '';
$SubTotal = (isset($_POST['SubTotal'])) ? $_POST['SubTotal'] : '';
$Total = (isset($_POST['Total'])) ? $_POST['Total'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$IdCon = (isset($_POST['IdCon'])) ? $_POST['IdCon'] : '';


switch($opcion){
    case 1: //alta
        //$consulta = "call insertarCi ('$id_P','$Hor_C','$Fec_Cit') ";
        $consulta = "INSERT INTO consulta (IdCit, CanT,tc,SubTotal, Total) VALUES('$IdCit', '$CanT','$tc','$SubTotal', '$Total') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT * FROM consulta";
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
        $consulta = "DELETE FROM consulta WHERE IdCon='$IdCon' ";		
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