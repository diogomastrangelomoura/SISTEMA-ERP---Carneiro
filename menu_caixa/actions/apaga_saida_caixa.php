<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");


unset($_SESSION['id_venda_erp_sis'] );
unset($_SESSION['id_caixa_erp_sis'] );

$dt = date("Y-m-d");
$hr = date("H:i:s");


$update = $db->select("DELETE FROM saidas_caixa WHERE id='$id' LIMIT 1");

?>