<?php
require("../../config.php");

$grava = $db->select("UPDATE configuracoes SET  modulo_entregas='$modulo_entregas', modulo_entregas_pedidos='$modulo_entregas_pedidos' ");


//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Módulos atualizados com sucesso.';

//REDIRECIONA PARA A PÁGINA//
header("Location: ".ADMIN_DIR."modulos");

?>