<?php 
    include "../conexao.php";


    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $cont = $_POST['cont'];

    for($i = 1; $i<=$num1; $i++){
        $cidade[$i] = $_POST['cidade'.$i];
       
    }

    for($i = 1; $i<=$num2; $i++){
        $telefone[$i] = $_POST['telefone'.$i];
        
    }

    // cadastrando TITULO DE PAGINA
$pesquisa_prod = mysqli_query($con,"SELECT * FROM isc_products LIMIT 1 OFFSET $cont");

while($exibe_pesq_prod = mysqli_fetch_array($pesquisa_prod)){
	$productid = $exibe_pesq_prod['productid'];
	$nome = $exibe_pesq_prod['prodname'];
	$categoria = $exibe_pesq_prod['prodcatids'];
	

	$tel = " ";
	$cit = " ";
	for($i = 1; $i<=$num2; $i++){
		$tel .= $telefone[$i]." ";
	}

	for($i = 1; $i<=$num1; $i++){
		$cit .= $cidade[$i]." ";
	}


	$concat = $nome.$tel.$cit;
	
    

	$upload = mysqli_query($con,"UPDATE isc_products SET prodpagetitle='$concat' WHERE productid='$productid'");

	$res_upload = mysqli_affected_rows($con);

	if($res_upload >0){

		$cit = $nome.", ";
		for($i = 1; $i<=$num1; $i++){
			$cit .= $nome." ".$cidade[$i].",";
			
		}
		$concat = $cit;

		$upload2 = mysqli_query($con,"UPDATE isc_products SET prodsearchkeywords='$concat' WHERE productid='$productid'");

		$res_upload2 = mysqli_affected_rows($con);

		if($res_upload2 >0){

			$upload3 = mysqli_query($con,"UPDATE isc_products SET prodmetakeywords='$concat' WHERE productid='$productid'");
			$res_upload3 = mysqli_affected_rows($con);

			if($res_upload3 >0){
				$upload4 = mysqli_query($con,"UPDATE isc_product_search SET prodsearchkeywords='$concat' WHERE productid='$productid'");
				$res_upload4 = mysqli_affected_rows($con);

				if($res_upload4 >0){
					$cit = strtolower($cit);
					$cit = str_replace(' ', '-', $cit);

					$pesquisa_tag = mysqli_query($con,"SELECT * FROM isc_product_tagassociations WHERE productid='$productid'");

					if(mysqli_num_rows($pesquisa_tag) == 0){



						$insert_BD_tag = mysqli_query($con,"INSERT INTO isc_product_tags (tagid,tagname,tagfriendlyname,tagcount) VALUES (NULL,'$concat','$cit','0')");
						if(mysqli_affected_rows($con) == 0){

						}else{

							$tagid = mysqli_insert_id($con);
							$insert_BD_tags = mysqli_query($con,"INSERT INTO isc_product_tagassociations (tagassocid,tagid,productid) VALUES (NULL,'$tagid','$productid')");

							// if(mysqli_affected_rows($con) == 0){}else{}

						}


					}else{
						$exibe_BD_tag = mysqli_fetch_array($pesquisa_tag);
						$tagid = $exibe_BD_tag['tagid'];

						$pesquisa_tags = mysqli_query($con,"SELECT * FROM isc_product_tags WHERE tagid='$tagid'");

						if(mysqli_num_rows($pesquisa_tags) == 0){

							$insert_BD_tags = mysqli_query($con,"INSERT INTO isc_product_tagassociations (tagassocid,tagid,productid) VALUES ('$tagid','$tagid','$productid')");
							// if(mysqli_affected_rows($con) == 0){}else{}

						}else{

							$update_BD_tags = mysqli_query($con,"UPDATE isc_product_tags SET tagname='$concat', tagfriendlyname='$cit' WHERE tagid='$tagid'");

							// if(mysqli_affected_rows($con) == 0){}else{}
						}
					}



								// fazendo verificação de categoria
					$cat_pesquisa = mysqli_query($con,"SELECT * FROM isc_categories WHERE categoryid='$categoria'");
                    echo "<p><strong>Nome do Produto: </strong>".$nome."</p><p style=color:green;><strong>Sucesso</strong></p><br>";

					while ($exibe_cat_pesquisa = mysqli_fetch_array($cat_pesquisa)) {
						$catparentid = $exibe_cat_pesquisa['catparentid'];

						$cat_cadastra = recursiv($catparentid,$categoria);

						$upload10 = mysqli_query($con,"UPDATE isc_products SET prodmetadesc='$cat_cadastra' WHERE productid='$productid'");

						

					}

	// fazendo verificação de categoria


				}else{
                    echo "<p><strong>Nome do Produto: </strong>" . $nome . "</p><p style=color:red;><strong>Falha Ao Cadastrar </strong>-> Meta tag Searchs Key Word já cadastrada</p><br>";
                }
			}else{
                echo "<p><strong>Nome do Produto: </strong>".$nome."</p><p style=color:red;><strong>Falha Ao Cadastrar </strong>-> Meta tag Key Word já cadastrada</p><br>";
            }

		}else{
            echo "<p><strong>Nome do Produto: </strong>".$nome."</p><p style=color:red;><strong>Falha Ao Cadastrar </strong>-> Meta tag Search Key Word já cadastrada</p><br>";
        }

	}else{
        echo "<p><strong>Nome do Produto: </strong>".$nome."</p><p style=color:red;><strong>Falha Ao Cadastrar </strong>-> Meta tag Titulo já cadastrada</p><br>";
    }


}


?>

<?php 


function recursiv($catparentid,$categoria){
	include "../conexao.php";

	if($catparentid == 0){
		$descricao = 0;
		$pesq_cat = mysqli_query($con,"SELECT * FROM isc_categories WHERE categoryid='$categoria'");
		while($exibe = mysqli_fetch_array($pesq_cat)){
			$descricao = $exibe['catmetadesc'];
		}
		return $descricao;
	}else{
		$pesq_cat = mysqli_query($con,"SELECT * FROM isc_categories WHERE categoryid='$catparentid'");
		while($exibe = mysqli_fetch_array($pesq_cat)){
			$categoria = $exibe['categoryid'];
			$catparentid = $exibe['catparentid'];
		}
		return recursiv($catparentid,$categoria);
	}
}
?>