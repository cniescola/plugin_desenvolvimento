<?php 
	include "../conexao.php";

	if(isset($_POST['cont']) && isset($_POST['contCT']) && isset($_POST['contPF'])){

		$contCT = $_POST['contCT'];
		$contPF = $_POST['contPF'];
		
		$id_pqc = $_POST['vari'];
		$zera = $_POST['zera'];

		if($contPF == 0){
			$pqc = mysqli_query($con,"SELECT * FROM isc_categories LIMIT 1 OFFSET $contCT");
			$exb = mysqli_fetch_array($pqc);
			$id_pqc = $exb['categoryid'];
			$pqc_asso = mysqli_query($con,"SELECT * FROM isc_categoryassociations WHERE categoryid=$id_pqc");
			if(mysqli_num_rows($pqc_asso) == 0){
				$zera = 0;
			}else{
				$zera = 1;
			}

		}

			

		if($id_pqc != 0){
			
				$contPF++;
				$pqp = mysqli_query($con,"SELECT * FROM isc_products WHERE (prodfeatured=1) LIMIT 1 OFFSET $contPF");

			$exbp = mysqli_fetch_array($pqp);
			$id_pqp = $exbp['productid'];

			if($zera == 0){
				$iserindo = mysqli_query($con,"INSERT INTO isc_categoryassociations (associationid,productid,categoryid) VALUES (NULL,$id_pqp,$id_pqc)");
			}
		}

		echo "<script> varic = ".$id_pqc.";</script>";
		echo "<script> zera = ".$zera.";</script>";

		

	}


 ?>