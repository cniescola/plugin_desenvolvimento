<?php include "../conexao.php"; ?>
<div class="prodconteiner">
	<div class="containeresquerda">
		<div class="prodtitle">ADICIONAR PORCENTAGEM</div>
		
		<div>
			<div>PORCENTO</div>
			<div><input type="number" name="porcnt_num" id="porcnt_num"></div>
		</div>

		
	</div>

	<div class="containerdireita">
		<select class="select_options">
			<?php 
				$listagem = mysqli_query($con,"SELECT * FROM isc_brands");
				while($exibe = mysqli_fetch_array($listagem)){


			 ?>
			 	<option value="<?php echo $exibe['brandid'];?>"><?php echo $exibe['brandname'];?></option>
			 <?php
			 	}
			 ?>
		</select>
	</div>
</div>

<div class="butaoaddProd">ADICIONAR REGRA</div>

<script>
  //Script para produtos
  $(document).ready(function(){

  	$(".retordown .butaoaddProd").click(function(){

  		var ini_prod_qtd = $("#ini_prod_qtd").val();
  		var final_prod_qtd = $("#final_prod_qtd").val();

  		if(ini_prod_qtd == '' || final_prod_qtd == ''){
  			$('#AlertModalPreco .modal-body').html("Preencha os campos do LIMITADOR QTDE PRODUTOS");
  			$('#AlertModalPreco').modal('show');
  		}else{
  			var ini_alt_valor_inic = $('#ini_alt_valor_inic').val();
  			var final_alt_valor_inic = $('#final_alt_valor_inic').val();

  			if(final_alt_valor_inic == '' || ini_alt_valor_inic == ''){
  				$('#AlertModalPreco .modal-body').html("Preencha os campos FAIXA DE VALOR À ALTERAR");
  				$('#AlertModalPreco').modal('show');
  			}else{
  				var porcnt_num = $('#porcnt_num').val();

  				if(porcnt_num == ''){
  					$('#AlertModalPreco .modal-body').html("Preencha o campo ADCIONAR PORCENTAGEM");
  					$('#AlertModalPreco').modal('show');

  				}else{
  					var selectopt = $('.prodconteiner .containerdireita .select_options').val();
  					var dadosMarca = new FormData();
  					dadosMarca.append('ini_prod_qtd',ini_prod_qtd);
  					dadosMarca.append('final_prod_qtd',final_prod_qtd);
  					dadosMarca.append('ini_alt_valor_inic',ini_alt_valor_inic);
  					dadosMarca.append('final_alt_valor_inic',final_alt_valor_inic);
  					dadosMarca.append('porcnt_num',porcnt_num);
  					dadosMarca.append('selectopt',selectopt);

  					$.ajax({
  						url:'backend/vertentePrecos/MarcaClick_cadastra_regra.php',
  						type:'POST',
  						data:dadosMarca,
  						contentType:false,
  						async:false,
  						processData:false,
  						success: function( data ){
  							$('#AlertModalPreco .modal-body').html( data );
  							$('#AlertModalPreco').modal('show');
  							
  							
  						}
  					});
  				}
  			}
  		}

  	});
  });
  //Script para produtos

</script>