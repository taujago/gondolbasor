<?php
class rocknroll extends CI_Controller {
function rocknroll(){
		//header("Content-type: text/xml");
		parent::__construct();
		$this->load->helper("tanggal");

		$this->load->library("xml");
		$this->load->model("bpkbonlinemodel","bm");
		$this->load->model("oramodel");

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
			
		//$xml = Array2XML::createXML("Login",$ret);
		$xml = $this->xml->createXML("SignIn",$ret);
		header('Content-type: text/xml');
		echo $xml->saveXML();

			//echo json_encode($ret);
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

function bpkb_login(){
	$result = $this->bm->bpkb_login($this->data->Param);
	$xml = $this->xml->createXML("bpkb_login",$result);
	header('Content-type: text/xml');
	echo $xml->saveXML();
}

function bpkb_add_operator(){
	
	$result = $this->bm->bpkb_add_operator($this->data->Param);
	$xml = $this->xml->createXML("bpkb_add_operator",$result);
	header('Content-type: text/xml');
	echo $xml->saveXML();


}


function bpkb_edit_operator(){
	
	$result = $this->bm->bpkb_edit_operator($this->data->Param);
	$xml = $this->xml->createXML("bpkb_edit_operator",$result);
	header('Content-type: text/xml');
	echo $xml->saveXML();


}



function bpkb_detail_operator(){
	
	$result = $this->bm->bpkb_detail_operator($this->data->Param);
	$xml = $this->xml->createXML("bpkb_detail_operator",$result);
	header('Content-type: text/xml');
	echo $xml->saveXML();


}


function bpkb_add_alat(){
	
	$result = $this->bm->bpkb_add_alat($this->data->Param);
	$xml = $this->xml->createXML("bpkb_add_alat",$result);
	header('Content-type: text/xml');
	echo $xml->saveXML();

}

function bpkb_edit_alat(){
	
	$result = $this->bm->bpkb_edit_alat($this->data->Param);
	$xml = $this->xml->createXML("bpkb_edit_alat",$result);
	header('Content-type: text/xml');
	echo $xml->saveXML();

}



function bpkb_detail_alat(){
	
	$result = $this->bm->bpkb_detail_alat($this->data->Param);
	$xml = $this->xml->createXML("bpkb_detail_alat",$result);
	header('Content-type: text/xml');
	echo $xml->saveXML();

}


function bpkb_role_menu(){
	$result = $this->bm->bpkb_role_menu($this->data->Param);
	$xml = $this->xml->createXML("bpkb_role_menu",$result);
	header('Content-type: text/xml');
	echo $xml->saveXML();
}

function add_m_group_hak_akses(){
	$result = $this->bm->add_m_group_hak_akses($this->data->Param);
	$xml = $this->xml->createXML("add_m_group_hak_akses",$result);
	header('Content-type: text/xml');
	echo $xml->saveXML();
}

function data_master(){
	$result = $this->bm->data_master();
	$xml = $this->xml->createXML("data_master",$result);
	header('Content-type: text/xml');
	echo $xml->saveXML();
}

function add_pemohon(){
	$result = $this->bm->add_pemohon($this->data->Param);
	$xml = $this->xml->createXML("add_pemohon",$result);
	header('Content-type: text/xml');
	echo $xml->saveXML();
}


function edit_pemohon(){
	$result = $this->bm->edit_pemohon($this->data->Param);
	$xml = $this->xml->createXML("edit_pemohon",$result);
	header('Content-type: text/xml');
	echo $xml->saveXML();
}


function bpkb_refresh_pemohon(){
	$result = $this->bm->refresh_pemohon();
	$xml = $this->xml->createXML("bpkb_refresh_pemohon",$result);
	header('Content-type: text/xml');
	echo $xml->saveXML();
}

function bpkb_pendaftaran_add(){
	$result = $this->bm->bpkb_pendaftaran_add($this->data->Param);
	$xml = $this->xml->createXML("bpkb_pendaftaran_add",$result);
	header('Content-type: text/xml');
	echo $xml->saveXML();
}

function bpkb_pendaftaran_edit(){
	$result = $this->bm->bpkb_pendaftaran_edit($this->data->Param);
	$xml = $this->xml->createXML("bpkb_pendaftaran_edit",$result);
	header('Content-type: text/xml');
	echo $xml->saveXML();
}


function bpkb_pendaftaran_delete(){
	$result = $this->bm->bpkb_pendaftaran_delete($this->data->Param);
	$xml = $this->xml->createXML("bpkb_pendaftaran_delete",$result);
	header('Content-type: text/xml');
	echo $xml->saveXML();
}

function bpkb_list_pendaftaran(){
	$result = $this->bm->list_pendaftaran($this->data->Param);
	$xml = $this->xml->createXML("bpkb_list_pendaftaran",$result);
	header('Content-type: text/xml');
	echo $xml->saveXML();
}

// --------------------------------------------------------------------------------
// ---------------------- MODUL STNK ONLINE ---------------------------------------
// --------------------------------------------------------------------------------

// ********* function *********
function stnk_login(){
	$result = $this->bm->stnk_login($this->data->Param);
	echo json_encode($result);
}

function stnk_add(){
	$result = $this->bm->stnk_add($this->data->Param);
	echo json_encode($result);
}

function stnk_update(){
	$result = $this->bm->stnk_update($this->data->Param);
	echo json_encode($result);
}

function stnk_print(){
	$result = $this->bm->stnk_print($this->data->Param);
	echo json_encode($result);
}

function stnk_ambil(){
	$result = $this->bm->stnk_ambil($this->data->Param);
	echo json_encode($result);
}

function stnk_add_pemohon(){
	$result = $this->bm->stnk_add_pemohon($this->data->Param);
	echo json_encode($result);
}

function stnk_add_pemohon2(){
	$result = $this->bm->stnk_add_pemohon2($this->data->Param);
	echo json_encode($result);
}

function stnk_add_rahasia(){
	$result = $this->bm->stnk_add_rahasia($this->data->Param);
	echo json_encode($result);
}

function stnk_add2(){
	$result = $this->bm->stnk_add2($this->data->Param);
	echo json_encode($result);
}


// ********* procedure *********
function stnk_get_data(){
	$result = $this->bm->stnk_get_data($this->data->Param);
	echo json_encode($result);
}

function stnk_get_data_for_edit(){
	$result = $this->bm->stnk_get_data_for_edit($this->data->Param);
	echo json_encode($result);
}

function stnk_list_registrasi(){
	$result = $this->bm->stnk_list_registrasi($this->data->Param);
	echo json_encode($result);
}

function stnk_get_data_cetak(){
	$result = $this->bm->stnk_get_data_cetak($this->data->Param);
	echo json_encode($result);
}

function stnk_list_registrasi_print(){

	// show_array($this->data); exit;
	// echo "lbldfkdf";
	$result = $this->bm->stnk_list_registrasi_print($this->data->Param);
	echo json_encode($result);
}

function stnk_get_data_ambil(){
	$result = $this->bm->stnk_get_data_ambil($this->data->Param);
	echo json_encode($result);
}

function stnk_list_registrasi_ambil(){
	$result = $this->bm->stnk_list_registrasi_ambil($this->data->Param);
	echo json_encode($result);
}

function stnk_list_registrasi_lap(){
	$result = $this->bm->stnk_list_registrasi_lap($this->data->Param);
	echo json_encode($result);
}

function stnk_list_print(){
    $result = $this->bm->stnk_list_print($this->data->Param);
	echo json_encode($result);
} 

function stnk_list_status_penerbitan(){
	//show_array($this->data); exit;
    $result = $this->bm->stnk_list_status_penerbitan($this->data->Param);
	echo json_encode($result);
}

function stnk_list_registrasi_print2(){

	// show_array($this->data); exit;
	// echo "lbldfkdf";
	$result = $this->bm->stnk_list_registrasi_print2($this->data->Param);
	echo json_encode($result);
}
function pengurus_list(){
	$result = $this->bm->pengurus_list($this->data->Param);
	echo json_encode($result);
}
function m_merk(){
	$result = $this->bm->m_merk($this->data->Param);
	echo json_encode($result);
}
}
?>
