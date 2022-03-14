<?php
require_once ("Settings/setting.php");
require_once ("Settings/function.php");

if (isset($_GET["ActivationCode"])){
    $IncomingActivationCode =   Safety($_GET["ActivationCode"]);
}else{
    $IncomingActivationCode =   "";
}

if(isset($_GET["EmailAddress"])){
    $IncomeingEmail		=	Safety($_GET["EmailAddress"]);
}else{
    $IncomeingEmail		=	"";
}
    if(($IncomingActivationCode!="") and ($IncomeingEmail!="")){
        $ControlQuery		=	$DatabaseConnect->prepare("SELECT * FROM members WHERE EmailAddress = ? AND ActivationCode = ? AND Status = ?");
        $ControlQuery->execute([$IncomeingEmail, $IncomingActivationCode, 0]);
        $UserCount	=	$ControlQuery->rowCount();

        if($UserCount>0){
            $UserUpdateQuery		=	$DatabaseConnect->prepare("UPDATE members SET Status = 1");
            $UserUpdateQuery->execute();
            $Control		=	$UserUpdateQuery->rowCount();

            if($Control>0){
                header("Location:index.php?PageCode=25");
                exit();
            }else{
                header("Location:" . $SiteLink);
                exit();
            }
        }else{
            die();
            header("Location:" . $SiteLink);
            exit();
        }
    }else{
    die();
        header("Location:" . $SiteLink);
        exit();
    }

$DatabaseConnect	=	null;
?>