<div class="prodconteiner">
	<div class="containeresquerda">
		<div class="prodtitle">ADICIONAR PORCENTAGEM</div>
		
		<div>
			<div>PORCENTO</div>
			<div><input type="number" name="porcnt_num" id="porcnt_num"></div>
		</div>

		
	</div>

	<div class="containerdireita">
		
	</div>
</div>

<div class="butaoaddProd">ADICIONAR REGRA</div>



<script>
  //Script para produtos
  $(document).ready(function(){

  	$.ajax({

  		url: "backend/vertentePrecos/Modal.php",

  		success: function(data){
  			$('.motal_overvisible').html(data);

  		},

  		beforeSend: function(){

  		},

  		complete: function(){

  		}

  	});

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
  					var dados = new FormData();
  					dados.append('ini_prod_qtd',ini_prod_qtd);
  					dados.append('final_prod_qtd',final_prod_qtd);
  					dados.append('ini_alt_valor_inic',ini_alt_valor_inic);
  					dados.append('final_alt_valor_inic',final_alt_valor_inic);
  					dados.append('porcnt_num',porcnt_num);

  					$.ajax({
  						url:'backend/vertentePrecos/Produtosclick_cadastra_regra.php',
  						type:'POST',
  						data:dados,
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