$(document).ready(function(){

    $('#import').click(function(){
        var file = $('#seleciona #carrega')[0].files[0];
        // var file = $('#seleciona #carrega').val();
        var dimp = new FormData();
        if(file == ""){
            alert("selecione um arquivo");
        }else{
            
            dimp.append("file1",file);

            $.ajax({
                url:'../plugins/importando/importa.php',
                data:dimp,
                processData:false,
                contentType: false,
                type: 'POST',
                async: false,
                success: function(data){
                    $('footer').html(data);
                }
            });
        }
    });

    $('#seleciona #carrega').change(function(){
        var file = $('#seleciona #carrega').val();
        $('#seleciona p').html(file);
    });

    $.ajax({
        url: '../plugins/categorias.php',
        success: function(data){
            $('section #squad2 #f_quad2').html(data);
        }
    })
});