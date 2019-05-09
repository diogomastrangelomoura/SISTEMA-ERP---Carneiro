<?php
include("../../admin/class/class.db.php");
include("../../admin/class/class.seguranca.php");
include("../../includes/verifica_session.php");
include("../../includes/verifica_configuracoes_loja.php");
include("../../includes/verifica_dados_sistema.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

   
    <title>ORÇAMENTO - SIS ERP v<?php echo $dados_sistema['versao']; ?></title>

    <!-- vendor css -->
    <link href="../../admin/lib/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="../../admin/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../../admin/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../../css/icones/icones01/icofont.min.css" rel="stylesheet">
    

    <!-- Slim CSS -->
    <link rel="stylesheet" href="../../admin/css/slim.css">
    <link rel="stylesheet" href="../../admin/css/custom.css">
    <link rel="stylesheet" href="../../css/sistema/custom.css">

    <link rel="shortcut icon" href="../../favicon.ico">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


  </head>
  <body id="body">

    <script>
        function orcamento_venda(id){
            window.opener.transforma_orcamento_venda(id);    
            window.close();
        }
    </script>


    <div class="slim-mainpanel">
      <div class="container-fluid" id="conteudo_geral">


            <div class="slim-pageheader">
              <ol class="breadcrumb slim-breadcrumb"></ol>
              <h6 class="slim-pagetitle upper">ORÇAMENTO #<?php echo $id; ?></h6>
            </div>

            <div class="section-wrapper" style="padding: 20px; font-size: 16px; font-weight: 300">

                <?php
                
                $sql = $db->select("SELECT * FROM produtos_venda WHERE id_orcamento='$id'   ORDER BY id DESC");

                if($db->rows($sql)){
                    while($row = $db->expand($sql)){

                        echo '';

                        $qtd_itens_pedido = ($qtd_itens_pedido+$row['quantidade']);
                        $total_final_pedido = ($total_final_pedido+($row['quantidade']*$row['valor']));
                        
                        $id_produto = $row['id_produtos'];
                        $id_controle = $row['id'];
                        

                        $pg = $db->select("SELECT produto FROM produtos WHERE id='$id_produto' LIMIT 1");
                        $var = $db->expand($pg);
                        $nome_produto= $var['produto'];

                        //POE O ZERO NA QUANTIDADE
                        $quan = explode('.', $row['quantidade']);
                        
                        if($quan[1]=='00'){
                            if($row['quantidade']<10){$row['quantidade']= '0'.$quan[0];} else {$row['quantidade'] = $quan[0];}    
                        } 

                        
                        echo '<span  style="color:#333">';          

                            echo '<strong>'.$row['quantidade'].' x</strong>';   
                             echo '<span class="pull-right text-right">R$ '.number_format($row['valor'],2,",",".").'</span>';        

                        echo '</span>';

                                                
                        echo '<br>';
                        echo '<span class="name_produto_comanda upper corta_texto"> '.$nome_produto.'</span>';
                       
                        


                        echo '<hr style="margin-top:8px; padding-top:8px">';



                    }

                    

                } else {

                    echo '<center>NENHUM ÍTEM NO ORÇAMENTO.</center>';

                }



                ?>


                </div>

                <a href="javascript:void(0);" onclick="javascript:orcamento_venda(<?php echo $id; ?>);" class="btn btn-primary top15">TRANSFORMAR EM VENDA</a>


      </div>
    </div>


</body>



    <script src="../../admin/lib/jquery/js/jquery.js"></script>
    <script src="../../admin/lib/popper.js/js/popper.js"></script>
    <script src="../../admin/lib/bootstrap/js/bootstrap.js"></script>
   <script src="../../admin/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>


    <script src="../../js/jquery.maskMoney.js"></script>
    <script src="../../js/mascara.js"></script>
    <script src="../../javascript/pedidos.js?<?php echo time(); ?>"></script>
    



</html>

