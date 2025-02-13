<link rel="stylesheet" href="css/metaDescricoes.css">

<div class="header_top">
    <h1>Sistema De Cadastro de Meta-Tags Dos Produtos</h1>

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

<div class="container1">
    <p class="titulo_green">Adicione as Cidades e seus numeros de contato respectivamente </p>
    <div class="section1">
        <div id="cidade">
            <div class="texto">Adicione Uma Cidade</div>
            <div class="campos">
                <div>
                    <input type="text" name="cidade1" id="cidade1" placeholder="Digite a cidade 1">
                    <div id="botao">+</div>
                </div>
            </div>
        </div>
        <div id="numero">
            <div class="texto">Adicione Um Numero</div>
            <div class="campos">
                <div>
                    <input type="text" name="telefone1" id="telefone1" placeholder="Digite o telefone 1">
                    <div id="botao">+</div>
                </div>
            </div>
        </div>
    </div>
    <a class="btn botao" href="#">CADASTRAR</a>
</div>

<div id="print" style="display: none;"></div>
<div id="print2">
    <div>
        <div></div>
    </div>
</div>

<?php
include "../backend/conexao.php";
$pesquisa_prod = mysqli_query($con, "SELECT * FROM isc_products");
$qtde_prods = mysqli_num_rows($pesquisa_prod);
?>

<script>
    $(document).ready(function() {
        var num = 1;
        var nuns = 1;
        $('.container1 .section1 #cidade .campos > div #botao').click(function() {

            console.log(num);
            num = nuns;
            nuns++;
            $('.container1 .section1 #cidade .campos > div:nth-child(' + num + ')').after('<div><input type="text" name="cidade' + nuns + '" id="cidade' + nuns + '" placeholder="Digite a Cidade ' + nuns + '"></div>');
        });

        var num2 = 1;
        var nuns2 = 1;
        $('.container1 .section1 #numero .campos > div #botao').click(function() {

            num2 = nuns2;
            nuns2++;
            $('.container1 .section1 #numero .campos > div:nth-child(' + num2 + ')').after('<div><input type="text" name="telefone' + nuns2 + '" id="telefone' + nuns2 + '" placeholder="Digite o Telefone' + nuns2 + '"></div>');
        });


        // PROCEDIMENTO DE GRAVAÇÃO 
        var formData = new FormData();

        // produtos
        $('.container1 a.botao').click(function() {


            formData.append('num1', nuns);
            formData.append('num2', nuns2);


            for (var i = 1; i <= nuns; i++) {
                eval('cidade' + i + '=$("#cidade"+i).val();');
                formData.append('cidade' + i, eval('cidade' + i));
                // formData.append('cidade'+i,)
            }

            for (var i = 1; i <= nuns2; i++) {
                eval('telefone' + i + '=$("#telefone"+i).val();');
                formData.append('telefone' + i, eval('telefone' + i));
                // formData.append('cidade'+i,)
            }

            // for(var pair of formData.entries()) {
            // 	console.log(pair[0]+ ', '+ pair[1]);
            // }

            var num = 0;
            var qtde = parseInt("<?php echo $qtde_prods; ?>");

            var jason = 0;
            var drop = 0;
            var soma = 100 / qtde;

            teste(num, qtde);

            function teste(num, qtde) {

                $('#print2').css({
                    display: "flex",
                    opacity: "100%"
                });

                if (num < qtde) {

                    $('.container1 > a.botao').addClass('disabled');
                    num++;

                    var cont = num;
                    formData.set('cont', cont);

                    $.ajax({
                        url: 'backend/metaTags/recebeTagsProd.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        async: false,
                        processData: false,
                        success: function(data) {

                            $('#print2 > div > div').append(data);

                            setTimeout(() => {
                                teste(num, qtde)
                            }, 100);

                        }
                    });

                    jason = jason + soma;
                    drop = jason;
                    jason = Math.ceil(jason); //metodo de arredondamento para o maior

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
                    $('.header_top .content4 .skills > span').html('Concluido');

                    $(".container1 .sq_left .load1 .loader").css({
                        background: 'black'
                    });

                    $('.container1 > a.botao').removeClass('disabled');
                    $('.container1 .sq_left .load1 .loader').addClass('loadcont');

                    $('#print2').css({
                        display: "none",
                        opacity: "0%"
                    });
                }
            }
        });





    });
</script>