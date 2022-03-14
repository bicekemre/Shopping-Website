<?php
if (isset($_SESSION["Admin"])){
    if ($_GET["ID"]){
        $IncomingID =   Safety($_GET["ID"]);
    }else{
        $IncomingID =   "";
    }

    if($IncomingID!=""){
        $MemberDeleteQuery	=	$DatabaseConnect->prepare("UPDATE members SET DeletingStatus = ? WHERE id = ? LIMIT 1");
        $MemberDeleteQuery->execute([1, $IncomingID]);
        $MemberDeleteControl	=	$MemberDeleteQuery->rowCount();

        if($MemberDeleteControl>0){
            $BasketDeleteQuery		=	$DatabaseConnect->prepare("DELETE FROM basket WHERE UserID = ?");
            $BasketDeleteQuery->execute([$IncomingID]);

            $CommentsQuery	=	$DatabaseConnect->prepare("SELECT * FROM comments WHERE UserID = ?");
            $CommentsQuery->execute([$IncomingID]);
            $CommentsCount		=	$CommentsQuery->rowCount();
            $CommentsRecords	=	$CommentsQuery->fetchAll(PDO::FETCH_ASSOC);

            if($CommentsCount>0){
                foreach($CommentsRecords as $CommentLines){
                    $CommentId							=	$CommentLines["id"];
                    $UpdatingItemID			=	$CommentLines["ItemID"];
                    $UpdatingItemRating	=	$CommentLines["Rating"];

                    $UpdatingItemQuery	=	$DatabaseConnect->prepare("UPDATE items SET CommentNumber=CommentNumber-1, Rating=Rating-? WHERE id = ? LIMIT 1");
                    $UpdatingItemQuery->execute([$UpdatingItemRating, $UpdatingItemID]);
                    $UpdatingItemControl	=	$UpdatingItemQuery->rowCount();

                    if($UpdatingItemControl<1){
                        header("Location:index.php?PageCodeLog=0&PageCodeA=86");
                        exit();
                    }

                    $CommentDeleteQuery		=	$DatabaseConnect->prepare("DELETE FROM comments WHERE id = ? LIMIT 1");
                    $CommentDeleteQuery->execute([$CommentId]);
                    $CommentDeleteControl		=	$CommentDeleteQuery->rowCount();

                    if($CommentDeleteControl<1){
                        header("Location:index.php?PageCodeLog=0&PageCodeA=86");
                        exit();
                    }
                }
            }

            header("Location:index.php?PageCodeLog=0&PageCodeA=85");
            exit();
        }else{
            header("Location:index.php?PageCodeLog=0&PageCodeA=86");
            exit();
        }
    }else{
        header("Location:index.php?PageCodeLog=0&PageCodeA=86");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>
