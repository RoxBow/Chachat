$('.wrapper-icone-room span').on('click', function() {
    $(this).toggleClass('selected');

    if ($(this).hasClass('selected')) {
        $('.wrapper-info-room').css("left", "0");
    } else {
        $('.wrapper-info-room').css("left", "-50%");
    }
});

$('.wrapper-icone-amis span').on('click', function() {
    $(this).toggleClass('selected');
    
    if ($(this).hasClass('selected')) {
        $('.wrapper-list-amis').css("right", "0");
    } else {
        $('.wrapper-list-amis').css("right", "-40%");
    }
});