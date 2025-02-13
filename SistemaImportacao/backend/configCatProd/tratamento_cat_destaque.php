<?php
while($exibe = mysqli_fetch_array($pesq_categoria)){
	$id = $exibe['categoryid'];
	$name = $exibe['catname'];

	$pesq_categoriaAssosiation = mysqli_query($con,"SELECT * FROM isc_categoryassociations WHERE categoryid=".$id."");

	if(mysqli_num_rows($pesq_categoriaAssosiation) != 0){
		// echo "<script>console.log('".$name."');</script>";
		// echo "<script>console.log('Existe');</script>";
	}else{

		$pesq_prod = mysqli_query($con,"SELECT * FROM isc_products WHERE prodfeatured=1");

		$cont_featured = mysqli_num_rows($pesq_prod);
		?>

		<script>
			var cont = 0;
			var cont_featured = "<?php echo $cont_featured; ?>";
			var dados = new FormData();
			var jason = 0;
			var drop = 0;
			var soma = 0;
			var cont_prod =cont_featured;
			soma = 100/cont_prod;

			function cadasDest(cont,cont_featured){

				var categoryid = "<?php echo $id; ?>";


				if(cont < cont_featured){
					dados.set('categoryid',categoryid);
					dados.set('cont',cont);

					$.ajax({
						url:"backend/ConfigCatProd/tratamento_destaque.php",
						type:"POST",
						data:dados,
						contentType:false,
						async:false,
						processData:false,
						success:function(data){
							$('#recebtrat').html(data);
							cont++;
							setTimeout(() => {cadasDest(cont,cont_featured)},1000);

						}
					});

					jason = jason+soma;
					drop = jason;
				jason = Math.ceil(jason);//metodo de arredondamento para o maior

				$(".content4").css({display: 'inherit'});
				$(".principalContainer .header_top .progress").attr("style","width:"+jason+"%;");
				$(".principalContainer .header_top .Value").text(jason+"%");
				$(":root").css("--largura-bg",drop+"%");
				var el = $(".principalContainer .header_top .percent > div:nth-child(1)"), 
				newone = el.clone(true);
				el.before(newone);
				$("." + el.attr("progress") + ":last").remove();
				$(".principalContainer .header_top .progress");
				$(".principalContainer .header_top .Name").html(cont);
				jason = drop;

			}

		}

		cadasDest(cont,cont_featured);



	</script>

	<?php
}
}
