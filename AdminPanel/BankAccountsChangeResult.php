<?php
if(isset($_SESSION["Admin"])){
    if(isset($_GET["ID"])){
        $IncomingID			=	Safety($_GET["ID"]);
    }else{
        $IncomingID			=	"";
    }
    $IncomingBankLogo   =   $_FILES["BankLogo"];

    if (isset($_POST["BankName"])){
        $IncomingBankName       =  Safety($_POST["BankName"]);
    }else{
        $IncomingBankName       =  ";";
    }
    if (isset($_POST["City"])){
        $IncomingCity   =  Safety($_POST["City"]);
    }else{
        $IncomingCity   =  ";";
    }
    if (isset($_POST["Country"])){
        $IncomingCountry   =  Safety($_POST["Country"]);
    }else{
        $IncomingCountry   =  ";";
    }
    if (isset($_POST["currency"])){
        $Incomingcurrency   =  Safety($_POST["currency"]);
    }else{
        $Incomingcurrency   =  ";";
    }
    if (isset($_POST["AccountHolder"])){
        $IncomingAccountHolder   =  Safety($_POST["AccountHolder"]);
    }else{
        $IncomingAccountHolder   =  ";";
    }
    if (isset($_POST["AccountNu"])){
        $IncomingAccountNu   =  Safety($_POST["AccountNu"]);
    }else{
        $IncomingAccountNu   =  ";";
    }
    if (isset($_POST["IBAN"])){
        $IncomingIBAN   =  Safety($_POST["IBAN"]);
    }else{
        $IncomingIBAN   =  ";";
    }

    if(($IncomingID!=0) and ($IncomingBankName != "") and ($IncomingCity != "") and ($IncomingCountry != "") and ($Incomingcurrency != "") and ($IncomingAccountHolder != "") and ($IncomingAccountNu!= "") and ($IncomingIBAN!= "")) {

        $Query = $DatabaseConnect->prepare("UPDATE bankaccounts SET BankName = ?, City = ?, Country = ?, currency = ?, AccountHolder = ?, AccountNu = ?, IBAN = ? WHERE id = ? LIMIT 1");
        $Query->execute([$IncomingBankName, $IncomingCity, $IncomingCountry, $Incomingcurrency, $IncomingAccountHolder, $IncomingAccountNu, $IncomingIBAN, $IncomingID]);
        $QueryControl = $Query->rowCount();


        if(($IncomingBankLogo["name"]!="") and ($IncomingBankLogo["type"]!="") and ($IncomingBankLogo["tmp_name"]!="") and ($IncomingBankLogo["error"]==0) and ($IncomingBankLogo["size"]>0)){
            $PictureQuery		=	$DatabaseConnect->prepare("SELECT * FROM bankaccounts WHERE id = ? LIMIT 1");
            $PictureQuery->execute([$IncomingID]);
            $PictureControl			=	$PictureQuery->rowCount();
            $Pictureinfo			=	$PictureQuery->fetch(PDO::FETCH_ASSOC);

            $DeletingPath		=	"../Images/".$Pictureinfo["BankLogo"];
            unlink($DeletingPath);

            $PictureName = PictureNameCreate();
            $IncomingPicExtension = substr($IncomingBankLogo["name"], -4);

            if($IncomingPicExtension=="jpeg"){
                $IncomingPicExtension	=	".".$IncomingPicExtension;
            }

            $PictureName		=	$PictureName.$IncomingPicExtension;

            $foo	=	new Verot\Upload\Upload($IncomingBankLogo, "tr-TR");
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
                    $UpdateQuery	=	$DatabaseConnect->prepare("UPDATE bankaccounts SET BankLogo = ? WHERE id = ? LIMIT 1");
                    $UpdateQuery->execute([$PictureName, $IncomingID]);
                    $UpdateControl	=	$UpdateQuery->rowCount();

                    if($UpdateControl<1){
                        header("Location:index.php?PageCodeLog=0&PageCodeA=17");
                        exit();
                    }
                    $foo->clean();
                }else{
                    header("Location:index.php?PageCodeLog=0&PageCodeA=17");
                    exit();
                }
            }
        }

        if(($QueryControl>0) or ($UpdateControl>0)){
            header("Location:index.php?PageCodeLog=0&PageCodeA=16");
            exit();
        }else{
            header("Location:index.php?PageCodeLog=0&PageCodeA=17");
            exit();
        }
    }else{
        header("Location:index.php?PageCodeLog=0&PageCodeA=17");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>