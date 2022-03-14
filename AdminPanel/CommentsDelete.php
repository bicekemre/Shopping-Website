<?php
if (isset($_SESSION["Admin"])){
    if ($_GET["ID"]){
        $IncomingID =   Safety($_GET["ID"]);
    }else{
        $IncomingID =   "";
    }

    if($IncomingID!=""){
        $commentsQuery	=	$DatabaseConnect->prepare("SELECT * FROM comments WHERE id = ? LIMIT 1");
        $commentsQuery->execute([$IncomingID]);
        $commentsCount		=	$commentsQuery->rowCount();
        $commentsRecords		=	$commentsQuery->fetch(PDO::FETCH_ASSOC);

        if($commentsCount>0){
            $UpdatingItemID			=	$commentsRecords["ItemID"];
            $UpdatingItemRating	    =	$commentsRecords["Rating"];

            $DeleteQuery		=	$DatabaseConnect->prepare("DELETE FROM comments WHERE id = ? LIMIT 1");
            $DeleteQuery->execute([$IncomingID]);
            $DeleteControl		=	$DeleteQuery->rowCount();

            if($DeleteControl>0){
                $ItemUpdateQuery	=	$DatabaseConnect->prepare("UPDATE items SET CommentNumber=CommentNumber-1, Rating=Rating-? WHERE id = ? LIMIT 1");
                $ItemUpdateQuery->execute([$UpdatingItemRating, $UpdatingItemID]);
                $ItemUpdateControl	=	$ItemUpdateQuery->rowCount();

                if($ItemUpdateControl>0){
                    header("Location:index.php?PageCodeLog=0&PageCodeA=92");
                    exit();
                }else{
                    header("Location:index.php?PageCodeLog=0&PageCodeA=93");
                    exit();
                }
            }else{
                header("Location:index.php?PageCodeLog=0&PageCodeA=93");
                exit();
            }
        }else{
            header("Location:index.php?PageCodeLog=0&PageCodeA=93");
            exit();
        }
    }else{
        header("Location:index.php?PageCodeLog=0&PageCodeA=93");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>