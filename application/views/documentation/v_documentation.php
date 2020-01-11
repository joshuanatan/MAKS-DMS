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
    <div class = "col-lg-12">
        <button type = "button" class = "btn btn-primary btn-sm" data-toggle = "modal" data-target = "#addNewAccount">+ ADD NEW ENDPOINT</button>
        <a href = "<?php base_url();?>documentation/recycle_bin" class = "btn btn-light btn-sm"><i class = "icon wb-trash"></i></a>
        <br/><br/>
        <table class = "table table-striped table-hover table-bordered" id = "table_driver" data-plugin = "dataTable" style = "table-layout: fixed">
            <thead>
                <th style = "width:5%">#</th>
                <th style = "width:10%; overflow-wrap: break-word">Function</th>
                <th style = "width:10%; overflow-wrap: break-word">Method</th>
                <th style = "width:20%; overflow-wrap: break-word">Endpoint URL</th>
                <th style = "width:10%; overflow-wrap: break-word">Input</th>
                <th style = "width:10%; overflow-wrap: break-word">Output</th>
                <th style = "width:15%; overflow-wrap: break-word">Token</th>
                <th style = "width:10%">Status Endpoint</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php for($a = 0; $a<count($endpoint); $a++):?>
                <tr>
                    <td><?php echo $a+1;?></td>
                    <td style = " overflow-wrap: break-word"><?php echo $endpoint[$a]["endpoint_name"];?></td>
                    <td style = " overflow-wrap: break-word"><?php echo $endpoint[$a]["endpoint_http_method"];?></td>
                    <td style = " overflow-wrap: break-word"><?php echo $endpoint[$a]["endpoint_uri"];?></td>
                    <td style = " overflow-wrap: break-word"><?php echo $endpoint[$a]["endpoint_input"];?></td>
                    <td style = " overflow-wrap: break-word"><?php echo $endpoint[$a]["endpoint_output"];?></td>
                    <td style = " overflow-wrap: break-word"><?php echo $endpoint[$a]["endpoint_token"];?></td>
                    <td>
                        <?php if($endpoint[$a]["status_aktif_endpoint"] == 1):?>
                        <button type = "button" class = "btn btn-primary btn-sm col-lg-12">IN USE</button>
                        <?php else:?>
                        <button type = "button" class = "btn btn-danger btn-sm col-lg-12">NOT IN USE</button> 
                        <?php endif;?> 
                    </td>
                    <td>
                        <?php if($endpoint[$a]["status_aktif_endpoint"] == 1):?>
                        <a href = "<?php echo base_url();?>documentation/deactive/<?php echo $endpoint[$a]["id_submit_endpoint_documentation"];?>" class = "btn btn-danger btn-sm col-lg-12">DEACTIVE</a>
                        <?php else:?>
                        <a href = "<?php echo base_url();?>documentation/activate/<?php echo $endpoint[$a]["id_submit_endpoint_documentation"];?>" class = "btn btn-light btn-sm col-lg-12">ACTIVATE</a> 
                        <?php endif;?> 
                        <a href = "<?php echo base_url();?>documentation/activate/<?php echo $endpoint[$a]["id_submit_endpoint_documentation"];?>" class = "btn btn-dark btn-sm col-lg-12">DELETE</a> 
                        <button type = "button" data-toggle = "modal" data-target = "#editEndpoint<?php echo $a;?>" class = "btn btn-primary btn-sm col-lg-12">EDIT ENDPOINT</button>
                        <button type = "button" onclick = "loadUserAuthentication(<?php echo $endpoint[$a]['id_submit_endpoint_documentation'];?>)" data-toggle = "modal" data-target = "#userAuthentication" class = "btn btn-light btn-sm col-lg-12">AUTHENTICATION</button>
                    </td>
                </tr>
                <?php endfor;?>
            </tbody>
        </table>
    </div>
