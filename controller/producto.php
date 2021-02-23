<?php

    header('Content-Type: application/json');

    require_once("../config/conexion.php");
    require_once("../models/Producto.php");
    $productos = new Producto();

    $body = json_decode(file_get_contents("php://input"), true);


    switch($_GET["op"]){

        case "GetAll":
            $datos=$productos->get_producto();
            echo json_encode($datos);
        break;

        case "GetId":
            $datos=$productos->get_producto_x_id($body["id"]);
            echo json_encode($datos);
        break;

        case "GetCategoria":
            $datos=$productos->get_producto_x_cat($body["categoria"]);
            echo json_encode($datos);
        break;

        case "Insert":
            $datos=$productos->insert_producto($body["nombrep"],$body["descripcion"],$body["categoria"],$body["precio"]);
            echo json_encode("Producto Registrado");
        break;

        case "Update":
            $datos=$productos->update_producto($body["id"],$body["nombrep"],$body["descripcion"],$body["categoria"],$body["precio"],$body["estado"]);
            echo json_encode("Actualizacion de Prodcuto Correcto");
        break;

        case "Delete":
            $datos=$productos->delete_producto($body["id"]);
            echo json_encode("Producto Eliminado Correcto");
        break;

        case "Activar":
            $datos=$productos->activar_producto($body["id"],$body["estado"]);
            echo json_encode("Producto Activado");
        break;


    }
?>