<?php 
/*
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header("Content-Type: application/json; charset=UTF-8");
    include_once '../class/class_user.php';
    
    $user = new TaxiClass();

    switch($_SERVER['REQUEST_METHOD']){
        

        case 'GET': //get a single o list
            
            
            if(isset($_GET['id'])){
                $getId = $user->getUser($_GET['id'],null);
                if(is_array($getId))
                {
                    $result["data"] = $getId;
                    $result["status"] = 'success';
                }
                else
                {
                    $result["status"] = "error";
                    $result["message"] = "Unable to communicate with database";                       
                }
            }
            else
            
            if(isset($_GET['email'])){
                    $getId = $user->getUser(null,$_GET['email']);
                    if(is_array($getId))
                    {
                        $result["data"] = $getId;
                        $result["status"] = 'success';
                    }
                    else
                    {
                        $result["status"] = "error";
                        $result["message"] = "Unable to communicate with database";                       
                    }
                }
            else{
                $getAll = $user->getAllUsers();
                if(is_array($getAll))
                {
                    $result["data"] = $getAll;
                    $result["status"] = 'success';
                }
                else
                {
                    $result["status"] = "error";
                    $result["message"] = "Unable to communicate with database";                       
                } 
            }
        break;        

        case 'POST': //create
            $_POST = json_decode(file_get_contents('php://input'), true);
            if( $user->insertUser($_POST['name'],$_POST['lastname'],
                                   $_POST['email'],$_POST['password']))
            {
                $result["status"] = 'success';
                $result["data"] = null;
            }
            else{
                $result["status"] = 'error';
                $result["message"] = "Duplicate data or invalid data";
            }

        break;
       
        case 'DELETE': //delete
            $_DELETE = json_decode(file_get_contents('php://input'),true);
            $deleteId = $user->deleteUser($_DELETE['id']);
            if($deleteId)
            {
                $result["data"] = null;
                $result["status"] = 'success';    
            }
            else
            {
                $result["status"] = "error";
                $result["message"] = "Unable to communicate with database";                       
            } 
        break;
        
        case 'PUT': //update
            $_PUT = json_decode(file_get_contents('php://input'),true);
            $updateId =  $user->updateUser($_PUT['id'],$_PUT['name'],$_PUT['lastname'],
            $_PUT['email'],$_PUT['password']);
            if($updateId)
            {
                $result["data"] = null;
                $result["status"] = 'success';                
            }
            else
            {
                $result["status"] = "error";
                $result["message"] = "Unable to communicate with database or duplicate";                       
            } 
        break;   
        
        default:{
            $result["status"] = "error";
            $result["message"] = "Unknown request";
        }
    }
    echo json_encode($result);
    */
?>

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json; charset=UTF-8");
include_once '../class/class_taxi.php';

$taxi = new TaxiClass();

switch ($_SERVER['REQUEST_METHOD']) {

    case 'GET': // Obtener un solo taxi o lista

        if (isset($_GET['id'])) {
            $getId = $taxi->getTaxi($_GET['id'], null);
            if (is_array($getId)) {
                $result["data"] = $getId;
                $result["status"] = 'success';
            } else {
                $result["status"] = "error";
                $result["message"] = "No se pudo obtener el taxi de la base de datos";
            }
        } else if (isset($_GET['marca'])) {
            $getMarca = $taxi->getTaxi(null, $_GET['marca']);
            if (is_array($getMarca)) {
                $result["data"] = $getMarca;
                $result["status"] = 'success';
            } else {
                $result["status"] = "error";
                $result["message"] = "No se pudo obtener el taxi de la base de datos";
            }
        } else {
            $getAll = $taxi->getAllTaxis();
            if (is_array($getAll)) {
                $result["data"] = $getAll;
                $result["status"] = 'success';
            } else {
                $result["status"] = "error";
                $result["message"] = "No se pudo obtener la lista de taxis de la base de datos";
            }
        }
        break;

    case 'POST': // Crear
        $_POST = json_decode(file_get_contents('php://input'), true);
        if ($taxi->insertTaxi($_POST['marca'], $_POST['modelo'], $_POST['anio'], $_POST['color'], $_POST['conductor'], $_POST['ubicacion'])) {
            $result["status"] = 'success';
            $result["data"] = null;
        } else {
            $result["status"] = 'error';
            $result["message"] = "No se pudo insertar el taxi en la base de datos";
        }
        break;

    case 'DELETE': // Eliminar
        $_DELETE = json_decode(file_get_contents('php://input'), true);
        $deleteId = $taxi->deleteTaxi($_DELETE['id']);
        if ($deleteId) {
            $result["data"] = null;
            $result["status"] = 'success';
        } else {
            $result["status"] = "error";
            $result["message"] = "No se pudo eliminar el taxi de la base de datos";
        }
        break;

    case 'PUT': // Actualizar
        $_PUT = json_decode(file_get_contents('php://input'), true);
        $updateId = $taxi->updateTaxi($_PUT['id'], $_PUT['marca'], $_PUT['modelo'], $_PUT['anio'], $_PUT['color'], $_PUT['conductor'], $_PUT['ubicacion']);
        if ($updateId) {
            $result["data"] = null;
            $result["status"] = 'success';
        } else {
            $result["status"] = "error";
            $result["message"] = "No se pudo actualizar el taxi en la base de datos";
        }
        break;

    default:
        {
            $result["status"] = "error";
            $result["message"] = "Solicitud desconocida";
        }
}
echo json_encode($result);
?>
