<?php

/*
Plugin Name: Remindr
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: Steffen Voss | Kai Jacobsen
Author URI: http://URI_Of_The_Plugin_Author
License: GPL2
*/

namespace SVKJ\Remindr;

include_once 'autoloader.php';

add_action(
    'plugins_loaded',
    function () {
        $remindr = Remindr::getInstance();
        $remindr->setPluginUrl( plugin_dir_url( __FILE__ ) );
        $remindr->setPluginPath( plugin_dir_path( __FILE__ ) );
        $remindr->run();
    }
);

