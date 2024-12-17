$(document).ready(function(){
    $('.downloadButton').on("click",function(){
        let width = $(window).width();
        let height = $(window).height();
        $('.shadow').css("display","block");
        $('.shadow').width(width);
        $('.shadow').height(height);
        $('.window').css("display","block");
        let x = width/2 - 200;
        $('.window').css("left",x+"px");
    });
    $('.windowClose').on("click",function(){
        $('.window').fadeOut(200);

        $('.shadow').fadeOut(300);

    });

});
