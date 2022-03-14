<?php
if(isset($_SESSION["Admin"])){
    if (isset($_POST["answer"])){
        $Incominganswer       =  Safety($_POST["answer"]);
    }else{
        $Incominganswer       =  ";";
    }
    if (isset($_POST["question"])){
        $Incomingquestion       =  Safety($_POST["question"]);
    }else{
        $Incomingquestion       =  ";";
    }

    if (($Incominganswer["size"]>0) and ($Incomingquestion!="")){

        $Query = $DatabaseConnect->prepare("INSERT INTO questions (question, answer) values (?, ?)");
        $Query->execute([$Incominganswer, $Incomingquestion]);
        $QueryControl = $Query->rowCount();

        if ($QueryControl>0){
            header("Location:index.php?PageCodeLog=0&PageCodeA=48");
            exit();
        }else{
            header("Location:index.php?PageCodeLog=0&PageCodeA=49");
            exit();
        }
    }else{
        header("Location:index.php?PageCodeLog=0&PageCodeA=49");
        exit();
    }
}else{
    header("Location:index.php?PageCodeLog=1");
    exit();
}
?>