<?php

namespace SVKJ\Remindr\Model;


/**
 * Class ReminderModel
 * @package SVKJ\Remindr\Model
 */
class ReminderModel
{

    /**
     * Post ID of the related content
     * @var int
     */
    public $target = null;

    /**
     *
     * @var string
     */
    public $type = 'any';

    /**
     * unix timestamp
     * @var null|int
     */
    public $date = null;

    public $noticemsg;

    public $mailmsg;
    /**
     * @var \WP_Post;
     */
    private $post;

    /**
     * @param $post
     */
    public function __construct( $post )
    {
        $this->post = $post;
        $this->refresh();
    }

    /**
     *
     */
    public function refresh()
    {
        $meta = get_post_custom( $this->post->ID );
        $map = array();
        foreach ($meta as $key => $val) {
            if (strpos( $key, '_remindr_' )) {
                $cleanKey = str_replace( '_remindr_', '', $key );
                $map[$cleanKey] = $val;
            }
        }
        $this->set( $map );
    }

    /**
     * @param $map
     * @return \Exception
     */
    public function set( $map )
    {
        if (!is_array( $map )) {
            return new \Exception( 'array with key / value pairs required' );
        }

        foreach ($map as $key => $value) {
            if (property_exists( $this, $key )) {
                $this->$key = $value;
            }
        }
    }

    /**
     * Save current state to post meta
     * @return bool|int
     */
    public function sync()
    {
        $vars = $this->getPublicProperties();
        foreach ($vars as $key => $value) {
            $this->updateMeta( $key, $value );
        }
    }

    /**
     * @return mixed
     */
    private function getPublicProperties()
    {
        return call_user_func( 'get_object_vars', $this );
    }

    /**
     * @param $key
     * @param $value
     */
    public function updateMeta( $key, $value )
    {
        update_post_meta( $this->post->ID, $this->prefixKey( $key ), $value );
    }

    /**
     * @param $key
     * @return string
     */
    public function prefixKey( $key )
    {
        if (!strpos( $key, '_remindr_' )) {
            return '_remindr_' . $key;
        }
    }

    /**
     * @param $property
     * @return null
     */
    public function get( $property )
    {
        if (property_exists( $this, $property )) {
            return $this->$property;
        }

        return null;
    }
}