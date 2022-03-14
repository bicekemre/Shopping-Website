<?php
if (isset($_SESSION["User"])) {
    if (isset($_GET["ID"])) {
        $IncomingID = Safety($_GET["ID"]);
    } else {
        $IncomingID = "";
    }
    if (isset($_POST["NameSurname"])) {
        $IncomingNameSurname = Safety($_POST["NameSurname"]);
    } else {
        $IncomingNameSurname = "";
    }
    if (isset($_POST["Address"])) {
        $IncomingAddress = Safety($_POST["Address"]);
    } else {
        $IncomingAddress = "";
    }
    if (isset($_POST["District"])) {
        $IncomingDistrict = Safety($_POST["District"]);
    } else {
        $IncomingDistrict = "";
    }
    if (isset($_POST["City"])) {
        $IncomingCity = Safety($_POST["City"]);
    } else {
        $IncomingCity = "";
    }
    if (isset($_POST["PhoneNumber"])) {
        $IncomingPhoneNumber = Safety($_POST["PhoneNumber"]);
    } else {
        $IncomingPhoneNumber = "";
    }


    if(($IncomingID!="") and ($IncomingNameSurname!="") and ($IncomingAddress!="") and ($IncomingDistrict!="") and ($IncomingCity!="") and ($IncomingPhoneNumber!="")){
            $AdresChangeQuery		=	$DatabaseConnect->prepare("UPDATE addresses SET NameSurname = ?, Address = ?, District = ?, City = ?, PhoneNumber = ?  WHERE id = ? AND UserId = ? LIMIT 1");
            $AdresChangeQuery->execute([$IncomingNameSurname, $IncomingAddress, $IncomingDistrict, $IncomingCity, $IncomingPhoneNumber, $IncomingID, $UserID]);
            $Control			=	$AdresChangeQuery->rowCount();

        if($Control>0){
            header("Location:index.php?PageCode=59");
            exit();
        }else{
            header("Location:index.php?PageCode=60");
            exit();
        }
    }else{
        header("Location:index.php?PageCode=61");
        exit();
    }
}else{
    header("Location:index.php");
    exit();
}
?>