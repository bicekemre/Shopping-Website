<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Frameworks/PHPMailer/src/Exception.php';
require 'Frameworks/PHPMailer/src/PHPMailer.php';
require 'Frameworks/PHPMailer/src/SMTP.php';

if(isset($_POST["EmailAddress"])){
    $IncomeingEmail		=	Safety($_POST["EmailAddress"]);
}else{
    $IncomeingEmail		=	"";
}

if(isset($_GET["ActivationCode"])){
    $IncomeingActivationCode	=	Safety($_GET["ActivationCode"]);
}else{
    $IncomeingActivationCode	=	"";
}

if(isset($_POST["Password"])){
    $IncomeingPassword		=	Safety($_POST["Password"]);
}else{
    $IncomeingPassword		=	"";
}

if(isset($_POST["PasswordAgain"])){
    $IncomeingPasswordAgain		=	Safety($_POST["PasswordAgain"]);
}else{
    $IncomeingPasswordAgain		=	"";
}

$MD5Password        =   md5($IncomeingPassword);

if (($IncomeingEmail!="") and ($IncomeingPassword!="") and ($IncomeingPasswordAgain!="") and ($IncomeingActivationCode!="")){
    if($IncomeingPassword!=$IncomeingPasswordAgain){
        header("Location:index.php?PageCode=42");
        exit();
    }else{
        $UserUpdateQuery	=	$DatabaseConnect->prepare("UPDATE members SET Password = ? WHERE EmailAddress  = ? AND ActivationCode = ? LIMIT 1");
        $UserUpdateQuery->execute([$MD5Password, $IncomeingEmail, $IncomeingActivationCode]);
        $Control				=	$UserUpdateQuery->rowCount();

        if($Control>0){
            header("Location:index.php?PageCode=45");
            exit();
        }else{
            header("Location:index.php?PageCode=46");
            exit();
        }
    }
}else{
    header("Location:index.php?PageCode=48");
    exit();
}
?>