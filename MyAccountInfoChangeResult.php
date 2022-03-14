<?php
if (isset($_SESSION["User"])) {
    if (isset($_POST["EmailAddress"])) {
        $IncomeingEmail = Safety($_POST["EmailAddress"]);
    } else {
        $IncomeingEmail = "";
    }

    if (isset($_POST["Password"])) {
        $IncomeingPassword = Safety($_POST["Password"]);
    } else {
        $IncomeingPassword = "";
    }

    if (isset($_POST["PasswordAgain"])) {
        $IncomeingPasswordAgain = Safety($_POST["PasswordAgain"]);
    } else {
        $IncomeingPasswordAgain = "";
    }

    if (isset($_POST["NameSurname"])) {
        $IncomeingNameSurname = Safety($_POST["NameSurname"]);
    } else {
        $IncomeingNameSurname = "";
    }

    if (isset($_POST["PhoneNumber"])) {
        $IncomeingPhone = Safety($_POST["PhoneNumber"]);
    } else {
        $IncomeingPhone = "";
    }

    if (isset($_POST["Gender"])) {
        $IncomeingGender = Safety($_POST["Gender"]);
    } else {
        $IncomeingGender = "";
    }

    $MD5Password = md5($IncomeingPassword);

    if(($IncomeingEmail!="") and ($IncomeingPassword!="") and ($IncomeingPasswordAgain!="") and ($IncomeingNameSurname!="") and ($IncomeingPhone!="") and ($IncomeingGender!="")){
        if($IncomeingPassword!=$IncomeingPasswordAgain){
            header("Location:index.php?PageCode=52");
            exit();
        }else{
            if($IncomeingPassword == "OldPassword"){
                $ChangePasswordStatus		=	0;
            }else{
                $ChangePasswordStatus		=	1;
            }

            if($UserEmailAddress != $IncomeingEmail){
                $ControlQuery  = $DatabaseConnect->prepare("SELECT * FROM members WHERE EmailAddress = ?" );
                $ControlQuery->execute([$IncomeingEmail]);
                $UserCount  = $ControlQuery->rowCount();

                if($UserCount>0){
                    header("Location:index.php?PageCode=50");
                    exit();
                }
            }

            if($ChangePasswordStatus == 1){
                $UserChangeQuery		=	$DatabaseConnect->prepare("UPDATE members SET EmailAddress = ?, Password = ?, NameSurname = ?, PhoneNumber = ?, Gender = ? WHERE id = ? LIMIT 1");
                $UserChangeQuery->execute([$IncomeingEmail, $MD5Password, $IncomeingNameSurname, $IncomeingPhone, $IncomeingGender, $UserID]);
            }else{
                $UserChangeQuery		=	$DatabaseConnect->prepare("UPDATE members SET EmailAddress = ?, NameSurname = ?, PhoneNumber = ?, Gender = ? WHERE id = ? LIMIT 1");
                $UserChangeQuery->execute([$IncomeingEmail, $IncomeingNameSurname, $IncomeingPhone, $IncomeingGender, $UserID]);
            }

            $RegisControl		=	$UserChangeQuery->rowCount();

            if($RegisControl>0){
                $_SESSION["User"]	=	$IncomeingEmail;

                header("Location:index.php?PageCode=48");
                exit();
            }else{
                header("Location:index.php?PageCode=49");
                exit();
            }
        }
    }else{

        header("Location:index.php?PageCode=51");
        exit();
    }
}else{
    header("Location:index.php");
    exit();
}
?>