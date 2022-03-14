<?php
if(isset($_SESSION["User"])){
    ?>
    <table width="1065" bgcolor="#f0e68c" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="500" valign="top">
                <form action="index.php?PageCode=66" method="post">
                    <table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr height="40">
                            <td style="color:black"><h3>My Account > Addresses</h3></td>
                        </tr>
                        <tr height="30">
                            <td valign="top" style="border-bottom: 1px dashed #CCCCCC;">You Can see and change your Addresses.</td>
                        </tr>
                        <tr height="30">
                            <td valign="bottom" align="left">Name Surname (*)</td>
                        </tr>
                        <tr height="30">
                            <td valign="top" align="left"><input type="text" name="NameSurname" class="InputArea"></td>
                        </tr>
                        <tr height="30">
                            <td valign="bottom" align="left">Address (*)</td>
                        </tr>
                        <tr height="30">
                            <td valign="top" align="left"><input type="text" name="Address" class="InputArea"></td>
                        </tr>
                        <tr height="30">
                            <td valign="bottom" align="left">District (*)</td>
                        </tr>
                        <tr height="30">
                            <td valign="top" align="left"><input type="text" name="District" class="InputArea"></td>
                        </tr>
                        <tr height="30">
                            <td valign="bottom" align="left">City (*)</td>
                        </tr>
                        <tr height="30">
                            <td valign="top" align="left"><input type="text" name="City" class="InputArea"></td>
                        </tr>
                        <tr height="30">
                            <td valign="bottom" align="left">Phone Number (*)</td>
                        </tr>
                        <tr height="30">
                            <td valign="top" align="left"><input type="text" name="PhoneNumber" maxlength="11" class="InputArea"></td>
                        </tr>
                        <tr height="40">
                            <td colspan="2" align="center"><input type="submit" value="Save" class="SaveButton"></td>
                        </tr>
                    </table>
                </form>
            </td>
    </table>
    <?php
}else{
    header("Location:index.php");
    exit();
}
?>