</div>
<div class = "modal fade" id = "addNewAccount">
    <div class = "modal-dialog modal-center">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4>ADD ENDPOINT</h4>
            </div>
            <div class = "modal-body">
                <form action = "<?php echo base_url();?>documentation/insert" method = "POST">
                    <div class = "form-group">
                        <h5>Endpoint Function</h5>
                        <input type = "text" class = "form-control" name = "endpoint_name">
                    </div>
                    <div class = "form-group">
                        <h5>Endpoint Method</h5>
                        <input type = "text" class = "form-control" name = "endpoint_http_method">
                    </div>
                    <div class = "form-group">
                        <h5>Endpoint URL</h5>
                        <input type = "text" class = "form-control" name = "endpoint_uri">
                    </div>
                    <div class = "form-group">
                        <h5>Input</h5>
                        <input type = "text" class = "form-control" name = "endpoint_input">
                    </div>
                    <div class = "form-group">
                        <h5>Output</h5>
                        <input type = "text" class = "form-control" name = "endpoint_output">
                    </div>
                    <div class = "form-group">
                        <h5>Token</h5>
                        <input type = "text" class = "form-control" value = "<?php echo $new_token;?>" readonly name = "endpoint_token">
                    </div>
                    <button type = "submit" class = "btn btn-primary btn-sm">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php for($a = 0; $a<count($endpoint); $a++):?>
<div class = "modal fade" id = "editEndpoint<?php echo $a;?>">
    <div class = "modal-dialog modal-center">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4>EDIT ENDPOINT</h4>
            </div>
            <div class = "modal-body">
                <form action = "<?php echo base_url();?>documentation/update" method = "POST">
                    <input type = "hidden" name = "id_submit_endpoint_documentation" value = "<?php echo $endpoint[$a]["id_submit_endpoint_documentation"];?>">
                    <div class = "form-group">
                        <h5>Endpoint Function</h5>
                        <input type = "text" class = "form-control" value = "<?php echo $endpoint[$a]["endpoint_name"];?>" name = "endpoint_name">
                    </div>
                    <div class = "form-group">
                        <h5>Endpoint Method</h5>
                        <input type = "text" class = "form-control" value = "<?php echo $endpoint[$a]["endpoint_http_method"];?>" name = "endpoint_http_method">
                    </div>
                    <div class = "form-group">
                        <h5>Endpoint URL</h5>
                        <input type = "text" class = "form-control" value = "<?php echo $endpoint[$a]["endpoint_uri"];?>" name = "endpoint_uri">
                    </div>
                    <div class = "form-group">
                        <h5>Input</h5>
                        <input type = "text" class = "form-control" value = "<?php echo $endpoint[$a]["endpoint_input"];?>" name = "endpoint_input">
                    </div>
                    <div class = "form-group">
                        <h5>Output</h5>
                        <input type = "text" class = "form-control" value = "<?php echo $endpoint[$a]["endpoint_output"];?>" name = "endpoint_output">
                    </div>
                    <button type = "submit" class = "btn btn-primary btn-sm">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endfor;?>

<div class = "modal fade" id = "userAuthentication">
    <div class = "modal-dialog modal-center modal-lg">
        <div class = "modal-content">
            <div class = "modal-header">
                <h4>ENDPOINT AUTHENTICATION</h4>
            </div>
            <div class = "modal-body">
                <form action = "<?php echo base_url();?>documentation/add_user" method = "POST">
                    <input type = 'hidden' id = 'endpointToken' value = '' name = "id_submit_endpoint_documentation">
                    <div class = "row">
                        <div class = "form-group col-lg-10">
                            <h5>Username</h5>
                            <select class = "form-control" name = "client_token">
                                <?php for($a = 0; $a<count($client); $a++):?>
                                <option value = "<?php echo $client[$a]["token"];?>"><?php echo $client[$a]["nama_client"];?></option>
                                <?php endfor;?>
                            </select>
                        </div>
                        <div class = "form-group col-lg-1">
                            <h5>&nbsp;</h5>
                            <button type = "submit" class = "btn btn-primary btn-sm">ACTIVATE</button>
                        </div>
                    </div>
                </form>
                <table class = "table table-striped table-bordered table-hover">
                    <thead>
                        <th style = "width:5%">#</th>
                        <th>Username</th>
                        <th>User Token</th>
                        <th style = "width:15%">Action</th>
                    </thead>
                    <tbody id = "userAuthContainer">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
