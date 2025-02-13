<?php
    

    $id_cat = $_POST['id_cat'];
    $verif = $_POST['verif'];
   if(isset($_POST['cont'])){
    $cont = $_POST['cont'];
   }

    if(isset($id_cat)){
        include "../../backend/conexao.php";

       

        if($verif=='1'){    
            $pesq = mysqli_query($con,"SELECT * FROM isc_products WHERE prodcatids=$id_cat");
            if(mysqli_num_rows($pesq)>0){
                echo mysqli_num_rows($pesq);
            }else{
                echo 0;
            }
        }else if($verif == '2'){
            $pesq = mysqli_query($con,"SELECT * FROM isc_products WHERE prodcatids=$id_cat LIMIT 1 OFFSET $cont");
            while($exibe = mysqli_fetch_array($pesq)){
                $id = $exibe['productid'];
            }

            if(isset($id)){
                echo $id;
            }
        }

    }

?>