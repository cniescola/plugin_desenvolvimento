<?php 
include "../conexao.php";
if(isset($_POST['cont'])){
$cont = $_POST['cont'];
$res_isc_products = mysqli_query($con,"SELECT * FROM isc_products LIMIT 1 OFFSET $cont");
$i = 0;


while($exibe_isc_products = mysqli_fetch_array($res_isc_products)){
	$comcat = 0;
	$int = 0;
	$id = $exibe_isc_products['productid'];
	$prodbrandid = $exibe_isc_products['prodbrandid'];
    $prodname = $exibe_isc_products['prodname'];
	$tuts = 0;


	$res_isc_categoryassociations = mysqli_query($con,"SELECT * FROM isc_categoryassociations WHERE productid='$id' ");

	while($exibe_isc_categoryassociation = mysqli_fetch_array($res_isc_categoryassociations)){
		$categoria = $exibe_isc_categoryassociation['categoryid'];



		$catcomcat = recursivaPesq($categoria,$int,$comcat);
		$catcomcat = strrev($catcomcat);

		if($catcomcat > $tuts){
			$catcomcat = $catcomcat;
			$tuts = $catcomcat;
		}else{
			$catcomcat = $tuts;
		}
	}


	$comcat = $catcomcat."0";

	$comcat .= $id;

    

	$atualiza = mysqli_query($con,"UPDATE isc_products SET prodcode='$comcat' WHERE productid='$id' ");


	if($res = mysqli_affected_rows($con) > 0){

        echo "<script>$('.container1 .section1 > div').append('<p><strong>Produto: </strong>".$prodname."</p><p><strong>Novo Codigo: </strong>".$comcat."</p><br>');</script>";

		$atualiza2 = mysqli_query($con,"UPDATE isc_product_search SET prodcode='$comcat' WHERE productid='$id' ");

		if($res2 = mysqli_affected_rows($con) > 0){
           
		}else{
            
        }
	}else{
        
        echo "<script>$('.container1 .section1 > div').append('<p><strong>Erro ao Cadastrar Codigo do Produto: </strong>".$prodname."</p><p>CODIGO DE PRODUTO JÁ CADASTRADO!</p><br>');</script>";
    }
	
}

}





?>

<?php 



function recursivaPesq($categoria,$int,$valor){
	include "../conexao.php";


	$res_isc_categories = mysqli_query($con,"SELECT * FROM isc_categories WHERE categoryid = '$categoria' ");

	$exibe_isc_categories = mysqli_fetch_array($res_isc_categories);

	if($chop = mysqli_num_rows($res_isc_categories) >0 ){

		$categoriaparent = $exibe_isc_categories['catparentid'];
		$catsort = $exibe_isc_categories['catsort'];



		if($categoriaparent == '0'){
			$valor .= $catsort;
			return $valor;
		}else{
			if($catsort > 999){

				$catsort = strval($catsort);
				$strcatsort = strlen($catsort);
				$strcatsort = $strcatsort - 1;

				$rest = substr($catsort,0,1);

				for($j = 0; $j < $strcatsort;$j++){
					$rest = $rest.'0';
				}

				$rest = intval($rest);
				$catsort = intval($catsort);

				
				
				$catsort = $catsort - $rest;
				
				if($catsort > 9){
					$catsort = strrev($catsort);
				}
				$valor .= $catsort;
				$int++;
				return recursivaPesq($categoriaparent,$int,$valor);
			}else{
				if($catsort > 9){
					$catsort = strrev($catsort);
				}
				$valor .= $catsort;
				$int++;
				return recursivaPesq($categoriaparent,$int,$valor);
			}

			


		}

	}else{
		$valor .= $categoria;
		return $valor;
	}
	



}


?>