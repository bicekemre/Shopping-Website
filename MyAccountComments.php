<?php
if ($_SESSION["User"]){

    $RightandLeftButtonCountforPagination		=	2;
    $ViewingDataCountinperPage		            =	10;
    $Query				                        =	$DatabaseConnect->prepare("SELECT * FROM comments WHERE UserID = ? ORDER BY CommentDate DESC");
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
            <td style="color:black"><h3>My Account > Comments</h3></td>
        </tr>
        <tr height="30">
            <td valign="top" align="center" style="border-bottom: 1px dashed #CCCCCC;">You Can see your Comments.</td>
        </tr>
        <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr height="50">
                <td width="125" style="background: #f8ffa7; color: black;" align="left">&nbsp;Rating</td>
                <td width="75" style="background: #f8ffa7; color: black;" align="left">Comment&nbsp;</td>
            </tr>
            <?php
            $CommentQuery		    =	$DatabaseConnect->prepare("SELECT * FROM comments WHERE UserID = ? ORDER BY CommentDate DESC LIMIT $offset, $ViewingDataCountinperPage");
            $CommentQuery->execute([$UserID]);
            $CommentCount			=	$CommentQuery->rowCount();
            $CommentRecords 	        =	$CommentQuery->fetchAll(PDO::FETCH_ASSOC);

            if($CommentCount>0){
                foreach($CommentRecords as $Lines){
                    $Rating	=	$Lines["Rating"];
                    if($Rating==1){
                        $PicturePath	=	"YildizBirDolu.png";
                    }elseif($Rating==2){
                        $PicturePath	=	"YildizIkiDolu.png";
                    }elseif($Rating==3){
                        $PicturePath	=	"YildizUcDolu.png";
                    }elseif($Rating==4){
                        $PicturePath	=	"YildizDortDolu.png";
                    }elseif($Rating==5){
                        $PicturePath	=	"YildizBesDolu.png";
                    }
                    ?>
                    <tr>
                        <td width="85" align="left" style="border-bottom: 1px dashed #CCCCCC; padding: 15px 0px;" valign="top"><img src="Images/<?php echo $PicturePath; ?>" border="0"></td>
                        <td width="980" align="left" style="border-bottom: 1px dashed #CCCCCC; padding: 15px 0px;" valign="top"><?php echo Safety($Lines["CommentText"]); ?></td>
                    </tr>
                        <?php
                    }
                    ?>
                    <tr height="30">
                        <td colspan="8"><hr /></td>
                    </tr>
                    <?php

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
                }else{
                ?>
                <tr height="50">
                    <td colspan="8" align="left">You have not any comment</td>
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