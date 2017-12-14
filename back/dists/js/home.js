
$(function () {
    $('.link-login').on('click', function() {
        $.ajax({
            url : './views/login/form_login.html', // La ressource ciblée
            type : 'GET', // Le type de la requête HTTP
            dataType : 'html', // Le type de données à recevoir, ici, du HTML.
            success : function(code_html){ // success est toujours en place, bien sûr !
                $('.wrapper-form').replaceWith(code_html);
            },
            error : function(){
            }
        });
    });

    $('.link-register').on('click', function() {
        $.ajax({
            url : './views/login/form_register.html', // La ressource ciblée
            type : 'GET', // Le type de la requête HTTP
            dataType : 'html', // Le type de données à recevoir, ici, du HTML.
            success : function(code_html){ // success est toujours en place, bien sûr !
                $('.wrapper-form').replaceWith(code_html);
            },
            error : function(){
            }
        });
    });

    $('.wrapper-btn-login a').on('click', function() {
        $('.selected').removeClass('selected');
        $(this).addClass('selected');
    })
});