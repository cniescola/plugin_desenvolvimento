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


$pesquisa_cat = mysqli_query($con,"SELECT * FROM isc_categories LIMIT 1 OFFSET $cont");

while($exibe_pesq_cat = mysqli_fetch_array($pesquisa_cat)){
	$nome = $exibe_pesq_cat['catname'];
	$idcat = $exibe_pesq_cat['categoryid'];
	$tel = " ";
	$cit = " ";
	for($i = 1; $i<=$num2; $i++){
		$tel .= $telefone[$i]." ";
	}

	for($i = 1; $i<=$num1; $i++){
		$cit .= $cidade[$i]." ";
	}


	$concat = $nome.$tel.$cit;


	$upload = mysqli_query($con,"UPDATE isc_categories SET catpagetitle='$concat' WHERE categoryid='$idcat'");

	$res_upload = mysqli_affected_rows($con);

	if($res_upload >0){

		$cit = $nome." ";
		for($i = 1; $i<=$num1; $i++){
			$cit .= $nome." ".$cidade[$i]." ";
			
		}
		$concat = $cit;

		$upload2 = mysqli_query($con,"UPDATE isc_categories SET catmetakeywords='$concat' WHERE categoryid='$idcat'");
		$res_upload2 = mysqli_affected_rows($con);

		if($res_upload2 >0){
			$upload3 = mysqli_query($con,"UPDATE isc_categories SET catsearchkeywords='$concat' WHERE categoryid='$idcat'");
			$res_upload3 = mysqli_affected_rows($con);

			if($res_upload3 >0){

				$cat_pesquisa = mysqli_query($con,"SELECT * FROM isc_categories WHERE categoryid='$idcat'");


				while ($exibe_cat_pesquisa = mysqli_fetch_array($cat_pesquisa)) {
					$catparentid = $exibe_cat_pesquisa['catparentid'];

					$cat_cadastra = recursiv($catparentid,$idcat);
					// echo "<script>console.log('".$cat_cadastra."');</script>";
					$upload10 = mysqli_query($con,"UPDATE isc_categories SET catmetadesc='$cat_cadastra' WHERE categoryid='$idcat'");

				}

                echo "<p><strong>Nome da Categoria: </strong>".$nome."</p><p style=color:green;><strong>Sucesso</strong></p><br>";
			}else{
                echo "<p><strong>Nome da Categoria: </strong>" . $nome . "</p><p style=color:red;><strong>Falha Ao Cadastrar </strong>-> Meta tag Search Key Word já cadastrada</p><br>";
            }
		}else{
            echo "<p><strong>Nome da Categoria: </strong>" . $nome . "</p><p style=color:red;><strong>Falha Ao Cadastrar </strong>-> Meta tag Key Word já cadastrada</p><br>";
        }
	}else{
        echo "<p><strong>Nome da Categoria: </strong>" . $nome . "</p><p style=color:red;><strong>Falha Ao Cadastrar </strong>-> Meta tag Titulo da Categoria já cadastrada</p><br>";
    }

}






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