<form action="index.php?PageCode=9" method="post">
    <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="100" bgcolor="#b8860b">
            <td align="left"><h2 style="color: white;">&nbsp;FREQUENTLY ASKED QUESTIONS</h2></td>
        </tr>
        <tr height="50">
            <td align="left" style="border-bottom: 1px dashed #CCCCCC;">&nbsp;If you have any questions, you can contact us from the <a href="index.php?PageCode=11" style="text-decoration: none">here.</a></td>
        </tr>
        <tr>
            <td><?php
            $QuestionQuery 			=	$DatabaseConnect->prepare("SELECT * FROM questions");
            $QuestionQuery->execute();
            $QuestionCount	    =	$QuestionQuery->rowCount();
            $QuestionRegis		=	$QuestionQuery->fetchAll(PDO::FETCH_ASSOC);

            foreach ($QuestionRegis as $Questions){
            ?>
                <div>
                    <div id="<?php echo $Questions["id"]; ?>" class="QuestionTitle" onclick="$.ShowAnswers(<?php echo $Questions["id"]; ?>)"><?php echo $Questions["question"]; ?></div>
                    <div class="AnswersArea" style="display: none;"><?php echo $Questions["answer"]; ?></div>
                </div>
            <?php } ?>
            </td>
        </tr>
    </table>
</form>