<?php
if(isset($_SESSION["Admin"])){
    ?>
    <form action="index.php?PageCodeLog=0&PageCodeA=23" method="post" enctype="multipart/form-data">
        <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr height="70">
                <td width="560" bgcolor="#FF9900" style="color: #FFFFFF;" align="left"><h3>&nbsp;SHIPPING SETTINGS</h3></td>
                <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?PageCodeLog=0&PageCodeA=10" style="color: #FFFFFF; text-decoration: none;">Add Cargo Company&nbsp;</a></td>
            </tr>
            <tr height="10">
                <td colspan="2" style="font-size: 10px;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">
                    <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                        <tr height="40">
                            <td>Cargo Company Logo</td>
                            <td>:</td>
                            <td><input type="file" name="CargoLogo"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Cargo Company Name</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="CargoCompanyName" class="InputArea"></td>
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