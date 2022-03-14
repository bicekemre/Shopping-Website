<?php
if(isset($_SESSION["Admin"])){
    if(isset($_GET["ID"])){
        $IncomingID			=	Safety($_GET["ID"]);
    }else{
        $IncomingID			=	"";
    }
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
        die('dsdasdsa');
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

    if(($IncomingItemMenu!="") and ($IncomingItemName!="") and ($IncomingItemPrice!="") and ($IncomingCurrency!="") and ($IncomingShippingPrice!="") and ($IncomingItemAbout!="") and ($IncomingVariantTitle!="") and ($IncomingVariantName1!="") and ($IncomingStockNumber1!="")){
        $Query = $DatabaseConnect->prepare("SELECT * FROM items WHERE  id = ? LIMIT 1");
        $Query->execute([$IncomingID]);
        $Count = $Query->rowCount();
        $Records		=	$Query->fetch(PDO::FETCH_ASSOC);

        if($Count>0){


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
                $ItemUpdateQuery		=	$DatabaseConnect->prepare("UPDATE items SET MenuID = ?, ItemName = ?, ItemPrice = ?, Currency = ?, ItemAbout = ?, VariantTitle = ?, ShippingPrice = ? WHERE id = ? LIMIT 1");
                $ItemUpdateQuery->execute([$IncomingItemMenu, $IncomingItemName, $IncomingItemPrice, $IncomingCurrency, $IncomingItemAbout, $IncomingVariantTitle, $IncomingShippingPrice, $IncomingID]);
                $ItemUpdateControl		=	$ItemUpdateQuery->rowCount();

                if(($IncomingItemPic1["name"]!="") and ($IncomingItemPic1["type"]!="") and ($IncomingItemPic1["tmp_name"]!="") and ($IncomingItemPic1["error"]==0) and ($IncomingItemPic1["size"]>0)){
                    $PictureName1		=	PictureNameCreate();
                    $IncomingPicExtension1		=	substr($IncomingItemPic1["name"], -4);
                    if($IncomingPicExtension1=="jpeg"){
                        $IncomingPicExtension1		=	".".$IncomingPicExtension1;
                    }
                    $NewNameforPic1		=	$PictureName1.$IncomingPicExtension1;

                    $foo	=	new Verot\Upload\Upload($IncomingItemPic1);
                    if($foo->uploaded){
                        $foo->mime_magic_check			=	true;
                        $foo->allowed					=	array("image/*");
                        $foo->file_new_name_body		=	$NewNameforPic1;
                        $foo->file_overwrite			=	true;
                        //$foo->image_convert			=	"png";
                        $foo->image_quality			=	100;
                        $foo->image_background_color	=	"#FFFFFF";
                        $foo->image_resize				=	true;
                        $foo->image_x					=	600;
                        $foo->image_y					=	800;
                        $foo->process($ImagesPathforVerot.$PicturePath);

                        if($foo->processed){
                            $DeletingPath		=	"../Images/".$PicturePath.$Records["ItemPicOne"];
                            unlink($DeletingPath);

                            $PicUpdateQuery	=	$DatabaseConnect->prepare("UPDATE items SET ItemPicOne = ? WHERE id = ? LIMIT 1");
                            $PicUpdateQuery->execute([$NewNameforPic1, $IncomingID]);
                            $PicUpdateControl	=	$PicUpdateQuery->rowCount();

                            if($PicUpdateControl<1){
                                header("Location:index.php?PageCodeLog=0&PageCodeA=102");
                                exit();
                            }

                            $foo->clean();
                        }else{
                            header("Location:index.php?PageCodeLog=0&PageCodeA=102");
                            exit();
                        }
                    }
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
                        $foo->process($ImagesPathforVerot.$PicturePath);

                        if($foo->processed){
                            $DeletingPath		=	"../Images/".$PicturePath.$Records["ItemPicTwo"];
                            unlink($DeletingPath);

                            $PicUpdateQuery	=	$DatabaseConnect->prepare("UPDATE items SET ItemPicTwo = ? WHERE id = ? LIMIT 1");
                            $PicUpdateQuery->execute([$NewNameforPic2, $IncomingID]);
                            $PicUpdateControl	=	$PicUpdateQuery->rowCount();

                            if($PicUpdateControl<1){
                                header("Location:index.php?PageCodeLog=0&PageCodeA=102");
                                exit();
                            }

                            $foo->clean();
                        }else{
                            header("Location:index.php?PageCodeLog=0&PageCodeA=102");
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
                            $DeletingPath		=	"../Images/".$PicturePath.$Records["ItemPicThree"];
                            unlink($DeletingPath);

                            $PicUpdateQuery	=	$DatabaseConnect->prepare("UPDATE items SET ItemPicThree = ? WHERE id = ? LIMIT 1");
                            $PicUpdateQuery->execute([$NewNameforPic3, $IncomingID]);
                            $PicUpdateControl	=	$PicUpdateQuery->rowCount();

                            if($PicUpdateControl<1){
                                header("Location:index.php?PageCodeLog=0&PageCodeA=102");
                                exit();
                            }

                            $foo->clean();
                        }else{
                            header("Location:index.php?PageCodeLog=0&PageCodeA=102");
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
                            $DeletingPath		=	"../Images/".$PicturePath.$Records["ItemPicFour"];
                            unlink($DeletingPath);

                            $PicUpdateQuery	=	$DatabaseConnect->prepare("UPDATE items SET ItemPicFour = ? WHERE id = ? LIMIT 1");
                            $PicUpdateQuery->execute([$NewNameforPic4, $IncomingID]);
                            $PicUpdateControl	=	$PicUpdateQuery->rowCount();

                            if($PicUpdateControl<1){
                                header("Location:index.php?PageCodeLog=0&PageCodeA=102");
                                exit();
                            }

                            $foo->clean();
                        }else{
                            header("Location:index.php?PageCodeLog=0&PageCodeA=102");
                            exit();
                        }
                    }
                }

                $VariantQuery	=	$DatabaseConnect->prepare("SELECT * FROM itemsvariants WHERE ItemID = ?");
                $VariantQuery->execute([$IncomingID]);
                $VariantCount		=	$VariantQuery->rowCount();
                $VariantRecords		=	$VariantQuery->fetchAll(PDO::FETCH_ASSOC);

                $VariantNameArray	=	array();

                foreach($VariantRecords as $Variant){
                    $VariantNameArray[]	=	$Variant["VariantName"];
                }

                if(array_key_exists(0, $VariantNameArray)){
                    if(($IncomingVariantName1!="") and ($IncomingStockNumber1!="")){
                        $BirinciVariantUpdateQuery	=	$DatabaseConnect->prepare("UPDATE itemsvariants SET VariantName = ?, StockNumber = ? WHERE ItemID = ? AND VariantName = ? LIMIT 1");
                        $BirinciVariantUpdateQuery->execute([$IncomingVariantName1, $IncomingStockNumber1, $IncomingID, $VariantNameArray[0]]);
                        $BirinciVariantUpdateControl	=	$BirinciVariantUpdateQuery->rowCount();
                    }
                }

                if(array_key_exists(1, $VariantNameArray)){
                    if(($IncomingVariantName2!="") and ($IncomingStockNumber2!="")){
                        $VariantUpdateQuery	=	$DatabaseConnect->prepare("UPDATE itemsvariants SET VariantName = ?, StockNumber = ? WHERE ItemID = ? AND VariantName = ? LIMIT 1");
                        $VariantUpdateQuery->execute([$IncomingVariantName2, $IncomingStockNumber2, $IncomingID, $VariantNameArray[1]]);
                        $VariantUpdateControl	=	$VariantUpdateQuery->rowCount();
                    }else{
                        $VariantDeleteQuery		=	$DatabaseConnect->prepare("DELETE FROM itemsvariants WHERE ItemID = ? AND VariantName = ? LIMIT 1");
                        $VariantDeleteQuery->execute([$IncomingID, $VariantNameArray[1]]);
                        $VariantDeleteControl		=	$VariantDeleteQuery->rowCount();

                        if($VariantDeleteControl<1){
                            header("Location:index.php?PageCodeLog=0&PageCodeA=102");
                            exit();
                        }
                    }
                }else{
                    if(($IncomingVariantName2!="") and ($IncomingStockNumber2!="")){
                        $VariantAddQuery		=	$DatabaseConnect->prepare("INSERT INTO itemsvariants (ItemID, VariantName, StockNumber) values (?, ?, ?)");
                        $VariantAddQuery->execute([$IncomingID, $IncomingVariantName2, $IncomingStockNumber2]);
                        $VariantAddControl		=	$VariantAddQuery->rowCount();

                        if($VariantAddControl<1){
                            header("Location:index.php?PageCodeLog=0&PageCodeA=102");
                            exit();
                        }

                    }
                }

                if(array_key_exists(2, $VariantNameArray)){
                    if(($IncomingVariantName3!="") and ($IncomingStockNumber3!="")){
                        $VariantUpdateQuery	=	$DatabaseConnect->prepare("UPDATE itemsvariants SET VariantName = ?, StockNumber = ? WHERE ItemID = ? AND VariantName = ? LIMIT 1");
                        $VariantUpdateQuery->execute([$IncomingVariantName3, $IncomingStockNumber3, $IncomingID, $VariantNameArray[2]]);
                        $VariantUpdateControl	=	$VariantUpdateQuery->rowCount();
                    }else{
                        $VariantDeleteQuery		=	$DatabaseConnect->prepare("DELETE FROM itemsvariants WHERE ItemID = ? AND VariantName = ? LIMIT 1");
                        $VariantDeleteQuery->execute([$IncomingID, $VariantNameArray[2]]);
                        $VariantDeleteControl		=	$VariantDeleteQuery->rowCount();

                        if($VariantDeleteControl<1){
                            header("Location:index.php?PageCodeLog=0&PageCodeA=102");
                            exit();
                        }
                    }
                }else{
                    if(($IncomingVariantName3!="") and ($IncomingStockNumber3!="")){
                        $VariantAddQuery		=	$DatabaseConnect->prepare("INSERT INTO itemsvariants (ItemID, VariantName, StockNumber) values (?, ?, ?)");
                        $VariantAddQuery->execute([$IncomingID, $IncomingVariantName3, $IncomingStockNumber3]);
                        $VariantAddControl		=	$VariantAddQuery->rowCount();

                        if($VariantAddControl<1){
                            header("Location:index.php?PageCodeLog=0&PageCodeA=102");
                            exit();
                        }

                    }
                }

                if(array_key_exists(3, $VariantNameArray)){
                    if(($IncomingVariantName4!="") and ($IncomingStockNumber4!="")){
                        $VariantUpdateQuery	=	$DatabaseConnect->prepare("UPDATE itemsvariants SET VariantName = ?, StockNumber = ? WHERE ItemID = ? AND VariantName = ? LIMIT 1");
                        $VariantUpdateQuery->execute([$IncomingVariantName4, $IncomingStockNumber4, $IncomingID, $VariantNameArray[3]]);
                        $VariantUpdateControl	=	$VariantUpdateQuery->rowCount();
                    }else{
                        $VariantDeleteQuery		=	$DatabaseConnect->prepare("DELETE FROM itemsvariants WHERE ItemID = ? AND VariantName = ? LIMIT 1");
                        $VariantDeleteQuery->execute([$IncomingID, $VariantNameArray[3]]);
                        $VariantDeleteControl		=	$VariantDeleteQuery->rowCount();

                        if($VariantDeleteControl<1){
                            header("Location:index.php?PageCodeLog=0&PageCodeA=102");
                            exit();
                        }
                    }
                }else{
                    if(($IncomingVariantName4!="") and ($IncomingStockNumber4!="")){
                        $VariantAddQuery		=	$DatabaseConnect->prepare("INSERT INTO itemsvariants (ItemID, VariantName, StockNumber) values (?, ?, ?)");
                        $VariantAddQuery->execute([$IncomingID, $IncomingVariantName4, $IncomingStockNumber4]);
                        $VariantAddControl		=	$VariantAddQuery->rowCount();

                        if($VariantAddControl<1){
                            header("Location:index.php?PageCodeLog=0&PageCodeA=102");
                            exit();
                        }

                    }
                }

                if(array_key_exists(4, $VariantNameArray)){
                    if(($IncomingVariantName5!="") and ($IncomingStockNumber5!="")){
                        $VariantUpdateQuery	=	$DatabaseConnect->prepare("UPDATE itemsvariants SET VariantName = ?, StockNumber = ? WHERE ItemID = ? AND VariantName = ? LIMIT 1");
                        $VariantUpdateQuery->execute([$IncomingVariantName5, $IncomingStockNumber5, $IncomingID, $VariantNameArray[4]]);
                        $VariantUpdateControl	=	$VariantUpdateQuery->rowCount();
                    }else{
                        $VariantDeleteQuery		=	$DatabaseConnect->prepare("DELETE FROM itemsvariants WHERE ItemID = ? AND VariantName = ? LIMIT 1");
                        $VariantDeleteQuery->execute([$IncomingID, $VariantNameArray[4]]);
                        $VariantDeleteControl		=	$VariantDeleteQuery->rowCount();

                        if($VariantDeleteControl<1){
                            header("Location:index.php?PageCodeLog=0&PageCodeA=102");
                            exit();
                        }
                    }
                }else{
                    if(($IncomingVariantName5!="") and ($IncomingStockNumber5!="")){
                        $VariantAddQuery		=	$DatabaseConnect->prepare("INSERT INTO itemsvariants (ItemID, VariantName, StockNumber) values (?, ?, ?)");
                        $VariantAddQuery->execute([$IncomingID, $IncomingVariantName5, $IncomingStockNumber5]);
                        $VariantAddControl		=	$VariantAddQuery->rowCount();

                        if($VariantAddControl<1){
                            header("Location:index.php?PageCodeLog=0&PageCodeA=102");
                            exit();
                        }

                    }
                }

                if(array_key_exists(5, $VariantNameArray)){
                    if(($IncomingVariantName6!="") and ($IncomingStockNumber6!="")){
                        $VariantUpdateQuery	=	$DatabaseConnect->prepare("UPDATE itemsvariants SET VariantName = ?, StockNumber = ? WHERE ItemID = ? AND VariantName = ? LIMIT 1");
                        $VariantUpdateQuery->execute([$IncomingVariantName6, $IncomingStockNumber6, $IncomingID, $VariantNameArray[5]]);
                        $VariantUpdateControl	=	$VariantUpdateQuery->rowCount();
                    }else{
                        $VariantDeleteQuery		=	$DatabaseConnect->prepare("DELETE FROM itemsvariants WHERE ItemID = ? AND VariantName = ? LIMIT 1");
                        $VariantDeleteQuery->execute([$IncomingID, $VariantNameArray[5]]);
                        $VariantDeleteControl		=	$VariantDeleteQuery->rowCount();

                        if($VariantDeleteControl<1){
                            header("Location:index.php?PageCodeLog=0&PageCodeA=102");
                            exit();
                        }
                    }
                }else{
                    if(($IncomingVariantName6!="") and ($IncomingStockNumber6!="")){
                        $VariantAddQuery		=	$DatabaseConnect->prepare("INSERT INTO itemsvariants (ItemID, VariantName, StockNumber) values (?, ?, ?)");
                        $VariantAddQuery->execute([$IncomingID, $IncomingVariantName6, $IncomingStockNumber6]);
                        $VariantAddControl		=	$VariantAddQuery->rowCount();

                        if($VariantAddControl<1){
                            header("Location:index.php?PageCodeLog=0&PageCodeA=102");
                            exit();
                        }

                    }
                }

                if(array_key_exists(6, $VariantNameArray)){
                    if(($IncomingVariantName7!="") and ($IncomingStockNumber7!="")){
                        $VariantUpdateQuery	=	$DatabaseConnect->prepare("UPDATE itemsvariants SET VariantName = ?, StockNumber = ? WHERE ItemID = ? AND VariantName = ? LIMIT 1");
                        $VariantUpdateQuery->execute([$IncomingVariantName7, $IncomingStockNumber7, $IncomingID, $VariantNameArray[6]]);
                        $VariantUpdateControl	=	$VariantUpdateQuery->rowCount();
                    }else{
                        $VariantDeleteQuery		=	$DatabaseConnect->prepare("DELETE FROM itemsvariants WHERE ItemID = ? AND VariantName = ? LIMIT 1");
                        $VariantDeleteQuery->execute([$IncomingID, $VariantNameArray[6]]);
                        $VariantDeleteControl		=	$VariantDeleteQuery->rowCount();

                        if($VariantDeleteControl<1){
                            header("Location:index.php?PageCodeLog=0&PageCodeA=102");
                            exit();
                        }
                    }
                }else{
                    if(($IncomingVariantName7!="") and ($IncomingStockNumber7!="")){
                        $VariantAddQuery		=	$DatabaseConnect->prepare("INSERT INTO itemsvariants (ItemID, VariantName, StockNumber) values (?, ?, ?)");
                        $VariantAddQuery->execute([$IncomingID, $IncomingVariantName7, $IncomingStockNumber7]);
                        $VariantAddControl		=	$VariantAddQuery->rowCount();

                        if($VariantAddControl<1){
                            header("Location:index.php?PageCodeLog=0&PageCodeA=102");
                            exit();
                        }

                    }
                }

                if(array_key_exists(7, $VariantNameArray)){
                    if(($IncomingVariantName8!="") and ($IncomingStockNumber8!="")){
                        $VariantUpdateQuery	=	$DatabaseConnect->prepare("UPDATE itemsvariants SET VariantName = ?, StockNumber = ? WHERE ItemID = ? AND VariantName = ? LIMIT 1");
                        $VariantUpdateQuery->execute([$IncomingVariantName8, $IncomingStockNumber8, $IncomingID, $VariantNameArray[7]]);
                        $VariantUpdateControl	=	$VariantUpdateQuery->rowCount();
                    }else{
                        $VariantDeleteQuery		=	$DatabaseConnect->prepare("DELETE FROM itemsvariants WHERE ItemID = ? AND VariantName = ? LIMIT 1");
                        $VariantDeleteQuery->execute([$IncomingID, $VariantNameArray[7]]);
                        $VariantDeleteControl		=	$VariantDeleteQuery->rowCount();

                        if($VariantDeleteControl<1){
                            header("Location:index.php?PageCodeLog=0&PageCodeA=102");
                            exit();
                        }
                    }
                }else{
                    if(($IncomingVariantName8!="") and ($IncomingStockNumber8!="")){
                        $VariantAddQuery		=	$DatabaseConnect->prepare("INSERT INTO itemsvariants (ItemID, VariantName, StockNumber) values (?, ?, ?)");
                        $VariantAddQuery->execute([$IncomingID, $IncomingVariantName8, $IncomingStockNumber8]);
                        $VariantAddControl		=	$VariantAddQuery->rowCount();

                        if($VariantAddControl<1){
                            header("Location:index.php?PageCodeLog=0&PageCodeA=102");
                            exit();
                        }

                    }
                }

                if(array_key_exists(8, $VariantNameArray)){
                    if(($IncomingVariantName9!="") and ($IncomingStockNumber9!="")){
                        $VariantUpdateQuery	=	$DatabaseConnect->prepare("UPDATE itemsvariants SET VariantName = ?, StockNumber = ? WHERE ItemID = ? AND VariantName = ? LIMIT 1");
                        $VariantUpdateQuery->execute([$IncomingVariantName9, $IncomingStockNumber9, $IncomingID, $VariantNameArray[8]]);
                        $VariantUpdateControl	=	$VariantUpdateQuery->rowCount();
                    }else{
                        $VariantDeleteQuery		=	$DatabaseConnect->prepare("DELETE FROM itemsvariants WHERE ItemID = ? AND VariantName = ? LIMIT 1");
                        $VariantDeleteQuery->execute([$IncomingID, $VariantNameArray[8]]);
                        $VariantDeleteControl		=	$VariantDeleteQuery->rowCount();

                        if($VariantDeleteControl<1){
                            header("Location:index.php?PageCodeLog=0&PageCodeA=102");
                            exit();
                        }
                    }
                }else{
                    if(($IncomingVariantName9!="") and ($IncomingStockNumber9!="")){
                        $VariantAddQuery		=	$DatabaseConnect->prepare("INSERT INTO itemsvariants (ItemID, VariantName, StockNumber) values (?, ?, ?)");
                        $VariantAddQuery->execute([$IncomingID, $IncomingVariantName9, $IncomingStockNumber9]);
                        $VariantAddControl		=	$VariantAddQuery->rowCount();

                        if($VariantAddControl<1){
                            header("Location:index.php?PageCodeLog=0&PageCodeA=102");
                            exit();
                        }

                    }
                }

                if(array_key_exists(9, $VariantNameArray)){
                    if(($IncomingVariantName10!="") and ($IncomingStockNumber10!="")){
                        $VariantUpdateQuery	=	$DatabaseConnect->prepare("UPDATE itemsvariants SET VariantName = ?, StockNumber = ? WHERE ItemID = ? AND VariantName = ? LIMIT 1");
                        $VariantUpdateQuery->execute([$IncomingVariantName10, $IncomingStockNumber10, $IncomingID, $VariantNameArray[9]]);
                        $VariantUpdateControl	=	$VariantUpdateQuery->rowCount();
                    }else{
                        $VariantDeleteQuery		=	$DatabaseConnect->prepare("DELETE FROM itemsvariants WHERE ItemID = ? AND VariantName = ? LIMIT 1");
                        $VariantDeleteQuery->execute([$IncomingID, $VariantNameArray[9]]);
                        $VariantDeleteControl		=	$VariantDeleteQuery->rowCount();

                        if($VariantDeleteControl<1){
                            header("Location:index.php?PageCodeLog=0&PageCodeA=102");
                            exit();
                        }
                    }
                }else{
                    if(($IncomingVariantName10!="") and ($IncomingStockNumber10!="")){
                        $VariantAddQuery		=	$DatabaseConnect->prepare("INSERT INTO itemsvariants (ItemID, VariantName, StockNumber) values (?, ?, ?)");
                        $VariantAddQuery->execute([$IncomingID, $IncomingVariantName10, $IncomingStockNumber10]);
                        $VariantAddControl		=	$VariantAddQuery->rowCount();

                        if($VariantAddControl<1){
                            header("Location:index.php?PageCodeLog=0&PageCodeA=102");
                            exit();
                        }

                    }
                }

                header("Location:index.php?PageCodeLog=0&PageCodeA=101");
                exit();
            }else{
                header("Location:index.php?PageCodeLog=0&PageCodeA=102");
                exit();
            }
        }else{
            header("Location:index.php?PageCodeLog=0&PageCodeA=102");
            exit();
        }
    }else{
        header("Location:index.php?PageCodeLog=0&PageCodeA=102");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>