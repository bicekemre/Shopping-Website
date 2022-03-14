<?php
if(isset($_SESSION["Admin"])){
    if(isset($_GET["ID"])){
        $IncomingID			=	Safety($_GET["ID"]);
    }else{
        $IncomingID			=	"";
    }

    if($IncomingID!=""){
        $Query	=	$DatabaseConnect->prepare("SELECT * FROM banners WHERE id = ?");
        $Query->execute([$IncomingID]);
        $Count	=	$Query->rowCount();
        $Records		=	$Query->fetch(PDO::FETCH_ASSOC);

        $DeletingPath		=	"../Images/".$Records["BannerPicture"];

        $DeletingQuery	=	$DatabaseConnect->prepare("DELETE FROM banners WHERE id = ? LIMIT 1");
        $DeletingQuery->execute([$IncomingID]);
        $DeletingControl	=	$DeletingQuery->rowCount();

        if($DeletingControl>0){
            unlink($DeletingPath);

            header("Location:index.php?PageCodeLog=0&PageCodeA=33");
            exit();
        }else{
            header("Location:index.php?PageCodeLog=0&PageCodeA=44");
            exit();
        }

    }else{
        header("Location:index.php?PageCodeLog=0&PageCodeA=44");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>
