<div class="skills">
  <span class="Name">Html</span>
  <div class="percent">
    <div class="progress" style="width: 0%;"></div>
  </div>
  <span class="Value">0%</span>
</div>
<script>
  var manda_regra = new FormData();
</script>
<?php
include "../conexao.php";
$regras = mysqli_query($con, "SELECT * FROM a_regras_limitador_precos");
$cont = 0;
while ($recebe_regras = mysqli_fetch_array($regras)) {
  $id_psq = $recebe_regras['id'];
  $tipo_psq = $recebe_regras['tipo'];
  $porcentagem = $recebe_regras['porcentagem'];
  $valor1_psq = $recebe_regras['valor1'];
  $valor2_psq = $recebe_regras['valor2'];
  $id_conf_regra_psq = $recebe_regras['id_conf_regra'];
  $ini_limitador_psq = $recebe_regras['ini_limitador'];
  $end_limitador_psq = $recebe_regras['end_limitador'];
  $cont++;
  $qtd_limitador = $end_limitador_psq - $ini_limitador_psq;

  if ($tipo_psq == 1) {
    $pesq_prod = mysqli_query($con, "SELECT * FROM isc_products WHERE ((prodprice BETWEEN $valor1_psq AND $valor2_psq) AND (prodcatids = $id_conf_regra_psq)) LIMIT $qtd_limitador OFFSET $ini_limitador_psq");
    if (mysqli_num_rows($pesq_prod) == 0) {
      $num_linhas = 0;
    } else {
      $num_linhas = mysqli_num_rows($pesq_prod);
    }
  } else if ($tipo_psq == 2) {
    $pesq_prod = mysqli_query($con, "SELECT * FROM isc_products WHERE ((prodprice BETWEEN $valor1_psq AND $valor2_psq) AND (prodbrandid = $id_conf_regra_psq)) LIMIT $qtd_limitador OFFSET $ini_limitador_psq");
    if (mysqli_num_rows($pesq_prod) == 0) {
      $num_linhas = 0;
    } else {
      $num_linhas = mysqli_num_rows($pesq_prod);
    }
  } else if ($tipo_psq == 3) {
    $pesq_prod = mysqli_query($con, "SELECT * FROM isc_products WHERE (prodprice BETWEEN $valor1_psq AND $valor2_psq) LIMIT $qtd_limitador OFFSET $ini_limitador_psq");
    if (mysqli_num_rows($pesq_prod) == 0) {
      $num_linhas = 0;
    } else {
      $num_linhas = mysqli_num_rows($pesq_prod);
    }
  } else if ($tipo_psq == 4) {
  }


  echo "<script>manda_regra.append('id_regra" . $cont . "','" . $id_psq . "');</script>";
  echo "<script>manda_regra.append('cont_prod_regra" . $cont . "','" . $num_linhas . "');</script>";
  echo "<script>manda_regra.append('tipo_regra" . $cont . "','" . $tipo_psq . "');</script>";
  echo "<script>manda_regra.append('porcentagem_regra" . $cont . "','" . $porcentagem . "');</script>";
  echo "<script>manda_regra.append('valor1_regra" . $cont . "','" . $valor1_psq . "');</script>";
  echo "<script>manda_regra.append('valor2_regra" . $cont . "','" . $valor2_psq . "');</script>";
  echo "<script>manda_regra.append('id_conf_regra_regra" . $cont . "','" . $id_conf_regra_psq . "');</script>";
  echo "<script>manda_regra.append('ini_limitador" . $cont . "','" . $ini_limitador_psq . "');</script>";
  echo "<script>manda_regra.append('qtd_limitador_regra" . $cont . "','" . $qtd_limitador . "');</script>";
}

echo "<script>manda_regra.append('qtde_regras','" . $cont . "');</script>";
?>

