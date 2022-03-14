<?php
if(isset($_SESSION["Admin"])){
    if(isset($_GET["ID"])){
        $IncomingID			=	Safety($_GET["ID"]);
    }else{
        $IncomingID			=	"";
    }

    $Query = $DatabaseConnect->prepare("SELECT * FROM items WHERE  id = ? LIMIT 1");
    $Query->execute([$IncomingID]);
    $Count = $Query->rowCount();
    $Records		=	$Query->fetch(PDO::FETCH_ASSOC);

    if($Count>0){
?>
<form action="index.php?PageCodeLog=0&PageCodeA=100&ID=<?php echo FiltersDecode($IncomingID); ?>" method="post" enctype="multipart/form-data">
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFFFFF;" align="left"><h3>&nbsp;ITEMS</h3></td>
            <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?PageCodeLog=0&PageCodeA=95" style="color: #FFFFFF; text-decoration: none;">Add Item&nbsp;</a></td>
        </tr>
        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
                <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td width="230">Item Menu</td>
                        <td width="20">:</td>
                        <td width="500">
                            <select name="ItemMenu" class="SelectArea">
                                <?php
                                $MenuQuery			=	$DatabaseConnect->prepare("SELECT * FROM menus WHERE ItemType = ? ORDER BY ItemType ASC, MenuName ASC");
                                $MenuQuery->execute([FiltersDecode($Records["ItemType"])]);
                                $MenuCount			=	$MenuQuery->rowCount();
                                $MenuRecords		=	$MenuQuery->fetchAll(PDO::FETCH_ASSOC);


                                foreach($MenuRecords as $MenuRecord){
                                    ?>
                                    <option value="<?php echo FiltersDecode($MenuRecord["id"]); ?>" <?php if(FiltersDecode($Records["MenuID"]) == FiltersDecode($MenuRecord["id"])){ ?>selected="selected"<?php } ?>>(<?php echo  FiltersDecode($MenuRecord["ItemType"]); ?>) <?php echo  FiltersDecode($MenuRecord["MenuName"]); ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr height="40">
                        <td width="230">Item Name</td>
                        <td width="20">:</td>
                        <td width="500"><input type="text" name="ItemName" class="InputArea" value="<?php echo FiltersDecode($Records["ItemName"])?>"></td>
                    </tr>
                    <tr height="40">
                        <td width="230">Item Price</td>
                        <td width="20">:</td>
                        <td width="500"><input type="text" name="ItemPrice" class="InputArea" value="<?php echo FiltersDecode($Records["ItemPrice"])?>"></td>
                    </tr>
                    <tr height="40">
                        <td width="230">Currency</td>
                        <td width="20">:</td>
                        <td width="500">
                            <select name="Currency" class="SelectArea">
                                <option value="">Please Choice</option>
                                <option value="USD" <?php if (FiltersDecode($Records["Currency"]) == "USD"){ ?> selected="selected"<?php } ?>>USD</option>
                                <option value="EUR" <?php if(FiltersDecode($Records["Currency"]) == "EUR"){ ?>selected="selected"<?php } ?>>Euro</option>
                            </select>
                        </td>
                    </tr>
                    <tr height="40">
                        <td width="230">Shipping Price</td>
                        <td width="20">:</td>
                        <td width="500"><input type="text" name="ShippingPrice" class="InputArea" value="<?php echo FiltersDecode($Records["ShippingPrice"])?>"></td>
                    </tr>
                    <tr>
                        <td width="230" valign="top">Item About</td>
                        <td width="20" valign="top">:</td>
                        <td width="500"><textarea name="ItemAbout" class="TextArea"><?php echo FiltersDecode($Records["ItemAbout"]); ?></textarea></td>
                    </tr>
                    <tr height="40">
                        <td>ItemPicOne</td>
                        <td>:</td>
                        <td><input type="file" name="ItemPic1"></td>
                    </tr>
                    <tr height="40">
                        <td>ItemPicTwo</td>
                        <td>:</td>
                        <td><input type="file" name="ItemPic2"></td>
                    </tr>
                    <tr height="40">
                        <td>ItemPicThree</td>
                        <td>:</td>
                        <td><input type="file" name="ItemPic3"></td>
                    </tr>
                    <tr height="40">
                        <td>ItemPicFour</td>
                        <td>:</td>
                        <td><input type="file" name="ItemPic4"></td>
                    </tr>
                    <tr height="40">
                        <td width="230">Variant Title</td>
                        <td width="20">:</td>
                        <td width="500"><input type="text" name="VariantTitle" class="InputArea" value="<?php echo FiltersDecode($Records["VariantTitle"])?>"></td>
                    </tr>

                     <?php
                     $VariantQuery			=	$DatabaseConnect->prepare("SELECT * FROM itemsvariants WHERE ItemID = ?");
                     $VariantQuery->execute([$IncomingID]);
                     $VariantCount			=	$VariantQuery->rowCount();
                     $VariantRecords		=	$VariantQuery->fetchAll(PDO::FETCH_ASSOC);

                     $VariantNameArray    = array();
                     $VariantStockArray    = array();

                     foreach($VariantRecords as $Variant){
                         $VariantNameArray[]	=	$Variant["VariantName"];
                         $VariantStockArray[]	=	$Variant["StockNumber"];
                     }

                     if (array_key_exists(1 ,$VariantNameArray)){
                         $VariantNameArray2         =   FiltersDecode($VariantNameArray[1]);
                         $VariantStockArray2        =   FiltersDecode($VariantStockArray[1]);
                     }else{
                         $VariantNameArray2         =   "";
                         $VariantStockArray2        =   "";
                     }
                     if (array_key_exists(2 ,$VariantNameArray)){
                         $VariantNameArray3         =   FiltersDecode($VariantNameArray[2]);
                         $VariantStockArray3        =   FiltersDecode($VariantStockArray[2]);
                     }else{
                         $VariantNameArray3         =   "";
                         $VariantStockArray3        =   "";
                     }
                     if (array_key_exists(3 ,$VariantNameArray)){
                         $VariantNameArray4         =   FiltersDecode($VariantNameArray[3]);
                         $VariantStockArray4        =   FiltersDecode($VariantStockArray[3]);
                     }else{
                         $VariantNameArray4         =   "";
                         $VariantStockArray4        =   "";
                     }
                     if (array_key_exists(4 ,$VariantNameArray)){
                         $VariantNameArray5         =   FiltersDecode($VariantNameArray[4]);
                         $VariantStockArray5        =   FiltersDecode($VariantStockArray[4]);
                     }else{
                         $VariantNameArray5         =   "";
                         $VariantStockArray5        =   "";
                     }
                     if (array_key_exists(5 ,$VariantNameArray)){
                         $VariantNameArray6         =   FiltersDecode($VariantNameArray[5]);
                         $VariantStockArray6        =   FiltersDecode($VariantStockArray[5]);
                     }else{
                         $VariantNameArray6         =   "";
                         $VariantStockArray6        =   "";
                     }
                     if (array_key_exists(6 ,$VariantNameArray)){
                         $VariantNameArray7         =   FiltersDecode($VariantNameArray[6]);
                         $VariantStockArray7        =   FiltersDecode($VariantStockArray[6]);
                     }else{
                         $VariantNameArray7         =   "";
                         $VariantStockArray7        =   "";
                     }
                     if (array_key_exists(7 ,$VariantNameArray)){
                         $VariantNameArray8         =   FiltersDecode($VariantNameArray[7]);
                         $VariantStockArray8        =   FiltersDecode($VariantStockArray[7]);
                     }else{
                         $VariantNameArray8         =   "";
                         $VariantStockArray8        =   "";
                     }
                     if (array_key_exists(8 ,$VariantNameArray)){
                         $VariantNameArray9         =   FiltersDecode($VariantNameArray[8]);
                         $VariantStockArray9        =   FiltersDecode($VariantStockArray[8]);
                     }else{
                         $VariantNameArray9        =   "";
                         $VariantStockArray9       =   "";
                     }
                     if (array_key_exists(9 ,$VariantNameArray)){
                         $VariantNameArray10        =   FiltersDecode($VariantNameArray[9]);
                         $VariantStockArray10       =   FiltersDecode($VariantStockArray[9]);
                     }else{
                         $VariantNameArray10        =   "";
                         $VariantStockArray10       =   "";
                     }
                     ?>

                    <tr height="40">
                        <td colspan="3" align="left">
                            <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="230">1. Variant Name</td>
                                    <td width="20">:</td>
                                    <td width="200"><input type="text" name="VariantName1" class="InputArea" value="<?php echo FiltersDecode($VariantNameArray[0]); ?>"></td>
                                    <td width="20">&nbsp;</td>
                                    <td width="178">1. StockNumber</td>
                                    <td width="20">:</td>
                                    <td width="60"><input type="text" name="StockNumber1" class="InputArea" value="<?php echo FiltersDecode($VariantStockArray[0]); ?>"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="40">
                        <td colspan="3" align="left">
                            <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="230">2. Variant Name</td>
                                    <td width="20">:</td>
                                    <td width="200"><input type="text" name="VariantName2" class="InputArea" value="<?php echo$VariantNameArray2 ; ?>"  ></td>
                                    <td width="20">&nbsp;</td>
                                    <td width="178">2. StockNumber</td>
                                    <td width="20">:</td>
                                    <td width="60"><input type="text" name="StockNumber2" class="InputArea" value="<?php echo $VariantStockArray2; ?>"  ></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="40">
                        <td colspan="3" align="left">
                            <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="230">3. Variant Name</td>
                                    <td width="20">:</td>
                                    <td width="200"><input type="text" name="VariantName3" class="InputArea"  value="<?php echo$VariantNameArray3 ; ?>" ></td>
                                    <td width="20">&nbsp;</td>
                                    <td width="178">3. StockNumber</td>
                                    <td width="20">:</td>
                                    <td width="60"><input type="text" name="StockNumber3" class="InputArea"   value="<?php echo$VariantStockArray3; ?>" ></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="40">
                        <td colspan="3" align="left">
                            <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="230">4. Variant Name</td>
                                    <td width="20">:</td>
                                    <td width="200"><input type="text" name="VariantName4" class="InputArea" value="<?php echo$VariantNameArray4 ; ?>"  ></td>
                                    <td width="20">&nbsp;</td>
                                    <td width="178">4. StockNumber</td>
                                    <td width="20">:</td>
                                    <td width="60"><input type="text" name="StockNumber4" class="InputArea" value="<?php echo $VariantStockArray4; ?>"  ></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="40">
                        <td colspan="3" align="left">
                            <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="230">5. Variant Name</td>
                                    <td width="20">:</td>
                                    <td width="200"><input type="text" name="VariantName5" class="InputArea"value="<?php echo $VariantNameArray5; ?>"  ></td>
                                    <td width="20">&nbsp;</td>
                                    <td width="178">5. StockNumber</td>
                                    <td width="20">:</td>
                                    <td width="60"><input type="text" name="StockNumber5" class="InputArea" value="<?php echo $VariantStockArray5; ?>"  ></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="40">
                        <td colspan="3" align="left">
                            <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="230">6. Variant Name</td>
                                    <td width="20">:</td>
                                    <td width="200"><input type="text" name="VariantName6" class="InputArea"value="<?php echo $VariantNameArray6; ?>"></td>
                                    <td width="20">&nbsp;</td>
                                    <td width="178">6. StockNumber</td>
                                    <td width="20">:</td>
                                    <td width="60"><input type="text" name="StockNumber6" class="InputArea" value="<?php echo $VariantStockArray6; ?>" ></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="40">
                        <td colspan="3" align="left">
                            <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="230">7. Variant Name</td>
                                    <td width="20">:</td>
                                    <td width="200"><input type="text" name="VariantName7" class="InputArea"value="<?php echo $VariantNameArray7; ?>"></td>
                                    <td width="20">&nbsp;</td>
                                    <td width="178">7. StockNumber</td>
                                    <td width="20">:</td>
                                    <td width="60"><input type="text" name="StockNumber7" class="InputArea" value="<?php echo $VariantStockArray7; ?>"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="40">
                        <td colspan="3" align="left">
                            <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="230">8. Variant Name</td>
                                    <td width="20">:</td>
                                    <td width="200"><input type="text" name="VariantName8" class="InputArea"value="<?php echo $VariantNameArray8; ?>"></td>
                                    <td width="20">&nbsp;</td>
                                    <td width="178">8. StockNumber</td>
                                    <td width="20">:</td>
                                    <td width="60"><input type="text" name="StockNumber8" class="InputArea" value="<?php echo $VariantStockArray8; ?>"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="40">
                        <td colspan="3" align="left">
                            <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="230">9. Variant Name</td>
                                    <td width="20">:</td>
                                    <td width="200"><input type="text" name="VariantName9" class="InputArea"value="<?php echo $VariantNameArray9; ?>" ></td>
                                    <td width="20">&nbsp;</td>
                                    <td width="178">9. StockNumber</td>
                                    <td width="20">:</td>
                                    <td width="60"><input type="text" name="StockNumber9" class="InputArea" value="<?php echo $VariantStockArray9; ?>"  ></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="40">
                        <td colspan="3" align="left">
                            <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="230">9. Variant Name</td>
                                    <td width="20">:</td>
                                    <td width="200"><input type="text" name="VariantName10" class="InputArea" value="<?php echo $VariantNameArray10; ?>"  ></td>
                                    <td width="20">&nbsp;</td>
                                    <td width="178">9. StockNumber</td>
                                    <td width="20">:</td>
                                    <td width="60"><input type="text" name="StockNumber10" class="InputArea"  value="<?php echo $VariantStockArray10; ?>"  ></td>
                                </tr>
                            </table>
                        </td>
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
        header("Location:index.php?PageCodeLog=0&PageCodeA=102");
        exit();
    }
    }else{
        header("Location:index.php?PageCodeLog=1");
        exit();
    }
?>
