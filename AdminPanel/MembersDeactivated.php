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
    $Query				                        =	$DatabaseConnect->prepare("SELECT * FROM members WHERE DeletingStatus = ? $ConditionforSearch ORDER BY id DESC");
    $Query->execute([1]);
    $Query				                        =	$Query->rowCount();
    $offset		                                =	($Pagination*$ViewingDataCountinperPage)-$ViewingDataCountinperPage;
    $PageCount					                =	ceil($Query/$ViewingDataCountinperPage);
    ?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFFFFF;" align="left"><h3>&nbsp;MEMBERS</h3></td>
            <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?PageCodeLog=0&PageCodeA=82" style="color: #FFFFFF; text-decoration: none;">Active Members&nbsp;</a></td>
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
                                <form action="index.php?PageCodeLog=0&PageCodeA=82" method="post">
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
        $Query		=	$DatabaseConnect->prepare("SELECT * FROM members WHERE DeletingStatus = ? $ConditionforSearch ORDER BY id DESC LIMIT $offset, $ViewingDataCountinperPage");
        $Query->execute([1]);
        $Count			=	$Query->rowCount();
        $Records		=	$Query->fetchAll(PDO::FETCH_ASSOC);

        if($Count>0){
            foreach($Records as $records){
                ?>
                <tr height="80">
                    <td colspan="2" style="border-bottom: 1px dashed #CCCCCC;" valign="top">
                        <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                            <tr height="30">
                                <td width="85"><b>Name Surname</b></td>
                                <td width="10"><b>:</b></td>
                                <td width="150"><?php echo FiltersDecode($records["NameSurname"]); ?></td>
                                <td width="90"><b>E-Mail</b></td>
                                <td width="10"><b>:</b></td>
                                <td width="200"><?php echo FiltersDecode($records["EmailAddress"]); ?></td>
                                <td width="70"><b>Phone</b></td>
                                <td width="10"><b>:</b></td>
                                <td width="95"><?php echo FiltersDecode($records["PhoneNumber"]); ?></td>
                            </tr>
                            <tr height="30">
                                <td><b>Gender</b></td>
                                <td><b>:</b></td>
                                <td><?php echo FiltersDecode($records["Gender"]); ?></td>
                                <td><b>Regis Date</b></td>
                                <td><b>:</b></td>
                                <td><?php echo  DateFilter(FiltersDecode($records["RegisDate"])); ?></td>
                                <td><b>Regis IP address</b></td>
                                <td><b>:</b></td>
                                <td><?php echo FiltersDecode($records["RegisIPaddress"]); ?></td>
                            </tr>
                            <tr>
                                <td colspan="9" align="right"><table width="95" align="right" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="40">&nbsp;</td>
                                            <td width="25" valign="top" align="left"><a href="index.php?PageCodeLog=0&PageCodeA=87&ID=<?php echo FiltersDecode($records["id"]); ?>"><img src="../Images/Guncelleme20x20.png" border="0" style="margin-top: 5px;"></a></td>
                                            <td width="30" align="left"><a href="index.php?PageCodeLog=0&PageCodeA=87&ID=<?php echo FiltersDecode($records["id"]); ?>" style="color: blue; text-decoration: none;">Activate</a></td>
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
                            <td width="750">None Member.</td>
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
