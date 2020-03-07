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
        'sidebar'           => '__{themefoldetr}__/includes/inc/sidebar.php',
        'navbar'            => '__{themefoldetr}__/includes/inc/navbar.php',
        '__view'            => '__main_view',
        'wrapper_end'       => '__{themefoldetr}__/includes/inc/wrapperend.php',
    ],
    'header_resources' =>    [
        'css'   => [
            'materialdesignicons'                         => '__{themefoldetr}__/includes/assets/vendors/mdi/css/materialdesignicons.min.css' ,
            'vendorbundle'                         => '__{themefoldetr}__/includes/assets/vendors/css/vendor.bundle.base.css' ,
            'style'                         => '__{themefoldetr}__/includes/assets/css/demo/style.css' ,
            'bootstrap-4.4'                      => '__{themefoldetr}__/includes/assets/css/bootstrap.min.css' ,

        ],
        'js'    => [

        ],

    ],
    'footer_resources' => [
        'vendor_bundle'      => '__{themefoldetr}__/includes/assets/vendors/js/vendor.bundle.base.js',
        'material'      => '__{themefoldetr}__/includes/assets/js/material.js',
        'bootstrap-4.4'      => '__{themefoldetr}__/includes/assets/js/bootstra.js',
        'misc'      => '__{themefoldetr}__/includes/assets/js/misc.js',
        'cookiesjs'      => '__{themefoldetr}__/includes/assets/js/cookiesjs.js',
        'mainjs'      => '__{themefoldetr}__/includes/assets/js/mainjs.js',
    ]
] ;