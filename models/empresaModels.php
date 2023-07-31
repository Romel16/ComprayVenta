<?php

    class EmpresaModels extends Conectar{
        /*TODO: Listar Empresa*/
        public function getEmpresa_x_sucursalId($idcompania) {
            $conectar = parent::Conexion();
            $sql = "spListarEmpresa ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idcompania);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        /*TODO: Listar Empresa por Id*/
        public function getEmpresa_x_id($idempresa){
            $conectar = parent::Conexion();
            $sql = "spListarEmpresaporId ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idempresa);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        
        /*TODO: Eliminar Empresa*/
        public function eliminarEmpresa($idempresa){
            $conectar = parent::Conexion();
            $sql = "spEliminarEmpresa ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idempresa);
            $query->execute();
        }        
        /*TODO: Insertar Empresa*/
        public function insertarEmpresa($idcompania, $nombreempresa,$rucempresa){
            $conectar = parent::Conexion();
            $sql = "spRegistrarEmpresa ?,?,?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idcompania);
            $query->bindValue(2,$nombreempresa);
            $query->bindValue(3,$rucempresa);
            $query->execute();
        
        }        
        /*TODO:Actualizar Registro*/
        public function updateEmpresa($idempresa, $idcompania, $nombreempresa, $rucempresa){
            $conectar = parent::Conexion();
            $sql = "spUpdateEmpresa ?,?,?,?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idempresa);
            $query->bindValue(2,$idcompania);
            $query->bindValue(3,$nombreempresa);
            $query->bindValue(4,$nombreempresa);
            $query->execute();
        }        

    }

?>