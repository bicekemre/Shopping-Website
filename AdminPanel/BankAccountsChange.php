<?php
if(isset($_SESSION["Admin"])){
    if(isset($_GET["ID"])){
        $IncomingID			=	Safety($_GET["ID"]);
    }else{
        $IncomingID			=	"";
    }

    $Query	=	$DatabaseConnect->prepare("SELECT * FROM bankaccounts WHERE id = ? LIMIT 1");
    $Query->execute([$IncomingID]);
    $Count		=	$Query->rowCount();
    $Records	=	$Query->fetch(PDO::FETCH_ASSOC);

    if($Count>0){
?>
<form action="index.php?PageCodeLog=0&PageCodeA=15&ID=<?php echo FiltersDecode($IncomingID); ?>" method="post" enctype="multipart/form-data">
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFFFFF;" align="left"><h3>&nbsp; BANK ACCOUNTS</h3></td>
            <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?PageCodeLog=0&PageCodeA=10" style="color: #FFFFFF; text-decoration: none;">ADD BANK ACCOUNTS&nbsp;</a></td>
        </tr>
        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
                <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td>BankLogo</td>
                        <td>:</td>
                        <td><input type="file" name="BankLogo"></td>
                    </tr>
                    <tr height="40">
                        <td width="230">Bank Name</td>
                        <td width="20">:</td>
                        <td width="500"><input type="text" name="BankName" value="<?php echo FiltersDecode($Records["BankName"]); ?>" class="InputArea"></td>
                    </tr>
                    <tr height="40">
                        <td width="230">City</td>
                        <td width="20">:</td>
                        <td width="500"><input type="text" name="City" value="<?php echo FiltersDecode($Records["City"]); ?>" class="InputArea"></td>
                    </tr>
                    <tr height="40">
                        <td width="230">Country</td>
                        <td width="20">:</td>
                        <td width="500"><input type="text" name="Country" value="<?php echo FiltersDecode($Records["Country"]); ?>" class="InputArea"></td>
                    </tr>
                    <tr height="40">
                        <td width="230">currency</td>
                        <td width="20">:</td>
                        <td width="500"><input type="text" name="currency" value="<?php echo FiltersDecode($Records["currency"]); ?>" class="InputArea"></td>
                    </tr>
                    <tr height="40">
                        <td width="230">Account Holder</td>
                        <td width="20">:</td>
                        <td width="500"><input type="text" name="AccountHolder" value="<?php echo FiltersDecode($Records["AccountHolder"]); ?>" class="InputArea"></td>
                    </tr>
                    <tr height="40">
                        <td width="230">Account Nu</td>
                        <td width="20">:</td>
                        <td width="500"><input type="text" name="AccountNu" value="<?php echo FiltersDecode($Records["AccountNu"]); ?>" class="InputArea"></td>
                    </tr>
                    <tr height="40">
                        <td width="230">IBAN</td>
                        <td width="20">:</td>
                        <td width="500"><input type="text" name="IBAN" value="<?php echo FiltersDecode($Records["IBAN"]); ?>" class="InputArea"></td>
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
        header("Location:index.php?PageCodeLog=0&PageCodeA=17");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>