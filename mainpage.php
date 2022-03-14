<table>
    <tr>
        <td>
            <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                <?php
                /* Banner Area
                $BannerQuery		=	$DatabaseConnect->prepare("SELECT * FROM banners WHERE BannerArea = 'Main Page' ORDER BY Views ASC LIMIT 1");
                $BannerQuery->execute();
                $BannerCount		=	$BannerQuery->rowCount();
                $BannerRecords		=	$BannerQuery->fetch(PDO::FETCH_ASSOC);
                ?>
                <tr height="186">
                    <td><img src="Images/<?php echo $BannerRecords["BannerPicture"]; ?>" border="0"></td>
                </tr>
                <?php
                $BannerUpdate		=	$DatabaseConnect->prepare("UPDATE banners SET Views=Views+1 WHERE id = ? LIMIT 1");
                $BannerUpdate->execute([$BannerRecords["id"]]);
                */
                ?>
            </table>
        </td>
    </tr>

    <tr height="35">
        <td bgcolor="#b8860b" style="color: #FFFFFF; font-weight: bold;">&nbsp;New Items</td>
    </tr>

    <tr>
        <td>
            <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <?php
                    $NewItemsQuery		=	$DatabaseConnect->prepare("SELECT * FROM items WHERE Status = '1' ORDER BY id DESC LIMIT 5");
                    $NewItemsQuery->execute();
                    $NewItemsCount			=	$NewItemsQuery->rowCount();
                    $NewItemsRecords		=	$NewItemsQuery->fetchAll(PDO::FETCH_ASSOC);

                    $NewItemLoops			=	1;

                    foreach($NewItemsRecords as $NewItemLines){
                        $NewItemType		    =	FiltersDecode($NewItemLines["ItemType"]);
                        $NewItemPrice		=	FiltersDecode($NewItemLines["ItemPrice"]);
                        $NewItemCurrency	=	FiltersDecode($NewItemLines["Currency"]);

                        if($NewItemCurrency=="EUR"){
                            $NewItemPriceFormat	=	$NewItemPrice*$eurusd;
                        }elseif($NewItemCurrency=="USD"){
                            $NewItemPriceFormat	=	$NewItemPrice;
                        }else{
                            die();
                            /* Another Currencies */
                        }

                        if($NewItemType=="Phone"){
                            $NewItemPicPath		=	"Phone";
                        }elseif($NewItemType=="Computer"){
                            $NewItemPicPath		=	"Computer";
                        }

                        $NewItemComments	=	FiltersDecode($NewItemLines["CommentNumber"]);
                        $NewItemRating	    =	FiltersDecode($NewItemLines["Rating"]);

                        if($NewItemComments>0){
                            $NewRating			=	number_format($NewItemRating/$NewItemComments, 2, ".", "");
                        }else{
                            $NewRating			=	0;
                        }

                        if($NewRating==0){
                            $NewRatingPicture	=	"YildizCizgiliBos.png";
                        }elseif(($NewRating>0) and ($NewRating<=1)){
                            $NewRatingPicture	=	"YildizCizgiliBirDolu.png";
                        }elseif(($NewRating>1) and ($NewRating<=2)){
                            $NewRatingPicture	=	"YildizCizgiliIkiDolu.png";
                        }elseif(($NewRating>2) and ($NewRating<=3)){
                            $NewRatingPicture	=	"YildizCizgiliUcDolu.png";
                        }elseif(($NewRating>3) and ($NewRating<=4)){
                            $NewRatingPicture	=	"YildizCizgiliDortDolu.png";
                        }elseif($NewRating>4){
                            $NewRatingPicture	=	"YildizCizgiliBesDolu.png";
                        }
                        ?>
                        <td width="205" valign="top">
                            <table width="205" align="left" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 10px;">
                                <tr height="40">
                                    <td align="center"><a href="index.php?PageCode=77&ID=<?php echo FiltersDecode($NewItemLines["id"]); ?>"><img src="Images/ItemPictures/<?php echo $NewItemPicPath; ?>/<?php echo FiltersDecode($NewItemLines["ItemPicOne"]); ?>" border="0" width="205" height="273"></a></td>
                                </tr>
                                <tr height="25">
                                    <td width="205" align="center"><a href="index.php?PageCode=77&ID=<?php echo FiltersDecode($NewItemLines["id"]); ?>" style="color: darkgoldenrod; font-weight: bold; text-decoration: none;"><?php echo  FiltersDecode($NewItemType); ?></a></td>
                                </tr>
                                <tr height="25">
                                    <td width="205" align="center"><a href="index.php?PageCode=77&ID=<?php echo FiltersDecode($NewItemLines["id"]); ?>" style="color: #646464; font-weight: bold; text-decoration: none;"><div style="width: 205px; max-width: 205px; height: 20px; overflow: hidden; line-height: 20px;"><?php echo FiltersDecode($NewItemLines["ItemName"]); ?></div></a></td>
                                </tr>
                                <tr height="25">
                                    <td width="205" align="center"><a href="index.php?PageCode=77&ID=<?php echo FiltersDecode($NewItemLines["id"]); ?>"><img src="Images/<?php echo $NewRatingPicture; ?>" border="0"></a></td>
                                </tr>
                                <tr height="25">
                                    <td width="205" align="center"><a href="index.php?PageCode=77&ID=<?php echo FiltersDecode($NewItemLines["id"]); ?>" style="color: #0000FF; font-weight: bold; text-decoration: none;"><?php echo PriceFormat($NewItemPriceFormat); ?> USD</a></td>
                                </tr>
                            </table>
                        </td>
                        <?php
                        if($NewItemLoops<4){
                            ?>
                            <td width="10">&nbsp;</td>
                            <?php
                        }
                        ?>
                        <?php
                        $NewItemLoops++;
                    }
                    ?>
                </tr>
            </table>
        </td>
    </tr>

    <tr height="35">
        <td bgcolor="darkgoldenrod" style="color: #FFFFFF; font-weight: bold;">&nbsp;Most Popular Items</td>
    </tr>

    <tr>
        <td>
            <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <?php
                    $PopularItemsQuery		=	$DatabaseConnect->prepare("SELECT * FROM items WHERE Status = '1' ORDER BY Views DESC LIMIT 5");
                    $PopularItemsQuery->execute();
                    $PopularItemsCount			=	$PopularItemsQuery->rowCount();
                    $PopularItemsRecords			=	$PopularItemsQuery->fetchAll(PDO::FETCH_ASSOC);

                    $PopularLoops			=	1;

                    foreach($PopularItemsRecords as $PopularItemsLines){
                        $PopularItemsType		=	FiltersDecode($PopularItemsLines["ItemType"]);
                        $PopularItemsPrice		=	FiltersDecode($PopularItemsLines["ItemPrice"]);
                        $PopularItemsCurrency	=	FiltersDecode($PopularItemsLines["Currency"]);

                        if($PopularItemsCurrency=="USD"){
                            $PopularItemsPriceFormat	=	$PopularItemsPrice;
                        }elseif($PopularItemsCurrency=="EUR"){
                            $PopularItemsPriceFormat	=	$PopularItemsPrice*$eurusd;
                        }else{
                            die();
                            /* Another Currencies */
                        }

                        if($PopularItemsType=="Phone"){
                            $PopularItemsPicPath		=	"Phone";
                        }elseif($PopularItemsType=="Computer"){
                            $PopularItemsPicPath		=	"Computer";
                        }

                        $PopularItemsCommentNumber	=	FiltersDecode($PopularItemsLines["CommentNumber"]);
                        $PopularItemsRating	=	FiltersDecode($PopularItemsLines["Rating"]);

                        if($PopularItemsCommentNumber>0){
                            $PopularRating			=	number_format($PopularItemsRating/$PopularItemsCommentNumber, 2, ".", "");
                        }else{
                            $PopularRating			=	0;
                        }

                        if($PopularRating==0){
                            $PopularRatingPicture	=	"YildizCizgiliBos.png";
                        }elseif(($PopularRating>0) and ($PopularRating<=1)){
                            $PopularRatingPicture	=	"YildizCizgiliBirDolu.png";
                        }elseif(($PopularRating>1) and ($PopularRating<=2)){
                            $PopularRatingPicture	=	"YildizCizgiliIkiDolu.png";
                        }elseif(($PopularRating>2) and ($PopularRating<=3)){
                            $PopularRatingPicture	=	"YildizCizgiliUcDolu.png";
                        }elseif(($PopularRating>3) and ($PopularRating<=4)){
                            $PopularRatingPicture	=	"YildizCizgiliDortDolu.png";
                        }elseif($PopularRating>4){
                            $PopularRatingPicture	=	"YildizCizgiliBesDolu.png";
                        }
                        ?>
                        <td width="205" valign="top">
                            <table width="205" align="left" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 10px;">
                                <tr height="40">
                                    <td align="center"><a href="index.php?PageCode=77&ID=<?php echo FiltersDecode($PopularItemsLines["id"]); ?>"><img src="Images/ItemPictures/<?php echo $PopularItemsPicPath; ?>/<?php echo FiltersDecode($PopularItemsLines["ItemPicOne"]); ?>" border="0" width="205" height="273"></a></td>
                                </tr>
                                <tr height="25">
                                    <td width="205" align="center"><a href="index.php?PageCode=77&ID=<?php echo FiltersDecode($PopularItemsLines["id"]); ?>" style="color: darkgoldenrod; font-weight: bold; text-decoration: none;"><?php echo  FiltersDecode($PopularItemsType); ?></a></td>
                                </tr>
                                <tr height="25">
                                    <td width="205" align="center"><a href="index.php?PageCode=77&ID=<?php echo FiltersDecode($PopularItemsLines["id"]); ?>" style="color: #646464; font-weight: bold; text-decoration: none;"><div style="width: 205px; max-width: 205px; height: 20px; overflow: hidden; line-height: 20px;"><?php echo FiltersDecode($PopularItemsLines["ItemName"]); ?></div></a></td>
                                </tr>
                                <tr height="25">
                                    <td width="205" align="center"><a href="index.php?PageCode=77&ID=<?php echo FiltersDecode($PopularItemsLines["id"]); ?>"><img src="Images/<?php echo $PopularRatingPicture; ?>" border="0"></a></td>
                                </tr>
                                <tr height="25">
                                    <td width="205" align="center"><a href="index.php?PageCode=77&ID=<?php echo FiltersDecode($PopularItemsLines["id"]); ?>" style="color: #0000FF; font-weight: bold; text-decoration: none;"><?php echo PriceFormat($PopularItemsPriceFormat); ?> USD</a></td>
                                </tr>
                            </table>
                        </td>
                        <?php
                        if($PopularLoops<4){
                            ?>
                            <td width="10">&nbsp;</td>
                            <?php
                        }
                        ?>
                        <?php
                        $PopularLoops++;
                    }
                    ?>
                </tr>
            </table>
        </td>
    </tr>

    <tr height="35">
        <td bgcolor="darkgoldenrod" style="color: #FFFFFF; font-weight: bold;">&nbsp;Top Selling Items</td>
    </tr>

    <tr>
        <td>
            <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <?php
                    $TopSalesItemsQuery		=	$DatabaseConnect->prepare("SELECT * FROM items WHERE Status = '1' ORDER BY SalesAmount DESC LIMIT 5");
                    $TopSalesItemsQuery->execute();
                    $TopSalesItemsCount			=	$TopSalesItemsQuery->rowCount();
                    $TopSalesItemsRecords			=	$TopSalesItemsQuery->fetchAll(PDO::FETCH_ASSOC);

                    $TopSalesLoops			=	1;

                    foreach($TopSalesItemsRecords as $TopSalesItemsLines){
                        $TopSalesItemsType		=	FiltersDecode($TopSalesItemsLines["ItemType"]);
                        $TopSalesItemsPrice		=	FiltersDecode($TopSalesItemsLines["ItemPrice"]);
                        $TopSalesItemsCurrency	=	FiltersDecode($TopSalesItemsLines["Currency"]);

                        if($TopSalesItemsCurrency=="USD"){
                            $TopSalesItemsPriceFormat	=	$TopSalesItemsPrice;
                        }elseif($TopSalesItemsCurrency=="EUR"){
                            $TopSalesItemsPriceFormat	=	$TopSalesItemsPrice*$eurusd;
                        }else{
                            die();
                            /* Another Currencies */
                        }

                        if($TopSalesItemsType=="Phone"){
                            $TopSalesItemsPicPath		=	"Phone";
                        }elseif($TopSalesItemsType=="Computer"){
                            $TopSalesItemsPicPath		=	"Computer";
                        }

                        $TopSalesItemsCommentNumber	=	FiltersDecode($TopSalesItemsLines["CommentNumber"]);
                        $TopSalesItemsRating	=	FiltersDecode($TopSalesItemsLines["Rating"]);

                        if($TopSalesItemsCommentNumber>0){
                            $TopSalesRating			=	number_format($TopSalesItemsRating/$TopSalesItemsCommentNumber, 2, ".", "");
                        }else{
                            $TopSalesRating			=	0;
                        }

                        if($TopSalesRating==0){
                            $TopSalesRatingPicture	=	"YildizCizgiliBos.png";
                        }elseif(($TopSalesRating>0) and ($TopSalesRating<=1)){
                            $TopSalesRatingPicture	=	"YildizCizgiliBirDolu.png";
                        }elseif(($TopSalesRating>1) and ($TopSalesRating<=2)){
                            $TopSalesRatingPicture	=	"YildizCizgiliIkiDolu.png";
                        }elseif(($TopSalesRating>2) and ($TopSalesRating<=3)){
                            $TopSalesRatingPicture	=	"YildizCizgiliUcDolu.png";
                        }elseif(($TopSalesRating>3) and ($TopSalesRating<=4)){
                            $TopSalesRatingPicture	=	"YildizCizgiliDortDolu.png";
                        }elseif($TopSalesRating>4){
                            $TopSalesRatingPicture	=	"YildizCizgiliBesDolu.png";
                        }
                        ?>
                        <td width="205" valign="top">
                            <table width="205" align="left" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 10px;">
                                <tr height="40">
                                    <td align="center"><a href="index.php?PageCode=77&ID=<?php echo FiltersDecode($TopSalesItemsLines["id"]); ?>"><img src="Images/ItemPictures/<?php echo $TopSalesItemsPicPath; ?>/<?php echo FiltersDecode($TopSalesItemsLines["ItemPicOne"]); ?>" border="0" width="205" height="273"></a></td>
                                </tr>
                                <tr height="25">
                                    <td width="205" align="center"><a href="index.php?PageCode=77&ID=<?php echo FiltersDecode($TopSalesItemsLines["id"]); ?>" style="color: darkgoldenrod; font-weight: bold; text-decoration: none;"><?php echo  FiltersDecode($TopSalesItemsType); ?></a></td>
                                </tr>
                                <tr height="25">
                                    <td width="205" align="center"><a href="index.php?PageCode=77&ID=<?php echo FiltersDecode($TopSalesItemsLines["id"]); ?>" style="color: #646464; font-weight: bold; text-decoration: none;"><div style="width: 205px; max-width: 205px; height: 20px; overflow: hidden; line-height: 20px;"><?php echo FiltersDecode($TopSalesItemsLines["ItemName"]); ?></div></a></td>
                                </tr>
                                <tr height="25">
                                    <td width="205" align="center"><a href="index.php?PageCode=77&ID=<?php echo FiltersDecode($TopSalesItemsLines["id"]); ?>"><img src="Images/<?php echo $TopSalesRatingPicture; ?>" border="0"></a></td>
                                </tr>
                                <tr height="25">
                                    <td width="205" align="center"><a href="index.php?PageCode=77&ID=<?php echo FiltersDecode($TopSalesItemsLines["id"]); ?>" style="color: #0000FF; font-weight: bold; text-decoration: none;"><?php echo PriceFormat($TopSalesItemsPriceFormat); ?> USD</a></td>
                                </tr>
                            </table>
                        </td>
                        <?php
                        if($TopSalesLoops<4){
                            ?>
                            <td width="10">&nbsp;</td>
                            <?php
                        }
                        ?>
                        <?php
                        $TopSalesLoops++;
                    }
                    ?>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td>&nbsp;</td>
    </tr>

    <tr>
        <td>
            <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="258">
                        <table width="258" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="center"><img src="Images/HizliTeslimat.png" border="0"></td>
                            </tr>
                            <tr>
                                <td align="center"><b>Fast Shipping</b></td>
                            </tr>
                            <tr>
                                <td align="center"></td>
                            </tr>
                        </table>
                    </td>
                    <td width="11">&nbsp;</td>
                    <td width="258">
                        <table width="258" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="center"><img src="Images/GuvenliAlisveris.png" border="0"></td>
                            </tr>
                            <tr>
                                <td align="center"><b>Easy and Safety Shopping</b></td>
                            </tr>
                            <tr>
                                <td align="center"></td>
                            </tr>
                        </table>
                    </td>
                    <td width="11">&nbsp;</td>
                    <td width="258">
                        <table width="258" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="center"><img src="Images/MobilErisim.png" border="0"></td>
                            </tr>
                            <tr>
                                <td align="center"><b>On mobile</b></td>
                            </tr>
                            <tr>
                                <td align="center"></td>
                            </tr>
                        </table>
                    </td>
                    <td width="11">&nbsp;</td>
                    <td width="258">
                        <table width="258" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="center"><img src="Images/IadeGarantisi.png" border="0"></td>
                            </tr>
                            <tr>
                                <td align="center"><b>Easy Returns</b></td>
                            </tr>
                            <tr>
                                <td align="center"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>