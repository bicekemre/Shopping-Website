<?php
session_start(); ob_start();
require_once("../Settings/setting.php");
require_once("../Settings/function.php");
require_once("../Frameworks/Verot/src/class.upload.php");
require_once("../Settings/adminpages.php");
require_once("../Settings/adminpagesLogin.php");


if(isset($_REQUEST["PageCodeLog"])){
    $PageCodeLoginValues	=  NumbersFilter($_REQUEST["PageCodeLog"]);
}else{
    $PageCodeLoginValues	=	0;
}

if(isset($_REQUEST["PageCodeA"])){
    $PageCodeAdminValues	=  NumbersFilter($_REQUEST["PageCodeA"]);
}else{
    $PageCodeAdminValues	=	0;
}

if(isset($_REQUEST["Page"])){
    $Pagination			=	NumbersFilter($_REQUEST["Page"]);
}else{
    $Pagination			=	1;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Language" content="en">
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow, noarchive">
    <meta name="googlebot" content="noindex, nofollow, noarchive">
    <title><?php echo FiltersDecode($SiteTitle); ?></title>
    <link type="image/png" rel="icon" href="../Images/favicon.ico">
    <script type="text/javascript" src="../Frameworks/jQuery/jquery-3.6.0.min.js" lang="javascript"></script>
    <link type="text/css" rel="stylesheet" href="../Settings/adminstyle.css">
    <script type="text/javascript" src="../Settings/function.js" lang="javascript"></script>
</head>
<body>
<table width="1065" height="100%" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr height="100%">
        <td align="center"><?php
            if(empty($_SESSION["Admin"])){
                if((!$PageCodeLoginValues) or ($PageCodeLoginValues=="") or ($PageCodeLoginValues==0)){
                    include($PageLog[1]);
                }else{
                    include($PageLog[$PageCodeLoginValues]);
                }
            }else{
                if((!$PageCodeLoginValues) or ($PageCodeLoginValues=="") or ($PageCodeLoginValues==0)){
                    include($PageLog[0]);
                }else{
                    include($PageLog[$PageCodeLoginValues]);
                }
            }
            ?></td>
    </tr>
</table>
</body>
</html>
<?php
$DatabaseConnect    =   null;
ob_end_flush();
?>