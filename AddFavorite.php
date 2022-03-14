<?php
if(isset($_SESSION["User"])){
    if(isset($_GET["ID"])){
        $IncomingID		=	Safety($_GET["ID"]);
    }else{
        $IncomingID		=	"";
    }

    if($IncomingID!=""){

        $FavoriteQuery  	=	$DatabaseConnect->prepare("SELECT * FROM favorites WHERE ItemID = ? AND UserID = ? LIMIT 1");
        $FavoriteQuery->execute([$IncomingID, $UserID]);
        $FavoriteCount		=	$FavoriteQuery->rowCount();

        if($FavoriteCount>0){
            header("Location:index.php?PageCode=83");
            exit();
        }else{
            $AddFavoriteQuery	=	$DatabaseConnect->prepare("INSERT INTO favorites (ItemID, UserID) values (?, ?)");
            $AddFavoriteQuery->execute([$IncomingID, $UserID]);
            $AddFavoriteCount		=	$AddFavoriteQuery->rowCount();

            if($AddFavoriteCount>0){
                header("Location:index.php?PageCode=81");
                exit();
            }else{
                header("Location:index.php?PageCode=82");
                exit();
            }
        }
    }else{
        header("Location:index.php");
        exit();
    }
}else{
    header("Location:index.php");
    exit();
}
?>