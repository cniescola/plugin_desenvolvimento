<?php include "../backend/vertentePrecos/Modal.php" ?>

<div class="recebe"></div>
<div class="principalContainer">
	<div class="header_top">
		<div class="titulo">
			<h1> Sistema Conversão de Categoria em Produto</h1>
		</div>

		<div class="content4 content4v">
			<div class="skills">
				<span class="Name">Html</span>
				<div class="percent">
					<div class="progress" style="width: 0%;"></div>
				</div>
				<span class="Value">0%</span>
			</div>
			<div id="recebe_coisas"></div>
		</div>
	</div>

	<div class="sectionIni">
		<div class="boxselect">
			<div class="titulo">
				<p>Conversão de Categoria para Produto</p>
			</div>
			<div class="areaselect">
				<div class="list">
					<div class="containeresquerda">
						<label for='inp_id_1'>
							<i class='fas fa-upload'></i>
							<!-- corrigindo aqui -->
							<img id="ima_cat" src='#'>
						</label>
						<input type='file' name='inp_id_1' id='inp_id_1'>

						</label>
					</div>
					<div class="containerdireita">
						<div class="category_select">
							<ul class="prn">
								<li id="td_prod">
									<label>

										<input type='checkbox' name='todos_prods' id='todos_prods' value='todos_prods' class="cls">
										<span class='icon'></span>
										<span class='list' id='span_todos_prods'>Selecionar Todas as Categorias e Produtos</span>

									</label>
								</li>
								<ul class="princ"></ul>
							</ul>
						</div>
						<div class="paginacao">
							<button value="after">Anterior</button>

							<div class="buttons_click">
								<?php
								include "../backend/conexao.php";
								$return_cont = mysqli_query($con, "SELECT * FROM isc_categories");
								$return_cont = mysqli_num_rows($return_cont);
								$qtde_pagina = 100;
								$qtde_p_pagina = round($return_cont / $qtde_pagina);
								// echo "<script> console.log('s" . $qtde_pagina . "');</script>";

								for ($i = 0; $i < $qtde_p_pagina; $i++) {
									$p = $i * 100;
								?>
									<button value="<?php echo $i; ?>00" id="id_button_<?php echo $p; ?>"><?php echo $i; ?></button>
								<?php } ?>
							</div>

							<button value="before">Proximo</button>
						</div>
					</div>
				</div>
				<div class="button">
					<div class="button">Converter</div>
				</div>
			</div>
		</div>
	</div>

