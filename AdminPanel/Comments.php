<?php
if(isset($_SESSION["Admin"])){
    $RightandLeftButtonCountforPagination		=	2;
    $ViewingDataCountinperPage		=	10;
    $Query				=	$DatabaseConnect->prepare("SELECT * FROM comments ORDER BY id DESC");
    $Query->execute();
    $Query				=	$Query->rowCount();
    $offset		=	($Pagination*$ViewingDataCountinperPage)-$ViewingDataCountinperPage;
    $PageCount						=	ceil($Query/$ViewingDataCountinperPage);

?>
<table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr height="70">
        <td width="560" bgcolor="#FF9900" style="color: #FFFFFF;" align="left"><h3>&nbsp;COMMENTS</h3></td>
    </tr>
    <tr height="10">
        <td style="font-size: 10px;">&nbsp;</td>
    </tr>
<?php
    $CommentsQuery		=	$DatabaseConnect->prepare("SELECT * FROM comments ORDER BY id DESC LIMIT $offset, $ViewingDataCountinperPage");
    $CommentsQuery->execute();
    $Count			=	$CommentsQuery->rowCount();
    $Records		=	$CommentsQuery->fetchAll(PDO::FETCH_ASSOC);

    if($Count>0){
		foreach($Records as $comments){
			if(FiltersDecode($comments["Rating"]) == "1"){
				$RatingPic	=	"YildizBirDolu.png";
			}elseif(FiltersDecode($comments["Rating"]) == "2"){
				$RatingPic	=	"YildizIkiDolu.png";
			}elseif(FiltersDecode($comments["Rating"]) == "3"){
				$RatingPic	=	"YildizUcDolu.png";
			}elseif(FiltersDecode($comments["Rating"]) == "4"){
				$RatingPic	=	"YildizDortDolu.png";
			}elseif(FiltersDecode($comments["Rating"]) == "5"){
				$RatingPic	=	"YildizBesDolu.png";
			}
            ?>
    <tr>
        <td style="border-bottom: 1px dashed #CCCCCC;" valign="top">
            <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td colspan="3"><?php echo FiltersDecode($comments["CommentText"]); ?></td>
                </tr>
                <tr>
                    <td width="685"><img src="../Images/<?php echo $RatingPic ?>" border="0"></td>
                    <td width="10">&nbsp;</td>
                    <td width="55">
                        <table width="55" align="right" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="25" valign="top" align="left"><a href="index.php?PageCodeLog=0&PageCodeA=91&ID=<?php echo FiltersDecode($comments["id"]); ?>"><img src="../Images/Sil20x20.png" border="0" style="margin-top: 5px;"></a></td>
                                <td width="30" align="left"><a href="index.php?PageCodeLog=0&PageCodeA=91&ID=<?php echo FiltersDecode($comments["id"]); ?>" style="color: #FF0000; text-decoration: none;">Delete</a></td>
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
            <td>
                <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="750">None Comment.</td>
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
