<?php
    $conv = 'dados.json';
    $file = fopen('../'.$conv,'w');
    fwrite($file, '{"Dados": [');
    fclose($file);
?>