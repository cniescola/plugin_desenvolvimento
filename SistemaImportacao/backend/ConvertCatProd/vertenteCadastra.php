<?php 
	include "../conexao.php";

	$image = $_FILES['image']['name'];
	$id_cat = $_POST['id_cat'];
	$very = $_POST['very'];
	$isct = $_POST['isct'];
	
	if($very == 0){
		$pesq_cat = mysqli_query($con,"SELECT * FROM isc_categories WHERE categoryid=$id_cat");
	}else{
		$pesq_cat = mysqli_query($con,"SELECT * FROM isc_categories LIMIT 1 OFFSET $isct");
	}
	while($exb = mysqli_fetch_array($pesq_cat)){
		$catname = $exb['catname'];
		$catpagetitle = $exb['catpagetitle'];
		$catmetakeywords = $exb['catmetakeywords'];
		$catmetadesc = $exb['catmetadesc'];
		$catsearchkeywords = $exb['catsearchkeywords'];
	}

	// echo "<script>console.log('".$catname."')</script>";

	$cadastra_prod = mysqli_query($con,"INSERT INTO isc_products (productid,prodname,prodsearchkeywords,prodpagetitle,prodmetakeywords,prodmetadesc,prodlayoutfile,prodcallforpricinglabel,prodcatids,prodeventdatefieldname,prodcondition,opengraph_type,prodtype,prodvisible,prodfeatured,prodrelatedproducts,prodoptionsrequired,prodhastags) VALUES (NULL,'$catname','$catsearchkeywords','$catpagetitle','$catmetakeywords','$catmetadesc','product.html','COTAR PREÇO','$id_cat','Data de entrega','New','product','1','1','1','-1','1','1')");

	if(mysqli_affected_rows($con)){
		// echo "<script>console.log('Deu certo')</script>";
		$id = mysqli_insert_id($con);
		// echo "<script>console.log('".$id."')</script>";

		$image = $catname.$image;
		$movendo = '/home/tudoserralheria/public_html/product_images/imgs/'.$image;

		move_uploaded_file($_FILES['image']['tmp_name'], $movendo);
		$movendo = 'imgs/'.$image;
		$inserindo_img =mysqli_query($con,"INSERT INTO isc_product_images (imageid,imageprodid,imagefile,imageisthumb,imagesort,imagefiletiny,imagefilethumb,imagefilestd,imagefilezoom,imagefiletinysize,imagefilethumbsize,imagefilestdsize,imagefilezoomsize) VALUES (NULL,'$id','$movendo','1','0','$movendo','$movendo','$movendo','$movendo','98x97','220x217','220x217','349x344')");
		
		$inserindo_child = mysqli_query($con,"INSERT INTO isc_categoryassociations (associationid,productid,categoryid) VALUES (NULL,'$id','$id_cat')");

		


	}else{
		// echo "<script>console.log('Deu errado')</script>";
	}
 ?>