<?php
class Module extends CI_Controller{
    public function get_detail_module_connection(){
        $where = array(
            "id_submit_module_connection_service" => $this->input->post("id_submit_module_endpoint")
        );
        $field = array(
            "module_connection_token","module_connection_log_id","service_url","service_name","service_method","service_input","service_output"
        );
        $result = selectRow("detail_module_endpoint",$where,$field);
        $result_array = $result->result_array();
        echo json_encode($result_array);
    }
    public function get_module_endpoint(){
        $where = array(
            "id_module_connection" => $this->input->post("id_submit_module_connection")
        );
        $field = array(
            "service_url","service_name","id_submit_module_connection_service"
        );
        $result = selectRow("tbl_module_connection_service",$where,$field);
        $result_array = $result->result_array();
        echo json_encode($result_array);
    }
    public function load_module_services(){
        $where = array(
            "id_module_connection" => $this->input->post("id_module"),
            "status_aktif_service" => 1
        );
        $field = array(
            "id_submit_module_connection_service","service_name"
        );
        $result = selectRow("tbl_module_connection_service",$where,$field);
        $result_array = $result->result_array();

        echo json_encode($result_array);
    }
    public function get_detail_module(){
        $where = array(
            "id_submit_module_connection" => $this->input->post("modules")
        );
        $field = array(
            "module_connection_log_id"
        );
        $result = selectRow("tbl_module_connection",$where,$field);
        $result_array = $result->result_array();
        echo json_encode($result_array);
    }
    public function get_detail_service(){
        $where = array(
            "id_submit_module_connection_service" => $this->input->post("service")
        );
        $field = array(
            "service_name"
        );
        $result = selectRow("tbl_module_connection_service",$where,$field);
        $result_array = $result->result_array();
        echo json_encode($result_array);

    }
}