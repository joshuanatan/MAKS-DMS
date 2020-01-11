<div class="page-header">
    <h1 class="page-title">MODULE CONNECTION LOG</h1>
    <br/>
    <ol class="breadcrumb breadcrumb-arrow">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item active">Module Connection Log</li>
    </ol>
</div>
<br/>
<div class="page-body">
    <table class = "table table-striped table-hover table-bordered" id = "table_driver" data-plugin = "dataTable">
        <thead>
            <th>Log ID</th>
            <th>Executed Function</th>
            <th>Request Status</th>
            <th>Request Message</th>
            <th>Request Date</th>
        </thead>
        <tbody>
            <?php for($a = 0; $a<count($log); $a++):?>
            <tr>
                <td><?php echo $log[$a]["module_log_id"];?></td>
                <td><?php echo $log[$a]["executed_function"];?></td>
                <td><?php echo $log[$a]["connection_status"];?></td>
                <td><?php echo $log[$a]["connection_msg"];?></td>
                <td><?php echo $log[$a]["tgl_module_connetion_log"];?></td>
            </tr>
            <?php endfor;?>
        </tbody>
    </table>
    <button onclick = "window.close()" class = "btn btn-primary btn-sm">BACK</button>
</div>