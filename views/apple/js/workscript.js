$(function () {

    $('.catalog').dcAccordion();

    $('#forgot-link').click(function () {
        $('#auth').fadeOut(300,function () {
            $('#forgot').fadeIn();
        });
        return false;
    });
    $('#auth-link').click(function () {
        $('#forgot').fadeOut(300,function () {
            $('#auth').fadeIn();
        });
        return false;
    });

});