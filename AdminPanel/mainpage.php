<?php
if(isset($_SESSION["Admin"])){
?>
<table width="1065" height="100%" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr height="100%">
        <td width="300" align="center" bgcolor="#001d26" valign="top">
            <table width="300" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr height="70">
                    <td align="center"><a href="index.php?PageCodeLog=0&PageCodeA=0"><img width="200" height="200" src="../Images/logo2.png" border="0"></a></td>
                </tr>
                <tr height="50">
                    <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="MainPages"><a href="index.php?PageCodeLog=0&PageCodeA=106">&nbsp;ORDERS</a></td>
                </tr>
                <tr height="50">
                    <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="MainPages"><a href="index.php?PageCodeLog=0&PageCodeA=94">&nbsp;ITEMS</a></td>
                </tr>
                <tr height="50">
                    <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="MainPages"><a href="index.php?PageCodeLog=0&PageCodeA=82">&nbsp;MEMBERS</a></td>
                </tr>
                <tr height="50">
                    <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="MainPages"><a href="index.php?PageCodeLog=0&PageCodeA=90">&nbsp;COMMENTS</a></td>
                </tr>
                <tr height="50">
                    <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="MainPages"><a href="index.php?PageCodeLog=0&PageCodeA=1">&nbsp;SITE SETTINGS</a></td>
                </tr>
                <tr height="50">
                    <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="MainPages"><a href="index.php?PageCodeLog=0&PageCodeA=57">&nbsp;MENUS</a></td>
                </tr>
                <tr height="50">
                    <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="MainPages"><a href="index.php?PageCodeLog=0&PageCodeA=9">&nbsp;BANK ACCOUNTS</a></td>
                </tr>
                <tr height="50">
                    <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="MainPages"><a href="index.php?PageCodeLog=0&PageCodeA=5">&nbsp;CONTRACTS AND TEXTS</a></td>
                </tr>
                <tr height="50">
                    <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="MainPages"><a href="index.php?PageCodeLog=0&PageCodeA=21">&nbsp;SHIPPING SETTINGS</a></td>
                </tr>
                <tr height="50">
                    <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="MainPages"><a href="index.php?PageCodeLog=0&PageCodeA=33">&nbsp;BANNER SETTINGS</a></td>
                </tr>
                <tr height="50">
                    <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="MainPages"><a href="index.php?PageCodeLog=0&PageCodeA=45">&nbsp;SUPPORT CONTENT</a></td>
                </tr>
                <tr height="50">
                    <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="MainPages"><a href="index.php?PageCodeLog=0&PageCodeA=69">&nbsp;ADMINS</a></td>
                </tr>
                <tr height="50">
                    <td align="left" style="border-bottom: 1px dashed #00c8ff;" class="MainPages"><a href="index.php?PageCodeLog=4">&nbsp;SIGN OUT</a></td>
                </tr>
            </table>
        </td>
        <td width="5" align="center" bgcolor="#FF0000" valign="top">&nbsp;</td>
        <td width="760" align="center" valign="top">
            <?php
            if((!$PageCodeAdminValues) or ($PageCodeAdminValues=="") or ($PageCodeAdminValues==0)){
                include($PageA[0]);
            }else{
                include($PageA[$PageCodeAdminValues]);
            }
            ?></td>
    </tr>
</table>
<?php
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>