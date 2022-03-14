<?php
if(isset($_SESSION["Admin"])){
    if(isset($_GET["ID"])){
        $IncomingID			=	Safety($_GET["ID"]);
    }else{
        $IncomingID			=	"";
    }
    if (isset($_POST["question"])){
        $Incomingquestion       =  Safety($_POST["question"]);
    }else{
        $Incomingquestion       =  ";";
    }
    if (isset($_POST["answer"])){
        $Incominganswer      =  Safety($_POST["answer"]);
    }else{
        $Incominganswer      =  ";";
    }

    if(($IncomingID!="") and ($Incomingquestion!="") and ($Incominganswer!="")){

        $Query = $DatabaseConnect->prepare("UPDATE questions SET question = ?, answer = ? WHERE id = ? LIMIT 1");
        $Query->execute([$Incomingquestion, $Incominganswer, $IncomingID]);
        $QueryControl = $Query->rowCount();

        if($QueryControl>0){

        header("Location:index.php?PageCodeLog=0&PageCodeA=52");
        exit();
    }else{
            header("Location:index.php?PageCodeLog=0&PageCodeA=53");
            exit();
        }
    }else{
        header("Location:index.php?PageCodeLog=0&PageCodeA=53");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>