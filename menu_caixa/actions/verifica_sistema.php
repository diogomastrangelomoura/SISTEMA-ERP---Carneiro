<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
include("../../includes/verifica_session.php");

unset($_SESSION['id_caixa_erp_sis'] );


$selecionax = $db->select("SELECT caixa_compartilhado FROM configuracoes LIMIT 1");
$dados_configuracoes = $db->expand($selecionax);

$and='';
if($dados_configuracoes['caixa_compartilhado']==0){
	$and = "AND id_usuario='$id_usuario'";		
} 


$sel = $db->select("SELECT id FROM caixa WHERE data_fechamento='0000-00-00' $and ORDER BY id DESC LIMIT 1");

if($db->rows($sel)){
	echo '1';
} else {
	echo '0';
}


?>