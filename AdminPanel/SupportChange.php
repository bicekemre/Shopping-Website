<?php
if(isset($_SESSION["Admin"])){
    if(isset($_GET["ID"])){
        $IncomingID			=	Safety($_GET["ID"]);
    }else{
        $IncomingID			=	"";
    }
    $Query = $DatabaseConnect->prepare("SELECT * FROM questions WHERE  id = ? LIMIT 1");
    $Query->execute([$IncomingID]);
    $Count = $Query->rowCount();
    $Records		=	$Query->fetch(PDO::FETCH_ASSOC);

    if($Count>0){
        ?>
        <form action="index.php?PageCodeLog=0&PageCodeA=51&ID=<?php echo FiltersDecode($IncomingID); ?>" method="post">
            <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr height="70">
                    <td width="560" bgcolor="#FF9900" style="color: #FFFFFF;" align="left"><h3>&nbsp;SUPPORT CONTENT</h3></td>
                    <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?PageCodeLog=0&PageCodeA=46" style="color: #FFFFFF; text-decoration: none;">Add SUPPORT CONTENT&nbsp;</a></td>
                </tr>
                <tr height="10">
                    <td colspan="2" style="font-size: 10px;">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                            <tr height="40">
                                <td width="230">question</td>
                                <td width="20">:</td>
                                <td width="500"><input type="text" name="question" class="InputArea" value="<?php echo FiltersDecode($Records["question"]); ?>"></td>
                            </tr>
                            <tr>
                                <td width="230" valign="top">answer</td>
                                <td width="20" valign="top">:</td>
                                <td width="500"><textarea name="answer" class="TextArea"><?php echo FiltersDecode($Records["answer"]); ?></textarea></td>
                            </tr>
                            <tr height="40">
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><input type="submit" value="Save" class="SaveButton"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </form>
        <?php
    }else{
        header("Location:index.php?PageCodeLog=0&PageCodeA=41");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>