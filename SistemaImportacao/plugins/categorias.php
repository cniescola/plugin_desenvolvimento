    <link rel="stylesheet" href="../css/plugins/categorias.css">
    
    <div class="principal">

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
                        $p = $i * $qtde_pagina;
                        ?>
                        
                        <button value="<?php echo $p; ?>" id="id_button_<?php echo $p; ?>"><?php echo $i; ?></button>

                <?php } ?>
                        <input type="hidden" value="<?php echo $qtde_pagina; ?>" id="qtd_pagina">
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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/categorias.js"></script>
