<?php
if(isset($_SESSION["Admin"])){
    ?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFFFFF;" align="left"><h3>&nbsp; BANK ACCOUNTS</h3></td>
            <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?PageCodeLog=0&PageCodeA=10" style="color: #FFFFFF; text-decoration: none;">ADD BANK ACCOUNTS&nbsp;</a></td>
        </tr>
        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>
        <?php
        $Query		=	$DatabaseConnect->prepare("SELECT * FROM bankaccounts ORDER BY BankName ASC");
        $Query->execute();
        $Count			=	$Query->rowCount();
        $Records		=	$Query->fetchAll(PDO::FETCH_ASSOC);

        if($Count>0){
            foreach($Records as $Accounts){
                ?>
                <tr height="105">
                    <td colspan="2" style="border-bottom: 1px dashed #CCCCCC;" valign="top">
                        <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="200">
                                    <table width="200" align="right" border="0" cellpadding="0" cellspacing="0">
                                        <tr height="75">
                                            <td><img src="../Images/<?php echo FiltersDecode($Accounts["BankLogo"]); ?>" border="0"></td>
                                        </tr>
                                        <tr height="30">
                                            <td align="left">
                                                <table width="200" align="right" border="0" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="25" valign="top"><a href="index.php?PageCodeLog=0&PageCodeA=14&ID=<?php echo FiltersDecode($Accounts["id"]); ?>"><img src="../Images/Guncelleme20x20.png" border="0"></a></td>
                                                        <td width="70" valign="top"><a href="index.php?PageCodeLog=0&PageCodeA=14&ID=<?php echo FiltersDecode($Accounts["id"]); ?>" style="color: #0000FF; text-decoration: none;">Change</a></td>
                                                        <td width="25" valign="top"><a href="index.php?PageCodeLog=0&PageCodeA=18&ID=<?php echo FiltersDecode($Accounts["id"]); ?>"><img src="../Images/Sil20x20.png" border="0"></a></td>
                                                        <td width="80" valign="top"><a href="index.php?PageCodeLog=0&PageCodeA=18&ID=<?php echo FiltersDecode($Accounts["id"]); ?>" style="color: #FF0000; text-decoration: none;">Delete</a></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table></td>
                                <td width="10">&nbsp;</td>
                                <td width="540">
                                    <table width="540" align="right" border="0" cellpadding="0" cellspacing="0">
                                        <tr height="90">
                                            <td>
                                                <table width="540" align="right" border="0" cellpadding="0" cellspacing="0">
                                                    <tr height="35">
                                                        <td>
                                                            <table width="540" align="right" border="0" cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td width="100"><b>Bank Name</b></td>
                                                                    <td width="20"><b>:</b></td>
                                                                    <td width="140"><?php echo FiltersDecode($Accounts["BankName"]); ?></td>
                                                                    <td width="115"><b>Account Holder</b></td>
                                                                    <td width="20"><b>:</b></td>
                                                                    <td width="145"><?php echo FiltersDecode($Accounts["AccountHolder"]); ?></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr height="35">
                                                        <td>
                                                            <table width="540" align="right" border="0" cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td width="80"><b>Location</b></td>
                                                                    <td width="20"><b>:</b></td>
                                                                    <td width="340"><?php echo FiltersDecode($Accounts["City"]); ?> / <?php echo FiltersDecode($Accounts["Country"]); ?></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr height="35">
                                                        <td>
                                                            <table width="540" align="right" border="0" cellpadding="0" cellspacing="0">
                                                                <tr>
                                                                    <td width="110"><b>Account Info</b></td>
                                                                    <td width="20"><b>:</b></td>
                                                                    <td width="410"><?php echo FiltersDecode($Accounts["currency"]); ?> / <?php echo FiltersDecode($Accounts["AccountNu"]); ?> / <?php echo FiltersDecode($Accounts["IBAN"]); ?></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php
            }
        }else{
            ?>
            <tr>
                <td colspan="2">
                    <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="750">None Bank Accounts</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}else{
    header("Location:index.php?PageCodeLOG=1");
    exit();
}
?>
