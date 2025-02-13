<?php
include "../conexao.php";

if (!empty($_FILES['file1']['tmp_name'])) {
	$arquivo = new DomDocument();
	$file = $_FILES['file1']['tmp_name'];
	$arquivo->load($_FILES['file1']['tmp_name']);
	$cont = $_POST['cont'];
	$linhas = $arquivo->getElementsByTagName("Row");
	$qtde = count($linhas);
	$cont = $cont + 4;
?>
	<script>
		var num = 0;
		var qtde = parseInt("<?php echo $qtde; ?>");
		qtde = qtde - 5;

		var jason = 0;
		var drop = 0;
		var soma = 100 / qtde;

		teste(num, qtde);

		function teste(num) {



			if (num < qtde) {
				$('.container2 > a').addClass('disabled');
				num++;

				var data = new FormData();
				var file1 = $('.container1 .sq_right > label input#arquivoExcel')[0].files[0];
				var cont = num;
				data.append('file1', file1);
				data.append('cont', cont);

				$.ajax({
					url: 'backend/importacaoExcel/cadastra.php',
					type: 'POST',
					data: data,
					contentType: false,
					async: false,
					processData: false,
					success: function(data) {

						$('.res').html(data);

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
				$('.container1 > div > .sq_left > .load1 > p').html('Concluido');

				$(".container1 .sq_left .load1 .loader").css({
						background: 'black'
				});

				$('.container2 > a').removeClass('disabled');
				$('.container1 .sq_left .load1 .loader').addClass('loadcont');
			}
		}
	</script>
<?php
}

?>