<?php
    class Clientes extends Conectar{
        public function get_cliente(){
            $conectar= parent::conexion();
            parent::set_names();
            //$sql="SELECT * FROM clientes WHERE estado = 1";
            $sql="CALL spc_listar_Clientes";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
    

    public function get_cliente_x_id($id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="CALL spc_listar_ApellidosClienteID(?)";
        //$sql="CALL sp_obtener_regProductoID('?')";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $id);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
     }

    public function get_cliente_x_ape($apellidos){
        $conectar= parent::conexion();
        parent::set_names();
        //$sql="SELECT * FROM productos WHERE estado=1 AND categoria = ?";
        $sql="CALL spc_listar_ClienteApellidos(?)";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $apellidos);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }



    public function insert_cliente($nombres,$apellidos,$email,$celular,$direccion){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="CALL spc_insertar_Clientes(?,?,?,?,?)";
        //$sql="CALL sp_insertar_datos('$nombrep','$apellidos','$email',$celular')";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $nombres);
        $sql->bindValue(2, $apellidos);
        $sql->bindValue(3, $email);
        $sql->bindValue(4, $celular);
        $sql->bindValue(5, $direccion);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    //////////////////revisar al actualizar el estado no se pone en 0 pero si en actualiza a 1////////
    public function update_cliente($id,$nombres,$apellidos,$email,$celular,$direccion,$estado){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="CALL spc_actualizar_Cliente(?,?,?,?,?,?,?)";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $nombres);
        $sql->bindValue(2, $apellidos);
        $sql->bindValue(3, $email);
        $sql->bindValue(4, $celular);
        $sql->bindValue(5, $direccion);
        $sql->bindValue(6, $estado);
        $sql->bindValue(7, $id);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete_cliente($id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="CALL spc_eliminar_Cliente(?)";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $id);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }
////////////////////////// el estado no se pone en 0 en la bd se pone vacia pero si en actualiza a 1////////
    public function activar_cliente($id,$estado){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="CALL spc_actualizar_estadoCliente(?,?)";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $estado);
        $sql->bindValue(2, $id);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }


    }
?>

