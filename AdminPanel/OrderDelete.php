<?php
if(isset($_SESSION["Admin"])){
    if(isset($_GET["OrderNo"])){
        $IncomingOrderNO		=	Safety($_GET["OrderNo"]);
    }else{
        $IncomingOrderNO		=	"";
    }

    if($IncomingOrderNO!=""){
        $ordersQuery	=	$DatabaseConnect->prepare("SELECT * FROM orders WHERE OrderNO = ?");
        $ordersQuery->execute([$IncomingOrderNO]);
        $OrderCount		=	$ordersQuery->rowCount();
        $OrderRecords	=	$ordersQuery->fetchAll(PDO::FETCH_ASSOC);

        if($OrderCount>0){
            foreach($OrderRecords as $Lines){
                $OrderId				=	$Lines["id"];
                $OrderItemID		    =	$Lines["ItemID"];
                $OrderItemAmount		=	$Lines["ItemAmount"];
                $OrderVariantChoice	=	$Lines["VariantChoice"];

                $OrderDeleteQuery	=	$DatabaseConnect->prepare("DELETE FROM orders WHERE id = ? LIMIT 1");
                $OrderDeleteQuery->execute([$OrderId]);
                $DeleteControl			=	$OrderDeleteQuery->rowCount();

                if($DeleteControl>0){
                    $ItemUpdateQuery	=	$DatabaseConnect->prepare("UPDATE items SET SalesAmount=SalesAmount+? WHERE id = ? LIMIT 1");
                    $ItemUpdateQuery->execute([$OrderItemAmount, $OrderItemID]);
                    $ItemUpdateKontrol	=	$ItemUpdateQuery->rowCount();

                    if($ItemUpdateKontrol>0){
                        $VariantUpdateQuery	=	$DatabaseConnect->prepare("UPDATE itemsvariants SET StockNumber=StockNumber+? WHERE VariantName = ? AND UrunId = ? LIMIT 1");
                        $VariantUpdateQuery->execute([$OrderItemAmount, FiltersDecode($OrderVariantChoice), $OrderItemID]);
                        $VariantUpdateControl	=	$VariantUpdateQuery->rowCount();

                        if($VariantUpdateControl<1){
                            header("Location:index.php?PageCodeLog=0&PageCodeA=115");
                            exit();
                        }
                    }else{
                        header("Location:index.php?PageCodeLog=0&PageCodeA=115");
                        exit();
                    }
                }else{
                    header("Location:index.php?PageCodeLog=0&PageCodeA=115");
                    exit();
                }
            }

            header("Location:index.php?PageCodeLog=0&PageCodeA=114");
            exit();
        }else{
            header("Location:index.php?PageCodeLog=0&PageCodeA=115");
            exit();
        }
    }else{
        header("Location:index.php?PageCodeLog=0&PageCodeA=115");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>