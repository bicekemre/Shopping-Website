<?php
if(isset($_SESSION["User"])){
    if(isset($_GET["ID"])){
        $IncomingID		=	Safety($_GET["ID"]);
    }else{
        $IncomingID		=	"";
    }

    if (isset($_POST["variant"])){
        $IncomingVariantID    =   Safety($_POST["variant"]);
    }else{
        $IncomingVariantID    = "";
    }

    if(($IncomingID!="") and ($IncomingVariantID!="")){
        $UserBasketQuery		=	$DatabaseConnect->prepare("DELETE FROM basket WHERE UserID = ? ORDER BY id DESC LIMIT 1");
        $UserBasketQuery->execute([$UserID]);
        $UserBasketCount	    =	$UserBasketQuery->rowCount();

        if($UserBasketCount>0){
            $ItemBasketQuery		=	$DatabaseConnect->prepare("SELECT * FROM basket WHERE UserID = ? AND ItemID = ? AND VariantID = ? LIMIT 1");
            $ItemBasketQuery->execute([$UserID,$IncomingID,$IncomingVariantID]);
            $ItemBasketCount	    =	$ItemBasketQuery->rowCount();
            $ItemBasketRecords      =   $ItemBasketQuery->fetch(PDO::FETCH_ASSOC);

            if($ItemBasketCount>0){
                $ItemID         =   $UserBasketCount["id"];
                $ItemAmount     =   $UserBasketCount["ItemAmount"];
                $ItemNewAmount  =   $ItemAmount+1;

                $ItemChangeQuery	    =	$DatabaseConnect->prepare("UPDATE basket SET ItemAmount = ? WHERE id = ? AND UserID = ? AND ItemID = ? LIMIT 1");
				$ItemChangeQuery->execute([$ItemNewAmount, $ItemID, $UserID, $IncomingID]);
				$ItemChangeCount		=	$ItemChangeQuery->rowCount();

                    if ($ItemChangeCount>0){
                        header("Location:index.php?PageCode=87");
                        exit();
                    }else{
                        header("Location:index.php?PageCode=85");
                        exit();
                    }
            }else{
                $ItemAddQuery		    =	$DatabaseConnect->prepare("INSERT INTO basket (UserID, ItemID, VariantID, ItemAmount) values (?, ?, ?, ?)");
                $ItemAddQuery->execute([$UserID, $IncomingID, $IncomingVariantID, 1]);
                $ItemAddCount		    =	$ItemAddQuery->rowCount();
                $LastInsertIdValue		=	$DatabaseConnect->lastInsertId();

                    if ($ItemAddCount>0){
                        $OrderNOUpdateQuery		    =	$DatabaseConnect->prepare("UPDATE basket SET 	BasketNO = ? WHERE UserID = ?");
                        $OrderNOUpdateQuery->execute([$LastInsertIdValue, $UserID]);
                        $OrderNOUpdateQueryCount	=	$OrderNOUpdateQuery->rowCount();
                            if ($OrderNOUpdateQueryCount>0){
                                header("Location:index.php?PageCode=87");
                                exit();
                            }else{
                                header("Location:index.php?PageCode=85");
                                exit();
                            }
                    }else{
                        header("Location:index.php?PageCode=85");
                        exit();
                    }
            }
        }else{
            $ItemAddQuery		    =	$DatabaseConnect->prepare("INSERT INTO basket (UserID, ItemID, VariantID, ItemAmount) values (?, ?, ?, ?)");
            $ItemAddQuery->execute([$UserID, $IncomingID, $IncomingVariantID, 1]);
            $ItemAddCount		    =	$ItemAddQuery->rowCount();
            $LastInsertIdValue		=	$DatabaseConnect->lastInsertId();

                if ($ItemAddCount>0){
                    $OrderNOUpdateQuery		    =	$DatabaseConnect->prepare("UPDATE basket SET 	BasketNO = ? WHERE UserID = ?");
                    $OrderNOUpdateQuery->execute([$LastInsertIdValue, $UserID]);
                    $OrderNOUpdateQueryCount	=	$OrderNOUpdateQuery->rowCount();
                        if ($OrderNOUpdateQueryCount>0){
                            header("Location:index.php?PageCode=87");
                            exit();
                        }else{
                            header("Location:index.php?PageCode=85");
                            exit();
                        }
                }else{
                    header("Location:index.php?PageCode=85");
                    exit();
                }
        }
    }else{
        header("Location:index.php");
        exit();
    }
}else{
    header("Location:index.php?PageCode=86");
    exit();
}
?>