<?php
try {
    $DatabaseConnect    =   new PDO("mysql:host=localhost;dbname=electronicshop;charset=UTF8", "root", "");
}catch(PDOException $Error){
    //echo "DB Connect Error<br>" . $Error->getMessage();
    die();
}

$SettingsQuery  =   $DatabaseConnect->prepare("SELECT * FROM settings LIMIT 1");
$SettingsQuery->execute();
$SettingsCount  =   $SettingsQuery->rowCount();
$Settings       =   $SettingsQuery->fetch(PDO::FETCH_ASSOC);

if ($SettingsCount>0){
    $SiteName              =$Settings["SiteName"];
    $SiteTitle             =$Settings["SiteTitle"];
    $SiteDescription       =$Settings["SiteDescription"];
    $SiteKeywords          =$Settings["SiteKeywords"];
    $SiteCopyright         =$Settings["SiteCopyright"];
    $SiteLogo              =$Settings["SiteLogo"];
    $SiteLink              =$Settings["SiteLink"];
    $SiteEmailAdress       =$Settings["SiteEmailAdress"];
    $SiteEmailPassword     =$Settings["SiteEmailPassword"];
    $SiteHostAddress       =$Settings["SiteEmailAdress"];
    $Facebooklink          =$Settings["Facebooklink"];
    $Twitterlink           =$Settings["Twitterlink"];
    $Linkedlnlink          =$Settings["Linkedlnlink"];
    $Instagramlink         =$Settings["Instagramlink"];
    $Pinterestlink         =$Settings["Pinterestlink"];
    $YouTubelink           =$Settings["YouTubelink"];
    $eurusd                =$Settings["eurusd"];
    $FreeShipping          =$Settings["FreeShipping"];
    $ClientID			   =$Settings["ClientID"];
    $StoreKey		       =$Settings["StoreKey"];
    $ApiUser		       =$Settings["ApiUser"];
    $ApiPassword		   =$Settings["ApiPassword"];
}

$TextsQuery  =   $DatabaseConnect->prepare("SELECT * FROM contractsandtexts LIMIT 1");
$TextsQuery->execute();
$TextsCount  =   $TextsQuery->rowCount();
$Texts       =   $TextsQuery->fetch(PDO::FETCH_ASSOC);

if ($TextsCount>0){
    $AboutusText                            =$Texts["Aboutus"];
    $MembershipContractsText                =$Texts["MembershipContracts"];
    $TermsofUseText                         =$Texts["TermsofUse"];
    $PrivacyPolicyText                      =$Texts["ConfidentialityAgreement"];
    $DistanceSalesAgreementText             =$Texts["DistanceSalesAgreement"];
    $DeliveryText                           =$Texts["DeliveryText"];
    $ReturnsReplacementsText                =$Texts["ReturnsReplacements"];
}else{
    die();
}


if (isset($_SESSION["User"])) {
    $UserQuery  = $DatabaseConnect->prepare("SELECT * FROM members WHERE EmailAddress = ? LIMIT 1");
    $UserQuery->execute([$_SESSION["User"]]);
    $UserCount  = $UserQuery->rowCount();
    $User       = $UserQuery->fetch(PDO::FETCH_ASSOC);

    if ($UserCount > 0) {
        $UserID                 =    $User["id"];
        $UserEmailAddress       =    $User["EmailAddress"];
        $UserPassword           =    $User["Password"];
        $UserNameSurname        =    $User["NameSurname"];
        $UserPhoneNumber        =    $User["PhoneNumber"];
        $UserGender             =    $User["Gender"];
        $UserStatus             =    $User["Status"];
        $UserRegisDate          =    $User["RegisDate"];
        $UserRegisIPaddress     =    $User["RegisIPaddress"];
        $UserActivationCode     =    $User["ActivationCode"];

    } else {
        echo "ERROR";
        die();
    }
}

if (isset($_SESSION["Admin"])) {
    $AdminQuery  = $DatabaseConnect->prepare("SELECT * FROM admins WHERE AdminName = ? LIMIT 1");
    $AdminQuery->execute([$_SESSION["Admin"]]);
    $AdminCount  = $AdminQuery->rowCount();
    $Admin       = $AdminQuery->fetch(PDO::FETCH_ASSOC);

    if ($AdminCount > 0) {
        $AdminID                 =    $Admin["id"];
        $AdminName               =    $Admin["AdminName"];
        $AdminEmailAddress       =    $Admin["Email"];
        $AdminPassword           =    $Admin["Password"];
        $AdminNameSurname        =    $Admin["NameSurname"];
        $AdminPhoneNumber        =    $Admin["Phone"];

    } else {
        echo "ERROR Admin not Fount";
        die();
    }
}

?>