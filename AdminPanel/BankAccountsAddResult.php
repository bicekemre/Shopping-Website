<?php
if(isset($_SESSION["Admin"])){
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

    if(($IncomingBankLogo["name"]!="") and ($IncomingBankLogo["type"]!="") and ($IncomingBankLogo["tmp_name"]!="") and ($IncomingBankLogo["error"]==0) and ($IncomingBankLogo["size"]>0) and ($IncomingBankName != "") and ($IncomingCity != "") and ($IncomingCountry != "") and ($Incomingcurrency != "") and ($IncomingAccountHolder != "") and ($IncomingAccountNu!= "") and ($IncomingIBAN!= "")) {

        $PictureName = PictureNameCreate();
        $IncomingPicExtension = substr($IncomingBankLogo["name"], -4);
        if ($IncomingPicExtension == "jpeg") {
            $IncomingPicExtension = "." . $IncomingPicExtension;
        }

        $NewNameforPic = $PictureName . $IncomingPicExtension;

            $Query = $DatabaseConnect->prepare("INSERT INTO bankaccounts (id ,BankLogo, BankName, City, Country,currency, AccountHolder, AccountNu, IBAN) values (?, ?, ?, ?, ?, ?, ?, ?,?)");
            $Query->execute(["?" ,$NewNameforPic, $IncomingBankName, $IncomingCity, $IncomingCountry, $Incomingcurrency, $IncomingAccountHolder, $IncomingAccountNu, $IncomingIBAN]);
            $QueryControl = $Query->rowCount();

            if ($QueryControl > 0) {

                $foo = new Verot\Upload\Upload($IncomingBankLogo);

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


                        header("Location:index.php?PageCodeLog=0&PageCodeA=12");
                        exit();
                    }else{
                        header("Location:index.php?PageCodeLog=0&PageCodeA=13");
                        exit();
                    }
                }
            }else{
                header("Location:index.php?PageCodeLog=0&PageCodeA=13");
                exit();
            }
        }else{
            header("Location:index.php?PageCodeLog=0&PageCodeA=13");
            exit();
        }
    }else{
        header("Location:index.php?PageCodeLog=1");
        exit();
    }
    ?>