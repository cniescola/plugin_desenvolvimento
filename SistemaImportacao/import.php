<!doctype html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/styleMeio.css">
  <link rel="stylesheet" id="teste" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="FontWesome/font/css/all.css">



  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


  <title>System Import</title>
</head>

<body>

  <script>
    $(document).ready(function() {
      $.ajax({
        url: "dash/home.php",
        success: function(data) {
          $('.painel').html(data);
        },
      });
      var numi = 0;
      //configurando paginação


      $('.navigation ul li.list:nth-child(1) a').click(function() {
        $.ajax({
          url: "dash/home.php",
          success: function(data) {
            $('.painel').html(data);
          },
        });
      });

      $('.navigation ul li.list:nth-child(2) a').click(function() {
        $.ajax({
          url: "dash/importacaoExcel.php",
          success: function(data) {
            $('.painel').html(data);
          }
        });
      });

      $('.navigation ul li.list:nth-child(3) a').click(function() {
        $.ajax({
          url: "dash/sistemaCodificacao.php",
          success: function(data) {
            $('.painel').html(data);
          }
        });
      });

      $('.navigation ul li.list:nth-child(4) a').click(function() {
        $.ajax({
          url: "dash/metasDescricoesProd.php",
          success: function(data) {
            $('.painel').html(data);
          },
        });
      });

      $('.navigation ul li.list:nth-child(5) a').click(function() {
        $.ajax({
          url: "dash/metasDescricoesCat.php",
          success: function(data) {
            $('.painel').html(data);
          },
        });
      });
      $('.navigation ul li.list:nth-child(6) a').click(function() {
        $.ajax({
          url: "dash/precos.php",
          success: function(data) {
            $('.painel').html(data);
          },
        });
      });
      $('.navigation ul li.list:nth-child(7) a').click(function() {
        $.ajax({
          url: "dash/painelMarca.php",
          success: function(data) {
            $('.painel').html(data);
          },
        });
      });
      $('.navigation ul li.list:nth-child(8) a').click(function() {
        $.ajax({
          url: "dash/configCatProd.php",
          success: function(data) {
            $('.painel').html(data);
          },
        });
      });
      $('.navigation ul li.list:nth-child(9) a').click(function() {
        $.ajax({
          url: "dash/ConvertCatProd.php",
          success: function(data) {
            $('.painel').html(data);
          },
        });
      });
      $('.navigation ul li.list:nth-child(10) a').click(function() {
        $.ajax({
          url: "dash/acresNomeFinalTitulo.php",
          success: function(data) {
            $('.painel').html(data);
          },
        });
      });
    });
  </script>

  <div class="navigation">
    <ul>
      <li class="list active">
        <a href="#">
          <span class="icon">
            <ion-icon name="home-outline"></ion-icon>
          </span>
          <span class="title">Home</span>
        </a>
      </li>
      <li class="list">
        <a href="#">
          <span class="icon">
            <ion-icon name="cloud-upload-outline"></ion-icon>
          </span>
          <span class="title">Import Excel</span>
        </a>
      </li>
      <li class="list">
        <a href="#">
          <span class="icon">
            <ion-icon name="arrow-up-circle-outline"></ion-icon>
          </span>
          <span class="title">Codificando</span>
        </a>
      </li>
      <li class="list">
        <a href="#">
          <span class="icon">
            <ion-icon name="duplicate-outline"></ion-icon>
          </span>
          <span class="title">Metas Descrições Prod.</span>
        </a>
      </li>
      <li class="list">
        <a href="#">
          <span class="icon">
            <ion-icon name="duplicate-outline"></ion-icon>
          </span>
          <span class="title">Metas Descrições Cat.</span>
        </a>
      </li>
      <li class="list">
        <a href="#">
          <span class="icon">
            <ion-icon name="logo-usd"></ion-icon>
          </span>
          <span class="title">Preços Produtos</span>
        </a>
      </li>
      <li class="list">
        <a href="#">
          <span class="icon">
            <ion-icon name="nutrition-outline"></ion-icon>
          </span>
          <span class="title">Config Marca</span>
        </a>
      </li>
      <li class="list">
        <a href="#">
          <span class="icon">
            <ion-icon name="briefcase-outline"></ion-icon>
          </span>
          <span class="title">Config Cat & Pro</span>
        </a>
      </li>
      <li class="list">
        <a href="#">
          <span class="icon">
            <ion-icon name="copy-outline"></ion-icon>
          </span>
          <span class="title">Converter Cat p/ Prod</span>
        </a>
      </li>
      <li class="list">
        <a href="#">
          <span class="icon">
            <ion-icon name="document-attach-outline"></ion-icon>
          </span>
          <span class="title">Acres.Nome F/Titulo</span>
        </a>
      </li>
    </ul>
  </div>

  <div class="painel"></div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


  <script>
    // add active class in select tap
    const list = document.querySelectorAll('.list');

    function activeLink() {
      list.forEach((item) => item.classList.remove('active'));
      this.classList.add('active');
    }

    list.forEach((item) => item.addEventListener('click', activeLink));
  </script>
</body>

</html>