<?php

namespace SVKJ\Remindr\UI\Inputs;


use SVKJ\Remindr\Model\ReminderModel;

/**
 * Class AbstractInput
 * @package SVKJ\Remindr\UI\Inputs
 */
abstract class AbstractInput
{
    public $key;

    /**
     * @var null|int
     */
    public $value = null;

    /**
     * @var ReminderModel
     */
    protected $model;

    public $changed = false;

    /**
     * @param $key
     * @param ReminderModel $model
     */
    public function __construct( $key, ReminderModel $model )
    {
        $this->key = $key;
        $this->model = $model;
    }

    abstract public function prepare();

    public function sync()
    {
        update_post_meta( $this->model->getPost()->ID, $this->prefixKey( $this->key ), $this->getValue() );
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
     * @return int|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     */
    public function setValue( $value )
    {
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function hasChanged(){
        return $this->changed;
    }
}