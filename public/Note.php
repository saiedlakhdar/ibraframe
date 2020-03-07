<?php
/**
 * Created by : SAIED.LAKHDAR.LOAI.
 * User: djelfanetwork
 * Date: 6/5/2018
 * Time: 8:19 AM
 * Filename : Note.php
 */


$this->allowed = array(
    'application/arj',
    'application/excel',
    'application/gnutar',
    'application/mspowerpoint',
    'application/msword',
    'application/octet-stream',
    'application/onenote',
    'application/pdf',
    'application/plain',
    'application/postscript',
    'application/powerpoint',
    'application/rar',
    'application/rtf',
    'application/vnd.ms-excel',
    'application/vnd.ms-excel.addin.macroEnabled.12',
    'application/vnd.ms-excel.sheet.binary.macroEnabled.12',
    'application/vnd.ms-excel.sheet.macroEnabled.12',
    'application/vnd.ms-excel.template.macroEnabled.12',
    'application/vnd.ms-office',
    'application/vnd.ms-officetheme',
    'application/vnd.ms-powerpoint',
    'application/vnd.ms-powerpoint.addin.macroEnabled.12',
    'application/vnd.ms-powerpoint.presentation.macroEnabled.12',
    'application/vnd.ms-powerpoint.slide.macroEnabled.12',
    'application/vnd.ms-powerpoint.slideshow.macroEnabled.12',
    'application/vnd.ms-powerpoint.template.macroEnabled.12',
    'application/vnd.ms-word',
    'application/vnd.ms-word.document.macroEnabled.12',
    'application/vnd.ms-word.template.macroEnabled.12',
    'application/vnd.oasis.opendocument.chart',
    'application/vnd.oasis.opendocument.database',
    'application/vnd.oasis.opendocument.formula',
    'application/vnd.oasis.opendocument.graphics',
    'application/vnd.oasis.opendocument.graphics-template',
    'application/vnd.oasis.opendocument.image',
    'application/vnd.oasis.opendocument.presentation',
    'application/vnd.oasis.opendocument.presentation-template',
    'application/vnd.oasis.opendocument.spreadsheet',
    'application/vnd.oasis.opendocument.spreadsheet-template',
    'application/vnd.oasis.opendocument.text',
    'application/vnd.oasis.opendocument.text-master',
    'application/vnd.oasis.opendocument.text-template',
    'application/vnd.oasis.opendocument.text-web',
    'application/vnd.openofficeorg.extension',
    'application/vnd.openxmlformats-officedocument.presentationml.presentation',
    'application/vnd.openxmlformats-officedocument.presentationml.slide',
    'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
    'application/vnd.openxmlformats-officedocument.presentationml.template',
    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
    'application/vocaltec-media-file',
    'application/wordperfect',
    'application/x-bittorrent',
    'application/x-bzip',
    'application/x-bzip2',
    'application/x-compressed',
    'application/x-excel',
    'application/x-gzip',
    'application/x-latex',
    'application/x-midi',
    'application/xml',
    'application/x-msexcel',
    'application/x-rar',
    'application/x-rar-compressed',
    'application/x-rtf',
    'application/x-shockwave-flash',
    'application/x-sit',
    'application/x-stuffit',
    'application/x-troff-msvideo',
    'application/x-zip',
    'application/x-zip-compressed',
    'application/zip',
    'audio/*',
    'image/*',
    'multipart/x-gzip',
    'multipart/x-zip',
    'text/plain',
    'text/rtf',
    'text/richtext',
    'text/xml',
    'video/*'
);
$this->mime_types = array(
    'jpg' => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'jpe' => 'image/jpeg',
    'gif' => 'image/gif',
    'png' => 'image/png',
    'bmp' => 'image/bmp',
    'flv' => 'video/x-flv',
    'js' => 'application/x-javascript',
    'json' => 'application/json',
    'tiff' => 'image/tiff',
    'css' => 'text/css',
    'xml' => 'application/xml',
    'doc' => 'application/msword',
    'docx' => 'application/msword',
    'xls' => 'application/vnd.ms-excel',
    'xlt' => 'application/vnd.ms-excel',
    'xlm' => 'application/vnd.ms-excel',
    'xld' => 'application/vnd.ms-excel',
    'xla' => 'application/vnd.ms-excel',
    'xlc' => 'application/vnd.ms-excel',
    'xlw' => 'application/vnd.ms-excel',
    'xll' => 'application/vnd.ms-excel',
    'ppt' => 'application/vnd.ms-powerpoint',
    'pps' => 'application/vnd.ms-powerpoint',
    'rtf' => 'application/rtf',
    'pdf' => 'application/pdf',
    'html' => 'text/html',
    'htm' => 'text/html',
    'php' => 'text/html',
    'txt' => 'text/plain',
    'mpeg' => 'video/mpeg',
    'mpg' => 'video/mpeg',
    'mpe' => 'video/mpeg',
    'mp3' => 'audio/mpeg3',
    'wav' => 'audio/wav',
    'aiff' => 'audio/aiff',
    'aif' => 'audio/aiff',
    'avi' => 'video/msvideo',
    'wmv' => 'video/x-ms-wmv',
    'mov' => 'video/quicktime',
    'zip' => 'application/zip',
    'tar' => 'application/x-tar',
    'swf' => 'application/x-shockwave-flash',
    'odt' => 'application/vnd.oasis.opendocument.text',
    'ott' => 'application/vnd.oasis.opendocument.text-template',
    'oth' => 'application/vnd.oasis.opendocument.text-web',
    'odm' => 'application/vnd.oasis.opendocument.text-master',
    'odg' => 'application/vnd.oasis.opendocument.graphics',
    'otg' => 'application/vnd.oasis.opendocument.graphics-template',
    'odp' => 'application/vnd.oasis.opendocument.presentation',
    'otp' => 'application/vnd.oasis.opendocument.presentation-template',
    'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
    'ots' => 'application/vnd.oasis.opendocument.spreadsheet-template',
    'odc' => 'application/vnd.oasis.opendocument.chart',
    'odf' => 'application/vnd.oasis.opendocument.formula',
    'odb' => 'application/vnd.oasis.opendocument.database',
    'odi' => 'application/vnd.oasis.opendocument.image',
    'oxt' => 'application/vnd.openofficeorg.extension',
    'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'docm' => 'application/vnd.ms-word.document.macroEnabled.12',
    'dotx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.template',
    'dotm' => 'application/vnd.ms-word.template.macroEnabled.12',
    'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    'xlsm' => 'application/vnd.ms-excel.sheet.macroEnabled.12',
    'xltx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.template',
    'xltm' => 'application/vnd.ms-excel.template.macroEnabled.12',
    'xlsb' => 'application/vnd.ms-excel.sheet.binary.macroEnabled.12',
    'xlam' => 'application/vnd.ms-excel.addin.macroEnabled.12',
    'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
    'pptm' => 'application/vnd.ms-powerpoint.presentation.macroEnabled.12',
    'ppsx' => 'application/vnd.openxmlformats-officedocument.presentationml.slideshow',
    'ppsm' => 'application/vnd.ms-powerpoint.slideshow.macroEnabled.12',
    'potx' => 'application/vnd.openxmlformats-officedocument.presentationml.template',
    'potm' => 'application/vnd.ms-powerpoint.template.macroEnabled.12',
    'ppam' => 'application/vnd.ms-powerpoint.addin.macroEnabled.12',
    'sldx' => 'application/vnd.openxmlformats-officedocument.presentationml.slide',
    'sldm' => 'application/vnd.ms-powerpoint.slide.macroEnabled.12',
    'thmx' => 'application/vnd.ms-officetheme',
    'onetoc' => 'application/onenote',
    'onetoc2' => 'application/onenote',
    'onetmp' => 'application/onenote',
    'onepkg' => 'application/onenote',
);