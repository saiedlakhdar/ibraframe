<?php
/**
 * Created by : SAIED.LAKHDAR.LOAI
 * User:        DJELFANETWORK
 * Dvlper Email:saied.lakhdar01@gmail.com
 * Date:        1/21/2020
 * Time:        3:40 AM
 * Filename :   errors.lang.php
 */

// validations errors labels

// errors labels
$_lang['error_label_username']  =  '%s ماخوذ مسبقا ' ;
$_lang['error_label_email']     =  '%s ماخوذ مسبقا ' ;
$_lang['error_label_phone']     =  '%s ماخوذ مسبقا ' ;
$_lang['error_label_taken']     =  '%s ماخوذ مسبقا ' ;
$_lang['error_label_error']     =  'خطأ في %s' ;
// onep errors labels

$_lang['error_text_req']        =  'حقل (%s) مطلوب ' ;
$_lang['error_text_num']        =  '%s يجيب ان يحتوي على قيمة عددية ' ;
$_lang['error_text_int']        =  '%s يجب ان يكون عدد صحيح '  ;
$_lang['error_text_float']      =  '%sيجب ان يكون عدد عشري (كسري) ' ;
$_lang['error_text_ddate']      =  '%sيجب ان يكون تاريخ ' ;
$_lang['error_text_alpha']      =  '%sيجب ان يكون حروف فقط ' ;
$_lang['error_text_vstring']    =  '%sيجب ان يكون سلسلة حروف و ارقام فقط ' ;
$_lang['error_text_email']      =  '%s يجب ان يكون بريد الكتروني صحيح ex: email@gmail.com' ;
$_lang['error_text_url']        =  '%sيجب ان يكون رابط ' ;
$_lang['error_text_ipv4']       =  '%sيجب ان يكون IP  ' ;
$_lang['error_text_phone']      =  '%s يجب ان يحتوي ارقاما فقط (او علامة +)' ;

// twop errors labels

$_lang['error_text_lt']         =  '%sيجب ان يكون اقل من %s' ;
$_lang['error_text_gt']         =  '%sيجب ان يكون اكبر من %s' ;
$_lang['error_text_min']        =  '%s يجب ان تكون قيمته على الاقل %s احرف' ;
$_lang['error_text_max']        =  '%s يجب ان تكون قسمته على الاكثر %s احرف' ;
$_lang['error_text_eq']         =  '%s يجب ان يكون مساو لـ %s' ;
$_lang['error_text_eqf']        =  '%s يجب ان تكون قيمته مساوية لـ %s' ;


// threep errors labels

$_lang['error_text_between']    =  '%s يجب ان تكون قيمته بين %s و %s (حرفا اذا كان نصيا )' ;
$_lang['error_text_lendecimal'] =  '%s يجب ان يحتوي %s رقم قبل الفاصلة و %s رقم بعد الفاصلة' ;

// Upload files errors

$_lang['upload_err_ok']          = 'تم تحميل الملف بنجاح' ;
$_lang['upload_err_ini_size']    = 'حجم الملف اكثر من %s' ;
$_lang['upload_err_form_size']   = 'حجم الملف اكثر من %s';
$_lang['upload_err_partial']     = 'تم تحميل جزء من الملف فقط' ;
$_lang['upload_err_no_file']     = 'لا يوجد ملف' ;
$_lang['upload_err_no_tmp_dir']  = 'لا يوجد مجلد التخزين المؤقت' ;
$_lang['upload_err_cant_write']  = 'لا يمكن الكتابة على القرص' ;
$_lang['upload_err_extension']   = 'تم منع تحميل الملب بسبب النظام' ;
$_lang['upload_err_max_size']    = 'حجم الملف اكثر من %s' ;
$_lang['upload_err_bad_ext']     = 'صيغة الملف غير صالحة' ;
$_lang['upload_err_unknown']     = 'خطا غير معروف اثناء تحميل الملف' ;