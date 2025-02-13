<?php 
	include "../conexao.php";


	$p_antigo = $_POST['p_antigo'];
	$p_novo = $_POST['p_novo'];



	$pesq_name_prod = mysqli_query($con,"SELECT * FROM isc_products WHERE prodname LIKE '%".$p_antigo."%' LIMIT 1 OFFSET 0");

	if(mysqli_num_rows($pesq_name_prod) != 0){
		$exi = mysqli_fetch_array($pesq_name_prod);
			$name = $exi['prodname'];
			$prodid = $exi['productid'];
			$altera = str_replace($p_antigo, $p_novo, $name);


			$altera_name_prod = mysqli_query($con,"UPDATE isc_products SET prodname='$altera' WHERE productid=$prodid");

			

		
	}

 ?>