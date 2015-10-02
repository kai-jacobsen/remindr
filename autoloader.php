<?php
namespace SVKJ\Remindr;

// register SPL Autoloader
spl_autoload_register( 'SVKJ\Remindr\Autoloader::classLoader' );

/**
 * Class Autoloader
 * @package SVKJ\Remindr
 */
class Autoloader
{

    /**
     * @param $className
     */
    public static function classLoader( $className )
    {
        $className  = str_replace( '\\', '/', $className );
        $cleaned = str_replace( 'SVKJ/Remindr', '', $className );
        $path = plugin_dir_path(__FILE__);
        if (file_exists( $path . DIRECTORY_SEPARATOR . 'core' . $cleaned . '.php' )) {
            include_once $path . DIRECTORY_SEPARATOR . 'core' . $cleaned . '.php';
        }

    }

}