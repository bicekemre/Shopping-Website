<?php

if(isset($_POST["CargoTrackNO"])){
    $CargoTrackNO		=	NumbersFilter(Safety($_POST["CargoTrackNO"]));
}else{
    $CargoTrackNO		=	"";
}

if($CargoTrackNO!=""){
    header("Location:https://www.yurticikargo.com/tr/online-servisler/gonderi-sorgula?code=" . $CargoTrackNO);
    exit();
}else{
    header("Location:index.php?PageCode=9");
    exit();
}
?>