<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Frameworks/PHPMailer/src/Exception.php';
require 'Frameworks/PHPMailer/src/PHPMailer.php';
require 'Frameworks/PHPMailer/src/SMTP.php';

if(isset($_POST["NameSurname"])){
    $IncomeingNameSurname		=	Safety($_POST["NameSurname"]);
}else{
    $IncomeingNameSurname		=	"";
}

if(isset($_POST["EmailAddress"])){
    $IncomeingEmail		=	Safety($_POST["EmailAddress"]);
}else{
    $IncomeingEmail		=	"";
}

if(isset($_POST["PhoneNumber"])){
    $IncomeingPhone	=	Safety($_POST["PhoneNumber"]);
}else{
    $IncomeingPhone	=	"";
}

if(isset($_POST["Message"])){
    $IncomeingMessage				=	Safety($_POST["Message"]);
}else{
    $IncomeingMessage				=	"";
}

if(($IncomeingNameSurname!="") and ($IncomeingEmail!="") and ($IncomeingPhone!="") and ($IncomeingMessage!="")){
    $MailPrepare		=	"Name Surname : " . $IncomeingNameSurname . "<br />E-Mail Address : " . $IncomeingEmail . "<br />Phone Number : " . $IncomeingPhone . "<br />Message : " . $IncomeingMessage;

    $MailSend	=	new PHPMailer(true);

    try{
        $MailSend->SMTPDebug			=	0;
        $MailSend->isSMTP();
        $MailSend->Host				=	FiltersDecode($SiteHostAddress);
        $MailSend->SMTPAuth			=	true;
        $MailSend->CharSet			=	"UTF-8";
        $MailSend->Username			=	FiltersDecode($SiteEmailAdress);
        $MailSend->Password			=	FiltersDecode($SiteEmailPassword);
        $MailSend->SMTPSecure			=	'tls';
        $MailSend->Port				=	587;
        $MailSend->SMTPOptions		=	array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $MailSend->setFrom(FiltersDecode($SiteEmailAdress), FiltersDecode($SiteName));
        $MailSend->addAddress(FiltersDecode($SiteEmailAdress), FiltersDecode($SiteName));
        $MailSend->addReplyTo($IncomeingEmail, $IncomeingNameSurname);
        $MailSend->isHTML(true);
        $MailSend->Subject = FiltersDecode($SiteName) . ' Message';
        $MailSend->MsgHTML($MailPrepare);
        $MailSend->send();

        header("Location:index.php?PageCode=13");
        exit();
    }catch(Exception $e){
        header("Location:index.php?PageCode=14");
        exit();
    }
}else{
    header("Location:index.php?PageCode=15");
    exit();
}
