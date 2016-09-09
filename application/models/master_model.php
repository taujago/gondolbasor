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


}



?>