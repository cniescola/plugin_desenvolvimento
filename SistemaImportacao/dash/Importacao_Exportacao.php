<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/Inportacao_Exportacao.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <title>Import/Export B.D</title>
</head>

<body>

    <header>
        <div id="titulo">
            <h1>Sistema de Importação e Exportação</h1>
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
    </header>
    <section>
        <div id="squad1">
            <h1 class="titulo">Importação de Produtos</h1>

            <label id="seleciona" for="carrega">
                <ion-icon name="cloud-upload-outline"></ion-icon>
                <input type="file" style="display: none;" id="carrega">
                <p style="font-size:2vw; color:#5e5e60;"></p>
            </label>


            <a class="btn btn_c" id="import">IMPORTAR DADOS</a>

        </div>
        <div id="squad2">
            <h1 class="titulo">Exportação de Produtos</h1>
            <div id="f_quad1"></div>
            <div id="f_quad2"></div>
            <a class="btn btn_c">Exporta Dados</a>

        </div>
    </section>
    <footer></footer>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="../js/importacao_Exportacao.js"></script>
    <script src="../js/verifCheckbox.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>

</html>