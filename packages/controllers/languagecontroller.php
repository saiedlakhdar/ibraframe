<?php
/**
 * Created by : SAIED.LAKHDAR.LOAI
 * User:        DJELFANETWORK
 * Dvlper Email:saied.lakhdar01@gmail.com
 * Date:        1/31/2020
 * Time:        11:47 AM
 * Filename :   languagecontroller.php
 */

namespace App\controllers;


use App\Controllers\common\AbstractController;

class LanguageController extends AbstractController
{

    public function NotfoundAction() :void
    {
        // no languaage file needed
        // no view will return
        $this->referer('/');
    }

    public function arAction()
    {
        // no languaage file needed
        // no view will return
        if (isset($this->session->app_lang)){
            if ($this->session->app_lang != 'ar'){
                $this->session->app_lang = 'ar' ;
                $this->referer('/');
            }
            $this->referer('/');
        }
        $this->referer('/');
    }

    public function enAction()
    {
        // no languaage file needed
        // no view will return
        if (isset($this->session->app_lang)){
            if ($this->session->app_lang != 'en'){
                $this->session->app_lang = 'en' ;
                $this->referer('/');
            }
            $this->referer('/');
        }
        $this->referer('/');
    }
}