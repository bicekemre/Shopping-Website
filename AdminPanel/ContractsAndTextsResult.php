<?php
if(isset($_SESSION["Admin"])){
    if (isset($_POST["AboutUS"])){
        $IncomingAboutUS       =  Safety($_POST["AboutUS"]);
    }else{
        $IncomingAboutUS       =  ";";
    }
    if (isset($_POST["MembershipContracts"])){
        $IncomingMembershipContracts   =  Safety($_POST["MembershipContracts"]);
    }else{
        $IncomingMembershipContracts   =  ";";
    }
    if (isset($_POST["TermsofUse"])){
        $IncomingTermsofUse   =  Safety($_POST["TermsofUse"]);
    }else{
        $IncomingTermsofUse   =  ";";
    }
    if (isset($_POST["PrivacyPolicy"])){
        $IncomingPrivacyPolicy   =  Safety($_POST["PrivacyPolicy"]);
    }else{
        $IncomingPrivacyPolicy   =  ";";
    }
    if (isset($_POST["DistanceSalesAgreement"])){
        $IncomingDistanceSalesAgreement   =  Safety($_POST["DistanceSalesAgreement"]);
    }else{
        $IncomingDistanceSalesAgreement   =  ";";
    }
    if (isset($_POST["Delivery"])){
        $IncomingDelivery   =  Safety($_POST["Delivery"]);
    }else{
        $IncomingDelivery   =  ";";
    }
    if (isset($_POST["ReturnsReplacements"])){
        $IncomingReturnsReplacements   =  Safety($_POST["ReturnsReplacements"]);
    }else{
        $IncomingReturnsReplacements   =  ";";
    }

    if(($IncomingAboutUS!="") and ($IncomingMembershipContracts!="") and ($IncomingTermsofUse!="") and ($IncomingPrivacyPolicy!="") and ($IncomingDistanceSalesAgreement!="") and ($IncomingDelivery!="") and ($IncomingReturnsReplacements!="")){
        $Query  =   $DatabaseConnect->prepare("UPDATE contractsandtexts SET Aboutus = ? ,MembershipContracts = ? ,TermsofUse = ? ,ConfidentialityAgreement = ? ,DistanceSalesAgreement = ? ,DeliveryText = ? , ReturnsReplacements = ?");
        $Query->execute([$IncomingAboutUS, $IncomingMembershipContracts, $IncomingTermsofUse, $IncomingPrivacyPolicy, $IncomingDistanceSalesAgreement, $IncomingDelivery, $IncomingReturnsReplacements]);



        header("Location:index.php?PageCodeLog=0&PageCodeA=7");
        exit();
    }else{
        header("Location:index.php?PageCodeLog=0&PageCodeA=8");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}