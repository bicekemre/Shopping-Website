<?php
if(isset($_SESSION["Admin"])){
    if(isset($_GET["ID"])){
        $IncomingID			=	Safety($_GET["ID"]);
    }else{
        $IncomingID			=	"";
    }
    $IncomingCargoLogo   =   $_FILES["CargoLogo"];

    if (isset($_POST["CargoCompanyName"])){
        $IncomingCargoCompanyName       =  Safety($_POST["CargoCompanyName"]);
    }else{
        $IncomingCargoCompanyName       =  ";";
    }

    if(($IncomingID!=0) and ($IncomingCargoCompanyName != "")){

        $Query = $DatabaseConnect->prepare("UPDATE cargocompanies SET CargoCompanyName = ? WHERE id = ? LIMIT 1");
        $Query->execute([$IncomingCargoCompanyName, $IncomingID]);
        $QueryControl = $Query->rowCount();

        if(($IncomingCargoLogo["name"]!="") and ($IncomingCargoLogo["type"]!="") and ($IncomingCargoLogo["tmp_name"]!="") and ($IncomingCargoLogo["error"]==0) and ($IncomingCargoLogo["size"]>0)){
            $PictureQuery		=	$DatabaseConnect->prepare("SELECT * FROM cargocompanies WHERE id = ? LIMIT 1");
            $PictureQuery->execute([$IncomingID]);
            $PictureControl			=	$PictureQuery->rowCount();
            $Pictureinfo			=	$PictureQuery->fetch(PDO::FETCH_ASSOC);

            $DeletingPath		=	"../Images/".$Pictureinfo["BankLogo"];
            unlink($DeletingPath);

            $PictureName = PictureNameCreate();
            $IncomingPicExtension = substr($IncomingCargoLogo["name"], -4);

            if($IncomingPicExtension=="jpeg"){
                $IncomingPicExtension	=	".".$IncomingPicExtension;
            }

            $PictureName		=	$PictureName.$IncomingPicExtension;

            $foo	=	new Verot\Upload\Upload($IncomingCargoLogo, "tr-TR");
            if($foo->uploaded){
                $foo->mime_magic_check			=	true;
                $foo->allowed					=	array("image/*");
                $foo->file_new_name_body		=	$PictureName;
                $foo->file_overwrite			=	true;
                //$foo->image_convert				=	"png";
                $foo->image_quality				=	100;
                $foo->image_background_color	=	"#FFFFFF";
                $foo->image_resize				=	true;
                $foo->image_ratio				=	true;
                $foo->image_y					=	30;
                $foo->process($ImagesPathforVerot);

                if($foo->processed){
                    $UpdateQuery	=	$DatabaseConnect->prepare("UPDATE cargocompanies SET CargoLogo = ? WHERE id = ? LIMIT 1");
                    $UpdateQuery->execute([$PictureName, $IncomingID]);
                    $UpdateControl	=	$UpdateQuery->rowCount();

                    if($UpdateControl<1){
                        header("Location:index.php?PageCodeLog=0&PageCodeA=29");
                        exit();
                    }
                    $foo->clean();
                }else{
                    header("Location:index.php?PageCodeLog=0&PageCodeA=29");
                    exit();
                }
            }
        }

        if(($QueryControl>0) or ($UpdateControl>0)){
            header("Location:index.php?PageCodeLog=0&PageCodeA=28");
            exit();
        }else{
            header("Location:index.php?PageCodeLog=0&PageCodeA=29");
            exit();
        }
    }else{
        header("Location:index.php?PageCodeLog=0&PageCodeA=29");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>
