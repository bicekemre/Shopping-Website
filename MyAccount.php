<?php
if ($_SESSION["User"]){
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
        <table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr height="40">
                <td style="color:black"><h3>My Account > Account Information</h3></td>
            </tr>
            <tr height="30">
                <td valign="top" style="border-bottom: 1px dashed #CCCCCC;">You Can see and change your account information.</td>
            </tr>
            <tr height="30">
                <td valign="bottom" align="left"><b>Name Surname</b></td>
            </tr>
            <tr height="30">
                <td valign="top" align="left"><?php echo $UserNameSurname; ?></td>
            </tr>
            <tr height="30">
                <td valign="bottom" align="left"><b>Gender</b></td>
            </tr>
            <tr height="30">
                <td valign="top" align="left"><?php echo $UserGender; ?></td>
            </tr>
            <tr height="30">
                <td valign="bottom" align="left"><b>E-Mail Address</b></td>
            </tr>
            <tr height="30">
                <td valign="top" align="left"><?php echo $UserEmailAddress; ?></td>
            </tr>
            <tr height="30">
                <td valign="bottom" align="left"><b>Phone Number</b></td>
            </tr>
            <tr height="30">
                <td valign="top" align="left"><?php echo $UserPhoneNumber; ?></td>
            </tr>
            <tr height="30">
                <td valign="bottom" align="left"><b>Regis Date</b></td>
            </tr>
            <tr height="30">
                <td valign="top" align="left"><?php echo DateFilter($UserRegisDate); ?></td>
            </tr>
            <tr height="30">
                <td valign="bottom" align="left"><b>Regis IP</b></td>
            </tr>
            <tr height="30">
                <td valign="top" align="left"><?php echo $UserRegisIPaddress; ?></td>
            </tr>
            <tr height="30">
                <td align="center"><a href="index.php?PageCode=46" class="ChangeButton">Change</a></td>
            </tr>
        </table>
    </td>
    <?php
}else{
    header("Location:index.php");
    exit();
}
?>