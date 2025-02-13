<div class="prodconteiner">
	<div class="containeresquerda">
		<div class="prodtitle">ADICIONAR PORCENTAGEM</div>

		<div>
			<div>PORCENTO</div>
			<div><input type="number" name="porcnt_num" id="porcnt_num"></div>
		</div>


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
				include "../conexao.php";
				$return_cont = mysqli_query($con, "SELECT * FROM isc_categories");
				$return_cont = mysqli_num_rows($return_cont);
				$qtde_pagina = 100;
				$qtde_p_pagina = round($return_cont / $qtde_pagina);
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

<div class="butaoaddProd">ADICIONAR REGRA</div>


<script>
	$(document).ready(function() {

		var qtd_pagina = "<?php echo $qtde_pagina; ?>";
		$('#id_button_0').addClass('activebutton');
		$.ajax({
			url: 'backend/vertentePrecos/requisita_list_li_categorias.php',
			type: 'POST',
			contentType: false,
			async: false,
			processData: false,
			success: function(data) {
				$('.prodconteiner .containerdireita .category_select ul.princ').html(data);
				var nn = 0;
				var n = 0;
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

				$('.containerdireita .category_select ul.prn #td_prod input').click(function(){
					var teste = $(this).attr('value');
					// console.log(teste);
					if ($(this).is(':checked')) {
						nn = 1;
					} else {
						nn = 0;
					}

					if (nn == 1) {
						$('#ini_prod_qtd').prop('value',0);
						$('#final_prod_qtd').prop('value',0);
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
			}
		});
		var somatd = 0;

		$(".prodconteiner .containerdireita .paginacao button").click(function() {
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


			$('.prodconteiner .containerdireita .paginacao button').removeClass('activebutton');
			$('#id_button_' + somatd).addClass('activebutton');

			dd.set('v1', somatd);
			dd.set('qtde_sm', qtd_pagina);

			if (somatd >= 0) {
				$.ajax({
					url: 'backend/vertentePrecos/requisita_list_li_categorias.php',
					type: 'POST',
					data: dd,
					contentType: false,
					async: false,
					processData: false,
					success: function(data) {
						$('.prodconteiner .containerdireita .category_select ul.princ').html(data);
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