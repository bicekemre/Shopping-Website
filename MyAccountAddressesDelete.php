<?php
if ($_SESSION["User"]){
    if (isset($_GET["ID"])){
        $IncomingID     =   Safety($_GET["ID"]);
    }else{
        $IncomingID     =   "";
    }
    if($IncomingID!=""){
        $AddressDeleteQuery		=	$DatabaseConnect->prepare("DELETE FROM addresses WHERE id = ? LIMIT 1");
        $AddressDeleteQuery->execute([$IncomingID]);
        $AddressDeleteCount		=	$AddressDeleteQuery->rowCount();

        if($AddressDeleteCount>0){
            header("Location:index.php?PageCode=53");
            exit();
        }else{
            header("Location:index.php?PageCode=64");
            exit();
        }
    }else{
        header("Location:index.php?PageCode=64");
        exit();
    }
}else{
    header("Location:index.php");
    exit();
}
?>






















}else{
    header("Location:index.php");
    exit();
}
?>
