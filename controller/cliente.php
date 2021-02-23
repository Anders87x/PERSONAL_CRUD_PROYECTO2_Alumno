<?php

    header('Content-Type: application/json');

    require_once("../config/conexion.php");
    require_once("../models/Cliente.php");
    $clientes = new Clientes();

    $body = json_decode(file_get_contents("php://input"), true);


    switch($_GET["op"]){

        case "GetAll":
            $datos=$clientes->get_cliente();
            echo json_encode($datos);
        break;

        case "GetId":
            $datos=$clientes->get_cliente_x_id($body["id"]);
            echo json_encode($datos);
        break;

        case "GetApellidos":
            $datos=$clientes->get_cliente_x_ape($body["apellidos"]);
            echo json_encode($datos);
        break;

        case "Insert":
            $datos=$clientes->insert_cliente($body["nombres"],$body["apellidos"],$body["email"],$body["celular"],$body["direccion"]);
            echo json_encode("Cliente Registrado");

        break;

        case "Update":
            $datos=$clientes->update_cliente($body["id"],$body["nombres"],$body["apellidos"],$body["email"],$body["celular"],$body["direccion"],$body["estado"]);
            echo json_encode("Actualizacion de Cliente Correcto");
        break;

        case "Delete":
            $datos=$clientes->delete_cliente($body["id"]);
            echo json_encode("Cliente de baja");
        break;

        case "Activar":
            $datos=$clientes->activar_cliente($body["id"],$body["estado"]);
            echo json_encode("Cliente Activado");
        break;


    }
?>