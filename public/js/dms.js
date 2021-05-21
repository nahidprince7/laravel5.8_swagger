$(document).ready( function () {

    $('#contextmenu').show();
    $('#contextmenu').addClass('is-fadingIn');

    $('#contextmenu a').on('click',function(e) {
        var value = $(this).text();
        e.preventDefault();
        if( $(this).hasClass('ticked') ) {
            $(this).addClass('unticked');
            $(this).removeClass('ticked');
            return false;
        } else if( $(this).hasClass('unticked') )     {
            $(this).addClass('ticked');
            $(this).removeClass('unticked');
            return false;
        } else {
            alert(value);
        }
    });

    $(document).on("contextmenu", function(e) {
        var delay=0;
        if( $('#contextmenu').hasClass('is-fadingIn') ) delay=100;
        e.preventDefault();
        $('#contextmenu').removeClass('is-fadingIn');
        $('#contextmenu').addClass('is-fadingOut');

        setTimeout(function() {
            $('#contextmenu').css('top',e.clientY);
            $('#contextmenu').css('left',e.clientX);
            $('#contextmenu').removeClass('is-fadingOut');
            $('#contextmenu').addClass('is-fadingIn');
        },delay);

    });

    $(document).on("click", function(e) {
        $('#contextmenu').addClass('is-fadingOut');
    });

});
