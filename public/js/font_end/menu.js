$(document).ready(function() {
var aboveHeight = 20;
    $(window).scroll(function(){
        if ($(window).scrollTop() > aboveHeight){
        $("sticknav").addClass('fixed').css('top','0').next().css('padding-top','60px');
        } else {
        $("sticknav").removeClass('fixed').next().css('padding-top','0');
        }
    });
});
