<?php
if(isset($_SESSION["Admin"])){
    if(isset($_GET["ID"])){
        $IncomingID			=	Safety($_GET["ID"]);
    }else{
        $IncomingID			=	"";
    }

    if($IncomingID!=""){
        $Query	=	$DatabaseConnect->prepare("SELECT * FROM cargocompanies WHERE id = ?");
        $Query->execute([$IncomingID]);
        $Count	=	$Query->rowCount();
        $Records		=	$Query->fetch(PDO::FETCH_ASSOC);

        $DeletingPath		=	"../Images/".$Records["BankLogo"];

        $DeletingQuery	=	$DatabaseConnect->prepare("DELETE FROM cargocompanies WHERE id = ? LIMIT 1");
        $DeletingQuery->execute([$IncomingID]);
        $DeletingControl	=	$DeletingQuery->rowCount();

        if($DeletingControl>0){
            unlink($DeletingPath);

            header("Location:index.php?PageCodeLog=0&PageCodeA=31");
            exit();
        }else{
            header("Location:index.php?PageCodeLog=0&PageCodeA=32");
            exit();
        }

    }else{
        header("Location:index.php?PageCodeLog=0&PageCodeA=32");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>
