
<div class="principalContainer">	
	<?php 
	include("../backend/vertenteMarca/Modal.php");
	?>

	<div id="recebe" style="display:none;"></div>

	<div class="header_top">
		<div class="titulo">	
			<h1> Sistema de Alteração Cat & Prod</h1>
		</div>

		<div class="content4 content4v">
			<div class="skills">
				<span class="Name">Html</span>
				<div class="percent">
					<div class="progress" style="width: 0%;"></div>
				</div>
				<span class="Value">0%</span>
			</div>
			<div id="recebe_coisas"></div>
		</div>
	</div>

	<div class="section_bottom">	
		<p>	Sistema de Alteração Titulos Produtos & Categorias</p>
		<div class="sec1">

			<div class="prodAlter">	

				<p>	Alteração Titulo Produto</p>
				<div>	

					<div>	<input type="text" id="ProdNameSearch" name="ProdNameSearch" placeholder="Digite Nome a ser substituido"></div>
					<div>	<input type="text" id="ProdNameUpdate" name="ProdNameUpdate" placeholder="Digite Nome que vai substituir"></div>
				</div>
			</div>

			<div class="catAlter">	

				<p>	Alteração Titulo Categoria</p>
				<div>	
					<div>	<input type="text" id="CatNameSearch" name="CatNameSearch" placeholder="Digite o Nome a ser substituido"></div>
					<div>	<input type="text" id="CatNameUpdate" name="CatNameUpdate" placeholder="Digite Nome que vai substituir"></div>
				</div>

			</div>	

		</div>
		<p>	Cadastrando produtos em destaque para todas as categorias vazias</p>
		<div class="sec2">	
			<div>
				<a href="#">
					<span>Cadastrar Destaques</span>
					<span>Cadastrar Destaques</span>
				</a>
				<a href="#">
					<span>Alterar Prod & Cat</span>
					<span>Alterar Prod & Cat</span>

				</a>	

			</div>
			<div></div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){


		$('.principalContainer .section_bottom .sec2 div a:nth-child(1)').click(function(){
			$.ajax({

				url: "backend/ConfigCatProd/cadastroProdDestaque.php",

				success: function(data){
					$('#recebe').html(data);

				},

				beforeSend: function(){

				},

				complete: function(){

				}

			});
		});



		// sistema relacionado ao primeiro botão altera Prod & Cat
		$('.sec2 div:nth-child(1) a:nth-child(2)').click(function(){
			var tp_antigo = $(".section_bottom .sec1 .prodAlter #ProdNameSearch").val();
			var tc_antigo = $(".section_bottom .sec1 .catAlter #CatNameSearch").val();

			var tp_substituto = $(".section_bottom .sec1 .prodAlter #ProdNameUpdate").val();
			var tc_substituto = $(".section_bottom .sec1 .catAlter #CatNameUpdate").val();

			var tipo = 0;



// --------------------------------------------------------------------------------------------------------------------------
if(tp_antigo === "" && tp_substituto === ""){

	if(tc_antigo === "" && tc_substituto === ""){
		$('#AlertModalPreco .modal-body').html("Nenhum dos argumentos foi preenchido! Por favor Preencha!");
		$('#AlertModalPreco').modal('show');
	}else{
		if(tc_antigo === ""){
			$('#AlertModalPreco .modal-body').html("O argumento (Digite Nome a ser substituido) da alteração de titulo categoria não foi preenchida! Por favor Preencha!");
			$('#AlertModalPreco').modal('show');
		}else{
			if(tc_substituto === ""){
				$('#AlertModalPreco .modal-body').html("O argumento (Digite Nome que vai substituir) da alteração de titulo categoria não foi preenchida! Por favor Preencha!");
				$('#AlertModalPreco').modal('show');
			}else{

				tipo = 1;
			}
		}
	}

}else{

	if(tc_antigo === "" && tc_substituto === ""){
		if(tp_antigo === ""){
			$('#AlertModalPreco .modal-body').html("O argumento (Digite Nome a ser substituido) da alteração de titulo produto não foi preenchida! Por favor Preencha!");
			$('#AlertModalPreco').modal('show');
		}else{
			if(tp_substituto === ""){
				$('#AlertModalPreco .modal-body').html("O argumento (Digite Nome que vai substituir) da alteração de titulo produto não foi preenchida! Por favor Preencha!");
				$('#AlertModalPreco').modal('show');
			}else{

				tipo = 2;
			}
		}
	}else{
		if(tp_antigo === ""){
			$('#AlertModalPreco .modal-body').html("O argumento (Digite Nome a ser substituido) da alteração de titulo produto não foi preenchida! Por favor Preencha!");
			$('#AlertModalPreco').modal('show');
		}else{
			if(tc_antigo === ""){
				$('#AlertModalPreco .modal-body').html("O argumento (Digite Nome a ser substituido) da alteração de titulo categoria não foi preenchida! Por favor Preencha!");
				$('#AlertModalPreco').modal('show');
			}else{
				if(tc_substituto === ""){
					$('#AlertModalPreco .modal-body').html("O argumento (Digite Nome que vai substituir) da alteração de titulo categoria não foi preenchida! Por favor Preencha!");
					$('#AlertModalPreco').modal('show');
				}else{
					if(tp_substituto === ""){
						$('#AlertModalPreco .modal-body').html("O argumento (Digite Nome que vai substituir) da alteração de titulo produto não foi preenchida! Por favor Preencha!");
						$('#AlertModalPreco').modal('show');
					}else{

						tipo = 3;
					}
				}
			}
		}

	}
}
// --------------------------------------------------------------------------------------------------------------------------

if(tipo == 0){

}else{

	var enviad = new FormData();


	if(tipo == 2){
		enviad.set('p_antigo',tp_antigo);
		enviad.set('p_novo',tp_substituto);
	}else if(tipo == 1){
		enviad.set('c_antigo',tc_antigo);
		enviad.set('c_novo',tc_substituto);
	}else if(tipo == 3){
		enviad.set('p_antigo',tp_antigo);
		enviad.set('p_novo',tp_substituto);
		enviad.set('c_antigo',tc_antigo);
		enviad.set('c_novo',tc_substituto);
	}

	// console.log(tipo);

	$.ajax({
		url:"backend/ConfigCatProd/tratandodados.php",
		type:"POST",
		data:enviad,
		contentType:false,
		async:false,
		processData:false,
		success:function(data){
			$('#recebe').html(data);
		}
	});

}

});
	});
</script>