<?php
$IPadress           =   $_SERVER["REMOTE_ADDR"];
$TimeTamp           =   time();
$Date               =   date("d.m.y H:i:s",$TimeTamp);
$ImagesPath         =   "/Basic E-Commerce Site/Images/";
$ImagesPathforVerot =   $_SERVER["DOCUMENT_ROOT"] . $ImagesPath;

function OnlyNumbers($Value){
    $Process				=	preg_replace("/[^0-9]/", "", $Value);
    return $Process;
}

function FiltersDecode($Value){
    $Decode     =   htmlspecialchars_decode($Value, ENT_QUOTES);
    return  $Decode;
}

function Safety($Value){
    $SpaceClean  =   trim($Value);
    $TagsClean   =   strip_tags($SpaceClean);
    $CodeClean   =   htmlspecialchars($TagsClean);
    $Result      =   $CodeClean;
    return $Result;
}

function NumbersFilter($Value){
    $SpaceDel			=	trim($Value);
    $TagsClean		    =	strip_tags($SpaceDel);
    $CodeClean			=	htmlspecialchars($TagsClean, ENT_QUOTES);
    $Clean			=	OnlyNumbers($CodeClean);
    return $Clean;
}

function ActivationCode(){
    $First      = rand(10000, 99999);
    $Second     = rand(10000, 99999);
    $Third      = rand(10000, 99999);
    $Fourth     = rand(10000, 99999);
    $Code       = $First . "-" . $Second . "-" . $Third . "-" . $Fourth;
    return $Code;
}

function DateFilter($Value){
    $Convert     = date("d.m.Y H:i:s", $Value);
    return $Convert;
}

function PriceFormat($Value){
    $Format    =    number_format($Value,"2",",",".");
    return $Format;
}

function ShippingDate(){
    global $TimeTamp;
    $Day			=	86400;
    $ThreeDayLater			=	$TimeTamp+(3*$Day);
    $DateFormat				=	date("d.m.Y", $ThreeDayLater);
    return $DateFormat;
}

function PictureNameCreate(){
    $Result			=	substr(md5(uniqid(time())), 0, 25);
    return $Result;
}
?>