<script>
	var varic;
	var zera;
</script>
<div id="blotu"></div>
<?php 
include "../conexao.php";

$pesq_prodfeatured = mysqli_query($con,"SELECT * FROM isc_products WHERE prodfeatured=1");

$contagemPF = mysqli_num_rows($pesq_prodfeatured);

$pesq_categoria = mysqli_query($con,"SELECT * FROM isc_categories");
$pesq_contagemc = mysqli_num_rows($pesq_categoria);

$contagem = $pesq_contagemc * $contagemPF;



?>

<script>
	var contagem = "<?php echo $contagem; ?>";
	var contagemPF = "<?php echo $contagemPF; ?>";
	var pesq_contagemc = "<?php echo $pesq_contagemc; ?>";
	var contPF = 0;
	var contCT = 0;
	var cont = 0;
	var vari = 0;
	var zeni = 0;
	var jason = 0;
	var drop = 0;
	var soma = 100/contagem;
	var dados = new FormData();


	function cadproddesq(cont,contCT,contPF){

		if(cont < contagem){
			if(contCT < pesq_contagemc){
				if(contPF <contagemPF){

					if(varic == undefined){
						zeni = 0;
					}else{
						zeni = zera;
						
					}

					if(zera == undefined){
						vari = 0;
					}else{
						vari = varic;
						
					}
					dados.set('vari',vari);
					dados.set('cont',cont);
					dados.set('contCT',contCT);
					dados.set('contPF',contPF);
					dados.set('zera',zeni);

					// console.log('geral: '+cont);
					// console.log(' contCT: '+contCT);
					// console.log('   contPF: '+contPF);

					$.ajax({
						url:"backend/ConfigCatProd/tratamento_destaque.php",
						type:"POST",
						data:dados,
						contentType:false,
						async:false,
						processData:false,
						success:function(data){
							if(contPF == contagemPF-1){
								contCT++;
								contPF = 0;
							}else{
								contPF++;
							}
							cont++;

							$('#blotu').html(data);
							setTimeout(() => {cadproddesq(cont,contCT,contPF)},300);
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
	}
}

cadproddesq(cont,contCT,contPF)
</script>