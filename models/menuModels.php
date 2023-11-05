<?php

    class MenuModels extends Conectar{
        /*TODO: Listar Categoria*/
        public function getmenu_x_rolId($idrol) {
            $conectar = parent::Conexion();
            $sql = "call spListarMenu (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idrol);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        public function update_menu_habilitar($detallemenudId) {
            $conectar = parent::Conexion(); 
            $sql = "call spUpdateMenuSi (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$detallemenudId);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        public function update_menu_deshabilitar($detallemenudId) {
            $conectar = parent::Conexion();
            $sql = "call spUpdateMenuNo (?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$detallemenudId);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
       
    }

?>