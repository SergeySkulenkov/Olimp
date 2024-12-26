$(document).ready(function(){
    $('.downloadButton').on("click",function(){
         windowShow();
    });
    $('.windowClose').on("click",function(){
        $('.window').fadeOut(200);
        $('.shadow').fadeOut(300);
    });
});
$(window).resize(function(){
    if ($('.window').css("display") == "block") {
        windowShow();
    }

});
function windowShow(){
    let width = $(window).width();
    let height = $(window).height();
    $('.shadow').css("display","block");
    $('.shadow').width(width);
    $('.shadow').height(height);
    $('.window').css("display","block");
    let x = width/2 - $('.window').width()/2;
    let y = height/2 - 100;
    $('.window').css("left",x+"px");
    $('.window').css("top",y+"px");

}
