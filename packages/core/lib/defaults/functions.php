<?php

function deleteFile($path){
   if (file_exists($path)){
       return unlink($path) ;
   }

} ;