<div class="page-header">
    <h1 class="page-title">Endpoint</h1>
    <br/>
    <ol class="breadcrumb breadcrumb-arrow">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Endpoint</a></li>
        <li class="breadcrumb-item active">Reinsert</li>
    </ol>
</div>
<h5>Notes</h5> <p>This section is just to maintain the <strong>ENDPOINT DOCUMENTATION</strong> and <strong>ACCESS AUTHENTICATION</strong>.<br/> It <strong>DOES NOT</strong> affect the endpoint source code. Suppose you make changes on the endpoint source code, you can update the changes here therefore it will be easier to monitor</p>
<br/>
<div class = "alert alert-danger">
    <button type = "button" class = "close" data-dismiss = "alert">&times;</button>
    <?php echo validation_errors();?>
</div>
<div class="page-body">
    <form action = "<?php echo base_url();?>documentation/insert" method = "POST">
        <div class = "form-group">
            <h5>Endpoint Function</h5>
            <input type = "text" class = "form-control" value = "<?php echo set_value("endpoint_name");?>" name = "endpoint_name">
        </div>
        <div class = "form-group">
            <h5>Endpoint Method</h5>
            <input type = "text" class = "form-control" value = "<?php echo set_value("endpoint_http_method");?>" name = "endpoint_http_method">
        </div>
        <div class = "form-group">
            <h5>Endpoint URL</h5>
            <input type = "text" class = "form-control" value = "<?php echo set_value("endpoint_url");?>" name = "endpoint_url">
        </div>
        <div class = "form-group">
            <h5>Input</h5>
            <input type = "text" class = "form-control" value = "<?php echo set_value("endpoint_input");?>" name = "endpoint_input">
        </div>
        <div class = "form-group">
            <h5>Output</h5>
            <input type = "text" class = "form-control" value = "<?php echo set_value("endpoint_output");?>" name = "endpoint_output">
        </div>
        <div class = "form-group">
            <h5>Token</h5>
            <input type = "text" class = "form-control" value = "<?php echo set_value("endpoint_token");?>" readonly name = "endpoint_token">
        </div>
        <button type = "submit" class = "btn btn-primary btn-sm">SUBMIT</button>
    </form>
</div>