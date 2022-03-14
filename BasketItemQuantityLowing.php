<?php
if(isset($_SESSION["User"])){
    if(isset($_GET["ID"])){
        $IncomingID		=	Safety($_GET["ID"]);
    }else{
        $IncomingID		=	"";
    }


    if($IncomingID!=""){
        $BasketUpdateQuery		=	$DatabaseConnect->prepare("UPDATE basket SET ItemAmount=ItemAmount-1 WHERE id = ? AND UserID = ? LIMIT 1");
        $BasketUpdateQuery->execute([$IncomingID, $UserID]);
        $BasketUpdateCount		=	$BasketUpdateQuery->rowCount();


        if($BasketUpdateCount>0){
            header("Location:index.php?PageCode=87");
            exit();
        }else{
            header("Location:index.php?PageCode=87");
            exit();
        }
    }else{
        header("Location:index.php?PageCode=87");
        exit();
    }
}else{
    header("Location:index.php");
    exit();
}
?>