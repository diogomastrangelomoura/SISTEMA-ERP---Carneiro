<?php
require("../../config.php");

$grava = $db->select("UPDATE dados_loja SET cabecalho_linha01='$cabecalho_linha01', cabecalho_linha02='$cabecalho_linha02', cabecalho_linha03='$cabecalho_linha03'");

$grava = $db->select("UPDATE configuracoes SET  impressora_principal='$impressora_principal'");

//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Configurações atualizadas com sucesso.';

//REDIRECIONA PARA A PÁGINA//
header("Location: ".ADMIN_DIR."impressao");

?>