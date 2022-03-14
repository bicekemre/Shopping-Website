<?php
if (empty($_SESSION["Admin"])) {
    if(isset($_POST["AdminName"])){
        $IncomingAdminName		=	Safety($_POST["AdminName"]);
    }else{
        $IncomingAdminName	=	"";
    }

    if(isset($_POST["Password"])){
        $IncomingPassword		=	Safety($_POST["Password"]);
    }else{
        $IncomingPassword		=	"";
    }

    $MD5Password        =   md5($IncomingPassword);

    if(($IncomingAdminName!="") and ($IncomingPassword!="")){
        $ControlQuery		=	$DatabaseConnect->prepare("SELECT * FROM admins WHERE AdminName = ? AND Password = ?");
        $ControlQuery->execute([$IncomingAdminName, $MD5Password]);
        $UserCount	    =	$ControlQuery->rowCount();
        $UserRegis		=	$ControlQuery->fetch(PDO::FETCH_ASSOC);

        if($UserCount>0){
            $_SESSION["Admin"]	=	$IncomingAdminName;

            header("Location:index.php?PageCodeLog=0&PageCodeA=0");
            exit();
        }else{
            header("Location:index.php?PageCodeLog=3");
            exit();
        }
    }else{
        header("Location:index.php?PageCodeLog=1");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=0");
    exit();
}
?>