<?php
if(isset($_REQUEST["MenuID"])){
    $IncomingMenuId		        =	NumbersFilter(Safety($_REQUEST["MenuID"]));
    $ConditionforMenu			=	 " AND MenuId = '" . $IncomingMenuId . "' ";
    $ConditionforPagination	        =	"&MenuID=" . $IncomingMenuId;
}else{
    $IncomingMenuId		=	"";
    $ConditionforMenu			=	"";
    $ConditionforPagination	=	"";
}

if(isset($_REQUEST["SearchContents"])){
    $IncomingSearchContents	=	Safety($_REQUEST["SearchContents"]);
    $ConditionforSearch		=	 " AND ItemName LIKE '%" . $IncomingSearchContents . "%' ";
    $ConditionforPagination	=	"&SearchContents=" . $IncomingSearchContents;
}else{
    $ConditionforSearch		=	"";
    $ConditionforPagination	=	"";
}

$RightandLeftButtonCountforPagination		=	2;
$ViewingDataCountinperPage		            =	10;
$Query				                        =	$DatabaseConnect->prepare("SELECT * FROM Items WHERE ItemType = 'Phone' AND Status = '1' $ConditionforMenu $ConditionforSearch ORDER BY id DESC");
$Query->execute();
$Query				                        =	$Query->rowCount();
$offset		                                =	($Pagination*$ViewingDataCountinperPage)-$ViewingDataCountinperPage;
$PageCount					                =	ceil($Query/$ViewingDataCountinperPage);

