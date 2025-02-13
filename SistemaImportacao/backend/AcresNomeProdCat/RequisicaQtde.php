<?php 

if(isset($_POST['c']) && isset($_POST['coleta']) && isset($_POST['id_cat'])){
	include "../conexao.php";
	$c = $_POST['c'];
	$coleta = $_POST['coleta'];
	$id_cat = $_POST['id_cat'];

	$pesq = mysqli_query($con,"SELECT * FROM isc_categoryassociations WHERE categoryid=$id_cat");

	$cont = mysqli_num_rows($pesq);
 

	if($c < $cont){
		$pesqc = mysqli_query($con,"SELECT * FROM isc_categoryassociations WHERE categoryid=$id_cat LIMIT 1 OFFSET $c");

		if($c == 1){
			echo $cont;
		}else{
			echo "j";
		}



		while($exb = mysqli_fetch_array($pesqc)){
			$id_prod = $exb['productid'];
		}

		$pesqp = mysqli_query($con,"SELECT * FROM isc_products WHERE productid=$id_prod");

		if(mysqli_num_rows($pesqp) != 0){
			while($exbp = mysqli_fetch_array($pesqp)){
				$prodname = $exbp['prodname'];
			}

			$atu_prodname = $prodname." ".$coleta;

			$atualiza = mysqli_query($con,"UPDATE isc_products SET prodname='$atu_prodname' WHERE productid='$id_prod'");

			// if(mysqli_affected_rows($con) != 0){
			// 	echo "deu certo";
			// }else{
			// 	echo "deu errado";
			// }
		}

	}else{
		echo "0";
	}


}
?>