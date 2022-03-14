$(document).ready(function(){
    $.ShowAnswers			    =	function(ClickedID){
        var QuestionID			=	ClickedID;
        var ClickedArea		    =	"#" + ClickedID;
        $(".AnswersArea").slideUp();
        $(ClickedArea).parent().find(".AnswersArea").slideToggle();
    }
    $.ChangePicture             =   function(Path, Picture){
        var PicturePath         =   "Images/ItemPictures/" + Path + "/" + Picture;
        $("#BigPicture").attr("src", PicturePath);
    }

    $.CreditCard			=	function(){
        $(".MTArea").css("display", "none");
        $(".CCArea").css("display", "block");
    }

    $.MoneyTransfer			=	function(){
        $(".CCArea").css("display", "none");
        $(".MTArea").css("display", "block");
    }
});


