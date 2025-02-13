$(document).ready(function(){

    $('section #squad2 .btn_c').click(function(){
            
            

            $.ajax({
                url: '../dados/dados.json',
                type: 'HEAD',
                error: function() 
                {
                    $.ajax({
                        url: '../dados/php/cria.php',
                        success: function(data){      
                            executa();                   
                        }
                        
                    });
                },
                success: function() 
                {
                    $.ajax({
                        url: '../dados/php/cria.php',
                        success: function(data){      
                            executa();                   
                        }
                        
                    });
                }
            });

            function executa(){
                var totalCat = $('.princ input').length;
                var i = 0;
                var t = 1;
                
                function lodding(jason,drop,totalCat){
                    var soma = 100 / totalCat;

                    jason = jason + soma;
                    drop = jason;
                    jason = Math.ceil(jason); //metodo de arredondamento para o maior
                    
                    // console.log('-----------------------------');
                    // console.log('jason: ' + jason + ' -> soma: ' + soma + ' ->drop: ' + drop);
                    // console.log('-----------------------------');
                    
                    $(".content4").css({
                        display: 'inherit'
                    });
                    $("header .progress").attr("style", "width:" + jason + "%;");
                    $("header .Value").text(jason + "%");
                    $(":root").css("--largura-bg", drop + "%");
                    var el = $("header .percent > div:nth-child(1)"),
                    newone = el.clone(true);
                    el.before(newone);
                    $("." + el.attr("progress") + ":last").remove();
                    jason = drop;

                    return jason;
                }

                function rec1(i,j,contprods,testeLogico1,totalCat,idcat,json){
                   
                    

                    // console.log("--> "+contprods);
                    // console.log("----> "+j);
                    var dd = new FormData();
                    if(i<totalCat){

                        $('.btn_c').addClass('disabled');

                        if($('.princ .clas_'+i).is(':checked')){
                            var id = $('.princ .clas_'+i).val();

                            dd.set('id_cat',id);
                            

                            if(testeLogico1 == 0){
                                console.log("Categoria: "+id);

                                dd.set('verif',1);
                                $.ajax({
                                    url:'../dados/php/contCat.php',
                                    data:dd,
                                    processData:false,
                                    contentType: false,
                                    type: 'POST',
                                    async: false,
                                    success: function(data){
                                        contprods = data;
                                        
                                        dd.set('verif',2);
                                        $.ajax({
                                            url:'../dados/php/cadastrapai.php',
                                            data:dd,
                                            processData:false,
                                            contentType: false,
                                            type: 'POST',
                                            async: false,
                                            success: function(data){

                                            }
                                        });

                                       
                                       if(contprods == 0){
                                        setTimeout(()=>{
                                            i++;
                                            json = lodding(json,0,totalCat);
                                            rec1(i,0,contprods,0,totalCat,0,json);


                                        },100);
                                       }else{
                                        setTimeout(()=>{ 
                                            rec1(i,j,contprods,1,totalCat,id,json);
                                        },100);
                                        }
                                    }
                                });
                            }else if(testeLogico1 == 1){
                                
                                dd.set('verif',2);
                                dd.set('cont',j);
                                dd.set('id_cat',id);
                                $.ajax({
                                    url:'../dados/php/contCat.php',
                                    data:dd,
                                    processData:false,
                                    contentType: false,
                                    type: 'POST',
                                    async: false,
                                    success: function(data){
                                        
                                        if(j<contprods){
                                            $id = data;
                                            dd.set('id_prod',$id);
                                            dd.set('verif',3);
                                            $.ajax({
                                                url:'../dados/php/cadastrapai.php',
                                                data:dd,
                                                processData:false,
                                                contentType: false,
                                                type: 'POST',
                                                async: false,
                                                success: function(data){
                                                    
                                                }
                                            });

                                            setTimeout(()=>{
                                                j++;
                                                rec1(i,j,contprods,1,totalCat,id,json);
                                            },100);
                                        }else{
                                            setTimeout(()=>{
                                                i++;
                                                json = lodding(json,0,totalCat);
                                                rec1(i,0,contprods,0,totalCat,0,json);
                                            },100);
                                        }
                                    }
                                });
                            
                            }
                                              
                        }else{
                            setTimeout(()=>{
                                i++;
                                json = lodding(json,0,totalCat);
                                rec1(i,0,contprods,0,totalCat,0,json);
                            },100);
                        }

                    }else{
                        $('.btn_c').removeClass('disabled');
                        dd.set('verif',1);
                        $.ajax({
                            url: '../dados/php/cadastrapai.php',
                            data: dd,
							processData: false,
							contentType: false,
							type: 'POST',
							async: false,
                            success: function(data){ 
                                $.ajax({
                                    url: '../plugins/modal.php',
                                    success: function(data){
                                        $('footer').html(data);
                                        $('#downloadarq').modal('show');
                                    }
                                })     

                            }
                        });
                    }
                }


                rec1(i,0,0,0,totalCat,0,0);
            }
    });
});