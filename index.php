<?php
session_start(); ob_start();
require_once ("Settings/setting.php");
require_once ("Settings/function.php");
require_once ("Settings/pages.php");

if(isset($_REQUEST["PageCode"])){
    $PageCodeValues	=  NumbersFilter($_REQUEST["PageCode"]);
}else{
    $PageCodeValues	=	0;
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
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="content-language" content="en">
<meta name="Robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<meta name="googlebot" content="index, follow">
<meta name="revist-after" content="7 Days">
<title><?php echo FiltersDecode($SiteTitle);?></title>
<meta name="description" content="<?php echo FiltersDecode($SiteDescription) ;?>">
<meta name="keywords" content="<?php echo FiltersDecode($SiteKeywords) ;?>">
<link type="text/css" rel="stylesheet" href="Settings/style.css">
<link type="image/ico" rel="icon" href="Images/favicon.ico">
<script type="text/javascript" src="Frameworks/jQuery/jquery-3.6.0.min.js" lang="JavaScript"></script>
<script type="text/javascript" src="Settings/function.js" lang="JavaScript"></script>
</head>
<body>
    <table width="1065" height="10" bgcolor="#f0e68c" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="40" align="center">
           <?php /* <td><img src="Images/" border="0"></td> */ ?>
        </tr>
        <tr height="110">
            <td>
                <table width="1065" height="30" bgcolor="#f0e68c" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr bgcolor="#b8860b">
                        <td>&nbsp;</td>
                        <?php
                        if (isset($_SESSION["User"])){
                        ?>
                            <td width="20"><a href="index.php?PageCode=45"><img src="Images/KullaniciBeyaz16x16.png" border="0" style="margin-top: 5px"></td></a>
                            <td class="WhiteText" width="100"><a href="index.php?PageCode=45">My Account</a></td>
                            <td width= "20"><a href="index.php?PageCode=44"><img src="Images/CikisBeyaz16x16.png" border="0" style="margin-top: 5px"></a></td>
                            <td class="WhiteText" width="85"><a href="index.php?PageCode=44">Sign Out</a></td>
                        <?php
                        }else{
                        ?>
                            <td width="20"><a href="index.php?PageCode=26"><img src="Images/KullaniciBeyaz16x16.png" border="0" style="margin-top: 5px"></td></a>
                            <td class="WhiteText" width="70"><a href="index.php?PageCode=26">Login</a></td>
                            <td width= "20"><a href="index.php?PageCode=17"><img src="Images/KullaniciEkleBeyaz16x16.png" border="0" style="margin-top: 5px"></a></td>
                            <td class="WhiteText" width="85"><a href="index.php?PageCode=17">Sign Up</a></td>
                        <?php } ?>
                            <td width="30"><a href="index.php?PageCode=87"><img src="Images/SepetBeyaz21x20.png" height="20" width="20" style="margin-top: 5px"></a></td>
                    </tr>
                </table>
                <table width="1065" height="80" bgcolor="#f0e68c" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td  width="192"><a href="index.php"><img width="100" src="Images/logo2.png"></a></td>
                        <td>
                            <table width="873" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="1200">&nbsp;</td>
                                    <td class="BlackText" width="200"><a href="index.php">Main Page</a></td>
                                    <td class="BlackText" width="160"><a href="index.php?PageCode=78">Phones</a></td>
                                    <td class="BlackText" width="120"><a href="index.php?PageCode=79">Computer</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>


        <tr>
            <td valign="top"><table width="1065" align="center" border="0"  cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center"><?php

                        if((!$PageCodeValues) or ($PageCodeValues=="") or ($PageCodeValues==0)){
                            include($Page[0]);
                        }else{
                            include($Page[$PageCodeValues]);
                        }
                        ?></td>
                </tr>
            </table></td>
        </tr>



        <tr>
            <table width="1065" align="center" bgcolor="#696969" border="0" cellpadding="0" cellspacing="0">
                <tr height="30">
                    <td width="250" style="border-bottom: 1px dashed #CCCCCC;">&nbsp;<b>Institutional</b></td>
                    <td width="22">&nbsp;</td>
                    <td width="250" style="border-bottom: 1px dashed #CCCCCC;"><b>Membership</b></td>
                    <td width="22">&nbsp;</td>
                    <td width="250" style="border-bottom: 1px dashed #CCCCCC;"><b>Contracts</b></td>
                    <td width="21">&nbsp;</td>
                    <td width="250" style="border-bottom: 1px dashed #CCCCCC;"><b>Follow Us</b></td>
                </tr>
                <tr height="30">
                    <td class="FooterMenu"><a href="index.php?PageCode=1">About us</a></td>
                    <td>&nbsp;</td>
                    <?php
                    if (isset($_SESSION["User"])){
                    ?>
                        <td class="FooterMenu"><a href="index.php?PageCode=index.php?PageCode=45">My Account</a></td>
                    <?php
                    }else{
                    ?>
                        <td class="FooterMenu"><a href="index.php?PageCode=26">Login</a></td>
                    <?php } ?>
                    <td>&nbsp;</td>
                    <td class="FooterMenu"><a href="index.php?PageCode=2">Membership Contracts</a></td>
                    <td>&nbsp;</td>
                    <td><table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="20"><a href="<?php echo FiltersDecode($Facebooklink); ?>"target="_blank"><img src="Images/Facebook16x16.png" border="0" style="margin-top: 5px;"></a></td>
                                <td class="FooterMenu" width="230"><a href="<?php echo FiltersDecode($Facebooklink); ?>" target="_blank">Facebook</a></td>
                            </tr>
                        </table></td>
                </tr>
                <tr height="30">
                    <td class="FooterMenu"><a href="index.php?PageCode=8">Bank accounts</a></td>
                    <td>&nbsp;</td>
                    <?php
                    if (isset($_SESSION["User"])){
                        ?>
                        <td class="FooterMenu"><a href="index.php?PageCode=44">Sign Out</a></td>
                        <?php
                    }else{
                        ?>
                        <td class="FooterMenu"><a href="index.php?PageCode=17">Sign Up</a></td>
                    <?php } ?>
                    <td>&nbsp;</td>
                    <td class="FooterMenu"><a href="index.php?PageCode=3">Terms of Use</a></td>
                    <td>&nbsp;</td>
                    <td><table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="20"><a href="<?php echo FiltersDecode($Twitterlink); ?>" target="_blank"><img src="Images/Twitter16x16.png" border="0" style="margin-top: 5px;"></a></td>
                                <td class="FooterMenu" width="230"><a href="<?php echo FiltersDecode($Twitterlink); ?>" target="_blank">Twitter</a></td>
                            </tr>
                        </table></td>
                </tr>
                <tr height="30">
                    <td class="FooterMenu"><a href="index.php?PageCode=9">Where is my cargo</a></td>
                    <td>&nbsp;</td>
                    <td class="FooterMenu"><a href="index.php?PageCode=16">Questions</a></td>
                    <td>&nbsp;</td>
                    <td class="FooterMenu"><a href="index.php?PageCode=4">Privacy Policy</a></td>
                    <td>&nbsp;</td>
                    <td><table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="20"><a href="<?php echo FiltersDecode($Linkedlnlink); ?>" target="_blank"><img src="Images/LinkedIn16x16.png" border="0" style="margin-top: 5px;"></td>
                                <td class="FooterMenu" width="230" ><a href="<?php echo FiltersDecode($Linkedlnlink); ?>" target="_blank">LinkedIn</a></td>
                            </tr>
                        </table></td>
                </tr>
                <tr height="30">
                    <td class="FooterMenu"><a href="index.php?PageCode=11">Contact</a></td>
                    <td>&nbsp;</td>
                    <td></td>
                    <td>&nbsp;</td>
                    <td class="FooterMenu"><a href="index.php?PageCode=5">Distance Sales Agreement</a></td>
                    <td>&nbsp;</td>
                    <td><table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="20"><a href="<?php echo FiltersDecode($Instagramlink); ?>" target="_blank"><img src="Images/Instagram16x16.png" border="0" style="margin-top: 5px;"></a></td>
                                <td class="FooterMenu" width="230"><a href="<?php echo FiltersDecode($Instagramlink); ?>" target="_blank">Instagram</a></td>
                            </tr>
                        </table></td>
                </tr>
                <tr height="30">
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td></td>
                    <td>&nbsp;</td>
                    <td class="FooterMenu"><a href="index.php?PageCode=6">Delivery</a></td>
                    <td>&nbsp;</td>
                    <td><table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="20"><a href="<?php echo FiltersDecode($Pinterestlink); ?>" target="_blank"><img src="Images/Pinterest16x16.png" border="0" style="margin-top: 5px;"></a></td>
                                <td class="FooterMenu" width="230"><a href="<?php echo FiltersDecode($Pinterestlink); ?>" target="_blank">Pinterest</a></td>
                            </tr>
                        </table></td>
                </tr>
                <tr height="30">
                    <td></td>
                    <td>&nbsp;</td>
                    <td></td>
                    <td>&nbsp;</td>
                    <td class="FooterMenu"><a href="index.php?PageCode=7">Returns & Replacements</a></td>
                    <td>&nbsp;</td>
                    <td><table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="20"><a href="<?php echo FiltersDecode($YouTubelink); ?>" target="_blank"><img src="Images/YouTube16x16.png" border="0" style="margin-top: 5px;"></a></td>
                                <td class="FooterMenu" width="230"><a href="<?php echo FiltersDecode($YouTubelink); ?>" target="_blank">YouTube</a></td>
                            </tr>
                        </table></td>
                </tr>
            </table></td>
        </tr>
        <tr height="30">
            <td><table width="1065" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="center"><?php echo $SiteCopyright; ?></td>
                    </tr>
                </table></td>
        </tr>

        <tr height="30">
            <td><table width="1065" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="center"><img src="Images/RapidSSL32x12.png" border="0" style="margin-right: 5px;"><img src="Images/InternetteGuvenliAlisveris28x12.png" border="0" style="margin-right: 5px;"><img src="Images/3DSecure14x12.png" border="0" style="margin-right: 5px;"><img src="Images/BonusCard41x12.png" border="0" style="margin-right: 5px;"><img src="Images/MaximumCard46x12.png" border="0" style="margin-right: 5px;"><img src="Images/WorldCard48x12.png" border="0" style="margin-right: 5px;"><img src="Images/CardFinans78x12.png" border="0" style="margin-right: 5px;"><img src="Images/AxessCard46x12.png" border="0" style="margin-right: 5px;"><img src="Images/ParafCard19x12.png" border="0" style="margin-right: 5px;"><img src="Images/VisaCard37x12.png" border="0" style="margin-right: 5px;"><img src="Images/MasterCard21x12.png" border="0" style="margin-right: 5px;"><img src="Images/AmericanExpiress20x12.png" border="0"></td>
                    </tr>
                </table></td>
        </tr>
    </table>
</body>
</html>
<?php
$DatabaseConnect    =   null;
ob_end_flush();
?>