<?php
if(isset($_SESSION["Admin"])){
    if(isset($_REQUEST["SearchContents"])){
        $IncomingSearchContents	=	Safety($_REQUEST["SearchContents"]);
        $ConditionforSearch		=	  " AND (EmailAddress  LIKE '%" . $IncomingSearchContents . "%' OR NameSurname LIKE '%" . $IncomingSearchContents . "%' OR PhoneNumber LIKE '%" . $IncomingSearchContents . "%' ) ";
        $ConditionforPagination	=	"&SearchContents=" . $IncomingSearchContents;
    }else{
        $ConditionforSearch		=	"";
        $ConditionforPagination	=	"";
    }

    $RightandLeftButtonCountforPagination		=	2;
    $ViewingDataCountinperPage		            =	10;
    $Query				                        =	$DatabaseConnect->prepare("SELECT * FROM items WHERE Status = ? $ConditionforSearch ORDER BY id DESC");
    $Query->execute([0]);
    $Query				                        =	$Query->rowCount();
    $offset		                                =	($Pagination*$ViewingDataCountinperPage)-$ViewingDataCountinperPage;
    $PageCount					                =	ceil($Query/$ViewingDataCountinperPage);
    ?>
<table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr height="70">
        <td width="560" bgcolor="#FF9900" style="color: #FFFFFF;" align="left"><h3>&nbsp;ITEMS</h3></td>
        <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?PageCodeLog=0&PageCodeA=95" style="color: #FFFFFF; text-decoration: none;">Add ITEM&nbsp;</a></td>
    </tr>
    <tr height="10">
        <td colspan="2" style="font-size: 10px;">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2">
            <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <div class="SearchArea">
                            <form action="index.php?PageCodeLog=0&PageCodeA=94" method="post">
                                <div class="SearchAreaButtonArea">
                                    <input type="submit" value="" class="SearchAreaButton">
                                </div>
                                <div class="SearchAreaInputArea">
                                    <input type="text" name="SearchContents" class="SearchAreaInput">
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr height="10">
        <td colspan="2" style="font-size: 10px;">&nbsp;</td>
    </tr>
    <?php
    $Query		=	$DatabaseConnect->prepare("SELECT * FROM items WHERE Status = ? $ConditionforSearch ORDER BY id DESC LIMIT $offset, $ViewingDataCountinperPage");
    $Query->execute([1]);
    $Count			=	$Query->rowCount();
    $Records		=	$Query->fetchAll(PDO::FETCH_ASSOC);

    if($Count>0){
    foreach($Records as $records){
        $MenuQuery		=	$DatabaseConnect->prepare("SELECT * FROM menus WHERE id = ? LIMIT 1");
        $MenuQuery->execute([FiltersDecode($records["MenuID"])]);
        $MenuRecods			=	$MenuQuery->fetch(PDO::FETCH_ASSOC);

        if($records["ItemType"] == "Phone"){
            $PicturePath	=	"Phone";
        }elseif($records["ItemType"] == "Computer"){
            $PicturePath	=	"Computer";
        }elseif($records["ItemType"] == ""){
            //another ıtem types
            die();
        }
    ?>
    <tr height="80">
        <td colspan="2" style="border-bottom: 1px dashed #CCCCCC;" valign="top">
            <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="60" valign="top"><img src="../Images/ItemPictures/<?php echo $PicturePath; ?>/<?php echo FiltersDecode($records["ItemPicOne"]); ?>" border="0" width="60" height="80"></td>
                    <td width="10">&nbsp;</td>
                    <td width="680" valign="top">
                        <table width="680" align="right" border="0" cellpadding="0" cellspacing="0">
                            <tr height="25">
                                <td colspan="2"><?php echo FiltersDecode($records["ItemType"]); ?> -> <?php echo FiltersDecode($MenuRecods["MenuName"]); ?></td>
                            </tr>
                            <tr height="25">
                                <td width="580"><?php echo FiltersDecode($records["ItemName"]); ?></td>
                                <td width="100" align="right"><?php echo  PriceFormat(FiltersDecode($records["ItemPrice"])); ?> <?php echo FiltersDecode($records["Currency"]); ?></td>
                            </tr>
                            <tr height="25">
                                <td width="540"><?php echo FiltersDecode($records["SalesAmount"]); ?> Sales. <?php echo FiltersDecode($records["CommentNumber"]); ?> Comment <?php echo FiltersDecode($records["Rating"]); ?> Rating <?php echo FiltersDecode($records["Views"]); ?> Views.</td>
                                <td width="140" align="right"><table width="140" align="right" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="25" valign="top"><a href="index.php?PageCodeLog=0&PageCodeA=99&ID=<?php echo FiltersDecode($records["id"]); ?>"><img src="../Images/Guncelleme20x20.png" border="0"></a></td>
                                            <td width="70" valign="top"><a href="index.php?PageCodeLog=0&PageCodeA=99&ID=<?php echo FiltersDecode($records["id"]); ?>" style="color: #0000FF; text-decoration: none;">Change</a></td>
                                            <td width="25" valign="top"><a href="index.php?PageCodeLog=0&PageCodeA=103&ID=<?php echo FiltersDecode($records["id"]); ?>"><img src="../Images/Sil20x20.png" border="0"></a></td>
                                            <td width="20" valign="top"><a href="index.php?PageCodeLog=0&PageCodeA=103&ID=<?php echo FiltersDecode($records["id"]); ?>" style="color: #FF0000; text-decoration: none;">Delete</a></td>
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
    }
        if($PageCount>1){
            ?>
            <tr height="50">
                <td colspan="8" align="center">
                    <div class="PaginationArea">
                        <div class="PaginationTextArea">
                            Total Records :<?php echo $Query; ?>
                        </div>
                        <div class="PaginationNumberArea">
                            <?php
                            if($Pagination>1){
                                echo "<span class='PaginationPasive'><a href='index.php?PageCodeLog=0&PageCodeA=82" . $ConditionforSearch . "&Page=1'><<</a></span>";
                                $OneStepBack	=	$Pagination-1;
                                echo "<span class='PaginationPasive'><a href='index.php?PageCodeLog=0&PageCodeA=82" . $ConditionforSearch . "&Page=" . $OneStepBack . "'><</a></span>";
                            }

                            for($PageIndexValue=$Pagination-$RightandLeftButtonCountforPagination; $PageIndexValue<=$Pagination+$RightandLeftButtonCountforPagination; $PageIndexValue++){
                                if(($PageIndexValue>0) and ($PageIndexValue<=$PageCount)){
                                    if($Pagination==$PageIndexValue){
                                        echo "<span class='PaginationActive'>" . $PageIndexValue . "</span>";
                                    }else{
                                        echo "<span class='PaginationPasive'><a href='index.php?PageCodeLog=0&PageCodeA=82" . $ConditionforSearch . "&Page=" . $PageIndexValue . "'> " . $PageIndexValue . "</a></span>";

                                    }
                                }
                            }

                            if($Pagination!=$PageCount){
                                $OneStepForward	=	$Pagination+1;
                                echo "<span class='PaginationPasive'><a href='index.php?PageCodeLog=0&PageCodeA=82" . $ConditionforSearch . "&Page=" . $OneStepForward . "'>></a></span>";
                                echo "<span class='PaginationPasive'><a href='index.php?PageCodeLog=0&PageCodeA=82" . $ConditionforSearch . "&Page=" . $PageCount . "'>>></a></span>";
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
                        <td width="750">None Item.</td>
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

