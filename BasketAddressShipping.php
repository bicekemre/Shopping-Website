<?php
if (isset($_SESSION["User"])){

    $StockQuery 	=	$DatabaseConnect->prepare("SELECT * FROM basket WHERE UserID = ?");
    $StockQuery->execute([$UserID]);
    $StockCount		=	$StockQuery->rowCount();
    $StockRecords	=	$StockQuery->fetchAll(PDO::FETCH_ASSOC);

if ($StockCount>0){
    foreach ($StockRecords as $StockLines) {
        $BasketStockID           =   $StockLines["id"];
        $BasketStockVariantID    =   $StockLines["VariantID"];
        $BasketStockItemAmount   =   $StockLines["ItemAmount"];

        $VariantQuery	    =	$DatabaseConnect->prepare("SELECT * FROM itemsvariants WHERE id = ? LIMIT 1");
        $VariantQuery->execute([$BasketStockVariantID]);
        $VariantRecords	    =	$VariantQuery->fetch(PDO::FETCH_ASSOC);
        $StockAmount	    =	$StockLines["ItemAmount"];

        if ($StockAmount==0){
            $BasketDeleteQuery  =   $DatabaseConnect->prepare("DELETE FROM basket WHERE id = ? AND UserID = ? LIMIT 1");
            $BasketDeleteQuery->execute([$BasketStockID, $UserID]);
        }elseif ($BasketStockItemAmount>$StockAmount){
            $BasketUpdateQuery  =   $DatabaseConnect->prepare("UPDATE basket SET UrunAdedi= ? WHERE id = ? AND UserID = ? LIMIT 1");
            $BasketUpdateQuery->execute([$StockAmount,$BasketStockID, $UserID]);
        }
    }
}
?>
<form action="index.php?PageCode=92" method="post">
<table  width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="800" valign="top">
            <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr height="40">
                    <td style="color:darkgoldenrod"><h3>Basket</h3></td>
                </tr>
                <tr height="30">
                    <td colspan="2" valign="top" style="border-bottom: 1px dashed #CCCCCC;">You can choice address and shipping details.</td>
                </tr>
                <tr height="10">
                    <td colspan="2" style="font-size: 10px;">&nbsp;</td>
                </tr>
                <tr height="40">
                    <td align="left" style="background: #CCCCCC; font-weight: bold;">&nbsp;Address Choice</td>
                    <td align="right" style="background: #CCCCCC; font-weight: bold;"><a href="index.php?SK=70" style="color: #646464; text-decoration: none; font-weight: bold;">+ Add Address&nbsp;</a></td>
                </tr>
                <?php
                $BasketItemsQuery	=	$DatabaseConnect->prepare("SELECT * FROM basket WHERE UserID = ? ORDER BY id DESC");
                $BasketItemsQuery->execute([$UserID]);
                $BasketItemsCount		=	$BasketItemsQuery->rowCount();
                $BasketItemsRecords		=	$BasketItemsQuery->fetchAll(PDO::FETCH_ASSOC);

                if ($BasketItemsCount>0) {
                    $BasketTotalItems = 0;
                    $BasketTotalPrice = 0;
                    $BasketTotalShippingPrice = 0;
                    $BasketTotalShippingPriceFormat = 0;

                    foreach ($BasketItemsRecords as $BasketItemsLines) {
                        $BasketID = $BasketItemsLines["id"];
                        $BasketItemID = $BasketItemsLines["ItemID"];
                        $BasketItemVariantID = $BasketItemsLines["VariantID"];
                        $BasketItemAmount = $BasketItemsLines["ItemAmount"];

                        $ItemAboutQuery = $DatabaseConnect->prepare("SELECT * FROM items WHERE id = ? LIMIT 1");
                        $ItemAboutQuery->execute([$BasketItemID]);
                        $ItemRecords = $ItemAboutQuery->fetch(PDO::FETCH_ASSOC);

                        $ItemPrice = $ItemRecords["ItemPrice"];
                        $ItemCurrency = $ItemRecords["Currency"];
                        $ItemShippingPrice = $ItemRecords["ShippingPrice"];

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

                        $ItemTotalPrice = ($ItemPriceChange * $BasketItemAmount);
                        $ItemTotalPriceFormat = PriceFormat($ItemTotalPrice);

                        $BasketTotalItems += $BasketItemAmount;
                        $BasketTotalPrice += ($ItemPriceChange * $BasketItemAmount);

                        $BasketTotalShippingPriceFormat += ($ItemShippingPrice * $BasketItemAmount);
                        $BasketTotalShippingPriceFormatCreate = PriceFormat($BasketTotalShippingPriceFormat);
                    }
                    if ($BasketTotalPrice >= $FreeShipping) {
                        $BasketTotalShippingPriceFormat = 0;
                        $SepettekiToplamKargoFiyatiBicimlendir = PriceFormat($BasketTotalShippingPriceFormat);

                        $FinalPrice = PriceFormat($BasketTotalPrice);
                    } else {
                        $FinalPriceProces = ($BasketTotalPrice + $BasketTotalShippingPriceFormat);
                        $FinalPrice = PriceFormat($FinalPriceProces);
                    }

                    $AddressQuery = $DatabaseConnect->prepare("SELECT * FROM addresses WHERE UserID = ? ORDER BY id DESC");
                    $AddressQuery->execute([$UserID]);
                    $AddressCount = $AddressQuery->rowCount();
                    $AddressRecords = $AddressQuery->fetchAll(PDO::FETCH_ASSOC);

                    if ($AddressCount > 0) {
                        foreach ($AddressRecords as $AddressLines) {
                    ?>
                    <tr>
                        <td colspan="2" align="left">
                            <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr height="50">
                                    <td width="25" style="border-bottom: 1px dashed #CCCCCC;" align="left"><input type="radio" name="AddressChocie" checked="checked" value="<?php echo FiltersDecode($AddressLines["id"]); ?>"></td>
                                    <td width="775" style="border-bottom: 1px dashed #CCCCCC;" align="left"><?php echo FiltersDecode($AddressLines["NameSurname"]); ?> - <?php echo FiltersDecode($AddressLines["Address"]); ?> <?php echo FiltersDecode($AddressLines["District"]); ?> / <?php echo FiltersDecode($AddressLines["City"]); ?> - <?php echo FiltersDecode($AddressLines["PhoneNumber"]); ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php
						}
					}else{
					?>
                    <tr height="50">
                        <td colspan="2" align="left">Please Add Address <a href="index.php?PageCode=70" style="color: #646464; text-decoration: none; font-weight: bold;">Click Here</a>.</td>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr height="10">
                        <td colspan="2" style="font-size: 10px;">&nbsp;</td>
                    </tr>
                    <tr height="40">
                        <td colspan="2" align="left" style="background: #CCCCCC; font-weight: bold;">&nbsp;Shipping Chocie</td>
                    </tr>
                    <tr height="10">
                        <td colspan="2" style="font-size: 10px;">&nbsp;</td>
                    </tr>
                    <tr height="40">
                        <td colspan="2" align="left">
                            <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                <?php
                                $ShippingQuery		=	$DatabaseConnect->prepare("SELECT * FROM cargocompanies");
                                $ShippingQuery->execute();
                                $ShippingCount			=	$ShippingQuery->rowCount();
                                $ShippingRecords		=	$ShippingQuery->fetchAll(PDO::FETCH_ASSOC);

                                $LoopCount		=	1;
                                $Column		    =	3;
                                $ChoiceNumber	=	1;

                                foreach($ShippingRecords as $shippingRecord){
                                ?>
                                    <td width="260">
                                        <table width="260" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr height="40">
                                                <td align="center"><img src="Images/<?php echo FiltersDecode($shippingRecord["CargoLogo"]); ?>" border="0"></td>
                                            </tr>
                                            <tr>
                                                <td align="center"><input type="radio" name="ShippingChoice" <?php if($ChoiceNumber==1){ ?>checked="checked" <?php } ?> value="<?php echo FiltersDecode($shippingRecord["id"]); ?>"></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <?php
                                    $ChoiceNumber++;

                                    if($LoopCount<$Column){
                                        ?>
                                        <td width="10">&nbsp;</td>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    $LoopCount++;

                                    if($LoopCount>$Column){
                                        echo "</tr><tr>";
                                        $LoopCount	=	1;
                                    }
                                }
                                ?>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php
                    }else{
                        header("Location:index.php?PageCode=87");
                        exit();
                    }
                    ?>
                </table>
			</td>

            <td width="15">&nbsp;</td>

            <td width="250" valign="top"><table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr height="40">
                    <td  style="color:darkgoldenrod" align="right"><h3>Order Summary</h3></td>
                </tr>
                <tr height="30">
                    <td valign="top" style="border-bottom: 1px dashed #CCCCCC;" align="right">Total Items :<b style="color: black;"><?php echo $BasketTotalItems; ?></b></td>
                </tr>
                <tr height="5">
                    <td height="5" style="font-size: 5px;">&nbsp;</td>
                </tr>
                <tr>
                    <td align="right">Price</td>
                </tr>
                <tr>
                    <td align="right" style="font-size: 25px; font-weight: bold;"><?php echo $FinalPrice; ?> USD</td>
                </tr>
                <tr height="10">
                    <td style="font-size: 10px;">&nbsp;</td>
                </tr>
                <tr>
                    <td align="right">Items Total Price</td>
                </tr>
                <tr>
                    <td align="right" style="font-size: 25px; font-weight: bold;"><?php echo PriceFormat($BasketTotalPrice); ?> USD</td>
                </tr>
                <tr height="10">
                    <td style="font-size: 10px;">&nbsp;</td>
                </tr>
                <tr>
                    <td align="right">Shipping Price</td>
                </tr>
                <tr>
                    <td align="right" style="font-size: 25px; font-weight: bold;"><?php echo $BasketTotalShippingPriceFormatCreate; ?> USD</td>
                </tr>
                <tr height="10">
                    <td style="font-size: 10px;">&nbsp;</td>
                </tr>
                <tr>
                    <td align="right"><input type="submit" value="Payment" class="PaymentButton"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</form>
    <?php
}else{
    header("Location:index.php");
    exit();
}
?>