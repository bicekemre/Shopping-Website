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

$BasketResetQuery  =   $DatabaseConnect->prepare("UPDATE basket SET AddressID= ?, ShippingID = ?, Payment = ?, Installment = ? WHERE UserID = ?");
$BasketResetQuery->execute([0, 0, "", 0, $UserID]);
?>
<table  width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="800" valign="top">
            <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr height="40">
                    <td style="color:darkgoldenrod"><h3>Basket</h3></td>
                </tr>
                <tr height="30">
                    <td valign="top" style="border-bottom: 1px dashed #CCCCCC;">Your Basket.</td>
                </tr>
                <?php
                $BasketItemsQuery	=	$DatabaseConnect->prepare("SELECT * FROM basket WHERE UserID = ? ORDER BY id DESC");
                $BasketItemsQuery->execute([$UserID]);
                $BasketItemsCount		=	$BasketItemsQuery->rowCount();
                $BasketItemsRecords		=	$BasketItemsQuery->fetchAll(PDO::FETCH_ASSOC);

                if ($BasketItemsCount>0){
                    $BasketTotalItems   =0;
                    $BasketTotalPrice    =0;



                    foreach ($BasketItemsRecords as $BasketItemsLines) {
                        $BasketID               =   $BasketItemsLines["id"];
                        $BasketItemID           =   $BasketItemsLines["ItemID"];
                        $BasketItemVariantID    =   $BasketItemsLines["VariantID"];
                        $BasketItemAmount       =   $BasketItemsLines["ItemAmount"];

                        $ItemAboutQuery		=	$DatabaseConnect->prepare("SELECT * FROM items WHERE id = ? LIMIT 1");
                        $ItemAboutQuery->execute([$BasketItemID]);
                        $ItemRecords		=	$ItemAboutQuery->fetch(PDO::FETCH_ASSOC);
                            $ItemType           = $ItemRecords["ItemType"];
                            $ItemPic            = $ItemRecords["ItemPicOne"];
                            $ItemName           = $ItemRecords["ItemName"];
                            $ItemPrice          = $ItemRecords["ItemPrice"];
                            $ItemCurrency       = $ItemRecords["Currency"];
                            $ItemVariantTitle   = $ItemRecords["VariantTitle"];

                        $ItemVariantQuery	=	$DatabaseConnect->prepare("SELECT * FROM itemsvariants WHERE id = ? LIMIT 1");
                        $ItemVariantQuery->execute([$BasketItemVariantID]);
                        $VariantinfoRecords	=	$ItemVariantQuery->fetch(PDO::FETCH_ASSOC);

                            $ItemVariantName    =   $VariantinfoRecords["VariantName"];
                            $ItemStock          =   $VariantinfoRecords["StockNumber"];

                        if ($ItemType=="Phone"){
                            $PicturePath    =   "Phone";
                        }elseif($ItemType=="Computer"){
                            $PicturePath    =   "Computer";
                        }

                        if($ItemCurrency=="EUR"){
                            $ItemPriceChange				=	$ItemPrice*$eurusd;
                            $ItemPriceChangeFormat			=	PriceFormat($ItemPriceChange);
                        }elseif($ItemCurrency=="USD"){
                            $ItemPriceChange				=	$ItemPrice;
                            $ItemPriceChangeFormat			=	PriceFormat($ItemPriceChange);
                        }else{
                            die();
                           /* Another Currencies */
                        }

                        $ItemTotalPrice		    =	($ItemPriceChange*$BasketItemAmount);
                        $ItemTotalPriceFormat	=	PriceFormat($ItemTotalPrice);

                        $BasketTotalItems		    +=	$BasketItemAmount;
                        $BasketTotalPrice			+=	($ItemPriceChange*$BasketItemAmount);
                ?>
                <tr height="100">
					<td valign="bottom" align="left">
                        <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="80" style="border-bottom: 1px dashed #CCCCCC;" align="left"><img src="Images/ItemPictures/<?php echo $PicturePath; ?>/<?php echo FiltersDecode($ItemPic); ?>" border="0" width="60" height="80"></td>
                                <td width="40" style="border-bottom: 1px dashed #CCCCCC;" align="left"><a href="index.php?PageCode=88&ID=<?php echo FiltersDecode($BasketID); ?>"><img src="Images/SilDaireli20x20.png" border="0"></a></td>
                                <td width="530" style="border-bottom: 1px dashed #CCCCCC;" align="left"><?php echo FiltersDecode($ItemName); ?><br /><?php echo FiltersDecode($ItemVariantTitle); ?> : <?php echo FiltersDecode($ItemVariantTitle); ?></td>
                                <td width="90" style="border-bottom: 1px dashed #CCCCCC;" align="left">
                                    <table width="90" align="center" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="30" align="center"><?php if($BasketItemAmount>1){ ?><a href="index.php?PageCode=89&ID=<?php echo FiltersDecode($BasketID); ?>" style="text-decoration: none; color: #646464;"><img src="Images/AzaltDaireli20x20.png" border="0" style="margin-top: 5px;"></a><?php }else{ ?>&nbsp;<?php } ?></td>
                                            <td width="30" align="center" style="line-height: 20px;"><?php echo FiltersDecode($BasketItemAmount); ?></td>
                                            <td width="30" align="center"><a href="index.php?PageCode=90&ID=<?php echo FiltersDecode($BasketID); ?>"><img src="Images/ArttirDaireli20x20.png" border="0" style="margin-top: 5px;"></a></td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="150" style="border-bottom: 1px dashed #CCCCCC;" align="right"><?php echo $ItemPriceChangeFormat; ?> USD<br /><?php echo $ItemTotalPriceFormat; ?> USD</td>
                            </tr>
                        </table>
					</td>
                </tr>
                <?php
                    }
                }else{
                    $BasketTotalItems      =   0;
                    $BasketTotalPrice       =   0;
                ?>
                <tr height="30">
					<td valign="bottom" align="left">None Item.</td>
				</tr>
                <?php
                }
                ?>
            </table>
        </td>

        <td width="15">&nbsp;</td>

        <td width="250" valign="top">
            <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr height="40">
                    <td  style="color:darkgoldenrod" align="right"><h3>Order Summary</h3></td>
                </tr>
                <tr height="30">
                    <td valign="top" style="border-bottom: 1px dashed #CCCCCC;" align="right">Your Item Quantity : <b style="color: black;"><?php echo $BasketTotalItems; ?></b></td>
                </tr>
                <tr height="5">
                    <td height="5" style="font-size: 5px;">&nbsp;</td>
                </tr>
                <tr>
                    <td align="right">Paid Your Item</td>
                </tr>
                <tr>
                    <td align="right" style="font-size: 25px; font-weight: bold;"><?php echo PriceFormat($BasketTotalPrice); ?> USD</td>
                </tr>
                <tr height="10">
                    <td style="font-size: 10px;">&nbsp;</td>
                </tr>
                <tr>
                    <td align="right"><div class="CompletedShopButton"><a href="index.php?PageCode=91"><img src="Images/SepetBeyaz21x20.png" border="0"> <div>GO ON</div></a></div></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?php
}else{
    header("Location:index.php");
    exit();
}
?>
