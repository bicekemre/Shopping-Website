<?php
if(isset($_SESSION["Admin"])){
    if(isset($_POST["ItemMenu"])){
        $IncomingItemMenu			=	Safety($_POST["ItemMenu"]);
    }else{
        $IncomingItemMenu			=	"";
    }
    if(isset($_POST["ItemName"])){
        $IncomingItemName				=	Safety($_POST["ItemName"]);
    }else{
        $IncomingItemName				=	"";
    }
    if(isset($_POST["ItemPrice"])){
        $IncomingItemPrice			=	Safety($_POST["ItemPrice"]);
    }else{
        $IncomingItemPrice			=	"";
    }
    if(isset($_POST["Currency"])){
        $IncomingCurrency			=	Safety($_POST["Currency"]);
    }else{
        $IncomingCurrency			=	"";
    }
    if(isset($_POST["ShippingPrice"])){
        $IncomingShippingPrice			=	Safety($_POST["ShippingPrice"]);
    }else{
        $IncomingShippingPrice			=	"";
    }
    if(isset($_POST["ItemAbout"])){
        $IncomingItemAbout		=	Safety($_POST["ItemAbout"]);
    }else{
        $IncomingItemAbout		=	"";
    }
    if(isset($_POST["VariantTitle"])){
        $IncomingVariantTitle		=	Safety($_POST["VariantTitle"]);
    }else{
        $IncomingVariantTitle		=	"";
    }
    if(isset($_POST["VariantName1"])){
        $IncomingVariantName1			=	Safety($_POST["VariantName1"]);
    }else{
        $IncomingVariantName1			=	"";
    }
    if(isset($_POST["StockNumber1"])){
        $IncomingStockNumber1			=	Safety($_POST["StockNumber1"]);
    }else{
        $IncomingStockNumber1			=	"";
    }
    if(isset($_POST["VariantName2"])){
        $IncomingVariantName2			=	Safety($_POST["VariantName2"]);
    }else{
        $IncomingVariantName2			=	"";
    }
    if(isset($_POST["StockNumber2"])){
        $IncomingStockNumber2			=	Safety($_POST["StockNumber2"]);
    }else{
        $IncomingStockNumber2			=	"";
    }
    if(isset($_POST["VariantName3"])){
        $IncomingVariantName3			=	Safety($_POST["VariantName3"]);
    }else{
        $IncomingVariantName3			=	"";
    }
    if(isset($_POST["StockNumber3"])){
        $IncomingStockNumber3			=	Safety($_POST["StockNumber3"]);
    }else{
        $IncomingStockNumber3			=	"";
    }
    if(isset($_POST["VariantName4"])){
        $IncomingVariantName4			=	Safety($_POST["VariantName4"]);
    }else{
        $IncomingVariantName4			=	"";
    }
    if(isset($_POST["StockNumber4"])){
        $IncomingStockNumber4			=	Safety($_POST["StockNumber4"]);
    }else{
        $IncomingStockNumber4			=	"";
    }
    if(isset($_POST["VariantName5"])){
        $IncomingVariantName5			=	Safety($_POST["VariantName5"]);
    }else{
        $IncomingVariantName5			=	"";
    }
    if(isset($_POST["StockNumber5"])){
        $IncomingStockNumber5			=	Safety($_POST["StockNumber5"]);
    }else{
        $IncomingStockNumber5			=	"";
    }
    if(isset($_POST["VariantName6"])){
        $IncomingVariantName6			=	Safety($_POST["VariantName6"]);
    }else{
        $IncomingVariantName6			=	"";
    }
    if(isset($_POST["StockNumber6"])){
        $IncomingStockNumber6			=	Safety($_POST["StockNumber6"]);
    }else{
        $IncomingStockNumber6			=	"";
    }
    if(isset($_POST["VariantName7"])){
        $IncomingVariantName7			=	Safety($_POST["VariantName7"]);
    }else{
        $IncomingVariantName7			=	"";
    }
    if(isset($_POST["StockNumber7"])){
        $IncomingStockNumber7			=	Safety($_POST["StockNumber7"]);
    }else{
        $IncomingStockNumber7			=	"";
    }
    if(isset($_POST["VariantName8"])){
        $IncomingVariantName8			=	Safety($_POST["VariantName8"]);
    }else{
        $IncomingVariantName8			=	"";
    }
    if(isset($_POST["StockNumber8"])){
        $IncomingStockNumber8			=	Safety($_POST["StockNumber8"]);
    }else{
        $IncomingStockNumber8			=	"";
    }
    if(isset($_POST["VariantName9"])){
        $IncomingVariantName9			=	Safety($_POST["VariantName9"]);
    }else{
        $IncomingVariantName9			=	"";
    }
    if(isset($_POST["StockNumber9"])){
        $IncomingStockNumber9			=	Safety($_POST["StockNumber9"]);
    }else{
        $IncomingStockNumber9			=	"";
    }
    if(isset($_POST["VariantName10"])){
        $IncomingVariantName10			=	Safety($_POST["VariantName10"]);
    }else{
        $IncomingVariantName10			=	"";
    }
    if(isset($_POST["StockNumber10"])){
        $IncomingStockNumber10			=	Safety($_POST["StockNumber10"]);
    }else{
        $IncomingStockNumber10			=	"";
    }
    $IncomingItemPic1					=	$_FILES["ItemPic1"];
    $IncomingItemPic2					=	$_FILES["ItemPic2"];
    $IncomingItemPic3					=	$_FILES["ItemPic3"];
    $IncomingItemPic4					=	$_FILES["ItemPic4"];

    if(($IncomingItemMenu!="") and ($IncomingItemName!="") and ($IncomingItemPrice!="") and ($IncomingCurrency!="") and ($IncomingShippingPrice!="") and ($IncomingItemAbout!="") and ($IncomingVariantTitle!="") and ($IncomingVariantName1!="") and ($IncomingStockNumber1!="") and ($IncomingItemPic1["name"]!="") and ($IncomingItemPic1["type"]!="") and ($IncomingItemPic1["tmp_name"]!="") and ($IncomingItemPic1["error"]==0) and ($IncomingItemPic1["size"]>0)){
        $MenuTypeQuery		=	$DatabaseConnect->prepare("SELECT * FROM menus WHERE id = ? LIMIT 1");
        $MenuTypeQuery->execute([$IncomingItemMenu]);
        $MenuTypeControl		    =	$MenuTypeQuery->rowCount();
        $MenuTypeRecords			=	$MenuTypeQuery->fetch(PDO::FETCH_ASSOC);

        if($MenuTypeRecords["ItemType"] == "Phone"){
            $PicturePath	=	"Phone";
        }elseif($MenuTypeRecords["ItemType"] == "Computer"){
            $PicturePath	=	"Computer";
        }elseif($MenuTypeRecords["ItemType"] == ""){
            //another ıtem types
            die();
        }

        if($MenuTypeControl>0){
            $PictureName1		=	PictureNameCreate();
            $IncomingPicExtension1		=	substr($IncomingItemPic1["name"], -4);
            if($IncomingPicExtension1=="jpeg"){
                $IncomingPicExtension1		=	".".$IncomingPicExtension1;
            }
            $NewNameforPic1		=	$PictureName1.$IncomingPicExtension1;

            $ItemAddQuery		=	$DatabaseConnect->prepare("INSERT INTO items (MenuId, ItemType, ItemName, ItemPrice, Currency, ItemAbout, ItemPicOne, VariantTitle, ShippingPrice, Status) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $ItemAddQuery->execute([$IncomingItemMenu, $MenuTypeRecords["ItemType"], $IncomingItemName, $IncomingItemPrice, $IncomingCurrency, $IncomingItemAbout, $NewNameforPic1, $IncomingVariantTitle, $IncomingShippingPrice, 1]);
            $ItemAddControl		=	$ItemAddQuery->rowCount();

            if($ItemAddControl>0){
                $LastAddedItemID		=	$DatabaseConnect->lastInsertId();

                $foo	=	new Verot\Upload\Upload($IncomingItemPic1);
                if($foo->uploaded){
                    $foo->mime_magic_check			=	true;
                    $foo->allowed					=	array("image/*");
                    $foo->file_new_name_body		=	$PictureName1;
                    $foo->file_overwrite			=	true;
                    //$foo->image_convert			=	"png";
                    $foo->image_quality			=	100;
                    $foo->image_background_color	=	"#FFFFFF";
                    $foo->image_resize				=	true;
                    $foo->image_x					=	600;
                    $foo->image_y					=	800;
                    $foo->process($ImagesPathforVerot. '/ItemPictures/' .$PicturePath);

                    if($foo->processed){
                        $foo->clean();
                    }else{
                        header("Location:index.php?PageCodeLog=0&PageCodeA=98");
                        exit();
                    }
                }

                $MenuUpdateQuery	=	$DatabaseConnect->prepare("UPDATE menus SET ItemAmount=ItemAmount+1 WHERE id = ? LIMIT 1");
                $MenuUpdateQuery->execute([$IncomingItemMenu]);
                $MenuUpdateControl	=	$MenuUpdateQuery->rowCount();

                if($MenuUpdateControl>0){
                    $FirstAddVariantQuery		=	$DatabaseConnect->prepare("INSERT INTO itemsvariants (ItemID, VariantName, StockNumber) values (?, ?, ?)");
                    $FirstAddVariantQuery->execute([$LastAddedItemID, $IncomingVariantName1, $IncomingStockNumber1]);
                    $FirstVaryantControl		=	$FirstAddVariantQuery->rowCount();

                    if($FirstVaryantControl>0){
                        if(($IncomingVariantName2!="") and ($IncomingStockNumber2!="")){
                            $SecondAddVariantQuery		=	$DatabaseConnect->prepare("INSERT INTO itemsvariants (ItemID, VariantName, StockNumber) values (?, ?, ?)");
                            $SecondAddVariantQuery->execute([$LastAddedItemID, $IncomingVariantName2, $IncomingStockNumber2]);
                        }
                        if(($IncomingVariantName3!="") and ($IncomingStockNumber3!="")){
                            $ThirdAddVariantQuery		=	$DatabaseConnect->prepare("INSERT INTO itemsvariants (ItemID, VariantName, StockNumber) values (?, ?, ?)");
                            $ThirdAddVariantQuery->execute([$LastAddedItemID, $IncomingVariantName3, $IncomingStockNumber3]);
                        }
                        if(($IncomingVariantName4!="") and ($IncomingStockNumber4!="")){
                            $FourthAddVariantQuery	=	$DatabaseConnect->prepare("INSERT INTO itemsvariants (ItemID, VariantName, StockNumber) values (?, ?, ?)");
                            $FourthAddVariantQuery->execute([$LastAddedItemID, $IncomingVariantName4, $IncomingStockNumber4]);
                        }
                        if(($IncomingVariantName5!="") and ($IncomingStockNumber5!="")){
                            $FifthAddVariantQuery	=	$DatabaseConnect->prepare("INSERT INTO itemsvariants (ItemID, VariantName, StockNumber) values (?, ?, ?)");
                            $FifthAddVariantQuery->execute([$LastAddedItemID, $IncomingVariantName5, $IncomingStockNumber5]);
                        }
                        if(($IncomingVariantName6!="") and ($IncomingStockNumber6!="")){
                            $SixthAddVariantQuery	=	$DatabaseConnect->prepare("INSERT INTO itemsvariants (ItemID, VariantName, StockNumber) values (?, ?, ?)");
                            $SixthAddVariantQuery->execute([$LastAddedItemID, $IncomingVariantName6, $IncomingStockNumber6]);
                        }
                        if(($IncomingVariantName7!="") and ($IncomingStockNumber7!="")){
                            $SeventhAddVariantQuery	=	$DatabaseConnect->prepare("INSERT INTO itemsvariants (ItemID, VariantName, StockNumber) values (?, ?, ?)");
                            $SeventhAddVariantQuery->execute([$LastAddedItemID, $IncomingVariantName7, $IncomingStockNumber7]);
                        }
                        if(($IncomingVariantName8!="") and ($IncomingStockNumber8!="")){
                            $EgihthAddVariantQuery	=	$DatabaseConnect->prepare("INSERT INTO itemsvariants (ItemID, VariantName, StockNumber) values (?, ?, ?)");
                            $EgihthAddVariantQuery->execute([$LastAddedItemID, $IncomingVariantName8, $IncomingStockNumber8]);
                        }
                        if(($IncomingVariantName9!="") and ($IncomingStockNumber9!="")){
                            $NinthAddVariantQuery	=	$DatabaseConnect->prepare("INSERT INTO itemsvariants (ItemID, VariantName, StockNumber) values (?, ?, ?)");
                            $NinthAddVariantQuery->execute([$LastAddedItemID, $IncomingVariantName9, $IncomingStockNumber9]);
                        }
                        if(($IncomingVariantName10!="") and ($IncomingStockNumber10!="")){
                            $TenthAddVariantQuery		=	$DatabaseConnect->prepare("INSERT INTO itemsvariants (ItemID, VariantName, StockNumber) values (?, ?, ?)");
                            $TenthAddVariantQuery->execute([$LastAddedItemID, $IncomingVariantName10, $IncomingStockNumber10]);
                        }

                        if(($IncomingItemPic2["name"]!="") and ($IncomingItemPic2["type"]!="") and ($IncomingItemPic2["tmp_name"]!="") and ($IncomingItemPic2["error"]==0) and ($IncomingItemPic2["size"]>0)){
                            $PictureName2		=	PictureNameCreate();
                            $IncomingPicExtension2		=	substr($IncomingItemPic2["name"], -4);
                            if($IncomingPicExtension2=="jpeg"){
                                $IncomingPicExtension2		=	".".$IncomingPicExtension2;
                            }
                            $NewNameforPic2	=	$PictureName2.$IncomingPicExtension2;


                            $foo	=	new Verot\Upload\Upload($IncomingItemPic2);
                            if($foo->uploaded){
                                $foo->mime_magic_check			=	true;
                                $foo->allowed					=	array("image/*");
                                $foo->file_new_name_body		=	$PictureName2;
                                $foo->file_overwrite			=	true;
                                //$foo->image_convert			=	"png";
                                $foo->image_quality				=	100;
                                $foo->image_background_color	=	"#FFFFFF";
                                $foo->image_resize				=	true;
                                $foo->image_x					=	600;
                                $foo->image_y					=	800;
                                $foo->process($ImagesPathforVerot. '/ItemPictures/' .$PicturePath);

                                if($foo->processed){
                                    $SecondItemPicUpdateQuery	=	$DatabaseConnect->prepare("UPDATE items SET ItemPicTwo = ? WHERE id = ? LIMIT 1");
                                    $SecondItemPicUpdateQuery->execute([$NewNameforPic2, $LastAddedItemID]);
                                    $SecondItemPicUpdateControl	=	$SecondItemPicUpdateQuery->rowCount();

                                    if($SecondItemPicUpdateControl<1){
                                        header("Location:index.php?PageCodeLog=0&PageCodeA=98");
                                        exit();
                                    }

                                    $foo->clean();
                                }else{
                                    header("Location:index.php?PageCodeLog=0&PageCodeA=98");
                                    exit();
                                }
                            }
                        }

                        if(($IncomingItemPic3["name"]!="") and ($IncomingItemPic3["type"]!="") and ($IncomingItemPic3["tmp_name"]!="") and ($IncomingItemPic3["error"]==0) and ($IncomingItemPic3["size"]>0)){
                            $PictureName3		=	PictureNameCreate();
                            $IncomingPicExtension3		=	substr($IncomingItemPic3["name"], -4);
                            if($IncomingPicExtension3=="jpeg"){
                                $IncomingPicExtension3		=	".".$IncomingPicExtension3;
                            }
                            $NewNameforPic3	=	$PictureName3.$IncomingPicExtension3;

                            $foo	=	new Verot\Upload\Upload($IncomingItemPic3);
                            if($foo->uploaded){
                                $foo->mime_magic_check			=	true;
                                $foo->allowed					=	array("image/*");
                                $foo->file_new_name_body		=	$PictureName3;
                                $foo->file_overwrite			=	true;
                                //$foo->image_convert			=	"png";
                                $foo->image_quality				=	100;
                                $foo->image_background_color	=	"#FFFFFF";
                                $foo->image_resize				=	true;
                                $foo->image_x					=	600;
                                $foo->image_y					=	800;
                                $foo->process($ImagesPathforVerot.$PicturePath);

                                if($foo->processed){
                                    $ThirdItemPicUpdateQuery	=	$DatabaseConnect->prepare("UPDATE items SET ItemPicThree = ? WHERE id = ? LIMIT 1");
                                    $ThirdItemPicUpdateQuery->execute([$NewNameforPic3, $LastAddedItemID]);
                                    $ThirdItemPicUpdateControl	=	$ThirdItemPicUpdateQuery->rowCount();

                                    if($ThirdItemPicUpdateControl<1){
                                        header("Location:index.php?PageCodeLog=0&PageCodeA=98");
                                        exit();
                                    }

                                    $foo->clean();
                                }else{
                                    header("Location:index.php?PageCodeLog=0&PageCodeA=98");
                                    exit();
                                }
                            }
                        }

                        if(($IncomingItemPic4["name"]!="") and ($IncomingItemPic4["type"]!="") and ($IncomingItemPic4["tmp_name"]!="") and ($IncomingItemPic4["error"]==0) and ($IncomingItemPic4["size"]>0)){
                            $PictureName4		=	PictureNameCreate();
                            $IncomingPicExtension4	=	substr($IncomingItemPic4["name"], -4);
                            if($IncomingPicExtension4=="jpeg"){
                                $IncomingPicExtension4		=	".".$IncomingPicExtension4;
                            }
                            $NewNameforPic4	=	$PictureName4.$IncomingPicExtension4;

                            $foo	=	new Verot\Upload\Upload($IncomingItemPic4);
                            if($foo->uploaded){
                                $foo->mime_magic_check			=	true;
                                $foo->allowed						=	array("image/*");
                                $foo->file_new_name_body			=	$PictureName4;
                                $foo->file_overwrite				=	true;
                                //$foo->image_convert				=	"png";
                                $foo->image_quality				=	100;
                                $foo->image_background_color		=	"#FFFFFF";
                                $foo->image_resize				=	true;
                                $foo->image_x						=	600;
                                $foo->image_y						=	800;
                                $foo->process($ImagesPathforVerot.$PicturePath);

                                if($foo->processed){
                                    $FourthItemPicUpdateQuery	=	$DatabaseConnect->prepare("UPDATE items SET ItemPicFour = ? WHERE id = ? LIMIT 1");
                                    $FourthItemPicUpdateQuery->execute([$NewNameforPic4, $LastAddedItemID]);
                                    $FourthItemPicUpdateControl	=	$FourthItemPicUpdateQuery->rowCount();

                                    if($FourthItemPicUpdateControl<1){
                                        header("Location:index.php?PageCodeLog=0&PageCodeA=98");
                                        exit();
                                    }

                                    $foo->clean();
                                }else{
                                    header("Location:index.php?PageCodeLog=0&PageCodeA=98");
                                    exit();
                                }
                            }
                        }

                        header("Location:index.php?PageCodeLog=0&PageCodeA=97");
                        exit();
                    }else{
                        header("Location:index.php?PageCodeLog=0&PageCodeA=98");
                        exit();
                    }
                }else{
                    header("Location:index.php?PageCodeLog=0&PageCodeA=98");
                    exit();
                }
            }else{
                header("Location:index.php?PageCodeLog=0&PageCodeA=98");
                exit();
            }
        }else{
            header("Location:index.php?PageCodeLog=0&PageCodeA=98");
            exit();
        }
    }else{
        header("Location:index.php?PageCodeLog=0&PageCodeA=98");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>