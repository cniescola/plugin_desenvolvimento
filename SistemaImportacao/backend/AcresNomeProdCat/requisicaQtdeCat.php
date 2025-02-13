<?php 
include "../conexao.php";
if(isset($_POST['coleta']) && isset($_POST['id_cat'])){
    $coleta = $_POST['coleta'];
    $id_cat = $_POST['id_cat'];

    $rec_pesq = mysqli_query($con,"SELECT * FROM isc_categories WHERE categoryid=$id_cat");

    while($exibe = mysqli_fetch_array($rec_pesq)){
        $titulo = $exibe['catname'];
        $somanomes = $titulo." ".$coleta;

        $atualiza = mysqli_query($con,"UPDATE isc_categories SET catname='$somanomes' WHERE categoryid=$id_cat");

    }
}
?>