<?php
class tester extends CI_Controller {

	function tester(){
		parent::__construct();
	}



function test_conn(){
	if($this->db->conn_id){
		echo "berhasil connect";
	}
	else {
		echo "koneksi gaga";
	}
}

	var $url = "http://jabar/gondolbasor/index.php/rocknroll";

	//ss
	// var $url = "http://180.250.16.227/bpkbonline/index.php/rocknroll";
	// http://180.250.16.227/bpkbonline/index.php/

var $user = "3PILAR";
var $pass = "rahasia.123321";
var $salt = "1234556678";









	function bpkb_login_web(){
		 
		
	 

		$data =  array(
				"LoginInfo" => array ( 
						"LoginName" => $this->user,
						"Salt" =>  $this->salt,
						"AuthHash" =>  md5( $this->user . "_".$this->salt. md5($this->pass) )   // algo   md5(user+md5(pass)) 
				),
				"Param"=>array(
						"v_user_name"=> "upie",
						"v_password"=>  "upie" 
						 )	
				);

		$data_json = json_encode($data);

		// exit;
		// echo "sebelum dikirim " . $data_json;
		$res = $this->execute_service2($this->url,"bpkb_login_web",$data_json);

		// echo "<hr />"; 
		 
		echo $res;

		 
	}


	function bpkb_add_operator(){
		$data =  array(
				"LoginInfo" => array ( 
						"LoginName" => $this->user,
						"Salt" =>  $this->salt,
						"AuthHash" =>  md5( $this->user . "_".$this->salt. md5($this->pass) )   // algo   md5(user+md5(pass)) 
				),
				"Param" => array(
						"v_polda_id"=>"1",
						"v_polres_id"=>"17",
						"v_petugas_id"=>"alexxxx",
						"v_nama"=>"66666",
						"v_nrp"=>"yyyyx",
						"v_pangkat"=>"yyxxx",
						"v_role_id"=>"ADMINISTRATOR",
						"v_password"=>"123"
				));
/*
 "v_polda_id":<string>,
						    "v_polres_id":<string>,
						    "v_petugas_id":<string>,
						    "v_nama":<string>,
						    "v_nrp":<string>,
						    "v_pangkat":<string>,
						    "v_role_id":<string>,
						    "v_password":<string>
*/
		$data_json = json_encode($data);

		// echo "sebelum dikirim " . $data_json;
		$res = $this->execute_service2($this->url,"bpkb_add_operator",$data_json);

		// echo "<hr />"; 
		header('Content-type: text/xml');
		echo $res;

		 
	}


function bpkb_edit_operator(){
		$data =  array(
				"LoginInfo" => array ( 
						"LoginName" => $this->user,
						"Salt" =>  $this->salt,
						"AuthHash" =>  md5( $this->user . "_".$this->salt. md5($this->pass) )   // algo   md5(user+md5(pass)) 
				),
				"Param" => array(
						"v_polda_id"=>"1",
						"v_polres_id"=>"17",
						"v_petugas_id"=>"sssssss",
						"v_nama"=>"66666",
						"v_nrp"=>"yyyyx",
						"v_pangkat"=>"yyxxx",
						"v_role_id"=>"ADMINISTRATOR",
						"v_password"=>"123"
				));

		$data_json = json_encode($data);

		// echo "sebelum dikirim " . $data_json;
		$res = $this->execute_service2($this->url,"bpkb_edit_operator",$data_json);

		// echo "<hr />"; 
		header('Content-type: text/xml');
		echo $res;

		 
	}


function bpkb_detail_operator(){
		$data =  array(
				"LoginInfo" => array ( 
						"LoginName" => $this->user,
						"Salt" =>  $this->salt,
						"AuthHash" =>  md5( $this->user . "_".$this->salt. md5($this->pass) )   // algo   md5(user+md5(pass)) 
				),
				"Param" => array(
						"v_administrator"=>"0",
						"v_op_id"=>"193"
						
				));

		$data_json = json_encode($data);

		// echo "sebelum dikirim " . $data_json;
		$res = $this->execute_service2($this->url,"bpkb_detail_operator",$data_json);

		// echo "<hr />"; 
		header('Content-type: text/xml');
		echo $res;

		 
	}



function bpkb_add_alat(){
		$data =  array(
				"LoginInfo" => array ( 
						"LoginName" => $this->user,
						"Salt" =>  $this->salt,
						"AuthHash" =>  md5( $this->user . "_".$this->salt. md5($this->pass) )   // algo   md5(user+md5(pass)) 
				),
				"Param" => array(
						"v_polda_id" =>  "1",
						"v_polres_id" =>  "17",
						"v_id_alat" =>  "APPL1",
						"v_nama_alat" =>  "LAPTOP APPLE",
						"v_lokasi" =>  "POLDA JABAR",
						"v_bloked" =>  0
						
				));

		$data_json = json_encode($data);

		// echo "sebelum dikirim " . $data_json;
		$res = $this->execute_service2($this->url,"bpkb_add_alat",$data_json);

		// echo "<hr />"; 
		header('Content-type: text/xml');
		echo $res;

		 
	}



function bpkb_edit_alat(){
		$data =  array(
				"LoginInfo" => array ( 
						"LoginName" => $this->user,
						"Salt" =>  $this->salt,
						"AuthHash" =>  md5( $this->user . "_".$this->salt. md5($this->pass) )   // algo   md5(user+md5(pass)) 
				),
				"Param" => array(
						"v_polda_id" =>  "17",
						"v_polres_id" =>  "1",
						"v_id_alat" =>  "APPL1",
						"v_nama_alat" =>  "LAPTOP APPLE",
						"v_lokasi" =>  "POLDA JABAR",
						"v_bloked" =>  0
						
				));

		$data_json = json_encode($data);

		// echo "sebelum dikirim " . $data_json;
		$res = $this->execute_service2($this->url,"bpkb_edit_alat",$data_json);

		// echo "<hr />"; 
		header('Content-type: text/xml');
		echo $res;

		 
	}



function bpkb_detail_alat(){
		$data =  array(
				"LoginInfo" => array ( 
						"LoginName" => $this->user,
						"Salt" =>  $this->salt,
						"AuthHash" =>  md5( $this->user . "_".$this->salt. md5($this->pass) )   // algo   md5(user+md5(pass)) 
				),
				"Param" => array(
						"v_polda_id" =>  "17",
						"v_polres_id" =>  "1"
						
				));

		$data_json = json_encode($data);

		// echo "sebelum dikirim " . $data_json;
		$res = $this->execute_service2($this->url,"bpkb_detail_alat",$data_json);

		// echo "<hr />"; 
		header('Content-type: text/xml');
		echo $res;

		 
	}

function add_m_group_hak_akses(){
		$data =  array(
				"LoginInfo" => array ( 
						"LoginName" => $this->user,
						"Salt" =>  $this->salt,
						"AuthHash" =>  md5( $this->user . "_".$this->salt. md5($this->pass) )   // algo   md5(user+md5(pass)) 
				),
				"Param" => array(
						"kode" =>  "REVIEWERXss",
						"ket" =>  "ADMIN REVIEWER",
						"polda_id" =>  "17",
						"polres_id" =>  "1"
						
				));

		$data_json = json_encode($data);

		// echo "sebelum dikirim " . $data_json;
		$res = $this->execute_service2($this->url,"add_m_group_hak_akses",$data_json);

		// echo "<hr />"; 
		header('Content-type: text/xml');
		echo $res;

		 
	}



function add_pemohon(){
		$data =  array(
				"LoginInfo" => array ( 
						"LoginName" => $this->user,
						"Salt" =>  $this->salt,
						"AuthHash" =>  md5( $this->user . "_".$this->salt. md5($this->pass) )   // algo   md5(user+md5(pass)) 
				),
				"Param" => array(				 

						"tgl_daftar"	=> "20151010",
						"pemohon_reg"   => "12131/41414/",
						"pemohon_nama"   =>  "Firmansyah",
						"company_id"   =>  "1",
						"bank_id"   =>  "1",
						"pemohon_rek"   =>  "3433355535",
						"pemohon_telp"   => "081328080020",
						"pemohon_hp"   => "3353535353",
						"pemohon_alamat"   => "Jakarta",
						"pemohon_jenis"   => "Jenis"
						
				));

		$data_json = json_encode($data);
		echo $data_json; exit;
		// echo "sebelum dikirim " . $data_json;
		$res = $this->execute_service2($this->url,"add_pemohon",$data_json);

		// echo "<hr />"; 
		header('Content-type: text/xml');
		echo $res;

		 
	}
	

function edit_pemohon(){
		$data =  array(
				"LoginInfo" => array ( 
						"LoginName" => $this->user,
						"Salt" =>  $this->salt,
						"AuthHash" =>  md5( $this->user . "_".$this->salt. md5($this->pass) )   // algo   md5(user+md5(pass)) 
				),
				"Param" => array(				 

						"tgl_daftar"	=> "20151010",
						"pemohon_reg"   => "12131/41414/",
						"pemohon_nama"   =>  "Firmansyah",
						"company_id"   =>  "1",
						"bank_id"   =>  "1",
						"pemohon_rek"   =>  "3433355535",
						"pemohon_telp"   => "081328080020",
						"pemohon_hp"   => "3353535353",
						"pemohon_alamat"   => "Jakarta",
						"pemohon_jenis"   => "Jenis",
						"pemohon_id" => "3029"
						
				));

		$data_json = json_encode($data);
		// echo $data_json; exit;
		// echo "sebelum dikirim " . $data_json;
		$res = $this->execute_service2($this->url,"edit_pemohon",$data_json);

		// echo "<hr />"; 
		header('Content-type: text/xml');
		echo $res;

		 
	}


function refresh_pemohon(){
		$data =  array(
				"LoginInfo" => array ( 
						"LoginName" => $this->user,
						"Salt" =>  $this->salt,
						"AuthHash" =>  md5( $this->user . "_".$this->salt. md5($this->pass) )   // algo   md5(user+md5(pass)) 
				));

		$data_json = json_encode($data);
		echo $data_json;
		//exit;
		// echo "sebelum dikirim " . $data_json;
		$res = $this->execute_service2($this->url,"refresh_pemohon",$data_json);

		// echo "<hr />"; 
		// header('Content-type: text/xml');
		echo $res;

		 
	}

function bpkb_pendaftaran_add(){
		$data =  array(
				"LoginInfo" => array ( 
						"LoginName" => $this->user,
						"Salt" =>  $this->salt,
						"AuthHash" =>  md5( $this->user . "_".$this->salt. md5($this->pass) )   // algo   md5(user+md5(pass)) 
				),
				"Param" => array(				 

						"vNoRangka"	=> "HMK35305305353",
						"vTglDaftar"   => "20151010",
						"vNoBPKB"   =>  "L353535",
						"vPemohonID"   =>  "1",
						"vPetugasID"   =>  "1",
						"vBarcodeBank"   =>  "3433355535",
						"vLoketNo"   => "1",
						"vEnrollmentType"   => "CKD",
						"vTypeDaftaran"   => "1",
						"vMerkID"   => "1"
						 
						
				));

		$data_json = json_encode($data);
		// echo $data_json; exit;
		// echo "sebelum dikirim " . $data_json;
		$res = $this->execute_service2($this->url,"bpkb_pendaftaran_add",$data_json);

		// echo "<hr />"; 
		header('Content-type: text/xml');
		echo $res;

		 
	}


function bpkb_pendaftaran_edit(){
		$data =  array(
				"LoginInfo" => array ( 
						"LoginName" => $this->user,
						"Salt" =>  $this->salt,
						"AuthHash" =>  md5( $this->user . "_".$this->salt. md5($this->pass) )   // algo   md5(user+md5(pass)) 
				),
				"Param" => array(				 

						"vNoRangka"	=> "HMK35305305353",
						"vTglDaftar"   => "20151010",
						"vNoBPKB"   =>  "L353535",
						"vPemohonID"   =>  "1",
						"vPetugasID"   =>  "1",
						"vBarcodeBank"   =>  "3433355535",
						"vLoketNo"   => "1",
						"vEnrollmentType"   => "CKD",
						"vTypeDaftaran"   => "1",
						"vMerkID"   => "1",
						"vDaftarID" => "1"
						 
						
				));

		$data_json = json_encode($data);
		echo $data_json; exit;
		// echo "sebelum dikirim " . $data_json;
		$res = $this->execute_service2($this->url,"bpkb_pendaftaran_edit",$data_json);

		// echo "<hr />"; 
		header('Content-type: text/xml');
		echo $res;

		 
	}


function bpkb_pendaftaran_delete(){
		$data =  array(
				"LoginInfo" => array ( 
						"LoginName" => $this->user,
						"Salt" =>  $this->salt,
						"AuthHash" =>  md5( $this->user . "_".$this->salt. md5($this->pass) )   // algo   md5(user+md5(pass)) 
				),
				"Param" => array(				 

						"vDaftarID"	=> "106",
						"vPetugasID"   => "UPIE" 
						 
						
				));

		$data_json = json_encode($data);
		echo $data_json; exit;
		// echo "sebelum dikirim " . $data_json;
		$res = $this->execute_service2($this->url,"bpkb_pendaftaran_delete",$data_json);

		// echo "<hr />"; 
		header('Content-type: text/xml');
		echo $res;

		 
	}




function list_pendaftaran(){
		$data =  array(
				"LoginInfo" => array ( 
						"LoginName" => $this->user,
						"Salt" =>  $this->salt,
						"AuthHash" =>  md5( $this->user . "_".$this->salt. md5($this->pass) )   // algo   md5(user+md5(pass)) 
				),
				"Param" => array(				 

						"v_tgl"	=> "20150102",
						"v_pemohon"   => "3029",
						"v_bbn1"   =>  "0"
						 
						 
						
				));

		$data_json = json_encode($data);
		echo $data_json; exit;
		// echo "sebelum dikirim " . $data_json;
		$res = $this->execute_service2($this->url,"list_pendaftaran",$data_json);

		// echo "<hr />"; 
		header('Content-type: text/xml');
		echo $res;

		 
	}


function stnk_login(){
		$data =  array(
				"LoginInfo" => array ( 
						"LoginName" => $this->user,
						"Salt" =>  $this->salt,
						"AuthHash" =>  md5( $this->user . "_".$this->salt. md5($this->pass) )   // algo   md5(user+md5(pass)) 
				),
				"Param"=>array(
						"v_user_name"=> "upie",
						"v_password"=>  "upie",
						"v_id_alat" => 	"000306C3-1082086226-7FDAFBBF-BFEBFBFF")	
				);

		$data_json = json_encode($data);
		// echo $data_json; exit;
		// echo "sebelum dikirim " . $data_json;
		$res = $this->execute_service2($this->url,"stnk_login",$data_json);

		// echo "<hr />"; 
		//header('Content-type: text/xml');
		echo $res;

		 
	}

function stnk_add(){
		$data =  array(
				"LoginInfo" => array ( 
						"LoginName" => $this->user,
						"Salt" =>  $this->salt,
						"AuthHash" =>  md5( $this->user . "_".$this->salt. md5($this->pass) )   // algo   md5(user+md5(pass)) 
				),
				"Param" => array(				 
					    "vNO_BPKB" => "G 1905745 M",
						"vNO_STNK" => "13",
						"vNREG_STNK" => "123456789x",
						"vTGL_STNK" => "20160215",
						"vTGL_STNK_TO" => "20210215",
						"vENTRY_BY" => "upie",
						"vENTRY_DATE" => "20150215",
						"vPOLDA_ID" => "19",
						"vPOLRES_ID" => "1",
						"vSAMSAT_ID" => "1",
						"vSNHDD" => "D2CC3ED4-87011230-8B14E018-77C5F83D",
						"vPEMOHON_ID" => "1524",
						"vJenis" => "0",
						"vNAMA_PEMILIK" => "TIKA IRIYANA WN",
						"vALAMAT_PEMILIK" => "JL.AES NASUTION GG.MUFAKAT RT.011/004 GADANG 
BANJARMASIN TENGAH KOTA BANJARMASIN
" ));
        $data_json = json_encode($data);
		//echo $data_json; exit;
		// echo "sebelum dikirim " . $data_json;
		$res = $this->execute_service2($this->url,"stnk_add",$data_json);

		// echo "<hr />"; 
		//header('Content-type: text/xml');
		echo $res;

		 
	}


function stnk_get_data(){
		$data =  array(
				"LoginInfo" => array ( 
						"LoginName" => $this->user,
						"Salt" =>  $this->salt,
						"AuthHash" =>  md5( $this->user . "_".$this->salt. md5($this->pass) )   // algo   md5(user+md5(pass)) 
				),
				"Param" => array(				 

						"v_is_cari"	=> "2",
						"v_cari"   => "DA 2686 VF"
				));

		$data_json = json_encode($data);
		//echo $data_json; exit;
		// echo "sebelum dikirim " . $data_json;
		$res = $this->execute_service2($this->url,"stnk_get_data",$data_json);

		// echo "<hr />"; 
		//header('Content-type: text/xml');
		echo $res; 
	}




function stnk_get_data_for_edit(){
		$data =  array(
				"LoginInfo" => array ( 
						"LoginName" => $this->user,
						"Salt" =>  $this->salt,
						"AuthHash" =>  md5( $this->user . "_".$this->salt. md5($this->pass) )   // algo   md5(user+md5(pass)) 
				),
				"Param" => array(				 

						"v_cari"   => "37"
				));

		$data_json = json_encode($data);
		//echo $data_json; exit;
		// echo "sebelum dikirim " . $data_json;
		$res = $this->execute_service2($this->url,"stnk_get_data_for_edit",$data_json);

		// echo "<hr />"; 
		//header('Content-type: text/xml');
		echo $res; 
	}


function stnk_list_registrasi(){
		$data =  array(
				"LoginInfo" => array ( 
						"LoginName" => $this->user,
						"Salt" =>  $this->salt,
						"AuthHash" =>  md5( $this->user . "_".$this->salt. md5($this->pass) )   // algo   md5(user+md5(pass)) 
				),
				"Param" => array(		
				        "v_is_cari" => "0",		 
						"v_tgl"	=> "20160209",
						"v_tgl2"   => "20160215",
						"v_snhdd"	=> "D2CC3ED4-87011230-8B14E018-77C5F83D",
						"v_user_id"   => "upie"
				));

		$data_json = json_encode($data);
		//echo $data_json; exit;
		// echo "sebelum dikirim " . $data_json;
		$res = $this->execute_service2($this->url,"stnk_list_registrasi",$data_json);

		// echo "<hr />"; 
		//header('Content-type: text/xml');
		echo $res; 
	}

function execute_service2($url,$method,$json_data) {


	// echo $json_data; exit;

	// echo $json_data; exit;
	$req_url = $url."/".$method;
 	$ch = curl_init();

 	//print_r($json_data); exit;
	//set the url, number of POST vars, POST data


 	$post_data = array("data"=>$json_data);
	curl_setopt($ch,CURLOPT_URL, $req_url);
	//curl_setopt($ch,CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($ch,CURLOPT_POST, 1);
	curl_setopt($ch,CURLOPT_POSTFIELDS, $post_data);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	// curl_setopt($ch, CURLINFO_HEADER_OUT, true); // enable tracking
	//execute post
	$result = curl_exec($ch);


// $headerSent = curl_getinfo($ch, CURLINFO_HEADER_OUT ); // request headers

// echo $headerSent; exit;

	// $obj  = json_decode($result);
	// $array = (array) $obj;
	// 
	curl_close($ch);
	// return $array;
	return $result;
}

function stnk_ambil(){
		$data =  array(
				"LoginInfo" => array ( 
						"LoginName" => $this->user,
						"Salt" =>  $this->salt,
						"AuthHash" =>  md5( $this->user . "_".$this->salt. md5($this->pass) )   // algo   md5(user+md5(pass)) 
				),
				"Param" => array(		
				       array(
							"vSTNK_ID"  => '35', 
							"vNO_STNK"  =>  '151',
							"vUSER"  => 'upie',
							"vTGL"  => '20160303',
							"vKODE_SERAH"  =>'1'),
				       array(
							"vSTNK_ID"  => '15', 
							"vNO_STNK"  =>  '1356953',
							"vUSER"  => 'upie',
							"vTGL"  => '20160303',
							"vKODE_SERAH"  =>'1'),
				       array(
							"vSTNK_ID"  => '16', 
							"vNO_STNK"  =>  '1356951',
							"vUSER"  => 'upie',
							"vTGL"  => '20160303',
							"vKODE_SERAH"  =>'1')
				       
				));

       
                                       



		$data_json = json_encode($data);
		echo $data_json;  
		echo "sebelum dikirim " . $data_json;
		$res = $this->execute_service2($this->url,"stnk_ambil",$data_json);

		// echo "<hr />"; 
		//header('Content-type: text/xml');
		echo $res; 
	}

function stnk_list_registrasi_print(){
		$data =  array(
				"LoginInfo" => array ( 
						"LoginName" => $this->user,
						"Salt" =>  $this->salt,
						"AuthHash" =>  md5( $this->user . "_".$this->salt. md5($this->pass) )   // algo   md5(user+md5(pass)) 
				),
				"Param" => array(				 

					 
						"v_is_cari" => "1",
						"v_tgl" => "20160401",
						"v_tgl2" => "20160426",
						"v_snhdd" => "D2CC3ED4-87011230-8B14E018-77C5F83D",
						"v_user_id" => "upie"
				));

		$data_json = json_encode($data);
		//echo $data_json; exit;
		// echo "sebelum dikirim " . $data_json;
		$res = $this->execute_service2($this->url,"stnk_list_registrasi_print",$data_json);

		// echo "<hr />"; 
		//header('Content-type: text/xml');
		echo $res; 
	}





}
?>
