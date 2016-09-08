<?php
class rocknroll extends CI_Controller {
function rocknroll(){
		//header("Content-type: text/xml");
		parent::__construct();
		$this->load->helper("tanggal");

		$this->load->library("xml");
		$this->load->model("bpkb_model","bm");
		// $this->load->model("oramodel");

		$data = json_decode(stripslashes($this->input->post('data')));

		/*echo "cek post data " ; 
		show_array($_POST); 
		echo "cek post data end ";*/ 




		$this->data = $data;
		/*echo " data post ";
		show_array($data);
		echo "end of data in object form"; 
		exit;  */ 

		$login = $this->auth($data);

		if($login['result']=="false"){
			$ret = array("result"=>"false","message"=>"Authentikasi Gagal");
			
		// //$xml = Array2XML::createXML("Login",$ret);
		// $xml = $this->xml->createXML("SignIn",$ret);
		// header('Content-type: text/xml');
		// echo $xml->saveXML();

			echo json_encode($ret);
			exit;
		}


	}

	var $data;

	function auth($data){
			// rahasia.123321
			//$data = json_decode($this->input->post('data'));

			// echo "<pre>"; print_r($data); echo "</pre>";


			$this->db->where("USER_ID",$data->LoginInfo->LoginName);
			$res = $this->db->get("SERVICE_AUTH"); 
			 // echo $this->db->last_query(); exit;
			$data_login = $res->row();
			//echo $this->db->last_query(); exit;
			// show_array($data_login);

			if(count($data_login) == 0){
				$ret = array("result"=>"false","message"=>"User tidak dikenal");
			}
			else {
				if( md5($data_login->USER_ID. "_". $data->LoginInfo->Salt . $data_login->USER_PASSWORD ) == $data->LoginInfo->AuthHash  ) {
					$ret = array("result"=>"true");
				}
				else {
					$ret = array("result"=>"false","message"=>"Password salah");
				}
			}

			return $ret;
	}




function bpkb_login_web(){
	$result = $this->bm->bpkb_login_web($this->data->Param);
	echo json_encode($result);

}


 
}
?>
