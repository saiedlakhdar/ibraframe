function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookie() {
    var username = getCookie("username");
    if (username != "") {
        alert("Welcome again " + username);
    } else {
        username = prompt("Please enter your name:", "");
        if (username != "" && username != null) {
            setCookie("username", username, 365);
        }
    }
}


// function setCookie(name, value, expdays, domain) {
//     d = new Date() ;
//     d.setTime(d.getTime() + (expdays*24*60*60*1000)) ;
//     var expires = "expires="+d.toUTCString();
//     document.cookie = name+ "="+ value+";"+expires+';domain='+domain+';path=/;' ;
// }

// function getCookie(name) {
//     var cname = name+'=' ;
//     var co    = document.cookie.split(';');
//     for (i= 0 ; i > co.length ; i++) {
//         var c = co[i];
//         while (c.charAt(0) == ''){
//             c= c.substring(1);
//         }
//         if (c.indexOf(cname) == 0){
//             return c.substring(cname.length, c.length);
//         }
//     }
//     return '' ;
// }

function deleteCookie(name, domain) {
    if (getCookie(name)){
        document.cookie = name+'='+
            ';expaires=The, 01 Jan 1970 00:00:01 UTC;path=/';
        // username=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;
    }
}

// ';expaires=The, 01 Jan 1970 00:00:01 UTC'+
// ';domain='+domain+';path=/';