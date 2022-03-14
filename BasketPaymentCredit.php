<?php
if (isset($_SESSION["User"])){
    $BasketItemsQuery	=	$DatabaseConnect->prepare("SELECT * FROM basket WHERE UserID = ? ORDER BY id DESC");
    $BasketItemsQuery->execute([$UserID]);
    $BasketItemsCount		=	$BasketItemsQuery->rowCount();
    $BasketItemsRecords		=	$BasketItemsQuery->fetchAll(PDO::FETCH_ASSOC);

    if ($BasketItemsCount>0) {
        $BasketTotalItems = 0;
        $BasketTotalPrice = 0;
        $BasketTotalShippingPrice = 0;
        $BasketTotalShippingPriceFormat = 0;

        foreach ($BasketItemsRecords as $BasketItemsLines) {
            $BasketID = $BasketItemsLines["id"];
            $BasketNO   =  $BasketItemsLines["BasketNO"];
            $BasketItemID = $BasketItemsLines["ItemID"];
            $BasketItemVariantID = $BasketItemsLines["VariantID"];
            $BasketItemAmount = $BasketItemsLines["ItemAmount"];

            $ItemAboutQuery = $DatabaseConnect->prepare("SELECT * FROM items WHERE id = ? LIMIT 1");
            $ItemAboutQuery->execute([$BasketItemID]);
            $ItemRecords = $ItemAboutQuery->fetch(PDO::FETCH_ASSOC);

            $ItemPrice = $ItemRecords["ItemPrice"];
            $ItemCurrency = $ItemRecords["Currency"];
            $ItemShippingPrice = $ItemRecords["ShippingPrice"];

            if ($ItemCurrency == "USD") {
                $ItemPriceChange = $ItemPrice;
                $ItemPriceChangeFormat = PriceFormat($ItemPriceChange);
            } elseif ($ItemCurrency == "EUR") {
                $ItemPriceChange = $ItemPrice * $eurusd;
                $ItemPriceChangeFormat = PriceFormat($ItemPriceChange);
            } else {
                die();
                /* Another Currencies */
            }

            $ItemTotalPrice = ($ItemPriceChange * $BasketItemAmount);
            $ItemTotalPriceFormat = PriceFormat($ItemTotalPrice);

            $BasketTotalItems += $BasketItemAmount;
            $BasketTotalPrice += ($ItemPriceChange * $BasketItemAmount);

            $BasketTotalShippingPriceFormat += ($ItemShippingPrice * $BasketItemAmount);
            $BasketTotalShippingPriceFormatCreate = PriceFormat($BasketTotalShippingPriceFormat);
        }
        if ($BasketTotalPrice >= $FreeShipping) {
            $BasketTotalShippingPriceFormat = 0;
            $SepettekiToplamKargoFiyatiBicimlendir = PriceFormat($BasketTotalShippingPriceFormat);

            $FinalPrice = PriceFormat($BasketTotalPrice);
        } else {
            $FinalPriceProces = ($BasketTotalPrice + $BasketTotalShippingPriceFormat);
            $FinalPrice = PriceFormat($FinalPriceProces);
        }

        $clientId		=	FiltersDecode($ClientID);	//	Bankadan Sanal Pos Onaylanınca Bankanın Verdiği İşyeri Numarası
        $amount			=	$FinalPrice;	//	Sepet Ücreti yada İşlem Tutarı yada Karttan Çekilecek Tutar
        $oid			=	$BasketNO;	//	Sipariş Numarası (Tekrarlanmayan Bir Değer) (Örneğin Sepet Tablosundaki IDyi Kullanabilirsiniz) (Her İşlemde Değişmeli ve Asla Tekrarlanmamalı)
        $okUrl			=	"http://localhost/Basic%20E-Commerce%20Site/BasketPaymentCreditResultComplete.php";	//	Ödeme İşlemi Başarıyla Gerçekleşir ise Dönülecek Sayfa
        $failUrl		=	"http://localhost/Basic%20E-Commerce%20Site/BasketPaymentCreditResultERROR.php";	//	Ödeme İşlemi Red Olur ise Dönülecek Sayfa
        $rnd			=	@microtime();
        $storekey		=	FiltersDecode($StoreKey);	// Sanal Pos Onaylandığında Bankanın Size Verdiği Sanal Pos Ekranına Girerek Oluşturulacak Olan İş Yeri Anahtarı
        $storetype		=	"3d";	//	3D Modeli
        $hashstr		=	$clientId.$oid.$amount.$okUrl.$failUrl.$rnd.$storekey;	// Bankanın Kendi Ayarladığı Hash Parametresi
        $hash			=	@base64_encode(@pack('H*',@sha1($hashstr)));	// Bankanın Kendi Ayarladığı Hash Şifreleme Parametresi
        $description	=	"Item Sales";	//	Extra Bir Açıklama Yazmak İsterseniz Çekim İle İlgili Buraya Yazıyoruz
        $xid			=	"";		//	20 bytelik, 28 Karakterli base64 Olarak Boş Bırılınca Sistem Tarafindan Ototmatik Üretilir. Lütfen Boş Bırakın
        $lang			=	"";		//	Çekim Gösterim Dili Default Türkçedir. Ayarlamak İsterseniz Türkçe (tr), İngilizce (en) Girilmelidir. Boş Bırakılırsa (tr) Kabu Edilmiş Olur.
        $email			=	"";	//	İsterseniz Çekimi Yapan Kullanıcınızın E-Mail Adresini Gönderebilirsiniz
        $userid			=	"";	//	İsterseniz Çekimi Yapan Kullanıcınızın Idsini Gönderebilirsiniz
?>
<form action="https://<server-address>/<3dgate_path>" method="post"> <!-- Bu Adres Banka veya EST Firması Tarafından Verilir -->
    <input type="hidden" name="clientid" value="<?=$clientId?>" />
    <input type="hidden" name="amount" value="<?=$amount?>" />
    <input type="hidden" name="oid" value="<?=$oid?>" />
    <input type="hidden" name="okUrl" value="<?=$okUrl?>" />
    <input type="hidden" name="failUrl" value="<?=$failUrl?>" />
    <input type="hidden" name="rnd" value="<?=$rnd?>" />
    <input type="hidden" name="hash" value="<?=$hash?>" />
    <input type="hidden" name="storetype" value="3d" />
    <input type="hidden" name="lang" value="tr" />
    <table  width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="800" valign="top">
                <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td style="color:darkgoldenrod"><h3>Basket</h3></td>
                    </tr>
                    <tr height="30">
                        <td valign="top" style="border-bottom: 1px dashed #CCCCCC;">Your Can pay items with credit card</td>
                    </tr>
                    <tr height="10">
                        <td style="font-size: 10px;">&nbsp;</td>
                    </tr><tr>
                        <td><table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr height="40">
                                    <td width="250">credit card number</td>
                                    <td colspan="4" width="550"><input type="text" name="pan" class="InputArea">
                                </tr>
                                <tr height="40">
                                    <td>Expiration date</td>
                                    <td width="100"><select name="Ecom_Payment_Card_ExpDate_Month" class="SelectArea">
                                            <option value=""></option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select></td>
                                    <td width="20" align="center"> - </td>
                                    <td width="100"><select name="Ecom_Payment_Card_ExpDate_Year" class="SelectArea">
                                            <option value=""></option>
                                            <option value="2013">2013</option>
                                            <option value="2014">2014</option>
                                            <option value="2015">2015</option>
                                            <option value="2016">2016</option>
                                            <option value="2017">2017</option>
                                            <option value="2018">2018</option>
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                        </select></td>
                                    <td width="330"></td>
                                </tr>
                                <tr height="40">
                                    <td>Card Type</td>
                                    <td colspan="4"><input type="radio" value="1" name="cardType"> Visa <input type="radio" value="2" name="cardType"> MasterCard</td>
                                </tr>
                                <tr height="40">
                                    <td>Security Code</td>
                                    <td width="100"><input type="text" name="cv2" size="4" value="" class="InputArea" /></td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr height="40">
                                    <td align="center">&nbsp;</td>
                                    <td colspan="4" align="left"><input type="submit" value="Pay" class="SendButton" /></td>
                                </tr>
                            </table></td>
                    </tr>
                </table>
            </td>

            <td width="15">&nbsp;</td>

            <td width="250" valign="top"><table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td  style="color:darkgoldenrod" align="right"><h3>Order Summary</h3></td>
                    </tr>
                    <tr height="30">
                        <td valign="top" style="border-bottom: 1px dashed #CCCCCC;" align="right">Total Items :<b style="color: black;"><?php echo $BasketTotalItems; ?></b></td>
                    </tr>
                    <tr height="5">
                        <td height="5" style="font-size: 5px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="right">Price</td>
                    </tr>
                    <tr>
                        <td align="right" style="font-size: 25px; font-weight: bold;"><?php echo $FinalPrice; ?> USD</td>
                    </tr>
                    <tr height="10">
                        <td style="font-size: 10px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="right">Items Total Price</td>
                    </tr>
                    <tr>
                        <td align="right" style="font-size: 25px; font-weight: bold;"><?php echo PriceFormat($BasketTotalPrice); ?> USD</td>
                    </tr>
                    <tr height="10">
                        <td style="font-size: 10px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="right">Shipping Price</td>
                    </tr>
                    <tr>
                        <td align="right" style="font-size: 25px; font-weight: bold;"><?php echo $BasketTotalShippingPriceFormatCreate; ?> USD</td>
                    </tr>
                    <tr height="10">
                        <td style="font-size: 10px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>
        <?php
    }else{
        header("Location:index.php");
        exit();
    }
}else{
    header("Location:index.php");
    exit();
}
?>
