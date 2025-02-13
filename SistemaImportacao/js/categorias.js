
$(document).ready(function(){
    $.ajax({
        url: '../plugins/requisicoes/requi_categorias.php',
        type: 'POST',
        contentType: false,
        async: false,
        processData: false,
        success: function(data) {
            $('.principal .category_select ul.princ').html(data);

            var nn = 0;
            $('.principal .category_select ul > label > input').click(function() {
                var teste = $(this).attr('value');
                // console.log(teste);
                if ($('.principal .category_select input#id_' + teste).is(':checked')) {
                    nn = 1;
                } else {
                    nn = 0;
                }

                if (nn == 1) {
                    $('.principal .category_select #ul_id_' + teste + ' input').prop('checked', true);
                } else {
                    $('.principal .category_select #ul_id_' + teste + ' input').prop('checked', false);
                }

            });
        }
    });



    var nn = 0; 
    $('.principal .category_select ul.prn #td_prod input').click(function() {
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
            $('.principal .category_select ul.prn ul.princ label').css({
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
            $('.principal .category_select ul.prn ul.princ label').css({
                pointerEvents: '',
                opacity: '',
                color: ''
            });

        }
    });


    var somatd = 0;
    var qtd_pagina = $('.principal #qtd_pagina').val();
    $('#id_button_0').addClass('activebutton');
    $(".principal .paginacao button").click(function() {
        var recupera = $(this).val();
        var dd = new FormData();

        if (recupera == 'before') {
            somatd = parseInt(somatd + qtd_pagina);
        } else if (recupera == 'after') {
            if (somatd > 0) {
                somatd = parseInt(somatd - qtd_pagina);
            }
        } else {
            somatd = recupera;
        }


        $('.principal .paginacao button').removeClass('activebutton');
        $('#id_button_' + somatd).addClass('activebutton');
        var t = "#id_button_" + somatd;
        console.log(t);

        dd.set('v1', somatd);
        dd.set('qtde_sm', qtd_pagina);

        if (somatd >= 0) {
            $.ajax({
                url: '../plugins/requisicoes/requi_categorias.php',
                type: 'POST',
                data: dd,
                contentType: false,
                async: false,
                processData: false,
                success: function(data) {
                    $('.principal .category_select ul.princ').html(data);

                    var nn = 0;
                    $('.principal .category_select ul > label > input').click(function() {
                        var teste = $(this).attr('value');
                        // console.log(teste);
                        if ($('.principal .category_select input#id_' + teste).is(':checked')) {
                            nn = 1;
                        } else {
                            nn = 0;
                        }

                        if (nn == 1) {
                            $('.principal .category_select #ul_id_' + teste + ' input').prop('checked', true);
                        } else {
                            $('.principal .category_select #ul_id_' + teste + ' input').prop('checked', false);
                        }

                    });
                }
            });
        }


    });
});