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
if($id_caixa_aberto!=0){
    if($dados_caixa_aberto['data_abertura']<date("Y-m-d")){
        $aviso_caixa_antigo=1;        
    }
} 



if($aviso_caixa_antigo==1){
    echo '<div class="alert alert-danger text-center" style="margin-bottom:0; border:0">';
        echo '<i class="icofont-warning"></i> ATENÇÃO VOCÊ ESTÁ TRABALHANDO COM O CAIXA ANTIGO DO DIA: '.data_mysql_para_user($dados_caixa_aberto['data_abertura']); 
    echo '</div>';
}

?>