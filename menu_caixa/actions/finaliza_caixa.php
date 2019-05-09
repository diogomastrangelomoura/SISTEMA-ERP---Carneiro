<?php
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");
require("../../includes/verifica_caixa_aberto.php");

unset($_SESSION['id_venda_erp_sis'] );
unset($_SESSION['id_caixa_erp_sis'] );

$dt = date("Y-m-d");
$hr = date("H:i:s");


$update = $db->select("DELETE FROM produtos_venda WHERE id_venda='0' AND id_orcamento='0' AND id_usuario='$id_usuario' AND user_hash='$md5_usuario_logado'");

$update = $db->select("UPDATE caixa SET data_fechamento='$dt', hora_fechamento='$hr' WHERE data_fechamento='0000-00-00'");


echo $id_caixa_aberto;

?>