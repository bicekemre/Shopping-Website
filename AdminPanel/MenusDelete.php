<?php
if (isset($_SESSION["Admin"])){
    if ($_GET["ID"]){
        $IncomingID =   $_GET["ID"];
    }else{
        $IncomingID =   "";
    }

    if ($IncomingID!=""){

        $DeletingQuery	=	$DatabaseConnect->prepare("DELETE FROM menus WHERE id = ? LIMIT 1");
        $DeletingQuery->execute([$IncomingID]);
        $DeletingControl	=	$DeletingQuery->rowCount();

        if($DeletingControl>0){
            $ItemQuery			=	$DatabaseConnect->prepare("SELECT * FROM items WHERE MenuID = ?");
            $ItemQuery->execute([$IncomingID]);
            $ItemControl	    =	$ItemQuery->rowCount();
            $ItemRecords		=	$ItemQuery->fetchAll(PDO::FETCH_ASSOC);

            if($ItemControl>0){
                foreach($ItemRecords as $itemRecords){
                    $DeletinItemID	=	$itemRecords["id"];

                    $ItemUpdateQuery	=	$DatabaseConnect->prepare("UPDATE items SET Status = ? WHERE id = ? AND MenuID = ?");
                    $ItemUpdateQuery->execute([0, $DeletinItemID, $IncomingID]);

                    $BasketDeleteQuery			=	$DatabaseConnect->prepare("DELETE FROM basket WHERE ItemID = ?");
                    $BasketDeleteQuery->execute([$DeletinItemID]);

                    $FavoritesDeleteQuery		=	$DatabaseConnect->prepare("DELETE FROM favorites WHERE ItemID = ?");
                    $FavoritesDeleteQuery->execute([$DeletinItemID]);
                }
            }

            header("Location:index.php?PageCodeLog=0&PageCodeA=67");
            exit();
        }else{
            header("Location:index.php?PageCodeLog=0&PageCodeA=68");
            exit();
        }
    }else{
        header("Location:index.php?PageCodeLog=0&PageCodeA=68");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>