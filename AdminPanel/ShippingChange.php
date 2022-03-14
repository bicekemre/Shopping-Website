<?php
if(isset($_SESSION["Admin"])){
if(isset($_GET["ID"])){
    $IncomingID			=	Safety($_GET["ID"]);
}else{
    $IncomingID			=	"";
}

$Query	=	$DatabaseConnect->prepare("SELECT * FROM cargocompanies WHERE id = ? LIMIT 1");
$Query->execute([$IncomingID]);
$Count		=	$Query->rowCount();
$Records	=	$Query->fetch(PDO::FETCH_ASSOC);

if($Count>0){
?>
<form action="index.php?PageCodeLog=0&PageCodeA=27&ID=<?php echo FiltersDecode($IncomingID); ?>" method="post" enctype="multipart/form-data">
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFFFFF;" align="left"><h3>&nbsp;  SHIPPING SETTINGS</h3></td>
            <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?PageCodeLog=0&PageCodeA=22" style="color: #FFFFFF; text-decoration: none;">ADD  SHIPPING&nbsp;</a></td>
        </tr>
        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
                <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td>Cargo Logo</td>
                        <td>:</td>
                        <td><input type="file" name="CargoLogo"></td>
                    </tr>
                    <tr height="40">
                        <td width="230">Cargo Company Name</td>
                        <td width="20">:</td>
                        <td width="500"><input type="text" name="CargoCompanyName" value="<?php echo FiltersDecode($Records["CargoCompanyName"]); ?>" class="InputArea"></td>
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
    header("Location:index.php?PageCodeLog=0&PageCodeA=29");
    exit();
}
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>