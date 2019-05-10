<?php

$selecionax = $db->select("SELECT caixa_compartilhado FROM configuracoes LIMIT 1");
$dados_configuracoes = $db->expand($selecionax);

$and='';
if($dados_configuracoes['caixa_compartilhado']==0){
	$and = "AND caixa.id_usuario='$id_usuario'";		
}


$sel_cx = $db->select("SELECT caixa.*, usuarios.nome FROM caixa 
    LEFT JOIN usuarios ON caixa.id_usuario=usuarios.id
    WHERE caixa.data_fechamento='0000-00-00' $and 
    ORDER BY caixa.id DESC LIMIT 1");


if($db->rows($sel_cx)){
	$dados_caixa_aberto = $db->expand($sel_cx);
	$id_caixa_aberto = $dados_caixa_aberto['id'];

} else {
	$id_caixa_aberto =0;
}




$aviso_caixa_antigo=0;
$hoje = date("Y-m-d");
$sel = $db->select("SELECT data_abertura, hora_abertura FROM caixa WHERE data_fechamento='0000-00-00' ORDER BY id DESC LIMIT 1");
if($db->rows($sel)){
	$dados_caixa=$db->expand($sel);       
    if($dados_caixa['data_abertura']==$hoje){
    	$aviso_caixa_antigo=0;
    } else {
    	$aviso_caixa_antigo=1;
    }
} else {
    $dados_caixa['data_abertura']='---';
    $dados_caixa['hora_abertura']='---';
}  
    

?>