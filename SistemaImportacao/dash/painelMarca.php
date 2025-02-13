<?php include "../backend/conexao.php"; ?>
<link rel="stylesheet" href="css/styleMeio.css">
<div class="topo_preco">

	<div class="headerTop">
		<div class="title"><h1></h1>Sistema de Ajuste Marca Produto</div>

		<div class="content4">

		</div>

		<div class="botoes">

			<a href="#">Apagar</a>
			<a href="#">Salvar</a>

		</div>
	</div>

	<div class="corpo">
		<div class="p_block">
			<div style="width: 95%;height: 13vw;">
				<div><ion-icon name="send-outline"></ion-icon></div>
				<div>
					<div><?php 
						$calc = mysqli_query($con,"SELECT * FROM isc_brands");
						$cont = mysqli_num_rows($calc);

						echo $cont;
					 ?></div>
					<div>Marca</div>
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

		<div class="te_block">
			<span></span>
			<span></span>
			<div>
				<p>DIGITE O NOME DA MARCA PARA FAIXA DE VALOR</p>
				<div>
					<div>
						<div>
							<input type="text" name="name_marc" id="name_marc">
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

</div>

<div class="motal_overvisible">
	<?php include "../backend/vertenteMarca/Modal.php"; ?>
</div>


<script>
	$(document).ready(function(){
		$('.topo_preco .botoes a:nth-child(2)').click(function(){

			

			var ini_prod_qtd = $("#ini_prod_qtd").val();
			var final_prod_qtd = $("#final_prod_qtd").val();
			var ini_alt_valor_inic = $('#ini_alt_valor_inic').val();
			var final_alt_valor_inic = $('#final_alt_valor_inic').val();

			if(ini_prod_qtd == '' || final_prod_qtd == ''){
				$('#AlertModalPreco .modal-body').html("Preencha os campos do LIMITADOR QTDE PRODUTOS");
				$('#AlertModalPreco').modal('show');
			}else{

				if(final_alt_valor_inic == '' || ini_alt_valor_inic == ''){
					$('#AlertModalPreco .modal-body').html("Preencha os campos FAIXA DE VALOR À ALTERAR");
					$('#AlertModalPreco').modal('show');
				}else{
					var name_marc = $('#name_marc').val();

					if(name_marc == ''){
						$('#AlertModalPreco .modal-body').html("Preencha o campo NOME MARCA");
						$('#AlertModalPreco').modal('show');

					}else{


						var enviadados = new FormData();
						enviadados.set('ini_prod_qtd',ini_prod_qtd);
						enviadados.set('final_prod_qtd',final_prod_qtd);
						enviadados.set('ini_alt_valor_inic',ini_alt_valor_inic);
						enviadados.set('final_alt_valor_inic',final_alt_valor_inic);
						enviadados.set('name_marc',name_marc);

						$.ajax({

							url: "backend/vertenteMarca/CadastraMarca.php",
							type:'POST',
							data:enviadados,
							contentType:false,
							async:false,
							processData:false,
							success: function(data){
								$('.content4').html(data);

							}
						});

					}
				}
			}

			
		});
	});
</script>