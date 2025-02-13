<?php
    
    

    $file = $_FILES['file1']['tmp_name'];
    $file = str_replace('\\','/',$file);
    
    $json = file_get_contents($file);
    $data = json_decode($json);


$dados = $data->Dados;
$dados = json_encode($dados);

    // foreach( $dados as $e){
    //     // var_dump($e);

    //     if($e->Tipo == 2){
    //         $imgs = $e->imagens;

    //         foreach( $imgs as $img){
    //             var_dump($img);
                
    //         }
    //     }

    //     echo "-----------";
    // }
    
    
    
    // $dados = file($file);
    // var_dump($dados);

    // foreach($dados as $linhas){
    //     $linhas = json_encode($linhas);
    //      var_dump($linhas);
    // }

   
?>

<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script type="text/javascript">

    

    var dados = '<?php echo $dados;?>';
    // dados = JSON.stringify(dados);
    dados = JSON.parse(dados);
    var tam = dados.length;
    var soma = 100 / tam;



    // parte da função cadastra
    
    function recursiveCad(i,tam,obj,json,drop,soma){
        if(i<tam){

            json = json + soma;
            drop = json;
            json = Math.ceil(json);

            var dd = new FormData();
            var obja = JSON.stringify(obj[i]);
            dd.append('obj',obja);
            dd.set('httpp','https://www.tudo-serralheria.com.br/');

                     $(".content4").css({
                        display: 'inherit'
                    });
                    $("header .progress").attr("style", "width:" + json + "%;");
                    $("header .Value").text(json + "%");
                    $(":root").css("--largura-bg", drop + "%");
                    var el = $("header .percent > div:nth-child(1)"),
                    newone = el.clone(true);
                    el.before(newone);
                    $("." + el.attr("progress") + ":last").remove();
                    json = drop;

            $.ajax({
                url:'../plugins/importando/cadastraImport.php',
                data:dd,
                processData:false,
                contentType: false,
                type: 'POST',
                async: false,
                success: function(data){
                    $('footer').append(data);                  
						setTimeout(() => {
                            i++;
							recursiveCad(i,tam,obj,json,drop,soma);
						}, 100);
                }
            });

            


        }
    }
    recursiveCad(0,tam,dados,0,0,soma);

</script>