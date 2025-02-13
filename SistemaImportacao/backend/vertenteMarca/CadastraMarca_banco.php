<?php 
include "../conexao.php";

if(isset($_POST['ini_alt_valor_inic']) && isset($_POST['final_alt_valor_inic']) && isset($_POST['brandid']) && isset($_POST['v1'])){
	$ini_alt_valor_inic = $_POST['ini_alt_valor_inic'];
	$final_alt_valor_inic = $_POST['final_alt_valor_inic'];
	$brandid = $_POST['brandid'];
	$v1 = $_POST['v1'];

	$pesq_prod = mysqli_query($con,"SELECT * FROM isc_products WHERE (prodprice BETWEEN $ini_alt_valor_inic AND $final_alt_valor_inic) LIMIT 1 OFFSET $v1");

	if(mysqli_num_rows($pesq_prod) == 0){
		?>
		<script>
			$('#AlertModalPreco .modal-body').html("Erro ao localizar produto");
			$('#AlertModalPreco').modal('show');
		</script>
		<?php
	}else{
		$exibe = mysqli_fetch_array($pesq_prod);
		$idprod = $exibe['productid'];
		$atualiza_prod = mysqli_query($con,"UPDATE isc_products SET prodbrandid=$brandid WHERE productid=$idprod");

		if(mysqli_affected_rows($con) == 0){
			// echo "<script>console.log('marca já cadastrada anteriomente');</script>";
		}else{
			// echo "<script>console.log('sucesso cadastramento inicio ".$idprod."');</script>";
		}
	}
}else{
	// echo "<script>console.log('ruim');</script>";
}
?>