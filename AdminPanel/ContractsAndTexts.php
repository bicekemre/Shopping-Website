<?php
if (isset($_SESSION["Admin"])) {
?>
<form action="index.php?PageCodeLog=0&PageCodeA=6" method="post">
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td bgcolor="#FF9900" style="color: #FFFFFF;"><h3>&nbsp;Contracts And Texts</h3></td>
        </tr>
        <tr height="10">
            <td style="font-size: 10px;">&nbsp;</td>
        </tr>
        <tr>
            <td><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="230" valign="top">About US</td>
                        <td width="20" valign="top">:</td>
                        <td width="500" valign="top"><textarea name="AboutUS" class="TextArea"><?php echo FiltersDecode($AboutusText); ?></textarea></td>
                    </tr>
                    <tr>
                        <td width="230" valign="top"> 	Membership Contracts</td>
                        <td width="20" valign="top">:</td>
                        <td width="500" valign="top"><textarea name="MembershipContracts" class="TextArea"><?php echo FiltersDecode($MembershipContractsText); ?></textarea></td>
                    </tr>
                    <tr>
                        <td width="230" valign="top">Terms of Use</td>
                        <td width="20" valign="top">:</td>
                        <td width="500" valign="top"><textarea name="TermsofUse" class="TextArea"><?php echo FiltersDecode($TermsofUseText); ?></textarea></td>
                    </tr>
                    <tr>
                        <td width="230" valign="top"> 	Privacy Policy</td>
                        <td width="20" valign="top">:</td>
                        <td width="500" valign="top"><textarea name="PrivacyPolicy" class="TextArea"><?php echo FiltersDecode($PrivacyPolicyText); ?></textarea></td>
                    </tr>
                    <tr>
                        <td width="230" valign="top">Distance Sales Agreement</td>
                        <td width="20" valign="top">:</td>
                        <td width="500" valign="top"><textarea name="DistanceSalesAgreement" class="TextArea"><?php echo FiltersDecode($DistanceSalesAgreementText); ?></textarea></td>
                    </tr>
                    <tr>
                        <td width="230" valign="top"> 	Delivery</td>
                        <td width="20" valign="top">:</td>
                        <td width="500" valign="top"><textarea name="Delivery" class="TextArea"><?php echo FiltersDecode($DeliveryText); ?></textarea></td>
                    </tr>
                    <tr>
                        <td width="230" valign="top"> 	Returns & Replacements</td>
                        <td width="20" valign="top">:</td>
                        <td width="500" valign="top"><textarea name="ReturnsReplacements" class="TextArea"><?php echo FiltersDecode($ReturnsReplacementsText); ?></textarea></td>
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
    header("Location:index.php?PageCodeLOG=1");
    exit();
}
?>