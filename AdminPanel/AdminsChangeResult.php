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
        $AdminPasswordQuery		=	$DatabaseConnect->prepare("SELECT * FROM admins WHERE id = ? LIMIT 1");
        $AdminPasswordQuery->execute([$IncomingID]);
        $AdminPasswordRecord		=	$AdminPasswordQuery->fetch(PDO::FETCH_ASSOC);
        $AdminPasswordControl		=	$AdminPasswordQuery->rowCount();

        if($AdminPasswordControl>0){
            $AdminPassword	=	$AdminPasswordRecord["Password"];

            if($IncomingPassword==""){
                $SavedPassword	=	$AdminPassword;
            }else{
                $SavedPassword	=	md5($IncomingPassword);
            }

            $AdminUpdateQuery	=	$DatabaseConnect->prepare("UPDATE admins SET NameSurname = ?, Password = ?, Email = ?, Phone = ? WHERE id = ? LIMIT 1");
            $AdminUpdateQuery->execute([$IncomingNameSurname, $SavedPassword, $IncomingEmail, $IncomingPhone, $IncomingID]);
            $AdminUpdateControl	=	$AdminUpdateQuery->rowCount();

            if($AdminUpdateControl>0){
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