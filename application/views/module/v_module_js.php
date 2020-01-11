<script>
function loadModuleService(){
    var id_module = $("#module").val();
    $.ajax({
        url:"<?php echo base_url();?>interface/module/load_module_services",
        type:"POST",
        dataType:"JSON",
        data:{
            id_module:id_module
        },
        success:function(respond){
            var html = "<option value = 0 selected disabled>Choose Services</option>";
            for(var a = 0; a<respond.length; a++){
                html += "<option value = '"+respond[a]["id_submit_module_connection_service"]+"'>"+respond[a]["service_name"]+"</option>";
            }
            $("#service").html(html);
            if(respond.length > 0){
                $("#sync_button").css("display","block");
            }
            else{
                $("#sync_button").css("display","none");
            }
        }
    });
}
</script>
<script>
function buildLink(){
    var modules = $("#module").val();
    var service = $("#service").val();

    $.ajax({
        url:"<?php echo base_url();?>interface/module/get_detail_module",
        type:"POST",
        dataType:"JSON",
        data:{modules:modules},
        success:function(respond){
            $.ajax({
                url:"<?php echo base_url();?>interface/module/get_detail_service",
                type:"POST",
                dataType:"JSON",
                data:{service:service},
                success:function(respond2){
                    var link = "<?php echo base_url();?>"+"sync/"+respond[0]["module_connection_log_id"]+"/"+respond2[0]["service_name"];
                    $("#sync_button").attr("href",link);
                } 
            });
        } 
    });
    
}
</script>