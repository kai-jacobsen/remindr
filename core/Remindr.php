<?php

namespace SVKJ\Remindr;


/**
 * Class Remindr
 * @package SVKJ\Remindr
 */
class Remindr
{

    /**
     * @var string
     */
    public $pluginPath;

    /**
     * @var string
     */
    public $pluginUrl;

    /**
     * @var string
     */
    public $posttype;

    private function __construct()
    {
    }

    /**
     * @return Remindr
     */
    public static function getInstance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new self;
        }
        return $inst;
    }

    public function run()
    {
        if (is_admin()) {
            add_action( 'init', array( $this, 'registerPostType' ) );
            add_action( 'add_meta_boxes', array( $this, 'setupInterface' ), 10, 2 );
        }
    }

    /**
     *
     */
    public function registerPostType()
    {
        $this->posttype = include_once $this->getPluginPath() . '/inc/posttype.php';
    }


    /**
     * @return string
     */
    public function getPluginPath()
    {
        return $this->pluginPath;
    }


    /**
     * @param string $path
     */
    public function setPluginPath( $path )
    {
        $this->pluginPath = $path;
    }

    /**
     * @param string $postType
     * @param \WP_Post $post
     */
    public function setupInterface( $postType, $post )
    {
        if ($postType === $this->posttype) {
            $editScreen = new UI\EditScreen( $post );
            $editScreen->run();
        }
    }


    /**
     * @return string
     */
    public function getPluginUrl()
    {
        return $this->pluginUrl;
    }

    /**
     * @param string $dir
     */
    public function setPluginUrl( $dir )
    {
        $this->pluginUrl = $dir;
    }

}