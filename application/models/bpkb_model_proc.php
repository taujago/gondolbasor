<?php
class bpkb_model_proc extends ORA_Model {
	function bpkb_model_proc(){
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






}

?>