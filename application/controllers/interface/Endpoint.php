<?php
class Endpoint extends CI_Controller{
    public function get_registered_client(){
        $where = array(
            "id_submit_endpoint_documentation" => $this->input->post("id_submit_endpoint_documentation")
        );
        $field = array(
            "id_submit_endpoint_auth","token","nama_client"
        );
        $result = selectRow("detail_endpoint_auth",$where,$field);
        echo json_encode($result->result_array());
    }
}
?>