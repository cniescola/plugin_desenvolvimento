<link rel="stylesheet" type="text/css" href="css/importacaoExcel.css">

<div class="header_top" >
		<h1>Sistema de Upload Dados Via Excel</h1>

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


<form method="post" action="processa.php" id="form1" enctype="multipart/form-data">

	<p class="titulo_green">Clique abaixo para buscar planilha</p>

	<div class="container1">

		<div>
			
			<div class="sq_right">
				<label for="arquivoExcel">
					<span><ion-icon name="add-outline"></ion-icon></span>
					<input type="file" name="arquivo" id="arquivoExcel">
				</label>

				<label>
					<div>
						<img src="img/pla.png">
						<p>testando 123</p>
					</div>
				</label>
			</div>

			<div class="sq_left">
				<div class="load1">
					<div class="loader"></div>
					<p>Carregando...</p>
				</div>
				
			</div>
		</div>

	</div>

	<div class="res"></div>
	<div class="container2">

	<a href="#" class="btn"><span>Fazer Upload De Planilha</span></a>
		
		<script>
			$(document).ready(function(){

				$(".container2 .btn").click(function(){
					var nomeArquvo = $(".container1 .sq_right > label input#arquivoExcel").val();
					nomeArquvo = nomeArquvo.length;

					if(nomeArquvo > 0){

						var formData = new FormData();//a forma de declaração "let" serve pra limitar a variavel a existir somente nessa função -- já o formData cria um banco de dados muito parecido com json ou xml
						var file1 = $('.container1 .sq_right > label input#arquivoExcel')[0].files[0];
						var cont = 1;
						formData.append('file1',file1);
						formData.append('cont',cont);
						$.ajax({
							url: 'backend/importacaoExcel/processoimport.php',
							type:'POST',
							data: formData,
							contentType:false,
							async:false,
							processData:false,
							success: function( data ){
								$('.container1 .sq_left .load1').css({
									display:'flex'
								});

								$('.res').html(data);


							}
						});
					}
				});

				$("#arquivoExcel").change(function() {

					var nomeArquvoC = $(".container1 .sq_right > label input#arquivoExcel").val();

					$(".container1 .sq_right > label:nth-child(2)").css({
						display: 'flex'
					});
					$(".container1 > div > div:nth-child(1)").css({
						justifyContent:'space-evenly'
					});

					$(".container1 .sq_right > label:nth-child(2) > div > p").html(nomeArquvoC);
				});
			});
		</script>
	</div>
</form>
