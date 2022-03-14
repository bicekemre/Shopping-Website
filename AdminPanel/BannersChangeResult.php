<?php
if(isset($_SESSION["Admin"])){
    if(isset($_GET["ID"])){
        $IncomingID			=	Safety($_GET["ID"]);
    }else{
        $IncomingID			=	"";
    }
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

    if(($IncomingID!="") and ($IncomingBannerArea!="") and ($IncomingBannerName!="")){
        $PictureQuery		=	$DatabaseConnect->prepare("SELECT * FROM banners WHERE id = ? LIMIT 1");
        $PictureQuery->execute([$IncomingID]);
        $PictureControl			=	$PictureQuery->rowCount();
        $Pictureinfo			=	$PictureQuery->fetch(PDO::FETCH_ASSOC);


        if($IncomingBannerArea==$Pictureinfo["BannerArea"]){
            $UpdateQuery		=	$DatabaseConnect->prepare("UPDATE banners SET BannerArea = ?, BannerName = ? WHERE id = ? LIMIT 1");
            $UpdateQuery->execute([$IncomingBannerArea, $IncomingBannerName, $IncomingID]);
            $UpdateControl		=	$UpdateQuery->rowCount();


            if(($IncomingBannerPicture["name"]!="") and ($IncomingBannerPicture["type"]!="") and ($IncomingBannerPicture["tmp_name"]!="") and ($IncomingBannerPicture["error"]==0) and ($IncomingBannerPicture["size"]>0)){
                $DeletingPath		=	"../Images/".$Pictureinfo["BannerPicture"];
                unlink($DeletingPath);

                $PictureName		=	PictureNameCreate();
                $IncomingPicExtension	=	substr($IncomingBannerPicture["name"], -4);

                if($IncomingPicExtension=="jpeg"){
                    $IncomingPicExtension	=	".".$IncomingPicExtension;
                }

                $PictureName		=	$PictureName.$IncomingPicExtension;

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

                $foo	=	new Verot\Upload\Upload($IncomingBannerPicture);
                if($foo->uploaded){
                    $foo->mime_magic_check			=	true;
                    $foo->allowed					=	array("image/*");
                    $foo->file_new_name_body		=	$PictureName;
                    $foo->file_overwrite			=	true;
                    //$foo->image_convert			=	"png";
                    $foo->image_quality			=	100;
                    $foo->image_background_color	=	"#FFFFFF";
                    $foo->image_resize				=	true;
                    $foo->image_x					=	$PictureWidth;
                    $foo->image_y					=	$PictureHeight;
                    $foo->process($ImagesPathforVerot);

                    if($foo->processed){
                        $UpdatePictureQuery	=	$DatabaseConnect->prepare("UPDATE banners SET BannerPicture = ? WHERE id = ? LIMIT 1");
                        $UpdatePictureQuery->execute([$PictureName, $IncomingID]);
                        $UpdatePictureControl	=	$UpdatePictureQuery->rowCount();

                        if($UpdatePictureControl<1){
                            header("Location:index.php?PageCodeLOG=0&PageCodeA=41");
                            exit();
                        }
                        $foo->clean();
                    }else{
                        header("Location:index.php?PageCodeLOG=0&PageCodeA=41");
                        exit();
                    }
                }
            }
            if(($UpdateControl>0) or ($UpdatePictureControl>0)){
                header("Location:index.php?PageCodeLOG=0&PageCodeA=40");
                exit();
            }else{
                header("Location:index.php?PageCodeLOG=0&PageCodeA=41");
                exit();
            }
        }else{
            if(($IncomingBannerPicture["name"]!="") and ($IncomingBannerPicture["type"]!="") and ($IncomingBannerPicture["tmp_name"]!="") and ($IncomingBannerPicture["error"]==0) and ($IncomingBannerPicture["size"]>0)){
                $DeletingPath		=	"../Images/".$Pictureinfo["BannerPicture"];
                unlink($DeletingPath);

                $PictureName		=	PictureNameCreate();
                $IncomingPicExtension	=	substr($IncomingBannerPicture["name"], -4);
                if($IncomingPicExtension=="jpeg"){
                    $IncomingPicExtension	=	".".$IncomingPicExtension;
                }

                $PictureName		=	$PictureName.$IncomingPicExtension; // Eğer Convert Kullanılacaksa $PictureName = $PictureName.".png"; şeklinde kullanınız.

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

                $foo	=	new Verot\Upload\Upload($IncomingBannerPicture);
                if($foo->uploaded){
                    $foo->mime_magic_check			=	true;
                    $foo->allowed					=	array("image/*");
                    $foo->file_new_name_body		=	$PictureName;
                    $foo->file_overwrite			=	true;
                    //$foo->image_convert			=	"png";
                    $foo->image_quality			=	100;
                    $foo->image_background_color	=	"#FFFFFF";
                    $foo->image_resize				=	true;
                    $foo->image_x					=	$PictureWidth;
                    $foo->image_y					=	$PictureHeight;
                    $foo->process($ImagesPathforVerot);

                    if($foo->processed){
                        $UpdatePictureQuery	=	$DatabaseConnect->prepare("UPDATE banners SET BannerArea = ?, BannerName = ?, BannerPicture = ? WHERE id = ? LIMIT 1");
                        $UpdatePictureQuery->execute([$IncomingBannerArea, $IncomingBannerName, $PictureName, $IncomingID]);
                        $UpdatePictureControl	=	$UpdatePictureQuery->rowCount();

                        header("Location:index.php?PageCodeLOG=0&PageCodeA=40");
                        exit();

                        if($UpdatePictureControl<1){
                            header("Location:index.php?PageCodeLOG=0&PageCodeA=41");
                            exit();
                        }
                        $foo->clean();
                    }else{
                        header("Location:index.php?PageCodeLOG=0&PageCodeA=41");
                        exit();
                    }
                }
            }else{
                header("Location:index.php?PageCodeLOG=0&PageCodeA=41");
                exit();
            }
        }
    }else{
        header("Location:index.php?PageCodeLOG=0&PageCodeA=41");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLOG=1");
    exit();
}
?>