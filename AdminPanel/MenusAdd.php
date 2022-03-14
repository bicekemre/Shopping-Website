<?php
if(isset($_SESSION["Admin"])){
?>
<form action="index.php?PageCodeLog=0&PageCodeA=59" method="post">
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFFFFF;" align="left"><h3>&nbsp;  MENUS</h3></td>
            <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?PageCodeLog=0&PageCodeA=58" style="color: #FFFFFF; text-decoration: none;">Add  MENU&nbsp;</a></td>
        </tr>
        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr><tr>
            <td colspan="2">
                <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td width="230">Item Type</td>
                        <td width="20">:</td>
                        <td width="500"><select name="ItemType" class="SelectArea">
                                <option value="">Choice</option>
                                <option value="Phone">Phone</option>
                                <option value="Computer">Computer</option>
                            </select>
                        </td>
                    </tr>
                    <tr height="40">
                        <td width="230">Menu Name</td>
                        <td width="20">:</td>
                        <td width="500"><input type="text" name="MenuName" class="InputArea"></td>
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
