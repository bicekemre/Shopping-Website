<?php
if(isset($_SESSION["Admin"])){
    ?>
    <form action="index.php?PageCodeLog=0&PageCodeA=96" method="post" enctype="multipart/form-data">
        <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr height="70">
                <td width="560" bgcolor="#FF9900" style="color: #FFFFFF;" align="left"><h3>&nbsp;ITEMS</h3></td>
                <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?PageCodeLog=0&PageCodeA=95" style="color: #FFFFFF; text-decoration: none;">Ad Item&nbsp;</a></td>
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
                                    <option value="">Please Choice</option>

                                    <?php
                                    $MenuQuery			=	$DatabaseConnect->prepare("SELECT * FROM menus ORDER BY ItemType ASC, MenuName ASC");
                                    $MenuQuery->execute();
                                    $MenuCount			=	$MenuQuery->rowCount();
                                    $MenuRecords		=	$MenuQuery->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($MenuRecords as $MenuRecord){
                                        ?>
                                        <option value="<?php echo  FiltersDecode($MenuRecord["id"]); ?>">(<?php echo  FiltersDecode($MenuRecord["ItemType"]); ?>) <?php echo  FiltersDecode($MenuRecord["MenuName"]); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr height="40">
                            <td width="230">Item Name</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="ItemName" class="InputArea"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Item Price</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="ItemPrice" class="InputArea"></td>
                        </tr>
                        <tr height="40">
                            <td width="230">Currency</td>
                            <td width="20">:</td>
                            <td width="500">
                                <select name="Currency" class="SelectArea">
                                    <option value="">Please Choice</option>
                                    <option value="USD">USD</option>
                                    <option value="EUR">Euro</option>
                                </select>
                            </td>
                        </tr>
                        <tr height="40">
                            <td width="230">Shipping Price</td>
                            <td width="20">:</td>
                            <td width="500"><input type="text" name="ShippingPrice" class="InputArea"></td>
                        </tr>
                        <tr>
                            <td width="230" valign="top">Item About</td>
                            <td width="20" valign="top">:</td>
                            <td width="500"><textarea name="ItemAbout" class="TextArea"></textarea></td>
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
                            <td width="500"><input type="text" name="VariantTitle" class="InputArea"></td>
                        </tr>
                        <tr height="40">
                            <td colspan="3" align="left">
                                <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="230">1. Variant Name</td>
                                        <td width="20">:</td>
                                        <td width="200"><input type="text" name="VariantName1" class="InputArea"></td>
                                        <td width="20">&nbsp;</td>
                                        <td width="178">1. StockNumber</td>
                                        <td width="20">:</td>
                                        <td width="60"><input type="text" name="StockNumber1" class="InputArea"></td>
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
                                        <td width="200"><input type="text" name="VariantName2" class="InputArea"></td>
                                        <td width="20">&nbsp;</td>
                                        <td width="178">2. StockNumber</td>
                                        <td width="20">:</td>
                                        <td width="60"><input type="text" name="StockNumber2" class="InputArea"></td>
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
                                        <td width="200"><input type="text" name="VariantName3" class="InputArea"></td>
                                        <td width="20">&nbsp;</td>
                                        <td width="178">3. StockNumber</td>
                                        <td width="20">:</td>
                                        <td width="60"><input type="text" name="StockNumber3" class="InputArea"></td>
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
                                        <td width="200"><input type="text" name="VariantName4" class="InputArea"></td>
                                        <td width="20">&nbsp;</td>
                                        <td width="178">4. StockNumber</td>
                                        <td width="20">:</td>
                                        <td width="60"><input type="text" name="StockNumber4" class="InputArea"></td>
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
                                        <td width="200"><input type="text" name="VariantName5" class="InputArea"></td>
                                        <td width="20">&nbsp;</td>
                                        <td width="178">5. StockNumber</td>
                                        <td width="20">:</td>
                                        <td width="60"><input type="text" name="StockNumber5" class="InputArea"></td>
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
                                        <td width="200"><input type="text" name="VariantName6" class="InputArea"></td>
                                        <td width="20">&nbsp;</td>
                                        <td width="178">6. StockNumber</td>
                                        <td width="20">:</td>
                                        <td width="60"><input type="text" name="StockNumber6" class="InputArea"></td>
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
                                        <td width="200"><input type="text" name="VariantName7" class="InputArea"></td>
                                        <td width="20">&nbsp;</td>
                                        <td width="178">7. StockNumber</td>
                                        <td width="20">:</td>
                                        <td width="60"><input type="text" name="StockNumber7" class="InputArea"></td>
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
                                        <td width="200"><input type="text" name="VariantName8" class="InputArea"></td>
                                        <td width="20">&nbsp;</td>
                                        <td width="178">8. StockNumber</td>
                                        <td width="20">:</td>
                                        <td width="60"><input type="text" name="StockNumber8" class="InputArea"></td>
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
                                        <td width="200"><input type="text" name="VariantName9" class="InputArea"></td>
                                        <td width="20">&nbsp;</td>
                                        <td width="178">9. StockNumber</td>
                                        <td width="20">:</td>
                                        <td width="60"><input type="text" name="StockNumber9" class="InputArea"></td>
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
                                        <td width="200"><input type="text" name="VariantName10" class="InputArea"></td>
                                        <td width="20">&nbsp;</td>
                                        <td width="178">9. StockNumber</td>
                                        <td width="20">:</td>
                                        <td width="60"><input type="text" name="StockNumber10" class="InputArea"></td>
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
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>