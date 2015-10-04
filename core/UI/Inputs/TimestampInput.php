<?php

namespace SVKJ\Remindr\UI\Inputs;


/**
 * Class TimestampInput
 * @package SVKJ\Remindr\UI\Inputs
 */
class TimestampInput extends AbstractInput
{

    public function prepare()
    {

    }

    /**
     * @param $value
     */
    public function setValue($value){
        $this->value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }

}