<?php
    include "../conexao.php";

    $pesq_products = mysqli_query($con, "SELECT * FROM isc_products");

    $contProds = mysqli_num_rows($pesq_products);

?>

<script>
		var num = 0;
		var qtde = parseInt("<?php echo $contProds; ?>");

		var jason = 0;
		var drop = 0;
		var soma = 100 / qtde;

		teste(num, qtde);

		function teste(num,qtde) {



			if (num < qtde) {
				$('.container1 .botao').addClass('disabled');

				var data = new FormData();
				var cont = num;
				data.append('cont', cont);
                num++;

				$.ajax({
					url: 'backend/codificando/cadastra.php',
					type: 'POST',
					data: data,
					contentType: false,
					async: false,
					processData: false,
					success: function(data) {

						$('#print2').html(data);

						setTimeout(() => {
							teste(num, qtde)
						}, 100);

					}
				});

				jason = jason + soma;
				drop = jason;
				jason = Math.ceil(jason); //metodo de arredondamento para o maior

				// console.log('-----------------------------');
				// console.log('jason: ' + jason + ' -> soma: ' + soma + ' ->drop: ' + drop);
				// console.log('-----------------------------');

				$(".content4").css({
					display: 'inherit'
				});
				$(".header_top .progress").attr("style", "width:" + jason + "%;");
				$(".header_top .Value").text(jason + "%");
				$(":root").css("--largura-bg", drop + "%");
				var el = $(".header_top .percent > div:nth-child(1)"),
					newone = el.clone(true);
				el.before(newone);
				$("." + el.attr("progress") + ":last").remove();
				jason = drop;


			} else {
                $('.header_top .content4 .skills .Name').html('Concluido');
                $('.container1 > .botao').removeClass('disabled');
            }
		}
	</script>