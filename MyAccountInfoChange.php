<?php
if(isset($_SESSION["User"])){
?>
<table width="1065" align="center" bgcolor="#f0e68c" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="500" valign="top">
            <form action="index.php?PageCode=47" method="post">
                <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr bgcolor="#b8860b" height="40">
                        <td align="center" style="color:black"><h3>My Account > Account Information</h3></td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="center" style="border-bottom: 1px dashed #CCCCCC;">You Can see and change your account information.</td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom" align="center"E-mail Address (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="center"><input type="mail" name="EmailAddress" class="InputArea" value="<?php echo $UserEmailAddress; ?>"></td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom" align="center">Password (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="center"><input type="password" name="Password" class="InputArea" value="OldPassword"></td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom" align="center">Password Again (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="center"><input type="password" name="PasswordAgain" class="InputArea" value="OldPassword"></td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom" align="center">Name Surname (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="center"><input type="text" name="NameSurname" class="InputArea" value="<?php echo $UserNameSurname; ?>"></td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom" align="center">Phone Number (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="center"><input type="text" name="PhoneNumber" maxlength="11" class="InputArea" value="<?php echo $UserPhoneNumber; ?>"></td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom" align="center">Gender (*)</td>
                    </tr>
                    <tr height="30">
                        <td valign="top" align="center"><select name="Gender" class="SelectArea">
                                <option value="Male" <?php if($UserGender=="Male"){ ?>selected="selected"<?php } ?>>Male</option>
                                <option value="Female" <?php if($UserGender=="Female"){ ?>selected="selected"<?php } ?>>Female</option>
                            </select></td>
                    </tr>
                    <tr height="40">
                        <td colspan="2" align="center"><input type="submit" value="Change" class="ChangeButton"></td>
                    </tr>
                </table>
            </form>
        </td>
    <?php
}else{
    header("Location:index.php");
    exit();
}
?>