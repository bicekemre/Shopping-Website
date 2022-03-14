<?php
if(isset($_SESSION["User"])){
    if(isset($_POST["NameSurname"])){
        $IncomingNameSurname		=	Safety($_POST["NameSurname"]);
    }else{
        $IncomingNameSurname		=	"";
    }
    if(isset($_POST["Address"])){
        $IncomingAddress				=	Safety($_POST["Address"]);
    }else{
        $IncomingAddress				=	"";
    }
    if(isset($_POST["District"])){
        $IncomingDistrict			=	Safety($_POST["District"]);
    }else{
        $IncomingDistrict				=	"";
    }
    if(isset($_POST["City"])){
        $IncomingCity				=	Safety($_POST["City"]);
    }else{
        $IncomingCity				=	"";
    }
    if(isset($_POST["PhoneNumber"])){
        $IncomingPhoneNumber	=	Safety($_POST["PhoneNumber"]);
    }else{
        $IncomingPhoneNumber	=	"";
    }

    if(($IncomingNameSurname!="") and ($IncomingAddress!="") and ($IncomingDistrict!="") and ($IncomingCity!="") and ($IncomingPhoneNumber!="")){
        $AddressAddQuery    	=	$DatabaseConnect->prepare("INSERT INTO addresses (UserId, NameSurname, Address, District, City, PhoneNumber) values (?, ?, ?, ?, ?, ?)");
        $AddressAddQuery->execute([$UserID, $IncomingNameSurname, $IncomingAddress, $IncomingDistrict, $IncomingCity, $IncomingPhoneNumber]);
        $Conrtol			=	$AddressAddQuery->rowCount();

        if($Conrtol>0){
            header("Location:index.php?PageCode=67");
            exit();
        }else{
            header("Location:index.php?PageCode=68");
            exit();
        }
    }else{
        header("Location:index.php?PageCode=69");
        exit();
    }
}else{
    header("Location:index.php");
    exit();
}
?>