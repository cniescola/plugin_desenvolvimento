<div class="skills">
	<span class="Name">Html</span>
	<div class="percent">
		<div class="progress" style="width: 0%;"></div>
	</div>
	<span class="Value">0%</span>
</div>
<div id="recebe_coisas"></div>
<?php 
include "../conexao.php";

if(isset($_POST['ini_prod_qtd']) && isset($_POST['final_prod_qtd']) && isset($_POST['ini_alt_valor_inic']) && isset($_POST['final_alt_valor_inic']) && isset($_POST['name_marc'])){
	$ini_prod_qtd = $_POST['ini_prod_qtd'];
	$final_prod_qtd = $_POST['final_prod_qtd'];
	$ini_alt_valor_inic = $_POST['ini_alt_valor_inic'];
	$final_alt_valor_inic = $_POST['final_alt_valor_inic'];
	$name_marc = $_POST['name_marc'];



	$pesq_brand = mysqli_query($con,"SELECT * FROM isc_brands WHERE brandname='$name_marc'");

	if(mysqli_num_rows($pesq_brand) == 0){
		$cadastra_new_brand = mysqli_query($con,"INSERT INTO isc_brands (brandid,brandname,brandpagetitle,brandmetakeywords,brandmetadesc,brandimagefile,brandsearchkeywords) VALUES (NULL,'$name_marc','','','','','')");

		if(mysqli_affected_rows($con) == 0){
			?>
			<script>
				$('#AlertModalPreco .modal-body').html("isc_brand NÃO CADASTRADO");
				$('#AlertModalPreco').modal('show');
			</script>
			<?php
		}else{
			$brandid = mysqli_insert_id($con);
			$cadastra_new_brand_search = mysqli_query($con,"INSERT INTO isc_brand_search (brandsearchid,brandid,brandname,brandpagetitle,brandsearchkeywords) VALUES (NULL,'$brandid','$name_marc','','')");

			if(mysqli_affected_rows($con) == 0){
				?>
				<script>
					$('#AlertModalPreco .modal-body').html("isc_brand_search NÃO CADASTRADO");
					$('#AlertModalPreco').modal('show');
				</script>
				<?php
			}else{
				// Procedimento ocorreu de forma correta
				$qtd_limitador = $final_prod_qtd - $ini_prod_qtd;
				$pesq_prod = mysqli_query($con,"SELECT * FROM isc_products WHERE (prodprice BETWEEN $ini_alt_valor_inic AND $final_alt_valor_inic) LIMIT $qtd_limitador OFFSET $ini_prod_qtd");


				$cont_prod = mysqli_num_rows($pesq_prod);
				?>
				<script>
					$(document).ready(function(){
						var brandid = "<?php echo $brandid; ?>";
						var cont_prod = "<?php echo $cont_prod; ?>";
						var ini_prod_qtd = "<?php echo $ini_prod_qtd; ?>";
						var ini_alt_valor_inic = "<?php echo $ini_alt_valor_inic; ?>";
						var final_alt_valor_inic = "<?php echo $final_alt_valor_inic; ?>";
						var name_marc = "<?php echo $name_marc; ?>";
						var time = 1000;
						var plus = 0;
						var dd = new FormData();

						dd.set('ini_alt_valor_inic',ini_alt_valor_inic);
						dd.set('brandid',brandid);
						dd.set('final_alt_valor_inic',final_alt_valor_inic);

						var cont_ctpd = parseInt(ini_prod_qtd);
						var jason = 0;
						var drop = 0;
						var soma = 0;
						soma = 100/cont_prod;
						function cadastra(plus,cont_ctpd){

							if(plus < cont_prod){
								plus++;
								dd.set('v1',cont_ctpd);

								$.ajax({
									url:'../backend/vertenteMarca/CadastraMarca_banco.php',
									type:'POST',
									data:dd,
									contentType:false,
									async:false,
									processData:false,
									success: function( data ){

										$('#recebe_coisas').html(data);

									}
								});

								jason = jason+soma;
								drop = jason;

								$(".progress").attr("style","width:"+jason+"%;");
								$(".Value").text(jason+"%");
								$(":root").css("--largura-bg",drop+"%");
								var el = $(".percent > div:nth-child(1)"), 
								newone = el.clone(true);
								el.before(newone);
								$("." + el.attr("progress") + ":last").remove();

								cont_ctpd = cont_ctpd+1;
								setTimeout(() => {cadastra(plus,cont_ctpd)},time);
							}
						}

						cadastra(plus,cont_ctpd);


					});
				</script>
				<?php

				// Procedimento ocorreu de forma correta
				
			}

		}
	}else{
		?>
		<script>
			$('#AlertModalPreco .modal-body').html("ENCONTROU UMA IGUAL");
			$('#AlertModalPreco').modal('show');
			// console.log("igual");
		</script>
		<?php
	}

	?>


	<script>
		$(document).ready(function(){
			$('.content4').attr('style','display:flex');
		});
	</script>


	<?php

}else{
	?>
	<script>
		$('#AlertModalPreco .modal-body').html("Dados não recebidos");
		$('#AlertModalPreco').modal('show');
	</script>
	<?php
}
?>