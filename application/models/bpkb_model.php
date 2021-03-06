<?php
class bpkb_model extends ORA_Model {
	function bpkb_model(){
		parent::__construct();
	}





function escape($x)
{

  $tmp = new stdClass();

  foreach($x as $idx => $a):
	// echo "avriabel a $idx  ".$a . "\n\r"; 
	$tmp->{$idx} = str_replace("'","''",$a);
	
  endforeach; 

  //print_r($tmp); 
  return $tmp;

}



function bpkb_login_web($data){

	$sql="select bpkb_login_web(
		'$data->v_user_name',
		'$data->v_password' 
		
		) as msg from dual";

	 
	// echo "test..";

		$result = $this->call_function($sql);
		// show_array($result); 
		// exit;
		if($result['MSG'] <> 'error') { 
		$tmp = explode("#",$result['MSG']);
			if($tmp[0]=="1"){
				

				$xtmp = explode("|", $tmp[1]); 

				$xmessage['vl_op_id']   = $xtmp[0];
				$xmessage['vl_op_login']   = $xtmp[1];
				$xmessage['vl_op_authhash']   = $xtmp[2];
				$xmessage['vl_op_nama']   = $xtmp[3];
				$xmessage['vl_op_initial']   = $xtmp[4];
				$xmessage['vl_op_nrp']   = $xtmp[5];
				$xmessage['vl_op_lastlogindate']   = $xtmp[6];
				$xmessage['vl_op_pangkat']   = $xtmp[7];
				$xmessage['vl_wilayah_id']   = $xtmp[8];
				$xmessage['vl_polda_id']   = $xtmp[9];
				$xmessage['vl_polres_id']   = $xtmp[10];
				$xmessage['vl_level_akses']   = $xtmp[11];
				$xmessage['vl_blocked']   = $xtmp[12];
				$xmessage['vl_tgl']   = $xtmp[13];
				$xmessage['vl_awalan_tnkb']   = $xtmp[14];
				$xmessage['vl_seri_bpkb']   = $xtmp[15];
				$xmessage['vl_kode_wil_bpkb']   = $xtmp[16];
				$xmessage['vl_akhiran_noreg']   = $xtmp[17];
				$xmessage['vl_tempat_keluar_bpkb']   = $xtmp[18];
				$xmessage['vl_bpkb_dikeluarkan_oleh']   = $xtmp[19];
				$xmessage['vl_pnbpr2']   = $xtmp[20];
				$xmessage['vl_pnbpr4']   = $xtmp[21];
				$xmessage['vl_toleransi_koordinat']   = $xtmp[22];
				$xmessage['vl_tanggal']   = $xtmp[23];
				$xmessage['vl_lama_rekom']   = $xtmp[24];
				$xmessage['vl_lama_rekom_sementara']   = $xtmp[25];
				$ret = array("result"=>"true","message"=>$xmessage,"message_err"=>"");

			}

			else {
				$ret = array("result"=>"false","message"=>"","message_err"=>$tmp[1]);
			}
		 }
		 else{

		 	$ret = array("result"=>"false","message"=>"","message_err"=>"Error DB");
		 }

		 //show_array($rest);

		 return $ret;

}




function list_pendaftaran($param){
	 
		try {
            $variables[0] = array("parameter" => "p1", "value" => $param->v_tgl);
            $variables[1] = array("parameter" => "p2", "value" => $param->v_pemohon);
            $variables[2] = array("parameter" => "p3", "value" => $param->v_bbn1);
            $data =  $this->readCursor("list_pendaftaran(:p1, :p2, :p3, :refc)", $variables);
            // show_array($data); exit;
            //$ret = array("result"=>"true","message"=>$data);
            if(count($data)==0){
            	$ret = array("result"=>"false","message_err"=>"DATA NOT FOUND","message"=>"");
            }
            else {
            	$ret = array("result"=>"true","message"=>array("list_pendaftaran"=>$data) , "message_err"=>"");
            }
        } 
        catch(exception $ex){
          $ret = array("result"=>"false","message_err"=>"DATABASE ERROR","message"=>"");
        }
        return $ret;
}




function bpkb_pendaftaran_add($data){
		$sql="select bpkb_pendaftaran_add(
		'$data->vNoRangka',
		'$data->vTglDaftar',
		'$data->vNoBPKB',
		'$data->vPemohonID',
		'$data->vPetugasID',
		'$data->vBarcodeBank',
		'$data->vLoketNo',
		'$data->vEnrollmentType',
		'$data->vTypeDaftaran',
		'$data->vMerkID'
		) as msg from dual";
	// echo "test..";

		echo "sql $sql <br />"; exit;

		$result = $this->call_function($sql);
		// show_array($result); 
		// exit;
		if($result['MSG'] <> 'error') { 
		$tmp = explode("#",$result['MSG']);
			if($tmp[0]=="00"){
				$ret = array("result"=>"true","message"=>$tmp[1],"message_err"=>"");
			}
			else {
				$ret = array("result"=>"false","message"=>"","message_err"=>$result['MSG']);
			}
		 }
		 else{

		 	$ret = array("result"=>"false","message"=>"","message_err"=>"Error DB");
		 }

		 return $ret;
}



}

?>