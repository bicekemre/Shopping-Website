<?php
if(isset($_SESSION["User"])){
    if(isset($_GET["ItemID"])){
        $IncomingItemID	=	Safety($_GET["ItemID"]);
    }else{
        $IncomingItemID	=	"";
    }
    if(isset($_POST["RatingPoint"])){
        $IncomingRating		=	Safety($_POST["RatingPoint"]);
    }else{
        $IncomingRating		=	"";
    }
    if(isset($_POST["Comment"])){
        $IncomingComment		=	Safety($_POST["Comment"]);
    }else{
        $IncomingComment		=	"";
    }

    if(($IncomingItemID!="") and ($IncomingRating!="") and ($IncomingComment!="")){
        $CommentRecordsQuery		=	$DatabaseConnect->prepare("INSERT INTO comments (ItemID, UserID, Rating, CommentText, CommentDate, CommentIPAddress) values (?, ?, ?, ?, ?, ?)");
        $CommentRecordsQuery->execute([$IncomingItemID, $UserID, $IncomingRating, $IncomingComment, $TimeTamp, $UserRegisIPaddress]);
        $CommentRecordsControl		=	$CommentRecordsQuery->rowCount();

        if($CommentRecordsControl>0){
            $ItemQuery		=	$DatabaseConnect->prepare("UPDATE items SET CommentNumber=CommentNumber+1, Rating=Rating+? WHERE id = ? LIMIT 1");
            $ItemQuery->execute([$IncomingRating, $IncomingItemID]);
            $ItemControl		=	$ItemQuery->rowCount();

            if($ItemControl>0){
                header("Location:index.php?PageCode=72");
                exit();
            }else{
                header("Location:index.php?PageCode=73");
                exit();
            }
        }else{
            header("Location:index.php?PageCode=73");
            exit();
        }
    }else{
        header("Location:index.php?PageCode=74");
        exit();
    }
}else{
    header("Location:index.php");
    exit();
}
?>
