$(document).ready(function() {
    new SimpleBar($('#menu')[0]);
    new SimpleBar($('#content')[0]);
    $(".navbar-burger").click(function() {
        $(".navbar-burger").toggleClass("is-active");
        $(".navbar-menu").toggleClass("is-active");
        active = $("#menu").hasClass("is-active");
        if(active){
            $("#menu").animate({
                marginLeft: '-91.66667%'
            }, 200);
        }else{
            $("#menu").animate({
                marginLeft: '0'
            }, 200);
        }
        $("#menu").toggleClass("is-active");
    });
});