<?php
require_once "person.php";
require_once "tool.php";
date_default_timezone_set('America/Chicago');

const TABLE= "tbl_tool_rotation";
    const COLUMNS = array(
            "id_tool_rotation",
            "id_person",
            "id_tool",
            "departure_time",
            "entry_time"
        );


class ToolRotation{
    
    private function to_insert_depure($id_person,$id_tool){
        $sql = "INSERT INTO ".TABLE."(
            ".COLUMNS[1].",
            ".COLUMNS[2]."
        )
         VALUES(
            ".$id_person.",
            ".$id_tool.")";

        return $sql;
    }

    private function seach_all(){
        $sql = "SELECT * FROM ".TABLE;
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
        $sql = "SELECT ".$columns." FROM ".TABLE;
        return $sql;
    }

    private function by_column_and_condition($condition,...$colms){
        $columns = "";
        foreach($colms as $col){
            $columns .= $col.","; 
        }
        $columns = substr_replace($columns,'', -1);
        $sql = "SELECT ".$columns." FROM ".TABLE." WHERE ".$condition;
        return $sql;
    }

    

    private function to_update_date_state($id_rotation){
        $datetime = new DateTime();
        $format = $datetime->format("y-m-d H:i:s");
        $update_set = COLUMNS[4]."='".$format."'";
        $where_set = COLUMNS[0]."=".$id_rotation;
        $sql = "UPDATE ".TABLE." SET ".$update_set." WHERE ".$where_set;
        return $sql;
    }

    private function to_delete($id_update){
        $condition = COLUMNS[0]."=".$id_update;
        $sql = "DELETE FROM ".TABLE." WHERE ".$condition;
        return $sql;
    }

    private function to_delete_condition($condition){
        $sql = "DELETE FROM ".TABLE." WHERE ".$condition;
        return $sql;
    }

    function insert($id_person,$id_tool){
        
        $sql = $this->to_insert_depure($id_person,$id_tool);
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
        print_r($result[0]["id_person"]);
        $db->close();
    }

    function update($id_rotation){
        $sql = $this->to_update_date_state($id_rotation);
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

    function new(){
        print(People::COLUMNS[0]);
        print(Tools::COLUMNS[0]);
    }


}

$change = new ToolRotation();
$change->new();



?>