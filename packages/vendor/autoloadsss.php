<?php namespace Ibralak ;

class Autoload {

    /**
     * @param String $className
     */
    public static function Loader($className )
    {
        $classMap = str_ireplace("\\" , "/" , $className) ;
        $classMap = str_ireplace(__NAMESPACE__."/" , "" , $classMap) ;
        $classMap = strtolower($classMap) ;
        $classMap = $classMap .  ".php" ;
        $baseDir = __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR ;
        $classMap = $baseDir . $classMap ;
        if (file_exists($classMap))
        {
            require $classMap ;
        }
        else
        {
            echo "<h1>$classMap Does't Exists  </h1>" ;
        }
    }

}

spl_autoload_register(__NAMESPACE__.'\Autoload::Loader') ;

