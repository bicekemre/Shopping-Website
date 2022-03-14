<?php
if (isset($_SESSION["Admin"])){
    if ($_GET["ID"]){
        $IncomingID =   Safety($_GET["ID"]);
    }else{
        $IncomingID =   "";
    }

    if($IncomingID!=""){
        $MemberActivatingQuery	=	$DatabaseConnect->prepare("UPDATE members SET DeletingStatus = ? WHERE id = ? LIMIT 1");
        $MemberActivatingQuery->execute([0, $IncomingID]);
        $MemberActivatingControl	=	$MemberActivatingQuery->rowCount();

        if($MemberActivatingControl>0){
            header("Location:index.php?PageCodeLog=0&PageCodeA=88");
            exit();
        }else{
            header("Location:index.php?PageCodeLog=0&PageCodeA=89");
            exit();
        }
    }else{
        header("Location:index.php?PageCodeLog=0&PageCodeA=89");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>
