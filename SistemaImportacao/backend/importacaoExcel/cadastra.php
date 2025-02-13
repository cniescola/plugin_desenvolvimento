<?php
include "../conexao.php";

if (!empty($_FILES['file1']['tmp_name'])) {
    $arquivo = new DomDocument();

    $arquivo->load($_FILES['file1']['tmp_name']);
    $cont = $_POST['cont'];
    $linhas = $arquivo->getElementsByTagName("Row");
    $qtde = count($linhas);
    $cont = $cont + 4;

    if ($cont <= $qtde) {
        $linha = $linhas[$cont];


        $id = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
        // echo "<script>console.log('" . $id . "');</script>";

        $categoria = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
        // echo "<script>console.log('" . $categoria . "');</script>";

        $fone = $linha->getElementsByTagName("Data")->item(2)->nodeValue;
        // echo "<script>console.log('" . $fone . "');</script>";

        $M_desc = $linha->getElementsByTagName("Data")->item(3)->nodeValue;
        // echo "<script>console.log('" . $M_desc . "');</script>";

        $T_cat = $linha->getElementsByTagName("Data")->item(4)->nodeValue;
        // echo "<script>console.log('" . $T_cat . "');</script>";

        $M_chave = $linha->getElementsByTagName("Data")->item(5)->nodeValue;
        // echo "<script>console.log('" . $M_chave . "');</script>";

        $C_pai = $linha->getElementsByTagName("Data")->item(6)->nodeValue;
        // echo "<script>console.log('pai" . $C_pai . "');</script>";


        $res_consulta = mysqli_query($con, "SELECT * FROM isc_categories WHERE catname='$categoria'");
        $total = mysqli_num_rows($res_consulta);



        if ($total == 0) {
            // echo "<script>console.log('Nome da linha " . $cont . " Não tem na tabela');</script>";
            if ($C_pai != '0') {
                // echo "<script>console.log('Categoriada linha " . $cont . "  é diferente de 0');</script>";

                $res_consulta_cat1 = mysqli_query($con, "SELECT * FROM isc_categories WHERE catname='$C_pai'");
                $total1 = mysqli_num_rows($res_consulta_cat1);

                if ($total1 == 0) {
                    // echo "<br>A categoria Pai da linha (" . $cont . ") não foi encontrada<br>";
                } else {
                    while ($exibe_dados_cat = mysqli_fetch_array($res_consulta_cat1)) {

                        $cat_pai_pesq = $exibe_dados_cat['categoryid'];

                        $cadastro_p1 = mysqli_query($con, "INSERT INTO isc_categories ( categoryid , catparentid , catname , catdesc , catviews , catsort , catpagetitle , catmetakeywords , catmetadesc , catlayoutfile , catparentlist , catimagefile , catvisible , catsearchkeywords , cat_enable_optimizer , catnsetleft , catnsetright , cataltcategoriescache	, cat_enable_google , catidgoogle) VALUES (NULL, '$cat_pai_pesq','$categoria','','0','0','$T_cat','$M_chave','$M_desc','category.html','','','1','$M_chave','0','21','24','','0','')");

                        $cont_res = mysqli_affected_rows($con);

                        if ($cont_res != 0) {

                            $res_con_update = mysqli_query($con, "UPDATE isc_categories SET catparentid='$cat_pai_pesq' WHERE catname='$categoria'");

                            verifica($id, $categoria, $fone, $M_desc, $T_cat, $M_chave, $C_pai, $cont);
                        } //if($cont_res != 0)
                        else {

                            // echo "<br>Falha ao cadastrar categoria da linha(" . $cont . ")<br>";
                        }
                    }
                }
            } else {

                $cadastro_p1 = mysqli_query($con, "INSERT INTO isc_categories ( categoryid , catparentid , catname , catdesc , catviews , catsort , catpagetitle , catmetakeywords , catmetadesc , catlayoutfile , catparentlist , catimagefile , catvisible , catsearchkeywords , cat_enable_optimizer , catnsetleft , catnsetright , cataltcategoriescache	, cat_enable_google , catidgoogle) VALUES (NULL, '0','$categoria','','0','0','$T_cat','$M_chave','$M_desc','category.html','','','1','$M_chave','0','21','24','','0','')");


                $cont_res = mysqli_affected_rows($con);

                if ($cont_res != 0) {
                    verifica($id, $categoria, $fone, $M_desc, $T_cat, $M_chave, $C_pai, $cont);
                }
            }
        } else {

            while ($res_consulta_exibe = mysqli_fetch_array($res_consulta)) {
                $cat_parent_tab = $res_consulta_exibe['catparentid'];
                $res_consulta_cat = mysqli_query($con, "SELECT * FROM isc_categories WHERE categoryid='$cat_parent_tab'");

                while ($res_consulta_exibe_cat = mysqli_fetch_array($res_consulta_cat)) {
                    $cat_pai_tab = $res_consulta_exibe_cat['catname'];

                    if ($C_pai == $cat_pai_tab) {

                        // echo "<br>O Categoria da linha (" . $cont . ") Já existe<br>";
                    } else {



                        if ($C_pai != '0') {
                            $res_consulta_cat1 = mysqli_query($con, "SELECT * FROM isc_categories WHERE catname='$C_pai'");
                            $total1 = mysqli_num_rows($res_consulta_cat1);

                            if ($total1 == 0) {

                                // echo "<br>A categoria Pai da linha (" . $cont . ") não foi encontrada<br>";
                            } //if($total1 == 0)
                            else {
                                while ($exibe_dados_cat = mysqli_fetch_array($res_consulta_cat1)) {
                                    $cat_pai_pesq = $exibe_dados_cat['categoryid'];

                                    $cadastro_p1 = mysqli_query($con, "INSERT INTO isc_categories ( categoryid , catparentid , catname , catdesc , catviews , catsort , catpagetitle , catmetakeywords , catmetadesc , catlayoutfile , catparentlist , catimagefile , catvisible , catsearchkeywords , cat_enable_optimizer , catnsetleft , catnsetright , cataltcategoriescache	, cat_enable_google , catidgoogle) VALUES (NULL, '$cat_pai_pesq','$categoria','','0','0','$T_cat','$M_chave','$M_desc','category.html','','','1','$M_chave','0','21','24','','0','')");

                                    $cont_res = mysqli_affected_rows($con);

                                    if ($cont_res != 0) {

                                        $res_con_update = mysqli_query($con, "UPDATE isc_categories SET catparentid='$cat_pai_pesq' WHERE catname='$categoria'");

                                        verifica($id, $categoria, $fone, $M_desc, $T_cat, $M_chave, $C_pai, $cont);
                                    } //if($cont_res != 0)
                                    else {

                                        // echo "<br>Falha ao cadastrar categoria da linha(" . $cont . ")<br>";
                                    }
                                } //while ($exibe_dados_cat = mysqli_fetch_array($res_consulta_cat1))
                            }
                        } //if($C_pai != 0)

                        else {
                            $cadastro_p1 = mysqli_query($con, "INSERT INTO isc_categories ( categoryid , catparentid , catname , catdesc , catviews , catsort , catpagetitle , catmetakeywords , catmetadesc , catlayoutfile , catparentlist , catimagefile , catvisible , catsearchkeywords , cat_enable_optimizer , catnsetleft , catnsetright , cataltcategoriescache	, cat_enable_google , catidgoogle) VALUES (NULL, '0','$categoria','','0','0','$T_cat','$M_chave','$M_desc','category.html','','','1','$M_chave','0','21','24','','0','')");


                            $cont_res = mysqli_affected_rows($con);

                            if ($cont_res != 0) {
                                verifica($id, $categoria, $fone, $M_desc, $T_cat, $M_chave, $C_pai, $cont);
                            }
                        }
                    }
                }
            }
        }
    }
}

