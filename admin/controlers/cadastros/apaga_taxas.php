<?php
require("../../config.php");

//APAGA O PRODUTO
$apaga = $db->select("DELETE FROM tipos_entrega WHERE id='$id' LIMIT 1");
$update = $db->select("UPDATE sistema SET aviso_update_internet='1'");

//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Taxa(s) excluída(s) com sucesso.';

//REDIRECIONA PARA A PÁGINA//
header("Location: ".ADMIN_DIR."taxas");

?>