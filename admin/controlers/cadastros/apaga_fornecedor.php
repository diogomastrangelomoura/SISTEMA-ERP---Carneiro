<?php
require("../../config.php");

//APAGA O PRODUTO
$apaga = $db->select("DELETE FROM fornecedores WHERE id='$id' LIMIT 1");

//SESSIONS DE AVISO//
$_SESSION['avisos-admin-sis-classe'] = 'success';
$_SESSION['avisos-admin-sis-frase'] = 'Fornecedor(es) excluído(s) com sucesso.';

//REDIRECIONA PARA A PÁGINA//
header("Location: ".ADMIN_DIR."fornecedores");

?>