<?php

    class ClienteModels extends Conectar{
        /*TODO: Listar Cliente*/
        public function getCliente_x_empresaId($idempresa) {
            $conectar = parent::Conexion();
            $sql = "spListarCliente ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idempresa);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        /*TODO: Listar Cliente por Id*/
        public function getCliente_x_id($idcliente){
            $conectar = parent::Conexion();
            $sql = "spListarClienteporId ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idcliente);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        
        /*TODO: Eliminar Cliente*/
        public function eliminarCliente($idcliente){
            $conectar = parent::Conexion();
            $sql = "spEliminarCliente ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idcliente);
            $query->execute();
        }        
        /*TODO: Insertar Cliente*/
        public function insertarCliente($idempresa, $nombrecliente, $ruccliente, $telefonocliente,$direccioncliente,$correocliente){
            $conectar = parent::Conexion();
            $sql = "spRegistrarCliente ?,?,?,?,?,?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idempresa);
            $query->bindValue(2,$nombrecliente);
            $query->bindValue(3,$ruccliente);
            $query->bindValue(4,$telefonocliente);
            $query->bindValue(5,$direccioncliente);
            $query->bindValue(6,$correocliente);
            $query->execute();
            
        }        
        /*TODO:Actualizar Registro*/
        public function updateCliente($idcliente, $idempresa, $nombrecliente, $ruccliente, $telefonocliente,$direccioncliente,$correocliente){
            $conectar = parent::Conexion();
            $sql = "spUpdateCliente ?,?,?,?,?,?,?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idcliente);
            $query->bindValue(2,$idempresa);
            $query->bindValue(3,$nombrecliente);
            $query->bindValue(4,$ruccliente);
            $query->bindValue(5,$telefonocliente);
            $query->bindValue(6,$direccioncliente);
            $query->bindValue(7,$correocliente);
            $query->execute();
        }        

    }

?>