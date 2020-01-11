<?php

class Resultmapping extends CI_Controller{
    private $log_id = "MYSQL_1";
    public function __construct(){
        parent::__construct();
        $this->load->library("Curl");
    }
    public function new_dataset(){
        $where = array(
            "status_aktif_result_type_mapping <" => 2,
            "result_type" => null
        );
        $field = array(
            "id_submit_result_type_mapping","mapping_key","result_type","status_aktif_result_type_mapping"
        );
        $result = selectRow("tbl_result_type_mapping",$where,$field);
        $data["result_mapping"] = $result->result_array();

        $where = array(
            "status_aktif_result_type" => 1
        );
        $field = array(
            "result_type"
        );
        $result = selectRow("tbl_result_type",$where,$field);
        $data["result_type"] = $result->result_array();
        
        $this->page_generator->req();
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("plugin/form/form-css");
        $this->page_generator->head_close();
        $this->page_generator->navbar();
        $this->page_generator->content_open();
        $this->load->view("intent_mapping/v_resultmapping",$data);
        $this->page_generator->close();
        $this->load->view("plugin/datatable/datatable-js");
        $this->load->view("plugin/form/form-js");
        $this->load->view("intent_mapping/v_resultmapping_js");
    }
    public function index(){
        $this->get_dataset_repository();
        redirect("resultmapping/show_mapped_result");
        
    }
    public function recycle_bin(){
        $where = array(
            "status_aktif_result_type_mapping" => 2,
            "result_type" => null
        );
        $field = array(
            "id_submit_result_type_mapping","mapping_key","result_type","status_aktif_result_type_mapping"
        );
        $result = selectRow("tbl_result_type_mapping",$where,$field);
        $data["result_mapping"] = $result->result_array();

        $where = array(
            "status_aktif_result_type" => 1
        );
        $field = array(
            "result_type"
        );
        $result = selectRow("tbl_result_type",$where,$field);
        $data["result_type"] = $result->result_array();
        $this->page_generator->req();
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("plugin/form/form-css");
        $this->page_generator->head_close();
        $this->page_generator->navbar();
        $this->page_generator->content_open();
        $this->load->view("intent_mapping/v_resultmapping_recycle_bin",$data);
        $this->page_generator->close();
        $this->load->view("plugin/datatable/datatable-js");
        $this->load->view("plugin/form/form-js");
        $this->load->view("intent_mapping/v_resultmapping_js");
    }
    public function update(){
        $checks = $this->input->post("checks");
        if($checks != ""){
            foreach($checks as $a){
                $where = array(
                    "id_submit_result_type_mapping" => $this->input->post("id_submit_result_type_mapping".$a)
                );
                $data = array(
                    "result_type" => $this->input->post("result_type".$a)
                );
                updateRow("tbl_result_type_mapping",$data,$where);
            }
        }
        $msg = "Data is successfully updated to database";
        $this->session->set_flashdata("status_mapping","success");
        $this->session->set_flashdata("msg_mapping",$msg);
        redirect("resultmapping/show_mapped_result");
    }
    public function activate($id_submit_result_type_mapping){
        $where = array(
            "id_submit_result_type_mapping" => $id_submit_result_type_mapping
        );
        $data = array(
            "status_aktif_result_type_mapping" => 1,
            "id_user_result_type_mapping_delete"=> $this->session->id_user,
            "tgl_result_type_mapping_delete" => date("Y-m-d H:i:s")
        );
        updateRow("tbl_result_type_mapping",$data,$where);
        $msg = "Data is successfully activated";
        $this->session->set_flashdata("status_mapping","success");
        $this->session->set_flashdata("msg_mapping",$msg);
        redirect("resultmapping");

    } 
    public function delete($id_submit_result_type_mapping){
        $where = array(
            "id_submit_result_type_mapping" => $id_submit_result_type_mapping
        );
        $data = array(
            "status_aktif_result_type_mapping" => 2,
            "id_user_result_type_mapping_delete"=> $this->session->id_user,
            "tgl_result_type_mapping_delete" => date("Y-m-d H:i:s")
        );
        updateRow("tbl_result_type_mapping",$data,$where);
        $msg = "Data is successfully deactivated";
        $this->session->set_flashdata("status_mapping","error");
        $this->session->set_flashdata("msg_mapping",$msg);
        redirect("resultmapping");
    }
    public function deactive($id_submit_result_type_mapping){
        $where = array(
            "id_submit_result_type_mapping" => $id_submit_result_type_mapping
        );
        $data = array(
            "status_aktif_result_type_mapping" => 0,
            "id_user_result_type_mapping_delete"=> $this->session->id_user,
            "tgl_result_type_mapping_delete" => date("Y-m-d H:i:s")
        );
        updateRow("tbl_result_type_mapping",$data,$where);
        $msg = "Data is successfully deactivated";
        $this->session->set_flashdata("status_mapping","error");
        $this->session->set_flashdata("msg_mapping",$msg);
        redirect("resultmapping");
    }
    public function activate_mapped($id_submit_result_type_mapping){
        $where = array(
            "id_submit_result_type_mapping" => $id_submit_result_type_mapping
        );
        $data = array(
            "status_aktif_result_type_mapping" => 1,
            "id_user_result_type_mapping_edit"=> $this->session->id_user,
            "tgl_result_type_mapping_edit" => date("Y-m-d H:i:s")
        );
        updateRow("tbl_result_type_mapping",$data,$where);
        $msg = "Data is successfully deactivated";
        $this->session->set_flashdata("status_mapping","success");
        $this->session->set_flashdata("msg_mapping",$msg);
        redirect("resultmapping/show_mapped_result");

    } 
    public function delete_mapped($id_submit_result_type_mapping){
        $where = array(
            "id_submit_result_type_mapping" => $id_submit_result_type_mapping
        );
        $data = array(
            "status_aktif_result_type_mapping" => 2,
            "id_user_result_type_mapping_delete"=> $this->session->id_user,
            "tgl_result_type_mapping_delete" => date("Y-m-d H:i:s")
        );
        updateRow("tbl_result_type_mapping",$data,$where);
        $msg = "Data is successfully deactivated";
        $this->session->set_flashdata("status_mapping","error");
        $this->session->set_flashdata("msg_mapping",$msg);
        redirect("resultmapping/show_mapped_result");
    }
    public function deactive_mapped($id_submit_result_type_mapping){
        $where = array(
            "id_submit_result_type_mapping" => $id_submit_result_type_mapping
        );
        $data = array(
            "status_aktif_result_type_mapping" => 0,
            "id_user_result_type_mapping_delete"=> $this->session->id_user,
            "tgl_result_type_mapping_delete" => date("Y-m-d H:i:s")
        );
        updateRow("tbl_result_type_mapping",$data,$where);
        $msg = "Data is successfully deactivated";
        $this->session->set_flashdata("status_mapping","error");
        $this->session->set_flashdata("msg_mapping",$msg);
        redirect("resultmapping/show_mapped_result");
    }
    public function insert_mapping(){
        $key = "";
        if(strtolower($this->input->post("key")) == "new_key"){
            $config = array(
                array(
                    "field" => "new_key",
                    "label" => "Request Mapping Key",
                    "rules" => "required"
                )
            );
            $this->form_validation->set_rules($config);
            if($this->form_validation->run()){
                $key = $this->input->post("new_key");
                $data = array(
                    "mapping_key" => $key,
                    "result_type" => $this->input->post("result_type"),
                    "status_aktif_result_type_mapping" => 1,
                    "tgl_result_type_mapping_add" => date("Y-m-d H:i:s"),
                    "id_user_result_type_mapping_add" => $this->session->id_user
                );
                insertRow("tbl_result_type_mapping",$data);
                $msg = "Data is successfully added to database. Click 'Checked Mapped Result' button to review";
                $this->session->set_flashdata("status_mapping","success");
                $this->session->set_flashdata("msg_mapping",$msg);
            }
            else{
                $msg = validation_errors();
                $this->session->set_flashdata("status_mapping","error");
                $this->session->set_flashdata("msg_mapping",$msg);
                redirect("resultmapping");
            }
        }
        else{
            $key = $this->input->post("key");
            $where = array(
                "mapping_key" => $key,
            );
            $data = array(
                "result_type" => $this->input->post("result_type"),
                "tgl_result_type_mapping_edit" => date("Y-m-d H:i:s"),
                "id_user_result_type_mapping_edit" => $this->session->id_user
            );
            updateRow("tbl_result_type_mapping",$data,$where);
            $msg = "Data is successfully updated to database. Click 'Checked Mapped Intent' button to review";
            $this->session->set_flashdata("status_mapping","success");
            $this->session->set_flashdata("msg_mapping",$msg);
        }
        redirect("resultmapping/show_mapped_result");
    }
    public function show_mapped_result(){
        $where = array(
            "status_aktif_result_type_mapping <" => 2,
            "result_type !=" => null
        );
        $field = array(
            "id_submit_result_type_mapping","mapping_key","result_type","status_aktif_result_type_mapping"
        );
        $result = selectRow("tbl_result_type_mapping",$where,$field);
        $data["result_mapping"] = $result->result_array();

        $where = array(
            "status_aktif_result_type" => 1
        );
        $field = array(
            "result_type"
        );
        $result = selectRow("tbl_result_type",$where,$field);
        $data["result_type"] = $result->result_array();
        
        $this->page_generator->req();
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("plugin/form/form-css");
        $this->page_generator->head_close();
        $this->page_generator->navbar();
        $this->page_generator->content_open();
        $this->load->view("intent_mapping/v_resultmapping_mapped",$data);
        $this->page_generator->close();
        $this->load->view("plugin/datatable/datatable-js");
        $this->load->view("plugin/form/form-js");
        $this->load->view("intent_mapping/v_resultmapping_js");
    }
    public function mapped_result_recycle_bin(){
        $where = array(
            "result_type is not " => null,
            "status_aktif_result_type_mapping" => 2
        );
        $field = array(
            "id_submit_result_type_mapping","mapping_key","result_type","status_aktif_result_type_mapping"
        );
        $result = selectRow("tbl_result_type_mapping",$where,$field);
        $data["result_list"] = $result->result_array();

        $where = array(
            "status_aktif_result_type" => 1
        );
        $field = array(
            "result_type"
        );
        $result = selectRow("tbl_result_type",$where,$field);
        $data["result_type"] = $result->result_array();
        $this->page_generator->req();
        $this->load->view("plugin/datatable/datatable-css");
        $this->load->view("plugin/form/form-css");
        $this->page_generator->head_close();
        $this->page_generator->navbar();
        $this->page_generator->content_open();
        $this->load->view("intent_mapping/v_resultmapping_mapped_recycle_bin",$data);
        $this->page_generator->close();
        $this->load->view("plugin/datatable/datatable-js");
        $this->load->view("plugin/form/form-js");
        $this->load->view("intent_mapping/v_resultmapping_js");
    }
    private function get_dataset_repository(){
        $function = "get_dataset_repository";
        $where = array(
            "service_name" => "get_dataset_repository",
            "module_connection_log_id" => strtoupper($this->log_id)
        );
        $field = array(
            "service_name","service_url","service_method","service_input","service_output","module_connection_token"
        );
        $result = selectRow("detail_module_endpoint",$where,$field);
        $result_array = $result->result_array();

        $last_loaded_time = get_log($this->log_id,$function);
        $url = $result_array[0]["service_url"].rawurlencode($last_loaded_time);
        $header = array(
            "client-token:".$result_array[0]["module_connection_token"]
        );
        $respond = $this->curl->get($url,$header);
        if($respond){
            if($respond["err"]){
                $msg = "Error with CURL, Contact Developer";
                $this->session->set_flashdata("status_curl","error");
                $this->session->set_flashdata("msg_curl",$msg);
                log_sync($this->log_id,"get_dataset_repository","error",$msg);
            }
            else{
                $msg = "Request is successfully made";
                $this->session->set_flashdata("status_curl","success");
                $this->session->set_flashdata("msg_curl",$msg);

                $respond = json_decode($respond["response"],true);

                if(array_key_exists("error",$respond)){
                    $msg = $respond["msg"];
                    $this->session->set_flashdata("status_sync","error");
                    $this->session->set_flashdata("msg_sync",$msg);
                    log_sync($this->log_id,"get_dataset_repository","error",$respond["msg"]);
                }
                else{
                    $msg = $respond["msg"];
                    $this->session->set_flashdata("status_sync","success");
                    $this->session->set_flashdata("msg_sync",$msg);
                    log_sync($this->log_id,"get_dataset_repository",$respond["status"],$respond["msg"]);
                    if(is_array($respond["result"])){
                        for($a = 0; $a<count($respond["result"]); $a++){
                            $where = array(
                                "mapping_key" => $respond["result"][$a]["dataset_key"]
                            );
                            $field = array(
                                "mapping_key"
                            );
                            $result = selectRow("tbl_result_type_mapping",$where,$field);
                            if(!$result->num_rows() > 0){
                                $data = array(
                                    "mapping_key" => $respond["result"][$a]["dataset_key"],
                                    "status_aktif_result_type_mapping" => 1,
                                    "tgl_result_type_mapping_add" => date("Y-m-d H:i:s"),
                                );
                                insertRow("tbl_result_type_mapping",$data);
                            }
                        }
                    }
                }
            }
        }
        else{
            $msg = "Error with CURL, No return message. Contact Developer";
            $this->session->set_flashdata("status_curl","error");
            $this->session->set_flashdata("msg_curl",$msg);
            log_sync($this->log_id,"get_dataset_repository","error",$msg);
        }
    }
}
?>