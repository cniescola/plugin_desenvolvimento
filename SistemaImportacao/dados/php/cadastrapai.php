<?php
    include "../../backend/conexao.php";
    $verif = $_POST['verif'];
    if($verif == 0){
        $id_category = $_POST['id_cat'];

        $pesq = mysqli_query($con,"SELECT * FROM isc_categories WHERE categoryid=$id_category");

        while($exibe = mysqli_fetch_array($pesq)){
            $nome = $exibe['catname'];
        }

        $conv = 'dados.json';
        $file = fopen('../'.$conv,'a');
        fwrite($file, '{"'.$nome.'": ['."\r\n");
        fclose($file);

    }else if($verif == 1){
        $conv = 'dados.json';
        $file = fopen('../'.$conv,'a');
        fwrite($file, "\r\n".'{}]}');
        fclose($file);

    }else if($verif == 2){
        $id_category = $_POST['id_cat'];

        $pesq = mysqli_query($con,"SELECT * FROM isc_categories WHERE categoryid=$id_category");

        while($exibe = mysqli_fetch_array($pesq)){
            $nome = $exibe['catname'];
            $catparentid = $exibe['catparentid'];
            $catdesc = $exibe['catdesc'];
            $catviews = $exibe['catviews'];
            $catsort  = $exibe['catsort'];
            $catpagetitle = $exibe['catpagetitle'];
            $catmetakeywords = $exibe['catmetakeywords'];
            $catmetadesc = $exibe['catmetadesc'];
            $catlayoutfile = $exibe['catlayoutfile'];
            $catparentlist = $exibe['catparentlist'];
            $catimagefile = $exibe['catimagefile'];
            $catvisible  = $exibe['catvisible'];
            $catsearchkeywords = $exibe['catsearchkeywords'];
            $cat_enable_optimizer = $exibe['cat_enable_optimizer'];
            $catnsetleft  = $exibe['catnsetleft'];
            $catnsetright  = $exibe['catnsetright'];
            $cataltcategoriescache  = $exibe['cataltcategoriescache'];
            $cat_enable_google  = $exibe['cat_enable_google'];
            $catidgoogle  = $exibe['catidgoogle'];
        }

        $conv = 'dados.json';
        $file = fopen('../'.$conv,'a');
        fwrite($file,"\r\n".'{"Tipo":1,"id":"'.$id_category.'",
            "catname":"'.$nome.'",
            "catparentid":"'.$catparentid.'",
            "catdesc":"'.$catdesc.'",
            "catviews":"'.$catviews.'",
            "catsort":"'.$catsort.'",
            "catpagetitle":"'.$catpagetitle.'",
            "catmetakeywords":"'.$catmetakeywords.'",
            "catmetadesc":"'.$catmetadesc.'",
            "catlayoutfile":"'.$catlayoutfile.'",
            "catparentlist":"'.$catparentlist.'",
            "catimagefile":"'.$catimagefile.'",
            "catvisible":"'.$catvisible.'",
            "catsearchkeywords":"'.$catsearchkeywords.'",
            "cat_enable_optimizer":"'.$cat_enable_optimizer.'",
            "catnsetleft":"'.$catnsetleft.'",
            "catnsetright":"'.$catnsetright.'",
            "cataltcategoriescache":"'.$cataltcategoriescache.'",
            "catidgoogle":"'.$catidgoogle.'",
            "cat_enable_google":"'.$cat_enable_google.'"},'."\r\n");
        fclose($file);

    }else if($verif == 3){
        $id_prod = $_POST['id_prod'];

        $pesq = mysqli_query($con,"SELECT * FROM isc_products WHERE productid=$id_prod");



        while($exibe = mysqli_fetch_array($pesq)){
            $nome = $exibe['prodname'];
            $produrl = $exibe['produrl'];
            $prodtype = $exibe['prodtype'];
            $prodcode = $exibe['prodcode'];
            $prodfile = $exibe['prodfile'];
            $proddesc = $exibe['proddesc'];
            $proddesc = str_replace('"',"-*",$proddesc);
            $proddesc = str_replace("/\r|\n/"," ",$proddesc);
            $prodsearchkeywords = $exibe['prodsearchkeywords'];
            $prodavailability = $exibe['prodavailability'];
            $prodprice = $exibe['prodprice'];
            $prodcostprice = $exibe['prodcostprice'];
            $prodretailprice = $exibe['prodretailprice'];
            $prodsaleprice = $exibe['prodsaleprice'];
            $prodcalculatedprice = $exibe['prodcalculatedprice'];
            $prodsortorder = $exibe['prodsortorder'];
            $prodvisible = $exibe['prodvisible'];
            $prodfeatured = $exibe['prodfeatured'];
            $prodvendorfeatured = $exibe['prodvendorfeatured'];
            $prodrelatedproducts = $exibe['prodrelatedproducts'];
            $prodcurrentinv = $exibe['prodcurrentinv'];
            $prodlowinv = $exibe['prodlowinv'];
            $prodoptionsrequired = $exibe['prodoptionsrequired'];
            $prodwarranty = $exibe['prodwarranty'];
            $prodweight = $exibe['prodweight'];
            $prodwidth = $exibe['prodwidth'];
            $prodheight = $exibe['prodheight'];
            $proddepth = $exibe['proddepth'];
            $prodfixedshippingcost = $exibe['prodfixedshippingcost'];
            $prodfreeshipping = $exibe['prodfreeshipping'];
            $prodinvtrack = $exibe['prodinvtrack'];
            $prodratingtotal = $exibe['prodratingtotal'];
            $prodnumratings = $exibe['prodnumratings'];
            $prodnumsold = $exibe['prodnumsold'];
            $proddateadded = $exibe['proddateadded'];
            $prodbrandid = $exibe['prodbrandid'];
            $prodnumviews = $exibe['prodnumviews'];
            $prodpagetitle = $exibe['prodpagetitle'];
            $prodmetakeywords = $exibe['prodmetakeywords'];
            $prodmetadesc = $exibe['prodmetadesc'];
            $prodlayoutfile = $exibe['prodlayoutfile'];
            $prodvariationid = $exibe['prodvariationid'];
            $prodallowpurchases = $exibe['prodallowpurchases'];
            $prodhideprice = $exibe['prodhideprice'];
            $prodcallforpricinglabel = $exibe['prodcallforpricinglabel'];
            $prodcatids = $exibe['prodcatids'];
            $prodlastmodified = $exibe['prodlastmodified'];
            $prodvendorid = $exibe['prodvendorid'];
            $prodhastags = $exibe['prodhastags'];
            $prodwrapoptions = $exibe['prodwrapoptions'];
            $prodconfigfields = $exibe['prodconfigfields'];
            $prodeventdaterequired = $exibe['prodeventdaterequired'];
            $prodeventdatefieldname = $exibe['prodeventdatefieldname'];
            $prodeventdatelimited = $exibe['prodeventdatelimited'];
            $prodeventdatelimitedtype = $exibe['prodeventdatelimitedtype'];
            $prodeventdatelimitedstartdate = $exibe['prodeventdatelimitedstartdate'];
            $prodeventdatelimitedenddate = $exibe['prodeventdatelimitedenddate'];
            $prodmyobasset = $exibe['prodmyobasset'];
            $prodmyobincome = $exibe['prodmyobincome'];
            $prodmyobexpense = $exibe['prodmyobexpense'];
            $prodpeachtreegl = $exibe['prodpeachtreegl'];
            $prodcondition = $exibe['prodcondition'];
            $prodshowcondition = $exibe['prodshowcondition'];
            $product_enable_optimizer = $exibe['product_enable_optimizer'];
            $prodpreorder = $exibe['prodpreorder'];
            $prodreleasedate = $exibe['prodreleasedate'];
            $prodreleasedateremove = $exibe['prodreleasedateremove'];
            $prodpreordermessage = $exibe['prodpreordermessage'];
            $prodminqty = $exibe['prodminqty'];
            $prodmaxqty = $exibe['prodmaxqty'];
            $tax_class_id = $exibe['tax_class_id'];
            $opengraph_type = $exibe['opengraph_type'];
            $opengraph_title = $exibe['opengraph_title'];
            $opengraph_use_product_name = $exibe['opengraph_use_product_name'];
            $opengraph_description = $exibe['opengraph_description'];
            $opengraph_use_meta_description	 = $exibe['opengraph_use_meta_description	'];
            $opengraph_use_image = $exibe['opengraph_use_image'];
            $upc = $exibe['upc'];
            $disable_google_checkout = $exibe['disable_google_checkout'];
            $last_import = $exibe['last_import'];
            $video01 = $exibe['video01'];
            $video02 = $exibe['video02'];
            $video03 = $exibe['video03'];
        }

        $pesqimg = mysqli_query($con,"SELECT * FROM isc_product_images WHERE imageprodid=$id_prod");

        $i = 0;
        while($exibe = mysqli_fetch_array($pesqimg)){
            $nomeimage = $exibe['imagefile'];
            $imageprodhash = $exibe['imageprodhash'];
            $imageisthumb = $exibe['imageisthumb'];
            $imagesort = $exibe['imagesort'];
            $imagefiletiny = $exibe['imagefiletiny'];
            $imagefilezoomsize = $exibe['imagefilezoomsize'];
            $imagefilethumb = $exibe['imagefilethumb'];
            $imagefilestd = $exibe['imagefilestd'];
            $imagefilezoom = $exibe['imagefilezoom'];
            $imagedesc = $exibe['imagedesc'];
            $imagedateadded = $exibe['imagedateadded'];
            $imagefiletinysize = $exibe['imagefiletinysize'];
            $imagefilethumbsize = $exibe['imagefilethumbsize'];
            $imagefilestdsize = $exibe['imagefilestdsize'];
            $bitimagefile = $exibe['bitimagefile'];
            $bitimagefiletiny = $exibe['bitimagefiletiny'];
            $bitimagefilethumb = $exibe['bitimagefilethumb'];
            $bitimagefilestd = $exibe['bitimagefilestd'];
            $bitimagefilezoom = $exibe['bitimagefilezoom'];
            $error = $exibe['error'];
            $imgs[$i] = array(
                "image"=>array(
                    "imagefile" => $nomeimage,
                    "imageprodhash" => $imageprodhash,
                    "imageisthumb" => $imageisthum,
                    "imagesort" => $imagesort,
                    "imagefiletiny" => $imagefiletiny,
                    "imagefilethumb" => $imagefilethumb,
                    "imagefilestd" => $imagefilestd,
                    "imagefilezoom" => $imagefilezoom,
                    "imagefilezoomsize" => $imagefilezoomsize,
                    "imagedesc" => $imagedesc,
                    "imagedateadded" => $imagedateadded,
                    "imagefiletinysize" => $imagefiletinysize,
                    "imagefilethumbsize" => $imagefilethumbsize,
                    "imagefilestdsize" => $imagefilestdsize,
                    "bitimagefile" => $bitimagefile,
                    "bitimagefiletiny" => $bitimagefiletiny,
                    "bitimagefilethumb" => $bitimagefilethumb,
                    "bitimagefilestd" => $bitimagefilestd,
                    "bitimagefilezoom" => $bitimagefilezoom,
                    "error" => $error,
                ),
            );
            $i++;
        }
        $imgs = json_encode($imgs);
        $conv = 'dados.json';
        $file = fopen('../'.$conv,'a');
        fwrite($file,'{"Tipo":2,"id":"'.$id_prod.'","Nome":"'.$nome.'","produrl":"'.$produrl.'","prodtype":"'.$prodtype.'","prodcode":"'.$prodcode.'","prodfile":"'.$prodfile.'","prodsearchkeywords":"'.$prodsearchkeywords.'","prodavailability":"'.$prodavailability.'","prodprice":"'.$prodprice.'","prodcostprice":"'.$prodcostprice.'","prodretailprice":"'.$prodretailprice.'","prodsaleprice":"'.$prodsaleprice.'","prodcalculatedprice":"'.$prodcalculatedprice.'","prodsortorder":"'.$prodsortorder.'","prodvisible":"'.$prodvisible.'","prodfeatured":"'.$prodfeatured.'","prodvendorfeatured":"'.$prodvendorfeatured.'","prodrelatedproducts":"'.$prodrelatedproducts.'","prodcurrentinv":"'.$prodcurrentinv.'","prodlowinv":"'.$prodlowinv.'","prodoptionsrequired":"'.$prodoptionsrequired.'","prodwarranty":"'.$prodwarranty.'","prodweight":"'.$prodweight.'","prodwidth":"'.$prodwidth.'","prodheight":"'.$prodheight.'","proddepth":"'.$proddepth.'","prodfixedshippingcost":"'.$prodfixedshippingcost.'","prodfreeshipping":"'.$prodfreeshipping.'","prodinvtrack":"'.$prodinvtrack.'","prodratingtotal":"'.$prodratingtotal.'","prodnumratings":"'.$prodnumratings.'","prodnumsold":"'.$prodnumsold.'","proddateadded":"'.$proddateadded.'","prodbrandid":"'.$prodbrandid.'","prodnumviews":"'.$prodnumviews.'","prodpagetitle":"'.$prodpagetitle.'","prodmetakeywords":"'.$prodmetakeywords.'","prodmetadesc":"'.$prodmetadesc.'","prodlayoutfile":"'.$prodlayoutfile.'","prodvariationid":"'.$prodvariationid.'","prodallowpurchases":"'.$prodallowpurchases.'","prodhideprice":"'.$prodhideprice.'","prodcallforpricinglabel":"'.$prodcallforpricinglabel.'","prodcatids":"'.$prodcatids.'","prodlastmodified":"'.$prodlastmodified.'","prodvendorid":"'.$prodvendorid.'","prodhastags":"'.$prodhastags.'","prodwrapoptions":"'.$prodwrapoptions.'","prodconfigfields":"'.$prodconfigfields.'","prodeventdaterequired":"'.$prodeventdaterequired.'","prodeventdatefieldname":"'.$prodeventdatefieldname.'","prodeventdatelimited":"'.$prodeventdatelimited.'","prodeventdatelimitedtype":"'.$prodeventdatelimitedtype.'","prodeventdatelimitedstartdate":"'.$prodeventdatelimitedstartdate.'","prodeventdatelimitedenddate":"'.$prodeventdatelimitedenddate.'","prodmyobasset":"'.$prodmyobasset.'","prodmyobincome":"'.$prodmyobincome.'","prodmyobexpense":"'.$prodmyobexpense.'","prodpeachtreegl":"'.$prodpeachtreegl.'","prodcondition":"'.$prodcondition.'","prodshowcondition":"'.$prodshowcondition.'","product_enable_optimizer":"'.$product_enable_optimizer.'","prodpreorder":"'.$prodpreorder.'","prodreleasedate":"'.$prodreleasedate.'","prodreleasedateremove":"'.$prodreleasedateremove.'","prodpreordermessage":"'.$prodpreordermessage.'","prodminqty":"'.$prodminqty.'","prodmaxqty":"'.$prodmaxqty.'","tax_class_id":"'.$tax_class_id.'","opengraph_type":"'.$opengraph_type.'","opengraph_title":"'.$opengraph_title.'","opengraph_use_product_name":"'.$opengraph_use_product_name.'","opengraph_description":"'.$opengraph_description.'","opengraph_use_meta_description":"'.$opengraph_use_meta_description.'","opengraph_use_image":"'.$opengraph_use_image.'","upc":"'.$upc.'","disable_google_checkout":"'.$disable_google_checkout.'","last_import":"'.$last_import.'","video01":"'.$video01.'","video02":"'.$video02.'","video03":"'.$video03.'","imagens":'.$imgs.'},'."\r\n");
        fclose($file);
    }

?>