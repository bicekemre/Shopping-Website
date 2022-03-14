<?php
if(isset($_SESSION["Admin"])){
    if(isset($_GET["OrderNo"])){
        $IncomingOrderNO		=	Safety($_GET["OrderNo"]);
    }else{
        $IncomingOrderNO		=	"";
    }
    if(isset($_POST["ShippingCode"])){
        $IncomingShippingNO	=	Safety($_POST["ShippingCode"]);
    }else{
        $IncomingShippingNO	=	"";
    }

    if(($IncomingOrderNO!="") and ($IncomingShippingNO!="")){
        $Query	=	$DatabaseConnect->prepare("UPDATE orders SET OrderConfirmStatus = ?, ShippingStatus = ?, ShippingCode = ? WHERE OrderNO = ?");
        $Query->execute([1, 1, $IncomingShippingNO, $IncomingOrderNO]);
        $Control			=	$Query->rowCount();

        if($Control>0){
            header("Location:index.php?PageCodeLog=0&PageCodeA=111");
            exit();
        }else{
            header("Location:index.php?PageCodeLog=0&PageCodeA=112");
            exit();
        }
    }else{
        header("Location:index.php?PageCodeLog=0&PageCodeA=112");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>