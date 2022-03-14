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

if(isset($_POST["NameSurname"])){
    $IncomeingNameSurname		=	Safety($_POST["NameSurname"]);
}else{
    $IncomeingNameSurname		=	"";
}

if(isset($_POST["PhoneNumber"])){
    $IncomeingPhone	=	Safety($_POST["PhoneNumber"]);
}else{
    $IncomeingPhone	=	"";
}

if(isset($_POST["Gender"])){
    $IncomeingGender				=	Safety($_POST["Gender"]);
}else{
    $IncomeingGender				=	"";
}

if(isset($_POST["SignUpForm"])){
    $IncomeingSignUpForm				=	Safety($_POST["SignUpForm"]);
}else{
    $IncomeingSignUpForm				=	"";
}

$ActivationCode     =   ActivationCode();
$MD5Password        =   md5($IncomeingPassword);

if (($IncomeingEmail!="") and ($IncomeingPassword!="") and ($IncomeingPasswordAgain!="") and ($IncomeingNameSurname!="") and ($IncomeingPhone!="") and ($IncomeingGender!="")){
    if($IncomeingSignUpForm==0){
        header("Location:index.php?PageCode=24");
    exit();
    }else{
        if ($IncomeingPassword!==$IncomeingPasswordAgain){
            header("Location:index.php?PageCode=23");
            exit();
        }else{
            $ControlQuery  = $DatabaseConnect->prepare("SELECT * FROM members WHERE EmailAddress = ?" );
            $ControlQuery->execute([$IncomeingEmail]);
            $UserCount  = $ControlQuery->rowCount();

            if ($UserCount>0){
                header("Location:index.php?PageCode=22");
                exit();
            }else{
                $SignupQuery		=	$DatabaseConnect->prepare("INSERT INTO members (EmailAddress, Password, NameSurname, PhoneNumber, Gender, Status, RegisDate, RegisIPaddress, ActivationCode) values (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $SignupQuery->execute([$IncomeingEmail, $MD5Password, $IncomeingNameSurname, $IncomeingPhone, $IncomeingGender, 0, $TimeTamp, $IPadress, $ActivationCode]);
                $RegisControl		=	$SignupQuery->rowCount();

                if ($RegisControl>0){

                    $MailPrepare		=	"Hello " . $IncomeingNameSurname . "<br /><br />Please Confirmed your E-Mail<a href='" . $SiteLink . "/Activation.php?ActivationCode=" . $ActivationCode . "&EmailAddress=" . $IncomeingEmail . "'>CLICK HERE</a>.<br /><br /><br />" . $SiteName;

                    $MailSend		=	new PHPMailer(true);


                    try{
                        $MailSend->SMTPDebug			=	0;
                        $MailSend->isSMTP();
                        $MailSend->Host				=	"smtp.gmail.com";
                        $MailSend->SMTPAuth			=	true;
                        $MailSend->CharSet			=	"UTF-8";
                        $MailSend->Username			=	FiltersDecode($SiteEmailAdress);
                        $MailSend->Password			=	FiltersDecode($SiteEmailPassword);
                        $MailSend->SMTPSecure			='SSL/TLS';
                        $MailSend->Port				=	587;
                        $MailSend->SMTPOptions		=	array(
                            'ssl' => array(
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => true
                            )
                        );
                        $MailSend->setFrom(FiltersDecode($SiteEmailAdress), FiltersDecode($SiteName));
                        $MailSend->addAddress(FiltersDecode($IncomeingEmail), FiltersDecode($IncomeingNameSurname));
                        $MailSend->addReplyTo(FiltersDecode($SiteEmailAdress), FiltersDecode($SiteName));
                        $MailSend->isHTML(true);
                        $MailSend->Subject			=	$SiteName . 'Member Activation';
                        $MailSend->MsgHTML($MailPrepare);
                        $MailSend->send();

                        header("Location:index.php?PageCode=19");
                        exit();
                    }catch(Exception $e){
                        //echo "{$MailSend->ErrorInfo}";
                        header("Location:index.php?PageCode=20");
                        exit();
                    }
                }else{
                    header("Location:index.php?PageCode=20");
                    exit();
                }
            }
        }
    }
}else{
    header("Location:index.php?PageCode=21");
    exit();
}
?>