$MainPageItemsQuery		=	$DatabaseConnect->prepare("SELECT SUM(ItemAmount) AS MenusItems FROM menus WHERE ItemType = 'Phone'");
$MainPageItemsQuery->execute();
$MainPageItemsQuery		=	$MainPageItemsQuery->fetch(PDO::FETCH_ASSOC);
?>
<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
    <tr  align="center" height="50">
        <td bgcolor="#b8860b"><b>&nbsp;Menus</b></td>
    </tr>
        <td width="250" align="left" valign="top"><table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td><table width="450" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr align="left" height="30"><a href="index.php?PageCode=78" style="text-decoration: none; <?php if($IncomingMenuId==""){ ?>color: black;<? }else{ ?>color: #646464;<?php } ?> font-weight: bold;">&nbsp;Items (<?php echo $MainPageItemsQuery["MenusItems"]; ?>)</a></tr>

                <?php
                $MenusQuery		=	$DatabaseConnect->prepare("SELECT * FROM menus WHERE ItemType = 'Phone' ORDER BY MenuName ASC");
                $MenusQuery->execute();
                $MenuCount	=	$MenusQuery->rowCount();
                $MenuRecords		=	$MenusQuery->fetchAll(PDO::FETCH_ASSOC);

                foreach($MenuRecords as $Menu){
                ?>
                <td height="5">
                <tr><a href="index.php?PageCode=78&MenuID=<?php echo $Menu["id"]; ?>" style="text-decoration: none; <?php if($IncomingMenuId==$Menu["id"]){ ?>color: black;<? }else{ ?>color: #646464;<?php } ?> font-weight: bold;">&nbsp;<?php echo FiltersDecode($Menu["MenuName"]); ?> (<?php echo FiltersDecode($Menu["ItemAmount"]); ?>)</a></tr>
                </td>
                <?php
                }
                ?>
                <tr>
                    <td><div class="SearchArea"><form action="index.php?PageCode=78" method="post">
                <?php
                if($IncomingMenuId!=""){
                ?>
                <input type="hidden" name="MenuID" value="<?php echo $IncomingMenuId; ?>">
                <?php
                }
                ?>
                <div class="SearchAreaButtonArea">
                    <input type="submit" value="" class="SearchAreaButton">
                </div>
                <div class="SearchAreaInputArea">
                    <input type="text" name="SearchContents" class="SearchAreaInput">
                </div>
                </form></div></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>

                <tr>
                    <td><table width="795" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr><?php
                        $ItemsQuery		=	$DatabaseConnect->prepare("SELECT * FROM items WHERE ItemType = 'Phone' AND Status = '1' $ConditionforMenu $ConditionforSearch ORDER BY id DESC LIMIT $offset, $ViewingDataCountinperPage");
                        $ItemsQuery->execute();
                        $ItemCount			=	$ItemsQuery->rowCount();
                        $ItemRecords		=	$ItemsQuery->fetchAll(PDO::FETCH_ASSOC);

                        $LoopsCount			=	1;
                        $ColumnCount		=	4;

                        foreach($ItemRecords as $Records){
                        $ItemPrice          =   Safety($Records["ItemPrice"]);
                        $ItemCurrency       =   Safety($Records["Currency"]);

                        if ($ItemCurrency=="EUR"){
                        $ItemPriceChange    =   $ItemPrice*$eurusd;
                        }else{
                        $ItemPriceChange    =   $ItemPrice;
                        }
                        }

                        $ItemsTotalComments	=	FiltersDecode($Records["CommentNumber"]);
                        $ItemRatings    	=	FiltersDecode($Records["Rating"]);

                        if($ItemsTotalComments>0){
                        $RatingsProcess			=	number_format($ItemRatings/$ItemsTotalComments, 2, ".", "");
                        }else{
                        $RatingsProcess			=	0;
                        }

                        if($RatingsProcess==0){
                        $RatingPicture	=	"YildizCizgiliBos.png";
                        }elseif(($RatingsProcess>0) and ($RatingsProcess<=1)){
                        $RatingPicture	=	"YildizCizgiliBirDolu.png";
                        }elseif(($RatingsProcess>1) and ($RatingsProcess<=2)){
                        $RatingPicture	=	"YildizCizgiliIkiDolu.png";
                        }elseif(($RatingsProcess>2) and ($RatingsProcess<=3)){
                        $RatingPicture	=	"YildizCizgiliUcDolu.png";
                        }elseif(($RatingsProcess>3) and ($RatingsProcess<=4)){
                        $RatingPicture	=	"YildizCizgiliDortDolu.png";
                        }elseif($RatingsProcess>4){
                        $RatingPicture	=	"YildizCizgiliBesDolu.png";
                        }
                        ?>
                        <td width="191" valign="top">
                            <table width="191" align="left" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 10px;"> <!-- border: 1px solid #CCCCCC; -->
                                <tr height="40">
                                    <td align="center"><a href="index.php?PageCode=77&ID=<?php echo FiltersDecode($Records["id"]); ?>"><img src="Images\ItemPictures\Phone/<?php echo FiltersDecode($Records["ItemPicOne"]); ?>" border="0" width="225" height="255"></a></td>
                                </tr>
                                <tr height="25">
                                    <td width="191" align="center"><a href="index.php?PageCode=77&ID=<?php echo FiltersDecode($Records["id"]); ?>" style="color: black; font-weight: bold; text-decoration: none;">Phone</a></td>
                                </tr>
                                <tr height="25">
                                    <td width="191" align="center"><a href="index.php?PageCode=77&ID=<?php echo FiltersDecode($Records["id"]); ?>" style="color: #646464; font-weight: bold; text-decoration: none;"><div style="width: 191px; max-width: 191px; height: 20px; overflow: hidden; line-height: 20px;"><?php echo FiltersDecode($Records["ItemName"]); ?></div></a></td>
                                </tr>
                                <tr height="25">
                                    <td width="191" align="center"><a href="index.php?PageCode=77&ID=<?php echo FiltersDecode($Records["id"]); ?>"><img src="Images/<?php echo $RatingPicture; ?>" border="0"></a></td>
                                </tr>
                                <tr height="25">
                                    <td width="191" align="center"><a href="index.php?PageCode=77&ID=<?php echo FiltersDecode($Records["id"]); ?>" style="color: #646464; font-weight: bold; text-decoration: none;"><?php echo PriceFormat($ItemPriceChange); ?> USD</a></td>
                                </tr>

                                <tr height="25">
                                    <td width="191" align="center">&nbsp;</td>
                                </tr>

                            </table>
                        </td>
                        <?php
                        if($LoopsCount<$ColumnCount){
                        ?>
                        <td width="10">&nbsp;</td>
                        <?php
                        }
                        ?>
                        <?php
                        $LoopsCount++;

                        if($LoopsCount>$ColumnCount){
                        echo "</tr><tr>";
                        $LoopsCount	=	1;
                        }
                        ?></tr>
                    </table></td>
                </tr><?php
                        if($PageCount>1){
                        ?>
                    <tr height="50">
                        <td colspan="8" align="center"><div class="PaginationArea">
                            <div class="PaginationTextArea">
                                Total Records :<?php echo $Query; ?>
                            </div>
                            <div class="PaginationNumberArea">
                            <?php
                            if($Pagination>1){
                            echo "<span class='PaginationPasive'><a href='index.php?PageCode=55&Page=1'><<</a></span>";
                            $OneStepBack	=	$Pagination-1;
                            echo "<span class='PaginationPasive'><a href='index.php?PageCode=55&Page=" . $OneStepBack . "'><</a></span>";
                            }

                            for($PageIndexValue=$Pagination-$RightandLeftButtonCountforPagination; $PageIndexValue<=$Pagination+$RightandLeftButtonCountforPagination; $PageIndexValue++){
                            if(($PageIndexValue>0) and ($PageIndexValue<=$PageCount)){
                            if($Pagination==$PageIndexValue){
                            echo "<span class='PaginationActive'>" . $PageIndexValue . "</span>";
                            }else{
                            echo "<span class='PaginationPasive'><a href='index.php?PageCode=55&Page=" . $PageIndexValue . "'> " . $PageIndexValue . "</a></span>";
                            }
                            }
                            }

                            if($Pagination!=$PageCount){
                            $OneStepForward	=	$Pagination+1;
                            echo "<span class='PaginationPasive'><a href='index.php?PageCode=55&Page=" . $OneStepForward . "'>></a></span>";
                            echo "<span class='PaginationPasive'><a href='index.php?PageCode=55&Page=" . $PageCount . "'>>></a></span>";
                            }
                            ?>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
                }
                ?>
            </table></td>
            </tr>
        </table>
    </table>
</table>