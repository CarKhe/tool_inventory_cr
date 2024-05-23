$(document).ready(function () {

    inOutCheck();

    $("#btn_safe").click(function (e) { 
        location.reload();
        
    });
      
    function inOutCheck(){
        $("#in_out_check").show();
        $("#txt_in_out").focus();
        $("#tool_check").hide();
        $("#employee_check").hide();
        $("#txt_in_out").keypress(function(e) {
            if(e.which == 13) {
                toolCheck();
                
                }
        });
    }

    

    function toolCheck(){
        $("#in_out_check").hide();
        $("#tool_check").show();
        $("#txt_tool").focus();
        $("#txt_tool").keypress(function(e) {
            if(e.which == 13) {
                employeeCheck();
                
                }
        });
    }
    
    function employeeCheck(){
        $("#tool_check").hide();
        $("#employee_check").show();
        $("#txt_employee").focus();
        $("#txt_employee").keypress(function(e) {
            if(e.which == 13) {
                toDataBase();
                
            }
            
        });
    }

    


    function getAllValues(){
        var data = new FormData();
        var inOut = $("#txt_in_out").val();
        var id_tool = $("#txt_tool").val();
        var id_employee = $("#txt_employee").val();
        data.append("inOut",inOut);
        data.append("id_tool",id_tool);
        data.append("id_employee",id_employee);

        return data;

    } 


    function toDataBase(){
        data = getAllValues();
        url = "../controller/insert_tool_rotation.php";
        $.ajax({
            type: "post",
            url: url,
            data: data,
            processData:false,
            contentType:false,
            success: function () {
                alert("Change");
                //location.reload();
            }
        });
    }
    
    
});