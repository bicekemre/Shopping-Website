<?php
if(isset($_SESSION["Admin"])){
    $IncomingCargoLogo   =   $_FILES["CargoLogo"];

    if (isset($_POST["CargoCompanyName"])){
        $IncomingCargoCompanyName       =  Safety($_POST["CargoCompanyName"]);
    }else{
        $IncomingCargoCompanyName       =  ";";
    }

    if(($IncomingCargoLogo["name"]!="") and ($IncomingCargoLogo["type"]!="") and ($IncomingCargoLogo["tmp_name"]!="") and ($IncomingCargoLogo["error"]==0) and ($IncomingCargoLogo["size"]>0) and ($IncomingCargoCompanyName != "")){

        $PictureName = PictureNameCreate();
        $IncomingPicExtension = substr($IncomingCargoLogo["name"], -4);
        if ($IncomingPicExtension == "jpeg") {
            $IncomingPicExtension = "." . $IncomingPicExtension;
        }

        $NewNameforPic = $PictureName . $IncomingPicExtension;

        $Query = $DatabaseConnect->prepare("INSERT INTO cargocompanies (CargoLogo, CargoCompanyName) values (?, ?)");
        $Query->execute([$NewNameforPic, $IncomingCargoCompanyName]);
        $QueryControl = $Query->rowCount();

        if ($QueryControl > 0) {

            $foo = new Verot\Upload\Upload($IncomingCargoLogo);

            if ($foo->uploaded) {
                $foo->mime_magic_check = true;
                $foo->allowed = array("image/*");
                $foo->file_new_name_body = $PictureName;
                $foo->file_overwrite = true;
                $foo->image_convert				=	"png";
                $foo->image_quality = 100;
                $foo->image_background_color = "#FFFFFF";
                $foo->image_resize = true;
                $foo->image_ratio = true;
                $foo->image_y = 30;
                $foo->process($ImagesPathforVerot);

                if ($foo->processed) {
                    $foo->clean();

                    header("Location:index.php?PageCodeLog=0&PageCodeA=24");
                    exit();
                }else{
                    header("Location:index.php?PageCodeLog=0&PageCodeA=25");
                    exit();
                }
            }
        }else{
            header("Location:index.php?PageCodeLog=0&PageCodeA=25");
            exit();
        }
    }else{
        header("Location:index.php?PageCodeLog=0&PageCodeA=25");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>
