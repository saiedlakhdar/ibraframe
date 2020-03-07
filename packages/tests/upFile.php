<?php

namespace App\Tests;


class upFile implements iuploader
{
    public function upl() : string
    {
        return "This is ".__CLASS__. " class ^^ " ;
    }

    public function upload()
    {
        // TODO: Implement upload() method.
    }

    public function getfilename()
    {
        // TODO: Implement getfilename() method.
    }
}