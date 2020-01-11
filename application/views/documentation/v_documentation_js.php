<script>
function loadUserAuthentication(id_submit_endpoint_documentation){
    $("#endpointToken").val(id_submit_endpoint_documentation);
    $.ajax({
        url:"<?php echo base_url();?>interface/endpoint/get_registered_client",
        type:"POST",
        dataType:"JSON",
        data:{id_submit_endpoint_documentation:id_submit_endpoint_documentation},
        success:function(respond){
            var html = "";
            for(var a = 0; a<respond.length; a++){
                html += "<tr><td>"+(a+1)+"</td><td>"+respond[a]["nama_client"]+"</td><td>"+respond[a]["token"]+"</td><td><a href = '<?php echo base_url();?>documentation/remove_user/"+respond[a]["id_submit_endpoint_auth"]+"' class = 'btn btn-danger btn-sm col-lg-12'>REMOVE</a></td></tr>"
            }
            $("#userAuthContainer").html(html);
        } 
    });
}
</script>