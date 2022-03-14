<?php
if(isset($_SESSION["Admin"])){
    ?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFFFFF;" align="left"><h3>&nbsp;ORDERS (Waiting)</h3></td>
            <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?PageCodeLog=0&PageCodeA=108" style="color: #FFFFFF; text-decoration: none;">Completed Orders&nbsp;</a></td>
        </tr>
        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>
        <?php
        $OrderNOQuery		=	$DatabaseConnect->prepare("SELECT DISTINCT OrderNO FROM orders WHERE OrderConfirmStatus = ? AND ShippingStatus = ? ORDER BY id ASC");
        $OrderNOQuery->execute([0, 0]);
        $OrderNOCount		=	$OrderNOQuery->rowCount();
        $OrderNORecords		=	$OrderNOQuery->fetchAll(PDO::FETCH_ASSOC);

        if($OrderNOCount>0){
            foreach($OrderNORecords as $OrderNOLines){
                $ordersQuery	=	$DatabaseConnect->prepare("SELECT * FROM orders WHERE OrderNO = ? AND OrderConfirmStatus = ? AND ShippingStatus = ?");
                $ordersQuery->execute([$OrderNOLines["OrderNO"], 0, 0]);
                $OrderCount		=	$ordersQuery->rowCount();
                $OrderRecords	=	$ordersQuery->fetchAll(PDO::FETCH_ASSOC);

                if($OrderCount>0){
                    $TotalPrice		=	0;
                    foreach($OrderRecords as $orders){
                        $OrderDate			=	 DateFilter($orders["OrderDate"]);
                        $TotalItemPrice		=	$orders["TotalItemPrice"];

                        $TotalPrice			+=	$TotalItemPrice;
                    }
                    ?>
                    <tr>
                        <td colspan="2" style="border-bottom: 1px dashed #CCCCCC;" valign="top"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td align="left" width="120"><b>Order Date</b></td>
                                    <td align="left" width="20"><b>:</b></td>
                                    <td align="left" width="200"><?php echo $OrderDate; ?></td>
                                    <td align="left" width="120"><b>$Total Price</b></td>
                                    <td align="left" width="20"><b>:</b></td>
                                    <td align="left" width="140"><?php echo PriceFormat($TotalPrice); ?> USD</td>
                                    <td align="left" width="130">
                                        <table width="130" align="right" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="25"><a href="index.php?PageCodeLog=0&PageCodeA=113&OrderNo=<?php echo FiltersDecode($OrderNOLines["OrderNO"]); ?>"><img src="../Images/Sil20x20.png" border="0" style="margin-top: 5px;"></a></td>
                                                <td width="30"><a href="index.php?PageCodeLog=0&PageCodeA=113&OrderNo=<?php echo FiltersDecode($OrderNOLines["OrderNO"]); ?>" style="color: #FF0000; text-decoration: none;">Delete</a></td>
                                                <td width="25"><a href="index.php?PageCodeLog=0&PageCodeA=107&OrderNo=<?php echo FiltersDecode($OrderNOLines["OrderNO"]); ?>"><img src="../Images/DokumanKirmiziKalemli20x20.png" border="0" style="margin-top: 5px;"></a></td>
                                                <td width="50"><a href="index.php?PageCodeLog=0&PageCodeA=107&OrderNo=<?php echo FiltersDecode($OrderNOLines["OrderNO"]); ?>" style="color: #0000FF; text-decoration: none;">Detail</a></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php

                }else{
                    header("Location:index.php?PageCodeLog=0&PageCodeA=0");
                    exit();
                }
            }
        }else{
            ?>
            <tr>
                <td colspan="2">
                    <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="750">None Order.</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>