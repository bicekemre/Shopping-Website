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

$MD5Password        =   md5($IncomeingPassword);


if(($IncomeingEmail!="") and ($IncomeingPassword!="")){
    $ControlQuery		=	$DatabaseConnect->prepare("SELECT * FROM members WHERE EmailAddress = ? AND Password = ? AND Status = ?");
    $ControlQuery->execute([$IncomeingEmail, $MD5Password, 0]);
    $UserCount	    =	$ControlQuery->rowCount();
    $UserRegis		=	$ControlQuery->fetch(PDO::FETCH_ASSOC);

    if($UserCount>0){
        if($UserRegis["Status"]==1){
            $_SESSION["User"]	=	$IncomeingEmail;

            if($_SESSION["User"]==$IncomeingEmail){
                header("Location:index.php?PageCode=45");
                exit();
            }else{
                header("Location:index.php?PageCode=28");
                exit();
            }
        }else{

            $MailPrepare		=	"Hello " . $UserRegis["NameSurname"] . "<br /><br />Please Confirmed your E-Mail<a href='" . $SiteLink . "/Activation.php?ActivationCode=" . $UserRegis["ActivationCode"] . "&Email=" . $UserRegis["EmailAddress"] . "'>CLICK HERE</a>.<br /><br /><br />" . $SiteName;

            $MailSend		=	new PHPMailer(true);

            try{
                $MailSend->SMTPDebug		=	0;
                $MailSend->isSMTP();
                $MailSend->Host				=	FiltersDecode($SiteHostAddress);
                $MailSend->SMTPAuth			=	true;
                $MailSend->CharSet			=	"UTF-8";
                $MailSend->Username			=	FiltersDecode($SiteEmailAdress);
                $MailSend->Password			=	FiltersDecode($SiteEmailPassword);
                $MailSend->SMTPSecure			='tls';
                $MailSend->Port				=	587;
                $MailSend->SMTPOptions		=	array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $MailSend->setFrom(FiltersDecode($SiteEmailAdress), FiltersDecode($SiteName));
                $MailSend->addAddress(FiltersDecode($UserRegis["EmailAddress"]), FiltersDecode($UserRegis["NameSurname"]));
                $MailSend->addReplyTo(FiltersDecode($SiteEmailAdress),FiltersDecode($SiteName));
                $MailSend->isHTML(true);
                $MailSend->Subject = FiltersDecode($SiteName) . 'Member Activation';
                $MailSend->MsgHTML($MailPrepare);
                $MailSend->send();

			header("Location:index.php?PageCode=31");
				exit();
			}catch(Exception $e){
				header("Location:index.php?PageCode=28");
				exit();
			}
		}
	}else{
		header("Location:index.php?PageCode=29");
		exit();
	}
}else{
	header("Location:index.php?PageCode=30");
	exit();
}
?>

