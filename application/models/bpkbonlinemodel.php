<?php 
class bpkbonlinemodel extends ORA_Model{

	function bpkbonlinemodel(){
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


	function query(){

		$sql="DELETE FROM TEST";
		$res = $this->db->query($sql);

		$sql="select bpkb_add_operator(
		'1',
		'17',
		'xxxxx',
		'xxxxx',
		'xxxx',
		'brigadir',
		'administrator',
		'1q2w3e4r'
		) as msg from dual";
		$res = $this->db->query($sql);
		echo " query ".$this->db->last_query();

		if($res){
			echo "berashiL";
			$datax = $res->row();
			echo "pesan " . $datax->MSG . "<br />";
		}
		else {
			echo "gagal";
		}
	}


function bpkb_add_operator($data){
		//$data = $this->data;

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
 




function bpkb_login($data){
		//$data = $this->data;

	$sql="select bpkb_login(
		'$data->v_user_name',
		'$data->v_password',
		'$data->v_id_alat'
		
		) as msg from dual";
// echo $sql; exit;
	// echo "test..";

		$result = $this->call_function($sql);
		// show_array($result); 
		// exit;
		if($result['MSG'] <> 'error') { 
		$tmp = explode("#",$result['MSG']);
			if($tmp[0]=="1"){
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
 

function bpkb_edit_operator($data){
		//$data = $this->data;

	$sql="select bpkb_edit_operator(
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


function bpkb_detail_operator($param){

	if($param->v_administrator == "0") {
		$this->db->where("OP_ID",$param->v_op_id);
	}
	$res = $this->db->get("T_OPERATOR");

	if($res->num_rows() == 0){
		$return = array("result"=>"false",
			  			"message"=>"","message_err"=>"DATA TIDAK DITEMUKAN");
	}
	else {
		// echo "jumlah baris " . $res->num_rows();
		$return = array("result"=>"true");
		foreach($res->result_array() as $row) : 
			$return['message'][] = $row;
		endforeach;
	}
	// show_array($return);
	return $return;

}


function bpkb_add_alat($param) {

	$arr_data['ID_ALAT']  = $param->v_id_alat;
	$arr_data['NAMA_ALAT']  = $param->v_nama_alat;
	$arr_data['LOKASI'] = $param->v_lokasi;
	$arr_data['BLOCKED']  = $param->v_bloked;
	$arr_data['POLDA_ID']  = $param->v_polda_id;
	$arr_data['POLRES_ID']   = $param->v_polres_id;

	$this->db->where("ID_ALAT",$param->v_id_alat);
	$jumlah  = $this->db->get("T_ALAT")->num_rows();
	if($jumlah==0) { // input baru 

		$res = $this->db->insert("T_ALAT",$arr_data);
		if($res){
			$result = array("result"=>"true","message"=>"DATA ALAT BERHASIL DISIMPAN");
		}
		else {
			$result = array("result"=>"false","message"=>"", "message_err"=>"DATA ALAT GAGAL DISIMPAN");
		}
	}
	else { 
	$result = array("result"=>"false","message"=>"", "message_err"=>"DATA ALAT SUDAH ADA");
	}
	return $result;
}




function bpkb_edit_alat($param) {

	$arr_data['ID_ALAT']  = $param->v_id_alat;
	$arr_data['NAMA_ALAT']  = $param->v_nama_alat;
	$arr_data['LOKASI'] = $param->v_lokasi;
	$arr_data['BLOCKED']  = $param->v_bloked;
	$arr_data['POLDA_ID']  = $param->v_polda_id;
	$arr_data['POLRES_ID']   = $param->v_polres_id;

	$this->db->where("ID_ALAT",$param->v_id_alat);
	$jumlah  = $this->db->get("T_ALAT")->num_rows();
	if($jumlah==1) { // input baru 

		$this->db->where("ID_ALAT",$param->v_id_alat);
		$res = $this->db->update("T_ALAT",$arr_data);
		if($res){
			$result = array("result"=>"true","message"=>"DATA ALAT BERHASIL DIUPDATE");
		}
		else {
			$result = array("result"=>"false","message"=>"", "message_err"=>"DATA ALAT GAGAL DIUPDATE");
		}
	}
	else { 
	$result = array("result"=>"false","message"=>"", "message_err"=>"DATA ALAT TIDAK DITEMUKAN");
	}
	return $result;
}



function bpkb_detail_alat($param){

	/*
	v_polda_id
v_polres_id
	*/
	$this->db->where("POLDA_ID",$param->v_polda_id);
	$this->db->where("POLRES_ID",$param->v_polres_id);
	
	$res = $this->db->get("T_ALAT");

	if($res->num_rows() == 0){
		$return = array("result"=>"false",
			  			"message"=>"","message_err"=>"DATA TIDAK DITEMUKAN");
	}
	else {
		// echo "jumlah baris " . $res->num_rows();
		$return = array("result"=>"true");
		foreach($res->result_array() as $row) : 
			$return['message'][] = $row;
		endforeach;
	}
	// show_array($return);
	return $return;

}

function bpkb_role_menu($param){
	$return = array();
	$this->db->select('KODE,KET')->from("M_GROUP_HAK_AKSES");
	$this->db->where("POLDA_ID",$param->v_polda_id);
	$this->db->where("POLRES_ID",$param->v_polres_id);
	$rs_role = $this->db->get();
	// echo $this->db->last_query();
	foreach($rs_role->result_array() as $row) : 
		$return['data_role'][] =  $row;
	endforeach;

	$this->db->select('KODE_SUB_GROUP,NAMA_SUB_GROUP,
	IS_PILIH,NAMA_GROUP,KODE_GROUP')
	->from("M_MENU_APLIKASI_BPKB");
	$this->db->order_by("KODE_GROUP,KODE_SUB_GROUP");
	$rs_menu = $this->db->get();
	foreach($rs_menu->result_array() as $row) : 
		$return['data_menu'][] =  $row;
	endforeach;

	return $return;

}

function add_m_group_hak_akses($param) {
	//kode,ket,polda_id,polres_id
	$arr['KODE'] = $param->kode;
	$arr['KET'] = $param->ket;
	$arr['POLDA_ID'] = $param->polda_id;
	$arr['POLRES_ID'] = $param->polres_id;

	$res = $this->db->insert("M_GROUP_HAK_AKSES",$arr);
	// echo $this->db->last_query();
	if($res){
		$return  = array("result"=>"true","message"=>"HAK AKSES BERHASIL DISIMPAN","message_err"=>"");
	}
	else {
		$return  = array("result"=>"false","message"=>"","message_err"=>"GAGAL SIMAPAN DATABASE ERROR");
	}
	return $return;

}


function data_master(){
	  
	// $sql=" select atpm_id,atpm_nama from m_atpm;";
	// 1. atpm 
	$this->db->select('ATPM_ID, ATPM_NAMA')
	->from("M_ATPM");
	$rs_atpm = $this->db->get();
	$ret = array("result"=>"true");
	foreach($rs_atpm->result_array() as $row_atpm) : 
		$ret['M_ATPM'][] = $row_atpm;
	endforeach;

// 2. bahan bakar
 	$this->db->select('BB_ID, BB_NAMA')
	->from("M_BAHANBAKAR");
	$rs_bb = $this->db->get();	 
	foreach($rs_bb->result_array() as $row_bb) : 
		$ret['M_BAHANBAKAR'][] = $row_bb;
	endforeach;


// 3. import select impmthd_id,impmthd_name,impmthd_description from m_cara_impor;
	$this->db->select('IMPMTHD_ID, IMPMTHD_NAME, IMPMTHD_DESCRIPTION')
	->from("M_CARA_IMPOR");
	$rs_bb = $this->db->get();	 
	// echo $this->db->last_query(); 
	foreach($rs_bb->result_array() as $row_bb) : 
		$ret['M_CARA_IMPOR'][] = $row_bb;
	endforeach;


//  4. company select company_id,company_nama from m_company;
	$this->db->select('COMPANY_ID, COMPANY_NAMA')
	->from("M_COMPANY");
	$rs_bb = $this->db->get();	 
	// echo $this->db->last_query(); 
	foreach($rs_bb->result_array() as $row_bb) : 
		$ret['M_COMPANY'][] = $row_bb;
	endforeach;


//  5. select dealer_id,dealer_nama,dealer_aktif,dealer_snhdd,dealer_key,pnbp_r2,pnbp_r4 from m_dealer;
	$this->db->select('DEALER_ID,DEALER_NAMA,DEALER_AKTIF,DEALER_SNHDD,DEALER_KEY,PNBP_R2,PNBP_R4')
	->from("M_DEALER");
	$rs_bb = $this->db->get();	 
	// echo $this->db->last_query(); 
	foreach($rs_bb->result_array() as $row_bb) : 
		$ret['M_DEALER'][] = $row_bb;
	endforeach;


//  6. select jenis_id,jenis_nama from m_jenis;
	$this->db->select(' JENIS_ID,JENIS_NAMA ')
	->from("M_JENIS");
	$rs_bb = $this->db->get();	 
	// echo $this->db->last_query(); 
	foreach($rs_bb->result_array() as $row_bb) : 
		$ret['M_JENIS'][] = $row_bb;
	endforeach;


//  7. select jd_id,jd_nama from m_jenis_daftaran
	$this->db->select('JD_ID,JD_NAMA ')
	->from("M_JENIS_DAFTARAN");
	$rs_bb = $this->db->get();	 
	// echo $this->db->last_query(); 
	foreach($rs_bb->result_array() as $row_bb) : 
		$ret['M_JENIS_DAFTARAN'][] = $row_bb;
	endforeach;


//  8. select merk_id,merk_nama,r2,merk_nama_r from m_merk;
	$this->db->select('MERK_ID,MERK_NAMA,R2,MERK_NAMA_R')
	->from("M_MERK");
	$rs_bb = $this->db->get();	 
	// echo $this->db->last_query(); 
	foreach($rs_bb->result_array() as $row_bb) : 
		$ret['M_MERK'][] = $row_bb;
	endforeach;

//  9. select model_id,model_nama,jenis_id from m_model;
	$this->db->select('MODEL_ID,MODEL_NAMA,JENIS_ID')
	->from("M_MODEL");
	$rs_bb = $this->db->get();	 
	// echo $this->db->last_query(); 
	foreach($rs_bb->result_array() as $row_bb) : 
		$ret['M_MODEL'][] = $row_bb;
	endforeach;

//  10. select pemohon_id,pemohon_reg,pemohon_nama,company_id,bank_id,pemohon_rek,pemohon_telp,pemohon_hp,pemohon_alamat,to_char(tgl_daftar,'yyyymmdd') tgl_daftar,status,user_entry,to_char(tgl_entry,'yyyymmdd') tgl_entry,pemohon_jenis from m_pemohon;
	 
	$sql="select PEMOHON_ID,PEMOHON_REG,PEMOHON_NAMA,COMPANY_ID,BANK_ID,
		PEMOHON_REK,PEMOHON_TELP,PEMOHON_HP,
		PEMOHON_ALAMAT,TO_CHAR(TGL_DAFTAR,'YYYYMMDD') TGL_DAFTAR,STATUS,
		USER_ENTRY,TO_CHAR(TGL_ENTRY,'YYYYMMDD') TGL_ENTRY,PEMOHON_JENIS FROM M_PEMOHON";
	 
	$rs_bb = $this->db->query($sql);	 
	// echo $this->db->last_query(); 
	foreach($rs_bb->result_array() as $row_bb) : 
		$ret['M_PEMOHON'][] = $row_bb;
	endforeach;



//  11.  SELECT PEMOHON_NAMA,PEMOHON_ALAMAT,PEMOHON_KOTA FROM M_PEMOHON_BLOKIR2
	 
	$sql="SELECT PEMOHON_NAMA,PEMOHON_ALAMAT,PEMOHON_KOTA FROM M_PEMOHON_BLOKIR2";
	 
	$rs_bb = $this->db->query($sql);	 
	// echo $this->db->last_query(); 
	foreach($rs_bb->result_array() as $row_bb) : 
		$ret['M_PEMOHON_BLOKIR2'][] = $row_bb;
	endforeach;
	//return $ret;


// 12. 
	$sql="SELECT PRB_ID,NAMA_PRB,RBH_NAMA,RBH_ALAMAT,RBH_WARNA,RBH_NOPOL,RBH_MODEL,
	ENABLED,KD_AWAL,KD_AKHIR,RBH_MESIN,RBH_DASAR FROM M_PERUBAHAN";
	 
	$rs_bb = $this->db->query($sql);	 
	// echo $this->db->last_query(); 
	foreach($rs_bb->result_array() as $row_bb) : 
		$ret['M_PERUBAHAN'][] = $row_bb;
	endforeach;


// 13. 
	$sql="SELECT PRT_ID,PRT_NAMA FROM M_PERUNTUKAN";
	 
	$rs_bb = $this->db->query($sql);	 
	// echo $this->db->last_query(); 
	foreach($rs_bb->result_array() as $row_bb) : 
		$ret['M_PERUNTUKAN'][] = $row_bb;
	endforeach;


// 14. 
	$sql=" SELECT POLDA_ID,POLDA_NAMA FROM M_POLDA";
	 
	$rs_bb = $this->db->query($sql);	 
	// echo $this->db->last_query(); 
	foreach($rs_bb->result_array() as $row_bb) : 
		$ret['M_POLDA'][] = $row_bb;
	endforeach;

 
// 15. 
	$sql=" SELECT POLRES_ID,POLRES_NAMA,POLRES_KODE,POLDA_ID FROM M_POLRES";
	 
	$rs_bb = $this->db->query($sql);	 
	// echo $this->db->last_query(); 
	foreach($rs_bb->result_array() as $row_bb) : 
		$ret['M_POLRES'][] = $row_bb;
	endforeach;


// 16. 
	$sql=" SELECT WARNA_ID,WARNA_NAMA FROM M_WARNA";
	 
	$rs_bb = $this->db->query($sql);	 
	// echo $this->db->last_query(); 
	foreach($rs_bb->result_array() as $row_bb) : 
		$ret['M_WARNA'][] = $row_bb;
	endforeach;

// 17. 
	$sql=" SELECT WK_ID,WK_NAMA,EXISTING_ARC_NO,WK_COLOR FROM M_WARNA_KARTU";
	 
	$rs_bb = $this->db->query($sql);	 
	// echo $this->db->last_query(); 
	foreach($rs_bb->result_array() as $row_bb) : 
		$ret['M_WARNA_KARTU'][] = $row_bb;
	endforeach;


// 18. 
	$sql="SELECT WARNATNKB_ID,WARNATNKB FROM M_WARNATNKB";
	 
	$rs_bb = $this->db->query($sql);	 
	// echo $this->db->last_query(); 
	foreach($rs_bb->result_array() as $row_bb) : 
		$ret['M_WARNATNKB'][] = $row_bb;
	endforeach;


// 19. 
	$sql=" SELECT WILAYAH_ID,WILAYAH_NAMA,WILAYAH_KODE,WC_ID FROM M_WILAYAH";
	 
	$rs_bb = $this->db->query($sql);	 
	// echo $this->db->last_query(); 
	foreach($rs_bb->result_array() as $row_bb) : 
		$ret['M_WILAYAH'][] = $row_bb;
	endforeach;

// 20. 
	$sql=" SELECT WC_ID,WC_NAMA,ORD_NO FROM M_WILAYAH_GROUP";
	 
	$rs_bb = $this->db->query($sql);	 
	// echo $this->db->last_query(); 
	foreach($rs_bb->result_array() as $row_bb) : 
		$ret['M_WILAYAH_GROUP'][] = $row_bb;
	endforeach;

// 21. 
	$sql="SELECT MERK,TIPE,JENIS,MODEL,THN_BUAT,NO_RANGKA,NO_MESIN,JML_RODA,
	JML_SUMBU,SILINDER,BHN_BAKAR,JNS_DAFTARAN,
	CARA_IMPOR,NAMA_IMPORTIR,
	KETR_PABEAN,TIPE2 FROM T_REFTYPE ORDER BY NO_RANGKA";
	 
	$rs_bb = $this->db->query($sql);	 
	// echo $this->db->last_query(); 
	foreach($rs_bb->result_array() as $row_bb) : 
		$ret['T_REFTYPE'][] = $row_bb;
	endforeach;



	return $ret;



}

function add_pemohon($param) {

	//$data = array($param);
	$this->db->set('TGL_DAFTAR', "to_date($param->tgl_daftar,'yyyymmdd')",false); 
	$this->db->set('PEMOHON_REG', $param->pemohon_reg); 
	$this->db->set('PEMOHON_NAMA', $param->pemohon_nama); 
	$this->db->set('COMPANY_ID', $param->company_id); 
	$this->db->set('BANK_ID', $param->bank_id); 
	$this->db->set('PEMOHON_REK', $param->pemohon_rek); 
	$this->db->set('PEMOHON_TELP', $param->pemohon_telp); 
	$this->db->set('PEMOHON_HP', $param->pemohon_hp); 
	$this->db->set('PEMOHON_ALAMAT', $param->pemohon_alamat); 
	$this->db->set('PEMOHON_JENIS', $param->pemohon_jenis); 
	$this->db->set('STATUS', 1); 



	$res = $this->db->insert("M_PEMOHON");
	// echo $this->db->last_query();

	if($res){
		$ret = array("result"=>"true","message"=>"PEMOHON BERHASIL DISIMPAN","message_err"=>"");
	}
	else {
		$ret = array("result"=>"false","message_err"=>"PEMOHON GAGAL  DISIMPAN","message"=>"");
	}
	return $ret;


}

function edit_pemohon($param) {

	//$data = array($param);
	$this->db->set('TGL_DAFTAR', "to_date($param->tgl_daftar,'yyyymmdd')",false); 
	$this->db->set('PEMOHON_REG', $param->pemohon_reg); 
	$this->db->set('PEMOHON_NAMA', $param->pemohon_nama); 
	$this->db->set('COMPANY_ID', $param->company_id); 
	$this->db->set('BANK_ID', $param->bank_id); 
	$this->db->set('PEMOHON_REK', $param->pemohon_rek); 
	$this->db->set('PEMOHON_TELP', $param->pemohon_telp); 
	$this->db->set('PEMOHON_HP', $param->pemohon_hp); 
	$this->db->set('PEMOHON_ALAMAT', $param->pemohon_alamat); 
	$this->db->set('PEMOHON_JENIS', $param->pemohon_jenis); 


	$this->db->where("PEMOHON_ID", $param->pemohon_id);
	$res = $this->db->update("M_PEMOHON");
	// echo $this->db->last_query();

	if($res){
		$ret = array("result"=>"true","message"=>"PEMOHON BERHASIL DIUPDATE","message_err"=>"");
	}
	else {
		$ret = array("result"=>"false","message_err"=>"PEMOHON GAGAL  DIUPDATE","message"=>"");
	}
	return $ret;


}


function refresh_pemohon(){
	$sql="SELECT PEMOHON_ID,PEMOHON_REG,PEMOHON_NAMA,COMPANY_ID,BANK_ID,
	PEMOHON_REK,PEMOHON_TELP,PEMOHON_HP,PEMOHON_ALAMAT, TO_CHAR(TGL_DAFTAR,'YYYYMMDD') TGL_DAFTAR,
	STATUS,USER_ENTRY,TO_CHAR(TGL_ENTRY,'YYYYMMDD') TGL_ENTRY,PEMOHON_JENIS FROM M_PEMOHON";
	 

	$rs_bb = $this->db->query($sql);	 
//	echo $this->db->last_query(); exit;
	
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


function bpkb_pendaftaran_edit($data){
		$sql="select bpkb_pendaftaran_edit(
		'$data->vNoRangka',
		'$data->vTglDaftar',
		'$data->vNoBPKB',
		'$data->vPemohonID',
		'$data->vPetugasID',
		'$data->vBarcodeBank',
		'$data->vLoketNo',
		'$data->vEnrollmentType',
		'$data->vTypeDaftaran',
		'$data->vMerkID',
		'$data->vMerkID'
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
				$ret = array("result"=>"false","message"=>"","message_err"=>$result['MSG']);
			}
		 }
		 else{

		 	$ret = array("result"=>"false","message"=>"","message_err"=>"Error DB");
		 }

		 return $ret;
}



function bpkb_pendaftaran_delete($data){
		$sql="select bpkb_pendaftaran_delete(
		'$data->vDaftarID',
		'$data->vPetugasID'
		) as msg from dual";
	// echo "test..";

		$result = $this->call_function($sql);
		// show_array($result); 
		// exit;
		if($result['MSG'] <> 'error') { 
		//$tmp = explode("#",$result['MSG']);
			if($result['MSG']=="00"){
				$ret = array("result"=>"true","message"=>'DATA BERHASIL DIHAPUS',"message_err"=>"");
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

// --------------------------------------------------------------------
// ----------------------- Modul STNK Online -------------------------- 
// --------------------------------------------------------------------

// *********** function ***********
function stnk_login($data){
	$sql="select stnk_login(
		'$data->v_user_name',
		'$data->v_password',
		'$data->v_id_alat'
		
		) as msg from dual";
// echo $sql; exit;
	// echo "test..";

		$result = $this->call_function($sql);
		// show_array($result); 
		// exit;
		if($result['MSG'] <> 'error') { 
		$tmp = explode("#",$result['MSG']);
			if($tmp[0]=="1"){
				$ret = array("result"=>"true","message"=>$result['MSG'],"message_err"=>"");
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



function stnk_add($data) {

   $data = $this->escape($data); 

    $sql="select stnk_add(
		'$data->vNO_BPKB',
		'$data->vNO_STNK',
		'$data->vNREG_STNK',
		'$data->vTGL_STNK',
		'$data->vTGL_STNK_TO',
		'$data->vENTRY_BY',
		'$data->vENTRY_DATE',
		'$data->vPOLDA_ID',
		'$data->vPOLRES_ID',
		'$data->vSAMSAT_ID',
		'$data->vSNHDD',
		'$data->vPEMOHON_ID',
		'$data->vJenis',
		'$data->vNAMA_PEMILIK',
		'$data->vALAMAT_PEMILIK'
		) as msg from dual"; 
    //  echo $sql; exit;
	//echo "test..";
/*$sql='select stnk_add(
                \"$data->vNO_BPKB\",
                \"$data->vNO_STNK\",
                \"$data->vNREG_STNK\",
                \"$data->vTGL_STNK\",
                \"$data->vTGL_STNK_TO\",
                \"$data->vENTRY_BY\",
                \"$data->vENTRY_DATE\",
                \"$data->vPOLDA_ID\",
                \"$data->vPOLRES_ID\",
                \"$data->vSAMSAT_ID\",
                \"$data->vSNHDD\",
                \"$data->vPEMOHON_ID\",
                \"$data->vJenis\",
                \"$data->vNAMA_PEMILIK\",
                \"$data->vALAMAT_PEMILIK\"
                ) as msg from dual';*/

		$result = $this->call_function($sql);
		// show_array($result); 
		// exit;
		if($result['MSG'] <> 'error') { 
		$tmp = explode("#",$result['MSG']);
			if($tmp[0]=="1"){
				$ret = array("result"=>"true","message"=>$result['MSG'],"message_err"=>"");
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

function stnk_update($data) {
    $sql="select stnk_update(
		'$data->vNO_BPKB',
		'$data->vNO_STNK',
		'$data->vNREG_STNK',
		'$data->vTGL_STNK',
		'$data->vTGL_STNK_TO',
		'$data->vENTRY_BY',
		'$data->vENTRY_DATE',
		'$data->vPOLDA_ID',
		'$data->vPOLRES_ID',
		'$data->vSAMSAT_ID',
		'$data->vSNHDD',
		'$data->vPEMOHON_ID',
		'$data->vJenis',
		'$data->vSTNK_ID',
		'$data->vNAMA_PEMILIK',
		'$data->vALAMAT_PEMILIK'
		) as msg from dual";
    //echo $sql; exit;
	//echo "test..";

		$result = $this->call_function($sql);
		// show_array($result); 
		// exit;
		if($result['MSG'] <> 'error') { 
		$tmp = explode("#",$result['MSG']);
			if($tmp[0]=="1"){
				$ret = array("result"=>"true","message"=>$result['MSG'],"message_err"=>"");
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

function stnk_print($data) {
/*
    $sql="select stnk_cetak(
		'$data->vSTNKID',
		'$data->vNOSTNK',
		'$data->vENTRY_BY',
		'$data->vENTRY_DATE'
		) as msg from dual"; */

 $sql="select stnk_cetak(
		'$data->vSTNKID',
		'$data->vNOSTNK',
		'$data->vENTRY_BY',
		'$data->vENTRY_DATE',
		'$data->vTglSTNK',
		'$data->vTglSTNKTo'
		) as msg from dual";


    //echo $sql; exit;
	//echo "test..";

		$result = $this->call_function($sql);
		// show_array($result); 
		// exit;
		if($result['MSG'] <> 'error') { 
		$tmp = explode("#",$result['MSG']);
			if($tmp[0]=="1"){
				$ret = array("result"=>"true","message"=>$result['MSG'],"message_err"=>"");
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


function stnk_ambil($param){
	$success = true;

	$arr_return = array();

	//show_array($param); 

	foreach($param as $data ) : 
		    $sql = "select stnk_ambil(
								'$data->vSTNK_ID',
								'$data->vNO_STNK',
								'$data->vUSER',
								'$data->vTGL',
								'$data->vKODE_SERAH'
								) as msg from dual";
								//echo  $sql; 

		$result = $this->call_function($sql);


		if($result['MSG'] <> 'error') { 
			$tmp = explode("#",$result['MSG']);
			if($tmp[0]=="1"){
				//$ret = array("result"=>"true","message"=>$tmp[1],"message_err"=>"");
				$success = $success && true;
				$arr_return[] = array("no_stnk"=>$data->vNO_STNK,"success"=>true,'msg'=>$tmp[1]);
			}
			else {
				//$arr_return = array("result"=>"false","message"=>"","message_err"=>$tmp[1]);
				$success = $success && false;
				$arr_return[] = array("no_stnk"=>$data->vNO_STNK,"success"=>false,'msg'=>$tmp[1]);
			}
 		}
 		else{
 			// $ret = array("result"=>"false","message"=>"","message_err"=>"Error DB");
 			$success = $success && false;
 			$arr_return[] = array("no_stnk"=>$data->vNO_STNK,"success"=>false,'msg'=>'DB ERROR');
 		}
	endforeach; 

// show_array($arr_return);

	$result = array("result"=>$success,"data"=>$arr_return);
	return $result;
 
    //echo $sql; exit;
	//echo "test..";

		//$result = $this->call_function($sql);
}

function stnk_add_pemohon($data) {
    $sql="select stnk_add_pemohon(
		'$data->vKodePemohon',
		'$data->vNama'
		) as msg from dual";
    //  echo $sql; exit;
	//echo "test..";

		$result = $this->call_function($sql);
		// show_array($result); 
		// exit;
		if($result['MSG'] <> 'error') { 
		$tmp = explode("#",$result['MSG']);
			if($tmp[0]=="1"){
				$ret = array("result"=>"true","message"=>$result['MSG'],"message_err"=>"");
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

function stnk_add_pemohon2($data) {
    $sql="select stnk_add_pemohon2(
		'$data->vKodePemohon',
		'$data->vNama',
		'$data->vSAMSAT_ID'
		) as msg from dual";
     //echo $sql; exit;
	//echo "test..";

		$result = $this->call_function($sql);
		// show_array($result); 
		// exit;
		if($result['MSG'] <> 'error') { 
		$tmp = explode("#",$result['MSG']);
			if($tmp[0]=="1"){
				$ret = array("result"=>"true","message"=>$result['MSG'],"message_err"=>"");
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

function stnk_add_rahasia($data) {
    $sql="select stnk_add_rahasia(
		'$data->vNO_BPKB',
		'$data->vNO_STNK',
		'$data->vNREG_STNK',
		'$data->vTGL_STNK',
		'$data->vTGL_STNK_TO',
		'$data->vENTRY_BY',
		'$data->vENTRY_DATE',
		'$data->vPOLDA_ID',
		'$data->vPOLRES_ID',
		'$data->vSAMSAT_ID',
		'$data->vSNHDD',
		'$data->vPEMOHON_ID',
		'$data->vJenis',
		'$data->vNAMA_PEMILIK',
		'$data->vALAMAT_PEMILIK',
		'$data->vNAMA_TERCETAK',
		'$data->vALAMAT_TERCETAK',
		'$data->vNOPOLISI_TERCETAK'
		) as msg from dual";
      //echo $sql; exit;
	//echo "test..";

		$result = $this->call_function($sql);
		// show_array($result); 
		// exit;
		if($result['MSG'] <> 'error') { 
		$tmp = explode("#",$result['MSG']);
			if($tmp[0]=="1"){
				$ret = array("result"=>"true","message"=>$result['MSG'],"message_err"=>"");
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
function stnk_add2($data) {

   $data = $this->escape($data); 

    $sql="select stnk_add2(
		'$data->vNO_BPKB',
		'$data->vNO_STNK',
		'$data->vNREG_STNK',
		'$data->vTGL_STNK',
		'$data->vTGL_STNK_TO',
		'$data->vENTRY_BY',
		'$data->vENTRY_DATE',
		'$data->vPOLDA_ID',
		'$data->vPOLRES_ID',
		'$data->vSAMSAT_ID',
		'$data->vSNHDD',
		'$data->vPEMOHON_ID',
		'$data->vJenis',
		'$data->vNAMA_PEMILIK',
		'$data->vALAMAT_PEMILIK'
		) as msg from dual"; 
    
		$result = $this->call_function($sql);
		// show_array($result); 
		// exit;
		if($result['MSG'] <> 'error') { 
		$tmp = explode("#",$result['MSG']);
			if($tmp[0]=="1"){
				$ret = array("result"=>"true","message"=>$result['MSG'],"message_err"=>"");
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

// *********** procedure ***********
function stnk_get_data($param){
	 
		try {
            $variables[0] = array("parameter" => "p1", "value" => $param->v_is_cari);
            $variables[1] = array("parameter" => "p2", "value" => $param->v_cari);
            $variables[2] = array("parameter" => "p3", "value" => $param->v_is_bbn);
            $data =  $this->readCursor("stnk_get_data2(:p1, :p2, :p3, :refc)", $variables);
            // show_array($data); exit;
            //$ret = array("result"=>"true","message"=>$data);
            if(count($data)==0){
            	$ret = array("result"=>"false","message_err"=>"DATA NOT FOUND","message"=>"");
            }
            else {
            	$ret = array("result"=>"true","message"=>array("stnk_get_data_field"=>$data) , "message_err"=>"");
            }
        } 
        catch(exception $ex){
          $ret = array("result"=>"false","message_err"=>"DATABASE ERROR","message"=>"");
        }
        return $ret;
}

function stnk_get_data_for_edit($param){
	 
		try {
            $variables[0] = array("parameter" => "p1", "value" => $param->v_cari);
            $data =  $this->readCursor("stnk_get_data_for_edit(:p1, :refc)", $variables);
            // show_array($data); exit;
            //$ret = array("result"=>"true","message"=>$data);
            if(count($data)==0){
            	$ret = array("result"=>"false","message_err"=>"DATA NOT FOUND","message"=>"");
            }
            else {
            	$ret = array("result"=>"true","message"=>array("stnk_get_data_field"=>$data) , "message_err"=>"");
            }
        } 
        catch(exception $ex){
          $ret = array("result"=>"false","message_err"=>"DATABASE ERROR","message"=>"");
        }
        return $ret;
}

function stnk_list_registrasi($param){
	 
		try {
			$variables[0] = array("parameter" => "p1", "value" => $param->v_is_cari);
            $variables[1] = array("parameter" => "p2", "value" => $param->v_tgl);
            $variables[2] = array("parameter" => "p3", "value" => $param->v_tgl2);
            $variables[3] = array("parameter" => "p4", "value" => $param->v_snhdd);
            $variables[4] = array("parameter" => "p5", "value" => $param->v_user_id);
            $data =  $this->readCursor("stnk_list_registrasi(:p1, :p2, :p3, :p4, :p5, :refc)", $variables);
            // show_array($data); exit;
            //$ret = array("result"=>"true","message"=>$data);
            if(count($data)==0){
            	$ret = array("result"=>"false","message_err"=>"DATA NOT FOUND","message"=>"");
            }
            else {
            	$ret = array("result"=>"true","message"=>array("detail_data"=>$data) , "message_err"=>"");
            }
        } 
        catch(exception $ex){
          $ret = array("result"=>"false","message_err"=>"DATABASE ERROR","message"=>"");
        }
        return $ret;
}

function stnk_get_data_cetak($param){
	 
		try {
            $variables[0] = array("parameter" => "p1", "value" => $param->v_is_cari);
            $variables[1] = array("parameter" => "p2", "value" => $param->v_cari);
            $data =  $this->readCursor("stnk_get_data_cetak(:p1, :p2, :refc)", $variables);
            // show_array($data); exit;
            //$ret = array("result"=>"true","message"=>$data);
            if(count($data)==0){
            	$ret = array("result"=>"false","message_err"=>"DATA NOT FOUND","message"=>"");
            }
            else {
            	$ret = array("result"=>"true","message"=>array("detail_data"=>$data) , "message_err"=>"");
            }
        } 
        catch(exception $ex){
          $ret = array("result"=>"false","message_err"=>"DATABASE ERROR","message"=>"");
        }
        return $ret;
}

function stnk_list_registrasi_print($param){
	 
		try {
			$variables[0] = array("parameter" => "p1", "value" => $param->v_is_cari);
            $variables[1] = array("parameter" => "p2", "value" => $param->v_tgl);
            $variables[2] = array("parameter" => "p3", "value" => $param->v_tgl2);
            $variables[3] = array("parameter" => "p4", "value" => $param->v_snhdd);
            $variables[4] = array("parameter" => "p5", "value" => $param->v_user_id);
            $data =  $this->readCursor("stnk_list_registrasi_print(:p1, :p2, :p3, :p4, :p5, :refc)", $variables);
            // show_array($data); exit;
            //$ret = array("result"=>"true","message"=>$data);
            if(count($data)==0){
            	$ret = array("result"=>"false","message_err"=>"DATA NOT FOUND","message"=>"");
            }
            else {
            	$ret = array("result"=>"true","message"=>array("detail_data"=>$data) , "message_err"=>"");
            }
        } 
        catch(exception $ex){
          $ret = array("result"=>"false","message_err"=>"DATABASE ERROR","message"=>"");
        }
        return $ret;
}

function stnk_get_data_ambil($param){
	 
		try {
            $variables[0] = array("parameter" => "p1", "value" => $param->v_is_cari);
            $variables[1] = array("parameter" => "p2", "value" => $param->v_cari);
            $data =  $this->readCursor("stnk_get_data_ambil(:p1, :p2, :refc)", $variables);
            // show_array($data); exit;
            //$ret = array("result"=>"true","message"=>$data);
            if(count($data)==0){
            	$ret = array("result"=>"false","message_err"=>"DATA NOT FOUND","message"=>"");
            }
            else {
            	$ret = array("result"=>"true","message"=>array("detail_data"=>$data) , "message_err"=>"");
            }
        } 
        catch(exception $ex){
          $ret = array("result"=>"false","message_err"=>"DATABASE ERROR","message"=>"");
        }
        return $ret;
}

function stnk_list_registrasi_ambil($param){
	 
		try {
			$variables[0] = array("parameter" => "p1", "value" => $param->v_is_cari);
            $variables[1] = array("parameter" => "p2", "value" => $param->v_tgl);
            $variables[2] = array("parameter" => "p3", "value" => $param->v_tgl2);
            $variables[3] = array("parameter" => "p4", "value" => $param->v_snhdd);
            $variables[4] = array("parameter" => "p5", "value" => $param->v_user_id);
            $data =  $this->readCursor("stnk_list_registrasi_ambil(:p1, :p2, :p3, :p4, :p5, :refc)", $variables);
            // show_array($data); exit;
            //$ret = array("result"=>"true","message"=>$data);
            if(count($data)==0){
            	$ret = array("result"=>"false","message_err"=>"DATA NOT FOUND","message"=>"");
            }
            else {
            	$ret = array("result"=>"true","message"=>array("detail_data"=>$data) , "message_err"=>"");
            }
        } 
        catch(exception $ex){
          $ret = array("result"=>"false","message_err"=>"DATABASE ERROR","message"=>"");
        }
        return $ret;
}

function stnk_list_registrasi_lap($param){
	 
		try {
			$variables[0] = array("parameter" => "p1", "value" => $param->v_is_cari);
            $variables[1] = array("parameter" => "p2", "value" => $param->v_tgl);
            $variables[2] = array("parameter" => "p3", "value" => $param->v_tgl2);
            $variables[3] = array("parameter" => "p4", "value" => $param->v_snhdd);
            $variables[4] = array("parameter" => "p5", "value" => $param->v_user_id);
            $data =  $this->readCursor("stnk_list_registrasi_lap(:p1, :p2, :p3, :p4, :p5, :refc)", $variables);
            // show_array($data); exit;
            //$ret = array("result"=>"true","message"=>$data);
            if(count($data)==0){
            	$ret = array("result"=>"false","message_err"=>"DATA NOT FOUND","message"=>"");
            }
            else {
            	$ret = array("result"=>"true","message"=>array("detail_data"=>$data) , "message_err"=>"");
            }
        } 
        catch(exception $ex){
          $ret = array("result"=>"false","message_err"=>"DATABASE ERROR","message"=>"");
        }
        return $ret;
}

function stnk_list_print($param){
	 
		try {
			$variables[0] = array("parameter" => "p1", "value" => $param->v_tgl);
            $variables[1] = array("parameter" => "p2", "value" => $param->v_snhdd);
            $variables[2] = array("parameter" => "p3", "value" => $param->v_user_id);
            $data =  $this->readCursor("stnk_list_print(:p1, :p2, :p3, :refc)", $variables);
            if(count($data)==0){
            	$ret = array("result"=>"false","message_err"=>"DATA NOT FOUND","message"=>"");
            }
            else {
            	$ret = array("result"=>"true","message"=>array("detail_data"=>$data) , "message_err"=>"");
            }
        } 
        catch(exception $ex){
          $ret = array("result"=>"false","message_err"=>"DATABASE ERROR","message"=>"");
        }
        return $ret;
}
function stnk_list_status_penerbitan($param){
	 
		try {
			$variables[0] = array("parameter" => "p1", "value" => $param->v_tgl);
			$variables[1] = array("parameter" => "p2", "value" => $param->v_jenis);
            $data =  $this->readCursor("stnk_list_status_penerbitan(:p1, :p2, :refc)", $variables);
            if(count($data)==0){
            	$ret = array("result"=>"false","message_err"=>"DATA NOT FOUND","message"=>"");
            }
            else {
            	$ret = array("result"=>"true","message"=>array("detail_data"=>$data) , "message_err"=>"");
            }
        } 
        catch(exception $ex){
          $ret = array("result"=>"false","message_err"=>"DATABASE ERROR","message"=>"");
        }
        return $ret;
}

function stnk_list_registrasi_print2($param){
	 
		try {
			$variables[0] = array("parameter" => "p1", "value" => $param->v_is_cari);
            $variables[1] = array("parameter" => "p2", "value" => $param->v_tgl);
            $variables[2] = array("parameter" => "p3", "value" => $param->v_tgl2);
            $variables[3] = array("parameter" => "p4", "value" => $param->v_snhdd);
            $variables[4] = array("parameter" => "p5", "value" => $param->v_user_id);
            $data =  $this->readCursor("stnk_list_registrasi_print2(:p1, :p2, :p3, :p4, :p5, :refc)", $variables);
            // show_array($data); exit;
            //$ret = array("result"=>"true","message"=>$data);
            if(count($data)==0){
            	$ret = array("result"=>"false","message_err"=>"DATA NOT FOUND","message"=>"");
            }
            else {
            	$ret = array("result"=>"true","message"=>array("detail_data"=>$data) , "message_err"=>"");
            }
        } 
        catch(exception $ex){
          $ret = array("result"=>"false","message_err"=>"DATABASE ERROR","message"=>"");
        }
        return $ret;
}

function pengurus_list($param){
	 
		try {
			$variables[0] = array("parameter" => "p1", "value" => $param->v_samsat);
            $data =  $this->readCursor("pengurus_list(:p1, :refc)", $variables);
            // show_array($data); exit;
            //$ret = array("result"=>"true","message"=>$data);
            if(count($data)==0){
            	$ret = array("result"=>"false","message_err"=>"DATA NOT FOUND","message"=>"");
            }
            else {
            	$ret = array("result"=>"true","message"=>array("detail_data"=>$data) , "message_err"=>"");
            }
        } 
        catch(exception $ex){
          $ret = array("result"=>"false","message_err"=>"DATABASE ERROR","message"=>"");
        }
        return $ret;
}

function m_merk($param){
	 
		try {
			$variables[0] = array("parameter" => "p1", "value" => $param->v_polda_id);
            $data =  $this->readCursor("m_merk_list(:p1, :refc)", $variables);
            // show_array($data); exit;
            //$ret = array("result"=>"true","message"=>$data);
            if(count($data)==0){
            	$ret = array("result"=>"false","message_err"=>"DATA NOT FOUND","message"=>"");
            }
            else {
            	$ret = array("result"=>"true","message"=>array("detail_data"=>$data) , "message_err"=>"");
            }
        } 
        catch(exception $ex){
          $ret = array("result"=>"false","message_err"=>"DATABASE ERROR","message"=>"");
        }
        return $ret;
}
}
?>
