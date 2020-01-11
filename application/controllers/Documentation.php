<?php
class Documentation extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $this->check_session();
        $randomString = $this->generate_token();
        $data["new_token"] = md5($randomString);
        $where = array(
            "status_aktif_endpoint < " => 2
        );
        $field = array(
            "id_submit_endpoint_documentation","endpoint_uri","endpoint_name","endpoint_http_method","endpoint_input","endpoint_output","endpoint_token","status_aktif_endpoint","tgl_endpoint_documentation_edit","tgl_endpoint_documentation_add"
        );
        $result = selectRow("endpoint_documentation",$where,$field);
        $data["endpoint"] = $result->result_array();

        $where = array(
            "status_aktif_token" => 1
        );
        $field = array(
            "token","nama_client"
        );
        $result = selectRow("tbl_token",$where,$field);
        $data["client"] = $result->result_array();
        $this->page_generator->req();
        $this->load->view("plugin/datatable/datatable-css");
        $this->page_generator->head_close(); 
        $this->page_generator->navbar();
        $this->page_generator->content_open();
        $this->load->view("documentation/v_documentation",$data);
        $this->page_generator->close();
        $this->load->view("plugin/datatable/datatable-js");
        $this->load->view("documentation/v_documentation_js");
    }
    public function recycle_bin(){
        $this->check_session();
        $randomString = $this->generate_token();
        $data["new_token"] = md5($randomString);
        $where = array(
            "status_aktif_endpoint" => 2
        );
        $field = array(
            "id_submit_endpoint_documentation","endpoint_uri","endpoint_name","endpoint_http_method","endpoint_input","endpoint_output","endpoint_token","status_aktif_endpoint","tgl_endpoint_documentation_edit","tgl_endpoint_documentation_add"
        );
        $result = selectRow("endpoint_documentation",$where,$field);
        $data["endpoint"] = $result->result_array();

        $where = array(
            "status_aktif_token" => 1
        );
        $field = array(
            "token","nama_client"
        );
        $result = selectRow("tbl_token",$where,$field);
        $data["client"] = $result->result_array();
        $this->page_generator->req();
        $this->load->view("plugin/datatable/datatable-css");
        $this->page_generator->head_close(); 
        $this->page_generator->navbar();
        $this->page_generator->content_open();
        $this->load->view("documentation/v_documentation_recycle_bin",$data);
        $this->page_generator->close();
        $this->load->view("plugin/datatable/datatable-js");
        $this->load->view("documentation/v_documentation_js");
    }
    public function request_log(){
        $this->check_session();
        $randomString = $this->generate_token();
        $data["new_token"] = md5($randomString);
        $where = array(
            "status_aktif_endpoint" => 1
        );
        $field = array(
            "id_submit_endpoint_documentation","endpoint_uri","endpoint_name","endpoint_http_method","endpoint_input","endpoint_output","endpoint_token","status_aktif_endpoint","tgl_endpoint_documentation_edit","tgl_endpoint_documentation_add"
        );
        $result = selectRow("endpoint_documentation",$where,$field);
        $data["endpoint"] = $result->result_array();

        $where = array(
            "status_aktif_token" => 1
        );
        $field = array(
            "token","nama_client"
        );
        $result = selectRow("tbl_token",$where,$field);
        $data["client"] = $result->result_array();
        $this->page_generator->req();
        $this->load->view("plugin/datatable/datatable-css");
        $this->page_generator->head_close(); 
        $this->page_generator->navbar();
        $this->page_generator->content_open();
        $this->load->view("documentation/v_documentation_log",$data);
        $this->page_generator->close();
        $this->load->view("plugin/datatable/datatable-js");
        $this->load->view("documentation/v_documentation_js");
    }
    public function insert(){
        $this->check_session();
        $config = array(
            array(
                "field" => "endpoint_name",
                "label" => "Endpoint Name",
                "rules" => "required|is_unique[endpoint_documentation.endpoint_name]"
            ),
            array(
                "field" => "endpoint_http_method",
                "label" => "Endpoint Method",
                "rules" => "required"
            ),
            array(
                "field" => "endpoint_uri",
                "label" => "Endpoint URL",
                "rules" => "required|valid_url"
            ),
            array(
                "field" => "endpoint_output",
                "label" => "Endpoint Output",
                "rules" => "required"
            ),
            array(
                "field" => "endpoint_token",
                "label" => "Endpoint Token",
                "rules" => "required"
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $data = array(
                "endpoint_name" => $this->input->post("endpoint_name"),
                "endpoint_http_method" => $this->input->post("endpoint_http_method"),
                "endpoint_uri" => $this->input->post("endpoint_uri"),
                "endpoint_input" => $this->input->post("endpoint_input"),
                "endpoint_output" => $this->input->post("endpoint_output"),
                "endpoint_token" => $this->input->post("endpoint_token"),
                "status_aktif_endpoint" => 1,
                "id_user_endpoint_documentation_add" => $this->session->id_user,
                "tgl_endpoint_documentation_add" => date("Y-m-d H:i:s")
            );
            insertRow("endpoint_documentation",$data);
            $this->session->set_flashdata("status","success");
            $this->session->set_flashdata("msg","Data is successfully added");
            $this->redirect();
        }
        else{
            $this->page_generator->req();
            $this->page_generator->head_close();
            $this->page_generator->content_open();
            $this->load->view("documentation/v_documentation_reinsert");
            $this->page_generator->close();
        }
    }
    public function generate_token(){
        $this->check_session();
        /**
         * Fungsi ini hanya untuk generate random token untuk diassign kepada 'client'
         */
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $randomString = ''; 
        $n = rand(10,100);
        for ($i = 0; $i < $n; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        } 
        return $randomString;
    }
    private function redirect(){
        redirect("documentation");
    }
    public function delete($id_submit_endpoint_documentation){
        $this->check_session();
        $where = array(
            "id_submit_endpoint_documentation" => $id_submit_endpoint_documentation
        );
        $data = array(
            "status_aktif_endpoint" => 2,
            "id_user_endpoint_documentation_delete" => $this->session->id_user,
            "tgl_endpoint_documentation_delete" => date("Y-m-d H:i:s")
        );
        updateRow("endpoint_documentation",$data,$where);
        $this->session->set_flashdata("status","success");
        $this->session->set_flashdata("msg","Data is successfully deactivated");
        $this->redirect();

    } 
    public function deactive($id_submit_endpoint_documentation){
        $this->check_session();
        $where = array(
            "id_submit_endpoint_documentation" => $id_submit_endpoint_documentation
        );
        $data = array(
            "status_aktif_endpoint" => 0,
            "id_user_endpoint_documentation_delete" => $this->session->id_user,
            "tgl_endpoint_documentation_delete" => date("Y-m-d H:i:s")
        );
        updateRow("endpoint_documentation",$data,$where);
        $this->session->set_flashdata("status","success");
        $this->session->set_flashdata("msg","Data is successfully deactivated");
        $this->redirect();

    } 
    public function activate($id_submit_endpoint_documentation){
        $this->check_session();
        $where = array(
            "id_submit_endpoint_documentation" => $id_submit_endpoint_documentation
        );
        $data = array(
            "status_aktif_endpoint" => 1,
            "id_user_endpoint_documentation_edit" => $this->session->id_user,
            "tgl_endpoint_documentation_edit" => date("Y-m-d H:i:s")
        );
        updateRow("endpoint_documentation",$data,$where);
        $this->session->set_flashdata("status","success");
        $this->session->set_flashdata("msg","Data is successfully activated");
        $this->redirect();
    }
    public function update(){
        $this->check_session();
        $config = array(
            array(
                "field" => "endpoint_name",
                "label" => "Endpoint Name",
                "rules" => "required"
            ),
            array(
                "field" => "endpoint_http_method",
                "label" => "Endpoint Method",
                "rules" => "required"
            ),
            array(
                "field" => "endpoint_uri",
                "label" => "Endpoint URL",
                "rules" => "required|valid_url"
            ),
            array(
                "field" => "endpoint_output",
                "label" => "Endpoint Output",
                "rules" => "required"
            )
        );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()){
            $where = array(
                "id_submit_endpoint_documentation" => $this->input->post("id_submit_endpoint_documentation")
            );
            $data = array(
                "endpoint_name" => $this->input->post("endpoint_name"),
                "endpoint_http_method" => $this->input->post("endpoint_http_method"),
                "endpoint_uri" => $this->input->post("endpoint_uri"),
                "endpoint_input" => $this->input->post("endpoint_input"),
                "endpoint_output" => $this->input->post("endpoint_output"),
                "id_user_endpoint_documentation_edit" => $this->session->id_user,
                "tgl_endpoint_documentation_edit" => date("Y-m-d H:i:s")
            );
            updateRow("endpoint_documentation",$data,$where);
            $this->session->set_flashdata("status","success"); 
            $this->session->set_flashdata("msg","Data is successfully updated");
            $this->redirect();
        }
        else{
            $this->page_generator->req(); 
            $this->page_generator->head_close(); 
            $this->page_generator->content_open(); 
            $this->load->view("documentation/v_documentation_reupdate");
            $this->page_generator->close();
        }
    }
    public function add_user(){
        $this->check_session();
        $check_where = array(
            "client_token" => $this->input->post("client_token"),
            "status_aktif_endpoint_auth" => 1,
            "endpoint_token" => get1Value("endpoint_documentation","endpoint_token",array("id_submit_endpoint_documentation" => $this->input->post("id_submit_endpoint_documentation")))
        );
        if(isExistsInTable("endpoint_auth",$check_where) == 1){ //kalau user enggak ada / enggak aktif
            $data = array(
                "client_token" => $this->input->post("client_token"),
                "endpoint_token" => get1Value("endpoint_documentation","endpoint_token",array("id_submit_endpoint_documentation" => $this->input->post("id_submit_endpoint_documentation"))),
                "status_aktif_endpoint_auth" => 1,
                "id_user_endpoint_auth_add" => $this->session->id_user,
                "tgl_endpiont_auth_add" => date("Y-m-d H:i:S")
            );
            $this->session->set_flashdata("status","success");
            $this->session->set_flashdata("msg","Authentication granted");
            insertRow("endpoint_auth",$data);
        }
        $this->redirect();
    }
    public function remove_user($id_submit_endpoint_auth){
        $this->check_session();
        $where = array(
            "id_submit_endpoint_auth" => $id_submit_endpoint_auth
        );
        $data = array(
            "status_aktif_endpoint_auth" => 0,
            "id_user_endpoint_auth_delete" => $this->session->id_user,
            "tgl_endpiont_auth_delete" => date("Y-m-d H:i:s")
        );
        updateRow("endpoint_auth",$data,$where);
        $this->session->set_flashdata("status","success");
        $this->session->set_flashdata("msg","Authentication removed");
        $this->redirect();
    }
    private function check_session(){
		if($this->session->id_user == ""){
			$msg = "Session Expired";	
			$this->session->set_flashdata("status_login","error");
			$this->session->set_flashdata("msg_login",$msg);
			redirect("welcome");
		}
	}
}
?>