<?php
if (isset($_SESSION["User"])){
    if (isset($_POST["AddressChocie"])){
        $IncomingAddressChoice  =   Safety($_POST["AddressChocie"]);
    }else{
        $IncomingAddressChoice  =   "";
    }
    if (isset($_POST["ShippingChoice"])){
        $IncomingShippingChoice =   Safety($_POST["ShippingChoice"]);
    }else{
        $IncomingShippingChoice  =   "";
    }

    if(($IncomingAddressChoice!="") and ($IncomingShippingChoice!="")){

        $BasketUpdateQuery  =   $DatabaseConnect->prepare("UPDATE basket SET 	ShippingID = ?, AddressID = ? WHERE UserID = ?");
        $BasketUpdateQuery->execute([$IncomingShippingChoice,$IncomingAddressChoice, $UserID]);
        $BasketUpdateCount	=	$BasketUpdateQuery->rowCount();

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

            $TwoInstallmentPerMounth = number_format(($BasketTotalPrice / 2), "2", ",", ".");
            $ThreeInstallmentPerMounth = number_format(($BasketTotalPrice / 3), "2", ",", ".");
            $FourInstallmentPerMounth = number_format(($BasketTotalPrice / 4), "2", ",", ".");
            $FiveInstallmentPerMounth = number_format(($BasketTotalPrice / 5), "2", ",", ".");
            $SixInstallmentPerMounth = number_format(($BasketTotalPrice / 6), "2", ",", ".");
            $SevenInstallmentPerMounth = number_format(($BasketTotalPrice / 7), "2", ",", ".");
            $EightInstallmentPerMounth = number_format(($BasketTotalPrice / 8), "2", ",", ".");
            $NineInstallmentPerMounth = number_format(($BasketTotalPrice / 9), "2", ",", ".");
        }
?>
<form action="index.php?PageCode=93" method="post">
    <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="800" valign="top">
                <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td style="color:darkgoldenrod"><h3>Basket</h3></td>
                    </tr>
                    <tr height="30">
                        <td valign="top" style="border-bottom: 1px dashed #CCCCCC;">You can choice the payment.</td>
                    </tr>
                    <tr height="10">
                        <td style="font-size: 10px;">&nbsp;</td>
                    </tr>
                    <tr height="40">
                        <td align="left" style="background: #CCCCCC; font-weight: bold;">&nbsp;Payment</td>
                    </tr>
                    <tr height="10">
                        <td style="font-size: 10px;">&nbsp;</td>
                    </tr>

                    <tr>
                        <td align="left">
                            <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="390" align="left"><table width="400" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td align="center"><img src="Images/KrediKarti92x75.png" border="0"></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td align="center"><input type="radio" name="Payment" value="Credit Card" checked="checked" onClick="$.CreditCard();"></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </table></td>

                                    <td width="20">&nbsp;</td>

                                    <td width="390" align="left"><table width="400" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td align="center"><img src="Images/Banka80x75.png" border="0"></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td align="center"><input type="radio" name="Payment" value="Money Transfer" onClick="$.MoneyTransfer();"></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </table></td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr height="10">
                        <td style="font-size: 10px;">&nbsp;</td>
                    </tr>

                    <tr height="40" class="CCArea">
                        <td height="40" width="800" align="left" bgcolor="#CCCCCC"><b>&nbsp;Credit  Card</b></td>
                    </tr>
                    <tr height="10" class="CCArea">
                        <td style="font-size: 10px;">&nbsp;</td>
                    </tr>
                    <tr height="40" class="CCArea">
                        <td height="40" width="800" align="left">You can pay us these banks</td>
                    </tr>
                    <tr height="10" class="CCArea">
                        <td style="font-size: 10px;">&nbsp;</td>
                    </tr>
                    <tr class="CCArea">
                        <td><table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="192"><table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td align="center"><img src="Images/OdemeSecimiAxessCard.png" border="0"></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </table></td>
                                    <td width="11">&nbsp;</td>
                                    <td width="192"><table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td align="center"><img src="Images/OdemeSecimiBonusCard.png" border="0"></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </table></td>
                                    <td width="11">&nbsp;</td>
                                    <td width="192"><table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td align="center"><img src="Images/OdemeSecimiCardFinans.png" border="0"></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </table></td>
                                    <td width="10">&nbsp;</td>
                                    <td width="192"><table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td align="center"><img src="Images/OdemeSecimiMaximumCard.png" border="0"></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </table></td>
                                </tr>
                                <tr>
                                    <td width="192"><table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td align="center"><img src="Images/OdemeSecimiWorldCard.png" border="0"></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </table></td>
                                    <td width="11">&nbsp;</td>
                                    <td width="192"><table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td align="center"><img src="Images/OdemeSecimiParafCard.png" border="0"></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </table></td>
                                    <td width="11">&nbsp;</td>
                                    <td width="192"><table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td align="center"><img src="Images/OdemeSecimiDigerKartlar.png" border="0"></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </table></td>
                                    <td width="10">&nbsp;</td>
                                    <td width="192"><table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td align="center"><img src="Images/OdemeSecimiATMKarti.png" border="0"></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </table></td>
                                </tr>
                            </table></td>
                    </tr>

                    <tr height="40" class="CCArea">
                        <td height="40" width="800" align="left" bgcolor="#CCCCCC"><b>&nbsp;Installment Chocie</b></td>
                    </tr>
                    <tr height="10" class="CCArea">
                        <td style="font-size: 10px;">&nbsp;</td>
                    </tr>
                    <tr height="40" class="CCArea">
                        <td height="40" width="800" align="left">Please Chocie Installment.</td>
                    </tr>
                    <tr height="30" class="CCArea">
                        <td><table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td width="25" align="left" style="border-bottom: 1px dashed #CCCCCC;"><input type="radio" name="InstallmentChocie" value="1" checked="checked"></td>
                                    <td width="375" align="left" style="border-bottom: 1px dashed #CCCCCC;">none installment</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;">1 x <?php echo $FinalPrice; ?> USD</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;"><?php echo $FinalPrice; ?> USD</td>
                                </tr>
                            </table></td>
                    </tr>
                    <tr height="30" class="CCArea">
                        <td><table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td width="25" align="left" style="border-bottom: 1px dashed #CCCCCC;"><input type="radio" name="InstallmentChocie" value="2"></td>
                                    <td width="375" align="left" style="border-bottom: 1px dashed #CCCCCC;">2 installment</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;">2 x <?php echo $TwoInstallmentPerMounth; ?> USD</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;"><?php echo $FinalPrice; ?> USD</td>
                                </tr>
                            </table></td>
                    </tr>
                    <tr height="30" class="CCArea">
                        <td><table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td width="25" align="left" style="border-bottom: 1px dashed #CCCCCC;"><input type="radio" name="InstallmentChocie" value="3"></td>
                                    <td width="375" align="left" style="border-bottom: 1px dashed #CCCCCC;">3 installment</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;">3 x <?php echo $ThreeInstallmentPerMounth; ?> USD</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;"><?php echo $FinalPrice; ?> USD</td>
                                </tr>
                            </table></td>
                    </tr>
                    <tr height="30" class="CCArea">
                        <td><table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td width="25" align="left" style="border-bottom: 1px dashed #CCCCCC;"><input type="radio" name="InstallmentChocie" value="4"></td>
                                    <td width="375" align="left" style="border-bottom: 1px dashed #CCCCCC;">4 installment</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;">4 x <?php echo $FourInstallmentPerMounth; ?> USD</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;"><?php echo $FinalPrice; ?> USD</td>
                                </tr>
                            </table></td>
                    </tr>
                    <tr height="30" class="CCArea">
                        <td><table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td width="25" align="left" style="border-bottom: 1px dashed #CCCCCC;"><input type="radio" name="InstallmentChocie" value="5"></td>
                                    <td width="375" align="left" style="border-bottom: 1px dashed #CCCCCC;">5 installment</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;">5 x <?php echo $FiveInstallmentPerMounth; ?> USD</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;"><?php echo $FinalPrice; ?> USD</td>
                                </tr>
                            </table></td>
                    </tr>
                    <tr height="30" class="CCArea">
                        <td><table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td width="25" align="left" style="border-bottom: 1px dashed #CCCCCC;"><input type="radio" name="InstallmentChocie" value="6"></td>
                                    <td width="375" align="left" style="border-bottom: 1px dashed #CCCCCC;">6 installment</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;">6 x <?php echo $SixInstallmentPerMounth; ?> USD</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;"><?php echo $FinalPrice; ?> USD</td>
                                </tr>
                            </table></td>
                    </tr>
                    <tr height="30" class="CCArea">
                        <td><table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td width="25" align="left" style="border-bottom: 1px dashed #CCCCCC;"><input type="radio" name="InstallmentChocie" value="7"></td>
                                    <td width="375" align="left" style="border-bottom: 1px dashed #CCCCCC;">7 installment</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;">7 x <?php echo $SevenInstallmentPerMounth; ?> USD</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;"><?php echo $FinalPrice; ?> USD</td>
                                </tr>
                            </table></td>
                    </tr>
                    <tr height="30" class="CCArea">
                        <td><table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td width="25" align="left" style="border-bottom: 1px dashed #CCCCCC;"><input type="radio" name="InstallmentChocie" value="8"></td>
                                    <td width="375" align="left" style="border-bottom: 1px dashed #CCCCCC;">8 installment</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;">8 x <?php echo $EightInstallmentPerMounth; ?> USD</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;"><?php echo $FinalPrice; ?> USD</td>
                                </tr>
                            </table></td>
                    </tr>
                    <tr height="30" class="CCArea">
                        <td><table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td width="25" align="left" style="border-bottom: 1px dashed #CCCCCC;"><input type="radio" name="InstallmentChocie" value="9"></td>
                                    <td width="375" align="left" style="border-bottom: 1px dashed #CCCCCC;">9 installment</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;">9 x <?php echo $NineInstallmentPerMounth; ?> USD</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;"><?php echo $FinalPrice; ?> USD</td>
                                </tr>
                            </table></td>
                    </tr>

                    <tr height="40" class="MTArea" style="display: none;">
                        <td height="40" width="800" align="left" bgcolor="#CCCCCC"><b>&nbsp;Money Transfer</b></td>
                    </tr>
                    <tr height="10" class="MTArea" style="display: none;">
                        <td style="font-size: 10px;">&nbsp;</td>
                    </tr>
                    <tr height="40" class="MTArea" style="display: none;">
                        <td height="40" width="800" align="left">Money Tranfer Informations</td>
                    </tr>
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
}else{
    header("Location:index.php");
    exit();
}
?>