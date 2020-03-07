<?php
/**
 * Created by : SAIED.LAKHDAR.LOAI
 * User:        DJELFANETWORK
 * Dvlper Email:saied.lakhdar01@gmail.com
 * Date:        1/23/2020
 * Time:        7:44 AM
 * Filename :   logincontroller.php
 */

namespace App\controllers;


use App\Controllers\common\AbstractController;
use App\controllers\interfaces\ActionInterface;

class LoginController extends AbstractController implements ActionInterface
{

    public function defaultAction()
    {
        // no languaage file needed
        // no view will return

        // TODO: Implement defaultAction() method.
        $this->redirect('/auth');
    }
    public function NotfoundAction() :void
    {
        // no languaage file needed
        // no view will return

        $this->redirect('/auth');
    }
}