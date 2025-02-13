<?php

    include "../../backend/conexao.php";

    $obj = $_POST['obj'];
    $obj = json_decode($obj);
    
    $Tipo = $obj->Tipo;
    $httpp = $_POST['httpp'];

    if($Tipo == 1){
    //     // Procedimento para cadastrar categorias
      $id = $obj->id;
      $nome = strval($obj->catname);
      $catparentid = $obj->catparentid;
      $catdesc = $obj->catdesc;
      $catviews = strval($obj->catviews);
      $catsort  = strval($obj->catsort);
      $catpagetitle = strval($obj->catpagetitle);
      $catmetakeywords = strval($obj->catmetakeywords);
      $catmetadesc = $obj->catmetadesc;
      $catlayoutfile = strval($obj->catlayoutfile);
      $catparentlist = strval($obj->catparentlist);
      $catimagefile = $obj->catimagefile;
      $catvisible  = strval($obj->catvisible);
      $catsearchkeywords = strval($obj->catsearchkeywords);
      $cat_enable_optimizer = strval($obj->cat_enable_optimizer);
      $catnsetleft  = strval($obj->catnsetleft);
      $catnsetright  = strval($obj->catnsetright);
      $cataltcategoriescache  = $obj->cataltcategoriescache;
      $cat_enable_google  = strval($obj->cat_enable_google);
      $catidgoogle  = $obj->id;


        $select = mysqli_query($con,"SELECT * FROM isc_categories WHERE catname='$nome'");

        if(mysqli_num_rows($select)){

        }else{
            $select2 = mysqli_query($con,"SELECT * FROM isc_categories WHERE catidgoogle='$catparentid'");
            if(mysqli_num_rows($select2)){
                while($exibe = mysqli_fetch_array($select2)){
                    $catparentid = $exibe['categoryid'];
                }
            }else{
                $catparentid = 0;
                
            }

            $cadastra = mysqli_query($con,"INSERT INTO isc_categories (categoryid,
            catparentid,
            catname,
            catdesc,
            catviews,
            catsort,
            catpagetitle,
            catmetakeywords,
            catmetadesc,
            catlayoutfile,
            catparentlist,
            catimagefile,
            catvisible,
            catsearchkeywords,
            cat_enable_optimizer,
            catnsetleft,
            catnsetright,
            catidgoogle) VALUES (NULL,
            '$catparentid',
            '$nome',
            '$catdesc',
            '$catviews',
            '$catsort',
            '$catpagetitle',
            '$catmetakeywords',
            '$catmetadesc',
            '$catlayoutfile',
            '$catparentlist',
            '$catimagefile',
            '$catvisible',
            '$catsearchkeywords',
            '$cat_enable_optimizer',
            '$catnsetleft',
            '$catnsetright',
            '$catidgoogle')");
            

        }

    }else if($Tipo == 2){
//         // Procedimento para cadastro de Produto

        $id = $obj->id;
        $Nome = $obj->Nome;
        $produrl = $obj->produrl;
        $prodtype = $obj->prodtype; 
        $prodcode = $obj->prodcode; 
        $prodfile = $obj->prodfile;
        // $proddesc = $obj->proddesc;
        $prodsearchkeywords = $obj->prodsearchkeywords;
        $prodavailability = $obj->prodavailability;
        $prodprice = $obj->prodprice; 
        $prodcostprice = $obj->prodcostprice; 
        $prodretailprice = $obj->prodretailprice; 
        $prodsaleprice = $obj->prodsaleprice; 
        $prodcalculatedprice = $obj->prodcalculatedprice; 
        $prodsortorder = $obj->prodsortorder; 
        $prodvisible = $obj->prodvisible; 
        $prodfeatured = $obj->prodfeatured; 
        $prodvendorfeatured = $obj->prodvendorfeatured; 
        $prodrelatedproducts = $obj->prodrelatedproducts; 
        $prodcurrentinv = $obj->prodcurrentinv; 
        $prodlowinv = $obj->prodlowinv; 
        $prodoptionsrequired = $obj->prodoptionsrequired; 
        $prodwarranty = $obj->prodwarranty;
        $prodweight = $obj->prodweight; 
        $prodwidth = $obj->prodwidth; 
        $prodheight = $obj->prodheight; 
        $proddepth = $obj->proddepth; 
        $prodfixedshippingcost = $obj->prodfixedshippingcost; 
        $prodfreeshipping = $obj->prodfreeshipping; 
        $prodinvtrack = $obj->prodinvtrack; 
        $prodratingtotal = $obj->prodratingtotal; 
        $prodnumratings = $obj->prodnumratings; 
        $prodnumsold = $obj->prodnumsold; 
        $proddateadded = $obj->proddateadded; 
        $prodbrandid = $obj->prodbrandid; 
        $prodnumviews = $obj->prodnumviews; 
        $prodpagetitle = $obj->prodpagetitle;
        $prodmetakeywords = $obj->prodmetakeywords;
        $prodmetadesc = $obj->prodmetadesc;
        $prodlayoutfile = $obj->prodlayoutfile; 
        $prodvariationid = $obj->prodvariationid; 
        $prodallowpurchases = $obj->prodallowpurchases; 
        $prodhideprice = $obj->prodhideprice; 
        $prodcallforpricinglabel = $obj->prodcallforpricinglabel; 
        $prodcatids = $obj->prodcatids; 
        $prodlastmodified = $obj->prodlastmodified; 
        $prodvendorid = $obj->prodvendorid; 
        $prodhastags = $obj->prodhastags; 
        $prodwrapoptions = $obj->prodwrapoptions; 
        $prodconfigfields = $obj->prodconfigfields;
        $prodeventdaterequired = $obj->prodeventdaterequired; 
        $prodeventdatefieldname = $obj->prodeventdatefieldname;
        $prodeventdatelimited = $obj->prodeventdatelimited; 
        $prodeventdatelimitedtype = $obj->prodeventdatelimitedtype; 
        $prodeventdatelimitedstartdate = $obj->prodeventdatelimitedstartdate; 
        $prodeventdatelimitedenddate = $obj->prodeventdatelimitedenddate; 
        $prodmyobasset = $obj->prodmyobasset;
        $prodmyobincome = $obj->prodmyobincome;
        $prodmyobexpense = $obj->prodmyobexpense;
        $prodpeachtreegl = $obj->prodpeachtreegl;
        $prodcondition = $obj->prodcondition; 
        $prodshowcondition = $obj->prodshowcondition; 
        $product_enable_optimizer = $obj->product_enable_optimizer; 
        $prodpreorder = $obj->prodpreorder; 
        $prodreleasedate = $obj->prodreleasedate; 
        $prodreleasedateremove = $obj->prodreleasedateremove; 
        $prodpreordermessage = $obj->prodpreordermessage;
        $prodminqty = $obj->prodminqty; 
        $prodmaxqty = $obj->prodmaxqty; 
        $tax_class_id = $obj->tax_class_id; 
        $opengraph_type = $obj->opengraph_type; 
        $opengraph_title = $obj->opengraph_title;
        $opengraph_use_product_name = $obj->opengraph_use_product_name; 
        $opengraph_description = $obj->opengraph_description;
        $opengraph_use_meta_description = $obj->opengraph_use_meta_description;
        $opengraph_use_image = $obj->opengraph_use_image; 
        $upc = $obj->upc;
        $disable_google_checkout = $obj->disable_google_checkout;
        $last_import = $obj->last_import;
        $video01 = $obj->video01;
        $video02 = $obj->video02;
        $video03 = $obj->video03;

        $pesqcat = mysqli_query($con,"SELECT * FROM isc_categories WHERE catidgoogle='$prodcatids'");
        if(mysqli_num_rows($pesqcat)){
            while($exibe = mysqli_fetch_array($pesqcat)){
                $prodcatids = $exibe['categoryid'];
            }
        }else{
            $prodcatids = 0;
        }

        $select = mysqli_query($con,"SELECT * FROM isc_products WHERE prodname='$Nome'");
        if(mysqli_num_rows($select)){

        }else{
            $cadastra = mysqli_query($con,"INSERT INTO isc_products (productid,
                prodname,
produrl,
prodtype,
prodcode,
prodfile,
prodsearchkeywords,
prodavailability,
prodprice,
prodcostprice,
prodretailprice,
prodsaleprice,
prodcalculatedprice,
prodsortorder,
prodvisible,
prodfeatured,
prodvendorfeatured,
prodrelatedproducts,
prodcurrentinv,
prodlowinv,
prodoptionsrequired,
prodwarranty,
prodweight,
prodwidth,
prodheight,
proddepth,
prodfixedshippingcost,
prodfreeshipping,
prodinvtrack,
prodratingtotal,
prodnumratings,
prodnumsold,
proddateadded,
prodbrandid,
prodnumviews,
prodpagetitle,
prodmetakeywords,
prodmetadesc,
prodlayoutfile,
prodvariationid,
prodallowpurchases,
prodhideprice,
prodcallforpricinglabel,
prodcatids,
prodlastmodified,
prodvendorid,
prodhastags,
prodwrapoptions,
prodconfigfields,
prodeventdaterequired,
prodeventdatefieldname,
prodeventdatelimited,
prodeventdatelimitedtype,
prodeventdatelimitedstartdate,
prodeventdatelimitedenddate,
prodmyobasset,
prodmyobincome,
prodmyobexpense,
prodpeachtreegl,
prodcondition,
prodshowcondition,
product_enable_optimizer,
prodpreorder,
prodreleasedate,
prodreleasedateremove,
prodpreordermessage,
prodminqty,
prodmaxqty,
tax_class_id,
opengraph_type,
opengraph_title,
opengraph_use_product_name,
opengraph_description,
opengraph_use_meta_description	,
opengraph_use_image,
upc,
disable_google_checkout,
last_import,
video01,
video02,
video03) VALUES (NULL,
'$Nome',
'$produrl',
'$prodtype',
'$prodcode',
'$prodfile',
'$prodsearchkeywords',
'$prodavailability',
'$prodprice',
'$prodcostprice',
'$prodretailprice',
'$prodsaleprice',
'$prodcalculatedprice',
'$prodsortorder',
'$prodvisible',
'$prodfeatured',
'$prodvendorfeatured',
'$prodrelatedproducts',
'$prodcurrentinv',
'$prodlowinv',
'$prodoptionsrequired',
'$prodwarranty',
'$prodweight',
'$prodwidth',
'$prodheight',
'$proddepth',
'$prodfixedshippingcost',
'$prodfreeshipping',
'$prodinvtrack',
'$prodratingtotal',
'$prodnumratings',
'$prodnumsold',
'$proddateadded',
'$prodbrandid',
'$prodnumviews',
'$prodpagetitle',
'$prodmetakeywords',
'$prodmetadesc',
'$prodlayoutfile',
'$prodvariationid',
'$prodallowpurchases',
'$prodhideprice',
'$prodcallforpricinglabel',
'$prodcatids',
'$prodlastmodified',
'$prodvendorid',
'$prodhastags',
'$prodwrapoptions',
'$prodconfigfields',
'$prodeventdaterequired',
'$prodeventdatefieldname',
'$prodeventdatelimited',
'$prodeventdatelimitedtype',
'$prodeventdatelimitedstartdate',
'$prodeventdatelimitedenddate',
'$prodmyobasset',
'$prodmyobincome',
'$prodmyobexpense',
'$prodpeachtreegl',
'$prodcondition',
'$prodshowcondition',
'$product_enable_optimizer',
'$prodpreorder',
'$prodreleasedate',
'$prodreleasedateremove',
'$prodpreordermessage',
'$prodminqty',
'$prodmaxqty',
'$tax_class_id',
'$opengraph_type',
'$opengraph_title',
'$opengraph_use_product_name',
'$opengraph_description',
'$opengraph_use_meta_description',
'$opengraph_use_image',
'$upc',
'$disable_google_checkout',
'$last_import',
'$video01',
'$video02',
'$video03')");


$idprodimg = mysqli_insert_id($con);
if($prodcatids!= 0){
    $cadassocia - mysqli_query($con,"INSERT INTO isc_categoryassociations (associationid,productid,categoryid) VALUES (NULL,'$idprodimg',' $prodcatids')");
}  
        }

if(isset($obj->imagens)){
$images = $obj->imagens;

    function upload($imgtemp,$httpp){
        
        $url = $httpp.'product_images/'.$imgtemp;
    
        $tt = explode("/",$imgtemp);
        $tamtt = count($tt);
        $file = "../../../product_images";
        for($i = 0;$i<$tamtt-1;$i++){
            $parte = $tt[$i];
            $file = $file."/".$parte;
            if(file_exists($file)){
            }else{
                mkdir($file);
            }
        }
    
    
        $ch = curl_init($url);
        $fp = fopen('../../../../product_images/'.$imgtemp, 'wb');
    
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
    }
    
foreach($images as $image){



    $img = $image->image;
    $imgfile = $img->imagefile;
    upload($imgfile,$httpp);
    $imagefiletiny = $img->imagefiletiny;
    upload($imagefiletiny,$httpp);
    $imagefilethumb = $img->imagefilethumb;
    upload($imagefilethumb,$httpp);
    $imagefilestd = $img->imagefilestd;
    upload($imagefilestd,$httpp);
    $imagefilezoom = $img->imagefilezoom;
    upload($imagefilezoom,$httpp);

    $imageprodhash = $img->imageprodhash;
    $imageisthumb = $img->imageisthumb;
    $imagesort = $img->imagesort;
    $imagedesc = $img->imagedesc;
    $imagedateadded = $img->imagedateadded;
    $imagefiletinysize = $img->imagefiletinysize;
    $imagefilethumbsize = $img->imagefilethumbsize;
    $imagefilestdsize = $img->imagefilestdsize;
    $bitimagefile = $img->bitimagefile;
    $bitimagefiletiny = $img->bitimagefiletiny;
    $bitimagefilethumb = $img->bitimagefilethumb;
    $bitimagefilestd = $img->bitimagefilestd;
    $bitimagefilezoom = $img->bitimagefilezoom;
    $imagefilezoomsize = $img->imagefilezoomsize;
    $error = $img->error;


    $cadastraimg = mysqli_query($con,"INSERT INTO isc_product_images (imageid,
                                                                    imageprodid,
                                                                    imageprodhash,
                                                                    imagefile,
                                                                    imageisthumb,
                                                                    imagesort,
                                                                    imagefiletiny,
                                                                    imagefilethumb,
                                                                    imagefilestd,
                                                                    imagefilezoom,
                                                                    imagedesc,
                                                                    imagedateadded,
                                                                    imagefiletinysize,
                                                                    imagefilethumbsize,
                                                                    imagefilestdsize,
                                                                    imagefilezoomsize,
                                                                    bitimagefile,
                                                                    bitimagefiletiny,
                                                                    bitimagefilethumb,
                                                                    bitimagefilestd,
                                                                    bitimagefilezoom,
                                                                    error) VALUES (NULL,
                                                                                        '$idprodimg',
                                                                                        '$imageprodhash',
                                                                                        '$imgfile',
                                                                                        '$imageisthumb',
                                                                                        '$imagesort',
                                                                                        '$imagefiletiny',
                                                                                        '$imagefilethumb',
                                                                                        '$imagefilestd',
                                                                                        '$imagefilezoom',
                                                                                        '$imagedesc',
                                                                                        '$imagedateadded',
                                                                                        '$imagefiletinysize',
                                                                                        '$imagefilethumbsize',
                                                                                        '$imagefilestdsize',
                                                                                        '$imagefilezoomsize',
                                                                                        '$bitimagefile',
                                                                                        '$bitimagefiletiny',
                                                                                        '$bitimagefilethumb',
                                                                                        '$bitimagefilestd',
                                                                                        '$bitimagefilezoom',
                                                                                        '$error')");
                                                            
}
}

    }
?>