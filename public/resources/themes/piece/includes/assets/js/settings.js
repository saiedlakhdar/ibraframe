// select tab by fragment hash
(function () {

        if(window.location.hash == '#profile' ) {
            $('#v-pills-profile-tab').addClass('active').attr('aria-selected', true) ;
            $('#v-pills-profile').tab('show') ;
            setCookie('selectedTab', 'v-pills-profile-tab', 0.05, 'localhost') ;
            window.location.hash = '';
        } else if (window.location.hash == '#account'){
            $('#v-pills-home-tab').addClass('active').attr('aria-selected', true) ;
            $('#v-pills-home').tab('show') ;
            setCookie('selectedTab', 'v-pills-home-tab', 0.05, 'localhost') ;
            window.location.hash = '';
        }
    }
)();

// save tab selected
( function() {
    if (getCookie('selectedTab') !== '') {
        $('#'+getCookie('selectedTab')+'-tab').addClass('active').attr('aria-selected', true) ;
        $('#'+getCookie('selectedTab')).tab('show') ;
    }else {
        $('#v-pills-profile-tab').addClass('active').attr('aria-selected', true) ;
        $('#v-pills-profile').tab('show') ;
    }
})();

$('#v-pills-tab a').click(function (evt) {

    evt.preventDefault() ;

    if (getCookie('selectedTab') !== $(this)[0].id ) {
        setCookie('selectedTab', $(this)[0].id, 0.05, 'localhost') ;
    }


}) ;



// ajax functions

function ajaxq(elm) {
    var xhttp = new XMLHttpRequest() ;
    if (elm.value !== ''){
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200){
                // var feedback = elm.parentElement.getElementsByTagName('div')
                if (elm.classList.contains('is-invalid') ){ elm.classList.remove('is-invalid');
                }else if (elm.classList.contains('is-valid')){elm.classList.remove('is-valid');
                }
                var valid_div = elm.parentElement.getElementsByTagName('div') ;
                if (valid_div.length > 0){
                    var i ;
                    for (i=0 ; i <= valid_div.length ;i++ ){ valid_div.item(i).remove() ;
                    }
                }
                if (this.responseText == 1 ){
                    elm.classList.add('is-invalid') ;
                    elm.parentNode.appendChild(document.createElement('div')).classList.add('invalid-feedback');
                    elm.parentElement.getElementsByTagName('div').item(0).innerHTML = elm.value+' Already taken'  ;
                }else if (this.responseText == 0){
                    elm.classList.add('is-valid') ;
                    elm.parentNode.appendChild(document.createElement('div')).classList.add('valid-feedback');
                    elm.parentElement.getElementsByTagName('div').item(0).innerText = elm.value+' Available'  ;
                }
            }
        } ;
        xhttp.open('GET', '/users/ajaxMethod/'+elm.name+'/'+elm.value , true) ;
        xhttp.setRequestHeader('Content-Type','application/json') ;
        xhttp.send() ;
    }

}

