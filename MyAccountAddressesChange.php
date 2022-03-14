<?php
if (isset($_SESSION["User"])){
    if (isset($_GET["ID"])){
        $IncomingID     =   Safety($_GET["ID"]);
    }else{
        $IncomingID     =   "";
    }

    if ($IncomingID!=""){
        $AddressQuery		=	$DatabaseConnect->prepare("SELECT * FROM addresses WHERE id = ? AND UserId = ? LIMIT 1");
        $AddressQuery->execute([$IncomingID, $UserID]);
        $AddressCount		=	$AddressQuery->rowCount();
        $Regis		        =	$AddressQuery->fetch(PDO::FETCH_ASSOC);

        if ($AddressCount>0){
            ?>
        <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="500" valign="top">
                    <form action="index.php?PageCode=58&ID=<?php echo $IncomingID; ?>" method="post">
                        <table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr height="40">
                                <td style="color:black"><h3>My Account > Addresses</h3></td>
                            </tr>
                            <tr height="30">
                                <td valign="top" style="border-bottom: 1px dashed #CCCCCC;">You Can see and change your Addresses.</td>
                            </tr>
                            <tr height="30">
                                <td valign="bottom" align="left">Name Surname (*)</td>
                            </tr>
                            <tr height="30">
                                <td valign="top" align="left"><input type="text" name="NameSurname" class="InputArea" value="<?php echo $Regis["NameSurname"]; ?>"></td>
                            </tr>
                            <tr height="30">
                                <td valign="bottom" align="left">Address (*)</td>
                            </tr>
                            <tr height="30">
                                <td valign="top" align="left"><input type="text" name="Address" class="InputArea" value="<?php echo $Regis["Address"]; ?>"></td>
                            </tr>
                            <tr height="30">
                                <td valign="bottom" align="left">District (*)</td>
                            </tr>
                            <tr height="30">
                                <td valign="top" align="left"><input type="text" name="District" class="InputArea" value="<?php echo $Regis["District"]; ?>"></td>
                            </tr>
                            <tr height="30">
                                <td valign="bottom" align="left">City (*)</td>
                            </tr>
                            <tr height="30">
                                <td valign="top" align="left"><input type="text" name="City" class="InputArea" value="<?php echo $Regis["City"]; ?>"></td>
                            </tr>
                            <tr height="30">
                                <td valign="bottom" align="left">Phone Number (*)</td>
                            </tr>
                            <tr height="30">
                                <td valign="top" align="left"><input type="text" name="PhoneNumber" class="InputArea" value="<?php echo $Regis["PhoneNumber"]; ?>"></td>
                            </tr>
                            <tr height="40">
                                <td colspan="2" align="center"><input type="submit" value="Address Change" class="SendButton"></td>
                            </tr>
                        </table>
                    </form>
                </td>
            </tr>
        </table>

        <?php
        }else{
            header("Location:index.php?PageCode=60");
            exit();
        }
    }else{
        header("Location:index.php?PageCode=60");
        exit();
    }
}else{
    header("Location:index.php");
    exit();
}
?>
