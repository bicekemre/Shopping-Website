<?php
if(isset($_SESSION["Admin"])){
    $IncomingBannerPicture   =   $_FILES["BannerPicture"];

    if (isset($_POST["BannerName"])){
        $IncomingBannerName       =  Safety($_POST["BannerName"]);
    }else{
        $IncomingBannerName       =  ";";
    }
    if (isset($_POST["BannerArea"])){
        $IncomingBannerArea       =  Safety($_POST["BannerArea"]);
    }else{
        $IncomingBannerArea       =  ";";
    }

    if(($IncomingBannerArea!="") and ($IncomingBannerPicture["name"]!="") and ($IncomingBannerPicture["type"]!="") and ($IncomingBannerPicture["tmp_name"]!="") and ($IncomingBannerPicture["error"]==0) and ($IncomingBannerPicture["size"]>0) and ($IncomingBannerName!="")){

        $PictureName = PictureNameCreate();
        $IncomingPicExtension = substr($IncomingBannerPicture["name"], -4);
        if ($IncomingPicExtension == "jpeg") {
            $IncomingPicExtension = "." . $IncomingPicExtension;
        }

        $NewNameforPic = $PictureName . $IncomingPicExtension;

        $Query = $DatabaseConnect->prepare("INSERT INTO banners (BannerArea, BannerName, BannerPicture) values (?, ?, ?)");
        $Query->execute([$IncomingBannerArea, $IncomingBannerName, $NewNameforPic]);
        $QueryControl = $Query->rowCount();

        if($QueryControl>0){
            if($IncomingBannerArea == "Main Page"){
                $PictureWidth	=	1065;
                $PictureHeight	=	186;
            }elseif($IncomingBannerArea == "Under Menu"){
                $PictureWidth	=	250;
                $PictureHeight	=	500;
            }elseif($IncomingBannerArea == "Item Details"){
                $PictureWidth	=	350;
                $PictureHeight	=	350;
            }

                $foo = new Verot\Upload\Upload($IncomingBannerPicture);

                if ($foo->uploaded) {
                    $foo->mime_magic_check = true;
                    $foo->allowed = array("image/*");
                    $foo->file_new_name_body = $PictureName;
                    $foo->file_overwrite = true;
                    $foo->image_convert = "png";
                    $foo->image_quality = 100;
                    $foo->image_background_color = "#FFFFFF";
                    $foo->image_resize = true;
                    $foo->image_ratio = true;
                    $foo->image_y = 30;
                    $foo->process($ImagesPathforVerot);

                    if ($foo->processed) {
                        $foo->clean();

                        header("Location:index.php?PageCodeLog=0&PageCodeA=36");
                        exit();
                    } else {
                        header("Location:index.php?PageCodeLog=0&PageCodeA=37");
                        exit();
                }
            }
        }else{
            header("Location:index.php?PageCodeLog=0&PageCodeA=37");
            exit();
        }
    }else{
        header("Location:index.php?PageCodeLog=0&PageCodeA=37");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>