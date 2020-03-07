
(function () {
    if (getCookie('menu-opened') == 'true') {
        $('button.material-icons').attr('data-menu-status','true' );
        $('aside.mdc-drawer').removeClass('mdc-drawer--open') ;
    }
})();

$('button.material-icons').click(function (evt) {

    evt.preventDefault() ;

    if ($(this).attr('data-menu-status') == 'false'){
        $(this).attr('data-menu-status','true' );
        $('aside.mdc-drawer').addClass('mdc-drawer--open') ;
        if (getCookie('menu-opened') == ''){
            setCookie('menu-opened', true, 180, 'localhost')
        }
    }else {
        $(this).attr('data-menu-status','false' );
        $('aside.mdc-drawer').removeClass('mdc-drawer--open') ;
        deleteCookie('menu-opened', 'ibralite.com') ;
    }
}) ;

