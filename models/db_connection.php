<?php 

class DbConnection{
    private $host = "localhost";
    private $db="db_tools_inventory";
    private $user="root";
    private $pass="";
    private $connection;


    function __construct(){
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::MYSQL_ATTR_FOUND_ROWS => true
        );

        $this->connection = new PDO(
            'mysql:host='.$this->host.';
            dbname='.$this->db,
            $this->user,$this->pass,
            $options
        );
    }

    function executeQuery($sql){
        $result = $this->connection->query($sql);
        $error = $this->connection->errorInfo();
        if($error[0] === "00000"){
            $result->execute();
            $lists = $result->fetchAll(PDO::FETCH_ASSOC);
            return $lists;
        } else{
            throw new Exception($error[2]);
        }
       
    }

    function numRows($sql){
        $data = array();
        $result = $this->connection->query($sql);
        $error = $this->connection->errorInfo();
        if($error[0] === "00000"){
            $result->execute();
            return $result->rowCount();
        } else{
            throw new Exception($error[2]);
        }

    }

    function getDataSingle($sql){
        $result = $this->connection->query($sql);
        $error = $this->connection->errorInfo();
        if($error[0] === "00000"){
            $result->execute();
            $lists = $result->fetchAll(PDO::FETCH_ASSOC);
            return $lists;
        } else{
            throw new Exception($error[2]);
        }
        
    }

    function executeInstruction($sql){
        $result = $this->connection->prepare($sql);
        $error = $this->connection->errorInfo();
        if($error[0] === "00000"){
            $result->execute();
            return $result->rowCount() > 0;
            
        } else{
            throw new Exception($error[2]);
        }
    }

    function getLastId(){
        $this->connection->lastInsertId();
    }

    function close(){
        $this->connection = null;
    }
}







?>