<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");



$delete = $db->select("DELETE FROM produtos_venda WHERE id='$id' LIMIT 1");	
echo 1;
	
?>


