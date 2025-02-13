<?php 
	include "../conexao.php";


	$c_antigo = $_POST['c_antigo'];
	$c_novo = $_POST['c_novo'];



	$pesq_name_cat = mysqli_query($con,"SELECT * FROM isc_categories WHERE catname LIKE '%".$c_antigo."%' LIMIT 1 OFFSET 0");

	if(mysqli_num_rows($pesq_name_cat) != 0){
		$exi = mysqli_fetch_array($pesq_name_cat);
			$name = $exi['catname'];
			$categoryid = $exi['categoryid'];
			$altera = str_replace($c_antigo, $c_novo, $name);


			$altera_name_prod = mysqli_query($con,"UPDATE isc_categories SET catname='$altera' WHERE categoryid=$categoryid");

			

		
	}

 ?>