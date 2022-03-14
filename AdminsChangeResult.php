<?php
if(isset($_SESSION["Admin"])){
    if(isset($_GET["ID"])){
        $IncomingID				=	Safety($_GET["ID"]);
    }else{
        $IncomingID				=	"";
    }
    if(isset($_POST["Password"])){
        $IncomingPassword				=	Safety($_POST["Password"]);
    }else{
        $IncomingPassword				=	"";
    }
    if(isset($_POST["NameSurname"])){
        $IncomingNameSurname		=	Safety($_POST["NameSurname"]);
    }else{
        $IncomingNameSurname		=	"";
    }
    if(isset($_POST["Email"])){
        $IncomingEmail		=	Safety($_POST["Email"]);
    }else{
        $IncomingEmail		=	"";
    }
    if(isset($_POST["Phone"])){
        $IncomingPhone	=	Safety($_POST["Phone"]);
    }else{
        $IncomingPhone	=	"";
    }

    if(($IncomingID!="") and ($IncomingNameSurname!="") and ($IncomingEmail!="") and ($IncomingPhone!="")){
        $PasswordQuery		=	$DatabaseConnect->prepare("SELECT * FROM admins WHERE id = ? LIMIT 1");
        $PasswordQuery->execute([$IncomingID]);
        $PasswordRecords		=	$PasswordQuery->fetch(PDO::FETCH_ASSOC);
        $PasswordControl		=	$PasswordQuery->rowCount();

        if($PasswordControl>0){
            $Password	=	$PasswordRecords["Password"];

            if($IncomingPassword==""){
                $NewPassword	=	$Password;
            }else{
                $NewPassword	=	md5($IncomingPassword);
            }

            $UpdateQuery	=	$DatabaseConnect->prepare("UPDATE admins SET NameSurname = ?, Password = ?, Email = ?, Phone = ? WHERE id = ? LIMIT 1");
            $UpdateQuery->execute([$IncomingNameSurname, $NewPassword, $IncomingEmail, $IncomingPhone, $IncomingID]);
            $UpdateControl	=	$UpdateQuery->rowCount();

            if($UpdateControl>0){
                header("Location:index.php?PageCodeLog=0&PageCodeA=77");
                exit();
            }else{
                header("Location:index.php?PageCodeLog=0&PageCodeA=78");
                exit();
            }
        }else{
            header("Location:index.php?PageCodeLog=0&PageCodeA=78");
            exit();
        }
    }else{
        header("Location:index.php?PageCodeLog=0&PageCodeA=78");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>