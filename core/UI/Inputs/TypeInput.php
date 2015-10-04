<?php

namespace SVKJ\Remindr\UI\Inputs;


/**
 * Class TypeInput
 * @package SVKJ\Remindr\UI\Inputs
 */
class TypeInput extends AbstractInput
{
    public $posts = array();

    public function prepare()
    {

    }

    /**
     * @param $value
     */
    public function setValue($value){
        $this->value = filter_var($value, FILTER_SANITIZE_STRING);
    }
}