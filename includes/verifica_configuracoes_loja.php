<?php

$selecionax = $db->select("SELECT * FROM configuracoes LIMIT 1");
$dados_configuracoes = $db->expand($selecionax);

?>