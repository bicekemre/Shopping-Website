<?php
if ($_SESSION["User"]){
?>
    <table width="1065" bgcolor="#f0e68c" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td colspan="3"><hr /></td>
    </tr>
    <tr>
        <td colspan="3"><table width="1065"  align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="203" bgcolor="#b8860b" style="border: 1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?PageCode=45" style="text-decoration: none; color: black;">Account Information</a></td>
                    <td width="10">&nbsp;</td>
                    <td width="203"  bgcolor="#b8860b" style="border: 1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?PageCode=53" style="text-decoration: none; color: black;">Address</a></td>
                    <td width="10">&nbsp;</td>
                    <td width="203"  bgcolor="#b8860b" style="border: 1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?PageCode=54" style="text-decoration: none; color: black;">Favorites</a></td>
                    <td width="10">&nbsp;</td>
                    <td width="203"  bgcolor="#b8860b" style="border: 1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?PageCode=55" style="text-decoration: none; color: black;">Comments</a></td>
                    <td width="10">&nbsp;</td>
                    <td width="203"  bgcolor="#b8860b" style="border: 1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?PageCode=56" style="text-decoration: none; color: black;">Orders</a></td>
                </tr>
            </table></td>
    </tr>
    <tr>
        <td colspan="3"><hr /></td>
    </tr>
    <tr>
    <td width="500" valign="top">
        <table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr height="40">
                <td style="color:black"><h3>My Account > Addresses</h3></td>
            </tr>
            <tr height="30">
                <td valign="top" style="border-bottom: 1px dashed #CCCCCC;">You Can see and change your Addresses.</td>
            </tr>
            <tr height="50">
                <td colspan="1" style="background: #f8ffa7; color: black; font-weight: bold;" align="left">&nbsp;Addresses</td>
                <td colspan="4" style="background: #f8ffa7; color: black; font-weight: bold;" align="right"><a href="index.php?PageCode=65" style="text-decoration: none; color: #000000;">+ Add Address</a>&nbsp;</td>
            </tr>
            <?php
            $AddressesQuery		=	$DatabaseConnect->prepare("SELECT * FROM addresses WHERE UserId = ?");
            $AddressesQuery->execute([$UserID]);
            $AddressesCount			=	$AddressesQuery->rowCount();
            $AddressesRegis 	=	$AddressesQuery->fetchAll(PDO::FETCH_ASSOC);

            $FirstColor			=	"#FFFFFF";
            $SecondColor		=	"#F1F1F1";
            $RenkCount			=	1;

            if($AddressesCount>0){
                foreach($AddressesRegis as $Lines){
                    if($RenkCount % 2){
                        $bgcolor	=	$FirstColor;
                    }else{
                        $bgcolor	=	$SecondColor;
                    }
                    ?>
                    <tr height="50" bgcolor="<?php echo $bgcolor; ?>">
                        <td align="left"><?php echo $Lines["NameSurname"]; ?> - <?php echo $Lines["Address"]; ?> <?php echo $Lines["District"]; ?> / <?php echo $Lines["City"]; ?> - <?php echo $Lines["PhoneNumber"]; ?></td>
                        <td width="25"><img src="Images/Guncelleme20x20.png" border="0" style="margin-top: 5px;"></td>
                        <td width="70"><a href="index.php?PageCode=57&ID=<?php echo $Lines["id"]; ?>" style="text-decoration: none; color: #646464;">Change</a></td>
                        <td width="25"><img src="Images/Sil20x20.png" border="0" style="margin-top: 5px;"></td>
                        <td width="25"><a href="index.php?PageCode=62&ID=<?php echo $Lines["id"]; ?>" style="text-decoration: none; color: #646464;">Delete</a></td>
                    </tr>
                    <?php
                    $RenkCount++;
                }
            }else{
                ?>
                <tr height="50">
                    <td colspan="5" align="left">There is no registered address in the system.</td>
                </tr>
                <?php
            }
            ?>
        </table>
    </td>
    </tr>
    </table>
    <?php
}else{
    header("Location:index.php");
    exit();
}
?>