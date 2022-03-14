<?php
if(isset($_SESSION["Admin"])){
    if(isset($_GET["OrderNo"])){
        $IncomingOrderNO			=	Safety($_GET["OrderNo"]);
    }else{
        $IncomingOrderNO			=	"";
    }
    ?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFFFFF;" align="left"><h3>&nbsp;ORDER DETAILS</h3></td>
            <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?PageCodeLog=0&PageCodeA=106" style="color: #FFFFFF; text-decoration: none;">ORDERS (Completed)&nbsp;</a></td>
        </tr>
        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>
        <?php
        $ordersQuery	=	$DatabaseConnect->prepare("SELECT * FROM orders WHERE OrderNO = ?");
        $ordersQuery->execute([$IncomingOrderNO]);
        $OrderCount		=	$ordersQuery->rowCount();
        $OrderRecords	=	$ordersQuery->fetchAll(PDO::FETCH_ASSOC);

        if($OrderCount>0){
            $LoopsCount =   0;

            foreach ($OrderRecords as $records){

                if($records["ItemType"] == "Phone"){
                    $PicturePath	=	"Phone";
                }elseif($records["ItemType"] == "Computer"){
                    $PicturePath	=	"Computer";
                }elseif($records["ItemType"] == ""){
                    //another ıtem types
                    die();
                }
                ?>
                <tr>
                    <td colspan="2" style="border-bottom: 1px dashed #CCCCCC;" valign="top"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                            <?php
                            if($LoopsCount==0){
                                ?>
                                <tr>
                                    <td colspan="3">
                                        <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="100"><b>Name Surname</b></td>
                                                <td width="10"><b>:</b></td>
                                                <td width="540"><?php echo FiltersDecode($records["AddressNameSurname"]); ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="100"><b>Phone</b></td>
                                                <td width="10"><b>:</b></td>
                                                <td width="540"><?php echo FiltersDecode($records["AddressPhone"]); ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="100"><b>Address</b></td>
                                                <td width="10"><b>:</b></td>
                                                <td width="540"><?php echo FiltersDecode($records["AddressDetail"]); ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">&nbsp;</td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr>
                                <td width="60" valign="top"><img src="../Images/ItemPictures/<?php echo $PicturePath; ?>/<?php echo FiltersDecode($records["ItemPicOne"]); ?>" border="0" width="60" height="80"></td>
                                <td width="10">&nbsp;</td>
                                <td width="680" valign="top">
                                    <table width="680" align="right" border="0" cellpadding="0" cellspacing="0">
                                        <tr height="25">
                                            <td width="680">
                                                <table width="680" align="right" border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="450" align="left"><?php echo FiltersDecode($records["ItemName"]); ?></td>
                                                        <td width="230" align="right"><?php echo FiltersDecode($records["VariantTitle"]); ?> : <?php echo FiltersDecode($records["VariantChoice"]); ?></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr height="25">
                                            <td width="680">
                                                <table width="680" align="right" border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="50"><b>Price</b></td>
                                                        <td width="10"><b>:</b></td>
                                                        <td width="138"><?php echo PriceFormat(FiltersDecode($records["ItemPrice"])); ?> TL</td>
                                                        <td width="50"><b>Amount</b></td>
                                                        <td width="10"><b>:</b></td>
                                                        <td width="50"><?php echo FiltersDecode($records["ItemAmount"]); ?></td>
                                                        <td width="115"><b>Total Item Price</b></td>
                                                        <td width="10"><b>:</b></td>
                                                        <td width="125"><?php echo PriceFormat(FiltersDecode($records["TotalItemPrice"])); ?> TL</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr height="25">
                                            <td width="680">
                                                <table width="680" align="right" border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="50"><b>Payment</b></td>
                                                        <td width="10"><b>:</b></td>
                                                        <td width="135"><?php echo FiltersDecode($records["Payment"]); ?></td>
                                                        <td width="50"><b>Installment</b></td>
                                                        <td width="10"><b>:</b></td>
                                                        <td width="50"><?php echo FiltersDecode($records["Installment"]); ?></td>
                                                        <td width="65"><b>Shipping</b></td>
                                                        <td width="10"><b>:</b></td>
                                                        <td width="125"><?php echo FiltersDecode($records["ShippingChoice"]); ?></td>
                                                        <td width="105"><b>Shipping Price</b></td>
                                                        <td width="10"><b>:</b></td>
                                                        <td width="65"><?php echo PriceFormat(FiltersDecode($records["ShippingPrice"])); ?> TL</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php
                $LoopsCount++;
            }
        }else{
            header("Location:index.php?PageCodeLog=0&PageCodeA=0");
            exit();
        }
        ?>
    </table>
    <?php
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>
