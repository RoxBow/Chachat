$(".wrapper-form").load("./views/login/form_login.html");

if (window.matchMedia('(max-width: 767px)').matches) {
    $('.li-login').removeClass('selected');
}

$(function () {
    $('.li-login').on('click', function () {
        loadForm("form_login.html");
    });

    $('.li-register').on('click', function () {
        loadForm("form_register.html");
    });

    $('.li-guest').on('click', function () {
        $('.wrapper-form').empty();
    });

    $('.wrapper-link-home ul li').on('click', function () {
        $('.wrapper-link-home ul li.selected').removeClass('selected');
        $(this).addClass('selected');
    });

    $('.close-popin').on('click', function () {
        $('.popin').hide();
    });

    $('.burger-menu').on('click', function () {
        $('.section-menu').toggleClass('selected');
    });
});

function loadForm(nameFile) {

    $.ajax({
        url: './views/login/' + nameFile, // La ressource ciblée
        type: 'GET', // Le type de la requête HTTP
        dataType: 'html', // Le type de données à recevoir, ici, du HTML.
        success: function (code_html) {
            $('.wrapper-form').replaceWith(code_html);
        }
    });

    // Si on est en version mobile, scroll jusqu'au formulaire lors du clique
    if (window.matchMedia('(max-width: 767px)').matches) {
        $('html,body').animate({ scrollTop: $(".wrapper-form-home").offset().top }, 'slow');
    }
}
