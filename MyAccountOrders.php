<?php
if ($_SESSION["User"]){

    $RightandLeftButtonCountforPagination		=	2;
    $ViewingDataCountinperPage		            =	10;
    $Query				                        =	$DatabaseConnect->prepare("SELECT DISTINCT OrderNO FROM orders WHERE UserID = ? ORDER BY OrderNO DESC");
    $Query->execute([$UserID]);
    $Query				                        =	$Query->rowCount();
    $offset		                                =	($Pagination*$ViewingDataCountinperPage)-$ViewingDataCountinperPage;
    $PageCount					                =	ceil($Query/$ViewingDataCountinperPage);
    ?>
    <table width="1065" bgcolor="#f0e68c" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="3"><hr /></td>
        </tr>
        <tr>
            <td colspan="3"><table width="1065"  align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="203" bgcolor="#b8860b" style="border: 1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?PageCode=45" style="text-decoration: none; color: black;">Account Information</a></td>
                        <td width="10">&nbsp;</td>
                        <td width="203"  bgcolor="#b8860b" style="border: 1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?PageCode=53" style="text-decoration: none; color: black;">Address</a></td>
                        <td width="10">&nbsp;</td>
                        <td width="203"  bgcolor="#b8860b" style="border: 1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?PageCode=54" style="text-decoration: none; color: black;">Favorites</a></td>
                        <td width="10">&nbsp;</td>
                        <td width="203"  bgcolor="#b8860b" style="border: 1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?PageCode=55" style="text-decoration: none; color: black;">Comments</a></td>
                        <td width="10">&nbsp;</td>
                        <td width="203"  bgcolor="#b8860b" style="border: 1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?PageCode=56" style="text-decoration: none; color: black;">Orders</a></td>
                    </tr>
                </table></td>
        </tr>
        <tr>
            <td colspan="3"><hr /></td>
        </tr>
        <tr>
            <td width="500" valign="top">
        <tr align="center" height="40">
            <td style="color:black"><h3>My Account > Orders</h3></td>
        </tr>
        <tr height="30">
            <td valign="top" align="center" style="border-bottom: 1px dashed #CCCCCC;">You Can see your orders.</td>
        </tr>
                <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="50">
                        <td width="125" style="background: #f8ffa7; color: black;" align="left">&nbsp;Order No</td>
                        <td width="75" style="background: #f8ffa7; color: black;" align="left">Pictures</td>
                        <td width="80" style="background: #f8ffa7; color: black;" align="left">Comment</td>
                        <td width="415" style="background: #f8ffa7; color: black;" align="left">Item Name</td>
                        <td width="100" style="background: #f8ffa7; color: black;" align="left">Item Price</td>
                        <td width="75" style="background: #f8ffa7; color: black;" align="left">Quantity</td>
                        <td width="110" style="background: #f8ffa7; color: black;" align="left">Total Price</td>
                        <td width="150" style="background: #f8ffa7; color: black;" align="left">Shipping Status</td>
                    </tr>
                    <?php
                    $OrderNOQuery		    =	$DatabaseConnect->prepare("SELECT DISTINCT OrderNO FROM orders WHERE UserID = ? ORDER BY OrderNO DESC LIMIT $offset, $ViewingDataCountinperPage");
                    $OrderNOQuery->execute([$UserID]);
                    $OrderNOCount			=	$OrderNOQuery->rowCount();
                    $OrderNORecords 	        =	$OrderNOQuery->fetchAll(PDO::FETCH_ASSOC);

                    if($OrderNOCount>0){
                        foreach($OrderNORecords as $OrderNOLines){
                            $OrderNO		=	FiltersDecode($OrderNOLines["OrderNO"]);

                            $OrdersQuery				=	$DatabaseConnect->prepare("SELECT * FROM orders WHERE UserID = ? AND OrderNO = ? ORDER BY id ASC");
                            $OrdersQuery->execute([$UserID, $OrderNO]);
                            $OrdersQueryRecords     	=	$OrdersQuery->fetchAll(PDO::FETCH_ASSOC);

                            foreach($OrdersQueryRecords as $OrderLines){
                                $ItemType		=	FiltersDecode($OrderLines["ItemType"]);
                                if($ItemType == "Phone"){
                                    $PicturePath	=	"Phone";
                                }elseif($ItemType == "Computer"){
                                    $PicturePath	=	"Computer";
                                }


                                $ShippingStatus		=	FiltersDecode($OrderLines["ShippingStatus"]);
                                if($ShippingStatus == 0){
                                    $ShippingStatusPrint	=	"Holding";
                                }else{
                                    $ShippingStatusPrint	=	FiltersDecode($OrderLines["ShippingCode"]);
                                }
                                ?>
                                <tr height="30">
                                    <td width="125" align="left">&nbsp;#<?php echo FiltersDecode($OrderLines["OrderNO"]); ?></td>
                                    <td width="75" align="left"><img src="Images/ItemPictures/<?php echo $PicturePath; ?>/<?php echo FiltersDecode($OrderLines["ItemPicOne"]); ?>" border="0" width="60" height="80"></td>
                                    <td width="50" align="left"><a href="index.php?PageCode=70&ItemID=<?php echo FiltersDecode($OrderLines["ItemID"]); ?>"><img src="Images/DokumanKirmiziKalemli20x20.png" border="0"></a></td>
                                    <td width="415" align="left"><?php echo FiltersDecode($OrderLines["ItemName"]); ?></td>
                                    <td width="100" align="left"><?php echo PriceFormat(FiltersDecode($OrderLines["ItemPrice"])); ?> USD</td>
                                    <td width="50" align="left"><?php echo FiltersDecode($OrderLines["ItemAmount"]); ?></td>
                                    <td width="100" align="left"><?php echo PriceFormat(FiltersDecode($OrderLines["TotalItemPrice"])); ?> USD</td>
                                    <td width="150" align="left"><?php echo $ShippingStatusPrint; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr height="30">
                                <td colspan="8"><hr /></td>
                            </tr>
                            <?php
                        }

                        if($PageCount>1){
                            ?>
                            <tr height="50">
                                <td colspan="8" align="center"><div class="PaginationArea">
                                        <div class="PaginationTextArea">
                                            Total Records :<?php echo $PageCount; ?> per page <?php echo $Query; ?>
                                        </div>

                                        <div class="PaginationNumberArea">
                                            <?php
                                            if($Pagination>1){
                                                echo "<span class='PaginationPasive'><a href='index.php?PageCode=56&Page=1'><<</a></span>";
                                                $OneStepBack	=	$Pagination-1;
                                                echo "<span class='PaginationPasive'><a href='index.php?PageCode=56&Page=" . $OneStepBack . "'><</a></span>";
                                            }

                                            for($PageIndexValue=$Pagination-$RightandLeftButtonCountforPagination; $PageIndexValue<=$Pagination+$RightandLeftButtonCountforPagination; $PageIndexValue++){
                                                if(($PageIndexValue>0) and ($PageIndexValue<=$PageCount)){
                                                    if($Pagination==$PageIndexValue){
                                                        echo "<span class='PaginationActive'>" . $PageIndexValue . "</span>";
                                                    }else{
                                                        echo "<span class='PaginationPasive'><a href='index.php?PageCode=56&Page=" . $PageIndexValue . "'> " . $PageIndexValue . "</a></span>";
                                                    }
                                                }
                                            }

                                            if($Pagination!=$PageCount){
                                                $OneStepForward	=	$Pagination+1;
                                                echo "<span class='PaginationPasive'><a href='index.php?PageCode=56&Page=" . $OneStepForward . "'>></a></span>";
                                                echo "<span class='PaginationPasive'><a href='index.php?PageCode=56&Page=" . $PageCount . "'>>></a></span>";
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
                        <tr height="50">
                            <td colspan="8" align="left">You have not any order</td>
                        </tr>
                        <?php
                    }
                    ?>
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