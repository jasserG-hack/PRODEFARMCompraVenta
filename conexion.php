<?php
class Conectar{
    protected $dbh;
    protected function Conexio(){
        try{
            $conectar = $this->dbh=new PDO("sqlsrv:Server=localhost;Database=CompraVenta","sa","123456");
            return $conectar;
        }catch(Exception $e){
            print "Error Conexion BD". $e->getMessage() ."<br/>";
            die();
        }
    }

}

?>