<?php
if(isset($_SESSION["Admin"])){
    if(isset($_GET["ID"])){
        $IncomingID	=	Safety($_GET["ID"]);
    }else{
        $IncomingID	=	"";
    }

    if($IncomingID!=""){
        $ItemsQuery			=	$DatabaseConnect->prepare("SELECT * FROM items WHERE id = ?");
        $ItemsQuery->execute([$IncomingID]);
        $ItemsQueryControl	=	$ItemsQuery->rowCount();
        $ItemsQueryRecords	=	$ItemsQuery->fetch(PDO::FETCH_ASSOC);

        if($ItemsQueryControl>0){
            $DeletingItemMenuID	=	$ItemsQueryRecords["MenuID"];

            $ItemDeleteQuery	=	$DatabaseConnect->prepare("UPDATE items SET Status = ? WHERE id = ? LIMIT 1");
            $ItemDeleteQuery->execute([0, $IncomingID]);
            $ItemDeleteControl	=	$ItemDeleteQuery->rowCount();

            if($ItemDeleteControl>0){
                $BasketDeleteQuery		=	$DatabaseConnect->prepare("DELETE FROM basket WHERE ItemID = ?");
                $BasketDeleteQuery->execute([$IncomingID]);

                $FavoritesQuery	=	$DatabaseConnect->prepare("DELETE FROM favorites WHERE ItemID = ?");
                $FavoritesQuery->execute([$IncomingID]);

                $MenuUpdateQuery	=	$DatabaseConnect->prepare("UPDATE menus SET ItemAmount=ItemAmount-1 WHERE id = ?");
                $MenuUpdateQuery->execute([$DeletingItemMenuID]);

                header("Location:index.php?PageCodeLog=0&PageCodeA=104");
                exit();
            }else{
                header("Location:index.php?PageCodeLog=0&PageCodeA=105");
                exit();
            }
        }else{
            header("Location:index.php?PageCodeLog=0&PageCodeA=105");
            exit();
        }
    }else{
        header("Location:index.php?PageCodeLog=0&PageCodeA=105");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>