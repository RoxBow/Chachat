
$(function () {

    $('.link-login').on('click', function () {
        loadForm("form_login.html");
    });

    $('.link-register').on('click', function () {
        loadForm("form_register.html");
    });

    $('.wrapper-btn-login a').on('click', function () {
        $('.wrapper-btn-login a.selected').removeClass('selected');
        $(this).addClass('selected');
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
        $('html,body').animate({ scrollTop: $(".section-champs-login").offset().top }, 'slow');
    }
}
