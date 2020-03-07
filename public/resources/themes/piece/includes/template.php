<?php
/**
 * Created by : SAIED.LAKHDAR.LOAI
 * User:        DJELFANETWORK
 * Dvlper Email:saied.lakhdar01@gmail.com
 * Date:        1/22/2020
 * Time:        12:56 AM
 * Filename :   template.php
 */

return [
    'template' => [
        'wrapper_start'     => '__{themefoldetr}__/includes/inc/wrapperstart.php',
        'navbar'            => '__{themefoldetr}__/includes/inc/navbar.php',
        'sidebar'           => '__{themefoldetr}__/includes/inc/sidebar.php',
        '__view'            => '__main_view',
        'wrapper_end'       => '__{themefoldetr}__/includes/inc/wrapperend.php',
    ],
    'header_resources' =>    [
        'css'   => [
            'fontawesome'                           => '__{themefoldetr}__/includes/assets/vendor/fontawesome-free/css/all.min.css' ,
            'style'                                 => '__{themefoldetr}__/includes/assets/css/sb-admin-2.min.css' ,
            // 'custom-rtl'                            => '__{themefoldetr}__/includes/assets/css/custom-rtl.css' ,
            'custom'                                => '__{themefoldetr}__/includes/assets/css/custom.css' ,

        ],
        'js'    => [

        ],

    ],
    'footer_resources' => [
        'jquery'         => '__{themefoldetr}__/includes/assets/vendor/jquery/jquery.min.js',
        'bootstrap'      => '__{themefoldetr}__/includes/assets/vendor/bootstrap/js/bootstrap.bundle.min.js',
        'jquery.easing'  => '__{themefoldetr}__/includes/assets/vendor/jquery-easing/jquery.easing.min.js',
        'admin'          => '__{themefoldetr}__/includes/assets/js/sb-admin-2.min.js',
//        'bootstrap-rtl'  => '__{themefoldetr}__/includes/assets/js/rtl/bootstrap.min.js',
        'cookies'        => '__{themefoldetr}__/includes/assets/js/cookiesjs.js',
        'mainjs'         => '__{themefoldetr}__/includes/assets/js/mainjs.js',
    ]
] ;