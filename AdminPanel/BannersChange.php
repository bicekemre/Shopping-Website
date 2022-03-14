<?php
if(isset($_SESSION["Admin"])){
    if(isset($_GET["ID"])){
        $IncomingID			=	Safety($_GET["ID"]);
    }else{
        $IncomingID			=	"";
    }

    $Query = $DatabaseConnect->prepare("SELECT * FROM banners WHERE  id = ? LIMIT 1");
    $Query->execute([$IncomingID]);
    $Count = $Query->rowCount();
    $Records		=	$Query->fetch(PDO::FETCH_ASSOC);

    if($Count>0){
?>
<form action="index.php?PageCodeLOG=0&PageCodeA=39&ID=<?php echo FiltersDecode($IncomingID); ?>" method="post" enctype="multipart/form-data">
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFFFFF;" align="left"><h3>&nbsp;BANNER SETTINGS</h3></td>
            <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?PageCodeLOG=0&PageCodeA=34" style="color: #FFFFFF; text-decoration: none;">Add BANNER&nbsp;</a></td>
        </tr>
        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td width="230">Banner Area</td>
                        <td width="20">:</td>
                        <td width="500"><select name="BannerArea" class="SelectArea">
                                <option value="Ana Sayfa" <?php if(FiltersDecode($Records["BannerArea"]) == "Main Page"){ ?>selected="selected"<?php } ?>>Main Page</option>
                                <option value="Menu Altı" <?php if(FiltersDecode($Records["BannerArea"]) == "Under Menu"){ ?>selected="selected"<?php } ?>>Under Menu</option>
                                <option value="Ürün Detay" <?php if(FiltersDecode($Records["BannerArea"]) == "Item Details"){ ?>selected="selected"<?php } ?>>Item Details</option>
                            </select></td>
                    </tr>
                    <tr height="40">
                        <td>Banner Picture</td>
                        <td>:</td>
                        <td><input type="file" name="BannerPicture"></td>
                    </tr>
                    <tr height="40">
                        <td width="230">Banner Name</td>
                        <td width="20">:</td>
                        <td width="500"><input type="text" name="BannerName" class="InputArea" value="<?php echo FiltersDecode($Records["BannerName"]); ?>"></td>
                    </tr>
                    <tr height="40">
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="Save" class="SaveButton"></td>
                    </tr>
                </table></td>
        </tr>
    </table>
</form>
<?php
    }else{
        header("Location:index.php?PageCodeLOG=0&PageCodeA=41");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLOG=1");
    exit();
}
?>
