<?php
if(isset($_SESSION["Admin"])){
    $WaitingOrdersQuery		=	$DatabaseConnect->prepare("SELECT DISTINCT OrderNO FROM orders WHERE OrderConfirmStatus = ? AND ShippingStatus = ?");
    $WaitingOrdersQuery->execute([0, 0]);
    $WaitingOrdersCount		=	$WaitingOrdersQuery->rowCount();

    $CompletedOrdersQuery	=	$DatabaseConnect->prepare("SELECT DISTINCT OrderNO FROM orders WHERE OrderConfirmStatus = ? AND ShippingStatus = ?");
    $CompletedOrdersQuery->execute([1, 1]);
    $CompletedOrdersCount		=	$CompletedOrdersQuery->rowCount();

    $OrdersQuery			=	$DatabaseConnect->prepare("SELECT DISTINCT OrderNO FROM orders");
    $OrdersQuery->execute();
    $OrdersCount			=	$OrdersQuery->rowCount();

    $BankQuery				=	$DatabaseConnect->prepare("SELECT * FROM bankaccounts");
    $BankQuery->execute();
    $BankCount					=	$BankQuery->rowCount();

    $MenuQuery					=	$DatabaseConnect->prepare("SELECT * FROM menus");
    $MenuQuery->execute();
    $MenuCount					=	$MenuQuery->rowCount();

    $ItemsQuery					=	$DatabaseConnect->prepare("SELECT * FROM items");
    $ItemsQuery->execute();
    $ItemsCount					=	$ItemsQuery->rowCount();

    $MembersQuery					=	$DatabaseConnect->prepare("SELECT * FROM members");
    $MembersQuery->execute();
    $MembersCount					=	$MembersQuery->rowCount();

    $AdminsQuery				=	$DatabaseConnect->prepare("SELECT * FROM admins");
    $AdminsQuery->execute();
    $AdminsCount				=	$AdminsQuery->rowCount();

    $CargosQuery				=	$DatabaseConnect->prepare("SELECT * FROM cargocompanies");
    $CargosQuery->execute();
    $CargosCount					=	$CargosQuery->rowCount();

    $BannersQuery				=	$DatabaseConnect->prepare("SELECT * FROM banners");
    $BannersQuery->execute();
    $BannersCount				=	$BannersQuery->rowCount();

    $CommentsQuery				=	$DatabaseConnect->prepare("SELECT * FROM comments");
    $CommentsQuery->execute();
    $CommentsCount					=	$CommentsQuery->rowCount();

    $QuestionsQuery					=	$DatabaseConnect->prepare("SELECT * FROM questions");
    $QuestionsQuery->execute();
    $QuestionsCount					=	$QuestionsQuery->rowCount();
    ?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td bgcolor="#FF9900" style="color: #FFFFFF;" align="left"><h3>&nbsp;PANEL</h3></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
                <table width="749" align="right" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="243" style="border: 1px solid #CCCCCC;">
                            <table width="243" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;">Waiting Orders</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $WaitingOrdersCount; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243" style="border: 1px solid #CCCCCC;">
                            <table width="243" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;">Completed Orders</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $CompletedOrdersCount; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243" style="border: 1px solid #CCCCCC;">
                            <table width="243" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;">All Orders</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $OrdersCount; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr height="10">
            <td style="font-size: 10px;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
                <table width="749" align="right" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="243" style="border: 1px solid #CCCCCC;">
                            <table width="243" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;">Support Contents</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $QuestionsCount; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243" style="border: 1px solid #CCCCCC;">
                            <table width="243" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;">Bank Accaounts</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $BankCount; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243" style="border: 1px solid #CCCCCC;">
                            <table width="243" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;">Menu Count</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $MenuCount; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr height="10">
            <td style="font-size: 10px;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
                <table width="749" align="right" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="243" style="border: 1px solid #CCCCCC;">
                            <table width="243" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;">Items</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $ItemsCount; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243" style="border: 1px solid #CCCCCC;">
                            <table width="243" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;">Members</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $MembersCount; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243" style="border: 1px solid #CCCCCC;">
                            <table width="243" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;">Admins</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $AdminsCount; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr height="10">
            <td style="font-size: 10px;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
                <table width="749" align="right" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="243" style="border: 1px solid #CCCCCC;">
                            <table width="243" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;">Cargos</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $CargosCount; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243" style="border: 1px solid #CCCCCC;">
                            <table width="243" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;">Banners</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $BannersCount; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243" style="border: 1px solid #CCCCCC;">
                            <table width="243" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;">Comments</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 25px; font-weight: bold;"><?php echo $CommentsCount; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr height="10">
            <td style="font-size: 10px;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
                <table width="749" align="right" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="10">&nbsp;</td>
                        <td width="243">&nbsp;</td>
                        <td width="10">&nbsp;</td>
                        <td width="243">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <?php
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>