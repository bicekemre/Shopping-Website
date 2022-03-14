$(document).ready(function(){

    $.ShowAnswers			=	function(ClickedID){
        var QuestionID			=	ClickedID;
        var ClickedArea		=	"#" + ClickedID;
        $(".AnswersArea").slideUp();
        $(IslenecekAlan).parent().find(".AnswersArea").slideToggle();
    }
});