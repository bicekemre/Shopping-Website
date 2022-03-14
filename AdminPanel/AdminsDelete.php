<?php
if (isset($_SESSION["Admin"])){
    if ($_GET["ID"]){
        $IncomingID =   $_GET["ID"];
    }else{
        $IncomingID =   "";
    }

    if ($IncomingID!=""){

        $DeletingQuery	=	$DatabaseConnect->prepare("DELETE FROM admins WHERE id = ? LIMIT 1");
        $DeletingQuery->execute([$IncomingID]);
        $DeletingControl	=	$DeletingQuery->rowCount();

        if ($DeletingControl>0) {
            header("Location:index.php?PageCodeLog=0&PageCodeA=80");
            exit();
        }else{
            header("Location:index.php?PageCodeLog=0&PageCodeA=81");
            exit();
        }
    }else{
        header("Location:index.php?PageCodeLog=0&PageCodeA=81");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=0");
    exit();
}