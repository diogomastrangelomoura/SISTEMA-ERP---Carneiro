

<div class="slim-navbar" style="margin-bottom: 20px">
      <div class="container">
        <ul class="nav">
        

          <li class="nav-item  active" id="aviso_impressao">
            <a class="nav-link" href="home" id="esconde_imprime">
              <img src="admin/img/logo-menu.png">
              <span>SIS ERP CAIXA</span>
            </a>   
           <a class="nav-link" href="javascript:void(0);" id="aparece_imprime" style="background-color: #333; display: none;">
            <i class="icofont-print"></i>&nbsp;&nbsp;IMPRIMINDO
           </a>        
          </li>

          <li class="nav-item with-sub">
            <a class="nav-link" href="javascript:void(0);" tabindex="-1">
              <i class="icon ion-ios-book-outline"></i>
              <span>ACESSO RÁPIDO</span>
            </a>
            <div class="sub-item">
              <ul>                
                <li><a href="home"  tabindex="-1">NOVA VENDA</a></li>

                <?php if($id_caixa_aberto!=0){ ?>
                <li><a href="javascript:void(0)" onclick="javascript:menu_cadastro_clientes();" tabindex="-1">CADASTRO DE CLIENTES</a></li>

                <li><a href="javascript:void(0)" onclick="javascript:menu_orcamentos();" tabindex="-1">ORÇAMENTOS</a></li>
                <?php } ?>                                              
              </ul>
            </div><!-- dropdown-menu -->
          </li>
          

          <li class="nav-item with-sub">
            <a class="nav-link" href="javascript:void(0);" tabindex="-1">
              <i class="icon icofont-chart-growth"></i>
              <span>RELATÓRIOS</span>
            </a>
            <div class="sub-item">
              <ul>                
                
                <li><a href="javascript:void(0)" onclick="javascript:menu_vendas_realizadas();" tabindex="-1">VENDAS REALIZADAS</a></li>
                <li><a href="javascript:void(0)" onclick="javascript:menu_caixa_consolidado();">CAIXA CONSOLIDADO</a></li>
                               
              </ul>
            </div><!-- dropdown-menu -->
          </li>


          <li class="nav-item with-sub">
            <a class="nav-link" href="javascript:void(0);" tabindex="-1">
              <i class="icon ion-ios-people"></i>
              <span><?php echo $dados_usuario_nome; ?></span>              
            </a>
            <div class="sub-item">
              <ul>
                <?php if($id_caixa_aberto!=0){ ?>
                <li><a href="javascript:void(0)" onclick="javascript:menu_saidas_caixa();" tabindex="-1">RETIRADAS DE CAIXA</a></li>  

                <li><a href="javascript:void(0)" onclick="javascript:confirma_fecha_caixa();"  tabindex="-1"><i class="icon icofont-checked"></i>&nbsp;&nbsp;ENCERRAR CAIXA</a></li>                

              <?php } ?>
                <li><a href="logout" tabindex="-1"><i class="icon ion-forward"></i>&nbsp;&nbsp;LOGOUT</a></li>                
              </ul>
            </div><!-- dropdown-menu -->
          </li>
         

        </ul>
      </div><!-- container -->
    </div><!-- slim-navbar -->

