<?php

if(isset($_POST['v1']) && isset($_POST['qtde_sm'])){
	$v1 = $_POST['v1'];
	$qtde_sm = $_POST['qtde_sm'];
	$v2 = $v1 + $qtde_sm;
}else{
	$v1 = 0;
	$v2 = 100;
}
$contador_category = 0;
$maiorid = 0;
include "../conexao.php";
				// function recursiva
function recursiva($ct_id,$ct_name){
	global $maiorid;
	include "../conexao.php";
	if($maiorid >=$ct_id){

	}else{
		$maiorid = $ct_id;
	}

	global $contador_category;
	global $v1;
	global $v2;
	

	$res_category_nv1 = mysqli_query($con,"SELECT * FROM isc_categories WHERE catparentid=$ct_id");

	if(mysqli_num_rows($res_category_nv1) > 0){
		
		echo "<ul id='ul_id_".$ct_id."'>";

		if($contador_category >= $v1 && $contador_category <= $v2){
		echo "<label id='lb_id_".$ct_id."'>";

		echo "<input type='checkbox' name='id_".$ct_id."' id='id_".$ct_id."' value='".$ct_id."'>";
		echo "<span class='icon'></span>";
		echo "<span class='list' id='span_name".$ct_id."'>".$ct_name."</span>";

		echo "</label>";
		}
		$contador_category++;
		while($exibe_category_vl1 = mysqli_fetch_array($res_category_nv1)){
			
				$id_vl1 = $exibe_category_vl1['categoryid'];
				$name_vl1 = $exibe_category_vl1['catname'];
				recursiva($id_vl1,$name_vl1);
			
			
		}



		echo "</ul>";



	}else{
		if($contador_category >= $v1 && $contador_category <= $v2){

			echo "<li>";
			echo "<label>";

			echo "<input type='checkbox' name='id_".$ct_id."' id='id_".$ct_id."' value='".$ct_id."'>";
			echo "<span class='icon'></span>";
			echo "<span class='list' id='span_name".$ct_id."'>".$ct_name."</span>";

			echo "</label>";
			echo "</li>";
		}
		$contador_category++;
	}
	
}



$res_category = mysqli_query($con,"SELECT * FROM isc_categories");



while($exibe = mysqli_fetch_array($res_category)){
	$cat_id = $exibe['categoryid'];
	$cat_name = $exibe['catname'];

	if($exibe['catparentid'] == 0){
		recursiva($cat_id,$cat_name);
	}
}



?>

<script>
	$(document).ready(function(){
		//#f08f2c
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
						var contador_category = "<?php echo $maiorid;?>";
						var dadosCat = new FormData();
						dadosCat.set('cont_category',contador_category);
						dadosCat.set('ini_prod_qtd',ini_prod_qtd);
						dadosCat.set('final_prod_qtd',final_prod_qtd);
						dadosCat.set('ini_alt_valor_inic',ini_alt_valor_inic);
						dadosCat.set('final_alt_valor_inic',final_alt_valor_inic);
						dadosCat.set('porcnt_num',porcnt_num);
						// console.log(contador_category);
						for(var ist = 1;ist<=contador_category;ist++){
							if($('.containerdireita .category_select input#id_'+ist).is(':checked')){
								var valor = $('.containerdireita .category_select input#id_'+ist).val();
								dadosCat.set('category_id_'+ist,valor);
								// console.log(valor);
							}
						}
						if($('.containerdireita .category_select input#todos_prods').is(':checked')){
							dadosCat.set('verif_tudo',1);
						}else{
							dadosCat.set('verif_tudo',0);
						}

						$.ajax({
							url:'backend/vertentePrecos/CategoriasClick_cadastra_regra.php',
							type:'POST',
							data:dadosCat,
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
</script>