<?php
    class EmpresaModels extends Conectar{
        /*TODO: Listar Empresa*/
        public function getEmpresa_x_companialId($idcompania) {
            $conectar = parent::Conexion();
            $sql = "call spListarEmpresa (?);";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idcompania);
            $query->execute(); 
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        /*TODO: Listar Empresa por Id*/
        public function getEmpresa_x_id($idempresa){
            $conectar = parent::Conexion();
            $sql = "call spListarEmpresaporId (?);";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idempresa);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        
        /*TODO: Eliminar Empresa*/
        public function eliminarEmpresa($idempresa){
            $conectar = parent::Conexion();
            $sql = "call spEliminarEmpresa (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idempresa);
            $query->execute();
        }        
        /*TODO: Insertar Empresa*/
        public function insertarEmpresa($idcompania, $nombreempresa,$rucempresa){
            $conectar = parent::Conexion();
            $sql = "call spRegistrarEmpresa (?,?,?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idcompania);
            $query->bindValue(2,$nombreempresa);
            $query->bindValue(3,$rucempresa);
            $query->execute();
        
        }        
        /*TODO:Actualizar Registro*/
        public function updateEmpresa($idempresa, $idcompania, $nombreempresa, $rucempresa){
            $conectar = parent::Conexion();
            $sql = "call spUpdateEmpresa (?,?,?,?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idempresa);
            $query->bindValue(2,$idcompania);
            $query->bindValue(3,$nombreempresa);
            $query->bindValue(4,$rucempresa);
            $query->execute();
        }        

    }

?>