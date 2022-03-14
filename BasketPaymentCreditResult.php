<?php
session_start(); ob_start();
require_once ("Settings/setting.php");
require_once ("Settings/function.php");
require_once ("Settings/pages.php");

$oid					=	$_POST['oid'];

$InstallmentQuery	=	$DatabaseConnect->prepare("SELECT * FROM basket WHERE BasketNO = ? LIMIT 1");
$InstallmentQuery->execute([$oid]);
$InstallmentRecords			=	$InstallmentQuery->fetch(PDO::FETCH_ASSOC);

$Installment	=	$InstallmentRecords["Installment"];
	if($Installment==1){
        $Installment	=	"";
    }
$hashparams		=	$_POST["HASHPARAMS"];
$hashparamsval	=	$_POST["HASHPARAMSVAL"];
$hashparam		=	$_POST["HASH"];
$storekey		=	FiltersDecode($StoreKey);	// Sanal Pos Onaylandığında Bankanın Size Verdiği Sanal Pos Ekranına Girerek Oluşturulacak Olan İş Yeri Anahtarı
$paramsval		=	"";
$index1			=	0;
$index2			=	0;
while($index1<@strlen($hashparams)){
    $index2		=	@strpos($hashparams,":",$index1);
    $vl			=	$_POST[@substr($hashparams,$index1,$index2-$index1)];
    if($vl==null)
        $vl			=	"";
    $paramsval	=	$paramsval.$vl;
    $index1		=	$index2+1;
}
$hashval		=	$paramsval.$storekey;
$hash			=	@base64_encode(@pack('H*',@sha1($hashval)));
if($paramsval!=$hashparamsval || $hashparam!=$hash)
    echo "<h4>Security error</h4>";
$name			=	FiltersDecode($ApiUser);	// Bankanın Size Verdiği Sanal Pos Ekranından Oluşturacağınız 3D Kullanıcı Adı
$password		=	FiltersDecode($ApiPassword);	// Bankanın Size Verdiği Sanal Pos Ekranından Oluşturacağınız 3D Kullanıcı Şifresi
$clientid		=	$_POST["clientid"];
$mode			=	"P";	// P Çekim İşlemi Demek, T Test İşlemi Demek (Kesinlikle P Olacak Yoksa Çekimler Kart Sahibine Geri Gider)
$type			=	"Auth";	// Auth: Satış PreAuth: Ön Otorizasyon
$expires		=	$_POST["Ecom_Payment_Card_ExpDate_Month"]."/".$_POST["Ecom_Payment_Card_ExpDate_Year"];
$cv2			=	$_POST['cv2'];
$tutar			=	$_POST["amount"];
$taksit			=	$Installment;	// Taksit Yapılacak İse Taksit Sayısı Girilmeli, 0 Kesinlikle Girilmeyecektir. Tek Çekim İçin Boş Bırakılacaktır, Taksit İşlemleri İçin Minimum 2 Girilir. Maksimum Bankanın Size Vereceği Taksit Sayısı Kadardır.
$lip			=	GetHostByName($REMOTE_ADDR);
$email			=	"";	//	İsterseniz Çekimi Yapan Kullanıcınızın E-Mail Adresini Gönderebilirsiniz
$mdStatus		=	$_POST['mdStatus'];
$xid			=	$_POST['xid'];
$eci			=	$_POST['eci'];
$cavv			=	$_POST['cavv'];
$md				=	$_POST['md'];

