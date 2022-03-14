<?php
if(isset($_SESSION["Admin"])){
    ?>
    <form action="index.php?PageCodeLog=0&PageCodeA=2" method="post" enctype="multipart/form-data">
        <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr height="70">
                <td bgcolor="#FF9900" style="color: #FFFFFF;"><h3>&nbsp;SİTE SETTİNGS</h3></td>
            </tr>
            <tr height="10">
                <td style="font-size: 10px;">&nbsp;</td>
            </tr>
            <tr>
                <td>
                    <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                        <tr height="40">
                            <td width="230">Site Name</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="SiteName" value="<?php echo FiltersDecode($SiteName); ?>" class="InputArea"></td>
                        </tr>
                        <tr height="40">
                            <td>Site Title</td>
                            <td>:</td>
                            <td><input type="text" name="SiteTitle" value="<?php echo FiltersDecode($SiteTitle); ?>" class="InputArea"></td>
                        </tr>
                        <tr height="40">
                            <td>Site Description</td>
                            <td>:</td>
                            <td><input type="text" name="SiteDescription" value="<?php echo FiltersDecode($SiteDescription); ?>" class="InputArea"></td>
                        </tr>
                        <tr height="40">
                            <td>Site Keywords</td>
                            <td>:</td>
                            <td><input type="text" name="SiteKeywords" value="<?php echo FiltersDecode($SiteKeywords); ?>" class="InputArea"></td>
                        </tr>
                        <tr height="40">
                            <td>Site Copyright Metni</td>
                            <td>:</td>
                            <td><input type="text" name="SiteCopyrightText" value="<?php echo FiltersDecode($SiteCopyright); ?>" class="InputArea"></td>
                        </tr>
                        <tr height="40">
                            <td>Site Logo</td>
                            <td>:</td>
                            <td><input type="file" name="SiteLogo"></td>
                        </tr>
                        <tr height="40">
                            <td>Site Link</td>
                            <td>:</td>
                            <td><input type="text" name="SiteLink" value="<?php echo FiltersDecode($SiteLink); ?>" class="InputArea"></td>
                        </tr>
                        <tr height="40">
                            <td>Site Email Address</td>
                            <td>:</td>
                            <td><input type="text" name="SiteEmailAddress" value="<?php echo FiltersDecode($SiteEmailAdress); ?>" class="InputArea"></td>
                        </tr>
                        <tr height="40">
                            <td>Site Email Password</td>
                            <td>:</td>
                            <td><input type="text" name="SiteEmailPassword" value="<?php echo FiltersDecode($SiteEmailPassword); ?>" class="InputArea"></td>
                        </tr>
                        <tr height="40">
                            <td>Site Email Host Address</td>
                            <td>:</td>
                            <td><input type="text" name="SiteEmailHostAddress" value="<?php echo FiltersDecode($SiteHostAddress); ?>" class="InputArea"></td>
                        </tr>
                        <tr height="40">
                            <td>Facebook Link</td>
                            <td>:</td>
                            <td><input type="text" name="Facebooklink" value="<?php echo FiltersDecode($Facebooklink); ?>" class="InputArea"></td>
                        </tr>
                        <tr height="40">
                            <td>Twitter Link</td>
                            <td>:</td>
                            <td><input type="text" name="Twitterlink" value="<?php echo FiltersDecode($Twitterlink); ?>" class="InputArea"></td>
                        </tr>
                        <tr height="40">
                            <td>LinkedIn Link</td>
                            <td>:</td>
                            <td><input type="text" name="Linkedlnlink" value="<?php echo FiltersDecode($Linkedlnlink); ?>" class="InputArea"></td>
                        </tr>
                        <tr height="40">
                            <td>Instagram Link</td>
                            <td>:</td>
                            <td><input type="text" name="Instagramlink" value="<?php echo FiltersDecode($Instagramlink); ?>" class="InputArea"></td>
                        </tr>
                        <tr height="40">
                            <td>Pinterest Link</td>
                            <td>:</td>
                            <td><input type="text" name="Pinterestlink" value="<?php echo FiltersDecode($Pinterestlink); ?>" class="InputArea"></td>
                        </tr>
                        <tr height="40">
                            <td>Youtube Link</td>
                            <td>:</td>
                            <td><input type="text" name="YouTubelink" value="<?php echo FiltersDecode($YouTubelink); ?>" class="InputArea"></td>
                        </tr>
                        <tr height="40">
                            <td>Euro/Usd</td>
                            <td>:</td>
                            <td><input type="text" name="eurusd" value="<?php echo FiltersDecode($eurusd); ?>" class="InputArea"></td>
                        </tr>
                        <tr height="40">
                            <td>Free Shipping Price</td>
                            <td>:</td>
                            <td><input type="text" name="FreeShipping" value="<?php echo FiltersDecode($FreeShipping); ?>" class="InputArea"></td>
                        </tr>
                        <tr height="40">
                            <td>ClientID</td>
                            <td>:</td>
                            <td><input type="text" name="ClientID" value="<?php echo FiltersDecode($ClientID); ?>" class="InputArea"></td>
                        </tr>
                        <tr height="40">
                            <td>StoreKey</td>
                            <td>:</td>
                            <td><input type="text" name="StoreKey" value="<?php echo FiltersDecode($StoreKey); ?>" class="InputArea"></td>
                        </tr>
                        <tr height="40">
                            <td>API User</td>
                            <td>:</td>
                            <td><input type="text" name="ApiUser" value="<?php echo FiltersDecode($ApiUser); ?>" class="InputArea"></td>
                        </tr>
                        <tr height="40">
                            <td>API Password</td>
                            <td>:</td>
                            <td><input type="text" name="ApiPassword" value="<?php echo FiltersDecode($ApiPassword); ?>" class="InputArea"></td>
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
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>