?>


<?php

function verifica($id, $categoria, $fone, $M_desc, $T_cat, $M_chave, $C_pai, $cont)
{
    include "../conexao.php";

    $rescup_cadastro_p1 = mysqli_query($con, "SELECT * FROM isc_categories WHERE catname='$categoria'");

    while ($exibe_rescup_cadastro_p1 = mysqli_fetch_array($rescup_cadastro_p1)) {
        $cat_search_id = $exibe_rescup_cadastro_p1['categoryid'];
        $cat_pai_search = $exibe_rescup_cadastro_p1['catparentid'];

        $res_cadastro_p2 = mysqli_query($con, "INSERT INTO isc_category_search (categorysearchid , categoryid ,catname , catdesc , catsearchkeywords) VALUES (NULL,'$cat_search_id','$categoria','','$M_chave')");

        $cont_res_2 = mysqli_affected_rows($con);

        if ($cont_res_2 != 0) {
            $rescup_cadastro_p3 = mysqli_query($con, "SELECT * FROM isc_categories WHERE categoryid='$cat_pai_search'");
            $total111 = mysqli_num_rows($rescup_cadastro_p3);

            if ($total111 == 0) {

                // echo "<br>Sucesso ao cadastrar linha(" . $cont . ")<br>";
            } //if($total111 == 0)
            else {
                while ($exibe_rescup_cadastro_p3 = mysqli_fetch_array($rescup_cadastro_p3)) {
                    $nome_categoria = $exibe_rescup_cadastro_p3['catname'];
                    $res_cadastro_p3 = mysqli_query($con, "INSERT INTO isc_category_words (wordid , word ,categoryid) VALUES (NULL,'$nome_categoria','$cat_search_id')");

                    $cont_res_word = mysqli_affected_rows($con);

                    if ($cont_res_word != 0) {

                        // echo "<br>Sucesso ao cadastrar linha(" . $cont . ")<br>";
                    } else {

                        // echo "<br>Falha ao cadastrar categoria da linha(" . $cont . ")<br>";
                    }
                } //while ($exibe_rescup_cadastro_p3 = mysqli_fetch_array($rescup_cadastro_p3)) 
            }
        } //if($cont_res_2 != 0)
        else {

            // echo "<br>Falha ao cadastrar categoria da linha(" . $cont . ")<br>";
        }
    } //while ($exibe_rescup_cadastro_p1 = mysqli_fetch_array($rescup_cadastro_p1))


}

?>