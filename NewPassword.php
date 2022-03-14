<?php

if(isset($_GET["ActivationCode"])){
    $IncomeingActivationCode	=	Safety($_GET["ActivationCode"]);
}else{
    $IncomeingActivationCode	=	"";
}
if(isset($_GET["EmailAddress"])){
    $IncomeingEmail				=	Safety($_GET["EmailAddress"]);
}else{
    $IncomeingEmail				=	"";
}

if(($IncomeingActivationCode!="") and ($IncomeingEmail!="")){
$ControlQuery		=	$DatabaseConnect->prepare("SELECT * FROM members WHERE EmailAddress = ? AND ActivationCode = ?");
$ControlQuery->execute([$IncomeingEmail, $IncomeingActivationCode]);
$UserCount	=	$ControlQuery->rowCount();
$UserRegis		=	$ControlQuery->fetch(PDO::FETCH_ASSOC);


if($UserCount>0){
?>






<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr height="40" bgcolor="#b8860b">
        <td colspan="2" width="1065" align="center" style="color: black"><h3>Reset Password</h3></td>
    </tr>
    <tr>
        <td width="450" valign="top">
            <form action="index.php?PageCode=39&EmailAddress=<?php echo $IncomeingEmail; ?>&ActivationCode=<?php echo $IncomeingActivationCode; ?>" method="post">
                <table width="500" align="center" border="0" cellpadding="0" cellspacing="0">

                    <tr height="30">
                        <td colspan="2" align="center" valign="top" style="border-bottom: 1px dashed #CCCCCC;"><h4>You can Reset your Password</h4></td>
                    </tr>
                    <tr height="30">
                        <td colspan="2" align="center" valign="bottom" >New Password (*)</td>
                    </tr>
                    <tr height="30">
                        <td colspan="2" valign="top" align="center"><input type="password" name="Password" class="InputArea"></td>
                    </tr>
                    <tr height="30">
                        <td colspan="2" align="center" valign="bottom" >New Password (*)</td>
                    </tr>
                    <tr height="30">
                        <td colspan="2" valign="top" align="center"><input type="password" name="Password" class="InputArea"></td>
                    </tr>
                    <tr height="40">
                        <td colspan="2" align="center"><input type="submit" value="Reset" class="LoginButton"></td>
                    </tr>
                </table>
            </form>
        </td>

        <td width="20">&nbsp;</td>

</table>
    <?php
}else{
    header("Location:index.php");
    exit();
}
}else{
    header("Location:index.php");
    exit();
}
?>