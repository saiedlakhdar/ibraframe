<?php
/**
 * Created by : SAIED.LAKHDAR.LOAI
 * User:        DJELFANETWORK
 * Dvlper Email:saied.lakhdar01@gmail.com
 * Date:        1/16/2020
 * Time:        4:42 PM
 * Filename :   notfoundcontroller.php
 */

namespace App\controllers\common;

use App\Controllers\common\AbstractController;
use App\controllers\interfaces\ActionInterface;

class NotfoundController extends AbstractController implements ActionInterface
{

    public function defaultAction()
    {
        $this->templatelang->load('common');
        $this->_view();
    }






}