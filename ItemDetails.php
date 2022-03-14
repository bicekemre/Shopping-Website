<?php
if (isset($_GET["ID"])){
    $IncomingID     =   NumbersFilter(Safety($_GET["ID"]));

    $ItemClicksQuery    =   $DatabaseConnect->prepare("UPDATE items SET Views=Views+1 WHERE id = ? AND Status = ? LIMIT 1 ");
    $ItemClicksQuery->execute([$IncomingID,1]);

    $ItemQuery   =   $DatabaseConnect->prepare("SELECT * FROM items WHERE id = ? AND Status = ? LIMIT 1");
    $ItemQuery->execute([$IncomingID,1]);
    $ItemCount   =   $ItemQuery->rowCount();
    $ItemRecords =   $ItemQuery->fetch(PDO::FETCH_ASSOC);

    if ($ItemCount>0){
     $ItemType  =   $ItemRecords["ItemType"];
        if ($ItemType=="Phone"){
            $PicturePath    =      "Phone";
        }elseif($ItemType="Computer"){
            $PicturePath    =   "Computer";
        }else{
        }

        $ItemPrice          =   Safety($ItemRecords["ItemPrice"]);
        $ItemCurrency       =   Safety($ItemRecords["Currency"]);

        if ($ItemCurrency=="EUR"){
            $ItemPriceChange    =   $ItemPrice*$eurusd;
        }else{
            $ItemPriceChange    =   $ItemPrice;
        }
?>
<table width="1065" align="center" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td width="350" valign="top">
            <table width="350" align="center" border="0" cellpadding="0" cellspacing="0">
                 <tr>
                    <td style="border: 1px solid #CCCCCC;" align="center"><img id="BigPicture" src="Images/ItemPictures/<?php echo $PicturePath . "/" . FiltersDecode($ItemRecords["ItemPicOne"]) ;?> " border="0" width="330" height="440"></td>
                 </tr>
                 <tr height="5">
                    <td style="font-size: 5px;">&nbsp;</td>
                 </tr>
                 <tr>
                     <td>
                         <table width="350" align="center" border="0" cellpadding="0" cellspacing="0">
                             <tr>
                                 <td width="78" style="border: 1px solid #CCCCCC;"><img src="Images/ItemPictures/<?php echo $PicturePath . "/" . FiltersDecode($ItemRecords["ItemPicOne"]) ;?> "width="78" height="104" border="0"  onclick="$.ChangePicture('<?php echo $PicturePath; ?>','<?php echo $ItemRecords["ItemPicOne"]; ?>')"></td>
                                 <td width="10">&nbsp</td>
                                 <td><img src="Images/ItemPictures/<?php echo $PicturePath . "/" . FiltersDecode($ItemRecords["ItemPicTwo"]) ;?> "width="78" height="104" border="0"  onclick="$.ChangePicture('<?php echo $PicturePath; ?>','<?php echo $ItemRecords["ItemPicTwo"]; ?>')"></td>
                                 <td width="10">&nbsp</td>
                                 <td><img src="Images/ItemPictures/<?php echo $PicturePath . "/" . FiltersDecode($ItemRecords["ItemPicThree"]) ;?> " width="78" height="104" border="0"  onclick="$.ChangePicture('<?php echo $PicturePath; ?>','<?php echo $ItemRecords["ItemPicThree"]; ?>')"=""></td>
                                 <td width="10">&nbsp</td>
                                 <td><img src="Images/ItemPictures/<?php echo $PicturePath . "/" . FiltersDecode($ItemRecords["ItemPicFour"]) ;?> " width="78" height="104" border="0"  onclick="$.ChangePicture('<?php echo $PicturePath; ?>','<?php echo $ItemRecords["ItemPicFour"]; ?>')"></td>
                                 <td width="10">&nbsp</td>
                             </tr>
                         </table>
                     </td>
                 </tr>
            </table>
        </td>

        <td width="10" valign="top">&nbsp;</td>

        <td width="705" valign="top">
            <table width="705" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr height="50" bgcolor="#F1F1F1">
                    <td style="text-align: left; font-size: 18px; font-weight: bold;">&nbsp;<?php echo FiltersDecode($ItemRecords["ItemName"]); ?></td>
                </tr>
                <tr>
                    <td>
                        <form action="index.php?PageCode=84&ID=<?php echo FiltersDecode($ItemRecords["id"]); ?>" method="post">
                            <table width="705" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr height="45">
                                    <td width="30"><a href="<?php echo FiltersDecode($Facebooklink); ?>" target="_blank"><img src="Images/Facebook24x24.png" border="0" style="margin-top: 5px;"></a></td>
                                    <td width="30"><a href="<?php echo FiltersDecode($Twitterlink); ?>" target="_blank"><img src="Images/Twitter24x24.png" border="0" style="margin-top: 5px;"></a></td>
                                    <td width="30"><?php if(isset($_SESSION["User"])){ ?><a href="index.php?PageCode=80&ID=<?php echo FiltersDecode($ItemRecords["id"]); ?>"><img src="Images/KalpKirmiziDaireliBeyaz24x24.png" border="0" style="margin-top: 5px;"></a><?php }else{ ?><img src="Images/KalpKirmiziDaireliBeyaz24x24.png" border="0" style="margin-top: 5px;"><?php } ?></td>
                                    <td width="10">&nbsp;</td>
                                    <td width="605"><input type="submit" value="Basket" class="BasketButton"></td>
                                </tr>
                                <tr height="45">
                                    <td colspan="5">
                                        <table width="705" align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr height="45">
                                                <td width="500" align="left">
                                                    <select name="variant" class="SelectArea" required>
                                                        <option value="">Please <?php echo FiltersDecode($ItemRecords["VariantTitle"]);?> Choice</option>
                                                        <?php

                                                        $VariantQuery		=	$DatabaseConnect->prepare("SELECT * FROM itemsvariants WHERE ItemID = ? AND StockNumber > ? ORDER BY VariantName ASC");
                                                        $VariantQuery->execute([FiltersDecode($ItemRecords["id"]), 0]);
                                                        $VariantCount		=	$VariantQuery->rowCount();
                                                        $VariantRecords	    =	$VariantQuery->fetchAll(PDO::FETCH_ASSOC);

                                                        foreach($VariantRecords as $VariantChoice){
                                                        ?>
                                                        <option value="<?php echo $VariantChoice["id"]; ?>"><?php echo FiltersDecode($VariantChoice["VariantName"]); ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td width="205" align="right" style="font-size: 25px; color: black; font-weight: bold;"><?php echo PriceFormat($ItemPriceChange); ?> USD</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td><hr /></td>
                </tr>
                <tr>
                    <td>
                        <table width="705" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr height="30">
                                <td><img src="Images/SaatEsnetikGri20x20.png" border="0" style="margin-top: 5px;"></td>
                                <td>Shipping date: <?php echo ShippingDate(); ?> </td>
                            </tr>
                            <tr height="30">
                                <td><img src="Images/SaatHizCizgiliLacivert20x20.png" border="0" style="margin-top: 5px;"></td>
                                <td>Fast shipping.</td>
                            </tr>
                            <tr height="30">
                                <td><img src="Images/KrediKarti20x20.png" border="0" style="margin-top: 5px;"></td>
                                <td>You can pay with credit card.</td>
                            </tr>
                            <tr height="30">
                                <td><img src="Images/Banka20x20.png" border="0" style="margin-top: 5px;"></td>
                                <td>You can pay with bank money transfer.</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td><hr /></td>
                </tr>
                <tr height="30">
                    <td style="background: darkgoldenrod; color: white;">&nbsp;Item About</td>
                </tr>
                <tr>
                    <td><?php echo FiltersDecode($ItemRecords["ItemAbout"]); ?></td>
                </tr>
                <tr>
                    <td><hr /></td>
                </tr>
                <tr height="30">
                    <td style="background: darkgoldenrod; color: white;">&nbsp;Item Comments</td>
                </tr>
                <tr>
                    <td><div style="width: 705px; max-width: 705px; height: 300px; max-height: 300px; overflow-y: scroll;"><table width="685" align="left" border="0" cellpadding="0" cellspacing="0">
                    <?php
                    $CommentsQuery	    =	$DatabaseConnect->prepare("SELECT * FROM comments WHERE ItemID = ? ORDER BY CommentDate DESC");
                    $CommentsQuery->execute([FiltersDecode($ItemRecords["id"])]);
                    $CommentsCount	    =	$CommentsQuery->rowCount();
                    $CommentsRecords		=	$CommentsQuery->fetchAll(PDO::FETCH_ASSOC);

                    if($CommentsCount>0){
                        foreach($CommentsRecords as $CommentLines){
                            $Rating		=	FiltersDecode($CommentLines["Rating"]);

                            if($Rating==1){
                                $RatingPic		=	"YildizBirDolu.png";
                            }elseif($Rating==2){
                                $RatingPic		=	"YildizIkiDolu.png";
                            }elseif($Rating==3){
                                $RatingPic		=	"YildizUcDolu.png";
                            }elseif($Rating==4){
                                $RatingPic		=	"YildizDortDolu.png";
                            }elseif($Rating==5){
                                $RatingPic		=	"YildizBesDolu.png";
                            }

                            $UserQuery	        =	$DatabaseConnect->prepare("SELECT * FROM members WHERE id = ? LIMIT 1");
                            $UserQuery->execute([FiltersDecode($CommentLines["UserID"])]);
                            $UserRecords		=	$UserQuery->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <tr height="30">
                                <td width="64"><img src="Images/<?php echo $RatingPic; ?>" border="0"></td>
                                <td width="10">&nbsp;</td>
                                <td width="451"><?php echo FiltersDecode($UserRecords["NameSurname"]); ?></td>
                                <td width="10">&nbsp;</td>
                                <td width="150" align="right"><?php echo DateFilter(FiltersDecode($CommentLines["CommentDate"])); ?></td>
                            </tr>
                            <tr>
                                <td colspan="5" style="border-bottom: 1px dashed #CCCCCC;"><?php echo FiltersDecode($CommentLines["CommentText"]); ?></td>
                            </tr>
                            <?php
                        }
                    }else{
                        ?>
                        <tr height="30">
                            <td>None Comment.</td>
                        </tr>
                        <?php
                    }
                    ?>
                    </table></div></td>
                </tr>
            </table>
        <td width="705" valign="top"></td>
    </tr>
</table>
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