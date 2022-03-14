<?php
if(isset($_SESSION["Admin"])){
    if (isset($_POST["SiteName"])){
        $IncomingSiteName       =  Safety($_POST["SiteName"]);
    }else{
        $IncomingSiteName       =  ";";
    }
    if (isset($_POST["SiteTitle"])){
        $IncomingSiteTitle   =  Safety($_POST["SiteTitle"]);
    }else{
        $IncomingSiteTitle   =  ";";
    }
    if (isset($_POST["SiteDescription"])){
        $IncomingSiteDescription   =  Safety($_POST["SiteDescription"]);
    }else{
        $IncomingSiteDescription   =  ";";
    }
    if (isset($_POST["SiteKeywords"])){
        $IncomingSiteKeywords   =  Safety($_POST["SiteKeywords"]);
    }else{
        $IncomingSiteKeywords   =  ";";
    }
    if (isset($_POST["SiteCopyrightText"])){
        $IncomingSiteCopyrightText   =  Safety($_POST["SiteCopyrightText"]);
    }else{
        $IncomingSiteCopyrightText   =  ";";
    }
    if (isset($_POST["SiteLink"])){
        $IncomingSiteLink   =  Safety($_POST["SiteLink"]);
    }else{
        $IncomingSiteLink   =  ";";
    }
    if (isset($_POST["SiteEmailAddress"])){
        $IncomingSiteEmailAddress   =  Safety($_POST["SiteEmailAddress"]);
    }else{
        $IncomingSiteEmailAddress   =  ";";
    }
    if (isset($_POST["SiteEmailPassword"])){
        $IncomingSiteEmailPassword   =  Safety($_POST["SiteEmailPassword"]);
    }else{
        $IncomingSiteEmailPassword   =  ";";
    }
    if (isset($_POST["SiteEmailHostAddress"])){
        $IncomingSiteSiteEmailHostAddress   =  Safety($_POST["SiteEmailHostAddress"]);
    }else{
        $IncomingSiteSiteEmailHostAddress   =  ";";
    }
    if (isset($_POST["Facebooklink"])){
        $IncomingFacebooklink   =  Safety($_POST["Facebooklink"]);
    }else{
        $IncomingFacebooklink   =  ";";
    }
    if (isset($_POST["Twitterlink"])){
        $IncomingTwitterlink   =  Safety($_POST["Twitterlink"]);
    }else{
        $IncomingTwitterlink   =  ";";
    }
    if (isset($_POST["Linkedlnlink"])){
        $IncomingLinkedlnlink   =  Safety($_POST["Linkedlnlink"]);
    }else{
        $IncomingLinkedlnlink   =  ";";
    }
    if (isset($_POST["Instagramlink"])){
        $IncomingInstagramlink   =  Safety($_POST["Instagramlink"]);
    }else{
        $IncomingInstagramlink   =  ";";
    }
    if (isset($_POST["Pinterestlink"])){
        $IncomingPinterestlink   =  Safety($_POST["Pinterestlink"]);
    }else{
        $IncomingPinterestlink   =  ";";
    }
    if (isset($_POST["YouTubelink"])){
        $IncomingYouTubelink   =  Safety($_POST["YouTubelink"]);
    }else{
        $IncomingYouTubelink   =  ";";
    }
    if (isset($_POST["eurusd"])){
        $Incomingeurusd   =  Safety($_POST["eurusd"]);
    }else{
        $Incomingeurusd   =  ";";
    }
    if (isset($_POST["FreeShipping"])){
        $IncomingFreeShipping   =  Safety($_POST["FreeShipping"]);
    }else{
        $IncomingFreeShipping   =  ";";
    }
    if (isset($_POST["ClientID"])){
        $IncomingClientID   =  Safety($_POST["ClientID"]);
    }else{
        $IncomingClientID   =  ";";
    }
    if (isset($_POST["StoreKey"])){
        $IncomingStoreKey   =  Safety($_POST["StoreKey"]);
    }else{
        $IncomingStoreKey   =  ";";
    }
    if (isset($_POST["ApiUser"])){
        $IncomingApiUser   =  Safety($_POST["ApiUser"]);
    }else{
        $IncomingApiUser   =  ";";
    }
    if (isset($_POST["ApiPassword"])){
        $IncomingApiPassword   =  Safety($_POST["ApiPassword"]);
    }else{
        $IncomingApiPassword   =  ";";
    }

    $IncomingSiteLogo   =   $_FILES["SiteLogo"];

    if(($IncomingSiteName!="") and ($IncomingSiteTitle!="") and ($IncomingSiteDescription!="") and ($IncomingSiteKeywords!="") and ($IncomingSiteCopyrightText!="") and ($IncomingSiteLink!="") and ($IncomingSiteEmailAddress!="") and ($IncomingSiteEmailPassword!="") and ($IncomingSiteSiteEmailHostAddress!="") and ($IncomingFacebooklink!="") and ($IncomingTwitterlink!="") and ($IncomingLinkedlnlink!="") and ($IncomingInstagramlink!="") and ($IncomingPinterestlink!="") and ($IncomingYouTubelink!="") and ($Incomingeurusd!="") and ($IncomingFreeShipping!="") and ($IncomingClientID!="") and ($IncomingStoreKey!="") and ($IncomingApiUser!="") and ($IncomingApiPassword!="")){
        $SettingsQuery  =   $DatabaseConnect->prepare("UPDATE settings SET SiteName = ? ,SiteTitle = ? ,SiteDescription = ? ,SiteKeywords = ? ,SiteCopyright = ? ,SiteLink = ? ,SiteEmailAdress = ? ,SiteName = ? ,SiteEmailPassword = ? ,SiteHostAddress = ? ,Facebooklink = ? ,Twitterlink = ? ,Linkedlnlink = ? ,Instagramlink = ? ,Pinterestlink = ? ,YouTubelink = ? ,eurusd = ? ,FreeShipping = ? ,ClientID = ? ,StoreKey = ? ,ApiUser = ? ,ApiPassword = ?");
        $SettingsQuery->execute([$IncomingSiteName, $IncomingSiteTitle, $IncomingSiteDescription, $IncomingSiteKeywords, $IncomingSiteCopyrightText, $IncomingSiteLink, $IncomingSiteEmailAddress, $IncomingSiteEmailPassword, $IncomingSiteSiteEmailHostAddress, $IncomingFacebooklink, $IncomingTwitterlink, $IncomingInstagramlink, $IncomingInstagramlink, $IncomingPinterestlink, $IncomingYouTubelink, $Incomingeurusd, $IncomingFreeShipping, $IncomingClientID, $IncomingStoreKey, $IncomingApiUser, $IncomingApiPassword]);


        if(($IncomingSiteLogo["name"]!="") and ($IncomingSiteLogo["type"]!="") and ($IncomingSiteLogo["tmp_name"]!="") and ($IncomingSiteLogo["error"]==0) and ($IncomingSiteLogo["size"]>0)) {

            $foo = new Upload($IncomingSiteLogo);
            if ($foo->uploaded) {


                $foo->mime_magic_check = true;
                $foo->allowed = array("image/*");
                $foo->file_new_name_body = "Logo";
                $foo->file_overwrite = true;
                $foo->image_convert = "png";
                $foo->image_quality = 100;
                $foo->image_background_color = null;
                $foo->image_resize = true;
                $foo->image_y = 35;
                $foo->image_x = 192;
                $foo->process($ImagesPathforVerot);

                if ($foo->processed) {
                    $foo->clean();
                } else {
                    header("Location:index.php?PageCodeLog=0&PageCodeA=4");
                    exit();
                }
            }
        }
        header("Location:index.php?PageCodeLog=0&PageCodeA=3");
        exit();
    }else{
        header("Location:index.php?PageCodeLog=0&PageCodeA=4");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}