<?php

    class DocumentoModels extends Conectar{
        /*TODO: Listar Categoria por Estado*/
            public function getDocumento($tipodocumento) {
            $conectar = parent::Conexion();
            $sql = "call spListarDocumento(?)";
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $tipodocumento);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }        
    }
?>