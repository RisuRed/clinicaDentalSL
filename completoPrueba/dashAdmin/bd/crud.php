<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$Nom = (isset($_POST['Nom'])) ? $_POST['Nom'] : '';
$AP = (isset($_POST['AP'])) ? $_POST['AP'] : '';
$AM = (isset($_POST['AM'])) ? $_POST['AM'] : '';
$Edad = (isset($_POST['Edad'])) ? $_POST['Edad'] : '';
$TelP= (isset($_POST['TelP'])) ? $_POST['TelP'] : '';
$CorreoP = (isset($_POST['CorreoP'])) ? $_POST['CorreoP'] : '';
$Calle = (isset($_POST['Calle'])) ? $_POST['Calle'] : '';
$Col = (isset($_POST['Col'])) ? $_POST['Col'] : '';
$Ciudad = (isset($_POST['Ciudad'])) ? $_POST['Ciudad'] : '';
$CP = (isset($_POST['CP'])) ? $_POST['CP'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$IdP = (isset($_POST['IdP'])) ? $_POST['IdP'] : '';

switch($opcion){
    case 1: //alta
        //Consulta para dar de alta
        $consulta = "INSERT INTO paciente (Nom, AP, AM, Edad, TelP, CorreoP, Calle, Col, Ciudad, CP) VALUES('$Nom','$AP','$AM','$Edad','$TelP','$CorreoP','$Calle','$Col','$Ciudad','$CP') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        //Consulta para mostrar todos los datos
        $consulta = "SELECT IdP, Nom, AP, AM, Edad, TelP, CorreoP, Calle, Col, Ciudad, CP FROM paciente ORDER BY IdP DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

    case 2: //modificación
        //Consulta para modificar
        $consulta = "UPDATE paciente SET Nom='$Nom', AP='$AP', AM='$AM', Edad='$Edad', TelP='$TelP', CorreoP='$CorreoP', Calle='$Calle', Col='$Col', Ciudad='$Ciudad', CP='$CP' WHERE IdP='$IdP' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        //Consulta para consultar un paciente en especifico 
        $consulta = "SELECT IdP, Nom, AP, AM, Edad, TelP, CorreoP, Calle, Col, Ciudad, CP FROM paciente WHERE IdP='$IdP' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        //Consulta para eliminar
        $consulta = "DELETE FROM paciente WHERE IdP='$IdP' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $consulta = "SELECT IdP, Nom, AP, AM, Edad, TelP, CorreoP, Calle, Col, Ciudad, CP FROM paciente WHERE IdP='$IdP' ";   
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    
}


print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;

