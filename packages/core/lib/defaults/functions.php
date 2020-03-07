<?php

function deleteFile($path){
    if (!is_dir($path) && file_exists($path)){
        return unlink($path) ;
    }
} ;