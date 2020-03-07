(function () {
    if (getCookie('menu-closed') == 'true') {
        $('button.sidebaropen').attr('data-menu-status','true' );
        $('ul#accordionSidebar').addClass('toggled') ;
        $('body#page-top').removeClass('sidebar-toggled') ;

    }
})();

$('button.sidebaropen').click(function (evt) {

    evt.preventDefault() ;

    if ($(this).attr('data-menu-status') == 'false'){
        $(this).attr('data-menu-status','true' );
        $('ul#accordionSidebar').addClass('toggled') ;
        $('body#page-top').removeClass('sidebar-toggled') ;
        if (getCookie('menu-closed') == ''){
            setCookie('menu-closed', true, 180, 'localhost')
        }
    }else {
        $(this).attr('data-menu-status','false' );
        $('ul#accordionSidebar').removeClass('toggled') ;
        $('body#page-top').addClass('sidebar-toggled') ;

        deleteCookie('menu-closed', 'ibralite.com') ;
    }

}) ;

// $("#alert").fadeTo(5000, 1).fadeOut(500, function(){
//     $("#alert").fadeOut(500);
// });

window.setTimeout(function() {
    $("#alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 5000);

// Call the dataTables jQuery plugin
// $(document).ready(function() {
//     $('#dataTable').DataTable();
// });
