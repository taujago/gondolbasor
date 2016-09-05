<?php
echo "test"; 

$data=new stdClass();

$data->nama='oke'; 
$data->alamat="jalan sayfi'i";


$yy = escape($data); 

print_r($yy);

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


?>
