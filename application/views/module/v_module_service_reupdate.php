<div class="page-header">
    <h1 class="page-title">MODULE SERVICES/ENDPOINTS</h1>
    <br/>
    <ol class="breadcrumb breadcrumb-arrow">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Module Connection</a></li>
        <li class="breadcrumb-item active">Module Services/Endpoints</li>
    </ol>
</div>
<br/>
<?php if($this->session->status_service == "success"):?>
<div class = "alert alert-success alert-dismissible">
    <button type = "button" class = "close" data-dismiss = "alert">&times;</button>
    <?php echo $this->session->msg_service;?>
</div>
<?php elseif($this->session->status_service == "error"):?>
<div class = "alert alert-danger alert-dismissible">
    <button type = "button" class = "close" data-dismiss = "alert">&times;</button>
    <?php echo $this->session->msg_service;?>
</div>
<?php endif;?>
<div class="page-body">
    <form action = "<?php echo base_url();?>module/update_service" method = "POST">
        <input type = "hidden" name = "id_submit_module_connection_service" value = "<?php echo set_value("id_submit_module_connection_service");?>">
        <div class = "form-group">
            <h5>Service Endpoint</h5>
            <input type = "text" class = "form-control" value = "<?php echo set_value("service_name");?>" name = "service_name">
        </div>
        <div class = "form-group">
            <h5>Service URL</h5>
            <input type = "text" class = "form-control" value = "<?php echo set_value("service_url");?>" name = "service_url">
        </div>
        <div class = "form-group">
            <h5>Service Method</h5>
            <input type = "text" class = "form-control" value = "<?php echo set_value("service_method");?>" name = "service_method">
        </div>
        <div class = "form-group">
            <h5>Service Input</h5>
            <input type = "text" class = "form-control" value = "<?php echo set_value("service_input");?>" name = "service_input">
        </div>
        <div class = "form-group">
            <h5>Service Output</h5>
            <input type = "text" class = "form-control" value = "<?php echo set_value("service_output");?>" name = "service_output">
        </div>
        <button type = "submit" class = "btn btn-primary btn-sm">SUBMIT</button>
        <a href = "<?php echo base_url();?>module/services/<?php echo $this->session->id_module;?>" class = "btn btn-primary btn-sm">BACK</a>
    </form>
</div>