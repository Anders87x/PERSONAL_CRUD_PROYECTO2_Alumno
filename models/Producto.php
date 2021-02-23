<?php
    class Producto extends Conectar{
        public function get_producto(){
            $conectar= parent::conexion();
            parent::set_names();
                $sql="CALL sp_listar_productos";
                //$sql="SELECT * FROM productos WHERE estado = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_producto_x_id($id){
            $conectar= parent::conexion();
            parent::set_names();
                //$sql="SELECT * FROM productos WHERE estado=1 AND id= ?";
                $sql="CALL sp_listar_ProductoID(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_producto_x_cat($categoria){
            $conectar= parent::conexion();
            parent::set_names();
                //$sql="SELECT * FROM productos WHERE estado=1 AND categoria = ?";
                $sql="CALL sp_listar_CategoriaNombreProductos(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $categoria);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_producto($nombrep,$descripcion,$categoria,$precio){
            $conectar= parent::conexion();
            parent::set_names();
                //$sql="INSERT INTO productos(id,nombrep,descripcion,categoria,precio,estado) VALUES (NULL,?,?,?,?,'1');";
                $sql="CALL sp_insertar_Productos(?,?,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $nombrep);
            $sql->bindValue(2, $descripcion);
            $sql->bindValue(3, $categoria);
            $sql->bindValue(4, $precio);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_producto($id,$nombrep,$descripcion,$categoria,$precio,$estado){
            $conectar= parent::conexion();
            parent::set_names();
                $sql="CALL sp_actualizar_Producto(?,?,?,?,?,?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $nombrep);
            $sql->bindValue(2, $descripcion);
            $sql->bindValue(3, $categoria);
            $sql->bindValue(4, $precio);
            $sql->bindValue(5, $estado);
            $sql->bindValue(6, $id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function delete_producto($id){
            $conectar= parent::conexion();
            parent::set_names();
                $sql="CALL sp_eliminar_Producto(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function activar_producto($id,$estado){
            $conectar= parent::conexion();
            parent::set_names();
                $sql="CALL sp_actualizar_estadoProducto(?,?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $estado);
            $sql->bindValue(2, $id);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>

