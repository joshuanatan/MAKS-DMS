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
    <button type = "button" data-toggle = "modal" data-target = "#tambahQueryBuilder" class = "btn btn-primary btn-sm">+ ADD MODULE CONNECTION</button>
    <button type = "button" data-toggle = "modal" data-target = "#syncModule" class = "btn btn-dark btn-sm">SYNCHRONIZE MODULE</button>
    <a target = "_blank" href = "<?php echo base_url();?>module/module_log" class = "btn btn-dark btn-sm">MODULE LOG</a>
    <a href = "<?php echo base_url();?>module/recycle_bin" class = "btn btn-light btn-sm"><i class = "icon wb-trash"></i></a>
    <br/><br/>
    <div class = "col-lg-12">
        <table class = "table table-striped table-hover table-bordered" id = "table_driver" data-plugin = "dataTable" style = "table-layout: fixed">
            <thead>
                <th style = "width:5%">#</th>
                <th>Module Name</th>
                <th>Module Token</th>
                <th>Module Id Log</th>
                <th>Module Doc URI</th>
                <th>Status Connection</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php for($a = 0; $a<count($module); $a++):?>
                <tr>
                    <td><?php echo $a+1;?></td>
                    <td style = "overflow-wrap:break-word"><?php echo $module[$a]["module_connection_name"];?></td>
                    <td style = "overflow-wrap:break-word"><?php echo $module[$a]["module_connection_token"];?></td>
                    <td style = "overflow-wrap:break-word"><?php echo $module[$a]["module_connection_log_id"];?></td>
                    <td style = "overflow-wrap:break-word"><?php echo $module[$a]["module_connection_uri"];?></td>
                    <td style = "overflow-wrap:break-word">
                        <?php if($module[$a]["status_aktif_module_connection"] == 1):?>
                        <button type = "button" class = "btn btn-primary btn-sm col-lg-12">IN USE</button>
                        <?php else:?>
                        <button type = "button" class = "btn btn-danger btn-sm col-lg-12">NOT IN USE</button>
                        <?php endif;?>
                    </td>
                    <td style = "overflow-wrap:break-word">
                        <?php if($module[$a]["status_aktif_module_connection"] == 1):?>
                        <a href = "<?php echo base_url();?>module/deactive/<?php echo $module[$a]["id_submit_module_connection"];?>" class = "btn btn-danger btn-sm col-lg-12">DEACTIVE</a>
                        <?php elseif($module[$a]["status_aktif_module_connection"] == 0):?>
                        <a href = "<?php echo base_url();?>module/activate/<?php echo $module[$a]["id_submit_module_connection"];?>" class = "btn btn-light btn-sm col-lg-12">ACTIVATE</a>
                        <?php endif;?>
                        <a href = "<?php echo base_url();?>module/delete/<?php echo $module[$a]["id_submit_module_connection"];?>" class = "btn btn-dark btn-sm col-lg-12">DELETE</a>
                        <button type = "button" data-toggle = "modal" data-target = "#editQueryBuilder<?php echo $a;?>" class = "btn btn-primary btn-sm col-lg-12">EDIT CONNECTION</button>
                        <a href = "<?php echo base_url();?>module/services/<?php echo $module[$a]["id_submit_module_connection"];?>" class = "btn btn-light btn-sm col-lg-12">MODULE SERVICES</a>
                    </td>
                </tr>
                <?php endfor;?>
            </tbody>
        </table>
    </div>
</div>
<div class = "modal fade" id = "tambahQueryBuilder">
    <div class = "modal-dialog modal-center">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4>Add Module Connection</h4>
            </div>
            <div class = "modal-body">
                <form action = "<?php echo base_url();?>module/insert" method = "POST">
                    <div class = "form-group">
                        <h5>Module Name</h5>
                        <input type = "text" class = "form-control" name = "module_connection_name">
                    </div>
                    <div class = "form-group">
                        <h5>Module Token</h5>
                        <input type = "text" class = "form-control" name = "module_connection_token">
                    </div>
                    <div class = "form-group">
                        <h5>Module Id</h5>
                        <input type = "text" class = "form-control" name = "module_connection_log_id">
                    </div>
                    <div class = "form-group">
                        <h5>Module Service Documentation URI</h5>
                        <input type = "text" class = "form-control" name = "module_connection_uri">
                    </div>
                    <button type = "submit" class = "btn btn-primary btn-sm">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php for($a = 0; $a<count($module); $a++):?>
<div class = "modal fade" id = "editQueryBuilder<?php echo $a;?>">
    <div class = "modal-dialog modal-center">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4>Edit Module Connection</h4>
            </div>
            <div class = "modal-body">
                <form action = "<?php echo base_url();?>module/update" method = "POST"> 
                    <input type = 'hidden' readonly name = "id_submit_module_connection" value = "<?php echo $module[$a]["id_submit_module_connection"];?>">
                    <div class = "form-group">
                        <h5>Module Name</h5>
                        <input type = "text" class = "form-control" value = "<?php echo $module[$a]["module_connection_name"];?>" name = "module_connection_name">
                    </div>
                    <div class = "form-group">
                        <h5>Module Token</h5>
                        <input type = "text" class = "form-control" value = "<?php echo $module[$a]["module_connection_token"];?>" name = "module_connection_token">
                    </div>
                    <div class = "form-group">
                        <h5>Module Id</h5>
                        <input type = "text" class = "form-control" value = "<?php echo $module[$a]["module_connection_log_id"];?>" name = "module_connection_log_id">
                    </div>
                    <div class = "form-group">
                        <h5>Module Service Documentation URI</h5>
                        <input type = "text" class = "form-control" value = "<?php echo $module[$a]["module_connection_uri"];?>" name = "module_connection_uri">
                    </div>
                    <button type = "submit" class = "btn btn-primary btn-sm">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endfor;?>
<div class = "modal fade" id = "syncModule">
    <div class = "modal-dialog modal-center">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4>Synchronize Module</h4>
            </div>
            <div class = "modal-body">
                <div class = "form-group">
                    <h5>Module</h5>
                    <select class = "form-control" id = "module" data-plugin = "select2" onchange = "loadModuleService()">
                        <option value = "0" disabled selected>Choose Module</option>
                        <?php for($a = 0; $a<count($module); $a++):?> 
                            <option value = "<?php echo $module[$a]["id_submit_module_connection"];?>"><?php echo $module[$a]["module_connection_name"];?></option>
                        <?php endfor;?>       
                    </select>
                </div>
                <div class = "form-group">
                    <h5>Module Services</h5>
                    <select class = "form-control" id = "service" onchange = "buildLink()">
                    </select>
                </div>
                <a href = "" target = "_blank" class = "btn btn-primary btn-sm" id = "sync_button" style = "display:none">SYNCHRONIZE</a>
            </div>
        </div>
    </div>
</div>