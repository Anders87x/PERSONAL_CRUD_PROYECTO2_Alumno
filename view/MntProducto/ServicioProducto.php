<?php
    switch($_GET["op"]){
        case "listar":
            $url='http://localhost:90/PERSONAL_CRUD_PROYECTO2_Alumno/controller/producto.php?op=GetAll';
            $json= file_get_contents($url);
            $datos=json_decode($json,true);

            $data=Array();
            foreach($datos as $row){
                $sub_array= array();
                $sub_array[] = $row["nombrep"];
                $sub_array[] = $row["descripcion"];
                $sub_array[] = $row["categoria"];
                $sub_array[] = $row["precio"];
                if($row["estado"] == '1'){
                    $sub_array[] = '<button class="btn btn-success btn-sm" onClick="desactivar(' . $row["id"] . ');"  id="' . $row["id"] . '">Activo</button>';
                }
                else{
                    $sub_array[] = '<button class="btn btn-warning btn-sm" onClick="activar(' . $row["id"] . ');"  id="' . $row["id"] . '">Desactivado</button>';
                }
                $sub_array[] = '<button class="btn btn-primary btn-sm" onClick="editar(' . $row["id"] . ');"  id="' . $row["id"] . '">Editar</button>';
                $sub_array[] = '<button class="btn btn-danger btn-sm" onClick="eliminar(' . $row["id"] . ');"  id="' . $row["id"] . '">Eliminar</button>';
                $data[]=$sub_array;
            }
            $results= array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        case "guardar":
            $url = "http://localhost:90/PERSONAL_CRUD_PROYECTO2_Alumno/controller/producto.php?op=Insert";
            $data = array(
                "nombrep" => $_POST["nombrep"],
                "descripcion" => $_POST["descripcion"],
                "categoria" => $_POST["categoria"],
                "precio" => $_POST["precio"],
                "estado" => "1"
            );
            $payload = json_encode($data);

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(
                $curl,
                CURLOPT_HTTPHEADER,
                array("Content-type: application/json")
            );
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
            $json_response = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ($status != 201) {
                $obj = json_decode($json_response);
            }

            curl_close($curl);
            $response = json_decode($json_response, true);
            break;

        case "actualizar":
            $url = "http://localhost:90/PERSONAL_CRUD_PROYECTO2_Alumno/controller/producto.php?op=Update";
            $data = array(
                "id" => $_POST["id"],
                "nombrep" => $_POST["nombrep"],
                "descripcion" => $_POST["descripcion"],
                "categoria" => $_POST["categoria"],
                "precio" => $_POST["precio"],
                "estado" => "1"
            );
            $payload = json_encode($data);

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(
                $curl,
                CURLOPT_HTTPHEADER,
                array("Content-type: application/json")
            );
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
            $json_response = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ($status != 201) {
                $obj = json_decode($json_response);
            }

            curl_close($curl);
            $response = json_decode($json_response, true);
            break;

        case "mostrar":
            $url = "http://localhost:90/PERSONAL_CRUD_PROYECTO2_Alumno/controller/producto.php?op=GetId";
            $data = array(
                "id" => $_POST["id"]
            );
            $payload = json_encode($data);

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(
                $curl,
                CURLOPT_HTTPHEADER,
                array("Content-type: application/json")
            );
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
            $json_response = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ($status != 201) {
                $datos= json_decode($json_response);
            }

            curl_close($curl);
            $datos = json_decode($json_response, true);
            foreach ($datos as $row) {
                $output["id"] = $row["id"];
                $output["nombrep"] = $row["nombrep"];
                $output["descripcion"] = $row["descripcion"];
                $output["categoria"] = $row["categoria"];
                $output["precio"] = $row["precio"];
            }
            echo json_encode($output);
            break;

        case "eliminar":
            $url = "http://localhost:90/PERSONAL_CRUD_PROYECTO2_Alumno/controller/producto.php?op=Delete";
            $data = array(
                "id" => $_POST["id"]
            );
            $payload = json_encode($data);

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(
                $curl,
                CURLOPT_HTTPHEADER,
                array("Content-type: application/json")
            );
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
            $json_response = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ($status != 201) {
                $datos= json_decode($json_response);
            }

            curl_close($curl);
            $datos = json_decode($json_response, true);

            break;
    
        case "activar":
            $url = "http://localhost:90/PERSONAL_CRUD_PROYECTO2_Alumno/controller/producto.php?op=Activar";
            $data = array(
                "id" => $_POST["id"],
                "estado" => $_POST["estado"],
            );
            $payload = json_encode($data);

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(
                $curl,
                CURLOPT_HTTPHEADER,
                array("Content-type: application/json")
            );
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
            $json_response = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ($status != 201) {
                $datos= json_decode($json_response);
            }

            curl_close($curl);
            $datos = json_decode($json_response, true);

            break;
    
        case "buscarcategoria":
            $url = "http://localhost:90/PERSONAL_CRUD_PROYECTO2_Alumno/controller/producto.php?op=GetCategoria";
            $data = array(
                "categoria" => $_POST["categoria"]
            );
            $payload = json_encode($data);

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt(
                $curl,
                CURLOPT_HTTPHEADER,
                array("Content-type: application/json")
            );
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
            $json_response = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ($status != 201) {
                $datos= json_decode($json_response);
            }

            curl_close($curl);
            $datos = json_decode($json_response, true);

            $data=Array();
            foreach($datos as $row){
                $sub_array= array();
                $sub_array[] = $row["nombrep"];
                $sub_array[] = $row["descripcion"];
                $sub_array[] = $row["categoria"];
                $sub_array[] = $row["precio"];
                if($row["estado"] == '1'){
                    $sub_array[] = '<button class="btn btn-success btn-sm" onClick="desactivar(' . $row["id"] . ');"  id="' . $row["id"] . '">Activo</button>';
                }
                else{
                    $sub_array[] = '<button class="btn btn-warning btn-sm" onClick="activar(' . $row["id"] . ');"  id="' . $row["id"] . '">Desactivado</button>';
                }
                $sub_array[] = '<button class="btn btn-primary btn-sm" onClick="editar(' . $row["id"] . ');"  id="' . $row["id"] . '">Editar</button>';
                $sub_array[] = '<button class="btn btn-danger btn-sm" onClick="eliminar(' . $row["id"] . ');"  id="' . $row["id"] . '">Eliminar</button>';
                $data[]=$sub_array;
            }
            $results= array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

    }
?>
