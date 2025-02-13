
<?php include "../backend/conexao.php" ?>

<?php 
$contador = mysqli_query($con,"SELECT * FROM isc_products");
$qtde_produtos = mysqli_num_rows($contador);
$contador = mysqli_query($con,"SELECT * FROM isc_categories");
$qtde_categorias = mysqli_num_rows($contador);
$contador = mysqli_query($con,"SELECT * FROM isc_brands");
$qtde_marca = mysqli_num_rows($contador);
?>


<div class="topo_preco">

  <div class="headerTop">
    <div class="title"><h1></h1>Sistema de Ajuste preço produto</div>

    <div class="content4">
      
    </div>

    <div class="botoes">

      <a href="#">Apagar</a>
      <a href="#">Salvar</a>
      
    </div>
  </div>

  <div class="corpo">

    <div class="p_block">
      <div>
        <div><ion-icon name="file-tray-stacked-outline"></ion-icon></div>
        <div>
          <div><?php echo $qtde_categorias; ?></div>
          <div>Categorias</div>
        </div>
      </div>

      <div>
        <div><ion-icon name="send-outline"></ion-icon></div>
        <div>
          <div><?php echo $qtde_marca; ?></div>
          <div>Marca</div>
        </div>
      </div>

      <div>
        <div><ion-icon name="albums-outline"></ion-icon></div>
        <div>
          <div><?php echo $qtde_produtos; ?></div>
          <div>Produtos</div>
        </div>
      </div>
      <div>
        <div><ion-icon name="document-text-outline"></ion-icon></div>
        <div>
          <div>1054</div>
          <div>Produtos Especificos</div>
        </div>
      </div>
    </div>

    <div class="s_block">
      <span></span>
      <span></span>
      <div>
        <p>LIMITADOR QTDE PRODUTOS</p>
        <div>
          <div>
            <div>INICIO</div>
            <div>
              <input type="number" name="ini_prod_qtd" id="ini_prod_qtd">
            </div>
          </div>
          <div>
            <div>FINAL</div>
            <div>
              <input type="number" name="final_prod_qtd" id="final_prod_qtd">
            </div>
          </div>
        </div>
      </div>

      <div>
        <p>FAIXA DE VALOR À ALTERAR</p> 
        <div>
          <div>
            <div>INICIO</div>
            <div>
              <input type="number" name="ini_alt_valor_inic" id="ini_alt_valor_inic">
            </div>
          </div>
          <div>
            <div>FINAL</div>
            <div>
              <input type="number" name="final_alt_valor_inic" id="final_alt_valor_inic">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="t_block">
      <span></span>
      <div class="retordown">



      </div>
    </div>

    <div class="q_block">
      <span></span>
      <span></span>

      <div class="lists">
        <div class="conjregras">CONJUNTO DE REGRAS</div>
        <div class="p_lists">
          <div class="titulos_list">
            <span>ID</span>
            <span>TIPO DE REGRA</span>
            <span>NOME DA REGRA</span>
            <span>PORCENTAGEM</span>
            <span>FAIXA DE VALOR</span>
            <span>EXCLUIR</span>
          </div>

          <div class="listagem">

          </div>
        </div>
      </div>
    </div>


  </div>
</div>
<div class="motal_overvisible"> </div>



<script>

  $('.topo_preco .botoes a:nth-child(2)').click(function(){
    $('.content4').attr('style','display:flex');

    $.ajax({

      url: "backend/vertentePrecos/Cadastraprecoprodutofield.php",

      success: function(data){
        $('.content4').html(data);

      },

      beforeSend: function(){

      },

      complete: function(){

      }

    });
  });







  $(document).ready(function(){

    // $.ajax({
    //   url:'backend/vertentePrecos/Listagem_de_regra.php',
    //   type: 'POST',
    //   contentType:false,
    //   async:false,
    //   processData:false,
    //   success: function( data ){
    //     $('.topo_preco .corpo .q_block .listagem').html(data);
    //   }
    // });

  $.ajax({
      url:'../backend/vertentePrecos/Modal.php',
      type: 'POST',
      contentType:false,
      async:false,
      processData:false,
      success: function( data ){
        $('.motal_overvisible').html(data);
      }
    });

    $('.topo_preco .corpo .p_block > div:nth-child(1)').click(function(){
      $('.topo_preco .corpo .t_block').toggleClass('active');
      $('.topo_preco .corpo .t_block > span').toggleClass('animespan');
      $('.topo_preco .corpo .t_block').toggleClass('catAlment');

      $.ajax({

        url: "backend/vertentePrecos/CategoriasClick.php",

        success: function(data){
          $('.topo_preco .corpo .t_block .retordown').html(data);

        },

        beforeSend: function(){

        },

        complete: function(){

        }

      });

    });
    $('.topo_preco .corpo .p_block > div:nth-child(2)').click(function(){
      $('.topo_preco .corpo .t_block').toggleClass('active');
      $('.topo_preco .corpo .t_block > span').toggleClass('animespan');

      $.ajax({

        url: "backend/vertentePrecos/MarcaClick.php",

        success: function(data){
          $('.topo_preco .corpo .t_block .retordown').html(data);

        },

        beforeSend: function(){

        },

        complete: function(){

        }

      });

    });

    $('.topo_preco .corpo .p_block > div:nth-child(3)').click(function(){
      $('.topo_preco .corpo .t_block').toggleClass('active');
      $('.topo_preco .corpo .t_block > span').toggleClass('animespan');

      $.ajax({

        url: "backend/vertentePrecos/Produtosclick.php",

        success: function(data){
          $('.topo_preco .corpo .t_block .retordown').html(data);

        },

        beforeSend: function(){

        },

        complete: function(){

        }

      });

    });

    $('.topo_preco .corpo .p_block > div:nth-child(4)').click(function(){
      $('.topo_preco .corpo .t_block').toggleClass('active');
      $('.topo_preco .corpo .t_block > span').toggleClass('animespan');


      $.ajax({

        url: "backend/vertentePrecos/ProdutosEspecificosclick.php",

        success: function(data){
          $('.topo_preco .corpo .t_block .retordown').html(data);

        },

        beforeSend: function(){

        },

        complete: function(){

        }

      });

    });



  });
</script>

