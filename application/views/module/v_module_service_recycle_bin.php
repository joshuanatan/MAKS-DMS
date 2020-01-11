<div class="page-header">
    <h1 class="page-title">MODULE SERVICES/ENDPOINTS <i><?php echo strtoupper($module_detail[0]["module_connection_name"]);?></i></h1>
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
    RECYCLE BIN
    <table class = "table table-striped table-hover table-bordered" id = "table_driver" data-plugin = "dataTable" style = "table-layout:fixed">
        <thead>
            <th style = "width:5%">#</th>
            <th>Service Endpoint</th>
            <th>Service URL</th>
            <th>Service Method</th>
            <th>Service Input</th>
            <th>Service Output</th>
            <th>Status Module Service</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php for($a = 0; $a<count($services); $a++):?>
            <tr>
                <td style = "overflow-wrap:break-word"><?php echo $a+1;?></td>
                <td style = "overflow-wrap:break-word"><?php echo $services[$a]["service_name"];?></td>
                <td style = "overflow-wrap:break-word"><?php echo $services[$a]["service_url"];?></td>
                <td style = "overflow-wrap:break-word"><?php echo $services[$a]["service_method"];?></td>
                <td style = "overflow-wrap:break-word"><?php echo $services[$a]["service_input"];?></td>
                <td style = "overflow-wrap:break-word"><?php echo $services[$a]["service_output"];?></td>
                <td style = "overflow-wrap:break-word">
                    <?php if($services[$a]["status_aktif_service"] == 1):?>
                    <button type = "button" class = "btn btn-primary btn-sm col-lg-12">IN USE</button>
                    <?php else:?>
                    <button type = "button" class = "btn btn-danger btn-sm col-lg-12">NOT IN USE</button>
                    <?php endif;?>
                </td>
                <td style = "overflow-wrap:break-word">
                    
                    <a href = "<?php echo base_url();?>module/activate_service/<?php echo $services[$a]["id_submit_module_connection_service"];?>" class = "btn btn-light btn-sm col-lg-12">ACTIVATE SERVICE</a>
                </td>
            </tr>
            <?php endfor;?>
        </tbody>
    </table>
    <a href = "<?php echo base_url();?>module/services/<?php echo $this->session->id_module;?>" class = "btn btn-primary btn-sm">BACK</a>
</div>