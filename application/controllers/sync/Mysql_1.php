<?php 
class Mysql_1 extends CI_Controller{
    private $log_id;
    public function __construct(){
        parent::__construct();
        $this->log_id = "MYSQL_1";
        $this->load->library("Curl");
    }
    public function get_dataset_repository(){
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

<script type="text/javascript">
close()
</script>