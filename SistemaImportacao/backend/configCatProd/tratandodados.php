<div id="recebtrat"></div>
<?php 

include "../conexao.php";

if(isset($_POST['p_antigo']) && isset($_POST['p_novo']) && !isset($_POST['c_antigo'])){

	$p_antigo = $_POST['p_antigo'];
	$p_novo = $_POST['p_novo'];

	$pesq_name_prod = mysqli_query($con,"SELECT * FROM isc_products WHERE prodname LIKE '%".$p_antigo."%'");

	$contagem = mysqli_num_rows($pesq_name_prod);
	?>
	<script>

		var cont = 1;
		var conti = 0;
		var contagem = "<?php echo $contagem; ?>";
		var jason = 0;
		var drop = 0;
		var soma = 0;
		var cont_prod = "<?php echo $contagem; ?>";
		var cont_ctpd = parseInt(cont_prod);
		soma = 100/cont_prod;

		
		function cadProd(cont,conti){

			if(conti < contagem){
				var mandp = new FormData();
				var p_antigo = "<?php echo $p_antigo;?>";
				var p_novo = "<?php echo $p_novo;?>";

				mandp.set('p_novo',p_novo);
				mandp.set('p_antigo',p_antigo);
				mandp.set('cont',cont);
				mandp.set('conti',conti);
				cont++;
				conti++;
				$.ajax({
					url:"backend/ConfigCatProd/pesq_cad_prod.php",
					type:"POST",
					data:mandp,
					contentType:false,
					async:false,
					processData:false,
					success:function(data){
						$('#recebtrat').html(data);
						setTimeout(() => {cadProd(cont,conti)},1000);
						
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
				cont_ctpd = cont_ctpd+1;
				jason = drop;

			}
		}

		cadProd(cont,conti);
	</script>
	<?php
	

}else if(isset($_POST['c_antigo']) && isset($_POST['c_novo']) && !isset($_POST['p_antigo'])){
	$c_antigo = $_POST['c_antigo'];
	$c_novo = $_POST['c_novo'];

	$pesq_name_cat = mysqli_query($con,"SELECT * FROM isc_categories WHERE catname LIKE '%".$c_antigo."%'");

	$contagem = mysqli_num_rows($pesq_name_cat);

	?>
	<script>

		var cont = 1;
		var conti = 0;
		var contagem = "<?php echo $contagem; ?>";
		var jason = 0;
		var drop = 0;
		var soma = 0;
		var cont_prod = "<?php echo $contagem; ?>";
		var cont_ctpd = parseInt(cont_prod);
		soma = 100/cont_prod;

		
		function cadCat(cont,conti){

			if(conti < contagem){
				var mandp = new FormData();
				var c_antigo = "<?php echo $c_antigo;?>";
				var c_novo = "<?php echo $c_novo;?>";

				mandp.set('c_novo',c_novo);
				mandp.set('c_antigo',c_antigo);
				mandp.set('cont',cont);
				mandp.set('conti',conti);
				cont++;
				conti++;
				$.ajax({
					url:"backend/ConfigCatProd/pesq_cad_cat.php",
					type:"POST",
					data:mandp,
					contentType:false,
					async:false,
					processData:false,
					success:function(data){
						$('#recebtrat').html(data);
						setTimeout(() => {cadCat(cont,conti)},1000);
						
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
				cont_ctpd = cont_ctpd+1;
				jason = drop;

			}
		}

		cadCat(cont,conti);
	</script>
	<?php

}else{
	$p_antigo = $_POST['p_antigo'];
	$c_antigo = $_POST['c_antigo'];
	$p_novo = $_POST['p_novo'];
	$c_novo = $_POST['c_novo'];

	$pesq_name_cat = mysqli_query($con,"SELECT * FROM isc_categories WHERE catname LIKE '%".$c_antigo."%'");
	$pesq_name_prod = mysqli_query($con,"SELECT * FROM isc_products WHERE prodname LIKE '%".$p_antigo."%'");

	$contagemp = mysqli_num_rows($pesq_name_prod);
	$contagemc = mysqli_num_rows($pesq_name_cat);

	$contagem = $contagemp + $contagemc;
	?>
	<script>

		var conti = 0;
		var cont = 0;
		var contagemc = "<?php echo $contagemc; ?>";
		var contagemp = "<?php echo $contagemp; ?>";
		var contagem = "<?php echo $contagem; ?>";
		var jason = 0;
		var drop = 0;
		var soma = 0;
		var cont_prod = "<?php echo $contagem; ?>";
		var cont_ctpd = parseInt(cont_prod);
		soma = 100/cont_prod;

		
		
		function cadgeral(cont,conti){

			if(conti < contagem){
				var mandp = new FormData();
				var c_antigo = "<?php echo $c_antigo;?>";
				var c_novo = "<?php echo $c_novo;?>";
				mandp.set('c_novo',c_novo);
				mandp.set('c_antigo',c_antigo);
				var p_antigo = "<?php echo $p_antigo;?>";
				var p_novo = "<?php echo $p_novo;?>";
				mandp.set('p_novo',p_novo);
				mandp.set('p_antigo',p_antigo);

				cont++;
				conti++;

				if(conti <= contagemc){



					$.ajax({
						url:"backend/ConfigCatProd/pesq_cad_cat.php",
						type:"POST",
						data:mandp,
						contentType:false,
						async:false,
						processData:false,
						success:function(data){
							$('#recebtrat').html(data);
							setTimeout(() => {cadgeral(cont,conti)},1000);

						}
					});

				}else{


					$.ajax({
						url:"backend/ConfigCatProd/pesq_cad_prod.php",
						type:"POST",
						data:mandp,
						contentType:false,
						async:false,
						processData:false,
						success:function(data){
							$('#recebtrat').html(data);
							setTimeout(() => {cadgeral(cont,conti)},1000);

						}
					});
				}

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
				cont_ctpd = cont_ctpd+1;
				jason = drop;

			}
		}

		cadgeral(cont,conti);
	</script>


	<?php
}




?>

