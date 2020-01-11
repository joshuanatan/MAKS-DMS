<?php
class Module extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $this->check_session();
        unset($this->session->id_module);
        $where = array(
            "status_aktif_module_connection < " => 2
        );
        $field = array(
            "id_submit_module_connection","module_connection_name","module_connection_token","module_connection_log_id","status_aktif_module_connection","tgl_module_connection_add","tgl_module_connection_edit","module_connection_uri"
        );
        $result = selectRow("tbl_module_connection",$where,$field);
        $data["module"] = $result->result_array();
        $this->page_generator->req();
        $this->load->view("plugin/datatable/datatable-css");
        $this->page_generator->head_close();
        $this->page_generator->navbar();
        $this->page_generator->content_open();
        $this->load->view("module/v_module",$data);
        $this->page_generator->close();
        $this->load->view("plugin/datatable/datatable-js");
        $this->load->view("module/v_module_js");
    }
    public function recycle_bin(){
        $this->check_session();
        unset($this->session->id_module);
        $where = array(
            "status_aktif_module_connection" => 2
        );
        $field = array(
            "id_submit_module_connection","module_connection_name","module_connection_token","module_connection_log_id","status_aktif_module_connection","tgl_module_connection_add","tgl_module_connection_edit","module_connection_uri"
        );
        $result = selectRow("tbl_module_connection",$where,$field);
        $data["module"] = $result->result_array();
        $this->page_generator->req();
        $this->load->view("plugin/datatable/datatable-css");
        $this->page_generator->head_close();
        $this->page_generator->navbar();
        $this->page_generator->content_open();
        $this->load->view("module/v_module_recycle_bin",$data);
        $this->page_generator->close();
        $this->load->view("plugin/datatable/datatable-js");
        $this->load->view("module/v_module_js");
    }
    public function insert(){
        $this->check_session();
        $config = array(
            array(
                "field" => "module_connection_name",
                "label" => ucwords(str_replace("_"," ","module_connection_name")),
                "rules" => "required"
            ),
            array(
                "field" => "module_connection_token",
                "label" => ucwords(str_replace("_"," ","module_connection_token")),
                "rules" => "required"
            ),
            array(
                "field" => "module_connection_log_id",
                "label" => ucwords(str_replace("_"," ","module_connection_log_id")),
                "rules" => "required|alpha_dash"
            ),
            array(
                "field" => "module_connection_uri",
                "label" => ucwords(str_replace("_"," ","module_connection_uri")),
                "rules" => "required|valid_url"
            ),
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $data = array(
                "module_connection_name" => $this->input->post("module_connection_name"),
                "module_connection_token" => $this->input->post("module_connection_token"),
                "module_connection_log_id" => strtoupper($this->input->post("module_connection_log_id")),
                "module_connection_uri" => $this->input->post("module_connection_uri"),
                "status_aktif_module_connection" => 1,
                "tgl_module_connection_add" => date("Y-m-d H:i:s"),
                "id_user_module_connection_add" => $this->session->id_user
            );
            insertRow("tbl_module_connection",$data);
            $msg = "Module is successfully added to database";
            $this->session->set_flashdata("status_module","success");
            $this->session->set_flashdata("msg_module",$msg); 
            $this->redirect();
        }
        else{
            $this->page_generator->req();
            $this->page_generator->head_close();
            $this->page_generator->content_open();
            $this->load->view("module/v_module_reinsert");
            $this->page_generator->close();
        }
    }
    public function update(){
        $this->check_session();
        $config = array(
            array(
                "field" => "module_connection_name",
                "label" => ucwords(str_replace("_"," ","module_connection_name")),
                "rules" => "required"
            ),
            array(
                "field" => "module_connection_token",
                "label" => ucwords(str_replace("_"," ","module_connection_token")),
                "rules" => "required"
            ),
            array(
                "field" => "module_connection_log_id",
                "label" => ucwords(str_replace("_"," ","module_connection_log_id")),
                "rules" => "required"
            ),
            array(
                "field" => "module_connection_uri",
                "label" => ucwords(str_replace("_"," ","module_connection_uri")),
                "rules" => "required"
            ),
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $where = array(
                "id_submit_module_connection" => $this->input->post("id_submit_module_connection")
            );
            $data = array(
                "module_connection_name" => $this->input->post("module_connection_name"),
                "module_connection_token" => $this->input->post("module_connection_token"),
                "module_connection_log_id" => $this->input->post("module_connection_log_id"),
                "module_connection_uri" => $this->input->post("module_connection_uri"),
                "tgl_module_connection_edit" => date("Y-m-d H:i:s"),
                "id_user_module_connection_edit" => $this->session->id_user
            );
            updateRow("tbl_module_connection",$data,$where);
            $msg = "Module is successfully updated to database";
            $this->session->set_flashdata("status_module","success");
            $this->session->set_flashdata("msg_module",$msg); 
            $this->redirect();
        }
        else{
            $this->page_generator->req();
            $this->page_generator->head_close();
            $this->page_generator->content_open();
            $this->load->view("module/v_module_reupdate");
            $this->page_generator->close();
        }
    }
    public function deactive($id_submit_module_connection){
        $this->check_session();
        $where = array(
            "id_submit_module_connection" => $id_submit_module_connection
        );
        $data = array(
            "status_aktif_module_connection" => 0,
            "tgl_module_connection_delete" => date("Y-m-d H:i:s"),
            "id_user_module_connection_delete" => $this->session->id_user
        );
        updateRow("tbl_module_connection",$data,$where);
        $msg = "Module is successfully deactivated";
        $this->session->set_flashdata("status_module","success");
        $this->session->set_flashdata("msg_module",$msg); 
        $this->redirect();
    }
    public function activate($id_submit_module_connection){
        $this->check_session();
        $where = array(
            "id_submit_module_connection" => $id_submit_module_connection
        );
        $data = array(
            "status_aktif_module_connection" => 1,
            "tgl_module_connection_edit" => date("Y-m-d H:i:s"),
            "id_user_module_connection_edit" => $this->session->id_user
        );
        updateRow("tbl_module_connection",$data,$where);
        $msg = "Module is successfully activated";
        $this->session->set_flashdata("status_module","success");
        $this->session->set_flashdata("msg_module",$msg); 
        $this->redirect();
    }
    public function services($id_submit_module){
        $this->check_session();
        $where = array(
            "id_submit_module_connection" => $id_submit_module,
        );
        $field = array(
            "module_connection_name"
        );
        $result = selectRow("tbl_module_connection",$where,$field);
        $data["module_detail"] = $result->result_array();
        $this->session->id_module = $id_submit_module;
        $where = array(
            "id_module_connection" => $id_submit_module,
            "status_aktif_service <" => 2
        );
        $field = array(
            "id_submit_module_connection_service","service_name","service_url","service_method","service_input","service_output","status_aktif_service","tgl_module_connection_service_add","tgl_module_connection_service_edit"
        );
        $result = selectRow("tbl_module_connection_service",$where,$field);
        $data["services"] = $result->result_array();
        $this->page_generator->req();
        $this->load->view("plugin/datatable/datatable-css");
        $this->page_generator->head_close();
        $this->page_generator->content_open();
        $this->load->view("module/v_module_service",$data);
        $this->page_generator->close();
        $this->load->view("plugin/datatable/datatable-js");
        $this->load->view("module/v_module_service_js");
    }
    public function services_recycle_bin($id_submit_module){
        $this->check_session();
        $where = array(
            "id_submit_module_connection" => $id_submit_module,
        );
        $field = array(
            "module_connection_name"
        );
        $result = selectRow("tbl_module_connection",$where,$field);
        $data["module_detail"] = $result->result_array();
        $where = array(
            "id_module_connection" => $id_submit_module,
            "status_aktif_service " => 2
        );
        $field = array(
            "id_submit_module_connection_service","service_name","service_url","service_method","service_input","service_output","status_aktif_service","tgl_module_connection_service_add","tgl_module_connection_service_edit"
        );
        $result = selectRow("tbl_module_connection_service",$where,$field);
        $data["services"] = $result->result_array();
        $this->page_generator->req();
        $this->load->view("plugin/datatable/datatable-css");
        $this->page_generator->head_close();
        $this->page_generator->content_open();
        $this->load->view("module/v_module_service_recycle_bin",$data);
        $this->page_generator->close();
        $this->load->view("plugin/datatable/datatable-js");
        $this->load->view("module/v_module_service_js");
    }
    public function insert_service(){
        $this->check_session();
        $config = array(
            array(
                "field" => "service_name",
                "label" => ucwords(str_replace("_"," ","service_name")),
                "rules" => "required"
            ),
            array(
                "field" => "service_url",
                "label" => ucwords(str_replace("_"," ","service_url")),
                "rules" => "required|valid_url"
            ),
            array(
                "field" => "service_method",
                "label" => ucwords(str_replace("_"," ","service_method")),
                "rules" => "required"
            ),
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $data = array(
                "id_module_connection" => $this->session->id_module,
                "service_name" => $this->input->post("service_name"),
                "service_url" => $this->input->post("service_url"),
                "service_method" => $this->input->post("service_method"),
                "service_input" => $this->input->post("service_input"),
                "service_output" => $this->input->post("service_output"),
                "status_aktif_service" => 1,
                "tgl_module_connection_service_add" => date("Y-m-d H:i:S"),
                "id_user_module_connection_service_add" => $this->session->id_user
            );
            insertRow("tbl_module_connection_service",$data);
            $msg = "Service is successfully inserted to database";
            $this->session->set_flashdata("status_service","success");
            $this->session->set_flashdata("msg_service",$msg);
            $this->redirect_services();
        }
        else{
            $this->page_generator->req();
            $this->page_generator->head_close();
            $this->page_generator->content_open();
            $this->load->view("module/v_module_service_reinsert");
            $this->page_generator->close();
            $msg = validation_errors();
            $this->session->set_flashdata("status_service","error");
            $this->session->set_flashdata("msg_service",$msg);
        }
    }
    public function delete_service($id_submit_module_connection_service){
        $this->check_session();
        $where = array(
            "id_submit_module_connection_service" => $id_submit_module_connection_service
        );
        $data = array(
            "status_aktif_service" => 2,
            "tgl_module_connection_service_delete" => date("Y-m-d H:i:s"),
            "id_user_module_connection_service_delete" => $this->session->id_user,
        );
        updateRow("tbl_module_connection_service",$data,$where);
        $msg = "Service is successfully deactivated";
        $this->session->set_flashdata("status_service","error");
        $this->session->set_flashdata("msg_service",$msg);
        $this->redirect_services();
    }
    public function deactive_service($id_submit_module_connection_service){
        $this->check_session();
        $where = array(
            "id_submit_module_connection_service" => $id_submit_module_connection_service
        );
        $data = array(
            "status_aktif_service" => 0,
            "tgl_module_connection_service_delete" => date("Y-m-d H:i:s"),
            "id_user_module_connection_service_delete" => $this->session->id_user,
        );
        updateRow("tbl_module_connection_service",$data,$where);
        $msg = "Service is successfully deactivated";
        $this->session->set_flashdata("status_service","error");
        $this->session->set_flashdata("msg_service",$msg);
        $this->redirect_services();
    }
    public function activate_service($id_submit_module_connection_service){
        $this->check_session();
        $where = array(
            "id_submit_module_connection_service" => $id_submit_module_connection_service
        );
        $data = array(
            "status_aktif_service" => 1,
            "tgl_module_connection_service_edit" => date("Y-m-d H:i:s"),
            "id_user_module_connection_service_edit" => $this->session->id_user,
        );
        updateRow("tbl_module_connection_service",$data,$where);
        $msg = "Service is successfully activated";
        $this->session->set_flashdata("status_service","success");
        $this->session->set_flashdata("msg_service",$msg);
        $this->redirect_services();
    }
    public function update_service(){
        $this->check_session();
        $config = array(
            array(
                "field" => "service_name",
                "label" => ucwords(str_replace("_"," ","service_name")),
                "rules" => "required"
            ),
            array(
                "field" => "service_url",
                "label" => ucwords(str_replace("_"," ","service_url")),
                "rules" => "required|valid_url"
            ),
            array(
                "field" => "service_method",
                "label" => ucwords(str_replace("_"," ","service_method")),
                "rules" => "required"
            ),
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $where = array(
                "id_submit_module_connection_service" => $this->input->post("id_submit_module_connection_service")
            );
            $data = array(
                "service_name" => $this->input->post("service_name"),
                "service_url" => $this->input->post("service_url"),
                "service_method" => $this->input->post("service_method"),
                "service_input" => $this->input->post("service_input"),
                "service_output" => $this->input->post("service_output"),
                "tgl_module_connection_service_edit" => date("Y-m-d H:i:S"),
                "id_user_module_connection_service_edit" => $this->session->id_user
            );
            updateRow("tbl_module_connection_service",$data,$where);
            $msg = "Service is successfully updated to database";
            $this->session->set_flashdata("status_service","success");
            $this->session->set_flashdata("msg_service",$msg);
            $this->redirect_services();
        }
        else{
            $msg = validation_errors();
            $this->session->set_flashdata("status_service","error");
            $this->session->set_flashdata("msg_service",$msg);
            $this->page_generator->req();
            $this->page_generator->head_close();
            $this->page_generator->content_open();
            $this->load->view("module/v_module_service_reupdate");
            $this->page_generator->close();
        }
    }
    public function redirect(){
        $this->check_session();
        redirect("module");
    }
    public function redirect_services(){
        $this->check_session();
        redirect("module/services/".$this->session->id_module);
    }
    public function module_log(){
        $this->check_session();
        $where = "";
        $field = array(
            "module_log_id","executed_function","connection_status","connection_msg","tgl_module_connetion_log"
        );
        $result = selectRow("tbl_module_connection_log",$where,$field,"","","id_submit_module_connection_log","DESC");
        $data = array(
            "log" => $result->result_array()
        );
        $this->page_generator->req();
        $this->load->view("plugin/datatable/datatable-css");
        $this->page_generator->head_close();
        $this->page_generator->navbar();
        $this->page_generator->content_open();
        $this->load->view("module/v_module_log",$data);
        $this->page_generator->close();
        $this->load->view("plugin/datatable/datatable-js");
    }
    private function check_session(){
		if($this->session->id_user == ""){
			$msg = "Session Expired";	
			$this->session->set_flashdata("status_login","error");
			$this->session->set_flashdata("msg_login",$msg);
			redirect("welcome");
		}
    }
    public function delete($id_submit_module_connection){
        $this->check_session();
        $where = array(
            "id_submit_module_connection" => $id_submit_module_connection
        );
        $data = array(
            "status_aktif_module_connection" => 2,
            "tgl_module_connection_delete" => date("Y-m-d H:i:s"),
            "id_user_module_connection_delete" => $this->session->id_user
        );
        updateRow("tbl_module_connection",$data,$where);
        $msg = "Module is successfully deleted";
        $this->session->set_flashdata("status_module","success");
        $this->session->set_flashdata("msg_module",$msg); 
        $this->redirect();
    }
}
?>