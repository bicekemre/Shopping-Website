<?php
if(isset($_SESSION["Admin"])){
?>
<table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr height="70">
        <td width="560" bgcolor="#FF9900" style="color: #FFFFFF;" align="left"><h3>&nbsp; SHIPPING SETTINGS</h3></td>
        <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?PageCodeLog=0&PageCodeA=22" style="color: #FFFFFF; text-decoration: none;">Add Cargo Company&nbsp;</a></td>
    </tr>
    <tr height="10">
        <td colspan="2" style="font-size: 10px;">&nbsp;</td>
    </tr>
    <?php
    $Query		=	$DatabaseConnect->prepare("SELECT * FROM cargocompanies ORDER BY CargoCompanyName ASC");
    $Query->execute();
    $Count			=	$Query->rowCount();
    $Records		=	$Query->fetchAll(PDO::FETCH_ASSOC);

    if($Count>0){
        foreach($Records as $Cargos){
            ?>
            <tr height="50">
                <td colspan="2" style="border-bottom: 1px dashed #CCCCCC;" valign="top">
                    <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                        <tr height="50">
                            <td width="200" align="left"><img src="../Images/<?php echo FiltersDecode($Cargos["CargoLogo"]); ?>" border="0"></td>
                            <td width="10" align="left">&nbsp;</td>
                            <td width="150" align="left"><b>Cargo Company Name</b></td>
                            <td width="20" align="left"><b>:</b></td>
                            <td width="210" align="left"><?php echo FiltersDecode($Cargos["CargoCompanyName"]); ?></td>
                            <td width="10" align="left">&nbsp;</td>
                            <td width="25" valign="top" align="left"><a href="index.php?PageCodeLog=0&PageCodeA=26&ID=<?php echo FiltersDecode($Cargos["id"]); ?>"><img src="../Images/Guncelleme20x20.png" border="0" style="margin-top: 15px;"></a></td>
                            <td width="70" align="left"><a href="index.php?PageCodeLog=0&PageCodeA=26&ID=<?php echo FiltersDecode($Cargos["id"]); ?>" style="color: #0000FF; text-decoration: none;">Change</a></td>
                            <td width="25" valign="top" align="left"><a href="index.php?PageCodeLog=0&PageCodeA=30&ID=<?php echo FiltersDecode($Cargos["id"]); ?>"><img src="../Images/Sil20x20.png" border="0" style="margin-top: 15px;"></a></td>
                            <td width="30" align="left"><a href="index.php?PageCodeLog=0&PageCodeA=30&ID=<?php echo FiltersDecode($Cargos["id"]); ?>" style="color: #FF0000; text-decoration: none;">Delete</a></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <?php
        }
    }else{
        ?>
        <tr>
            <td colspan="2"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="750">None Cargo Companies.</td>
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
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>