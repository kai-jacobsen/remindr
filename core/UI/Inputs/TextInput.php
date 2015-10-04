<?php

namespace SVKJ\Remindr\UI\Inputs;


/**
 * Class TextInput
 * @package SVKJ\Remindr\UI\Inputs
 */
class TextInput extends AbstractInput
{

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