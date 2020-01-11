<div class="page-header">
    <h1 class="page-title">Endpoint</h1>
    <br/>
    <ol class="breadcrumb breadcrumb-arrow">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item active">Endpoint</li>
    </ol>
</div>
<h5>Notes</h5> <p>This section is just to maintain the <strong>ENDPOINT DOCUMENTATION</strong> and <strong>ACCESS AUTHENTICATION</strong>.<br/> It <strong>DOES NOT</strong> affect the endpoint source code. Suppose you make changes on the endpoint source code, you can update the changes here therefore it will be easier to monitor</p>
<br/>
<?php if($this->session->status == "success"):?>
<div class = "alert alert-success">
    <button type = "button" class = "close" data-dismiss = "alert">&times;</button>
    <?php echo $this->session->msg;?>
</div>
<?php elseif($this->session->status == "error"):?>
<div class = "alert alert-danger">
    <button type = "button" class = "close" data-dismiss = "alert">&times;</button>
    <?php echo $this->session->msg;?>
</div>
<?php endif;?>
<div class="page-body">
    <table class = "table table-striped table-hover table-bordered" id = "table_driver" data-plugin = "dataTable">
        <thead>
            <th style = "width:5%">#</th>
            <th>Endpoint Function</th>
            <th>Endpoint Method</th>
            <th>Endpoint URL</th>
            <th>Input</th>
            <th>Output</th>
            <th>Token</th>
            <th style = "width:5%">Action</th>
        </thead>
        <tbody>
            <?php for($a = 0; $a<count($endpoint); $a++):?>
            <tr>
                <td><?php echo $a+1;?></td>
                <td><?php echo $endpoint[$a]["endpoint_name"];?></td>
                <td><?php echo $endpoint[$a]["endpoint_http_method"];?></td>
                <td><?php echo $endpoint[$a]["endpoint_uri"];?></td>
                <td><?php echo $endpoint[$a]["endpoint_input"];?></td>
                <td><?php echo $endpoint[$a]["endpoint_output"];?></td>
                <td><?php echo $endpoint[$a]["endpoint_token"];?></td>
                <td>
                    <a href = "<?php echo base_url();?>documentation/activate/<?php echo $endpoint[$a]["id_submit_endpoint_documentation"];?>" class = "btn btn-primary btn-sm col-lg-12">ACTIVATE</a> 
                </td>
            </tr>
            <?php endfor;?>
        </tbody>
    </table>
    <a href = "<?php echo base_url();?>documentation" class = "btn btn-primary btn-sm">BACK</a>
</div>