if($mdStatus =="1" || $mdStatus == "2" || $mdStatus == "3" || $mdStatus == "4"){
    $request	=	"DATA=<?xml version=\"1.0\" encoding=\"ISO-8859-9\"?>"."<CC5Request>"."<Name>{NAME}</Name>"."<Password>{PASSWORD}</Password>"."<ClientId>{CLIENTID}</ClientId>"."<IPAddress>{IP}</IPAddress>"."<Email>{EMAIL}</Email>"."<Mode>P</Mode>"."<OrderId>{OID}</OrderId>"."<GroupId></GroupId>"."<TransId></TransId>"."<UserId></UserId>"."<Type>{TYPE}</Type>"."<Number>{MD}</Number>"."<Expires></Expires>"."<Cvv2Val></Cvv2Val>"."<Total>{TUTAR}</Total>"."<Currency>949</Currency>"."<Taksit>{TAKSIT}</Taksit>"."<PayerTxnId>{XID}</PayerTxnId>"."<PayerSecurityLevel>{ECI}</PayerSecurityLevel>"."<PayerAuthenticationCode>{CAVV}</PayerAuthenticationCode>"."<CardholderPresentCode>13</CardholderPresentCode>"."<BillTo>"."<Name></Name>"."<Street1></Street1>"."<Street2></Street2>"."<Street3></Street3>"."<City></City>"."<StateProv></StateProv>"."<PostalCode></PostalCode>"."<Country></Country>"."<Company></Company>"."<TelVoice></TelVoice>"."</BillTo>"."<ShipTo>"."<Name></Name>"."<Street1></Street1>"."<Street2></Street2>"."<Street3></Street3>"."<City></City>"."<StateProv></StateProv>"."<PostalCode></PostalCode>"."<Country></Country>"."</ShipTo>"."<Extra></Extra>"."</CC5Request>";
    $request	=	@str_replace("{NAME}",$name,$request);
    $request	=	@str_replace("{PASSWORD}",$password,$request);
    $request	=	@str_replace("{CLIENTID}",$clientid,$request);
    $request	=	@str_replace("{IP}",$lip,$request);
    $request	=	@str_replace("{OID}",$oid,$request);
    $request	=	@str_replace("{TYPE}",$type,$request);
    $request	=	@str_replace("{XID}",$xid,$request);
    $request	=	@str_replace("{ECI}",$eci,$request);
    $request	=	@str_replace("{CAVV}",$cavv,$request);
    $request	=	@str_replace("{MD}",$md,$request);
    $request	=	@str_replace("{TUTAR}",$tutar,$request);
    $request	=	@str_replace("{TAKSIT}",$taksit,$request);

    $url		=	"https://<sunucu_adresi>/<apiserver_path>"; // Bu Adres Banka veya EST Firması Tarafından Verilir
    $ch			=	@curl_init();
    @curl_setopt($ch, CURLOPT_URL,$url);
    @curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,1);
    @curl_setopt($ch, CURLOPT_SSLVERSION, 3);
    @curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
    @curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    @curl_setopt($ch, CURLOPT_TIMEOUT, 90);
    @curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
    $result		=	@curl_exec($ch);
    if(@curl_errno($ch)){
        print @curl_error($ch);
    }else{
        @curl_close($ch);
    }
    $Response		=	"";
    $OrderId		=	"";
    $AuthCode		=	"";
    $ProcReturnCode	=	"";
    $ErrMsg			=	"";
    $HOSTMSG		=	"";
    $HostRefNum		=	"";
    $TransId		=	"";
    $response_tag	=	"Response";
    $posf			=	@strpos($result,("<".$response_tag.">"));
    $posl			=	@strpos($result,("</".$response_tag.">"));
    $posf			=	$posf+@strlen($response_tag)+2 ;
    $Response		=	@substr($result,$posf,$posl-$posf);
    $response_tag	=	"OrderId";
    $posf			=	@strpos($result,("<".$response_tag.">"));
    $posl			=	@strpos($result,("</".$response_tag.">")) ;
    $posf			=	$posf+@strlen($response_tag)+2;
    $OrderId		=	@substr($result,$posf,$posl-$posf);
    $response_tag	=	"AuthCode";
    $posf			=	@strpos($result,"<".$response_tag.">");
    $posl			=	@strpos($result,"</".$response_tag.">");
    $posf			=	$posf+@strlen($response_tag)+2 ;
    $AuthCode		=	@substr($result,$posf,$posl-$posf);
    $response_tag	=	"ProcReturnCode";
    $posf			=	@strpos($result,"<".$response_tag.">");
    $posl			=	@strpos($result,"</".$response_tag.">");
    $posf			=	$posf+@strlen($response_tag)+2 ;
    $ProcReturnCode	=	@substr($result,$posf,$posl-$posf);
    $response_tag	=	"ErrMsg";
    $posf			=	@strpos($result,"<".$response_tag.">");
    $posl			=	@strpos($result,"</".$response_tag.">");
    $posf			=	$posf+@strlen($response_tag)+2;
    $ErrMsg			=	@substr($result,$posf,$posl-$posf);
    $response_tag	=	"HostRefNum";
    $posf			=	@strpos($result,"<".$response_tag.">");
    $posl			=	@strpos($result,"</".$response_tag.">");
    $posf			=	$posf+@strlen($response_tag)+2;
    $HostRefNum		=	@substr($result,$posf,$posl-$posf);
    $response_tag	=	"TransId";
    $posf			=	@strpos($result,"<".$response_tag.">");
    $posl			=	@strpos($result,"</".$response_tag.">");
    $posf			=	$posf+@strlen($response_tag)+2;
    $$TransId		=	@substr($result,$posf,$posl-$posf);
    if($Response==="Approved"){
        $BasketQuery		=	$VeritabaniBaglantisi->prepare("SELECT * FROM basket WHERE BasketNO = ?");
        $BasketQuery->execute([$oid]);
        $BasketCount				=	$BasketQuery->rowCount();
        $BasketRecords				=	$BasketQuery->fetchAll(PDO::FETCH_ASSOC);
        if($BasketCount>0){

            foreach ($BasketItemsRecords as $BasketItemsLines) {
                $BasketID = $BasketItemsLines["id"];
                $BasketNO = $BasketItemsLines["BasketNO"];
                $BasketUserID = $BasketItemsLines["UserID"];
                $BasketItemID = $BasketItemsLines["ItemID"];
                $BasketAddressID = $BasketItemsLines["AddressID"];
                $BasketItemVariantID = $BasketItemsLines["VariantID"];
                $BasketShippingID = $BasketItemsLines["ShippingID"];
                $BasketItemAmount = $BasketItemsLines["ItemAmount"];
                $BasketPayment = $BasketItemsLines["Payment"];
                $BasketInstallment = $BasketItemsLines["Installment"];


                $ItemAboutQuery = $DatabaseConnect->prepare("SELECT * FROM items WHERE id = ? LIMIT 1");
                $ItemAboutQuery->execute([$BasketItemID]);
                $ItemRecords = $ItemAboutQuery->fetch(PDO::FETCH_ASSOC);

                $ItemType = $ItemRecords["ItemType"];
                $ItemName = $ItemRecords["ItemName"];
                $ItemPrice = $ItemRecords["ItemPrice"];
                $ItemCurrency = $ItemRecords["Currency"];
                $ItemShippingPrice = $ItemRecords["ShippingPrice"];
                $ItemPic = $ItemRecords["ItemPicOne"];
                $ItemVariantTitle = $ItemRecords["VariantTitle"];

                $ItemVariantQuery = $DatabaseConnect->prepare("SELECT * FROM itemsvariants WHERE id = ? LIMIT 1");
                $ItemVariantQuery->execute([$BasketItemVariantID]);
                $VariantinfoRecords = $ItemVariantQuery->fetch(PDO::FETCH_ASSOC);
                $ItemVariantName = $VariantinfoRecords["VariantName"];

                $ShippingQuery = $DatabaseConnect->prepare("SELECT * FROM cargocompanies");
                $ShippingQuery->execute();
                $ShippingRecords = $ShippingQuery->fetchAll(PDO::FETCH_ASSOC);
                $ShippingName = $ShippingRecords["CargoCompanyName"];

                $AddressQuery = $DatabaseConnect->prepare("SELECT * FROM addresses WHERE UserID = ? ORDER BY id DESC");
                $AddressQuery->execute([$UserID]);
                $AddressRecords = $AddressQuery->fetchAll(PDO::FETCH_ASSOC);

                $AddressNameSurname = $AddressRecords["NameSurname"];
                $Address = $AddressRecords["Address"];
                $AdresIlce = $AddressRecords["District"];
                $AddressDistrict = $AddressRecords["City"];
                $AddressWrite = $Address . " " . $AdresIlce . " " . $AddressDistrict;
                $AddressPhoneNumber = $AddressRecords["PhoneNumber"];

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
                $BasketTotalShippingPriceFormat = ($ItemShippingPrice * $BasketItemAmount);

                $AddOrders = $DatabaseConnect->prepare("INSERT INTO orders (UserID, OrderNO, ItemID, ItemType, ItemName, ItemPrice , ItemAmount, TotalItemPrice, ShippingChoice, ShippingPrice, ItemPicOne, VariantTitle, VariantChoice, AddressNameSurname, AddressDetail, AddressPhone, Payment, Installment, OrderDate, OrderIPaddress) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $AddOrders->execute([$BasketUserID, $BasketNO, $BasketItemID, $ItemType, $ItemName, $ItemPriceChange, $BasketItemAmount, $ItemTotalPrice, $ShippingName, $BasketTotalShippingPriceFormat, $ItemPic, $ItemVariantTitle, $ItemVariantName, $AddressNameSurname, $AddressWrite, $AddressPhoneNumber, $IncomingPayment, 0, $TimeTamp, $IPAddress]);
                $Control = $AddOrders->rowCount();
            }

            if ($Control > 0) {


                    $BasketDeleteQuery = $DatabaseConnect->prepare("DELETE FROM basket WHERE id = ? AND UserID = ? LIMIT 1");
                    $BasketDeleteQuery->execute([$BasketID, $UserID]);

                    $ItemSalesUpper = $DatabaseConnect->prepare("UPDATE items SET SalesAmount=SalesAmount + ? WHERE id = ?");
                    $ItemSalesUpper->execute([$BasketItemAmount, $BasketItemID]);

                    $BasketUpdateQuery = $DatabaseConnect->prepare("UPDATE basket SET ItemAmaount= ? WHERE id = ? AND UserID = ? LIMIT 1");
                    $BasketUpdateQuery->execute([$BasketItemAmount, $BasketItemVariantID]);
                }
            }
        }else{
            echo "ERROR = ".$ErrMsg;
        }
    }else{
        echo "Credit Card Bank Didn't Give 3D Approval, Please Check Your Information and Try Again. If your problem persists, please contact the customer representatives of the bank that owns your card.";
    }

    $DatabaseConnect	=	null;
    ob_end_flush();

    ?>