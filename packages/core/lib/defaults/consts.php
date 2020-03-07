<?php

/**
 * Created by : SAIED.LAKHDAR.LOAI.
 * User: djelfanetwork
 * Date: 6/7/2018
 * Time: 1:30 AM
 * Filename : consts.php
 */

/**
 * define Directory seperator
 */
defined('DS') ? null : define('DS',DIRECTORY_SEPARATOR) ;

/**
 * public dir "PDIR" basedir
 */
defined('BDIR') ? null : define('BDIR',dirname(realpath(__DIR__)).DS.'..'.DS .'..'.DS) ;
/**
 * private dir "PDIR" sould be change if the public or packages directory moved
 */
defined('PDIR') ? null : define('PDIR', dirname(realpath(__DIR__)).DS.'..'.DS.'..'.DS .'..'.DS.'public'.DS ) ;
/**
 * Themes dir
 */
defined('THEMES_DIR') ? null : define('THEMES_DIR',PDIR . 'resources'.DS.'themes'.DS ) ;
/**
 * Themes dir
 */
defined('UPLOADS') ? null : define('UPLOADS',PDIR . 'resources'.DS.'uploads'.DS ) ;
defined('IMAGES') ? null : define('IMAGES', UPLOADS .'images' .DS) ;
defined('DOCS') ? null : define('DOCS', UPLOADS .'docs' .DS ) ;

/**
 * language dir
 */
defined('LANG_DIR') ? null : define('LANG_DIR',PDIR . 'resources'.DS.'languages'.DS ) ;

/**
 * language dir
 */
defined('PLUGINS') ? null : define('PLUGINS',PDIR . 'resources'.DS.'plugins'.DS ) ;

/**
 * Current theme folder
 */
defined('DEFAULT_THEME') ? null : define('DEFAULT_THEME', 'piece') ;
/**
 * Sessions name must be set here
 */
defined('SESSNAME') ? null : define('SESSNAME', 'DNGSM') ;
/**
 * Sessions name must be set here
 */
defined('AUTHS') ? null : define('AUTHS', true) ;