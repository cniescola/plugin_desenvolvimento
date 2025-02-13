<?php include "../backend/vertentePrecos/Modal.php" ?>

<div class="recebe"></div>
<div class="principalContainer">
	<div class="header_top">
		<div class="titulo">
			<h1> Sistema de Adição de Caracteres</h1>
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
				<p>Adicionar Nomes no final dos produtos</p>
			</div>
			<div class="areaselect">
				<div class="list">
					<div class="containeresquerda containeresquerdaadi">
						<div class="title_alter">Digite o Nome à adicionar</div>
						<input type="text" name="coleta" id="coleta">
					</div>
					<div class="containerdireita">
						<div class="category_select">
							<ul class="prn">
								<li id="td_prod">
									<label>

										<input type='checkbox' name='todos_prods' id='todos_prods' value='todos_prods'>
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
								$returnn_cont = mysqli_query($con, "SELECT * FROM isc_categories");
								$return_cont = mysqli_num_rows($returnn_cont);
								$qtde_pagina = 100;
								$qtde_p_pagina = round($return_cont / $qtde_pagina);
								// echo "<script> console.log('s" . $qtde_pagina . "');</script>";

								for ($i = 0; $i < $qtde_p_pagina; $i++) {
									$p = $i * 100;
								?>
									<button value="<?php echo $i; ?>00" id="id_button_<?php echo $p; ?>"><?php echo $i; ?></button>
								<?php } ?>

								<?php
								$cont = 0;
								echo "<script> var idcat = [];";
								while ($imprime = mysqli_fetch_array($returnn_cont)) {
									echo "idcat[" . $cont . "] = parseInt(" . $imprime['categoryid'] . ");";
									$cont++;
								}
								echo "</script>";
								?>



							</div>

							<button value="before">Proximo</button>
						</div>
					</div>
				</div>
				<div class="button btn1">
					<div class="button">ADICIONAR AOS PRODUTOS</div>
				</div>
				<div class="button btn2">
					<div class="button">ADICIONAR AS CATEGORIAS</div>
				</div>
			</div>
		</div>
	</div>

</div>
<div id="executando"></div>
<script>
	$(document).ready(function() {

				var qtd_pagina = "<?php echo $qtde_pagina; ?>";
				var cont = 0;
				var ary_cont = [];
				var end_cont = 0;
				var rece;
				var dados = new FormData();

				$('.areaselect .button.btn2 > div').click(function() {

						var coleta = $('.containeresquerda #coleta').val();
						var c = 0;
						var recebe = 0;
						var jason = 0;
						var drop = 0;
						var soma = 0;
						var qual;
						var truc = 0;
						var base = 0;
						var n = 0;
						dados.set('coleta', coleta);

						if ($('.containerdireita .category_select ul.prn #td_prod input').is(':checked')) {
							n = 1;
						} else {
							n = 0;
						}



						function recursive(cont, end_cont, ary_cont, c, recebe, qual) {
							if (cont < end_cont) {

								soma = 100 / qual;
								base = soma - truc;
								base = soma + base;
								truc = soma;

								var id_cat = ary_cont[cont];
								dados.set('id_cat', id_cat);



								$.ajax({
									url: 'backend/AcresNomeProdCat/requisicaQtdeCat.php',
									data: dados,
									processData: false,
									contentType: false,
									type: 'POST',
									async: false,
									success: function(data) {
										cont++;
										setTimeout(() => {
											recursive(cont, end_cont, ary_cont, c, recebe, qual)
										}, 100);
									}
								});

								jason = jason + base;
								drop = jason;
								jason = Math.ceil(jason); //metodo de arredondamento para o maior


								$(".content4").css({
									display: 'inherit'
								});
								$(".principalContainer .header_top .progress").attr("style", "width:100%;");
								$(".principalContainer .header_top .Value").text("100%");
								$(":root").css("--largura-bg", "50%");
								var el = $(".principalContainer .header_top .percent > div:nth-child(1)"),
									newone = el.clone(true);
								el.before(newone);
								$("." + el.attr("progress") + ":last").remove();
								$(".principalContainer .header_top .progress");
								$(".principalContainer .header_top .Name").html(c);
								jason = drop;

							}
						}

						if (n == 1) {
							end_cont = parseInt("<?php echo $return_cont; ?>");
							recursive(cont, end_cont, idcat, c, recebe, qual);
						} else {
							for (var i = 0; i < qtd_pagina; i++) {
								if ($('.areaselect .containerdireita .category_select label .clas_' + i).is(':checked')) {
									rece = $('.areaselect .containerdireita .category_select label .clas_' + i).val();
									var j = parseInt(end_cont);
									ary_cont[j] = rece;
									end_cont++;
								}
							}
							recursive(cont, end_cont, ary_cont, c, recebe, qual);
						}




					});

					$('.areaselect .button.btn1 > div').click(function() {

						var coleta = $('.containeresquerda #coleta').val();
						var c = 0;
						var recebe = 0;
						var jason = 0;
						var drop = 0;
						var soma = 0;
						var qual;
						var truc = 0;
						var base = 0;
						var n = 0;
						dados.set('coleta', coleta);

						if ($('.containerdireita .category_select ul.prn #td_prod input').is(':checked')) {
							n = 1;
						} else {
							n = 0;
						}



						function recursive(cont, end_cont, ary_cont, c, recebe, qual) {
							if (cont < end_cont) {

								if (recebe != "j") {
									qual = recebe + qual;
								}




								soma = 100 / qual;
								base = soma - truc;
								base = soma + base;
								truc = soma;

								var id_cat = ary_cont[cont];
								dados.set('id_cat', id_cat);

								dados.set('c', c);


								$.ajax({
									url: 'backend/AcresNomeProdCat/RequisicaQtde.php',
									data: dados,
									processData: false,
									contentType: false,
									type: 'POST',
									async: false,
									success: function(data) {
										recebe = data;

										if (recebe == 0) {
											dump = cont;
											cont++;
											c = 0;
										} else {
											dump = cont;
										}
										c++;
										setTimeout(() => {
											recursive(cont, end_cont, ary_cont, c, recebe, qual)
										}, 100);
									}
								});

								jason = jason + base;
								drop = jason;
								jason = Math.ceil(jason); //metodo de arredondamento para o maior


								$(".content4").css({
									display: 'inherit'
								});
								$(".principalContainer .header_top .progress").attr("style", "width:100%;");
								$(".principalContainer .header_top .Value").text("100%");
								$(":root").css("--largura-bg", "50%");
								var el = $(".principalContainer .header_top .percent > div:nth-child(1)"),
									newone = el.clone(true);
								el.before(newone);
								$("." + el.attr("progress") + ":last").remove();
								$(".principalContainer .header_top .progress");
								$(".principalContainer .header_top .Name").html(c);
								jason = drop;

							}
						}

						if (n == 1) {
							end_cont = parseInt("<?php echo $return_cont; ?>");
							recursive(cont, end_cont, idcat, c, recebe, qual);
						} else {
							for (var i = 0; i < qtd_pagina; i++) {
								if ($('.areaselect .containerdireita .category_select label .clas_' + i).is(':checked')) {
									rece = $('.areaselect .containerdireita .category_select label .clas_' + i).val();
									var j = parseInt(end_cont);
									ary_cont[j] = rece;
									end_cont++;
								}
							}
							recursive(cont, end_cont, ary_cont, c, recebe, qual);
						}


					});


					/*PROCESSO DE COLETA DE IDS CATEGORIA*/





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
					var nn = 0; $('.containerdireita .category_select ul.prn #td_prod input').click(function() {
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