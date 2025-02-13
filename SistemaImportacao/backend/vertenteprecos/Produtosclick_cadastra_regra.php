<?php 	
include '../conexao.php';

$ini_prod_qtd = $_POST['ini_prod_qtd'];
$final_prod_qtd = $_POST['final_prod_qtd'];
$ini_alt_valor_inic = $_POST['ini_alt_valor_inic'];
$final_alt_valor_inic = $_POST['final_alt_valor_inic'];
$porcnt_num = $_POST['porcnt_num'];

$res = mysqli_query($con,"INSERT INTO a_regras_limitador_precos (id,tipo,porcentagem,valor1,valor2,id_conf_regra,ini_limitador,end_limitador) VALUES (NULL,'3','$porcnt_num','$ini_alt_valor_inic','$final_alt_valor_inic','0','$ini_prod_qtd','$final_prod_qtd')");

$cont = mysqli_affected_rows($con);

if($cont == 0){
	echo "FALHA AO CADASTRAR NOVA REGRA";
}else{
	echo "SUCESSO AO CADASTRAR REGRA";
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