</div>
<script>
	$(document).ready(function() {

		var qtd_pagina = "<?php echo $qtde_pagina; ?>";
		var qtd_prod = "<?php echo $return_cont; ?>";
		var qual = 0;
		var isct = 0;
		/*PROCESSO DE COLETA DE IDS CATEGORIA*/
		if (qtd_prod > qtd_pagina) {
			qual = qtd_pagina;
		} else {
			qual = qtd_prod;
		}
		var jason = 0;
		var drop = 0;
		var soma = 0;
		soma = 100 / qual;


		$('.areaselect .button > div').click(function() {
			var image = $('#inp_id_1')[0].files[0];

			if (image == undefined) {
				$('.modal-body').html("Por favor selecione uma imagem");
				$('#AlertModalPreco').modal('show');
			} else {

				if ($('.areaselect .containerdireita .category_select label .cls').is(':checked')) {
					var dados = new FormData();


					function var_click(isct, qual, image, very) {




						if (isct < qual) {

							if (very == 0) {
								if ($('.areaselect .containerdireita .category_select label .clas_' + isct).is(':checked')) {

									var id_cat = $('.areaselect .containerdireita .category_select label .clas_' + isct).val();
									dados.set('id_cat', id_cat);
									dados.set('image', image);
									dados.set('very', very);

									$.ajax({
										url: 'backend/ConvertCatProd/vertenteCadastra.php',
										data: dados,
										processData: false,
										contentType: false,
										type: 'POST',
										async: false,
										success: function(data) {
											isct++;
											setTimeout(() => {
												var_click(isct, qual, image, very)
											}, 100);
											$('.recebe').html(data);
										}
									});

								} else {
									isct++;
									setTimeout(() => {
										var_click(isct, qual, image, very)
									}, 100);
								}

							} else {
								dados.set('image', image);
								dados.set('very', very);
								dados.set('isct', isct);

								$.ajax({
									url: 'backend/ConvertCatProd/vertenteCadastra.php',
									data: dados,
									processData: false,
									contentType: false,
									type: 'POST',
									async: false,
									success: function(data) {
										isct++;
										setTimeout(() => {
											var_click(isct, qual, image, very)
										}, 100);
										$('.recebe').html(data);
									}
								});
							}
							jason = jason + soma;
							drop = jason;
							jason = Math.ceil(jason); //metodo de arredondamento para o maior


							$(".content4").css({
								display: 'inherit'
							});
							$(".principalContainer .header_top .progress").attr("style", "width:" + jason + "%;");
							$(".principalContainer .header_top .Value").text(jason + "%");
							$(":root").css("--largura-bg", drop + "%");
							var el = $(".principalContainer .header_top .percent > div:nth-child(1)"),
								newone = el.clone(true);
							el.before(newone);
							$("." + el.attr("progress") + ":last").remove();
							$(".principalContainer .header_top .progress");
							$(".principalContainer .header_top .Name").html(isct);
							jason = drop;
						}



					}
					var nnn = 0;

					if ($('.containerdireita .category_select ul.prn #td_prod input').is(':checked')) {
						nnn = 1;
					} else {
						nnn = 0;
					}
					console.log(nnn);
					if (nnn == 0) {
						var_click(isct, qual, image, nnn);
					} else {
						qual = qtd_prod;
						soma = 100 / qual;
						var_click(isct, qual, image, nnn);
					}
				} else {
					$('.modal-body').html("Por favor marque uma categoria");
					$('#AlertModalPreco').modal('show');
				}
			}

		});


		/*PROCESSO DE COLETA DE IDS CATEGORIA*/

		$('#inp_id_1').change(function() {
			const file = $(this)[0].files[0];
			const fileReader = new FileReader();
			fileReader.onloadend = function() {
				$('label[for=inp_id_1] > img').css('display', 'inherit');
				$('label[for=inp_id_1] > img').attr('src', fileReader.result);
				$('label[for=inp_id_1] > i').css('display', 'none');
			};
			fileReader.readAsDataURL(file);
		});





		$('#id_button_0').addClass('activebutton');
		$.ajax({
			url: 'backend/ConvertCatProd/vertenteConvertCatProd.php',
			type: 'POST',
			contentType: false,
			async: false,
			processData: false,
			success: function(data) {
				$('.list .containerdireita .category_select ul.princ').html(data);

				var nn = 0;
				$('.containerdireita .category_select ul > label > input').click(function() {
					var teste = $(this).attr('value');
					// console.log(teste);
					if ($('.containerdireita .category_select input#id_' + teste).is(':checked')) {
						nn = 1;
					} else {
						nn = 0;
					}

					if (nn == 1) {
						$('.containerdireita .category_select #ul_id_' + teste + ' input').prop('checked', true);
					} else {
						$('.containerdireita .category_select #ul_id_' + teste + ' input').prop('checked', false);
					}

				});
			}
		});

		var nn = 0;
		$('.containerdireita .category_select ul.prn #td_prod input').click(function() {
			var teste = $(this).attr('value');
			// console.log(teste);
			if ($(this).is(':checked')) {
				nn = 1;
			} else {
				nn = 0;
			}

			if (nn == 1) {
				$('#ini_prod_qtd').prop('value', 0);
				$('#final_prod_qtd').prop('value', 0);
				$('#ini_prod_qtd').css({
					pointerEvents: 'none',
					opacity: '65%',
					background: '#e6e8eb'
				});
				$('#final_prod_qtd').css({
					pointerEvents: 'none',
					opacity: '65%',
					background: '#e6e8eb'
				});
				$('.containerdireita .category_select ul.prn ul.princ label').css({
					pointerEvents: 'none',
					opacity: '65%',
					color: '#10101059'
				});

			} else {
				$('#ini_prod_qtd').removeProp('value');
				$('#final_prod_qtd').removeProp('value');
				$('#ini_prod_qtd').css({
					pointerEvents: 'inherit',
					opacity: '100%',
					background: 'white'
				});
				$('#final_prod_qtd').css({
					pointerEvents: 'inherit',
					opacity: '100%',
					background: 'white'
				});
				$('.containerdireita .category_select ul.prn ul.princ label').css({
					pointerEvents: '',
					opacity: '',
					color: ''
				});

			}
		});
		var somatd = 0;

		$(".list .containerdireita .paginacao button").click(function() {
			var recupera = $(this).val();
			var dd = new FormData();

			if (recupera == 'before') {
				somatd = somatd + parseInt(qtd_pagina);
			} else if (recupera == 'after') {
				if (somatd > 0) {
					somatd = somatd - parseInt(qtd_pagina);
				}
			} else {
				somatd = recupera;
			}


			$('.list .containerdireita .paginacao button').removeClass('activebutton');
			$('#id_button_' + somatd).addClass('activebutton');

			dd.set('v1', somatd);
			dd.set('qtde_sm', qtd_pagina);

			if (somatd >= 0) {
				$.ajax({
					url: 'backend/ConvertCatProd/vertenteConvertCatProd.php',
					type: 'POST',
					data: dd,
					contentType: false,
					async: false,
					processData: false,
					success: function(data) {
						$('.list .containerdireita .category_select ul.princ').html(data);

						var nn = 0;
						$('.containerdireita .category_select ul > label > input').click(function() {
							var teste = $(this).attr('value');
							// console.log(teste);
							if ($('.containerdireita .category_select input#id_' + teste).is(':checked')) {
								nn = 1;
							} else {
								nn = 0;
							}

							if (nn == 1) {
								$('.containerdireita .category_select #ul_id_' + teste + ' input').prop('checked', true);
							} else {
								$('.containerdireita .category_select #ul_id_' + teste + ' input').prop('checked', false);
							}

						});
					}
				});
			}


		});


	});
</script>