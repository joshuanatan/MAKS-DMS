<div class="page-header">
    <h1 class="page-title">RESULT TYPE</h1>
    <br/>
    <ol class="breadcrumb breadcrumb-arrow">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item active">Result Type</li>
    </ol>
</div>
<br/>
<?php if($this->session->status_result == "success"):?>
    <div class = "alert alert-success alert-dismissible">
        <button type = "button" class = "close" data-dismiss = "alert">&times;</button>
        <?php echo $this->session->msg_result;?>
    </div>
<?php elseif($this->session->status_result == "error"):?>
    <div class = "alert alert-danger alert-dismissible">
        <button type = "button" class = "close" data-dismiss = "alert">&times;</button>
        <?php echo $this->session->msg_result;?>
    </div>
<?php endif;?>
<div class="page-body">
    <div class = "col-lg-10 offset-lg-1 col-sm-12">
        <button type = "button" data-toggle = "modal" data-target = "#addResultType" class = "btn btn-primary btn-sm">+ ADD RESULT TYPE</button>
        <a href = "<?php echo base_url();?>result_type/recycle_bin" class = "btn btn-light btn-sm"><i class = "icon wb-trash"></i></a>
        <br/><br/>
        <h4>Result Type</h4>
        <table class = "table table-striped table-hover table-bordered" id = "table_driver" data-plugin = "dataTable">
            <thead>
                <th>Result Type</th>
                <th style = "width:15%">Status Result Type</th>
                <th style = "width:15%">Action</th>
            </thead>
            <tbody>
                <?php for($a = 0; $a<count($result_type); $a++):?>
                <tr>
                    <td><?php echo $result_type[$a]["result_type"];?></td>
                    <td>
                        <?php if($result_type[$a]["status_aktif_result_type"] == 1):?>
                            <button type = "button" class = "btn btn-primary btn-sm col-lg-12">ACTIVE</button>
                        <?php else:?>
                            <button type = "button" class = "btn btn-danger btn-sm col-lg-12">NOT ACTIVE</button>
                        <?php endif;?>
                    </td>
                    <td>
                        <?php if($result_type[$a]["status_aktif_result_type"] == 0):?>
                            <a href = "<?php echo base_url();?>result_type/activate/<?php echo rawurlencode($result_type[$a]["result_type"]);?>" class = "btn btn-light btn-sm col-lg-12">ACTIVATE</a>
                        <?php else:?>
                            <a href = "<?php echo base_url();?>result_type/deactive/<?php echo rawurlencode($result_type[$a]["result_type"]);?>" class = "btn btn-danger btn-sm col-lg-12">DEACTIVE</a>
                        <?php endif;?>
                            <a href = "<?php echo base_url();?>result_type/delete/<?php echo rawurlencode($result_type[$a]["result_type"]);?>" class = "btn btn-dark btn-sm col-lg-12">DELETE</a>
                        <button type = "button" class = "btn btn-primary btn-sm col-lg-12" data-toggle = "modal" data-target = "#editResultType<?php echo $a;?>">EDIT RESULT TYPE</button>
                    </td>
                </tr>
                <?php endfor;?>
            </tbody>
        </table>
    </div>
</div>
<div class = "modal fade" id = "addResultType">
    <div class = "modal-dialog modal-center">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4>ADD RESULT TYPE</h4>
            </div>
            <form action = "<?php echo base_url();?>result_type/insert" method = "POST">
                <div class = "modal-body">
                    <div class = "form-group">
                        <h5>Result Type Name</h5>
                        <input type = "text" class = "form-control" name = "result_type">
                    </div>
                    <button type = "submit" class = "btn btn-primary btn-sm">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php for($a = 0; $a<count($result_type); $a++):?>
<div class = "modal fade" id = "editResultType<?php echo $a;?>">
    <div class = "modal-dialog modal-center">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4>ADD RESULT TYPE</h4>
            </div>
            <form action = "<?php echo base_url();?>result_type/update" method = "POST">
                <div class = "modal-body">
                    <div class = "form-group">
                        <h5>Result Type Name</h5>
                        <input type = "hidden" name = "result_type_control" value = "<?php echo $result_type[$a]["result_type"];?>">
                        <input type = "text" class = "form-control" name = "result_type" value = "<?php echo $result_type[$a]["result_type"];?>">
                    </div>
                    <button type = "submit" class = "btn btn-primary btn-sm">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endfor;?>