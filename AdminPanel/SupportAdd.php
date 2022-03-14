<?php
if(isset($_SESSION["Admin"])){
    ?>
    <form action="index.php?PageCodeLog=0&PageCodeA=47" method="post" enctype="multipart/form-data">
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
                            <td>question</td>
                            <td>:</td>
                            <td><input type="file" name="question"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">answer</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="answer" class="InputArea"></td>
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
    header("Location:index.php?PageCodeLOG=1");
    exit();
}
?>
