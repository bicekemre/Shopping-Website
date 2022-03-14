<?php
if(isset($_SESSION["User"])){
    if(isset($_GET["ItemID"])){
        $IncomingItemID	=	Safety($_GET["ItemID"]);
    }else{
        $IncomingItemID	=	"";
    }

    if($IncomingItemID!=""){
    ?>
    <table width="1065" align="center" bgcolor="#f0e68c" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="500" valign="top">
            <form action="index.php?PageCode=71&ItemID=<?php echo $IncomingItemID; ?>" method="post">
            <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr bgcolor="#b8860b" height="40">
                    <td align="center" style="color:black"><h3>My Account > Comment</h3></td>
                </tr>
                <tr height="30">
                    <td valign="top" align="center" style="border-bottom: 1px dashed #CCCCCC;">You Can Comment your orders.</td>
                </tr>
                <tr height="30">
                    <td valign="bottom" align="center">Rating (*)</td>
                </tr>
                <tr height="30">
                    <td valign="top" align="center"><table width="360" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="64"><img src="Images/YildizBirDolu.png" border="0"></td>
                                <td width="10">&nbsp;</td>
                                <td width="64"><img src="Images/YildizIkiDolu.png" border="0"></td>
                                <td width="10">&nbsp;</td>
                                <td width="64"><img src="Images/YildizUcDolu.png" border="0"></td>
                                <td width="10">&nbsp;</td>
                                <td width="64"><img src="Images/YildizDortDolu.png" border="0"></td>
                                <td width="10">&nbsp;</td>
                                <td width="64"><img src="Images/YildizBesDolu.png" border="0"></td>
                            </tr>
                            <tr>
                                <td width="64" align="center"><input type="radio" name="RatingPoint" value="1"></td>
                                <td width="10">&nbsp;</td>
                                <td width="64" align="center"><input type="radio" name="RatingPoint" value="2"></td>
                                <td width="10">&nbsp;</td>
                                <td width="64" align="center"><input type="radio" name="RatingPoint" value="3"></td>
                                <td width="10">&nbsp;</td>
                                <td width="64" align="center"><input type="radio" name="RatingPoint" value="4"></td>
                                <td width="10">&nbsp;</td>
                                <td width="64" align="center"><input type="radio" name="RatingPoint" value="5"></td>
                            </tr>
                        </table></td>
                </tr>
                <tr height="30">
                    <td valign="bottom" align="center">Comment (*)</td>
                </tr>
                <tr height="30">
                    <td valign="top" align="center"><textarea name="Comment" class="CommentTextArea"></textarea></td>
                </tr>
                <tr height="40">
                    <td colspan="2" align="center"><input type="submit" value="Send" class="SendButton"></td>
                </tr>
            </table>
        </form>
    </td>
    </td>
    </tr>
    </table>
    <?php
    }else{
        header("Location:index.php?PageCode=73");
        exit();
    }
}else{
    header("Location:index.php");
    exit();
}
?>