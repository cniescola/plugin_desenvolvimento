

<?php 
include "../conexao.php";
$res_exib_regra = mysqli_query($con,"SELECT * FROM a_regras_limitador_precos");
$tipo = "";
$opc = "";
while($exibe_res_exib_regra = mysqli_fetch_array($res_exib_regra)){
  if($exibe_res_exib_regra['tipo'] == 1){
    $id_conf_regra = $exibe_res_exib_regra['id_conf_regra'];

    $pesq = mysqli_query($con,"SELECT * FROM isc_categories WHERE categoryid=$id_conf_regra");

    $exibe_pesq = mysqli_fetch_array($pesq);

    $tipo = $exibe_pesq['catname'];
    $opc = "Categoria";
    echo "<script>$('section .topo_preco .corpo .q_block .lists .p_lists .listagem > div #span_back_".$exibe_res_exib_regra['id']."').css({background:'#f2453d'});</script>";
  }else if($exibe_res_exib_regra['tipo'] == 2){
    $id_conf_regra = $exibe_res_exib_regra['id_conf_regra'];

    $pesq = mysqli_query($con,"SELECT * FROM isc_brands WHERE brandid=$id_conf_regra");

    $exibe_pesq = mysqli_fetch_array($pesq);

    $tipo = $exibe_pesq['brandname'];
    $opc = "Marca";
    echo "<script>$('section .topo_preco .corpo .q_block .lists .p_lists .listagem > div #span_back_".$exibe_res_exib_regra['id']."').css({background:'#fd9827'});</script>";
  }else if($exibe_res_exib_regra['tipo'] == 3){
    $tipo = "produtos";
    $opc = "Produtos";

     echo "<script>$('section .topo_preco .corpo .q_block .lists .p_lists .listagem > div #span_back_".$exibe_res_exib_regra['id']."').css({background:'#2c98f0'});</script>";
  }else if($exibe_res_exib_regra['tipo'] == 4){

  }
  ?>
  <div>
    <span id="span_back_<?php echo $exibe_res_exib_regra['id'];?>"></span>
    <div>
      <p><?php echo $exibe_res_exib_regra['id']; ?></p>
      <span></span>
    </div>
    <div>
      <p><?php echo $opc; ?></p>
      <span></span>
    </div>
    <div>
      <p><?php echo $tipo; ?></p>
      <span></span>
    </div>
    <div>
      <p><?php echo $exibe_res_exib_regra['porcentagem']; ?>%</p>
      <span></span>
    </div>
    <div>
      <p>R$<?php echo $exibe_res_exib_regra['valor1']; ?> a R$<?php echo $exibe_res_exib_regra['valor2']; ?></p>
      <span></span>
    </div>

    <div><ion-icon name="close-circle-outline" id="id_regra_<?php echo $exibe_res_exib_regra['id'];?>" class="excluir_regra_button"></ion-icon></div>
  </div>

<?php } ?>

<script>

  
  $(".topo_preco .corpo .q_block .listagem .excluir_regra_button").click(function(){
    var id_regra = $(this).attr('id');
    id_regra = id_regra.substring(9);
    var regra_pass = new FormData();
    regra_pass.append('id',id_regra);
    $.ajax({
      url:'backend/vertentePrecos/Apagando_regras.php',
      type:'POST',
      data:regra_pass,
      contentType:false,
      async:false,
      processData:false,
      success: function( data ){
        $('#AlertModalPreco .modal-body').html( data );
        $('#AlertModalPreco').modal('show');
      }
    });

  });
</script>