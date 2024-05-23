<?php

require_once "../models/tool_rotation.php";

@$inOut=$_POST['inOut'];
@$id_tool=$_POST['id_tool'];
@$id_employee=$_POST['id_employee'];

$toolrotation = new ToolRotation();
$result = $toolrotation->main($inOut,$id_tool,$id_employee);
print($result);





?>