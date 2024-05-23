<?php
require_once "person.php";
require_once "tool.php";
date_default_timezone_set('America/Chicago');

class ToolRotation{
    const TABLE= "tbl_tool_rotation";
    const COLUMNS = array(
            "id_tool_rotation",
            "id_person",
            "id_tool",
            "departure_time",
            "entry_time"
        );

    private function to_insert_tool_move($tool_id,$employee,$tool_inventory){
        $sql = "INSERT INTO ".self::TABLE."(
            ".self::COLUMNS[1].",
            ".self::COLUMNS[2]."
        )
         VALUES(
            ".$employee.",
            ".$tool_id.")";
        
        $tool = new Tools();
        $tool_status = $tool->update_status_in_inventory($tool_inventory,
            $tool_id);
        $db = new DbConnection();
        $insert_new_rotation = $db->executeInstruction($sql);
        $update_tool_status = $db->executeInstruction($tool_status);
        $db->close();

    }

    private function to_update_tool_move($tool_id,$employee,$tool_inventory){
        $sql = "SELECT ".self::COLUMNS[0]." FROM ".self::TABLE." 
            WHERE ".self::COLUMNS[1]." = ".$employee." and ".self::COLUMNS[2]."
            =".$tool_id." and ".self::COLUMNS[4]." is null";
        
        $datetime = new DateTime();
        $format = $datetime->format("y-m-d H:i:s");
        
        $db = new DbConnection();
        $id_tool_rotation = $db->executeQuery($sql);
        $id_rotation_id = $id_tool_rotation[0][self::COLUMNS[0]];

        $sql_update = "UPDATE ".self::TABLE." SET ".self::COLUMNS[4]."=
            '".$format."' WHERE ".self::COLUMNS[0]."=".$id_rotation_id;

        $tool = new Tools();
        $tool_status = $tool->update_status_in_inventory($tool_inventory,
                $tool_id);
        $update_tool_rotation_status = $db->executeInstruction($sql_update);
        $update_tool_status = $db->executeInstruction($tool_status);
        $db->close();

    }

    private function in_or_out_tool($scan){
        switch($scan){
            case $scan == "IN":
                return 1;
            case $scan == "OUT":
                return 0;
            default:
                return null;
        }
    }

    private function tool_scan($tool_id){
        $tool = new Tools();
        $result = $tool->is_tool_in_inventory($tool_id);
        if ($result == null){
            return null;
        }
        return $result;
    }

    private function check_to_continue($in_out,$tool_inventory){
        if($in_out == $tool_inventory){
            return false;
        } 
        return true;

    }


    function main($scan,$tool_id,$employee){
        $in_out = $this->in_or_out_tool($scan);
        $tool_inventory = $this->tool_scan($tool_id);
        $check_inventory = $this->check_to_continue($in_out,$tool_inventory);
        if($check_inventory){
            if($in_out == 0){
                $this->to_insert_tool_move($tool_id,$employee
                    ,$tool_inventory);
            } else{
                $this->to_update_tool_move($tool_id,$employee
                    ,$tool_inventory);
            }
            
        } else{
            return null;
        }
        
    }
}



?>