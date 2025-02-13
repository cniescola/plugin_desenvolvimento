<?php 
include "../conexao.php";

if(isset($_POST['tipo_regra']) && isset($_POST['porcentagem_regra']) && isset($_POST['valor1_regra']) && isset($_POST['valor2_regra']) && isset($_POST['id_conf_regra_regra']) && isset($_POST['ini_limitador'])){


	$tipo_psq= $_POST['tipo_regra'];
	$porcentagem_regra= $_POST['porcentagem_regra'];
	$valor1_regra= $_POST['valor1_regra'];
	$valor2_regra= $_POST['valor2_regra'];
	$id_conf_regra_regra= $_POST['id_conf_regra_regra'];
	$ini_limitador= $_POST['ini_limitador'];

	$qtd_limitador = 1;

	if($tipo_psq == 1){
		$pesq_prod = mysqli_query($con,"SELECT * FROM isc_products WHERE ((prodprice BETWEEN $valor1_regra AND $valor2_regra) AND (prodcatids = $id_conf_regra_regra)) LIMIT $qtd_limitador OFFSET $ini_limitador");
		if(mysqli_num_rows($pesq_prod) == 0){

		}else{
			

			while($exibe_prod = mysqli_fetch_array($pesq_prod)){
				$prodid = $exibe_prod['productid'];
				$prodprice = $exibe_prod['prodprice'];
				$cal = ($prodprice/100)*$porcentagem_regra;
				$cal = $cal + $prodprice;
				mysqli_query($con,"UPDATE isc_products SET prodcalculatedprice=$cal WHERE productid=$prodid");

				if(mysqli_affected_rows($con) == 0){
					echo "Preço produto categoria não cadastrado";
				}else{
					echo "Deu certo para produto categoria";
				}
			}


		}
	}else if($tipo_psq == 2){
		$pesq_prod = mysqli_query($con,"SELECT * FROM isc_products WHERE ((prodprice BETWEEN $valor1_regra AND $valor2_regra) AND (prodbrandid = $id_conf_regra_regra)) LIMIT $qtd_limitador OFFSET $ini_limitador");
		if(mysqli_num_rows($pesq_prod) == 0){

		}else{
			

			while($exibe_prod = mysqli_fetch_array($pesq_prod)){
				$prodid = $exibe_prod['productid'];
				$prodprice = $exibe_prod['prodprice'];
				$cal = ($prodprice/100)*$porcentagem_regra;
				$cal = $cal + $prodprice;
				mysqli_query($con,"UPDATE isc_products SET prodcalculatedprice=$cal WHERE productid=$prodid");

				if(mysqli_affected_rows($con) == 0){
					echo "Preço produto por marca não cadastrado";
				}else{
					echo "Deu certo para produto marca";
				}
			}


		}
	}else if($tipo_psq == 3){
		$pesq_prod = mysqli_query($con,"SELECT * FROM isc_products WHERE (prodprice BETWEEN $valor1_regra AND $valor2_regra) LIMIT $qtd_limitador OFFSET $ini_limitador");
		if(mysqli_num_rows($pesq_prod) == 0){

		}else{
			

			while($exibe_prod = mysqli_fetch_array($pesq_prod)){
				$prodid = $exibe_prod['productid'];
				$prodprice = $exibe_prod['prodprice'];
				$cal = ($prodprice/100)*$porcentagem_regra;
				$cal = $cal + $prodprice;
				mysqli_query($con,"UPDATE isc_products SET prodcalculatedprice=$cal WHERE productid=$prodid");

				if(mysqli_affected_rows($con) == 0){
					echo "Preço produto não cadastrado";

				}else{
					echo "Deu certo para produto";
					echo $prodid."<br>";
					echo $prodprice;
				}
			}


		}
	}else if($tipo_psq == 4){}

}else{
	echo "Variaveis não enviadas";
}
?>