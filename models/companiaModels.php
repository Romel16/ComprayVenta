<?php

    class CompaniaModels extends Conectar{
        /*TODO: Listar Compania*/
        public function getCompania_x_sucursalId() {
            $conectar = parent::Conexion();
            $sql = "spListarCompania";
            $query = $conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        /*TODO: Listar Compania por Id*/
        public function getCompania_x_id($idcompania){
            $conectar = parent::Conexion();
            $sql = "spListarCompaniaporId ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idcompania);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        
        /*TODO: Eliminar Compania*/
        public function eliminarCompania($idcompania){
            $conectar = parent::Conexion();
            $sql = "spEliminarCompania ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idcompania);
            $query->execute();
        }        
        /*TODO: Insertar Compania*/
        public function insertarCompania($nombrecompania){
            $conectar = parent::Conexion();
            $sql = "spRegistrarCompania ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$nombrecompania);
            $query->execute();
        
        }        
        /*TODO:Actualizar Registro*/
        public function updateCompania($idcompania, $nombrecompania){
            $conectar = parent::Conexion();
            $sql = "spUpdateCompania ?,?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idcompania);
            $query->bindValue(2,$nombrecompania);
            $query->execute();
        }        

    }

?>