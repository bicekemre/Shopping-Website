<?php
if(isset($_SESSION["Admin"])){
    if (isset($_POST["MenuName"])){
        $IncomingMenuName       =  Safety($_POST["MenuName"]);
    }else{
        $IncomingMenuName       =  ";";
    }
    if (isset($_POST["ItemType"])){
        $IncomingItemType      =  Safety($_POST["ItemType"]);
    }else{
        $IncomingItemType       =  ";";
    }

    if(($IncomingMenuName!="") and ($IncomingItemType!="")){
        $Query = $DatabaseConnect->prepare("INSERT INTO menus (MenuName, ItemType) values (?, ?)");
        $Query->execute([$IncomingMenuName, $IncomingItemType]);
        $QueryControl = $Query->rowCount();

        if($QueryControl>0){
            header("Location:index.php?PageCodeLog=0&PageCodeA=60");
            exit();
        }else{
            header("Location:index.php?PageCodeLog=0&PageCodeA=61");
            exit();
        }
    }else{
        header("Location:index.php?PageCodeLog=0&PageCodeA=61");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>