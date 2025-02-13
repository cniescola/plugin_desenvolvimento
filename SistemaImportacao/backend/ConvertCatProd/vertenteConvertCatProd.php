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
$cont = 0;

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
	global $cont;
	
	

	$res_category_nv1 = mysqli_query($con,"SELECT * FROM isc_categories WHERE catparentid=$ct_id");

	if(mysqli_num_rows($res_category_nv1) > 0){
		
		echo "<ul id='ul_id_".$ct_id."'>";

		if($contador_category >= $v1 && $contador_category <= $v2){
		echo "<label>";

		echo "<input type='checkbox' name='id_".$ct_id."' id='id_".$ct_id."' class='clas_".$cont." cls' value='".$ct_id."'>";
		echo "<span class='icon'></span>";
		echo "<span class='list' id='span_name".$ct_id."'>".$ct_name."</span>";

		echo "</label>";
		$cont++;
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

			echo "<input type='checkbox' name='id_".$ct_id."' id='id_".$ct_id."' class='clas_".$cont." cls' value='".$ct_id."'>";
			echo "<span class='icon'></span>";
			echo "<span class='list' id='span_name".$ct_id."'>".$ct_name."</span>";

			echo "</label>";
			echo "</li>";
			$cont++;
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
