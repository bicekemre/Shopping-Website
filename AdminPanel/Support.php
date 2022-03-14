<?php
if(isset($_SESSION["Admin"])){
    ?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFFFFF;" align="left"><h3>&nbsp; SUPPORT CONTENT</h3></td>
            <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?PageCodeLog=0&PageCodeA=46" style="color: #FFFFFF; text-decoration: none;">Add SUPPORT CONTENT&nbsp;</a></td>
        </tr>
        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>
        <?php
        $Query		=	$DatabaseConnect->prepare("SELECT * FROM questions ORDER BY question ASC");
        $Query->execute();
        $Count			=	$Query->rowCount();
        $Records		=	$Query->fetchAll(PDO::FETCH_ASSOC);

        if($Count>0){
            foreach($Records as $questions){
                ?>
                <tr>
                <td colspan="2" style="border-bottom: 1px dashed #CCCCCC;" valign="top"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                <tr height="30">
                    <td align="left"><b><?php echo $questions["question"]; ?></b></td>
                </tr>
                <tr>
                    <td align="left"><?php echo $questions["answer"]; ?></td>
                </tr>
                <tr height="20">
                    <td align="right"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                            <tr height="20">
                                <td width="600">&nbsp;</td>
                                <td width="25" valign="top" align="left"><a href="index.php?PageCodeLog=0&PageCodeA=50&ID=<?php echo FiltersDecode($questions["id"]); ?>"><img src="../Images/Guncelleme20x20.png" border="0" style="margin-top: 5px;"></a></td>
                                <td width="70" align="left"><a href="index.php?PageCodeLog=0&PageCodeA=50&ID=<?php echo FiltersDecode($questions["id"]); ?>" style="color: #0000FF; text-decoration: none;">Change</a></td>
                                <td width="25" valign="top" align="left"><a href="index.php?PageCodeLog=0&PageCodeA=54&ID=<?php echo FiltersDecode($questions["id"]); ?>"><img src="../Images/Sil20x20.png" border="0" style="margin-top: 5px;"></a></td>
                                <td width="30" align="left"><a href="index.php?PageCodeLog=0&PageCodeA=54&ID=<?php echo FiltersDecode($questions["id"]); ?>" style="color: #FF0000; text-decoration: none;">Delete</a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php
            }
        }else{
            ?>
            <tr>
                <td colspan="2"><table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="750">None Contents.</td>
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