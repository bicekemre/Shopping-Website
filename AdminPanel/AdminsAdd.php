<?php
if(isset($_SESSION["Admin"])){
?>
<form action="index.php?PageCodeLog=0&PageCodeA=71" method="post" enctype="multipart/form-data">
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFFFFF;" align="left"><h3>&nbsp; ADMINS</h3></td>
            <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?PageCodeLog=0&PageCodeA=70" style="color: #FFFFFF; text-decoration: none;">ADD ADMINS&nbsp;</a></td>
        </tr>
        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr><tr>
            <td colspan="2">
                <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td width="230">Admin Name</td>
                        <td width="20">:</td>
                        <td width="500"><input type="text" name="AdminName" class="InputArea"></td>
                    </tr>
                    <tr height="40">
                        <td width="230">Password</td>
                        <td width="20">:</td>
                        <td width="500"><input type="text" name="Password" class="InputArea"></td>
                    </tr>
                    <tr height="40">
                        <td width="230">Name Surname</td>
                        <td width="20">:</td>
                        <td width="500"><input type="text" name="NameSurname" class="InputArea"></td>
                    </tr>
                    <tr height="40">
                        <td width="230">Email</td>
                        <td width="20">:</td>
                        <td width="500"><input type="email" name="Email" class="InputArea"></td>
                    </tr>
                    <tr>
                        <td width="230" valign="top">Phone</td>
                        <td width="20" valign="top">:</td>
                        <td width="500"><input type="text" name="Phone" class="InputArea" maxlength="11"></td>
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
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>