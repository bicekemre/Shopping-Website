<?php
if(isset($_SESSION["Admin"])){
    ?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFFFFF;" align="left"><h3>&nbsp; ADMINS</h3></td>
            <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?PageCodeLog=0&PageCodeA=70" style="color: #FFFFFF; text-decoration: none;">ADD ADMINS&nbsp;</a></td>
        </tr>
        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>
        <?php


        $Query		=	$DatabaseConnect->prepare("SELECT * FROM admins ORDER BY NameSurname ASC");
        $Query->execute();
        $Count			=	$Query->rowCount();
        $Records		=	$Query->fetchAll(PDO::FETCH_ASSOC);

        if($Count>0){
            foreach($Records as $Admins){
                ?>
                <tr>
                    <td colspan="2" style="border-bottom: 1px dashed #CCCCCC;" valign="top">
                        <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                            <tr height="30">
                                <td align="left" width="150"><?php echo $Admins["AdminName"]; ?></td>
                                <td align="left" width="150"><?php echo $Admins["NameSurname"]; ?></td>
                                <td align="left" width="200"><?php echo $Admins["Email"]; ?></td>
                                <td align="left" width="100"><?php echo $Admins["Phone"]; ?></td>
                                <td align="right" width="150"><table width="150" align="right" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="25" valign="top" align="left"><a href="index.php?PageCodeLog=0&PageCodeA=75&ID=<?php echo FiltersDecode($Admins["id"]); ?>"><img src="../Images/Guncelleme20x20.png" border="0" style="margin-top: 5px;"></a></td>
                                            <td width="70" align="left"><a href="index.php?PageCodeLog=0&PageCodeA=75&ID=<?php echo FiltersDecode($Admins["id"]); ?>" style="color: #0000FF; text-decoration: none;">Change</a></td>
                                            <td width="25" valign="top" align="left"><a href="index.php?PageCodeLog=0&PageCodeA=79&ID=<?php echo FiltersDecode($Admins["id"]); ?>"><img src="../Images/Sil20x20.png" border="0" style="margin-top: 5px;"></a></td>
                                            <td width="30" align="left"><a href="index.php?PageCodeLog=0&PageCodeA=79&ID=<?php echo FiltersDecode($Admins["id"]); ?>" style="color: #FF0000; text-decoration: none;">Delete</a></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php
            }
        }else{
            ?>
            <tr>
                <td colspan="2">
                    <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="750">None Admin.</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>