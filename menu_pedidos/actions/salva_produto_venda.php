<?php 
require("../../admin/class/class.db.php");
require("../../admin/class/class.seguranca.php");
require("../../includes/verifica_session.php");

$grava = $db->select("INSERT INTO produtos_venda (id_produtos, valor, quantidade, user_hash, id_usuario) VALUES ('$id_produto_frente_caixa', '$preco_produto_frente_caixa', '$qtd_frente_caixa', '$md5_usuario_logado', '$id_usuario')");


?>