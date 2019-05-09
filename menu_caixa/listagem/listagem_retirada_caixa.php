<?php
include_once("../../admin/class/class.db.php");
include_once("../../admin/class/class.seguranca.php");
include_once("../../includes/verifica_session.php");
include_once("../../includes/verifica_caixa_aberto.php");
?>


      <?php
	      $sel = $db->select("SELECT saidas_caixa.*, usuarios.nome FROM saidas_caixa 	      	
	      	LEFT JOIN usuarios ON saidas_caixa.id_usuario=usuarios.id
	      	WHERE saidas_caixa.id_caixa='$id_caixa_aberto'
	      	ORDER BY saidas_caixa.id DESC
	      	");
		  	if($db->rows($sel)){
			while($dados = $db->expand($sel)){
	  ?>
      <tr id="apaga<?php echo $dados['id']; ?>">
        <td class="upper"><?php echo data_mysql_para_user($dados['data']); ?> AS <?php echo substr($dados['hora'],0,5); ?></td>
        <td class="upper">R$ <?php echo number_format($dados['valor_saida'],2,",","."); ?></td>
        <td class="upper"><?php echo ($dados['motivo']); ?></td>        
        <td class="upper"><?php echo ($dados['nome']); ?></td>        
        <td class="upper">
          <a tabindex="-1" href="javascript:void(0);" onclick="javascript:exclui_saidas_caixa(<?php echo $dados['id']; ?>)" class="thin">
          <button tabindex="-1" class="btn btn-danger btn-sm"><i class="icofont-ui-close"></i></button></a></td>        
      </tr>
      <?php
      	}} else {
           echo '
            <tr>              
              <td colspan="10" class="upper">
                  <center><br>Nenhuma retirada encontrada!<br><br></center>
              </td>        
            </tr>
           '; 
        }
      ?>
    