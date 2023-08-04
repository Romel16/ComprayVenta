<?php

class Conectar{
    protected $dbh;

    protected function Conexion(){
        try {
            $conectar = $this->dbh=new PDO("mysql:host=localhost;dbname=comprayventa","root","");
            //$conectar =$this->dbh= new PDO("mysql:host=localhost;dbname=comprayventa","root","",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            return $conectar;

        }
        catch (PDOException $e) {
            echo 'Falló la conexión:'.$e->getMessage();
            die();
        }

    }
}