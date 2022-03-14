<?php
if(isset($_SESSION["User"])){
    if(isset($_GET["ID"])){
        $IncomingID		=	Safety($_GET["ID"]);
    }else{
        $IncomingID		=	"";
    }

    if($IncomingID!=""){
        $BasketDeleteQuery		=	$DatabaseConnect->prepare("DELETE FROM basket WHERE id = ? AND UserID = ? LIMIT 1");
        $BasketDeleteQuery->execute([$IncomingID, $UserID]);
        $BasketDeleteCount		=	$BasketDeleteQuery->rowCount();

        if($BasketDeleteCount>0){
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