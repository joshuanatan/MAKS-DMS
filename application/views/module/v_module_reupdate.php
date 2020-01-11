<div class="page-header">
    <h1 class="page-title">MODULE CONNETION</h1>
    <br/>
    <ol class="breadcrumb breadcrumb-arrow">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item active">Module Connection</li>
    </ol>
</div>
<br/>
<div class = "alert alert-danger alert-dismissible">
    <button type = "button" class = "close" data-dismiss = "alert">&times;</button>
    <?php echo validation_errors();?>
</div>
<div class="page-body">
    <form action = "<?php echo base_url();?>module/update" method = "POST">
        <input type = 'hidden' readonly name = "id_submit_module_connection" value = "<?php echo set_value("id_submit_module_connection");?>">
        <div class = "form-group">
            <h5>Module Name</h5>
            <input type = "text" class = "form-control" value = "<?php echo set_value("module_connection_name");?>" name = "module_connection_name">
        </div>
        <div class = "form-group">
            <h5>Module Token</h5>
            <input type = "text" class = "form-control" value = "<?php echo set_value("module_connection_token");?>" name = "module_connection_token">
        </div>
        <div class = "form-group">
            <h5>Module Id</h5>
            <input type = "text" class = "form-control" value = "<?php echo set_value("module_connection_log_id");?>" name = "module_connection_log_id">
        </div>
        <div class = "form-group">
            <h5>Module Base URI</h5>
            <input type = "text" class = "form-control" value = "<?php echo set_value("module_connection_uri");?>" name = "module_connection_uri">
        </div>
        <button type = "submit" class = "btn btn-primary btn-sm">SUBMIT</button>
    </form>
</div>