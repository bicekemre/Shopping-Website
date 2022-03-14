<?php
if (isset($_SESSION["User"])){
    if (isset($_POST["Payment"])){
        $IncomingPayment  =   Safety($_POST["Payment"]);
    }else{
        $IncomingPayment  =   "";
    }
    if (isset($_POST["InstallmentChocie"])){
        $IncomingInstallmentChocie =   Safety($_POST["InstallmentChocie"]);
    }else{
        $IncomingInstallmentChocie  =   "";
    }

    if(($IncomingPayment!="")){
        if($IncomingPayment=="Money Transfer"){
            $BasketItemsQuery	=	$DatabaseConnect->prepare("SELECT * FROM basket WHERE UserID = ?");
            $BasketItemsQuery->execute([$UserID]);
            $BasketItemsCount		=	$BasketItemsQuery->rowCount();
            $BasketItemsRecords		=	$BasketItemsQuery->fetchAll(PDO::FETCH_ASSOC);

            if ($BasketItemsCount>0){
                foreach ($BasketItemsRecords as $BasketItemsLines) {
                    $BasketID				=	$BasketItemsLines["id"];
                    $BasketNO			    =	$BasketItemsLines["BasketNO"];
                    $BasketUserID			=	$BasketItemsLines["UserID"];
                    $BasketItemID			=	$BasketItemsLines["ItemID"];
                    $BasketAddressID		=	$BasketItemsLines["AddressID"];
                    $BasketItemVariantID	=	$BasketItemsLines["VariantID"];
                    $BasketShippingID		=	$BasketItemsLines["ShippingID"];
                    $BasketItemAmount		=	$BasketItemsLines["ItemAmount"];
                    $BasketPayment		    =	$BasketItemsLines["Payment"];
                    $BasketInstallment		=	$BasketItemsLines["Installment"];


                    $ItemAboutQuery			=	$DatabaseConnect->prepare("SELECT * FROM items WHERE id = ? LIMIT 1");
                    $ItemAboutQuery->execute([$BasketItemID]);
                    $ItemRecords					=	$ItemAboutQuery->fetch(PDO::FETCH_ASSOC);

                    $ItemType				=	$ItemRecords["ItemType"];
                    $ItemName				=	$ItemRecords["ItemName"];
                    $ItemPrice		    	=	$ItemRecords["ItemPrice"];
                    $ItemCurrency	    	=	$ItemRecords["Currency"];
                    $ItemShippingPrice		=	$ItemRecords["ShippingPrice"];
                    $ItemPic    			=	$ItemRecords["ItemPicOne"];
                    $ItemVariantTitle	    =	$ItemRecords["VariantTitle"];

                    $ItemVariantQuery	=	$DatabaseConnect->prepare("SELECT * FROM itemsvariants WHERE id = ? LIMIT 1");
                    $ItemVariantQuery->execute([$BasketItemVariantID]);
                    $VariantinfoRecords					=	$ItemVariantQuery->fetch(PDO::FETCH_ASSOC);
                    $ItemVariantName			=	$VariantinfoRecords["VariantName"];

                    $ShippingQuery		=	$DatabaseConnect->prepare("SELECT * FROM cargocompanies");
                    $ShippingQuery->execute();
                    $ShippingRecords		=	$ShippingQuery->fetchAll(PDO::FETCH_ASSOC);
                    $ShippingName			=	$ShippingRecords["CargoCompanyName"];

                    $AddressQuery = $DatabaseConnect->prepare("SELECT * FROM addresses WHERE UserID = ? ORDER BY id DESC");
                    $AddressQuery->execute([$UserID]);
                    $AddressRecords = $AddressQuery->fetchAll(PDO::FETCH_ASSOC);

                    $AddressNameSurname		=	$AddressRecords["NameSurname"];
                    $Address				=	$AddressRecords["Address"];
                    $AdresIlce				=	$AddressRecords["District"];
                    $AddressDistrict		=	$AddressRecords["City"];
                    $AddressWrite			=	$Address . " " . $AdresIlce . " " . $AddressDistrict;
                    $AddressPhoneNumber	    =	$AddressRecords["PhoneNumber"];

                    if ($ItemCurrency == "USD") {
                        $ItemPriceChange = $ItemPrice;
                        $ItemPriceChangeFormat = PriceFormat($ItemPriceChange);
                    } elseif ($ItemCurrency == "EUR") {
                        $ItemPriceChange = $ItemPrice * $eurusd;
                        $ItemPriceChangeFormat = PriceFormat($ItemPriceChange);
                    } else {
                        die();
                        /* Another Currencies */
                    }


                    $ItemTotalPrice			=	($ItemPriceChange*$BasketItemAmount);
                    $BasketTotalShippingPriceFormat	=	($ItemShippingPrice*$BasketItemAmount);

                    $AddOrders	=	$DatabaseConnect->prepare("INSERT INTO orders (UserID, OrderNO, ItemID, ItemType, ItemName, ItemPrice , ItemAmount, TotalItemPrice, ShippingChoice, ShippingPrice, ItemPicOne, VariantTitle, VariantChoice, AddressNameSurname, AddressDetail, AddressPhone, Payment, Installment, OrderDate, OrderIPaddress) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $AddOrders->execute([$BasketUserID, $BasketNO, $BasketItemID, $ItemType, $ItemName, $ItemPriceChange , $BasketItemAmount, $ItemTotalPrice, $ShippingName, $BasketTotalShippingPriceFormat, $ItemPic, $ItemVariantTitle, $ItemVariantName, $AddressNameSurname, $AddressWrite, $AddressPhoneNumber, $IncomingPayment, 0, $TimeTamp, $IPAddress]);
                    $Control	=	$AddOrders->rowCount();

                    if($Control>0){
                        $BasketDeleteQuery  =   $DatabaseConnect->prepare("DELETE FROM basket WHERE id = ? AND UserID = ? LIMIT 1");
                        $BasketDeleteQuery->execute([$BasketID, $UserID]);

                        $ItemSalesUpper	=	$DatabaseConnect->prepare("UPDATE items SET SalesAmount=SalesAmount + ? WHERE id = ?");
                        $ItemSalesUpper->execute([$BasketItemAmount, $BasketItemID]);

                        $BasketUpdateQuery  =   $DatabaseConnect->prepare("UPDATE basket SET ItemAmaount= ? WHERE id = ? AND UserID = ? LIMIT 1");
                        $BasketUpdateQuery->execute([$BasketItemAmount, $BasketItemVariantID]);
                    }else{
                        header("Location:index.php?PageCode=95");
                        exit();
                    }
                }

                $OrdersQueryForShipping	=	$DatabaseConnect->prepare("SELECT SUM(TotalItemPrice) AS TotalPrice FROM orders WHERE UserID = ? AND OrderNO = ?");
                $OrdersQueryForShipping->execute([$UserID, $BasketNO]);
                $ShippingPrice		=	$OrdersQueryForShipping->fetch(PDO::FETCH_ASSOC);
                $TotalPrice	=	$ShippingPrice["TotalPrice"];

                if($TotalPrice>=$FreeShipping){
                    $OrderUpdate	=	$DatabaseConnect->prepare("UPDATE orders SET ShippingPrice = ? WHERE UserID = ? AND OrderNO = ?");
                    $OrderUpdate->execute([0, $BasketUserID, $BasketNO]);
                }

                header("Location:index.php?PageCode=94");
                exit();
            }else{
                header("Location:index.php");
                exit();
            }
        }else{
            if($IncomingInstallmentChocie!=""){
                $BasketUpdate		=	$DatabaseConnect->prepare("UPDATE basket SET Payment = ?, Installment = ? WHERE UserID = ?");
                $BasketUpdate->execute([$IncomingPayment, $IncomingInstallmentChocie, $UserID]);
                $BasketControl		=	$BasketUpdate->rowCount();

                if($BasketControl>0){
                    header("Location:index.php?PageCode=96");
                    exit();
                }else{
                    header("Location:index.php");
                    exit();
                }
            }else{
                header("Location:index.php");
                exit();
            }

        }
    }else{
        header("Location:index.php");
        exit();
    }
}else{
    header("Location:index.php");
    exit();
}
?>