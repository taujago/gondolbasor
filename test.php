	
<?php
// phpinfo(); 
// exit;
$conn = oci_connect("scott", "tiger", "//192.168.50.136/ora11g");

// PHP function to get a formatted date
$d = date('j:M:y H:i:s');

// Insert the date into mytable
$s = oci_parse($conn,
		"SELECT * FROM EMP");

// Use OCI_DEFAULT to insert without committing
$r = oci_execute($s, OCI_DEFAULT);


?>