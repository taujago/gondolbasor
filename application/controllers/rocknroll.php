<?php
class rocknroll extends CI_Controller {
function rocknroll(){
		//header("Content-type: text/xml");
		parent::__construct();
		$this->load->helper("tanggal");

		$this->load->library("xml");
		$this->load->model("bpkb_model","bm");
		$this->load->model("master_model","master");
		// $this->load->model("oramodel");

		$data = json_decode(stripslashes($this->input->post('data')));

		/*echo "cek post data " ; 
		show_array($_POST); 
		echo "cek post data end ";*/ 




		$this->data = $data;
		// echo " data post ";
		// show_array($data);
		// echo "end of data in object form"; 
		// exit;   

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


function refresh_pemohon(){
	// show_array($this->data);
	// exit;
	$result = $this->master->refresh_pemohon($this->data->Param->pemohonJenis);
	// show_array($result);
	echo json_encode($result);
}

function bpkb_list_perusahaan_web(){
	// show_array($this->data);
	// exit;
	$result = $this->master->bpkb_list_perusahaan_web();
	// show_array($result);
	echo json_encode($result);
}


function bpkb_add_company_web(){
 
	$result = $this->master->bpkb_add_company_web($this->data->Param);
	// show_array($result);
	echo json_encode($result);
}


function bpkb_add_pemohon_web(){
 
	$result = $this->master->bpkb_add_pemohon_web($this->data->Param);
	 
	echo json_encode($result);
}


function bpkb_list_pemohon_web(){

	// echo FCPATH; exit;
 
	$result = $this->master->bpkb_list_pemohon_web();
	// echo "ini dan itu.."; 
	//show_array($result); 
	$ret = array();
	foreach($result['message']['bpkb_list_pemohon_web'] as $row ) : 

		//$image = imagecreatefromstring($row['PEMOHON_FOTO']); 

		// write_file('./gambar/'.$row['PEMOHON_ID'].'.jpg',$row['PEMOHON_FOTO'],'r+');
// write_file(FCPATH.'/gambar/'.$row['PEMOHON_ID'].'.txt','asdfdf fafd','r+');

		$ret[] = array(
				"PEMOHON_ID"  		=> $row['PEMOHON_ID'] ,
				"PEMOHON_REG"  		=> $row['PEMOHON_REG'] ,
				"PEMOHON_NAMA"  	=> $row['PEMOHON_NAMA'] ,	
				"COMPANY_ID"  		=> $row['COMPANY_ID'] ,
				"COMPANY_NAMA"  	=> $row['COMPANY_NAMA'] ,	
				"BANK_NAMA"  		=> $row['BANK_NAMA'] ,
				"PEMOHON_REK"  		=> $row['PEMOHON_REK'] ,
				"PEMOHON_TELP"  	=> $row['PEMOHON_TELP'] ,	
				"PEMOHON_HP"  		=> $row['PEMOHON_HP'] ,
				"PEMOHON_ALAMAT"  	=> $row['PEMOHON_ALAMAT'],
				"TGL_DAFTAR"        => $row['TGL_DAFTAR'],	
				"STATUS"	        => $row['STATUS'],
				"PEMOHON_JENIS"     => $row['PEMOHON_JENIS']		
			);


	endforeach;

	//show_array($ret);

	echo json_encode($ret);
}


 
}
?>
