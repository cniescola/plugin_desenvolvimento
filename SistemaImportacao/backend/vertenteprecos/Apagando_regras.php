<?php 	
		include "../conexao.php";

		$id = $_POST['id'];
		$res = mysqli_query($con,"DELETE FROM a_regras_limitador_precos WHERE id=$id");

		

		if(mysqli_affected_rows($con) == 0){
			echo "ERRO AO DELETAR REGRA";
		}else{
			echo "SUCESSO AO DELETAR REGRA";
		}


 ?>

 <script>
	$(document).ready(function(){
		$.ajax({

			url: "backend/vertentePrecos/Listagem_de_regra.php",

			success: function(data){
				$('.topo_preco .corpo .q_block .listagem').html(data);

			},

			beforeSend: function(){

			},

			complete: function(){

			}

		});
	});
</script>