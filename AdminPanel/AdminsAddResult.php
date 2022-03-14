<?php
if(isset($_SESSION["Admin"])){
    if(isset($_POST["AdminName"])){
        $IncomingAdminName			=	Safety($_POST["AdminName"]);
    }else{
        $IncomingAdminName			=	"";
    }
    if(isset($_POST["Password"])){
        $IncomingPassword					=	Safety($_POST["Password"]);
    }else{
        $IncomingPassword					=	"";
    }
    if(isset($_POST["NameSurname"])){
        $IncomingNameSurname			=	Safety($_POST["NameSurname"]);
    }else{
        $IncomingNameSurname			=	"";
    }
    if(isset($_POST["Email"])){
        $IncomingEmail			=	Safety($_POST["Email"]);
    }else{
        $IncomingEmail			=	"";
    }
    if(isset($_POST["Phone"])){
        $IncomingPhone		=	Safety($_POST["Phone"]);
    }else{
        $IncomingPhone		=	"";
    }

    $MD5Password						=	md5($IncomingPassword);

    if(($IncomingAdminName!="") and ($IncomingPassword!="") and ($IncomingNameSurname!="") and ($IncomingEmail!="") and ($IncomingPhone!="")){
        $Query		=	$DatabaseConnect->prepare("SELECT * FROM admins WHERE AdminName = ? OR Email = ?");
        $Query->execute([$IncomingAdminName, $IncomingEmail]);
        $QueryControl					=	$Query->rowCount();

        if($QueryControl>0){
            header("Location:index.php?PageCodeLog=0&PageCodeA=74");
            exit();
        }else{
            $AddAdminQuery		=	$DatabaseConnect->prepare("INSERT INTO admins (AdminName, Password, NameSurname, Email, Phone) values (?, ?, ?, ?, ?)");
            $AddAdminQuery->execute([$IncomingAdminName, $MD5Password, $IncomingNameSurname, $IncomingEmail, $IncomingPhone]);
            $AddAdminControl	=	$AddAdminQuery->rowCount();

            if($AddAdminControl>0){
                header("Location:index.php?PageCodeLog=0&PageCodeA=72");
                exit();
            }else{
                header("Location:index.php?PageCodeLog=0&PageCodeA=73");
                exit();
            }
        }
    }else{
        header("Location:index.php?PageCodeLog=0&PageCodeA=73");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>