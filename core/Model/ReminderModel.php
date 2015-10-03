<?php

namespace SVKJ\Remindr\Model;

use SVKJ\Remindr\UI\Inputs\CustomDateInput;
use SVKJ\Remindr\UI\Inputs\DateInput;
use SVKJ\Remindr\UI\Inputs\TargetInput;
use SVKJ\Remindr\UI\Inputs\TypeInput;


/**
 * Class ReminderModel
 * @package SVKJ\Remindr\Model
 */
class ReminderModel
{

    /**
     * Post ID of the related content
     * @var \SVKJ\Remindr\UI\Inputs\TargetInput
     */
    public $target;

    /**
     * @var string
     */
    public $type;

    /**
     * @var null|int
     */
    public $date;

    /**
     * @var
     */
    public $customdate;

    /**
     * @var string
     */
    public $noticemsg;

    /**
     * @var string
     */
    public $mailmsg;

    /**
     * @var int
     */
    public $count = 0;

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
        $this->target = new TargetInput( 'target', $this );
        $this->type = new TypeInput( 'type', $this );
        $this->date = new DateInput( 'date', $this );
        $this->customdate = new CustomDateInput('customdate', $this);
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
            if (strpos( $key, '_remindr_' ) !== false) {
                $cleanKey = str_replace( '_remindr_', '', $key );
                $map[$cleanKey] = $val[0];
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
            if (is_object( $this->$key )) {
                if (!is_null( $this->$key->value && $this->$key->value !== $value )) {
                    $this->$key->changed = true;
                }
                $this->$key->setValue( $value );
            }
        }
    }

    /**
     * Save current state to post meta
     * @return bool|int
     */
    public function sync()
    {
        foreach ($this->getPublicProperties() as $object) {
            if (is_object( $object )) {
                $object->sync();
            }
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

    public function prepare()
    {

        foreach ($this->getPublicProperties() as $object) {
            if (is_object( $object )) {
                $object->prepare();
            }
        }
    }

    /**
     * @return \WP_Post
     */
    public function getPost()
    {
        return $this->post;
    }

}