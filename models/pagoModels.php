<?php

    class PagoModels extends Conectar{
        /*TODO: Listar Categoria por Estado*/
        public function getPago_x_estado() {
            $conectar = parent::Conexion();
            $sql = "call spListarPago";
            $query = $conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        
    }
?>