<link rel="stylesheet" href="css/sistemaCodificacao.css">

<div class="header_top" >
		<h1>Sistema Gerador de Codigos De Produtos</h1>

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

<div class="container1">
    <p class="titulo_green">CLIQUE NO BOTÃO PARA GERAR AS IDENTIFICAÇÕES -> ( codigos )</p>
	<div class="section1"><div></div></div>
	<a class="btn botao" href="#">CRIAR CODIFICAÇÃO</a>
</div>

<div id="print" style="display: none;"></div>
<div id="print2"></div>

<script>
	$(document).ready(function(){
		$('.container1 .botao').click(function(){
			$.ajax({
				url:'backend/codificando/identificandoProduto.php',
				contentType: false,
				async: false,
				processData: false,
				success: function( data ){

					$('#print').html( data );

				}
			});
		});
	});
</script>