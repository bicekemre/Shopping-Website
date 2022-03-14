<?php
if(isset($_SESSION["User"])){
    if(isset($_GET["ID"])){
        $IncomingID		=	Safety($_GET["ID"]);
    }else{
        $IncomingID		=	"";
    }

    if($IncomingID!=""){
        $FavoritesDeleteQuery		=	$DatabaseConnect->prepare("DELETE FROM favorites WHERE id = ? AND UserID = ? LIMIT 1");
        $FavoritesDeleteQuery->execute([$IncomingID, $UserID]);
        $FavoritesDeleteCount	    =	$FavoritesDeleteQuery->rowCount();

        if($FavoritesDeleteCount>0){
            header("Location:index.php?PageCode=54");
            exit();
        }else{
            header("Location:index.php?PageCode=77");
            exit();
        }
    }else{
        header("Location:index.php?PageCode=77");
        exit();
    }
}else{
    header("Location:index.php");
    exit();
}
?>