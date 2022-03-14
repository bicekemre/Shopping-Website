<?php
if(isset($_SESSION["Admin"])){
    $RightandLeftButtonCountforPagination		=	2;
    $ViewingDataCountinperPage		=	10;
    $Query				=	$DatabaseConnect->prepare("SELECT DISTINCT OrderNO FROM orders WHERE OrderConfirmStatus = ? AND ShippingStatus = ? ORDER BY id DESC");
    $Query->execute([1,1]);
    $Query				=	$Query->rowCount();
    $offset		=	($Pagination*$ViewingDataCountinperPage)-$ViewingDataCountinperPage;
    $PageCount						=	ceil($Query/$ViewingDataCountinperPage);
    ?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFFFFF;" align="left"><h3>&nbsp;ORDERS (COMPLETED)</h3></td>
            <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?PageCodeLog=0&PageCodeA=106" style="color: #FFFFFF; text-decoration: none;">Waiting Orders&nbsp;</a></td>
        </tr>
        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>
        <?php
        $OrderNOQuery		=	$DatabaseConnect->prepare("SELECT DISTINCT OrderNO FROM orders WHERE OrderConfirmStatus = ? AND ShippingStatus = ? ORDER BY id DESC LIMIT $offset, $ViewingDataCountinperPage");
        $OrderNOQuery->execute([1, 1]);
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
                        <td colspan="2" style="border-bottom: 1px dashed #CCCCCC;" valign="top">
                            <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td align="left" width="120"><b>Order Date</b></td>
                                    <td align="left" width="20"><b>:</b></td>
                                    <td align="left" width="225"><?php echo $OrderDate; ?></td>
                                    <td align="left" width="120"><b>Total Price</b></td>
                                    <td align="left" width="20"><b>:</b></td>
                                    <td align="left" width="170"><?php echo PriceFormat($TotalPrice); ?> USD</td>
                                    <td align="left" width="75">
                                        <table width="75" align="right" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="25"><a href="index.php?PageCodeLog=0&PageCodeA=109&OrderNo=<?php echo FiltersDecode($OrderNOLines["OrderNO"]); ?>"><img src="../Images/DokumanKirmiziKalemli20x20.png" border="0" style="margin-top: 5px;"></a></td>
                                                <td width="50"><a href="index.php?PageCodeLog=0&PageCodeA=109&OrderNo=<?php echo FiltersDecode($OrderNOLines["OrderNO"]); ?>" style="color: #0000FF; text-decoration: none;">Details</a></td>
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

    if($PageCount>1){
        ?>
        <tr height="50">
            <td colspan="8" align="center">
                <div class="PaginationArea">
                    <div class="PaginationTextArea">
                        Total Records :<?php echo $PageCount; ?> per page <?php echo $Query; ?>
                    </div>

                    <div class="PaginationNumberArea">
                        <?php
                        if($Pagination>1){
                            echo "<span class='PaginationPasive'><a href='index.php?PageCodeLog=0&PageCodeA=90&Page=1'><<</a></span>";
                            $OneStepBack	=	$Pagination-1;
                            echo "<span class='PaginationPasive'><a href='index.php?PageCodeLog=0&PageCodeA=90&Page=" . $OneStepBack . "'><</a></span>";
                        }

                        for($PageIndexValue=$Pagination-$RightandLeftButtonCountforPagination; $PageIndexValue<=$Pagination+$RightandLeftButtonCountforPagination; $PageIndexValue++){
                            if(($PageIndexValue>0) and ($PageIndexValue<=$PageCount)){
                                if($Pagination==$PageIndexValue){
                                    echo "<span class='PaginationActive'>" . $PageIndexValue . "</span>";
                                }else{
                                    echo "<span class='PaginationPasive'><a href='index.php?PageCodeLog=0&PageCodeA=90&Page=" . $PageIndexValue . "'> " . $PageIndexValue . "</a></span>";
                                }
                            }
                        }

                        if($Pagination!=$PageCount){
                            $OneStepForward	=	$Pagination+1;
                            echo "<span class='PaginationPasive'><a href='index.php?PageCodeLog=0&PageCodeA=90&Page=" . $OneStepForward . "'>></a></span>";
                            echo "<span class='PaginationPasive'><a href='index.php?PageCodeLog=0&PageCodeA=90&Page=" . $PageCount . "'>>></a></span>";
                        }
                        ?>
                    </div>
                        </div>
                    </td>
                </tr>
                <?php
            }
        }else{
            ?>
            <tr>
                <td colspan="2">
                    <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="750">None Orders.</td>
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