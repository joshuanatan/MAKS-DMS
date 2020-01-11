<div class="page-header">
    <h1 class="page-title">MODULE CONNECTION</h1>
    <br/>
    <ol class="breadcrumb breadcrumb-arrow">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item active">Module Connection</li>
    </ol>
</div>
<br/>
<?php if($this->session->status_curl == "success"):?>
<div class = "alert alert-success alert-dismissible">
    <button type = "button" class = "close" data-dismiss = "alert">&times;</button>
    <?php echo $this->session->msg_curl;?>
</div>
<?php elseif($this->session->status_curl == "error"):?>
<div class = "alert alert-danger alert-dismissible">
    <button type = "button" class = "close" data-dismiss = "alert">&times;</button>
    <?php echo $this->session->msg_curl;?>
</div>
<?php endif;?>
<?php if($this->session->status_sync == "success"):?>
<div class = "alert alert-success alert-dismissible">
    <button type = "button" class = "close" data-dismiss = "alert">&times;</button>
    <?php echo $this->session->msg_sync;?>
</div>
<?php elseif($this->session->status_sync == "error"):?>
<div class = "alert alert-danger alert-dismissible">
    <button type = "button" class = "close" data-dismiss = "alert">&times;</button>
    <?php echo $this->session->msg_sync;?>
</div>
<?php endif;?>
<?php if($this->session->status_module == "success"):?>
<div class = "alert alert-success alert-dismissible">
    <button type = "button" class = "close" data-dismiss = "alert">&times;</button>
    <?php echo $this->session->msg_module;?>
</div>
<?php elseif($this->session->status_module == "error"):?>
<div class = "alert alert-danger alert-dismissible">
    <button type = "button" class = "close" data-dismiss = "alert">&times;</button>
    <?php echo $this->session->msg_module;?>
</div>
<?php endif;?>
<div class="page-body">
    <table class = "table table-striped table-hover table-bordered" id = "table_driver" data-plugin = "dataTable">
        <thead>
            <th style = "width:5%">#</th>
            <th>Module Name</th>
            <th>Module Token</th>
            <th>Module Id Log</th>
            <th>Module Doc URI</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php for($a = 0; $a<count($module); $a++):?>
            <tr>
                <td><?php echo $a+1;?></td>
                <td><?php echo $module[$a]["module_connection_name"];?></td>
                <td><?php echo $module[$a]["module_connection_token"];?></td>
                <td><?php echo $module[$a]["module_connection_log_id"];?></td>
                <td><?php echo $module[$a]["module_connection_uri"];?></td>
                <td>
                    <a href = "<?php echo base_url();?>module/activate/<?php echo $module[$a]["id_submit_module_connection"];?>" class = "btn btn-primary btn-sm col-lg-12">ACTIVATE</a>
                </td>
            </tr>
            <?php endfor;?>
        </tbody>
    </table>
    <a href = "<?php echo base_url();?>module" class = "btn btn-primary btn-sm">BACK</a>
</div>