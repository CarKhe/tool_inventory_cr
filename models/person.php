<?php
require_once "db_connection.php";

class People{
    const TABLE= "tbl_person";
    const COLUMNS = array(
            "id_person",
            "person",
            "id_permission"
        );

    private function to_insert($name,$permission){
        $sql = "INSERT INTO ".self::TABLE."(
            ".self::COLUMNS[1].",
            ".self::COLUMNS[2]."
        )
         VALUES(
            '".$name."',
            '".$permission."')";

        return $sql;
    }

    private function seach_all(){
        $sql = "SELECT * FROM ".self::TABLE;
        return $sql;
    }

    private function by_condition($condition){
        $sql = $this->seach_all();
        $sql = $sql." WHERE ".$condition;
        return $sql;
    }

    private function by_column(...$colms){
        $columns = "";
        foreach($colms as $col){
            $columns .= $col.","; 
        }
        $columns = substr_replace($columns,'', -1);
        $sql = "SELECT ".$columns." FROM ".self::TABLE;
        return $sql;
    }

    private function by_column_and_condition($condition,...$colms){
        $columns = "";
        foreach($colms as $col){
            $columns .= $col.","; 
        }
        $columns = substr_replace($columns,'', -1);
        $sql = "SELECT ".$columns." FROM ".self::TABLE." WHERE ".$condition;
        return $sql;
    }

    private function to_update($name,$permission,$id_update){
        $update_set = "";
        $values = array(
            $name,$permission);
        for($i=0;$i<=count($values)-1;$i++){
            $update_set .= self::COLUMNS[$i+1]."=";
            if (is_string($values[$i])){
                $update_set .= "'".$values[$i]."', ";
            }
            if (is_int($values[$i])){
                $update_set .= $values[$i].", ";
            } 
        }
        $update_set = substr_replace($update_set,'', -2);
        $id = self::COLUMNS[0]."=".$id_update;
        $sql = "UPDATE ".self::TABLE." SET ".$update_set." WHERE ".$id;
        return $sql;

    }

    private function to_delete($id_update){
        $condition = self::COLUMNS[0]."=".$id_update;
        $sql = "DELETE FROM ".self::TABLE." WHERE ".$condition;
        return $sql;
    }

    private function to_delete_condition($condition){
        $sql = "DELETE FROM ".self::TABLE." WHERE ".$condition;
        return $sql;
    }

    function insert($name,$permission){ 
        $sql = $this->to_insert($name,$permission);
        $db = new DbConnection();
        $result = $db->executeInstruction($sql);
        print($result);
        $db->close();
    }

    function search($type,$cond = false,...$colmns){
        switch($type){
            case 1:
                $sql = $this->seach_all();
                break;
            case 2:
                $sql = $this->by_condition($cond);
                break;
            case 3:
                $sql = $this->by_column(...$colmns);
                break;
            case 4:
                $sql = $this->by_column_and_condition($cond,...$colmns);
                break;
            default:
                return null;
        }
        $db = new DbConnection();
        $result = $db->executeQuery($sql);
        print_r($result);
        $db->close();
    }

    function update($name,$permission,$id_update){
        $sql = $this->to_update($name,$permission,$id_update);
        $db = new DbConnection();
        $result = $db->executeInstruction($sql);
        print($result);
        $db->close();
    }

    function delete($type,$cond = false,$to_delete=false){
        switch($type){
            case 1:
                $sql = $sql = $this->to_delete($to_delete);
                break;
            case 2:
                $sql = $this->to_delete_condition($cond);
                break;
            default:
                return null;
        }
        
        $db = new DbConnection();
        $result = $db->executeInstruction($sql);
        print($result);
        $db->close();
    }
}




?>