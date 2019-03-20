
$('.inputi').focusin(function () {
    $(this).parent().fadeTo(0.2, 1);
});

$('#go-ahead').click(function () {
    $('html, body').animate({
        scrollTop: $(this).parent().offset().top + 100 + 'px'
    }, 'fast');
    $('#first_name').focus();
});

$('.inputi').focusout(function () {
    $(this).parent().fadeTo(0.2, 0.6);
});

$('.inputi').focus(function () {
    $('html, body').animate({
        scrollTop: $(this).parent().offset().top - 200 + 'px'
    }, 'fast');
});