<script>
  $(document).ready(function() {
    // for(var pair of manda_regra.entries()){
    //   console.log(pair[0]+','+pair[1]);
    // }
    //   function Atualiza(cont){      
    //       // mostrando todos os elementos do array vetor
    //      // var vetor = [];
    //      //  for(var i = 0; i < 10; i++){
    //      //    vetor[i]= i;
    //      //    console.log(vetor[i]);
    //      //  }
    //      //  

    //     $('.title').before(coleta[cont]);
    //     cont++;
    //     setTimeout(() => {Atualiza(cont)},1000);

    //     return cont;
    // }
    //   var cont = 0;
    //   cont = Atualiza(cont,coleta);

    /*var teste = manda_regra.get('id_regra1');
    console.log(teste);*/

    var qtde_regras = manda_regra.get('qtde_regras');
    var time = 100;
    var t = 0;

    function recursive() {
      if (t < qtde_regras) {
        t++
        $('.content4 .skills .Name').html(t + '° Regra');
        time = cadastra(t);
        // console.log(time);
        // console.log("carregamento");
        setTimeout(() => {
          recursive()
        }, time);
      } else {

      }
    }
    recursive();


    function cadastra(t) {
      eval("var id_regra" + t + " = manda_regra.get('id_regra" + t + "');");
      eval("var cont_prod_regra" + t + " = manda_regra.get('cont_prod_regra" + t + "');");
      eval("var tipo_regra" + t + " = manda_regra.get('tipo_regra" + t + "');");
      eval("var porcentagem_regra" + t + " = manda_regra.get('porcentagem_regra" + t + "');");
      eval("var valor1_regra" + t + " = manda_regra.get('valor1_regra" + t + "');");
      eval("var valor2_regra" + t + " = manda_regra.get('valor2_regra" + t + "');");
      eval("var id_conf_regra_regra" + t + " = manda_regra.get('id_conf_regra_regra" + t + "');");
      eval("var ini_limitador" + t + " = manda_regra.get('ini_limitador" + t + "');");
      eval("var qtd_limitador_regra" + t + " = manda_regra.get('qtd_limitador_regra" + t + "');");
      var p = 0;
      var drop = 0;
      var jason = 0;
      imprime(p, drop, jason, eval("id_regra" + t), eval("cont_prod_regra" + t), eval("tipo_regra" + t), eval("porcentagem_regra" + t), eval("valor1_regra" + t), eval("valor2_regra" + t), eval("id_conf_regra_regra" + t), eval("ini_limitador" + t), eval("qtd_limitador_regra" + t));

      return eval("cont_prod_regra" + t + " *1000");
    }


    function imprime(p, drop, jason, id_regra, cont_regra, tipo_regra, porcentagem_regra, valor1_regra, valor2_regra, id_conf_regra_regra, ini_limitador, qtd_limitador_regra) {
      // console.log('dent_carrega'+p);
      // console.log(p);
      // console.log(cont_regra);
      var enviadados = new FormData();
      var soma = 100 / cont_regra;
      enviadados.set('tipo_regra', tipo_regra);
      enviadados.set('porcentagem_regra', porcentagem_regra);
      enviadados.set('valor1_regra', valor1_regra);
      enviadados.set('valor2_regra', valor2_regra);
      enviadados.set('id_conf_regra_regra', id_conf_regra_regra);
      enviadados.set('ini_limitador', ini_limitador);

      if (p < cont_regra) {

        p++;

        $.ajax({
          url: 'backend/vertentePrecos/Cadastraprecoprodutofield_cadastrando.php',
          type: 'POST',
          data: enviadados,
          contentType: false,
          async: false,
          processData: false,
          success: function(data) {
            console.log(data);
          }
        });

        jason = jason + soma;
        drop = jason;
        // console.log(jason);
        // if(jason == 100){
        // }
        $(".progress").attr("style", "width:" + jason + "%;");
        $(".Value").text(jason + "%");
        $(":root").css("--largura-bg", drop + "%");
        var el = $(".percent > div:nth-child(1)"),
          newone = el.clone(true);
        el.before(newone);
        $("." + el.attr("progress") + ":last").remove();




        ini_limitador++;
        setTimeout(() => {
          imprime(p, drop, jason, id_regra, cont_regra, tipo_regra, porcentagem_regra, valor1_regra, valor2_regra, id_conf_regra_regra, ini_limitador, qtd_limitador_regra)
        }, 100);

      }
    }

  });
</script>