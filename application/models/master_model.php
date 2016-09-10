<?php 

class master_model extends ORA_Model{

function master_model(){
		parent::__construct();
	}

function refresh_pemohon($PEMOHON_JENIS){
	$sql="SELECT PEMOHON_ID,PEMOHON_REG,PEMOHON_NAMA,COMPANY_ID,BANK_ID,
	PEMOHON_REK,PEMOHON_TELP,PEMOHON_HP,PEMOHON_ALAMAT, TO_CHAR(TGL_DAFTAR,'YYYYMMDD') TGL_DAFTAR,
	STATUS,USER_ENTRY,TO_CHAR(TGL_ENTRY,'YYYYMMDD') TGL_ENTRY,PEMOHON_JENIS FROM M_PEMOHON";

	if(!empty($PEMOHON_JENIS)) {
		$sql .= " WHERE PEMOHON_JENIS='$PEMOHON_JENIS'";
	} 
 	 
   
   

	$rs_bb = $this->db->query($sql);	 
	// echo $this->db->last_query(); exit;
	
	if($rs_bb) {
		$ret = array("result"=>"true");
		foreach($rs_bb->result_array() as $row_bb) : 
		$ret['M_PEMOHON'][] = $row_bb;
		endforeach;
	}
	else {
		$ret = array("result"=>"false","message_err"=>"DB QEURY EROR","message"=>"");
	}

	return $ret;
}




function bpkb_list_perusahaan_web(){
	
	try {
          
           $data =  $this->readCursor("bpkb_list_perusahaan_web(:refc)",array());
            // show_array($data); exit;
            //$ret = array("result"=>"true","message"=>$data);
            if(count($data)==0){
            	$ret = array("result"=>"false","message_err"=>"DATA NOT FOUND","message"=>"");
            }
            else {
            	$ret = array("result"=>"true","message"=>array("bpkb_list_perusahaan_web"=>$data) , "message_err"=>"");
            }
        } 
        catch(exception $ex){
          $ret = array("result"=>"false","message_err"=>"DATABASE ERROR","message"=>"");
        }
    return $ret; 
}



function bpkb_add_company_web($data){
		$sql="select bpkb_add_company_web('$data->v_nama_company'	 
		) as msg from dual";
	// echo "test..";

		$result = $this->call_function($sql);
		// show_array($result); 
		// exit;
		if($result['MSG'] <> 'error') { 
		//$tmp = explode("#",$result['MSG']);
			if($result['MSG']=="00"){
				$ret = array("result"=>"true","message"=>'DATA BERHASIL SIMPAN',"message_err"=>"");
			}
			else {
				$ret = array("result"=>"false","message"=>"","message_err"=>"DATA GAGAL DIHAPUS ".$result['MSG']);
			}
		 }
		 else{

		 	$ret = array("result"=>"false","message"=>"","message_err"=>"Error DB");
		 }

		 return $ret;
}


function bpkb_add_pemohon_web($data){
	$sql="select bpkb_add_operator(
		'$data->v_polda_id',
		'$data->v_polres_id',
		'$data->v_petugas_id',
		'$data->v_nama',
		'$data->v_nrp',
		'$data->v_pangkat',
		'$data->v_role_id',
		'$data->v_password'
		) as msg from dual";
	// echo "test..";

		$result = $this->call_function($sql);
		// show_array($result); 
		// exit;
		if($result['MSG'] <> 'error') { 
		$tmp = explode("#",$result['MSG']);
			if($tmp[0]=="00"){
				$ret = array("result"=>"true","message"=>$tmp[1],"message_err"=>"");
			}
			else {
				$ret = array("result"=>"false","message"=>"","message_err"=>$tmp[1]);
			}
		 }
		 else{

		 	$ret = array("result"=>"false","message"=>"","message_err"=>"Error DB");
		 }

		 return $ret;

}


}



?>