<?php
if(isset($_SESSION["Admin"])){
    if(isset($_GET["ID"])){
        $IncomingID			=	Safety($_GET["ID"]);
    }else{
        $IncomingID			=	"";
    }
    if (isset($_POST["MenuName"])){
        $IncomingMenuName       =  Safety($_POST["MenuName"]);
    }else{
        $IncomingMenuName       =  ";";
    }

    if(($IncomingID!="") and ($IncomingMenuName!="")){

        $Query = $DatabaseConnect->prepare("UPDATE menus SET MenuName = ? WHERE id = ? LIMIT 1");
        $Query->execute([$IncomingMenuName, $IncomingID]);
        $QueryControl = $Query->rowCount();

        if($QueryControl>0){
            header("Location:index.php?PageCodeLog=0&PageCodeA=64");
            exit();
        }else{
            header("Location:index.php?PageCodeLog=0&PageCodeA=65");
            exit();
        }
    }else{
        header("Location:index.php?PageCodeLog=0&PageCodeA=65");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>